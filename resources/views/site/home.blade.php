@extends('site')
@section('title','民宿')
@section('head')
<link rel="stylesheet" href="/assets/css/home.css">
<script src="/assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
<script src="/assets/js/integration/vue.js" type="text/javascript"></script>
<script type="text/javascript">
<?php
// Redirect mobile site.
header("Cache-Control: no-cache");
header("Pragma: no-cache");
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
$uachar = "/(symbianos|android|iphone|ipod|ucweb|blackberry)/i";
if($ua != '' && preg_match($uachar, $ua)){
    echo 'location.href="/mobile/home";';
}

?>
</script>
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
{{--<li><a href="">{{ $city->value }}</a></li>--}}
{{--@endforeach--}}
{{--</ul>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<!-- end 搜索框 -->--}}

<div class="container" id="app">
    @if(config('casarover.toggle_recom'))
            <!-- 民宿推荐 -->
    <section id="recom">
        <h2>民宿推荐</h2>
        <div class="line"></div>
        <div class="city-list">
            @foreach($citys as $city)
                <a class="normal" value="{{ $city->id }}" v-on:click="turn({{ $city->id }})" >{{ $city->value }}</a>
            @endforeach
        </div>
        <div class="loader">
            <div class="loader-inner line-scale">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="casa-card" v-for="casa in casas" transition="expand">
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
        <a href="/allcasa/@{{ city }}" class="city-casa">更多</a>
    </section>
    @endif

            <!-- 精选主题 -->
    @if(config('casarover.toggle_theme'))
        <section id="theme" >
            <h2>精选主题</h2>
            <div class="line"></div>
            <div class="casa-card" v-for="theme in themes">
                <div class="card-b">
                    <a href="theme/@{{ theme.id }}" target="_blank">
                        <img :src="theme.pic" height="100%">
                        <div class="card">
                            <h3>@{{ theme.name }}</h3>
                        </div>
                        <div class="info">
                            <div class="middle">
                                <h3>@{{ theme.name }}</h3>
                                <p>@{{{ theme.brief }}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        @endif
                <!-- 探庐系列 -->
        @if(config('casarover.toggle_series'))
            <section id="series">
                <h2>探庐系列</h2>
                <div class="line"></div>
                <div class="casa-card" v-for="serie in series">
                    <div class="card-b">
                        <a href="casaseries/@{{ serie.type }}/@{{ serie.id }}" target="_blank">
                            <img :src="serie.pic" height="100%">
                            <div class="card">
                                <h3>@{{ serie.name }}</h3>
                            </div>
                            <div class="info">
                                <div class="middle">
                                    <h3>@{{ serie.name }}</h3>
                                    <p>@{{ serie.brief }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </section>
        @endif
</div>
{{--测试如果放在下面能不能解决被提前加载的问题--}}
<script src="/assets/js/home.js" type="text/javascript"></script>
@endsection
