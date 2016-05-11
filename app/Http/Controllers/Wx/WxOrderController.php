<?php

namespace App\Http\Controllers\Wx;

use App\Entity\Wx\WxUser;
use Illuminate\Http\Request;
use Exception;
use DB;
use Log;
use Config;
use Session;

use App\Http\Controllers\Controller;
use App\Entity\Wx\WxOrder;
use App\Entity\Wx\WxOrderItem;
use App\Entity\Wx\WxRoom;

class WxOrderController extends Controller
{
    public function show($id) {
        $order = WxOrder::find($id);
        return view('wx.wxOrderDetail', compact('order'));
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
            // reserved rooms editing.
            $reservedRooms = $request->input('reservedRooms');
            $wxOrder = new WxOrder();
            if (empty($reservedRooms)) {
                return "没有选购商品！";
            }
            $wxOrder->wx_user_id = $userId;
            $wxOrder->wx_casa_id = $request->input('wxCasaId');
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

            // update order info
            $wxOrder->order_id = Config::get("casarover.wx_shopid") . '-' . $wxOrder->id;
            $wxOrder->total = $total;
            $wxOrder->save();
            DB::commit();
            return response()->json(['orderId' => $wxOrder->id]);
        } catch (Exception $ex) {
            DB::rollback();
            Log::critical($ex);
            return $ex;
        }
    }

    public function index()
    {
        $allstatus = $this->allstatus();
        return view('backstage.wxOrderList',compact('allstatus'));
    }

    public function orderlist($type=0)
    {
        $orderlist = WxOrder::orderBy('id', 'desc')->get();
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
            if (empty($order->wxCasa->name)) {
                $order->casaname = '该民宿已下架';
            } else {
                $order->casaname = $order->wxCasa->name;
            }
        }
        $data = $this->jsondata('200','获取成功',$orderlist);
        return response()->json($data);
    }
    protected function orderstatus($type,$code)
    {
        $allstatus = $this->allstatus();
        return $allstatus[$type][$code];
    }

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
        return redirect('back/wx/order/list');
    }

    public function del(Request $request)
    {
        $order = WxOrder::find($request->id);
        $order->delete();
    }
//    付款状态的修改
    public function payStatus($orderId,$status)
    {
        $order = WxOrder::find($orderId);
        $order->consume_status = $status;
        $order->save();
    }
//    预约状态的修改
    public function reserveStatus($orderId,$status)
    {
        $order = WxOrder::find($orderId);
        $order->consume_status = $status;
        $order->save();
    }
//    消费状态的修改
    public function consumeStatus($orderId,$status)
    {
        $order = WxOrder::find($orderId);
        $order->consume_status = $status;
        $order->save();
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
