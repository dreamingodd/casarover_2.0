@extends('wxBase')
@section('title','民宿预订')
@section('head')
<link href="/assets/css/wxOrder.css" rel="stylesheet"/>
<script src="/assets/js/integration/json2.js"></script>
<script src="/assets/js/wxBase.js"></script>
<script src="/assets/js/wxOrder.js"></script>
@stop
@section('body')
    <p class="title">
        <span class="glyphicon glyphicon-th-list"></span>套餐／房间选择
        <a href="/wx/casa/{{$wxCasa->id}}"  class="glyphicon glyphicon-remove"></a>
    </p>
    @foreach ($wxCasa->rooms as $room)
        <div class="room" db_id="{{$room->id}}">
            <div class="detail">
                <span><em></em></span>
                <b class="room_name">{{$room->name}}</b>
                <u class="price">￥{{$room->price}}</u>
            </div>
            <div class="quantity">
                <div class="count">
                    <span>预订<i class="room_quantity">1</i>间<span>
                    <a class="reduce glyphicon glyphicon-minus"></a>
                    <a class="add glyphicon glyphicon-plus"></a>
                </div>
                <p>
                    入住时间截止{{$endDate}}
                    <!-- {{-- @if($room->wxRoomDates!='[]')
                    可入住时间：
                        @foreach ($room->wxRoomDates as $date)
                            <span>{{$date->year}}年{{$date->month}}月{{$date->day}}号、</span>
                        @endforeach
                        @else
                    @endif--}} -->
                </p>
            </div>
        </div>
    @endforeach
    <div id="caculate">
        <div id="scoreConsume">
            <span><em></em></span>
            <u>使用积分抵扣</u>
        </div>
        <p id="total">总价：<i id="totalPayment">0</i>元</p>
        <div id="scoreDiv">
            @if (empty($user->wxMembership->user_id))
                您还不是探庐者会员，无法使用积分。
                <a href="/wx/user"><button>去申请成为会员</button></a>
            @else
                <input type="number" id="score" name="score" placeholder="输入积分"/>&nbsp;&nbsp;
                可用积分：<i id="usableScore">{{$user->wxMembership->score}}</i>
                <p class="scoreDesc">100积分可抵10元，最多可抵房价的{{Config::get('config.wx_max_discount')}}%。</p>
            @endif
        </div>
    </div>
    <input type="hidden" id="csrf_token" name="_token" value="{{csrf_token()}}"/>
    <input type="hidden" id="wxCasaId" value="{{$wxCasa->id}}"/>
    <p class="title">
        <span class="glyphicon glyphicon-user"></span>联系人信息
    </p>
    <div class="person">
        <div class="personName">
            <label for="personName">姓名：</label>
            <input type="text" id="personName" value="{{$user->realname}}" placeholder="请输入姓名" >
        </div>
        <div class="cellphone">
            <label for="cellphone">手机：</label>
            <input type="number" id="cellphone" value="{{$user->cellphone}}" placeholder="请输入11位手机号">
        </div>
    </div>
    <input type="button" id="submitBtn" class="btn" value="立即预定" />
@stop
