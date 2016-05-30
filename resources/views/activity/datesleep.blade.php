@extends('activity')
@section('title','约睡详情')
@section('head')
    <link rel="stylesheet" href="/assets/css/activityDate.css">
@stop
@section('body')
    <input type="hidden" value="{{$check}}" id="check">
<div class="bg">
    <div class="banner">
        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/datebanner.png" alt="">
    </div>
        <div class="main">
            <div class="maincon clear">
                <div class="left">
                    <img src="{{$user->headimgurl}}" alt="">
                </div>
                <div class="right">
                    <div class="righttop">
                        <h2><span>{{ $user->nickname }}</span>向<span>{{ $wxCasa->name }}</span>发起约睡</h2>
                    </div>
                    <div class="rightbottom">
                        <p>{{ $user->nickname }}仰慕{{ $wxCasa->name }}已久，今天终于找到机
                            会可以约一觉。各位看官有手的点个赞。</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="button">
            @if($isme)
                <a class="invite">邀请好友帮我约</a>
                <a class="helpsleep" onclick="poll({{ $wxCasa->id }},{{ $user->id }})">约约约</a>
                <a href="/wx/date/rank/{{ $wxCasa->id }}">排行</a>
            @else
                <a class="helpsleep" onclick="poll({{ $wxCasa->id }},{{ $user->id }})">帮他约睡</a>
                <a href="/date">我也约</a>
                <a href="/wx/date/rank/{{ $wxCasa->id }}">排行</a>
            @endif
        </div>
    </div>
    <div class="detail">
        <div class="detailcon clear">
            <img src="{{$user->headimgurl}}" alt="">
            <p>已成功帮助{{ $user->nickname }}向{{ $wxCasa->name }}
                发起约睡。</p>
            @if(!$isme)
                <a href="/wx/date">我也约</a>
            @endif
        </div>
        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/close.png" alt="" class="md-close">
    </div>
    <div class="invitecon">
        <div class="share">
            <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/wxshare.png" alt="">
        </div>
        <div class="arrow">
            <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/arrow.png" alt="">
        </div>
        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/close.png" alt="" class="md-close">
    </div>
<div class="qrcode">
    <div class="qrcodecon">
        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/qrcode.png" alt="">
    </div>
    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/wx18/close.png" alt="" class="md-close">
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

        function poll(casa,user){
            $.getJSON('/wx/date/poll/'+casa+'/'+user,function(data){
                console.log(data);
                if(data.code == 0){
                    $('.bg').addClass('blur');
                    $('.detail').show();
                }else if(data.code == 1){
                    alert('明天再来投票吧');
                }else{
                    alert('something is wrong');
                }
            })
        }
    </script>
@stop