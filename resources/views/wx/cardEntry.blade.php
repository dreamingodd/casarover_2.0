@extends('wxBase')
@section('title','进入度假卡')
@section('head')
    <link href="/assets/css/cardEntry.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx/user" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main">
        <img src="/assets/images/card.png" alt="">
        <h2>度假卡</h2>
        <p>HOLIDAY CARD</p>
        <input type="number" value="" placeholder="卡号">
        <div class="confirm" onclick="document.location='card'">确定</div>
    </div>

@stop