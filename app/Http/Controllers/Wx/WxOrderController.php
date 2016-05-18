<?php

namespace App\Http\Controllers\Wx;

use App\Common\QrImageGenerator;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxBind;
use App\Entity\Wx\WxOrder;
use App\Entity\Wx\WxOrderItem;
use App\Entity\Wx\WxRoom;
use App\Entity\Wx\WxUser;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Exception;
use DB;
use Log;
use Config;
use Session;

class WxOrderController extends Controller
{
    public function show($id) {
        $order = WxOrder::find($id);
        $qrFile = public_path() . "/assets/phpqrcode/temp/order" . $order->id . ".png";
        $qrPath = env('ROOT_URL') . "/assets/phpqrcode/temp/order" . $order->id . ".png";
        if (!file_exists($qrFile)) {
            QrImageGenerator::generate(env('ROOT_URL') . '/wx/consume/' . $order->id, $qrFile);
        }
        return view('wx.wxOrderDetail', compact('order', 'qrPath'));
    }

    public function create(Request $request) {

        DB::beginTransaction();
        try {
            // update user information.
            if (empty(Session::get('wx_user_id'))) {
                return "用户信息（ID）获取失败！";
            }
            $userId = Session::get('wx_user_id');
            $user = WxUser::find($userId);
            $user->realname = $request->input('realname');
            $user->cellphone = $request->input('cellphone');
            $user->save();
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
                $wxOrderItem = new WxOrderItem();
                $wxOrderItem->wx_order_id = $wxOrder->id;
                $wxOrderItem->wx_room_id = $reservedRoom['id'];
                $wxOrderItem->price = WxRoom::find($reservedRoom['id'])->price;
                $wxOrderItem->quantity = $reservedRoom['quantity'];
                $wxOrderItem->save();
                $total += $wxOrderItem->price * $wxOrderItem->quantity;
            }
            // check score.
            // Invalid situation 1 - larger than user's current score,
            // invalid situation 2 - larger than 30% of the payment.
            $score = $request->input('score');
            $userScore = $user->wxMembership->score;
            if ($score > $userScore) {
                return "您输入的积分超过当前可用的积分！";
            }
            if ($score > $total * Config::get('casarover.wx_max_discount') / 10) {
                return "您输入的积分超过了房价的30%！";
            }

            // update order info
            $wxOrder->order_id = Config::get("casarover.wx_shopid") . '-' . $wxOrder->id;
            $wxOrder->total = $total;
            $wxOrder->save();
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
    protected function orderstatus($type,$code)
    {
        $allstatus = $this->allstatus();
        return $allstatus[$type][$code];
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
    // 发送预约成功的短信
    private function sendOrderSms($orderId)
    {
        $sms = app('sms');
        $message = "{\"name\":\"yunlong\",\"thing\":\"这个是活动\",\"time\":\"2016.1.3\"}";
        $phone = '18958142694';
        $sms->send('活动验证','SMS_8550710',$message,$phone);
    }

    public function del(Request $request)
    {
        $order = WxOrder::find($request->id);
        $order->delete();
    }

    public function consume($orderId) {
        $isMerchant = false;
        $order = WxOrder::findOrFail($orderId);
        if ($order->pay_status != WxOrder::PAY_STATUS_YES) {
            return '<p style="font-size:40px;">此订单未付款！</p>';
        }
        $userId = Session::get('wx_user_id');
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
                return view('wx.success');
            }
        } else {
            return '<p style="font-size:40px;">抱歉！您的微信号并没有注册成为这家民宿的管理者。</p>';
        }
    }

    public function cancelConsume($orderId) {
        $order = WxOrder::findOrFail($orderId);
        $order->consume_status = WxOrder::CONSUME_STATUS_NO;
        $order->save();
        return redirect('/wx/bind');
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

    public function jsondata($code=0,$msg='成功',$data)
    {
        return ['code'=>$code,'msg'=>$msg,'data'=>$data];
    }
}
