<?php

namespace App\Http\Controllers\Wx;

use App\Common\QrImageGenerator;
use App\Entity\Product;
use App\Entity\CasaOrder;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxBind;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\User;
use App\Entity\Wx\WxMembership;
use App\Entity\Wx\WxScoreVariation;
use App\Http\Controllers\BaseController;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use DB;
use Log;
use Config;
use Session;
use App\Common\OrderStatus;

/** 微信民宿订单的生成，操作，展示以及积分抵扣相关的功能 */
class WxOrderController extends BaseController
{
    use OrderStatus;
    /** @var string ORDER_CONSUME_PREFIX 积分抵扣 - */
    const ORDER_CONSUME_PREFIX = "积分抵扣 - ";
    /** @var string ORDER_AWARD_PREFIX 完成订单奖励 - */
    const ORDER_AWARD_PREFIX = "完成订单奖励 - ";

    /**
    * 1.Update user info.
    * 2.Create a new order.
    * 3.Create a ScoreVariation.
    * 4.Update wx membership(score).
    * @param Request $request
    */
    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            // 1.Update user information.
            if (empty(Session::get('user_id'))) {
                return "用户信息（ID）获取失败！";
            }
            $userId = Session::get('user_id');
            $userCheckResult =
                    $this->checkThenSaveUsernameAndCellphone($userId, $request->realname, $request->cellphone);
            if (!$userCheckResult) {
                return "用户信息缺失！";
            }
            // 2.Save order info and process reserved rooms data.
            $reservedRooms = $request->input('reservedRooms');
            if (empty($reservedRooms)) {
                return "没有选购商品！";
            }
            $order = new Order();
            $wxCasa = WxCasa::find($request->input('wxCasaId'));
            $order->user_id = $userId;
            $order->name = Order::CASA_ORDER_PREFIX . $wxCasa->name;
            $order->type = Order::TYPE_CASA;
            // Id is needed for wx order item creation
            $order->save();
            $total = 0;
            foreach ($reservedRooms as $reservedRoom) {
                $orderItem = $this->createOrderItem($order->id, $reservedRoom);
                $total += $orderItem->price * $orderItem->quantity;
            }
            // 3.Save casa order info and update order info
            $casaOrder = new CasaOrder();
            $casaOrder->order_id = $order->id;
            $casaOrder->wx_casa_id = $request->input('wxCasaId');
            $casaOrder->save();
            // 民宿订单展示图片
            $order->photo_path = Config::get('config.photo_folder') . $wxCasa->thumbnail();
            $order->generateOrderId();
            $order->total = $total;
            $order->save();

