@extends('wxBase')
@section('title','我的收藏')
@section('head')
    <link href="/assets/css/wxCollection.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
        <div class="main">
            <h2>我的收藏</h2>
            <span class="edit">编辑</span>
            {{--<span class="finished">完成</span>--}}
            @foreach( $casas as $casa)
                <div class="case">
                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$casa->wxCasa->thumbnail}}" alt="">
                    <div class="article">
                        <h3>{{$casa->wxCasa->name}}</h3>
                        <p>{{$casa->wxCasa->brief}}</p>
                        <span>￥{{$casa->wxCasa->cheapestPrice}}起</span>
                    </div>
                </div>
            @endforeach
        </div>
@stop
