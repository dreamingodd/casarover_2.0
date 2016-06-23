@extends('wxBase')
@section('title','账单详情')
@section('head')
    <link href="/assets/css/wxBill.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="#" id="navleft" class="goback glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main">
        <div class="total">
            <h2>交易金额：</h2>
            <p>998.00元</p>
        </div>
        <div class="commodity">
            <h2>商品信息</h2>
            <p>民宿名称:<span>卷西山</span></p>
            <p>订单号:<span>1234567</span></p>
            {{--下两行做循环--}}
            <p>房间型号:<span>标准间</span></p>
            <p>房间数量:<span>2</span></p>
        </div>
        <div class="succes">
                <h1><span class="glyphicon glyphicon-ok"></span>交易成功</h1>
        </div>
    </div>
    <div class="return clear">
        <a href="/wx" >返回首页</a>
        <a href="/wx" id="info">查看订单</a>
    </div>
@stop
