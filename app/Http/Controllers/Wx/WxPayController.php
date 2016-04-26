<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;

use App\Http\Requests;

class WxPayController extends Controller
{
    /**
     * Create an order and return to confirm page.
     */
    public function order() {
        dd();
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
