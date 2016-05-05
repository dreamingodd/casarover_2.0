<?php

namespace App\Http\Controllers\Wx;

use Config;
use Session;
use EasyWeChat\Foundation\Application;
use EasyWeChat\Payment\Order;
use App\Http\Controllers\Controller;
use App\Entity\Wx\WxOrder;

class WxPayController extends Controller
{
    /**
     * Create an order and return to confirm page.
     */
    public function prepare($orderId) {
        $casaroverOrder = WxOrder::find($orderId);
        if (env('ENV') == 'DEV' && !empty($casaroverOrder)) {
            return "订单已创建，订单信息：" . $casaroverOrder;
        }
        $options = [
            // 前面的appid什么的也得保留哦
            'app_id' => Config::get("casarover.wx_appid"),
            'secret' => Config::get("casarover.wx_appsecret"),
            // ...

            // payment
            'payment' => [
                'merchant_id'        => Config::get("casarover.wx_shopid"),
                'key'                => Config::get("casarover.wx_shopsecret"),
                'cert_path'          => 'http://www.casarover.com/WxpayAPI/cert/apiclient_cert.pem', // XXX: 绝对路径！！！！
                'key_path'           => 'http://www.casarover.com/WxpayAPI/cert/apiclient_key.pem',      // XXX: 绝对路径！！！！
                // 'notify_url'         => '',       // 你也可以在下单时单独设置来想覆盖它
                // 'device_info'     => '013467007045764',
                // 'sub_app_id'      => '',
                // 'sub_merchant_id' => '',
                // ...
            ],
        ];

        $app = new Application($options);
        $payment = $app->payment;

        $attributes = [
            'body'             => 'casarover',
            'detail'           => 'casarover',
            'out_trade_no'     => $casaroverOrder->order_id,
            'total_fee'        => $casaroverOrder->total,//$casaroverOrder->total,
            'trade_type'       => 'JSAPI',
            'openid'           => Session::get('openid'),
            // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'notify_url'       => 'https://www.casarover.com/wx/pay/notify',
        ];

        // 统一下单
        $order = new Order($attributes);
        $result = $payment->prepare($order);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
        }

        $payConfig = $payment->configForPayment($prepayId);

        return view("wx.wxConfirm", compact('payConfig', 'order', 'casaroverOrder'));
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
