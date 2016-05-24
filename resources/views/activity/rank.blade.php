@extends('activity')
@section('title','排行榜')
@section('head')
    <link rel="stylesheet" href="/assets/css/activityRank.css">
@stop
@section('body')
    <div class="banner">
        <img src="/assets/images/cs.png" alt="">
        <div class="bannertext">
            <h2>无界</h2>
            <p>等你来睡</p>
            <a href="#">查看详情</a>
        </div>
    </div>
    <div class="person clear">
        <img src="/assets/images/activity/user.jpg" alt="">
        <div class="personinfo">
            <p>小王</p>
            <span>当前排名：10</span>
        </div>
        <div class="number">
            970<span>人帮约</span>
        </div>
    </div>
    <div class="main">
        <div class="person clear">
            <div class="rank">1</div>
            <img src="/assets/images/activity/user.jpg" alt="">
            <div class="personinfo">
                <p>小王</p>
                <span>当前排名：10</span>
            </div>
            <div class="number">
                970<span>人帮约</span>
            </div>
        </div>
        <div class="person clear">
            <div class="rank">2</div>
            <img src="/assets/images/activity/user.jpg" alt="">
            <div class="personinfo">
                <p>小王</p>
                <span>当前排名：10</span>
            </div>
            <div class="number">
                970<span>人帮约</span>
            </div>
        </div>
    </div>
@stop