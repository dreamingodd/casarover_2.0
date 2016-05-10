@extends('back')

@section('title', '探庐者后台-订单管理')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/wxOrderList.js"></script>
@stop

@section('body')
    <input type="hidden" id="page" value="reserve"/>
    <div id="app">
        <table class="table">
            <thead>
            <tr>
                <th>订单信息</th>
                <th>民宿信息</th>
                <th>买家信息</th>
                <th>付款金额</th>
                <th>
                    预约状态
                    {{--<select class="form-control" v-model="type" v-on:change="getOrder">--}}
                    {{--@foreach($allstatus as $key => $status)--}}
                    {{--<option value="{{ $key }}">{{ $status }}</option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                </th>
            </tr>
            </thead>
            <div id="order-list">
                <tbody>
                <template v-for="order in orders">
                    <tr transition="expand">
                        <th scope="row">
                            <p>订单号：@{{ order.order_id }}</p>
                            <p>微信订单号：@{{ order.wxpay_id }}</p>
                            <p>下单时间：@{{ order.time }}</p>
                            <goodlist :goods="order.goods"></goodlist>
                        </th>
                        <td>@{{ order.casaname }}</td>
                        <td>@{{ order.username }} <br>
                            <p>@{{ order.nickname }}</p>
                            电话：@{{ order.userphone }}</td>
                        <td>@{{ order.total }}</td>
                        <td>
                            <button type="button" class="btn btn-default order-del" v-on:click="del(order.id)">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                            <p>
                                @{{ order.paystatus }} |
                                @{{ order.reserveStatus }} |
                                @{{ order.consumeStatus }}

                            </p>
                            <p>
                                <template v-if="!order.reserve_time">
                                    填写预约时间
                                </template>
                                <form action="/back/wx/changewxordertype"  method="POST">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <input type="hidden" name="orderid" value="@{{ order.id }}">
                            <p class="text-danger">(时间格式是2016年5月6日)</p>
                            <input type="text" class="form-control" id="order-time"  name="message" value="@{{ order.reserve_time }}">
                            <button type="submit" class="btn btn-default" >保存</button>
                            </form>
                            </p>
                        </td>
                    </tr>
                </template>
                </tbody>
            </div>

        </table>
        <nav>
            <ul class="pagination" >
                <template v-for="page in pages">
                    <li><a href="javascript:void(0)"  v-on:click="getOrder(page)">@{{ page }}</a></li>
                </template>
            </ul>
        </nav>
    </div>


    {{--vue组件--}}
    {{--商品信息--}}
    <template id="goodlist">
        <ul class="list-group">
            <template v-for="good in goods">
                <li class="list-group-item">@{{ good.name }}--@{{ good.quantity }}--@{{ good.price }}</li>
            </template>
        </ul>
    </template>
@stop
