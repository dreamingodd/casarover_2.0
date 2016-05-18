@extends('wxBase')
@section('title','订单详情')
@section('head')
    <link href="/assets/css/wxOrderDetail.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx/user" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:15868102935" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main clear">
        <h2>
            {{$order->casa_name}}
        </h2>
        <h3>订单编号：{{$order->order_id}}</h3>
        <table class="table table-hover">
            <tr>
                <th>房间型号</th>
                <th>数量</th>
                <th>价格</th>
            </tr>
            @foreach ($order->wxOrderItems as $item)
            <tr>
                <td>{{$item->wxRoom->name}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->price}}</td>
            </tr>
            @endforeach
        </table>
        <h4>订单总额：<i>{{$order->total}}元</i></h4>
        <h5 style="float:left;">下单时间：<span>{{$order->created_at}}</span></h5>
    </div>
    <br/>
    @if ($order->consume_status == 0 && $order->pay_status == 1)
        <div style="width: 240px; margin: 0 auto;">
            <p>&nbsp;消费时展示此二维码</p>
            <img src="{{$qrPath}}" style="width:100%;"/>
        </div>
    @endif
@stop
