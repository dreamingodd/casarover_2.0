@extends('mobile')
@section('title','民宿大全')
@section('head')
    <link rel="stylesheet" href="/assets/css/mobileAllcasa.css">
    <script src="/assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/allcasa.js" type="text/javascript"></script>
@endsection
@section('body')
    <div id="app">
        <div class="city clear" >
            <b id="close">完成</b>
            <h3>当前选择</h3>
            <div class="line"></div>
            <span id="city_checked"></span>
            <span id="area_checked">白乐桥</span>
            <h3>选择城市</h3>
            <div class="line"></div>
            <ul class="casa clear">
                @foreach($citys as $city)
                    <li><a  v-on:click="selcity({{ $city->id }})"
                            @if($city->id == $sel)
                            id="active"
                                @endif
                        >{{ $city->value }}</a></li>
                @endforeach
            </ul>
            <h3>选择区域</h3>
            <div class="line"></div>
            <ul class="area">
                <template v-for="area in areas">
                    <li >
                        <a v-on:click="selarea(this)">@{{ area.value }}</a>
                    </li>
                </template>
            </ul>
        </div>
        <div class="main clear" >
            <div class="flexslider">
                <ul class="slides">
                    @foreach($areas as $area)
                        @if(!empty($area->contents[1]->attachments[0]))
                            <li style="background:url({{ config('casarover.oss_external').'/area/'.$area->contents[1]->attachments[0]->filepath }}); background-size:100% 100%;">
                                <a href="/area/{{ $area->id }}" target="_blank" class="slide-a">
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="content">
                <label id="tm">选择城市</label>
                <section id="casa-list">
                    <template v-for="casa in casas" block transition="expand">
                        <div class="card">
                            <a href="/casa/@{{ casa.id }}" target="_blank">
                                <img :src="casa.pic" width="100%" alt="@{{ casa.pic }}">
                                <h3>@{{ casa.name }}</h3>
                                {{--<p>地址：西湖区灵隐支路白乐桥246号</p>--}}
                                <p>标签：
                                    <span class="tip">@{{ casa.tip }}</span>
                                </p>
                            </a>
                        </div>
                    </template>
                    <div class="loader" style="display: none">
                        <div class="loader-inner line-scale">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                    <div class="no-more">
                        没有更多了
                    </div>
                </section>
            </div>
        </div>


    </div>
    <script>
        $(function($){
            $('#city_checked').html($('#active').html());
            $('.casa a').click(function () {
                $('.casa a').removeAttr('id');
                $(this).attr('id','active');
                $('#city_checked').html($('#active').html());
            });
            $('.area a').click(function () {
                $('.area a').removeAttr('id');
                $(this).attr('id','actived');
                $('#area_checked').html($('#actived').html());
            });
            $('#tm').click(function () {
                $('.main').hide();
                $('.navbartop').hide();
                $('footer').hide();
                $('.city').show();
            });
            $('#close').click(function () {
                $('.main').show();
                $('.navbartop').show();
                $('footer').show();
                $('.city').hide();
            });
        });
    </script>
    </script>
@stop