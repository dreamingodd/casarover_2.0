@extends('wxBase')
@section('title','订单详情')
@section('head')
    <link href="/assets/css/wxConfirm.css" rel="stylesheet"/>
@stop
@section('body')
    <script type="text/javascript">
    var WXPayment = function() {
        if( typeof WeixinJSBridge === 'undefined' ) {
            alert('请在微信在打开页面！');
            return false;
        }
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest', <?php echo $payConfig; ?>, function(res) {
            switch(res.err_msg) {
                case 'get_brand_wcpay_request:cancel':
                    alert('用户取消支付！');
                    break;
                case 'get_brand_wcpay_request:fail':
                    alert('支付失败！（'+res.err_desc+'）');
                    break;
                case 'get_brand_wcpay_request:ok':
                    alert('支付成功！');
                    break;
                default:
                    alert(JSON.stringify(res));
                    break;
            }
        });
    }
    </script>
    <nav><a href="/wx" class="glyphicon glyphicon-chevron-left"></a>
        <a href="tel:12345678901" class="glyphicon glyphicon-earphone"></a>
        <h1>探庐者</h1>
    </nav>
    <div class="main">
        <div class="commodity">
            <h2>商品信息</h2>
            <p>民宿名称:<span>卷西山</span></p>
            <p>订单号:<span>1234567</span></p>
            {{--下两行做循环--}}
            <p>房间型号:<span>标准间</span></p>
            <p>房间数量:<span>2</span></p>
            <p id="total">总价：<i><?php echo ($order->total_fee / 100); ?>元</i></p>
        </div>
        {{--<div class="person">--}}
            {{--<h2>用户信息</h2>--}}
        {{--</div>--}}
    </div>
    <a class="checkout" onclick="WXPayment()" href="#">确认支付</a>
@stop
