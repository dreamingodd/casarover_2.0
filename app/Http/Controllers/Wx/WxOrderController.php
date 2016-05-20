<?php

namespace App\Http\Controllers\Wx;

use App\Common\QrImageGenerator;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxBind;
use App\Entity\Wx\WxOrder;
use App\Entity\Wx\WxOrderItem;
use App\Entity\Wx\WxRoom;
use App\Entity\Wx\WxUser;
use App\Entity\Wx\WxMembership;
use App\Entity\Wx\WxScoreVariation;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Exception;
use DB;
use Log;
use Config;
use Session;

class WxOrderController extends Controller
{

    const ORDER_CONSUME_PREFIX = "积分抵扣 - ";
    const ORDER_AWARD_PREFIX = "完成订单奖励 - ";
    const ORDER_SUFFIX = " 的订单";

    public function show($id)
    {
        $order = WxOrder::find($id);
        $qrFile = public_path() . "/assets/phpqrcode/temp/order" . $order->id . ".png";
        $qrPath = env('ROOT_URL') . "/assets/phpqrcode/temp/order" . $order->id . ".png";
        if (!file_exists($qrFile)) {
            QrImageGenerator::generate(env('ROOT_URL') . '/wx/consume/' . $order->id, $qrFile);
        }
        return view('wx.wxOrderDetail', compact('order', 'qrPath'));
    }

    /**
     * 1.Update user info.
     * 2.Create a new order.
     * 3.Create a ScoreVariation.
     * 4.Update wx membership(score).
     */
    public function create(Request $request)
    {
        DB::beginTransaction();
        try {
            // update user information.
            if (empty(Session::get('wx_user_id'))) {
                return "用户信息（ID）获取失败！";
            }
            $userId = Session::get('wx_user_id');
            $user = $this->updateUserInfo($userId, $request->input('realname'), $request->input('cellphone'));
            // process reserved rooms data.
            $reservedRooms = $request->input('reservedRooms');
            $wxOrder = new WxOrder();
            if (empty($reservedRooms)) {
                return "没有选购商品！";
            }
            $wxOrder->wx_user_id = $userId;
            $wxOrder->wx_casa_id = $request->input('wxCasaId');
            $wxOrder->casa_name = WxCasa::find($wxOrder->wx_casa_id)->name;
            $wxOrder->save();
            $total = 0;
            foreach ($reservedRooms as $reservedRoom) {
                $wxOrderItem = $this->createWxOrderItem($wxOrder->id, $reservedRoom);
                $total += $wxOrderItem->price * $wxOrderItem->quantity;
            }
            // update order info
            $wxOrder->order_id = Config::get("casarover.wx_shopid") . '-' . $wxOrder->id;
            $wxOrder->save();

            // Check score. 前后台均有检查。
            $score = $request->input('score');
            if ($score > 0) {
                $userScore = $user->wxMembership->score;
                // Invalid situation 1 - larger than user's current score,
                if ($score > $userScore) {
                    return "您输入的积分超过当前可用的积分！";
                }
                // invalid situation 2 - larger than 30% of the payment.
                if ($score > $total * Config::get('casarover.wx_max_discount') / 10) {
                    return "您输入的积分超过了房价的30%！";
                }
                $wsv = new WxScoreVariation();
                $wsv->wx_membership_id = $user->wxMembership->id;
                $wsv->wx_order_id = $wxOrder->id;
                $wsv->type = WxScoreVariation::TYPE_ORDER;
                $wsv->name = self::ORDER_AWARD_PREFIX . $wxOrder->casa_name . self::ORDER_SUFFIX;
                $wsv->score = - $score;
                $wsv->save();
                $user->wxMembership->score -= $score;
                $user->wxMembership->save();
                $wxOrder->total = $total - ($score * 0.1);
                $wxOrder->save();
            }
            DB::commit();
            return response()->json(['orderId' => $wxOrder->id]);
        } catch (Exception $ex) {
            DB::rollback();
            Log::critical($ex);
            return "探庐君处理您的订单时晕倒了！";
        }
    }

    public function index()
    {
        $allstatus = $this->allstatus();
        return view('backstage.wxOrderList',compact('allstatus'));
    }

    public function orderlist($page=1,$type=0)
    {
        $orderlist = WxOrder::orderBy('id', 'desc')->paginate(20);
        foreach($orderlist as $order)
        {
            $order->time = $order->created_at->format('Y-m-d H:i');
            $order->paystatus = $this->orderstatus(0,$order->pay_status);
            $order->reserveStatus = $this->orderstatus(1,$order->reserve_status);
            $order->consumeStatus = $this->orderstatus(2,$order->consume_status);
            $order->goods = $order->wxOrderItems;
            foreach($order->goods as $good)
            {
                $good->name = WxRoom::find($good->wx_room_id)->name;
            }
            $order->username = $order->wxUser->realname;
            $order->userphone = $order->wxUser->cellphone;
            $order->nickname = $order->wxUser->nickname;
        }
        $data = $this->jsondata('200','获取成功',$orderlist);
        return response()->json($data);
    }

