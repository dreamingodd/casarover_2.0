@extends('wxBase')
@section('title','订单详情')
@section('head')
    <link href="/assets/css/wxConfirm.css" rel="stylesheet"/>
@stop
@section('body')
@section('nav')
    <a href="/wx/order/1" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:15868102935" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
    <div class="main">
        <div class="commodity">
            <h2>商品信息</h2>
            <p>民宿名称:<span>卷西山</span></p>
            <p>订单号:<span>1234567</span></p>
            {{--下两行做循环--}}
            <p>房间型号:<span>标准间</span></p>
            <p>房间数量:<span>2</span></p>
            <p id="total">总价：<i>998元</i></p>
        </div>
        {{--<div class="person">--}}
            {{--<h2>用户信息</h2>--}}
        {{--</div>--}}
    </div>
   <a class="checkout" href="bill">确认购买</a>
@stop