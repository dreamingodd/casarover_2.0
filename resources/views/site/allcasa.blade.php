@extends('site')
@section('title','民宿')
@section('head')
    <link rel="stylesheet" href="/assets/css/allcasa.css">
    <script src="{{ asset('assets/js/integration/jquery.flexslider-min.js') }}" type="text/javascript"></script>
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="{{ asset('assets/js/home.js') }}" type="text/javascript"></script>
    <script src="/assets/js/allcasa.js" type="text/javascript"></script>
@endsection
@section('body')
    <div class="flexslider">
        <ul class="slides">
                <li style="background:url('/assets/images/aboutus.jpg'); background-size:100% 100%;">
                    <a href="" target="_blank" class="slide-a">
                        <div class="slide-mess">一座山</div>
                    </a>
                </li>
            <li style="background:url('/assets/images/aboutus.jpg'); background-size:100% 100%;">
                <a href="" target="_blank" class="slide-a">
                    <div class="slide-mess">一片海</div>
                </a>
            </li>
        </ul>
    </div>
    <div class="all">
        <div class="main">
            <div class="screen">
                <div class="case">
                    <p>城市<a href="javascript:void(0)" class='show'>显示全部</a></p>
                    <ul class="casa">
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                        <li><a>杭州</a></li>
                    </ul>
                </div>
            </div>
            <div class="screen">
                <div class="case">
                    <p>区域<a href="javascript:void(0)" class='show'>显示全部</a></p>
                    <ul class="casas">
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                        <li><a>临安</a></li>
                    </ul>
                </div>
            </div>
                <a href="javascript:void(0)" class="right-float-top" id="toTop" >返回顶部</a>
                <a href="javascript:void(0)" class="right-float-middle" id="advice">意见反馈</a>
                <a href="javascript:void(0)" class="right-float-bottom" id="qrcode"></a>
        </div>
        <section>
            <div class="loader">
                <div class="loader-inner line-scale">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            <div class="card">
                <img src="/assets/images/test/1.png" alt="">
                <h3>法云安曼精品宿舍</h3>
                <p>地址：西湖区灵隐支路白乐桥246号</p>
                <p>标签：</p>
                <ul>
                    <li>小清新</li>
                    <li>小清新</li>
                    <li>小清新</li>
                    <li>小清新</li>
                    <li>小清新</li>
                    <li>小清新</li>
                    <li>小清新</li>
                    <li>小清新</li>
                </ul>
            </div>
            <div class="card">
                <img src="/assets/images/test/1.png" alt="">
                <h3>法云安曼精品宿舍</h3>
                <p>地址：西湖区灵隐支路白乐桥246号</p>
                <p>标签：</p>
                <ul>
                    <li>小清新</li>
                    <li>小清新</li>
                    <li>小清新</li>
                </ul>
            </div>
            <div class="card">
                <img src="/assets/images/test/1.png" alt="">
                <h3>法云安曼精品宿舍</h3>
                <p>地址：西湖区灵隐支路白乐桥246号</p>
                <p>标签：</p>
                <ul>
                    <li>小清新</li>
                    <li>小清新</li>
                    <li>小清新</li>
                </ul>
            </div>
            <div class="card">
                <img src="/assets/images/test/1.png" alt="">
                <h3>法云安曼精品宿舍</h3>
                <p>地址：西湖区灵隐支路白乐桥246号</p>
                <p>标签：</p>
                <ul>
                    <li>小清新</li>
                    <li>小清新</li>
                    <li>小清新</li>
                </ul>
            </div>
        </section>
    </div>
@endsection