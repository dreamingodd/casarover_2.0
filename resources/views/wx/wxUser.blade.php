@extends('wxBase')
@section('title','个人中心')
@section('head')
    <link href="/assets/css/wxPerson.css" rel="stylesheet"/>
@stop
@section('body')
    <nav><a href="/wechatbook" class="glyphicon glyphicon-chevron-left"></a>
        <a href="tel:12345678901" class="glyphicon glyphicon-earphone"></a>
        <h1>探庐者</h1>
    </nav>
    <div class="main">
        <p class="divider"><a href="#"><em class="glyphicon glyphicon-menu-hamburger"></em>我的订单
                <span class="glyphicon glyphicon-triangle-right"></span></a></p>
        <p><a href="#"><em class="glyphicon glyphicon-piggy-bank"></em>我的优惠券
                <span  class="glyphicon glyphicon-triangle-right"></span></a></p>
    </div>

@stop
