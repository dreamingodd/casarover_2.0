@extends('wechattemp')
@section('head')
    <link href="{{ asset('assets/css/book.css') }} " rel="stylesheet"/>
@stop
@section('body')
    <nav><h1>探庐者</h1></nav>
    <div class="tabtable">
        <ul class="nav nav-tabs">
            <li><a href="#hot" data-target="#hot" data-toggle="tab" aria-expanded="false">热门精选</a></li>
            <li><a href="#special" data-target="#special " data-toggle="tab" aria-expanded="false">当季特价</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="hot">
                <div class="case">
                    <div class="image">
                        <a href="/bookdetails"><img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512111345475426.jpg" alt=""></a>
                        <span>￥7599起</span>
                    </div>
                    <p>准备去征服星辰大海吧！</p>
                    <em>2333333</em>
                </div>
                <div class="case">
                    <div class="image">
                        <a href="#"><img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512111345475426.jpg" alt=""></a>
                        <span>￥7599起</span>
                    </div>
                    <p>准备去征服星辰大海吧！</p>
                    <em>233333333333333333333</em>
                </div>
                <div class="case">
                    <div class="image">
                        <a href="#"><img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512111345475426.jpg" alt=""></a>
                        <span>￥7599起</span>
                    </div>
                    <p>准备去征服星辰大海吧！</p>
                    <em>233333333333333333333</em>
                </div>
            </div>
            <div class="tab-pane" id="special">
                <div class="case">
                    <div class="image">
                        <a href="#"><img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512111345475426.jpg" alt=""></a>
                        <span>￥7599起</span>
                    </div>
                    <p>准备去征服星辰大海吧！</p>
                    <em>2222222</em>
                </div>
            </div>
        </div>
    </div>
@stop