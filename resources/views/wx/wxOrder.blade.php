@extends('wxBase')
@section('title','民宿预订')
@section('head')
<link href="/assets/css/wxOrder.css" rel="stylesheet"/>
<script type="text/javascript">
    function total(){
        totals=0;
        price=0;
        counts=0;
        $('.room').each(function(){
            if ($(this).children('.quantity').css('display') == 'block') {
                counts=  $(this).find('.room_quantity').html();
                price = $(this).find('.price').html().replace('￥','');
                totals=totals + parseFloat(counts) * parseFloat(price);
                console.log(totals);
            }
        });
        $('#total').children('i').html(totals);
    }
$(function() {
    window.onload=function(){
        $('.detail').click(function() {
            $(this).next().toggle();
            $(this).children('span').children('em').toggle();
            total();
        });
        $(".reduce").click(function(){
            var i = parseInt($(this).parents('.room').find('.room_quantity').html());
            if(i<=1)
            return 0;
            $(this).parents('.room').find('.room_quantity').html(--i);
            total();
        });
        $(".add").click(function(){
            var i = parseInt($(this).parents('.room').find('.room_quantity').html());
            $(this).parents('.room').find('.room_quantity').html(++i);
            total();
        });
    }
    $('#submitBtn').click(function(){
        var reservedRooms = [];
        $('.room').each(function(){
            if ($(this).children('.quantity').css('display') == 'block') {
                var reservedRoom = {};
                reservedRoom.id = $(this).attr('db_id');
                reservedRoom.quantity = $(this).find('.room_quantity').html();
            }
            reservedRooms.push(reservedRoom);
        });
        console.log(reservedRooms);
    });
});
</script>
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
                <b>{{$room->name}}</b>
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
    <p id="total">总价：<i>0</i>元</p>
    <form action="" method="">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" value="" id="counts">
        <p class="title"><span class="glyphicon glyphicon-user"></span>联系人信息</p>
        <div class="person">
            <input type="text" value="" placeholder="请输入姓名" >
            <input type="number" value="" placeholder="请输入11位手机号">
        </div>
        <input type="button" id="submitBtn" class="btn" value="立即支付" />
    </form>
@stop
