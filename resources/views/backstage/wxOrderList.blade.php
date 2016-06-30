@extends('back')

@section('title', '探庐者后台-订单管理')

@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/wxOrderList.js"></script>
    <style type="text/css">
    .list-group-item {
        padding: 4px;
        text-align: center;
    }
    .info-tr ul {
        margin: 5px 0 0 20px;
    }
    </style>
@stop

@section('body')
    <input type="hidden" id="page" value="reserve"/>
    <div id="app">
        <table class="table">
            <tr>
                <th>订单信息</th>
                <th>用户信息</th>
                <th>
                    状态
                    {{--<select class="form-control" v-model="type" v-on:change="getOrder">--}}
                    {{--@foreach($allstatus as $key => $status)--}}
                    {{--<option value="{{ $key }}">{{ $status }}</option>--}}
                    {{--@endforeach--}}
                    {{--</select>--}}
                </th>
            </tr>
            <div id="order-list">
                <tbody>
                <template v-for="order in orders">
                    <tr transition="expand" class="info-tr">
                        <td scope="row">
                            <span style="font-weight:bold;">@{{ order.name }}</span> <br/>
                            订单号：@{{ order.order_id }} &nbsp; | &nbsp;
                            下单时间：@{{ order.time }}<br />
                            微信支付订单号：@{{ order.pay_id }}<br />
                            <goodlist :goods="order.goods"></goodlist>
                        </td>
                        <td>
                            @{{ order.username }} &nbsp; | &nbsp; 微信名： @{{ order.nickname }} <br/>
                            电话：@{{ order.userphone }} <br/>
                            金额：<span style="font-weight:bold; font-size:18px; color:#FF0033">@{{ order.total }}元</span>
                        </td>
                        <td>
                            {{--<button type="button" class="btn btn-default order-del" v-on:click="del(order.id)">--}}
                                {{--<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>--}}
                            {{--</button>--}}
                                <span v-if="order.paystatus == '已付款'" style="color:#33CC66; font-weight:bold;">@{{ order.paystatus }}</span>
                                <span v-else>@{{ order.paystatus }}</span>
                                |
                                <span v-if="order.reserveStatus == '已预约'" style="color:#33CC66; font-weight:bold;">@{{ order.reserveStatus }}</span>
                                <span v-else>@{{ order.reserveStatus }}</span>
                            <br />
                            <template v-if="order.type=={{\App\Entity\Order::TYPE_CASA}}">
                                <template v-if="!order.reserveComment">
                                    填写预约时间
                                    <p class="text-danger">(时间格式是2016年5月6日)</p>
                                </template>
                                <template v-else>
                                    预约时间:
                                </template>
                                <form action="/back/wx/changewxordertype"  method="POST">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <input type="hidden" name="orderid" value="@{{ order.id }}">
                                    <input type="text" class="" id="order-time"  name="message" value="@{{ order.reserveComment }}">
                                    <button type="submit" class="btn btn-default btn-xs">保存</button>
                                </form>
                            </template>
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
                <li class="">@{{ good.name }}--@{{ good.quantity }}--@{{ good.price }}</li>
            </template>
        </ul>
    </template>
@stop
