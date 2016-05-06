@extends('wxBase')
@section('title','个人中心')
@section('head')
    <link href="/assets/css/wxPerson.css" rel="stylesheet"/>
@stop
@section('body')
@section('nav')
    <a href="/wx" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:15868102935" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
    <div class="main">
        <p>{{$wxUser->realname}}</p>
        <p>{{$wxUser->cellphone}}</p>
        <a href="#" id="order"><p class="divider"><em class="glyphicon glyphicon-menu-hamburger"></em>我的订单
                <span class="glyphicon glyphicon-triangle-right"></span><span class="glyphicon glyphicon-triangle-bottom"></span></p></a>
        <!--<div class="tabtable">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#already" data-target="#already" data-toggle="tab" aria-expanded="false">
                        待支付</a></li>
                <li><a href="#not" data-target="#not" data-toggle="tab" aria-expanded="false">已支付</a></li>
                <li><a href="#complete" data-target="#complete" data-toggle="tab" aria-expanded="false">已完成</a></li>
                <li><a href="#refund" data-target="#refund" data-toggle="tab" aria-expanded="false">已退款</a></li>
            </ul>
        -->
        <div class="tab-content">
            <div class="tab-pane active" id="already">
                @foreach($orders as $order)
                    <div class="case clear">
                        <a href="/wx/order/detail/{{$order->id}}">
                            <div class="images">
                                <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512101852512659.png"
                                        alt="">
                            <p>{{$order->wxCasa->getName()}}</p>
                          </div>
                        </a>
                        <div class="info">
                            <p>房间型号</p>
                            <p id="gray">{{$order->update_at}}</p>
                        </div>
                        <div class="bill">
                            <p>价格</p>
                            <p id="orange">{{$order->total}}元</p>
                        </div>
                        <div>
                            <p>订单号</p>
                            <p id="orange">{{$order->order_id}}</p>
                        </div>
                        <div>
                            <p>状态</p>
                            @if ($order->pay_status == 0)
                                <p>未付款</p>
                            @elseif ($order->pay_status == 1)
                                <p>已付款</p>
                            @elseif ($order->pay_status == 2)
                                <p>正在退款</p>
                            @elseif ($order->pay_status == 3)
                                <p>已退款</p>
                            @else
                                <p>未确认</p>
                            @endif

                            @if ($order->reserve_status == 0)
                                <p>未预约</p>
                            @elseif ($order->reserve_status == 1)
                                <p>已预约</p>
                            @elseif ($order->reserve_status == 1)
                                <p>预约失败</p>
                            @endif

                            @if ($order->consume_status == 0)
                                <p>未消费</p>
                            @elseif ($order->consume_status == 1)
                                <p>已完成</p>
                            @elseif ($order->consume_status == 2)
                                <p>已过期</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{--<p><a href="#"><em class="glyphicon glyphicon-piggy-bank"></em>我的优惠券--}}
        {{--<span  class="glyphicon glyphicon-triangle-right"></span></a></p>--}}
    </div>
    <script>
        $(function ($) {
           $('#order').click(function () {
               $('.glyphicon-triangle-right').toggle();
               $('.glyphicon-triangle-bottom').toggle();
               $('.tabtable').toggle();
               $(this).children('p').toggleClass('divider');
           });
        });
    </script>
@stop
