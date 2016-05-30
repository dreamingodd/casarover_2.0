@extends('activity')
@section('title','民宿信息')
@section('head')
    <link rel="stylesheet" href="/assets/css/activityPerson.css">
@stop
@section('body')
    <div class="banner">
        @if(!empty($user))
            <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/personbanner.png" alt="">
            <div class="user">
                <img src="{{$user->headimgurl}}" alt="">
                <p>{{$user->nickname}}</p>
            </div>
        @else
            <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/banner.png" alt="">
        @endif
    </div>
    <div class="main">
        @if(empty($casas))
            <div class="no">您还没有参加活动哦,赶紧挑选喜爱的民宿来约吧！</div>
        @endif
        @foreach( $casas as $casa)
                    <a class="case clear" href="/wx/date/rank/{{$casa->id}}">
                        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$casa->thumbnail}}" alt="">
                        <div class="article">
                            <h2>{{$casa->name}}</h2>
                            <p>{{$casa->brief}}</p>
                            <span>排名：第{{$casa->rank}}名</span>
                        </div>
                    </a>
        @endforeach
    </div>
@stop
