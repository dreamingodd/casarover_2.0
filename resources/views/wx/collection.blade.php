@extends('wxBase')
@section('title','我的收藏')
@section('head')
    <link href="/assets/css/wxCollection.css" rel="stylesheet"/>
@stop
@section('body')
    <form action="/wx/collection" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="main">
            {{-- <h2>我的收藏</h2> --}}
            @if(count($casas))
            <div class="title">
            <span class="edit">编辑</span>
            <span class="finished">完成</span>
        </div>
                @foreach( $casas as $casa)
                    <div class="case clear" >
                        <input type="hidden" value="{{$casa->wxCasa->id}}" class="casaId">
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
                                <div class="click" onclick="document.location='casa/{{$casa->wxCasa->id}}'">
                                    进入民宿
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
        <input type="submit" class="delete" value="删除(0)" style="box-shadow: none" />
    </form>
@else
    <p class="noconllection">
        还没有收藏
    </p>
@endif
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
                });
            });
        </script>
@stop
