@extends('activity')
@section('title','约睡详情')
@section('head')
    <link rel="stylesheet" href="/assets/css/activityDate.css">
@stop
@section('body')
    <input type="hidden" value="{{$check}}" id="check">
<div class="bg">
    <div class="banner">
        <img src="/assets/images/activity/datebanner.png" alt="">
    </div>
        <div class="main">
            <div class="maincon clear">
                <div class="left">
                    <img src="/assets/images/activity/user.jpg" alt="">
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
            {{--<a class="helpsleep">帮他约睡</a>--}}
            <a class="invite">邀请好友帮我约</a>
            <a  class="date">我要约</a>
            {{--<a href="\date">我也约</a>--}}
            <a href="rank">排行</a>
        </div>
    </div>
    <div class="detail">
        <div class="detailcon clear">
            <img src="/assets/images/activity/user.jpg" alt="">
            <p>已成功帮助XXX向XXX
                发起约睡。</p>
            <a href="\date">我也约</a>
        </div>
        <img src="/assets/images/activity/close.png" alt="" class="md-close">
    </div>
<div class="invitecon">
    <div class="share">
        <img src="/assets/images/activity/wxshare.png" alt="">
    </div>
    <div class="arrow">
        <img src="/assets/images/activity/arrow.png" alt="">
    </div>
    <img src="/assets/images/activity/close.png" alt="" class="md-close">
</div>
<div class="qrcode">
    <div class="qrcodecon">
        <img src="/assets/images/activity/qrcode.png" alt="">
    </div>
    <img src="/assets/images/activity/close.png" alt="" class="md-close">
</div>
    <script>
        $(function () {
                if($('#check').val()==0) {
                    $('.helpsleep').click(function () {
                        $('.bg').addClass('blur');
                        $('.qrcode').show();
                    });
                }
            else {
                    $('.helpsleep').click(function () {
                        $('.bg').addClass('blur');
                        $('.detail').show();
                    });
                }
            $('.invite').click(function () {
                $('.bg').addClass('blur');
                $('.invitecon').show();
            });
            $('.md-close').click(function () {
                $('.bg').removeClass('blur');
                $('.detail').hide();
                $('.qrcode').hide();
                $('.invitecon').hide();
            });
        });

    </script>
@stop