<!doctype html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
<title>探庐者</title>
<link href="//cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
<script src="//cdn.bootcss.com/jquery/2.1.2/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/js/integration/jquery.flexslider-min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/wechat_index.js') }}"></script>
</head>
<body>
<div class="wechat_container">

    <!-- Navigator Starts. -->
    <div class="flexslider">
        <ul class="slides">
            <li onclick="goto_link1()"
                    style="background:url('http://casarover.oss-cn-hangzhou.aliyuncs.com/tmp/banner-01.jpg') ; background-size:100% 100%; "></li>
            <li onclick="goto_link2()"
                    style="background:url('http://casarover.oss-cn-hangzhou.aliyuncs.com/tmp/banner-02.jpg') ; background-size:100% 100%; "></li>
        </ul>
    </div>
    <div class="navbar">
        <div class="navbar-inner">
            <ul class="nav nav-justified">
                <li role="presentation" class="scenery nav_one">
                    <a href="/wechat/2">民宿风采</a>
                </li>
                <li role="presentation" class="series dropdown nav_one">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">探庐系列<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        @foreach ($wechatSeries as $series)
                            <li><a href="/wechat/1/{{$series->id}}">
                                {{$series->name}}
                            </a></li>
                        @endforeach
                    </ul>
                </li>
                <li role="presentation" class="theme nav_one">
                    <a href="/wechat/3">主题民宿</a>
                </li>
                <!-- add back after OSS is installed.
                <li role="presentation" class="nav_one">
                    <a href="/">探庐驿站</a>
                </li>
                 -->
            </ul>
        </div>
    </div>
    <input type="hidden" id="type" value="{{$wechatArticles->first()!=null?$wechatArticles->first()->type:1}}"/>
    <!-- Navigator Ends. -->

    <div id="list" class="article_list">
        @foreach ($wechatArticles as $article)
            <a href="{{$article->address}}">
                <div class="article clearfix">
                    <div class="left">
                        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$article->attachment->filepath}}"/>
                    </div>
                    <div class="right">
                        <span class="title">{{$article->title}}</span>
                        <br/>
                        <span class="content">{{$article->brief}}</span>
                    </div>
                </div>
            </a>
            <hr/>
        @endforeach
    </div>
</div>
</body>
</html>
