@extends('wxBase')
@section('title','申请记录')
@section('head')
    <link href="/assets/css/cardBill.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx/user" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main">
        <h2>确认订单</h2>
        <div class="maincon">
            <div class="maintop">
                <h3>预订成功</h3>
                <p></p>
            </div>
            <div class="mainmid">
                <p>梅皋坞山居</p>
                <p>预定人 ：小新</p>
                <p>联系电话：1909870990</p>
                <p>备注：我是你表姐</p>
                <img src="/assets/images/cs.png" alt="">
            </div>
            <div class="mainbottom">
                <p>订单号：1324343434</p>
                <p>民宿地址：德清县紫岭村79号</p>
                <p>房间型号：标准间周末房</p>
                <p>房间数：1</p>
                <p>创建时间：2016-09-08 17:09</p>
                <p>（请提前15天或一周进行电话预定）</p>
            </div>
        </div>
    </div>
    <script>
    </script>
@stop
