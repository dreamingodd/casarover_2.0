@extends('site')

@section('body')
<!-- slider -->
<div class="flexslider">
    <ul class="slides">
        <li style="background:url(assets/images/head.png) ; background-size:100% 100%;">
            <div class="slide-mess">
                第一个
            </div>
        </li>
        <li style="background:url(assets/images/head2.png) ; background-size:100% 100%;">
            <div class="slide-mess">
                什么山
            </div>
        </li>
    </ul>
</div>
<!-- endslider -->
<!-- 搜索框 -->
<div class="search">
    <div class="search-form">
        <form action="">
            <div class="search-input">
                <input type="text" placeholder="找到好民宿">
            </div>
        </form>
        <div class="search-place" id="city">
            <ul v-for="item in citys">
                <li><a href="">@{{ item }}</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- end 搜索框 -->

<div class="container">
    <!-- 民宿推荐 -->
    <section id="recom">
        <h2>民宿推荐</h2>
        <div class="line"></div>
        <div class="city-list">
            <a href="">杭州</a>
            <a href="">临安</a>
            <a href="">莫干山</a>
        </div>
        @for($i=0;$i<6;$i++)
            <div class="item">
                <div class="item-b">
                    <a href="">
                        <img src="assets/images/fang.jpg" height="100%">
                        <div class="card">
                            <h3>花千谷</h3>
                        </div>
                        <div class="info">
                            <div class="middle">
                                <h3>花千谷</h3>
                                <p>位于云南省西部，这里冬天依旧温暖<br>
                                    这是多民族聚集区，可以吃到众多的云南小吃；丰富的热带水果；欣赏美丽的孔雀舞</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endfor
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