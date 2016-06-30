@extends('wxBase')
@section('title','探庐者精品民宿预订')
@section('head')
    <link href="/assets/css/wx.css " rel="stylesheet"/>
    <script src="/assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
@stop
    {{-- <a href="#"  id="navleft" class="glyphicon glyphicon-home"></a>
    <img  src="/assets/images/logow.png" />
    <a href="/wx/user" id="navright" class="glyphicon glyphicon-user"></a> --}}
@section('body')
    <div class="flexslider">
        <ul class="slides">
            <li style="background:url('http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_20160420-105355-748r5403.jpg') ; background-size:100% 100%;">
                <a href="/wx/casa/4" class="slide-a"></a>
            </li>
            <li style="background:url('http://casarover.oss-cn-hangzhou.aliyuncs.com/image/image_20160419-094608-425r3598.jpg') ; background-size:100% 100%;">
                <a href="/wx/casa/5" class="slide-a"></a>
            </li>
        </ul>
    </div>
    <div class="tabtable">
        <!--
        <ul class="nav nav-tabs">
            <li class="active"><a href="#hot" data-target="#hot" data-toggle="tab" aria-expanded="false">热门精选</a></li>
            <li><a href="#special" data-target="#special" data-toggle="tab" aria-expanded="false">当季特价</a></li>
        </ul>
        -->
        <div class="tab-content">
            <div class="tab-pane active" id="hot">
                @foreach($testWxCasas as $casa)
                    @if (count($casa->rooms) > 0 && !empty($casa->thumbnail))
                        <div class="case">
                            <div class="image">
                                <a href="/wx/casa/{{$casa->id}}">
                                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$casa->thumbnail}}"
                                            alt="">
                                </a>
                                <span>¥{{$casa->cheapestPrice}}元起</span>
                            </div>
                            <p>{{$casa->name or ""}}</p>
                            <em>{{$casa->brief or ""}}</em>
                        </div>
                    @endif
                @endforeach
                @foreach($wxCasas as $casa)
                    @if (count($casa->rooms) > 0 && !empty($casa->thumbnail))
                        <div class="case">
                            <div class="image">
                                <a href="/wx/casa/{{$casa->id}}">
                                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$casa->thumbnail}}"
                                            alt="">
                                </a>
                                <span>¥{{$casa->cheapestPrice}}元起</span>
                            </div>
                            <p>{{$casa->name or ""}}</p>
                            <em>{{$casa->brief or ""}}</em>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="tab-pane" id="special">
            </div>
        </div>
    </div>
    <script>
        $('.flexslider').flexslider({
            directionNav: true,
            pauseOnAction: false
        });
    </script>
@stop
