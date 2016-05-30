@extends('wxBase')
@section('title','订单详情')
@section('head')
    <link href="/assets/css/wxOrderDetail.css" rel="stylesheet"/>
@stop
@section('nav')
<a href="/wx/user" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
<a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
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
        @if (!empty($order->wxScoreVariation->score))
            <p style="text-align: right;">
                订单总额：{{$order->total - ($order->wxScoreVariation->score * 0.1)}}元<br/>
                积分抵扣：{{$order->wxScoreVariation->score * 0.1}}元
            </p>
        @endif
        <p style="width: 99%; text-align: right;">订单实付：<i style="font-size: 3rem; color: #800;">{{$order->total}}元</i></p>
        <p>下单时间：{{$order->created_at}}</p>
        @if (empty($order->reserve_time))
            <p style="color:red;">点击右上角电话预约</p>
        @else
            <p>预约信息：{{$order->reserve_time}}</p>
        @endif
    </div>
    <br/>
    @if ($order->consume_status == 0 && $order->pay_status == 1)
        <div style="width: 240px; margin: 0 auto;">
            <p>&nbsp;消费时展示此二维码</p>
            <img src="{{$qrPath}}" style="width:100%;"/>
        </div>
    @endif
@stop
