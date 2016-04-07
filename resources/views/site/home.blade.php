@extends('site')
@section('title','民宿')
@section('head')
    <link rel="stylesheet" href="/assets/css/home.css">
    <script src="{{ asset('assets/js/integration/jquery.flexslider-min.js') }}" type="text/javascript"></script>
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="{{ asset('assets/js/home.js') }}" type="text/javascript"></script>
@endsection
@section('body')
<!-- slider -->
<div class="flexslider">
    <ul class="slides">
        @foreach($casas as $casa)
            <li style="background:url({{ $casa->pic }}) ; background-size:100% 100%;">
                <a href="casa/{{ $casa->casa_id }}" target="_blank" class="slide-a">
                    <div class="slide-mess">
                        {{ $casa->title }}
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</div>
<!-- endslider -->
{{--<!-- 搜索框 -->--}}
{{--<div class="search">--}}
    {{--<div class="search-form">--}}
        {{--<form action="">--}}
            {{--<div class="search-input">--}}
                {{--<input type="text" placeholder="找到好民宿">--}}
            {{--</div>--}}
        {{--</form>--}}
        {{--<div class="search-place" id="city">--}}
            {{--<ul>--}}
                {{--@foreach($citys as $city)--}}
                    {{--<li><a href="">{{ $city }}</a></li>--}}
                {{--@endforeach--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--<!-- end 搜索框 -->--}}

<div class="container">
    <!-- 民宿推荐 -->
    <section id="recom">
        <h2>民宿推荐</h2>
        <div class="line"></div>
        <div class="city-list">
            @foreach($citys as $city)
                <a v-on:click="turn({{ $city->id }})">{{ $city->value }}</a>
            @endforeach
        </div>
            <div class="casa-card" v-for="casa in casas">
                <div class="card-b">
                    <a href="casa/@{{ casa.id }}" target="_blank">
                        <img :src="casa.pic" height="100%">
                        <div class="card">
                            <h3>@{{ casa.name }}</h3>
                        </div>
                        <div class="info">
                            <div class="middle">
                                <h3>@{{ casa.name }}</h3>
                                <p>@{{ casa.brief }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    </section>
    <!-- 精选主题 -->
    {{--<section id="theme" >--}}
    {{--<h2 v-on:click="turn(1)" >精选主题</h2>--}}
    {{--<div class="item" v-for="item in items">--}}
    {{--<div class="item-b">--}}
    {{--<a href="">--}}
    {{--<img :src="item.pic" height="100%">--}}
    {{--<div class="card">--}}
    {{--<h3>@{{ item.title }}</h3>--}}
    {{--</div>--}}
    {{--<div class="info">--}}
    {{--<div class="middle">--}}
    {{--<h3>@{{ item.title }}</h3>--}}
    {{--<p>@{{ item.shortMess }}</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</section>--}}
</div>
@endsection
