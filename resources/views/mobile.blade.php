<!DOCTYPE html>
<html>
<head>
    <meta charset=UTF-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" href="/assets/css/mobileindex.css">
    <script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title>@yield('title')</title>
    {{--百度统计代码--}}
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?4f26b22fbfe63c2ca0935f07dc6159ca";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    @yield('head')
</head>
<body>
    <!-- logo -->
    <div  class="navbartop">
        <a href="/mobile/home"><img  src="/assets/images/logow.png" /></a>
        {{--<div class="nav-middle">--}}
            {{--<input type="text" placeholder="搜索民宿">--}}
        {{--</div>--}}
        {{--<div class="nav-right">--}}
            {{--<a href="">登录</a>--}}
        {{--</div>--}}
    </div>
    @yield('body')
<footer clear>
    <div class="about">
        <ul>
            <li><a href="#">用户反馈</a></li>
            <li><a href="/mobile/about#about-us">关于我们</a></li>
        </ul>
    </div>
    <p>浙ICP备15036536号</p>
</footer>
</body>
</html>
