@extends('site')
@section('title','民宿大全')
@section('head')
    <link rel="stylesheet" href="/assets/css/allcasa.css">
    <script src="/assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/allcasa.js" type="text/javascript"></script>
@endsection
@section('body')
    <div class="flexslider">
        <ul class="slides">
            @foreach($slides as $casa)
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
    <div class="all" id="app">
        <div class="main">
            <div class="screen">
                <div class="case">
                    <div class="sel-key">
                        <input type="hidden" v-model="city" value="{{ $sel }}">
                        <span>城市</span>
                    </div>
                    <div class="sel-val">
                        <ul class="casa">
                            @foreach($citys as $city)
                                <li><a v-on:click="selcity({{ $city->id }})"
                                       @if($city->id == $sel)
                                       class="active"
                                            @endif
                                    >{{ $city->value }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="show">
                        <a href="javascript:void(0)" class="show-more">显示全部</a>
                    </div>
                </div>
            </div>
            <div class="screen">
                <div class="case">
                    <div class="sel-key">
                        <span>区域</span>
                    </div>
                    <div class="sel-val">
                        <ul class="casa area">
                            <template v-for="area in areas">
                                <li >
                                    <a v-on:click="selarea(this)">@{{ area.value }}</a>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
                <template v-if="banner.pic" v-cloak>
                    <a href="/area/@{{ banner.id }}">
                        <div class="banner">
                            <div class="cover-photo">
                                <img :src="banner.pic" width="100%" alt="">
                            </div>
                            <div class="guide-mess">
                                <h1>@{{ banner.title }}</h1>
                                <p>@{{ banner.mess }}</p>
                            </div>
                        </div>
                    </a>
                </template>

            </div>
        </div>
        {{--民宿显示列表--}}
        <section id="casa-list">
            <template v-for="casa in casas" block transition="expand">
                <div class="card">
                    <a href="/casa/@{{ casa.id }}" target="_blank">
                        <img :src="casa.pic" width="100%" alt="@{{ casa.pic }}">
                        <h3>@{{ casa.name }}</h3>
                        {{--<p>地址：西湖区灵隐支路白乐桥246号</p>--}}
                        <p>标签：
                            <template v-for="tag in casa.tags" v-cloak>
                                <template v-if="$index < 3">
                                    <span class="tip">@{{ tag.name }}</span>
                                </template>
                            </template>
                        </p>
                    </a>
                </div>
            </template>
        </section>
    </div>
    <div class="loader" style="display: none">
        <div class="loader-inner line-scale">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <div class="no-more">
        没有更多了
    </div>
    <div class="scroll-back">
        <a href="javascript:void(0)" class="right-float-top" id="toTop" >返回顶部</a>
        <a href="javascript:void(0)" class="right-float-bottom" id="qrcode"><span></span></a>
    </div>
@endsection