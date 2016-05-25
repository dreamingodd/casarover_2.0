@extends('activity')
@section('title','约睡详情')
@section('head')
    <link rel="stylesheet" href="/assets/css/activityDate.css">
@stop
@section('body')
<div class="bg">
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
            <a class="helpsleep">帮他约睡</a>
            <a href="\activity">我也约</a>
            <a href="rank">排行</a>
        </div>
    </div>
    <div class="detail">
        <div class="detailcon clear">
            <img src="\assets\images\activity\user.jpg" alt="">
            <p>已成功帮助XXX向XXX
                发起约睡。</p>
            <a href="\activity">我也约</a>
        </div>
        <img src="\assets\images\activity\close.png" alt="" class="md-close">
    </div>
    <script>
        $(function () {
            $('.helpsleep').click(function () {
                $('.bg').addClass('blur');
                $('.detail').show();
            });
            $('.md-close').click(function () {
                $('.bg').removeClass('blur');
                $('.detail').hide();
            });
        });

    </script>
@stop