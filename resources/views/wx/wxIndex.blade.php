@extends('wxBase')
@section('title','探庐者')
@section('head')
    <link href="/assets/css/wx.css " rel="stylesheet"/>
@stop
@section('body')
    <nav>
        <!--
        <a href="#" class="glyphicon glyphicon-search"></a>
        -->
        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/image/logo.png"/>
        <a href="/wechatperson" class="glyphicon glyphicon-user"></a>
    </nav>
    <div class="tabtable">
        <!--
        <ul class="nav nav-tabs">
            <li class="active"><a href="#hot" data-target="#hot" data-toggle="tab" aria-expanded="false">热门精选</a></li>
            <li><a href="#special" data-target="#special" data-toggle="tab" aria-expanded="false">当季特价</a></li>
        </ul>
        -->
        <div class="tab-content">
            <div class="tab-pane active" id="hot">
                @foreach($wxCasas as $casa)
                    @if (count($casa->wxRooms) > 0)
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
@stop
