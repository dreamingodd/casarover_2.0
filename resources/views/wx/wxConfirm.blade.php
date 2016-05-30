@extends('wxBase')
@section('title','订单详情')
@section('head')
    <link href="/assets/css/wxConfirm.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx/order/{{$casaroverOrder->wxCasa->id}}" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="/wx/user" id="navright" class="glyphicon glyphicon-user"></a>
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
                <p>房间型号:<span>{{$item->wxRoom->name}}</span></p>
                <p>房间数量:<span>{{$item->quantity}}</span></p>
            @endforeach
            <p id="total">总价：<i>元</i><i>{{$casaroverOrder->total or ''}}</i></p>
            <p id="reserveButton" style="text-align: center; display: none;">
                <a href="tel:{{Config::get('config.help_telephone')}}">
                    <button style="">电话预约</button>
                </a>
            </p>
        </div>
        {{--<div class="person">--}}
            {{--<h2>用户信息</h2>--}}
        {{--</div>--}}
    </div>
    <a class="checkout" onclick="WxPayment()" href="#">确认支付</a>
<script type="text/javascript">
    var WxPayment = function() {
        if( typeof WeixinJSBridge === 'undefined' ) {
            alert('请在微信中在打开页面！');
            return false;
        }
        WeixinJSBridge.invoke(
                'getBrandWCPayRequest', <?php echo $payConfig; ?>, function(res) {
                    switch(res.err_msg) {
                        case 'get_brand_wcpay_request:cancel':
                            alert('您已取消支付！订单已创建，可以到右上角个人中心查看！');
                            break;
                        case 'get_brand_wcpay_request:fail':
                            alert('支付失败！（' + res.err_desc + '）');
                            break;
                        case 'get_brand_wcpay_request:ok':
                            alert('支付成功！请点击电话预约！');
                            var reserveButton = document.getElementById('reserveButton');
                            reserveButton.style.display = 'block';
                            break;
                        default:
                            alert(JSON.stringify(res));
                            break;
                    }
                });
    }
</script>
@stop
