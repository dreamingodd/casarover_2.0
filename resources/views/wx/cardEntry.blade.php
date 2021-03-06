@extends('wxBase')
@section('title','进入度假卡')
@section('head')
    <link href="/assets/css/cardEntry.css" rel="stylesheet"/>
    <script src="/assets/js/wxBase.js" type="text/javascript"></script>
@stop
@section('body')
    <div class="main">
        <img src="/assets/images/card.png" alt="">
        <h2>度假卡</h2>
        <p>HOLIDAY CARD</p>
        <input type="number"  class="form-control" placeholder="卡号">
        <div class="confirm" onclick="getlist()">确定</div>
    </div>
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
                    console.log(data);
                    alert(data.msg);
                }
            })
        }
        // 貌似没用
        // if (/Android/gi.test(navigator.userAgent)) {
        //     window.addEventListener('resize', function () {
        //         if (document.activeElement.tagName == 'INPUT' || document.activeElement.tagName == 'TEXTAREA') {
        //             window.setTimeout(function () {
        //                 $('.confirm').scrollIntoViewIfNeeded();
        //             }, 0);
        //         }
        //     })
        // }
    </script>
@stop
