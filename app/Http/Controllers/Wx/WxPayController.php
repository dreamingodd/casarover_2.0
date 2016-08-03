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
use App\Entity\User;
use App\Entity\Coupon;

/**  */
class WxPayController extends Controller
{
    /**
     * Create an order and return to confirm page.
     * @param int $orderId
     */
    public function prepare($orderId) {
        $casaroverOrder = \App\Entity\Order::find($orderId);
        if (env('ENV') == 'DEV' && !empty($casaroverOrder)) {
            return "订单已创建，订单信息：" . $casaroverOrder . "<br/><br/><a href='/wx/user'>用户页面<a>";
        }
        $app = new Application($this->getOptions());
        $payment = $app->payment;

        $attributes = [
            'body'             => 'casarover',
            'detail'           => 'casarover',
            'out_trade_no'     => $casaroverOrder->order_id,
            'total_fee'        => $casaroverOrder->total * 100,//$casaroverOrder->total,
            'trade_type'       => 'JSAPI',
            'openid'           => User::find(Session::get('user_id'))->openid,
            // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'notify_url'       => 'http://www.casarover.com/wx/pay/notify',
        ];
        // 统一下单
        $order = new Order($attributes);
        // var_dump($order);
        // echo '<br/><br/><br/>';
        $result = $payment->prepare($order);
        // var_dump($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
        }

        Log::info(get_class() . ' - ' . 'Order created:' . $casaroverOrder->order_id);
        $payConfig = $payment->configForPayment($prepayId);
        return view("wx.wxConfirm", compact('payConfig', 'order', 'casaroverOrder'));
    }

    /**
     * Callback method after the payment is confirmed by wechat.
     * @param Request $request
     */
    public function notify(Request $request) {
        try {
            $app = new Application($this->getOptions());
            $response = $app->payment->handleNotify(function($notify, $successful) {
                Log::info(get_class() . ' - ' . "Payment process has been notified!");
                if ($successful) {
                    $orderId = $notify->out_trade_no;
                    Log::info(get_class() . ' - ' . "Order:" . $orderId . " has been notified!");
                    $transactionId = $notify->transaction_id;
                    $resultCode = $notify->result_code;
                    $order = \App\Entity\Order::where("order_id", $orderId)->get()->first();
                    if ($resultCode == 'SUCCESS' && !empty($order)) {
                        $order->status = 1;
                        $order->pay_id = $transactionId;
                        $order->save();
                        app('CouponService')->consumeCouponIfUsed($order->id);
                        // 这个需要测试是否能成功
                        app('ProductService')->minus($order->id);
                        Log::info(get_class() . ' - ' . "Order:" . $orderId . " payment is successful!");
                    }
                }
                return true; // Or error msg
            });
            return $response;
        } catch (Exception $e) {
            Log::error(get_class() . ' - ' . $e);
            return "fail";
        }
    }

    /**
     * TODO: Provide refund functionality.
     */
    public function refund() {

    }

    /**  */
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
