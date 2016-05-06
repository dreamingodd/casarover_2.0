@extends('back')

@section('title', '探庐者后台-订单管理')

@section('head')
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/wxOrderList.js"></script>
@stop

@section('body')

    <table class="table" id="app">
        <thead>
        <tr>
            <th>订单信息</th>
            <th>民宿信息</th>
            <th>买家信息</th>
            <th>付款金额</th>
            <th>
                <select class="form-control" v-model="type" v-on:change="getOrder">
                    @foreach($allstatus as $key => $status)
                        <option value="{{ $key }}">{{ $status }}</option>
                    @endforeach
                </select>
            </th>
        </tr>
        </thead>
        <tbody>
        <template v-for="order in orders">
            <tr>
                <th scope="row">
                    <p>订单号：@{{ order.order_id }}</p>
                    <p>微信订单号：@{{ order.wxpay_id }}</p>
                    <p>时间：@{{ order.time }}</p>
                    <goodlist :goods="order.goods"></goodlist>
                </th>
                <td>@{{ order.casaname }}</td>
                <td>@{{ order.username }} <br> 电话：@{{ order.userphone }}</td>
                <td>@{{ order.total }}</td>
                <td>@{{ order.paystatus }}</td>
            </tr>
        </template>
        </tbody>
    </table>
    {{--vue组件--}}
    {{--商品信息--}}
    <template id="goodlist">
        <ul class="list-group">
            <template v-for="good in goods">
                <li class="list-group-item">@{{ good.name }}--@{{ good.price }}</li>
            </template>
        </ul>
    </template>
@stop
