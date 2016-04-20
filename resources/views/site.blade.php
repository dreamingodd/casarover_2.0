<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="民宿,杭州,周末,去哪玩">
    <meta name="description" content="找到好民宿">
    <title>探庐者-@yield('title')</title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
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
    <nav class="navbar navbar-default">
        <!-- logo -->
        <div class="nav-left">
            <a href="/">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
            </a>
        </div>
        <div class="nav-middle">
            @if(config('casarover.toggle_allcasa'))
            <a href="/allcasa">民宿大全</a>
            @endif
            <a href="/#recom">民宿推荐</a>
            <a href="/#theme">精选主题</a>
            <a href="/#series">探庐系列</a>
        </div>
        <div class="nav-right">
            <a href="">登录</a>
            <a href="">注册</a>
        </div>
    </nav>

    @yield('body')

    <footer>
        <div class="message">
            <div class="pic">
                <img src="{{ asset('assets/images/qcode.jpg') }} " height="100%" alt="二维码">
            </div>
        </div>
        <div class="message">
            <h3>公司</h3>
            <ul>
                <li><a href="/about#about-us">关于我们</a></li>
                <li><a href="/about#media-cooperation">媒体合作</a></li>
            </ul>
        </div>
        <div class="message">
            <h3>服务</h3>
            <ul>
                <li><a href="/about#free-promotion">免费推广</a></li>
                <li><a href="/about#personal-customized">私人定制</a></li>
            </ul>
        </div>
        <div class="message">
            <h3>帮助中心</h3>
            <ul>
                <li><a href="/about#business-cooperation">商务合作</a></li>
                <li><a href="" class="icp">浙ICP备<span>15036536号</span></a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
