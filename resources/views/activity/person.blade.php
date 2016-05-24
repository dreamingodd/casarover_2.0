@extends('activity')
@section('title','民宿信息')
@section('head')
    <link rel="stylesheet" href="/assets/css/activityPerson.css">
@stop
@section('body')
    <div class="banner">
        <img src="/assets/images/activity/personbanner.png" alt="">
        <div class="user">
            <img src="/assets/images/activity/user.jpg" alt="">
            <p>阿土伯</p>
        </div>
        {{--总排行榜banner--}}
        {{--<img src="/assets/images/activity/banner.png" alt="">--}}
    </div>
    <div class="main">
        <a class="case clear" href="rank">
            <img src="/assets/images/cs.png" alt="">
            <div class="article">
                <h2>竹林之愿-无界</h2>
                <p>临安四眼井满觉陇路298号</p>
                <span>排名：90名</span>
            </div>
        </a>
        <a class="case clear" href="rank">
            <img src="/assets/images/cs.png" alt="">
            <div class="article">
                <h2>竹林之愿-无界</h2>
                <p>临安四眼井满觉陇路298号</p>
                <span>排名：90名</span>
            </div>
        </a>
        <a class="case clear" href="rank">
            <img src="/assets/images/cs.png" alt="">
            <div class="article">
                <h2>竹林之愿-无界</h2>
                <p>临安四眼井满觉陇路298号</p>
                <span>排名：90名</span>
            </div>
        </a>
    </div>
@stop