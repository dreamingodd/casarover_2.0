@extends('activity')
@section('title','排行榜')
@section('head')
    <link rel="stylesheet" href="/assets/css/activityRank.css">
@stop
@section('body')
    <div class="banner">
        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$casa->thumbnail}}" alt="">
        <div class="bannertext">
            <h2>{{$casa->name}}</h2>
            <p>{{$casa->brief}}</p>
            <a href="/wx/date/casa/{{$casa->id}}">查看详情</a>
        </div>
    </div>
    @if($myRawWx18)
        <div class="person clear">
            <img src="{{$myRawWx18->headimgurl}}" alt="">
            <div class="personinfo">
                <p>{{$myRawWx18->nickname}}</p>
                <span>当前排名：{{$myRawWx18->rank}}</span>
            </div>
            <div class="number">
                {{$myRawWx18->vote}}<span>人帮约</span>
            </div>
        </div>
    @endif
    <div class="main">
        @foreach($wx18s as $key=>$person)
        <div class="person clear">
            <div class="rank">{{$key+1}}</div>
            <img src="{{$person->wxUser->headimgurl}}" alt="">
            <div class="personinfo">
                <p>{{$person->wxUser->nickname}}</p>
            </div>
            <div class="number">
                {{$person->vote}}<span>人帮约</span>
            </div>
        </div>
        @endforeach
    </div>
@stop
