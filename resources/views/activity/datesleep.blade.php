@extends('activity')
@section('title','排行榜')
@section('head')
    <link rel="stylesheet" href="/assets/css/activityDate.css">
@stop
@section('body')
<div class="banner">
    <img src="\assets\images\activity\datebanner.png" alt="">
</div>
    <div class="main">
        <div class="maincon clear">
            <div class="left">
                <img src="\assets\images\activity\user.jpg" alt="">
            </div>
            <div class="right">
                <div class="righttop">
                        <h2><span>小明</span>向<span>无界</span>发起约睡</h2>
                </div>
                <div class="rightbottom">
                        <p>小明仰慕无界已久，今天终于找到机
                            会可以约一觉。各位看官有手的点个赞。</p>
                </div>
            </div>
        </div>
    </div>
    <div class="button">
        <a href="">帮他约睡</a>
        <a href="">我也约</a>
        <a href="">排行</a>
    </div>
@stop