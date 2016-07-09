<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxCasa;
use App\Entity\Wx\WxBind;
use App\Entity\Product;
use App\Entity\Order;
use App\Common\OrderStatus;


class OrderController extends Controller
{
    use OrderStatus;

    public function index()
    {
        // not
        // $userId = Session::get('user_id');
        // for test;
        $userId = 10;
        $orderlist = WxCasa::find(WxBind::where('user_id',$userId)->first()->wx_casa_id)
                    ->orders()->where('pay_type',Order::PAY_TYPE_CARD)->paginate(20);
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
    }
}
