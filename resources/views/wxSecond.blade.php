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
<header>
    {{-- 这个是微信中进图二级菜单时候的上面的导航 --}}
    {{-- 如果要改成固定在顶部加 .fix-top --}}
    <nav>
        <div class="nav-left">
            <a href="javascript:history.go(-1)">
                <img src="/assets/images/header/back.png" height="100%" alt="" />
            </a>
        </div>
        <div class="logo">
            <img  src="/assets/images/logow.png" height="100%"/>
        </div>
        <div class="nav-right">
            @yield('rightNav')
        </div>
    </nav>
</header>
    @yield('body')
</body>
</html>
