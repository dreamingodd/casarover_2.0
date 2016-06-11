@extends('wxBase')
@section('title','商家页面')
@section('head')
<?php use App\Entity\Wx\WxOrder; ?>
@stop
@section('body')
@section('nav')
    <img  src="/assets/images/logow.png" />
@stop
    <div>
        <br/><br/><br/>
        <h4>{{$wxCasa->name}}&nbsp;订单列表</h4>
        <table class="table" style="font-size: 11px;">
            <tr>
                <th>订单信息</th>
                <th>订单详情</th>
                <th>状态</th>
            </tr>
            @foreach ($orders as $order)
            <tr>
                <td>
                    {{$order->order_id}}<br/>
                    姓名：{{$order->user->realname}}<br/>
                    微信名：{{$order->user->nickname}}<br/>
                    价格：{{$order->total}}
                </td>
                <td>
                    下单时间：<br/>
                    {{$order->created_at->format('Y-m-d')}}<br/>
                    @foreach ($order->wxOrderItems as $item)
                        {{$item->wxRoom->name}}*{{$item->quantity}}<br/>
                    @endforeach
                </td>
                <td>
                    @if ($order->reserve_status == WxOrder::RESERVE_STATUS_YES)
                        预约时间：<br/>
                        {{$order->reserve_time or '未预约'}}<br/>
                    @else
                        {{$reserveStatus[$order->reserve_status]}}<br/>
                    @endif
                    {{$consumeStatus[$order->consume_status]}}
                    @if ($order->consume_status == WxOrder::RESERVE_STATUS_YES)
                        <a href="/wx/consume_cancel/{{$order->id}}"><button class="btn btn-xs">取消</button></a>
                    @else
                        <a href="/wx/consume/{{$order->id}}"><button class="btn btn-xs btn-primary">消费</button></a>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@stop
