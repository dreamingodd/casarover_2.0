@extends('wxBase')
@section('title','订单详情')
@section('head')
    <link href="/assets/css/wxOrderDetail.css" rel="stylesheet"/>
@stop
@section('body')
    @section('nav')
        <a href="/wx/user" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
        <a href="tel:15868102935" id="navright" class="glyphicon glyphicon-earphone"></a>
        <img  src="/assets/images/logow.png" />
    @stop
    <div class="main clear">
        <h2>民宿: 法云安居</h2>
        <h3>订单编号：1234567</h3>
        <table class="table table-hover">
            <tr>
                <th>房间型号</th>
                <th>数量</th>
                <th>总价</th>
            </tr>
            <tr>
                <td>123</td>
                <td>123</td>
                <td>123</td>
            </tr>
            <tr>
                <td>123</td>
                <td>123</td>
                <td>123</td>
            </tr>
            <tr>
                <td>123</td>
                <td>123</td>
                <td>123</td>
            </tr>
            </table>
        <h4>订单总额：<i>998元</i></h4>
        <h5>下单时间：<span>2016年5月1日16点12分</span></h5>
    </div>
@stop
