@extends('activity')
@section('title','民宿信息')
@section('head')
    <link rel="stylesheet" href="/assets/css/activityPerson.css">
@stop
@section('body')
    <div class="banner">
        @if(!empty($user))
            <img src="/assets/images/activity/personbanner.png" alt="">
            <div class="user">
                <img src="{{$user->headimgurl}}" alt="">
                <p>{{$user->nickname}}</p>
            </div>
        @else
            <img src="/assets/images/activity/banner.png" alt="">
        @endif
    </div>
    <div class="main">
        @foreach( $casas as $casa)
                    <a class="case clear" href="/wx/date/rank/{{$casa->id}}">
                        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$casa->thumbnail}}" alt="">
                        <div class="article">
                            <h2>{{$casa->name}}</h2>
                            <p>{{$casa->brief}}</p>
                            @if($id!=0)
                                <span>排名：第{{$casa->rank}}名</span>
                            @endif
                        </div>
                    </a>
        @endforeach
    </div>
    {{--@if(empty($casas))--}}
        {{--<em>您还没有参加活动哦,赶紧挑选喜爱的民宿来约吧！</em>--}}
    {{--@endif--}}
        {{--<em>您还没有参加活动哦,赶紧挑选喜爱的民宿来约吧！</em>--}}
@stop