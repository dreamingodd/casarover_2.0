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
        <input type="number"  class="form-control" placeholder="卡号">
        {{--校验卡号正确与否--}}
        <div class="confirm" onclick="getlist()">确定</div>
    </div>

@stop
<script>
    function getlist(){
        var number = $(".main input").val();
        console.log(number);
        $.getJSON('/wx/api/user/cardCasa/'+number,function(data){
            console.log(data);
            if(data.code == 0){
                window.location.href = '/wx/user/cardCasa/'+number;
            }else{
                alert("请检查卡号");
            }
        })
    }
</script>