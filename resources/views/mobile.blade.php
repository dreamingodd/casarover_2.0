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
        <div class="nav-middle">
            <input type="text" placeholder="搜索民宿">
        </div>
        <div class="nav-right">
            <a href="">登录</a>
        </div>
    </div>
    @yield('body')
<footer>
    <img src="{{ asset('assets/images/qcode.jpg') }} " height="100%" alt="二维码">
    <div class="message">
        <ul>
            <li><a href="/about#about-us">用户反馈</a></li>
            <li><a href="/about#about-us">关于我们</a></li>
        </ul>
    </div>
    <p>浙ICP备<span>15036536号</span></p>
</footer>
<script src="/assets/js/home.js" type="text/javascript"></script>
<script>

</script>
</body>
</html>