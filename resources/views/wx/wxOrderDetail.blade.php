@extends('wxSecond')
@section('title','订单详情')
@section('head')
    <link href="/assets/css/wxOrderDetail.css" rel="stylesheet"/>
@stop
@section('rightNav')
    <a href="tel:{{ $orderPhone }}">
        <img src="/assets/images/header/phone.png" height="100%" alt="" />
    </a>
@endsection
@section('body')
    {{-- 这个是订单详细信息页面
    目前有三种订单详细页面
    1、预订民宿订单，显示民宿的基本信息和订单包含的信息，这时候显示的预订电话是配置文件中的号码
    2、是度假卡订单，显示的内容和上面的基本一致
    3、消费度假卡订单，显示内容不同的地方是，订单金额显示为度假卡消费，应该显示一下消费的卡号是多少，这时候的预订电话是民宿主人的预订电话 --}}

    {{-- nornal casa order --}}
    @if($order->type == \App\Entity\Order::TYPE_CASA)
        <div class="main">
            @if ((empty($order->casaOrder->reserve_comment)))
                <p class="call-me">
                    请尽快电话预约
                </p>
            @endif
            <h2>
                {{$order->name}}
            </h2>
            <h3>订单编号：{{$order->order_id}}</h3>
            <table class="table table-hover">
                <tr class="goods-nav">
                    <th>商品</th>
                    <th>数量</th>
                    <th>价格</th>
                </tr>
                @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price}}</td>
                </tr>
                @endforeach
            </table>
            @if (!empty($order->casaOrder->wxScoreVariation->score))
                <p style="text-align: right;">
                    订单总额：{{$order->total - ($order->casaOrder->wxScoreVariation->score * 0.1)}}元<br/>
                    积分抵扣：{{$order->casaOrder->wxScoreVariation->score * 0.1}}元
                </p>
            @endif
            <p class="order-pay">订单实付：<i>{{$order->total}}元</i></p>
            <p>下单时间：{{$order->created_at}}</p>
                @if (($order->casaOrder->reserve_comment))
                    <p>预约信息：{{$order->casaOrder->reserve_comment}}</p>
                @endif
        </div>
            <br/>
            @if ($order->reserve_status != \App\Entity\CasaOrder::RESERVE_STATUS_CONSUMED && $order->status == 1)
                <div class="qrcode">
                    <p>消费时展示此二维码</p>
                    <img src="{{$qrPath}}" style="width:100%;"/>
                </div>
            @endif
    {{-- buy vacation card order --}}
    @elseif($order->type == \App\Entity\Order::TYPE_VACATION_CARD)
        <div class="main">
            <h2>
                {{$order->name}}
            </h2>
            <h3>订单编号：{{$order->order_id}}</h3>
            <table class="table table-hover">
                <tr class="goods-nav">
                    <th>商品</th>
                    <th>数量</th>
                    <th>价格</th>
                </tr>
                @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price}}</td>
                </tr>
                @endforeach
            </table>
            {{-- can not use score for buy vacationcard --}}
            {{-- @if (!empty($order->casaOrder->wxScoreVariation->score))
                <p style="text-align: right;">
                    订单总额：{{$order->total - ($order->casaOrder->wxScoreVariation->score * 0.1)}}元<br/>
                    积分抵扣：{{$order->casaOrder->wxScoreVariation->score * 0.1}}元
                </p>
            @endif --}}
            <p class="order-pay">订单实付：<i>{{$order->total}}元</i></p>
            <p>下单时间：{{$order->created_at}}</p>
        </div>
            <br/>
    @endif

@stop