            // 4.积分处理
            $scoreErrorMsg = $this->processScore(User::find($userId), $order, $request->input('score'), $total);
            if ($scoreErrorMsg) {
                return $scoreErrorMsg;
            }
            DB::commit();
            return response()->json(['orderId' => $order->id]);
        } catch (Exception $ex) {
            DB::rollback();
            Log::critical($ex);
            return "探庐君处理您的订单时晕倒了！请稍后再试！";
        }
    }

    /**
     * @param int $id
     */
    const TYPE_CASA_ROOM = 1;
    public function show($id)
    {
        $order = Order::find($id);
        $qrFile = null;
        // 如果是预订平台的订单，那么预订电话是公司设定好的，到配置文件中去修改
        // 如果是度假卡的消费订单，那么预订电话是民宿主人的电话
        if($order->pay_type == Order::PAY_TYPE_CARD){
            $orderPhone = $order->wxCasa[0]->phone;
            $order->casaOrder->reserve_date = $order->casaOrder->reserve_date == null? null : Carbon::parse($order->casaOrder->reserve_date)->format('Y年m月d日');
        }else{
            $orderPhone = config('casarover.help_telephone');
        }
        if ($order->type == Order::TYPE_CASA) {
            $qrFile = public_path() . "/assets/phpqrcode/temp/order_" . $order->id . ".png";
            $qrPath = env('ROOT_URL') . "/assets/phpqrcode/temp/order_" . $order->id . ".png";
            if (!file_exists($qrFile)) {
                QrImageGenerator::generate(env('ROOT_URL') . '/wx/consume/' . $order->id, $qrFile);
            }
        }
        return view('wx.wxOrderDetail', compact('order', 'qrPath','orderPhone'));
    }

    /**  */
    public function index()
    {
        return view('backstage.wxOrderList');
    }

    /**
     * @param int $page
     * @param int $type
     */
    public function orderlist()
    {
        try {
            $orderlist = Order::orderBy('id', 'desc')->paginate(20);
            foreach($orderlist as $order)
            {
                $order->time = $order->created_at->format('Y-m-d H:i');
                $order->paystatus = $this->getStatusWord(0, $order->status);
                $order->goods = $order->orderItems;
                foreach($order->goods as $good)
                {
                    if(Product::find($good->product)){
                        $good->name = Product::find($good->product->id)->name;
                    }
                }
                $order->username = $order->user->realname;
                $order->userphone = $order->user->cellphone;
                $order->nickname = $order->user->nickname;
                if ($order->type == Order::TYPE_CASA) {
                    $order->reserveStatus = $this->getStatusWord(1, $order->casaOrder->reserve_status);
                    $order->reserveComment = $order->casaOrder->reserve_comment;
                }
            }
            $data = $this->jsondata('200', '获取成功', $orderlist);
            return response()->json($data);
        } catch (Exception $e) {
            Log::error(get_class() . ' - ' . $e);
            dd($e);
        }
    }

    /**
     * 手动确定预订时间
     * @param Request $request
     */
    public function editStatus(Request $request)
    {
        $order = CasaOrder::find($request->orderid);
        $order->reserve_comment = $request->message;
        if (empty($request->message)) {
            $order->reserve_status = CasaOrder::RESERVE_STATUS_NO;
            $order->save();
        } else {
            $order->reserve_status = CasaOrder::RESERVE_STATUS_YES;
            $order->save();
            $this->sendOrderSms($request->orderid);
        }
        return redirect('back/wx/order/list');
    }

    public function del(Request $request)
    {
        $order = Order::find($request->id);
        $order->delete();
    }

    /**
     * 商家确认订单被消费。
     * 添加一条积分变化信息。
     * 修改用户的当前积分和累计积分。
     * @param int $orderId
     */
    public function consume($orderId)
    {
        dd(app('MembershipService'));
            $userId = Session::get('user_id');
            // Merchant
            $user = User::find($userId);
            $order = Order::findOrFail($orderId);
            $isMerchant = false;
            if ($order->status != Order::STATUS_PAYED) {
                return '<p style="font-size:40px;">此订单未付款！</p>';
            }
            $wxBinds = WxBind::where('user_id', $userId)->get();
            $casaOrder = $order->casaOrder;
            foreach ($wxBinds as $bind) {
                if ($bind->wx_casa_id == $casaOrder->wx_casa_id) {
                    $isMerchant = true;
                    break;
                }
            }
            if ($isMerchant) {
                if ($order->reserve_status == CasaOrder::RESERVE_STATUS_CONSUMED) {
                    return '<p style="font-size:40px;">此订单已消费过！</p>';
                } else {
                    // Consumer's membership.
                    $wms = User::find($order->user_id)->wxMembership;
                    if ($wms) {
                        DB::beginTransaction();
                        try {
                            $casaOrder->reserve_status = CasaOrder::RESERVE_STATUS_CONSUMED;
                            $casaOrder->save();
                            $convertPercent = WxMembership::getLevelDetail($wms->level)['convert_percent'];
                            $total = $order->total;
                            $score = round($total * $convertPercent / 100);
                            $this->createWxScoreVariationByOrder($wms->id, $order->id,
                                    self::ORDER_AWARD_PREFIX . $order->name . ' ' . $order->id,
                                    $score);
                            $this->updateMembership($wms, $score);
                            app('MembershipService')->upgradeWxMembershipLevelIfNeeded($wms);
                            DB::commit();
                        } catch (Exception $e) {
                            DB::rollBack();
                            Log::error(get_class() . ' - ' . $e);
                            return "操作失败！";
                        }
                    }
                    return view('wx.success');
                }
            } else {
                return '<p style="font-size:40px;">抱歉！您的微信号并没有注册成为这家民宿的管理者。</p>';
            }
    }

    /**
     * Merchant set the coasa order's reserve status to reserved(1) or unreserved(0),
     * simultaneously delete the score variation record and restore the membership score(accumulated score).
     * @param int $orderId
     */
    public function cancelConsume($orderId)
    {
        DB::beginTransaction();
        try {
            $order = CasaOrder::findOrFail($orderId);
            if ($order->reserve_date or $order->reserve_comment) {
                $order->reserve_status = CasaOrder::RESERVE_STATUS_YES;
            } else {
                $order->reserve_status = CasaOrder::RESERVE_STATUS_NO;
            }
            $order->save();
            $wms = WxMembership::where("user_id", $order->order->user_id)->get()->first();
            if ($wms) {
                $wsv = WxScoreVariation::where('casa_order_id', $order->order_id)->where('score', '>=', 0)->get()->first();
                if ($wsv) {
                    $this->updateMembership($wms, - $wsv->score);
                    $wsv->delete();
                } else {
                    Log::error(get_class() . ' - ' . 'order-' . $order->order_id . ' cancel consume, score variation not found!');
                }
            }
            DB::commit();
            return redirect('/wx/bind');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error(get_class() . ' - ' . $e);
            return "操作失败！";
        }
    }


    /**
     * 发送预约成功的短信
     * @param int $orderId
     */
    private function sendOrderSms($orderId)
    {
        $order = Order::find($orderId);
        $username = $order->user->realname;
        $casaName = $order->name;
        $time = $order->casaOrder->reserve_comment;
        $userphone = $order->user->cellphone;
        $sms = app('sms');
        $sendArr = ['name' => $username,'room' => $casaName,'time' => $time];
        $message = json_encode($sendArr,JSON_UNESCAPED_UNICODE);
        // $message2 = "{\"name\":\"$username\",\"room\":\"$casaName\",\"time\":\"$time\"}";
        $sms->send('探庐者','SMS_9720239',$message,$userphone);
    }

    /**
     * Create a new wx order item.
     * @param int $orderId
     * @param mixed $reservedRoom
     * @return OrderItem $orderItem
     */
    private function createOrderItem($orderId, $reservedRoom)
    {
        $orderItem = new OrderItem();
        $orderItem->order_id = $orderId;
        $orderItem->product_id = $reservedRoom['id'];
        $orderItem->price = Product::find($reservedRoom['id'])->price;
        $orderItem->quantity = $reservedRoom['quantity'];
        $orderItem->save();
        return $orderItem;
    }

    /**
     * Create a record of score variation which type is order.
     * @param int $memberId
     * @param int $orderId
     * @param string $name
     * @param int $score
     */
    private function createWxScoreVariationByOrder($memberId, $orderId, $name, $score)
    {
        $wsv = new WxScoreVariation();
        $wsv->wx_membership_id = $memberId;
        $wsv->casa_order_id = $orderId;
        $wsv->type = WxScoreVariation::TYPE_ORDER;
        $wsv->name = $name;
        $wsv->score = $score;
        $wsv->save();
        return $wsv;
    }

    /**
     * Update wx membership, and check if upgrading needed.
     * @param WxMembership $wms
     * @param int $score
     */
     private function updateMembership($wms, $score)
     {
         $wms->score += $score;
         $wms->accumulated_score += $score;
         $wms->save();
         app('MembershipService')->upgradeWxMembershipLevelIfNeeded($wms);
         return $wms;
     }

     /**
      * Score related process while creating wx casa order.
      * @param User $user
      * @param Order $order
      * @param int $score
      * @param int $total
      * @return string or null - Score Error Msg, null means process is OK.
      */
     private function processScore(User $user, Order $order, $score, $total) {
         // Check score. 前后台均有检查。
         if ($score > 0) {
             $userScore = $user->wxMembership->score;
             // Invalid situation 1 - larger than user's current score,
             if ($score > $userScore) {
                 return "您输入的积分超过当前可用的积分！";
             }
             // invalid situation 2 - larger than 30% of the payment.
             if ($score > $total * Config::get('config.wx_max_discount') / 10) {
                 return "您输入的积分超过了房价的30%！";
             }
             // 保存积分信息
             $this->createWxVariationScore($user, $order, $score);
             $user->wxMembership->score -= $score;
             $user->wxMembership->save();
             $order->total = $total - ($score * 0.1);
             $order->save();
             return null;
         }
     }

     /**
      * Just as the method's name implies.
      * @param User $user
      * @param Order $order
      * @param int $score
      */
     private function createWxVariationScore(User $user, Order $order, $score) {
         $wsv = new WxScoreVariation();
         $wsv->wx_membership_id = $user->wxMembership->id;
         $wsv->casa_order_id = $order->id;
         $wsv->type = WxScoreVariation::TYPE_ORDER;
         $wsv->name = self::ORDER_CONSUME_PREFIX . $order->name . ' ' . $order->id;
         $wsv->score = - $score;
         $wsv->save();
     }
}
