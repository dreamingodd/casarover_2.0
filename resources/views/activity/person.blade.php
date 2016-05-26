@extends('activity')
@section('title','民宿信息')
@section('head')
    <link rel="stylesheet" href="/assets/css/activityPerson.css">
@stop
@section('body')
    <div class="banner">
        <img src="/assets/images/activity/personbanner.png" alt="">
        <div class="user">
            {{--<img src="{{$user->headimgurl}}" alt="">--}}
            {{--<p>{{$user->nickname}}</p>--}}
        </div>
        {{--总排行榜banner--}}
        {{--<img src="/assets/images/activity/banner.png" alt="">--}}
    </div>
    <div class="main">
        @foreach( $casas as $casa)
                    <a class="case clear" href="rank">
                        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$casa->thumbnail}}" alt="">
                        <div class="article">
                            <h2>{{$casa->name}}</h2>
                            <p>{{$casa->brief}}</p>
                    <span>排名：90名</span>
                </div>
            </a>
        @endforeach
    </div>
@stop