<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="民宿,杭州,周末,去哪玩">
    <meta name="description" content="探庐者民宿让你找到好民宿">
    <title>探庐者-@yield('title')</title>
    <link rel="stylesheet" href="/assets/css/common.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/component.css" />
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
                <img src="/assets/images/logo.png" alt="logo">
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
            <a href="#" class="md-trigger" data-modal="modal-1">登录</a>
            <a href="#">注册</a>
        </div>
    </nav>
    <div class="md-modal md-effect-1" id="modal-1">
        <div class="md-content">
            <div class="left">
                <h3>登陆</h3>
                <p>探庐者帮你探寻远方的家</p>
                <form action="" method="post">
                    <div class="tel">
                        <label for="tel"></label>
                        <input type="tel" name="tel" placeholder="手机号">
                    </div>
                    <div class="password">
                        <label for="password"></label>
                        <input type="password" name="password" placeholder="密码" >
                    </div>
                    <input type="submit" value="登陆" id="submit">
                    <div class="checkbox">
                        <input type="checkbox" id="checkbox">
                        <span>自动登陆</span>
                    </div>
                    <div class="forget">
                        <a href="#">忘记密码?</a>
                    </div>
                </form>
            </div>
            <div class="right">
                <div class="md-close"></div>
                    <p>合作网站账号登陆</p>
                <a href=""><img src="/assets/images/qq.png" alt=""></a>
                <a href=""><img src="/assets/images/wechat.png" alt=""></a>
                <p id="noyet">还没有注册？<span>注册账号＞＞</span></p>
            </div>

            {{--<h3>Modal Dialog</h3>--}}
            {{--<div>--}}
                {{--<p>This is a modal window. You can do the following things with it:</p>--}}
                {{--<ul>--}}
                    {{--<li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to read what they say.</li>--}}
                    {{--<li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and appreciate its presence.</li>--}}
                    {{--<li><strong>Close:</strong> click on the button below to close the modal.</li>--}}
                {{--</ul>--}}
                {{--<button class="md-close">Close me!</button>--}}
            {{--</div>--}}
        </div>
        {{--<div class="md-content">--}}
            {{--<div class="left">--}}
                {{--<h3>登陆</h3>--}}
                {{--<p>探庐者帮你探寻远方的家</p>--}}
                {{--<form action="" method="post">--}}
                    {{--<div class="tel">--}}
                        {{--<label for="tel"></label>--}}
                        {{--<input type="tel" name="tel" placeholder="手机号">--}}
                    {{--</div>--}}
                    {{--<div class="password">--}}
                        {{--<label for="password"></label>--}}
                        {{--<input type="password" name="password" placeholder="密码" >--}}
                    {{--</div>--}}
                    {{--<input type="submit" value="登陆" id="submit">--}}
                    {{--<div class="checkbox">--}}
                        {{--<input type="checkbox" id="checkbox">--}}
                        {{--<span>自动登陆</span>--}}
                    {{--</div>--}}
                    {{--<div class="forget">--}}
                        {{--<a href="#">忘记密码?</a>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
            {{--<div class="right">--}}
                {{--<div class="md-close"></div>--}}
                {{--<p>合作网站账号登陆</p>--}}
                {{--<a href=""><img src="/assets/images/qq.png" alt=""></a>--}}
                {{--<a href=""><img src="/assets/images/wechat.png" alt=""></a>--}}
                {{--<p id="noyet">还没有注册？<span>注册账号＞＞</span></p>--}}
            {{--</div>--}}

            {{--<h3>Modal Dialog</h3>--}}
            {{--<div>--}}
            {{--<p>This is a modal window. You can do the following things with it:</p>--}}
            {{--<ul>--}}
            {{--<li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to read what they say.</li>--}}
            {{--<li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and appreciate its presence.</li>--}}
            {{--<li><strong>Close:</strong> click on the button below to close the modal.</li>--}}
            {{--</ul>--}}
            {{--<button class="md-close">Close me!</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    <div class="md-overlay"></div>
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
                <li><a href="/about#brand-culture">品牌文化</a></li>
                <li><a href="/about#media-cooperation">媒体合作</a></li>
            </ul>
        </div>
        <div class="message">
            <h3>服务</h3>
            <ul>
                <li><a href="/about#charge-standard">合作推广</a></li>
                <li><a href="/about#personal-customized">私人定制</a></li>
            </ul>
        </div>
        <div class="message">
            <h3>帮助中心</h3>
            <ul>
                <li><a href="/about#contact">联系我们</a></li>
                <li><a href="/about#business-cooperation">商务合作</a></li>
                <li><a href="" class="icp">浙ICP备<span>15036536号</span></a></li>
            </ul>
        </div>
    </footer>
    <script src="/assets/js/classie.js"></script>
    <script src="/assets/js/modalEffects.js"></script>
</body>
</html>
