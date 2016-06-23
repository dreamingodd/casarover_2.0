@extends('wxBase')
@section('title','进入度假卡')
@section('head')
    <link href="/assets/css/cardEntry.css" rel="stylesheet"/>
    <script src="/assets/js/wxBase.js" type="text/javascript"></script>
@stop
@section('nav')
    <a  id="navleft" class="goback glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main">
        <img src="/assets/images/card.png" alt="">
        <h2>度假卡</h2>
        <p>HOLIDAY CARD</p>
        <input type="number"  class="form-control" placeholder="卡号">
        <div class="confirm" onclick="getlist()">确定</div>
    </div>

@stop
<script>
    function getlist(){
        var number = $(".main input").val();
        if(!number){
            alert("卡号不能为空");
        }
        $.getJSON('/wx/api/user/cardCasa/'+number,function(data){
            if(data.code == 0){
                window.location.href = '/wx/user/cardCasa/'+number;
            }else{
                alert("该卡不存在，请检查卡号");
            }
        })
    }
</script>