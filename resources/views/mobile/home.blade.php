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
            <div class="nav-card">
                <a href="/mobile/allcasa" style="background: #00CCFF">民宿大全</a>
            </div>
            <div class="nav-card">
                <a href="/mobile/home#recom" style="background:#C391E2 ">民宿推荐</a>
            </div>
            <div class="nav-card">
                <a href="/mobile/home#theme" style="background: #87DB83">精选主题</a>
            </div>
            <div class="nav-card">
                <a href="/mobile/home#series" style="background: #6699FF">探庐系列</a>
            </div>
        </div>
    </nav>
    <div class="container" id="app">
        <input type="hidden" name="name" value="{{ $citys[0]->id }}" v-model="city">
        @if(config('config.toggle_recom'))
                <!-- 民宿推荐 -->
        <section id="recom">
            <div class="title">
                <h2>民宿推荐</h2>
                <a href="/mobile/allcasa" id="more-casa">更多»</a>
            </div>
            <div class="line"></div>
            <div class="m-casa-card" v-for="casa in casas" transition="expand" v-cloak>
                <div class="cardcon">
                    <a href="/mobile/casa/@{{ casa.id }}">
                        <img :src="casa.pic" width="100%">
                        <div class="info">
                            <div class="middle">
                                <h3>@{{ casa.name }}</h3>
                                {{--<p>@{{ casa.brief }}</p>--}}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        @endif

                <!-- 精选主题 -->
        @if(config('config.toggle_theme'))
            <section id="theme" >
                <h2>精选主题</h2>
                <template v-for="theme in themes">
                    <div class="theme-card">
                        <a href="/mobile/theme/@{{ theme.id }}">
                            <div class="head-img">
                                <img :src="theme.pic" width="100%" alt="">
                            </div>
                            <div class="message">
                                <p>@{{ theme.brief }}</p>
                            </div>
                        </a>
                    </div>
                </template>
            </section>
            @endif
                    <!-- 探庐系列 -->
            @if(config('config.toggle_series'))
                <section id="series">
                    <h2>探庐系列</h2>
                    <div class="line"></div>
                    <div class="series-card" v-for="serie in series">
                        <div class="cardcon">
                            <a href="/mobile/casaseries/@{{ serie.type }}/@{{ serie.id }}" >
                                <img :src="serie.pic" width="100%">
                                <div class="info">
                                        <h3>@{{ serie.name }}</h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </section>
            @endif
    </div>
    <script src="/assets/js/home.js" type="text/javascript"></script>
@stop
