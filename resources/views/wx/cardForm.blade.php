@extends('wxBase')
@section('title','填写信息')
@section('head')
    <link href="/assets/css/cardForm.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx/user" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main">
        <h2>填写信息</h2>
        <h4>填写您的身份信息向小明提出申请</h4>
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
                        <span>预订间数：<i>3</i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="#" method="post">
        <div class="input">
            <label for="name">*姓名</label>
            <input type="text" name="name" id="name">
        </div>
        <div class="input">
            <label for="tel">*手机号码</label>
            <input type="text" name="tel" id="tel">
        </div>
        <div class="input">
            <label for="remark">备注</label>
            <input type="text" name="remark" id="remark">
        </div>
        <input class="sub" type="submit" value="提交申请" />
    </form>
    <script>
    </script>
@stop
