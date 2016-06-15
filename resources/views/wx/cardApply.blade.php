@extends('wxBase')
@section('title','申请记录')
@section('head')
    <link href="/assets/css/cardApply.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx/user" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main">
        <h2>申请记录</h2>
        <div class="case clear" >
            <input type="hidden" value="" class="casaId">
            <div class="info">
                <p>申请人姓名：小红</p>
                <p>电话号码：12345678901</p>
            </div>
            <div class="casecon clear">
                <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_20160518-163558-932r9132.jpg"" alt="">
                <div class="article">
                    <h3>梅皋巫山居</h3>
                    <div class="articlecon">
                        <p>备注:我是你表姐</p>
                        <span>申请间数: <i>3</i></span>
                        <div class="click">
                            回复
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
    </script>
@stop
