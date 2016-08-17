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
use Log;

class OrderController extends Controller
{
    use OrderStatus;

    public function index(Request $request,$type)
    {
        $search = $request->input('query');
        $date = $request->input('date');

        $userId = Session::get('user_id');
        if($type<0 ){
            $query = ['pay_type'=>Order::PAY_TYPE_CARD];
        }else{
            $query = ['pay_type'=>Order::PAY_TYPE_CARD,'reserve_status'=>$type];
        }
        $orderlist = WxCasa::find(WxBind::where('user_id',$userId)->first()->wx_casa_id)
                    ->orders()->join('user','user.id','=','order.user_id')->where($query)->where(function($q) use($search){
                        if($search != 'null'){
                            $q->where('order.order_id','like','%'.$search.'%')
                                ->orWhere('user.realname','like','%'.$search.'%')
                                ->orWhere('user.cellphone','like','%'.$search.'%');
                        }
                    })->where(function($q) use ($date){
                        if($date != ''){
                            $datearr = explode('~', $date);
                            $queryDate = [$datearr[0].'00:00:00',$datearr[1].' 00:00:00' ];
                            $q->whereBetween('reserve_date', $queryDate);
                        }
                    })->orderBy('id','desc')->paginate(10);
        foreach($orderlist as $order)
        {
            $order->time = $order->created_at->format('Y-m-d H:i');
            $order->paystatus = $this->getStatusWord(0, $order->status);
            $order->goods = $order->orderItems;
            $order->username = $order->user->realname;
            $order->userphone = $order->user->cellphone;
            $order->nickname = $order->user->nickname;
            if ($order->type == Order::TYPE_CASA) {
                $order->reserveCode = $order->casaOrder->reserve_status;
                $order->reserveStatus = $this->getStatusWord(1, $order->casaOrder->reserve_status);
                $order->reserveDate = $order->casaOrder->reserve_date === null? "":
                                    Carbon::parse($order->casaOrder->reserve_date)->format('Y-m-d');
                $order->reserveComment = $order->casaOrder->reserve_comment;
            }
            $order->useVacationCard->card_no = $order->useVacationCard->vacationCard->card_no;
            $order->useVacationCard->username = $order->useVacationCard->vacationCard->order->user->realname;
            $order->useVacationCard->cellphone = $order->useVacationCard->vacationCard->order->user->cellphone;
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
            $sms = $this->sendOrderSms($request->id);
            if($sms){
                $data = $this->jsondata(0, '更新成功',['error'=>0]);
                return response()->json($data);
            }else{
                Log::info($sms);
            }
        }else{
            $data = $this->jsondata(401, 'no');
            return response()->json($data);
        }
    }

    public function del($id)
    {
        $userId = Session::get('user_id');
        $order = WxCasa::find(WxBind::where('user_id',$userId)->first()->wx_casa_id)
                    ->orders()->where('id',$id)->first();
        // 返回机会
        // 已经使用的订单下的列表
        $usedItems = $order->orderItems;
        foreach ($usedItems as $item) {
            // 找到度假卡下属订单的item
            $cardItem = $order->useVacationCard->vacationCard->order->orderItems()->where('product_id',$item->product_id)->first();
            $cardItem->opportunity->left_quantity += $item->quantity;
            $cardItem->opportunity->save();
        }
        $result = $order->delete();
        if($result){
            $data = $this->jsondata(0, '更新成功',['error'=>0]);
            return response()->json($data);
        }else{
            $data = $this->jsondata(401, 'no');
            return response()->json($data);
        }
    }

    public function turnused($id)
    {
        $userId = Session::get('user_id');
        $order = WxCasa::find(WxBind::where('user_id',$userId)->first()->wx_casa_id)
                    ->orders()->where('id',$id)->first();
        $status = $order->casaOrder->reserve_status;
        $order->casaOrder->reserve_status = $status == 3?1:3;
        $result = $order->casaOrder->save();
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
        $casaName = '';
        foreach ($order->orderItems as $value) {
            $casaName += $value->name;
        }
        $time = Carbon::parse($order->casaOrder->reserve_date)->format('Y-m-d');
        $userphone = $order->user->cellphone;
        $sms = app('sms');
        $sendArr = ['name' => $username,'room' => $casaName,'time' => $time];
        $message = json_encode($sendArr,JSON_UNESCAPED_UNICODE);
        // $message2 = "{\"name\":\"$username\",\"room\":\"$casaName\",\"time\":\"$time\"}";
        $sms->send('探庐者','SMS_9720239',$message,$userphone);
        Log::info($sms);
    }
}
