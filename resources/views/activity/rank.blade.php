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
    <div class="person clear">
        <img src="{{$user->headimgurl}}" alt="">
        <div class="personinfo">
            <p>{{$user->nickname}}</p>
            <span>当前排名：10</span>
        </div>
        <div class="number">
            {{$user->vote}}<span>人帮约</span>
        </div>
    </div>
    <div class="main">
        @foreach($users as $key=>$person)
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