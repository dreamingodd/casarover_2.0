@extends('wxBase')
@section('title','我的收藏')
@section('head')
    <link href="/assets/css/wxCollection.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <form action="/wx/collection" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="main">
            <h2>我的收藏</h2>
            <span class="edit">编辑</span>
            <span class="finished">完成</span>
            input value="3"
            @foreach( $casas as $casa)
                <div class="case clear">
                    <div class="check clear">
                        <div class="circle">
                            <div class="glyphicon glyphicon-ok"></div>
                            <input type="hidden" name="casa[{{$casa->wxCasa->id}}]" value="0" class="isdeleted" />
                        </div>
                    </div>
                    <div class="casecon clear">
                        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$casa->wxCasa->thumbnail}}" alt="">
                        <div class="article">
                            <h3>{{$casa->wxCasa->name}}</h3>
                            <p>{{$casa->wxCasa->brief}}</p>
                            <span>￥{{$casa->wxCasa->cheapestPrice}}起</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <input type="submit" class="delete" value="删除(0)" style="box-shadow: none" />
    </form>
        <script>
            function count() {
                i=0;
                $('.circle').each(function () {
                    $(this).find('.isdeleted').val(0);
                });
                $('.circleclick').each(function () {
                    ++i;
                    $(this).find('.isdeleted').val(1);
                });
                $('.delete').val('删除（'+i+'）');
            };
            $(function () {
                $('.edit').click(function () {
                    $(this).hide();
                    $('.finished').show();
                    $('.check').show();
                    $('.delete').show();
                });
                $('.finished').click(function () {
                    $(this).hide();
                    $('.edit').show();
                    $('.check').hide();
                    $('.delete').hide();
                });
                $('.case').click(function () {
                        $(this).find('.circle').toggleClass('circleclick');
                        count();
                        console.log($(this).find('.isdeleted').val());
                });
            });
        </script>
@stop
