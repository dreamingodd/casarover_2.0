@extends('wxBase')
@section('title','订单详情')
@section('head')
    <link href="/assets/css/wxConfirm.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx/order/1" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:15868102935" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main">
        <div class="commodity">
            <h2>商品信息</h2>
            <p>民宿名称:<span>{{$casaroverOrder->wxCasa->getName()}}</span></p>
            <p>订单号:<span>{{$casaroverOrder->order_id}}</span></p>
            {{--下两行做循环--}}
            @foreach($casaroverOrder->wxOrderItems as $item)
                <p>房间型号:<span>$item->wxRoom->name</span></p>
                <p>房间数量:<span>$item->quntity</span></p>
            @endforeach
            <p id="total">总价：<i>{{$casaroverOrder->total or ''}}</i><i>元</i></p>
        </div>
        {{--<div class="person">--}}
            {{--<h2>用户信息</h2>--}}
        {{--</div>--}}
    </div>
    <a class="checkout" onclick="WXPayment()" href="#">确认支付</a>
<script type="text/javascript">
    var WXPayment = function() {
        if( typeof WeixinJSBridge === 'undefined' ) {
            alert('请在微信中在打开页面！');
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
@stop
