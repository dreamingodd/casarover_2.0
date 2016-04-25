@extends('wxBase')
@section('title','民宿预订')
@section('head')
<link href="/assets/css/wxOrder.css" rel="stylesheet"/>
<script src="/assets/js/back.js"></script>
<script src="/assets/js/wxOrder.js"></script>
@stop
@section('body')
    <p class="title">
        <span class="glyphicon glyphicon-th-list"></span>套餐／房间选择
        <a href="/wx/casa/{{$wxCasa->id}}"  class="glyphicon glyphicon-remove"></a>
    </p>
    @foreach ($wxCasa->wxRooms as $room)
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
                <p></p>
            </div>
        </div>
    @endforeach
    <p id="total">总价：<i id="totalPayment">0</i>元</p>
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <p class="title">
        <span class="glyphicon glyphicon-user"></span>联系人信息
    </p>
    <div class="person">
        <input type="text" id="personName" value="" placeholder="请输入姓名" >
        <input type="number" id="cellphone" value="" placeholder="请输入11位手机号">
    </div>
    <input type="button" id="submitBtn" class="btn" value="立即预定" />
@stop
