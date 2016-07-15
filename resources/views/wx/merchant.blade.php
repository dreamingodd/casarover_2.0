@extends('wxBase')
@section('title','商家页面')
@section('head')
@stop
@section('body')
@section('nav')
    <img  src="/assets/images/logow.png" />
@stop
    <div>
        <br/><br/><br/>
        <h4>{{$wxCasa->name}}&nbsp;订单列表(已付款)</h4>
        <table class="table" style="font-size: 11px;">
            <tr>
                <th>订单信息</th>
                <th>订单详情</th>
                <th>状态</th>
            </tr>
            @foreach ($orders as $order)
            <tr>
                <td>
                    {{$order->order->order_id}}<br/>
                    姓名：{{$order->order->user->realname}}<br/>
                    微信名：{{$order->order->user->nickname}}<br/>
                    价格：{{$order->order->total}}
                </td>
                <td>
                    下单时间：<br/>
                    {{$order->order->created_at->format('Y-m-d')}}<br/>
                    @foreach ($order->order->orderItems as $item)
                        {{$item->product->name or '过期订单'}}*{{$item->quantity}}<br/>
                    @endforeach
                </td>
                <td>
                    @if ($order->reserve_status == App\Entity\CasaOrder::RESERVE_STATUS_YES)
                        预约时间：<br/>
                        {{$order->reserve_comment or '未预约'}}<br/>
                    @else
                        {{$reserveStatus[$order->reserve_status]}}<br/>
                    @endif
                    @if ($order->reserve_status == App\Entity\CasaOrder::RESERVE_STATUS_CONSUMED)
                        <a href="/wx/consume_cancel/{{$order->order_id}}"><button class="btn btn-xs">取消</button></a>
                    @else
                        <a href="/wx/consume/{{$order->order_id}}"><button class="btn btn-xs btn-primary">消费</button></a>
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@stop
