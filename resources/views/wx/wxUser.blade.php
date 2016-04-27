@extends('wxBase')
@section('title','个人中心')
@section('head')
    <link href="/assets/css/wxPerson.css" rel="stylesheet"/>
@stop
@section('body')
    <nav><a href="/wx" class="glyphicon glyphicon-chevron-left"></a>
        <a href="tel:12345678901" class="glyphicon glyphicon-earphone"></a>
        <h1>探庐者</h1>
    </nav>
    <div class="main">
        <a href="#" id="order"><p class="divider"><em class="glyphicon glyphicon-menu-hamburger"></em>我的订单
                <span class="glyphicon glyphicon-triangle-right"></span><span class="glyphicon glyphicon-triangle-bottom"></span></p></a>
        <div class="tabtable">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#already" data-target="#already" data-toggle="tab" aria-expanded="false">
                        待支付</a></li>
                <li><a href="#not" data-target="#not" data-toggle="tab" aria-expanded="false">已支付</a></li>
                <li><a href="#complete" data-target="#complete" data-toggle="tab" aria-expanded="false">已完成</a></li>
                <li><a href="#refund" data-target="#refund" data-toggle="tab" aria-expanded="false">已退款</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="already">
                    <a href="#">
                      <div class="case clear">
                          <div class="images">
                            <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512101852512659.png"
                                 alt="">
                            <p>民宿名字</p>
                          </div>
                          <div class="info">
                              <p>房间型号</p>
                              <p id="gray">下单时间</p>
                          </div>
                          <div class="bill">
                              <p>价格</p>
                              <p id="orange">未支付</p>
                          </div>
                      </div>
                    </a>
                    <a href="#">
                        <div class="case clear">
                            <div class="images">
                                <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512101852512659.png"
                                     alt="">
                                <p>民宿名字</p>
                            </div>
                            <div class="info">
                                <p>房间型号</p>
                                <p id="gray">下单时间</p>
                            </div>
                            <div class="bill">
                                <p>价格</p>
                                <p id="orange">未支付</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="tab-pane" id="not">
                    <a href="#">
                        <div class="case clear">
                            <div class="images">
                                <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512101852512659.png"
                                     alt="">
                                <p>民宿名字</p>
                            </div>
                            <div class="info">
                                <p>房间型号</p>
                                <p id="gray">下单时间</p>
                            </div>
                            <div class="bill">
                                <p>价格</p>
                                <p id="orange">以支付</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="tab-pane" id="complete">
                    <a href="#">
                        <div class="case clear">
                            <div class="images">
                                <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512101852512659.png"
                                     alt="">
                                <p>民宿名字</p>
                            </div>
                            <div class="info">
                                <p>房间型号</p>
                                <p id="gray">下单时间</p>
                            </div>
                            <div class="bill">
                                <p>价格</p>
                                <p id="orange">以完成</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="tab-pane" id="refund">
                    <a href="#">
                        <div class="case clear">
                            <div class="images">
                                <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512101852512659.png"
                                     alt="">
                                <p>民宿名字</p>
                            </div>
                            <div class="info">
                                <p>房间型号</p>
                                <p id="gray">下单时间</p>
                            </div>
                            <div class="bill">
                                <p>价格</p>
                                <p id="orange">以退款</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        {{--<p><a href="#"><em class="glyphicon glyphicon-piggy-bank"></em>我的优惠券--}}
        {{--<span  class="glyphicon glyphicon-triangle-right"></span></a></p>--}}
    </div>
    <script>
        $(function ($) {
           $('#order').click(function () {
               $('.glyphicon-triangle-right').toggle();
               $('.glyphicon-triangle-bottom').toggle();
               $('.tabtable').toggle();
               $(this).children('p').toggleClass('divider');
           });
        });
    </script>
@stop
