@extends('mobile')
@section('title','民宿大全')
@section('head')
    <link rel="stylesheet" href="/assets/css/mobileAllcasa.css">
    <script src="/assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/allcasa.js" type="text/javascript"></script>
@endsection
@section('body')
    <style type="text/css">

    </style>
        <div class="flexslider">
            <ul class="slides">
                @foreach($areas as $area)
                    @if(!empty($area->contents[1]->attachments[0]))
                        <li style="background:url({{ config('casarover.oss_external').'/area/'.$area->contents[1]->attachments[0]->filepath }}); background-size:100% 100%;">
                            <a href="/area/{{ $area->id }}" target="_blank" class="slide-a">
                                {{--<div class="slide-mess">{{ $area->value }}</div>--}}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        {{--<div class="all" id="app">--}}
            {{--<div class="main">--}}
                {{--<div class="screen">--}}
                    {{--<div class="case">--}}
                        {{--<div class="sel-key">--}}
                            {{--<input type="hidden" v-model="city" value="{{ $sel }}">--}}
                            {{--<span>城市</span>--}}
                        {{--</div>--}}
                        {{--<div class="sel-val">--}}
                            {{--<ul class="casa">--}}
                                {{--@foreach($citys as $city)--}}
                                    {{--<li><a v-on:click="selcity({{ $city->id }})"--}}
                                           {{--@if($city->id == $sel)--}}
                                           {{--class="active"--}}
                                                {{--@endif--}}
                                        {{-->{{ $city->value }}</a></li>--}}
                                {{--@endforeach--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                        {{--<div class="show">--}}
                            {{--<a href="javascript:void(0)" class="show-more">显示全部</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}
        <div class="mobile" id="app">
            <!-- Checkbox to toggle the menu -->
            <input type="checkbox" id="tm" />
            <!-- The menu -->
            <ul class="casa sidenav">
                @foreach($citys as $city)
                <li><a  v-on:click="selcity()"
                @if($city->id == $sel)
                id="active"
                @endif
                >{{ $city->value }}</a></li>
                @endforeach
            </ul>
            <!-- Content area -->
            <section>
                <!-- Label for #tm checkbox -->
                <label for="tm">Click Me</label>
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
            </section>
            {{--民宿显示列表--}}
            <section id="casa-list">
                <template v-for="casa in casas" block transition="expand">
                    <div class="card">
                        <a href="/casa/@{{ casa.id }}" target="_blank">
                            <img :src="casa.pic" width="100%" alt="@{{ casa.pic }}">
                            <h3>@{{ casa.name }}</h3>
                            <p>地址：西湖区灵隐支路白乐桥246号</p>
                            <p>标签：
                                <span class="tip">@{{ casa.tip }}</span>
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
        </div>
    <script>
        $(function($){
            $('.casa a').click(function () {
                $('.casa a').removeAttr('id');
                $(this).attr('id','active');
            });});
    </script>
@stop