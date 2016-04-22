@extends('wxBase')
@section('title','民宿预订')
@section('head')
    <link href="/assets/css/wxDetails.css" rel="stylesheet"/>
    <script src="/assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
@stop
@section('body')
    <nav><a href="/wechatbook" class="glyphicon glyphicon-chevron-left"></a>
        <a href="tel:12345678901" class="glyphicon glyphicon-earphone"></a>
        <h1>探庐者</h1>
    </nav>
    <div class="flexslider">
        <ul class="slides">
            <li onclick="goto_link1()"
                style="background:url('http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$wxCasa->thumbnail}}') ; background-size:100% 100%; "></li>
        </ul>
    </div>
    <div class="main">
        <div class="header">
            <h1>{{$wxCasa->name}}</h1>
            <p>{{$wxCasa->brief}}</p>
            <span>￥{{$wxCasa->cheapestPrice}}起</span>
        </div>
        <div class="brief">
            <p>{!!$wxCasa->desc!!}</p>
        </div>
        <div class="tabtable">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#product" data-target="#product" data-toggle="tab" aria-expanded="false">产品详情</a></li>
                <li><a href="#notice" data-target="#notice" data-toggle="tab" aria-expanded="false">预订须知</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="product">
                    @if (empty($wxCasa->casa_id))
                        <p>
                            self
                        </p>
                    @else
                        @foreach ($wxCasa->casa->contents as $content)
                            <h2>{{$content->name}}</h2>
                            @foreach ($content->attachments as $attachment)
                            <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$attachment->filepath}}"/>
                            @endforeach
                            <p>{!!$content->text!!}</p>
                        @endforeach
                    @endif
                </div>
                <div class="tab-pane" id="notice">
                    <div class="explain">
                        <h2>使用说明</h2>
                        <p>{!!$wxCasa->spec!!}</p>
                    </div>
                    <div class="rule">
                        <h2>改退规则</h2>
                        <p>{!!$wxCasa->rule!!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="btn">立即购买</a>
    <script>
        $('.flexslider').flexslider({
            directionNav: true,
            pauseOnAction: false
        });
    </script>
@stop
