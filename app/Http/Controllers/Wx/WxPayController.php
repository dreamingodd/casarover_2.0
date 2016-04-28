<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;

use Log;
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
        ini_set('date.timezone','Asia/Shanghai');
        //error_reporting(E_ERROR);
        require_once app_path()."/lib/WxpayAPI/lib/WxPay.Api.php";
        require_once app_path()."/lib/WxpayAPI/example/WxPay.JsApiPay.php";
        require_once app_path().'/lib/WxpayAPI/example/log.php';

        //初始化日志
        $logHandler= new CLogFileHandler(app_path()."/lib/WxpayAPI/logs/".date('Y-m-d').'.log');
        $log = Log::Init($logHandler, 15);

        //①、获取用户openid
        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();

        //②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee($order->total);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://www.casarover.com/WxpayAPI/example/notify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = WxPayApi::unifiedOrder($input);
        $jsApiParameters = $tools->GetJsApiParameters($order);
        Log::info("WxOrder:" . $jsApiParameters);
        return view("wx.wxTemp", compact('order', 'jsApiParameters'));
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
