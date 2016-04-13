@extends('site')
@section('title','民宿')
@section('head')
    <link rel="stylesheet" href="/assets/css/home.css">
    <link rel="stylesheet" href="/assets/css/allcasa.css">
    <script src="{{ asset('assets/js/integration/jquery.flexslider-min.js') }}" type="text/javascript"></script>
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="{{ asset('assets/js/home.js') }}" type="text/javascript"></script>
@endsection
@section('body')
    <div class="flexslider">
        <ul class="slides">
                <li style="background:url('/assets/images/head.png'); background-size:100% 100%;">
                    <a href="" target="_blank" class="slide-a">
                        <div class="slide-mess">一座山</div>
                    </a>
                </li>
            <li style="background:url('/assets/images/head2.png'); background-size:100% 100%;">
                <a href="" target="_blank" class="slide-a">
                    <div class="slide-mess">一片海</div>
                </a>
            </li>
        </ul>
    </div>
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
        <section id="series">
            <h2>民宿大全</h2>
            <div class="line"></div>
            <div class="casa-card" v-for="serie in series">
                <div class="card-b">
                    <a href="" target="_blank">
                        <img src="" height="100%">
                        <div class="card">
                            <h3></h3>
                        </div>
                        <div class="info">
                            <div class="middle">
                                <h3></h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <a href="javascript:void(0)" class="returntop">
            <span class="caret"></span>
        </a>
    </div>
    <script>
       //        显示收起标签
        $(function ($)
        {
            $('.show').click (function ()
            {
                if($(this).html()=='显示全部'){
                    $(this).html('收起');
                    $(this).parent().next().css('overflow','visible');
                }
                else {
                    $(this).html('显示全部');
                    $(this).parent().next().css('overflow','hidden');
                }
            });
            $('.casa a').click(function () {
                $('.casa a').removeClass();
                $(this).addClass('active');
            })
            $('.casas a').click(function () {
                $('.casas a').removeClass();
                $(this).addClass('active');
            })
        });
        //        回到头部
        $('.returntop').click(function () {
            $(document.body).animate({scrollTop: 0}, 800);
            $('.returntop').animate({opacity: 0}, 500);
            return false;
            });
       //        滚轮事件
        $(document).on("mousewheel DOMMouseScroll", function (e) {
            var delta = (e.originalEvent.wheelDelta && (e.originalEvent.wheelDelta > 0 ? 1 : -1)) ||  // chrome & ie
                    (e.originalEvent.detail && (e.originalEvent.detail > 0 ? -1 : 1));              // firefox
            console.log(delta);
            if (delta > 0) {
                // 向上滚
                console.log("wheelup");
            } else if (delta < 0) {
                // 向下滚
                console.log("wheeldown");
                $('.returntop').animate({opacity: 1}, 500);
            }
        });
    </script>
@endsection