@extends('wxBase')
@section('title', '探庐者 - ' . $wxCasa->name)
@section('head')
    <link href="/assets/css/wxDetails.css" rel="stylesheet"/>
    <script src="/assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
@stop
@section('body')
    @section('nav')
        <a href="/wx" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
        <a href="/wx/user" id="navright" class="glyphicon glyphicon-user"></a>
        <img  src="/assets/images/logow.png" />
    @stop
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
            {{--<div class="collection" onclick="poll({{$wxCasa->id}})">--}}
                    {{--<input type="hidden" value="{{empty($casas)}}" id="iscollection">--}}
                    {{--<div class="uncollected">--}}
                        {{--<span class="glyphicon glyphicon-star-empty"></span>--}}
                        {{--收藏--}}
                    {{--</div>--}}
                    {{--<div class="collected" style="display: none">--}}
                        {{--<span class="glyphicon glyphicon-star"></span>--}}
                        {{--已收藏--}}
                    {{--</div>--}}
            {{--</div>--}}
        </div>
        <div class="tabtable">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#product" data-target="#product" data-toggle="tab" aria-expanded="false">产品详情</a></li>
                <li><a href="#notice" data-target="#notice" data-toggle="tab" aria-expanded="false">预订须知</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="product">
                    @if (empty($wxCasa->casa_id))
                        @foreach ($wxCasa->contents as $content)
                            <h2>{{$content->name}}</h2>
                            @foreach ($content->attachments as $attachment)
                            <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$attachment->filepath}}"/>
                            @endforeach
                            <p>{!!$content->text!!}</p>
                        @endforeach
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
    <input type="hidden" value="{{$wxCasa->id}}" id="casaId">
    <a href="/wx/order/{{$wxCasa->id}}" class="btn">立即购买</a>
    <script>
        $('.flexslider').flexslider({
            directionNav: true,
            pauseOnAction: false
        });
        function iscollection() {
            if($('#iscollection').val()==1){
                $('.collected').hide();
                $('.uncollected').show();
            }
            else{
                $('.collected').show();
                $('.uncollected').hide();
            }
        }
        function poll(casa){
                        $.getJSON('/wx/casa/'+casa+'/1');
                        $('.collected').show();
                        $('.uncollected').hide();
                }
        iscollection();
    </script>
@stop