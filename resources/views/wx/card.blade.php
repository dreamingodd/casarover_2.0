@extends('wxBase')
@section('title','我的度假卡')
@section('head')
    <link href="/assets/css/card.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx/user" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
        <div class="main">
            <h2>我的度假卡</h2>
            {{--foreach--}}
                <div class="case clear" >
                    <input type="hidden" value="" class="casaId">
                    <div class="casecon clear">
                        <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_20160518-163558-932r9132.jpg"" alt="">
                        <div class="article">
                            <h3>梅皋巫山居</h3>
                            <img src="/assets/images/sign.png" alt="" >
                                <div class="articlecon">
                                    <p>湖州-德州-莫干山镇</p>
                                    <p>截至日期:2017年6月1日</p>
                                    <span>我的剩余间数：<i>3</i></span>
                                    <div class="click" onclick="document.location='/wx/user/cardBook'">
                                        预&nbsp;&nbsp;约
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <script>
    </script>
@stop
