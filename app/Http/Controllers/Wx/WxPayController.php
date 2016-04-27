<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxOrder;
use App\Entity\Wx\WxOrderItem;

class WxPayController extends Controller
{
    /**
     * Create an order and return to confirm page.
     */
    public function wxOrder($orderId) {
        $order = WxOrder::find($orderId);
        return view("wx.wxTemp", compact('order'));
    }

    /**
     * Callback method after the payment is confirmed by wechat.
     */
    public function notify() {

    }

    /**
     * TODO: Provide refund functionality.
     */
    public function refund() {

    }
}
