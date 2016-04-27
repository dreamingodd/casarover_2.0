@extends('mobile')
@section('title','探庐者')
@section('head')
    <script src="/assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
@endsection
@section('body')
    <div class="flexslider">
        <ul class="slides">
            @foreach($casas as $casa)
                <li style="background:url({{ $casa->pic }}) ; background-size:100% 100%;">
                    <a href="casa/{{ $casa->casa_id }}" target="_blank" class="slide-a">
                        <div class="slide-mess">
                            {{$casa->title }}
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <nav class="navbar">
        <div class="navcon">
            @if(config('casarover.toggle_allcasa'))
                {{--<a href="/mobile/allcasa">民宿大全</a>--}}
            @endif
            <a href="/mobile/home#recom">民宿推荐</a>
            <a href="/mobile/home#theme">精选主题</a>
            <a href="/mobile/home#series">探庐系列</a>
        </div>
    </nav>
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
                <div class="cardcon">
                    <a href="/mobile/casa/@{{ casa.id }}" target="_blank">
                        <img :src="casa.pic" >
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
        @endif

                <!-- 精选主题 -->
        @if(config('casarover.toggle_theme'))
            <section id="theme" >
                    <h2>精选主题</h2>
                    <div class="line"></div>
                    <div class="casa-card" v-for="theme in themes">
                        <div class="cardcon">
                            <a href="/mobile/theme/@{{ theme.id }}" target="_blank">
                                <img :src="theme.pic" height="100%">
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
                        <div class="cardcon">
                            <a href="/mobile/casaseries/@{{ serie.type }}/@{{ serie.id }}" target="_blank">
                                <img :src="serie.pic" height="100%">
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
    <script>
        $(function($){
        $('."city-list a').click(function () {
        $('."city-list a').removeClass();
        $(this).addClass('active');
        });});
    </script>
@stop