    // 手动确定预订时间
    public function editStatus(Request $request)
    {
        $order = WxOrder::find($request->orderid);
        $order->reserve_time = $request->message;
        if (empty($request->message)) {
            $order->reserve_status = 0;
        } else {
            $order->reserve_status = 1;
        }
        $order->save();
        $this->sendOrderSms(123);
        return redirect('back/wx/order/list');
    }

    public function del(Request $request)
    {
        $order = WxOrder::find($request->id);
        $order->delete();
    }

    /**
     * 商家确认订单被消费。
     * 添加一条积分变化信息。
     * 修改用户的当前积分和累计积分。
     */
    public function consume($orderId)
    {
            $userId = Session::get('wx_user_id');
            $user = WxUser::find($userId);
            $wms = $user->wxMembership;
            $order = WxOrder::findOrFail($orderId);
            $isMerchant = false;
            if ($order->pay_status != WxOrder::PAY_STATUS_YES) {
                return '<p style="font-size:40px;">此订单未付款！</p>';
            }
            $wxBinds = WxBind::where('wx_user_id', $userId)->get();
            foreach ($wxBinds as $bind) {
                if ($bind->wx_casa_id == $order->wx_casa_id) {
                    $isMerchant = true;
                    break;
                }
            }
            if ($isMerchant) {
                if ($order->consume_status == WxOrder::CONSUME_STATUS_YES) {
                    return '<p style="font-size:40px;">此订单已消费过！</p>';
                } else {
                    $order->consume_status = WxOrder::CONSUME_STATUS_YES;
                    $order->save();
                    if ($wms) {
                        DB::beginTransaction();
                        try {
                            $convertPercent = WxMembership::getLevelDetail($wms->level)['convert_percent'];
                            $total = $order->total;
                            $score = round($total * $converPercent);
                            $this->createWxScoreVariationByOrder($wms->id, $order->id,
                            self::ORDER_AWARD_PREFIX . $order->casa_name . self::ORDER_SUFFIX, $score);
                            $this->updateMembership($wms, $score);
                            app('MembershipService')->upgradeWxMembershipLevelIfNeeded($wms);
                            DB::commit();
                        } catch (Exception $e) {
                            DB::rollBack();
                            Log::error($e);
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
     * Merchant set the order consume_status to no(0),
     * simultaneously delete the score variation record and restore the membership score(accumulated score).
     */
    public function cancelConsume($orderId)
    {
        DB::beginTransaction();
        try {
            $order = WxOrder::findOrFail($orderId);
            $order->consume_status = WxOrder::CONSUME_STATUS_NO;
            $order->save();
            $wms = WxMembership::where("wx_user_id", Session::get('wx_user_id'))->get()->first();
            if ($wms) {
                $wsv = WxScoreVariation::where('order_id', $order->id)->where('score', '>', 0)->get()->first();
                $this->updateMembership($wms, - $wsv->score);
                $wsv->delete();
            }
            DB::commit();
            return redirect('/wx/bind');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return "操作失败！";
        }
    }

    protected function orderstatus($type,$code)
    {
        $allstatus = $this->allstatus();
        return $allstatus[$type][$code];
    }

    private function allstatus()
    {
        $allstatus = [
            [
                '未付款',
                '已付款',
                '申请退款',
                '已退款'
            ],
            [
                '未预约',
                '已预约',
                '预约失败'
            ],
            [
                '未消费',
                '已消费',
                '过期'
            ]
        ];
        return $allstatus;
    }

    // 发送预约成功的短信
    private function sendOrderSms($orderId)
    {
        $sms = app('sms');
        $message = "{\"name\":\"yunlong\",\"thing\":\"这个是活动\",\"time\":\"2016.1.3\"}";
        $phone = '18958142694';
        $sms->send('活动验证','SMS_8550710',$message,$phone);
    }

    // Create a new wx order item.
    private function createWxOrderItem($wxOrderId, $reservedRoom)
    {
        $wxOrderItem = new WxOrderItem();
        $wxOrderItem->wx_order_id = $wxOrderId;
        $wxOrderItem->wx_room_id = $reservedRoom['id'];
        $wxOrderItem->price = WxRoom::find($reservedRoom['id'])->price;
        $wxOrderItem->quantity = $reservedRoom['quantity'];
        $wxOrderItem->save();
        return $wxOrderItem;
    }

    // Update user table.
    private function updateUserInfo($userId, $realname, $cellphone)
    {
        $user = WxUser::find($userId);
        $user->realname = $realname;
        $user->cellphone = $cellphone;
        $user->save();
        return $user;
    }

    /**
     * Create a record of score variation which type is order.
     * @param $name include the casa name.
     */
    private function createWxScoreVariationByOrder($memberId, $orderId, $name, $score)
    {
        $wsv = new WxScoreVariation();
        $wsv->wx_membership_id = $memberId;
        $wsv->wx_order_ie = $orderId;
        $wsv->type = WxScoreVariation::TYPE_ORDER;
        $wsv->name = $name;
        $wsv->score = $score;
        $wsv->save();
        return $wsv;
    }

    /**
     * Update wx membership, and check if upgrading needed.
     */
     private function updateMembership($wms, $score)
     {
         $wms->score += $score;
         $wms->accumulated_score += $score;
         $wms->save();
         app('MembershipService')->upgradeWxMembershipLevelIfNeeded($wms);
         return $wms;
     }
}
