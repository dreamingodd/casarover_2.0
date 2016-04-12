@extends('site')
@section('title','民宿')
@section('head')
<link rel="stylesheet" href="/assets/css/home.css">
<link rel="stylesheet" href="/assets/css/themerecommend.css">
<script src="{{ asset('assets/js/integration/jquery.flexslider-min.js') }}" type="text/javascript"></script>
<script src="/assets/js/integration/vue.js" type="text/javascript"></script>
<script src="{{ asset('assets/js/home.js') }}" type="text/javascript"></script>
@endsection
@section('body')
    <div class="main">
        <div class="left">
            <h1>喵系</h1>
            <div class="case">
                <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201601291648068414.png" alt="">
                <div class="articles">
                    <h2>杭州莫雷娜古堡</h2>
                    <p>123333332222222222233333333333333333333333333333333333333333333333333333333333333333333332</p>
                </div>
            </div>
        </div>
        <div class="right">
            <h2>相关地：</h2>
            <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201601291648068414.png" alt="">
            <p>四眼井</p>
        </div>
    </div>
@endsection
