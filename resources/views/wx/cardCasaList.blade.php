@extends('wxBase')
@section('title','购买度假卡')
@section('head')
    <link href="/assets/css/cardCasaList.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx/user" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main">
        <h2>购买度假卡</h2>
        <div class="all">
            @foreach($casas as $casa)
                <div class="casa">
                    <div class="left">
                        <div class="circle">
                            <div class="glyphicon glyphicon-ok"></div>
                            {{--                    <input type="hidden" name="casa[{{$casa->wxCasa->id}}]" value="0" class="isdeleted" />--}}
                        </div>
                    </div>
                    <div class="right">
                        <div class="title">
                            <a href="">
                                <h3>{{ $casa->name }} <span class="glyphicon glyphicon-menu-right"></span> </h3>
                            </a>
                        </div>
                        <div class="message">
                            <div class="head-img">
                                <a href="">
                                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$casa->img->filepath}}" width="100%" alt="">
                                </a>
                            </div>
                            <div class="sel-mess">
                                <div style="text-decoration:line-through" class="orig">原价：{{ $casa->stock->orig }}</div>
                                <div class="price">价格：{{ $casa->price }}</div>
                                <div class="num">
                                    <span  class="glyphicon glyphicon-minus"></span>
                                    <span class="get-num">3</span>
                                    <span class="glyphicon glyphicon-plus"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="buttom-buy">
            <div class="total">总计：</div>
            <a href="">
                <div class="buy">
                    <h2>购买</h2>
                </div>
            </a>
        </div>
    </div>
    <script>
    </script>
@stop
