<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="民宿,杭州,周末,去哪玩">
    <meta name="description" content="找到好民宿">
    <title>探庐者-民宿</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/casaseries.css">
    <script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="../assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
    <script src="../assets/js/home.js" type="text/javascript"></script>
    <script src="../assets/casaseries.js" type="text/javascript"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-default">
        <!-- logo -->
        <div class="nav-left">
            <a href="#">
                <img src="../assets/images/logo.png" alt="logo">
            </a>
        </div>
        <ul class="nav-middle">
            <li><a href="">民宿大全</a></li>
            <li><a href="#recom">民宿推荐</a></li>
            <li><a href="#theme">精选主题</a></li>
            <li><a href="#series">探庐系列<span class="caret"></span></a>
                @foreach($series as $serie)
                <dl>
                    <dd><a href="#">{{$serie->name}}</a>
                    </dd>
                </dl>
                @endforeach
            </li>
        </ul>
        <div class="nav-right">
            <a href=""></a>
            <a href="">登录</a>
            <a href="">注册</a>
        </div>
    </nav>
</header>
<section class='tanlu'>
    <div class='tanlutop'>
        <h2>探庐·临安</h2>
        <p>临安介绍 xxxxxxxxxxxxxxxxxxxxxxxxx</p>
    </div>
    @foreach($articles as $article)
    <div id="list" class="article_list">
        <a href="#">
            <div class="article">
                <div class="left">
                    @foreach($attachments as $attachment)
                        @if($attachment->id==$article->attachment_id)
                        <?php $attachmentpath=$attachment->filepath;break;?>
                        @endif
                    @endforeach
                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$attachmentpath}}"/>
                </div>
                <div class="right">
                    <span class="title">{{$article->title}}</span>
                    <br/>
                    <span class="content">{{$article->brief}}</span>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</section>
<footer>
    <div class="message">
        <div class="pic">
            <img src="../assets/images/qcode.jpg" height="100%" alt="二维码">
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
