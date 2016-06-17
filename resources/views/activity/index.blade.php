@extends('activity')
@section('title','浙江奢华民宿约你睡')
@section('head')
    <link rel="stylesheet" href="/assets/css/activity.css">
@stop
@section('body')
    <div class="banner">
        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/banner.jpg" alt="">
    </div>
    <div class="main clear">
        @foreach($data as $key=>$casa)
            <a href="/wx/date/casa/{{ $casa->id }}">
                <div class="case">
                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$casa->thumbnail}}"
                         alt="{{$casa->thumbnail}}" class="casecon">
                    <span>{{ $key+1 }}</span>
                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/mask.png" alt="mask" class="mask">
                    <div class="article">
                        <h3>{{ $casa->name }}</h3>
                        <h4>想睡：{{ count($casa->totalVotes) }}人</h4>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@stop
