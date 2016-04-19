<!DOCTYPE html>
<html>
<head>
    <meta charset=UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="/assets/css/mobileindex.css">
    <script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="/assets/css/common.css">
    <![endif]-->
    <title>@yield('title')</title>
    @yield('head')
</head>
<body>
    <!-- logo -->
    <div  class="navbartop">
        <div class="nav-left">
            <a href="/" class="logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
            </a>
        </div>
        <div class="nav-right">
            <a href="">登录</a>
            <a href="">注册</a>
        </div>
    </div>
    @yield('body')
<nav class="navbar navbar-default">
    <div class="nav-middle">
        @if(config('casarover.toggle_allcasa'))
            <a href="/allcasa">民宿大全</a>
        @endif
        <a href="/#recom">民宿推荐</a>
        <a href="/#theme">精选主题</a>
        <a href="/#series">探庐系列</a>
    </div>
</nav>
{{--<footer>--}}
    {{--<div class="message">--}}
        {{--<div class="pic">--}}
            {{--<img src="{{ asset('assets/images/qcode.jpg') }} " height="100%" alt="二维码">--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="message">--}}
        {{--<h3>公司</h3>--}}
        {{--<ul>--}}
            {{--<li><a href="/about#casarover">探庐者</a></li>--}}
            {{--<li><a href="/about#about-us">关于我们</a></li>--}}
            {{--<li><a href="/about#brand-culture">品牌文化</a></li>--}}
            {{--<li><a href="/about#media-cooperation">媒体合作</a></li>--}}
        {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="message">--}}
        {{--<h3>服务</h3>--}}
        {{--<ul>--}}
            {{--<li><a href="/about#free-promotion">免费推广</a></li>--}}
            {{--<li><a href="/about#personal-customized">私人定制</a></li>--}}
        {{--</ul>--}}
    {{--</div>--}}
    {{--<div class="message">--}}
        {{--<h3>帮助中心</h3>--}}
        {{--<ul>--}}
            {{--<li><a href="/about#business-cooperation">商务合作</a></li>--}}
            {{--<li><a href="/about#charge-standard">合作推广收费标准</a></li>--}}
            {{--<li><a href="/about#contact-us">联系我们</a></li>--}}
        {{--</ul>--}}
    {{--</div>--}}
    {{--<p>浙ICP备<span>15036536号</span></p>--}}
{{--</footer>--}}
{{--测试如果放在下面能不能解决被提前加载的问题--}}
<script src="/assets/js/home.js" type="text/javascript"></script>
</body>
</html>