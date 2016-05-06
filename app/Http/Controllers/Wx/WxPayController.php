<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;

use Log;
use Config;
use Session;
use Exception;
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
        $app = new Application($this->getOptions());
        $payment = $app->payment;

        $attributes = [
            'body'             => 'casarover',
            'detail'           => 'casarover',
            'out_trade_no'     => $casaroverOrder->order_id,
            'total_fee'        => $casaroverOrder->total * 100,//$casaroverOrder->total,
            'trade_type'       => 'JSAPI',
            'openid'           => Session::get('openid'),
            // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'notify_url'       => 'http://www.casarover.com/wx/pay/notify',
        ];
        // 统一下单
        $order = new Order($attributes);
        // var_dump($order);
        $result = $payment->prepare($order);
        // var_dump($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
        }

        Log::info('Order created:' . $casaroverOrder->order_id);
        $payConfig = $payment->configForPayment($prepayId);
        return view("wx.wxConfirm", compact('payConfig', 'order', 'casaroverOrder'));
    }

    /**
     * Callback method after the payment is confirmed by wechat.
     */
    public function notify(Request $request) {
        try {
            $app = new Application($this->getOptions());
            $response = $app->payment->handleNotify(function($notify, $successful) {
                Log::info("Payment process has been notified!");
                if ($successful) {
                    $orderId = $notify->out_trade_no;
                    Log::info("Order:" . $orderId . " has been notified!");
                    $transactionId = $notify->transaction_id;
                    $resultCode = $notify->result_code;
                    $wxOrder = WxOrder::where("order_id", $orderId)->get()->first();
                    if ($resultCode == 'SUCCESS' && !empty($wxOrder)) {
                        $wxOrder->pay_status = 1;
                        Log::info("Order:" . $orderId . " payment is successful!");
                    }
                }
                return true; // Or error msg
            });
            return $response;
        } catch (Exception $e) {
            Log::error($e);
            return "fail";
        }
    }

    /**
     * TODO: Provide refund functionality.
     */
    public function refund() {

    }

    private function getOptions() {
        return [
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
    }
}
