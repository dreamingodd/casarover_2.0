<!DOCTYPE html>
<html>
<head>
    <meta charset=UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <link href="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen" />
    <link href="/assets/css/wxCommon.css" rel="stylesheet"/>
    <script src="//cdn.bootcss.com/jquery/2.1.2/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="/assets/js/wxBase.js" type="text/javascript"></script>
    <title>@yield('title')</title>
    @yield('head')
</head>
<body>
{{-- <nav>
    @yield('nav')
</nav> --}}
<header>
    {{-- 如果要改成固定在顶部加 .fix-top --}}
    <nav>
        <div class="nav-left">
            <a href="/wx">
                <img src="/assets/images/header/home.png" height="100%" alt="" />
            </a>
        </div>
        <div class="logo">
            <img  src="/assets/images/logow.png" height="100%"/>
        </div>
        <div class="nav-right">
            <a href="/wx/user">
                <img src="/assets/images/header/user.png" height="100%" alt="" />
            </a>
        </div>
    </nav>
</header>
    @yield('body')
</body>
</html>
