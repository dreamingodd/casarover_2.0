@extends('back')

@section('title', '探庐者后台-微信预定民宿管理')

@section('head')
<script src="/assets/js/integration/json2.js"></script>
<script src="/assets/js/wxRoom.js"></script>
<style type="text/css">
.col-lg-11 {
    margin: 0 0 5px 15px;
}
.glyphicon {
    padding: 5px;
}
</style>
@stop

@section('body')

    <input type="hidden" id="page" value="reserve"/>

    <form id="wxRoomForm" action="/back/wx/room/edit" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" id="wxCasaId" name="wxCasaId" value="{{$wxCasaId}}"/>
        <input type="hidden" id="wxRooms" name="wxRooms"/>
    </form>

    <div class="col-lg-11" style="margin-top: -15px">
        <h3>微信预定民宿房间编辑</h3>
    </div>

    <div class="col-lg-11 alert alert-warning">
        房间关联订单内容和价格，请慎重修改！如有下单将不能删除！
    </div>

    <div class="col-lg-11">
        <button type="button" class="btn btn-info submit_btn">提交</button>
        <button type="button" class="btn btn-default goback">返回</button>
    </div>

    <div class="col-lg-11">
        <a class="addRoom" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
    </div>
    <div>
        <div id="room_container">
            @if (isset($wxRooms) && count($wxRooms) > 0)
                @foreach ($wxRooms as $wxRoom)
                    <div class="room col-lg-11" db_id="{{$wxRoom->id}}">
                        <div class="roomNameDiv input-group input-group-sm col-lg-4" style="float:left; margin-right:10px;">
                            <span class="input-group-addon">房间/套餐名称</span>
                            <input type="text" class="roomName form-control" aria-describedby="sizing-addon3"
                            value="{{$wxRoom->name or ''}}"/>
                        </div>
                        <div class="roomPriceDiv input-group input-group-sm col-lg-2" style="float:left">
                            <span class="input-group-addon">价格 ¥</span>
                            <input type="text" class="roomPrice form-control" aria-describedby="sizing-addon3"
                            value="{{$wxRoom->price or ''}}"/>
                        </div>
                        <a class="not_complete delRoom" href="#"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Delete</a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="col-lg-11">
        <button type="button" class="btn btn-info submit_btn">提交</button>
        <button type="button" class="btn btn-default goback">返回</button>
    </div>

    <!-- Room input template starts. -->
    <div class="room_template room col-lg-11" style="display: none;">
        <div class="roomNameDiv input-group input-group-sm col-lg-4" style="float:left; margin-right:10px;">
            <span class="input-group-addon">房间/套餐名称</span>
            <input type="text" class="roomName form-control" aria-describedby="sizing-addon3"
            value=""/>
        </div>
        <div class="roomPriceDiv input-group input-group-sm col-lg-2" style="float:left">
            <span class="input-group-addon">价格 ¥</span>
            <input type="text" class="roomPrice form-control" aria-describedby="sizing-addon3"
            value=""/>
        </div>
        <a class="not_complete delRoom" href="#"><span class="glyphicon glyphicon-remove"></span>Delete</a>
    </div>
    <!-- Room input template ends. -->

@stop
