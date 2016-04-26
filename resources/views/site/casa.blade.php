@extends('site')
@section('title',$casa->name)
@section('head')
    <link rel="stylesheet" href="/assets/css/casa.css">
@endsection

@section('body')
        <!-- 民宿大图  -->
    {{--<div class="banner">--}}
        {{--<div class="cover-photo">--}}
            {{--<img src="{{ $casa->headImg }}" width="100%" alt="">--}}
        {{--</div>--}}
        {{--<div class="show-mess">--}}
            {{--<!-- <div class="mark">浏览233</div> -->--}}
            {{--<h1>{{ $casa->name }}</h1>--}}
        {{--</div>--}}

    {{--</div>--}}
    <!-- 民宿介绍内容 -->
    <div class="navtop">
        <h1>{{ $casa->name }}</h1>
        <p><a href="">首页</a> > <a href="">杭州</a> > <a href=""><span>珀客主题民宿</span></a></p>
    </div>
    <article class="casa-article">
        <div class="article-main">
            @foreach($casa->contents as $content)
                @foreach($content->attachments as $photo)
                        <img src="{{ config('casarover.photo_folder').$photo->filepath }}" alt="" width="100%">
                @endforeach
            <h2>{{ $content->name }}</h2>
            <p>{!! $content->text !!}</p>
            @endforeach
        </div>
    </article>
    <div class="casa-mess">
        <div class="tag-list">
            <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512101117234651.jpg" alt=""  width="100%" >
            <p>标签：
            @foreach($casa->tags as $tag)
                <a href="">{{ $tag->name }}</a>
            @endforeach
            </p>
        </div>
    </div>
    <div class="casa-mess" id="others">
        <section>
            <h2>猜你喜欢</h2>
        <div class="card">
            <a href="#" target="_blank">
                <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512101117234651.jpg" width="100%" alt="">
                <h3>杭州栖木客栈</h3>
                {{--<p>地址：西湖区灵隐支路白乐桥246号</p>--}}
                <p>标签：
                    <span class="tip">小清新</span>
                </p>
            </a>
        </div>
            <div class="card">
                <a href="#" target="_blank">
                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512101117234651.jpg" width="100%" alt="">
                    <h3>杭州栖木客栈</h3>
                    {{--<p>地址：西湖区灵隐支路白乐桥246号</p>--}}
                    <p>标签：
                        <span class="tip">小清新</span>
                    </p>
                </a>
            </div>
            <div class="card">
                <a href="#" target="_blank">
                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201512101117234651.jpg" width="100%" alt="">
                    <h3>杭州栖木客栈</h3>
                    {{--<p>地址：西湖区灵隐支路白乐桥246号</p>--}}
                    <p>标签：
                        <span class="tip">小清新</span>
                    </p>
                </a>
            </div>
        </section>
    </div>
    <div class="casa-map">
        <!-- 地图api显示位置 -->
        <div id="allmap"></div>
    </div>
    <script>
        //BR首行缩进
        $(function ($) {
           $('.article-main p ').each(function(){
               $(this).html($(this).html().replace(/BR/ig, 'p><p'));
            });
        });
    </script>
@endsection