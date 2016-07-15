<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxBind;
use App\Entity\Product;
use App\Entity\Order;
use App\Entity\CasaOrder;
use App\Common\OrderStatus;
use Session;
use Carbon\Carbon;

class OrderController extends Controller
{
    use OrderStatus;

    public function index(Request $request,$type)
    {
        $search = $request->input('query');
        // not
        $userId = Session::get('user_id');
        // for test;
        // $userId = 10;
        if($type<0 ){
            $query = ['pay_type'=>Order::PAY_TYPE_CARD];
        }else{
            $query = ['pay_type'=>Order::PAY_TYPE_CARD,'reserve_status'=>$type];
        }
        $orderlist = WxCasa::find(WxBind::where('user_id',$userId)->first()->wx_casa_id)
                    ->orders()->where($query)->orderBy('id','desc')->paginate(10);
        foreach($orderlist as $order)
        {
            $order->time = $order->created_at->format('Y-m-d H:i');
            $order->paystatus = $this->getStatusWord(0, $order->status);
            $order->goods = $order->orderItems;
            $order->username = $order->user->realname;
            $order->userphone = $order->user->cellphone;
            $order->nickname = $order->user->nickname;
            if ($order->type == Order::TYPE_CASA) {
                $order->reserveStatus = $this->getStatusWord(1, $order->casaOrder->reserve_status);
                $order->reserveDate = $order->casaOrder->reserve_date === null? "":
                                    Carbon::parse($order->casaOrder->reserve_date)->format('Y-m-d');
                $order->reserveComment = $order->casaOrder->reserve_comment;
            }
        }
        $data = $this->jsondata(0, '获取成功', $orderlist);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $order = Order::find($request->id);
        $order->casaOrder->reserve_status = CasaOrder::RESERVE_STATUS_YES;
        $order->casaOrder->reserve_date = $request->reserveDate;
        $order->casaOrder->reserve_comment = $request->reserveComment;
        $result = $order->casaOrder->save();
        if($result){
            // 发送短信
            $this->sendOrderSms($request->id);
            $data = $this->jsondata(0, '更新成功',['error'=>0]);
            return response()->json($data);
        }else{
            $data = $this->jsondata(401, 'no');
            return response()->json($data);
        }
    }

    public function del($id)
    {
        $userId = 10;
        $order = WxCasa::find(WxBind::where('user_id',$userId)->first()->wx_casa_id)
                    ->orders()->where('id',$id)->first();
        $result = $order->delete();
        if($result){
            $data = $this->jsondata(0, '更新成功',['error'=>0]);
            return response()->json($data);
        }else{
            $data = $this->jsondata(401, 'no');
            return response()->json($data);
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
}
