<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;
use Exception;
use DB;
use Log;
use Config;
use Session;

use App\Http\Controllers\Controller;
use App\Entity\Wx\WxOrder;
use App\Entity\Wx\WxUser;
use App\Entity\Wx\WxOrderItem;
use App\Entity\Wx\WxRoom;
use Carbon\Carbon;

class WxOrderController extends Controller
{
    public function create(Request $request) {

        DB::beginTransaction();
        try {
            $reservedRooms = $request->input('reservedRooms');
            $wxOrder = new WxOrder();
            $wxOrder->wx_user_id = WxUser::find(Session::get('wx_user_id'))->id;
            $wxOrder->save();
            if (empty($reservedRooms)) {
                return "没有选购商品！";
            }
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

            // update order info
            $wxOrder->order_id = Config::get("casarover.wx_shopid") . '-' . $wxOrder->id;
            $wxOrder->total = $total;
            $wxOrder->save();
            DB::commit();
            return response()->json(['orderId' => $wxOrder->id]);
        } catch (Exception $ex) {
            DB::rollback();
            Log::critical($ex);
        }
    }

    public function index()
    {
        $allstatus = $this->allstatus();
        return view('backstage.wxOrderList',compact('allstatus'));
    }

    public function orderlist($type=0)
    {
        $orderlist = WxOrder::all();
        foreach($orderlist as $order)
        {
            $order->time = $order->created_at->format('Y-m-d H:i');
            $order->paystatus= $this->paystatus($order->pay_status);
            $order->goods = $order->orderItems();
            $order->username = $order->wxUser->realname;
            $order->userphone = $order->wxUser->cellphone;
        }
        $data = $this->jsondata('200','获取成功',$orderlist);
        return response()->json($data);
    }
    protected function paystatus($code)
    {
        $allstatus = $this->allstatus();
        return $allstatus[$code];
    }

    private function allstatus()
    {
        $allstatus = [
            '0' => '订单状态',
            '1' => '未付款',
            '2' => '已付款',
            '3' => '申请退款',
            '4' => '已退款',
            '5' => '预订成功',
            '6' => '已消费',
            '7' => '过期'
        ];
        return $allstatus;
//        sex 0 未知
//    1男
//    2女
    }

    public function jsondata($code=0,$msg='成功',$data)
    {
        return ['code'=>$code,'msg'=>$msg,'data'=>$data];
    }
}
