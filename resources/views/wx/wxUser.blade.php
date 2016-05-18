@extends('wxBase')
@section('title','个人中心')
@section('head')
    <link href="/assets/css/wxPerson.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:15868102935" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="top">
        <img src="{{$wxUser->headimgurl}}" alt="">
        <h2>{{$wxUser->nickname}}</h2>
        @if(!empty($wxUser->WxMembership->id))
            <div class="vip">
                <span>{{$levelstr}}</span>
                <div class="progress">
                    <div class="progress-bar " role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{ $wxUser->WxMembership->score/50}}%" >
                        {{$wxUser->WxMembership->score}}/5000
                    </div>
                </div>
            </div>
         @else
            <div class="be-vip">成为会员</div>
        @endif
        @if(!empty($wxUser->WxMembership->id))
        <div class="mask clear">
            <div class="maskcon">
                <p>{{$wxUser->WxMembership->accumulated_score}}</p>
                <p>累计积分</p>
            </div>
            <div class="maskcon">
                <p>{{$wxUser->WxMembership->score}}</p>
                <p>可用积分</p>
            </div>
            <div class="maskcon">
                <p class="glyphicon glyphicon-star"></p>
                <p><a href="#">我的收藏</a></p>
            </div>
        </div>
        @endif
    </div>
    <div class="main">
        {{--<p id="notice">点击右上方电话按钮进行预约</p>--}}
        <div  id="rules" class="maincon">
            <p class="divider"><em class="glyphicon glyphicon-bell"></em>积分规则
                <span class="glyphicon glyphicon-minus"></span>
                <span class="glyphicon glyphicon-plus"></span>
            </p>
            <div class="maincondetail">
                    <p>1.会员分普通会员（所有用户均为普通会员） 黄金会员（扫描名片后方二维码即可获得金卡会员身份）白金会员三种。</p>
                    <p>2.会员上升方式普通会员累计2000积分可升级为黄金会员，黄金会员累计5000积分可升级为白金会员。</p>
                    <p>3.普通会员积分累计比例为20%（消费1000元得200积分），黄金会员为40%（消费1000元得400积分），白金会员为50%（消费1000元得500积分）。</p>
                    <p>4.每周二会员住宿日，周二入住可获得双倍积分累计，普通及金卡会员双倍积分累计，最高50%的积分累计（消费1000元得500积分）；白金会员获得免费升房一次（机会不可累积）</p>
                    <p>5.特价房，折扣房可累计积分，但不可通过积分兑换</p>
            </div>
        </div>
        <div id='info' class="maincon">
            <p class="divider"><em class="glyphicon glyphicon-user"></em>个人信息
                <span class="glyphicon glyphicon-minus"></span>
                <span class="glyphicon glyphicon-plus"></span>
            </p>
            <div class="maincondetail">
                <p>姓名：{{$wxUser->realname or null}}</p>
                <p>手机号码：{{$wxUser->cellphone}}</p>
                <p>会员等级：{{$levelstr}}</p>
            </div>
        </div>
        <div id="order" class="maincon">
            <p class="divider"><em class="glyphicon glyphicon-menu-hamburger"></em>我的订单
                <span class="glyphicon glyphicon-minus"></span>
                <span class="glyphicon glyphicon-plus"></span>
            </p>
            <div class="maincondetail">
                @foreach($orders as $order)
                    @if ($order->pay_status == 0)
                        @if (empty($order->wxCasa->name))
                            <a href="#" onclick="javascript:alert('民宿已下架，不再提供付款！')">
                                @else
                                    <a href="/wx/pay/wxorder/{{$order->id}}">
                                        @endif
                                        @else
                                            <a href="/wx/order/detail/{{$order->id}}">
                                                @endif
                                                <div class="case clear">
                                                    <div class="casecon clear">
                                                        <div class="images">
                                                            @if (empty($order->wxCasa->name))
                                                                <p>该民宿已下架</p>
                                                            @else
                                                                <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$order->wxCasa->thumbnail()}}"/>
                                                            @endif
                                                            <p>{{$order->casa_name}}</p>
                                                        </div>
                                                        <div class="info">
                                                            <p>订单号</p>
                                                            <p id="orange">{{$order->order_id}}</p>
                                                            <p>下单时间</p>
                                                            <p id="orange">{{$order->created_at}}</p>
                                                        </div>
                                                        <div class="bill">
                                                            <p>价格</p>
                                                            <p id="orange">{{$order->total}}元</p>
                                                        </div>
                                                        <div class="state">
                                                            <p>状态</p>
                                                            @if ($order->pay_status == 0)
                                                                <p>未付款</p>
                                                            @elseif ($order->pay_status == 1)
                                                                <p>已付款</p>
                                                            @elseif ($order->pay_status == 2)
                                                                <p>正在退款</p>
                                                            @elseif ($order->pay_status == 3)
                                                                <p>已退款</p>
                                                            @else
                                                                <p>未确认</p>
                                                            @endif

                                                            @if ($order->reserve_status == 0)
                                                                <p>未预约</p>
                                                            @elseif ($order->reserve_status == 1)
                                                                <p>已预约</p>
                                                            @elseif ($order->reserve_status == 1)
                                                                <p>预约失败</p>
                                                            @endif

                                                            @if ($order->consume_status == 0)
                                                                <p>未消费</p>
                                                            @elseif ($order->consume_status == 1)
                                                                <p>已完成</p>
                                                            @elseif ($order->consume_status == 2)
                                                                <p>已过期</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="date">
                                                        @if ($order->reserve_status == 1)
                                                            <p>预约日期:</p>
                                                            <p>{{$order->reserve_time}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </a>
                            @endforeach
            </div>
        </div>
        {{--<p><a href="#"><em class="glyphicon glyphicon-piggy-bank"></em>我的优惠券--}}
        {{--<span  class="glyphicon glyphicon-triangle-right"></span></a></p>--}}
    </div>
    <script>
        $(function ($) {
            $('.glyphicon-minus').hide();
            $('.maincondetail').hide();
            $('.divider').click(function () {
                $(this).find('.glyphicon-plus').toggle();
                $(this).find('.glyphicon-minus').toggle();
                $(this).parent('.maincon').find('.maincondetail').toggle();
                $(this).toggleClass('divider');
            });
        });
    </script>
@stop
