@extends('wxBase')
@section('title','民宿预订')
@section('head')
    <link href="/assets/css/cardBook.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx/user" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main">
        <h2>民宿预订</h2>
        <div class="case clear" >
            <div class="casecon clear">
                <input type="hidden" id="left" value="{{ $casa->Opportunity->left_quantity }}">
                <img src="{{ $casa->photo_path }}" alt="">
                <div class="article">
                    <h3>{{ $casa->name }}</h3>
                    {{--<img src="/assets/images/sign.png" alt="" >--}}
                    <div class="articlecon">
                        {{--<p>湖州-德州-莫干山镇</p>--}}
                        {{--<p>截至日期:2017年6月1日</p>--}}
                        <span>预订间数：<i id="reduce">-</i> <i id="number">1</i> <i id="add">+</i></span>
                        <p>剩余间数：{{ $casa->Opportunity->left_quantity }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($isMe)
        <a class="sub" href="tel:{{Config::get('config.help_telephone')}}">提&nbsp;&nbsp;交</a>
    @else
        <a class="sub" href="tel:{{Config::get('config.help_telephone')}}">申&nbsp;&nbsp;请</a>
    @endif
    <script>
        $(function () {
            $("#reduce").click(function(){
                var i=$('#number').html();
                if(i<=1)
                    return 0;
                $('#number').html(--i);
            });
            $("#add").click(function() {
                var i=$('#number').html();
                var left = $('#left').val();
                if(i == left){
                    return null;
                }
                $('#number').html(++i);
            });
        })
    </script>
@stop
