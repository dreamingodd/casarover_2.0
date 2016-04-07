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
            <a href="/#daquan">民宿大全</a>
            <a href="/#recom">民宿推荐</a>
            <a href="/#theme">精选主题</a>
            <a href="/#series">探庐系列</a>
        </div>
        <div class="nav-right">
            <a href=""></a>
            <a href="">登录</a>
            <a href="">注册</a>
        </div>
    </nav>

    @yield('body');

    <footer>
        <div class="message">
            <div class="pic">
                <img src="{{ asset('assets/images/qcode.jpg') }} " height="100%" alt="二维码">
            </div>
        </div>
        <div class="message">
            <h3>公司</h3>
            <ul>
                <li><a href="">关于我们</a></li>
                <li><a href="">媒体合作</a></li>
            </ul>
        </div>
        <div class="message">
            <h3>服务</h3>
            <ul>
                <li><a href="">免费推荐</a></li>
                <li><a href="">私人定制</a></li>
                <li><a href="">团队客户</a></li>
            </ul>
        </div>
        <div class="message">
            <h3>帮助中心</h3>
            <ul>
                <li><a href="">商务合作</a></li>
            </ul>
        </div>
        <p>浙ICP备<span>15036536号</span></p>
    </footer>
</body>
</html>
