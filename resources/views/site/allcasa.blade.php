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
            {{--@foreach($casas as $casa)--}}
                {{--<li style="background:url({{ $casa->pic }}) ; background-size:100% 100%;">--}}
                    {{--<a href="casa/{{ $casa->casa_id }}" target="_blank" class="slide-a">--}}
                        {{--<div class="slide-mess">--}}
                            {{--{{ $casa->title }}--}}
                        {{--</div>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--@endforeach--}}
        </ul>
    </div>
    <div class="container">
        <!-- 民宿推荐 -->
        <section id="recom">
            <h2>民宿推荐</h2>
            <div class="line"></div>
            <div class="city-list">
                {{--@foreach($citys as $city)--}}
                    {{--<a v-on:click="turn({{ $city->id }})">{{ $city->value }}</a>--}}
                {{--@endforeach--}}
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
    </div>
@endsection
