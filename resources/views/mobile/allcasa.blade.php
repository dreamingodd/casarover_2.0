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
            <div class="left">
                <h3>当前选择</h3>
            </div>
            <div class="right">
                <h3 id="close">完成</h3>
            </div>
            <div class="line"></div>
            <span id="city_checked"></span>
            <span id="area_checked"></span>
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
                        <a onclick="selarea(this)" v-on:click="selarea(this)">@{{ area.value }}</a>
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
                                <a href="/mobile/area/{{ $area->id }}"  class="slide-a">
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
                            <a href="/mobile/casa/@{{ casa.id }}">
                                <img :src="casa.pic" width="100%" alt="@{{ casa.pic }}">
                                <h3>@{{ casa.name }}</h3>
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
        function selarea(obj){
            var selareaStr = obj.text;
            $('#area_checked').html(selareaStr);
            $('.main').show();
            $('.navbartop').show();
            $('footer').show();
            $('.city').hide();
        }
        $(function($){
            $('#city_checked').html($('#active').html());
            $('.casa a').click(function () {
                $('#area_checked').css('display','none');
                $('.casa a').removeAttr('id');
                $(this).attr('id','active');
                $('#city_checked').html($('#active').html());
                $('#area_checked').html('');
            });

            $('#tm').click(function () {
                $('#area_checked').css('display','none');
                var pandun = $('#area_checked').text();
                if(pandun !== ''){
                    $('#area_checked').css('display','inline-block');
                }
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
@stop