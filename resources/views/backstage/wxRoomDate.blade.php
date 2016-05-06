@extends('back')

@section('title', '探庐者后台-微信预定民宿管理')

@section('head')
    <script src="/assets/js/integration/json2.js"></script>
    <script src="/assets/js/wxRoomDate.js"></script>
    <style type="text/css">
        h2,h3{
            margin-left: 35px;
        }
    </style>
@stop

@section('body')
    <input type="hidden" id="page" value="reserve"/>
    <form id="wxRoomForm" action="/back/wx/room/date/{{$wxRoom->id}}"
          method="post"  onsubmit="return checksubmit()">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="room_id" value="{{$wxRoom->id}}">
    <h2>{{$wxRoom->wxCasa->name }}</h2>
    <h3>{{$wxRoom->name }}</h3>
        <div class="col-lg-11 alert alert-warning">
            可入住日期栏内输入当月日期，以英文逗号分隔，如1,2,3
        </div>
    <div class="col-lg-11">
        <a class="addDate" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
    </div>
        <div id="date_container">
            @foreach ($date as $dates)
            <div class="col-lg-11" >
                <div class="input-group input-group-sm col-lg-2" style="margin:10px 0;">
                    <span class="input-group-addon">年份</span>
                    <input type="text" class="form-control year"  name="year[]" aria-describedby="sizing-addon3"
                           value="{{$dates->year or null}}"/>
                </div>
                <div class="input-group input-group-sm col-lg-1" style="margin:10px 0;">
                    <span class="input-group-addon">月份</span>
                    <input type="text" class="form-control month"name="month[]" aria-describedby="sizing-addon3"
                           value="{{$dates->month or null}}"/>
                </div>
                <div class="input-group input-group-sm col-lg-3" style="margin:10px 0;">
                    <span class="input-group-addon">可入住日期</span>
                    <input type="text" class="form-control day"name="day[]" aria-describedby="sizing-addon3"
                           value="{{$dates->day or null}}"/>
                </div>
                <a class="delRoom" onclick="del(this)" href="#"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Delete</a>
            </div>
        @endforeach
        </div>
    <div class="col-lg-11">
        <button  id="submit"  class="btn btn-info submit_btn" >提交</button>
        <button type="button" class="btn btn-default goback">返回</button>
    </div>
    </form>
    <div class="date_template col-lg-11" style="display: none" >
        <div class="input-group input-group-sm col-lg-2" style="margin:10px 0;">
            <span class="input-group-addon">年份</span>
            <input type="text" class="form-control year" name="year[]" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
        <div class="input-group input-group-sm col-lg-1" style="margin:10px 0;">
            <span class="input-group-addon">月份</span>
            <input type="text" class="form-control month"name="month[]" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
        <div class="input-group input-group-sm col-lg-3" style="margin:10px 0;">
            <span class="input-group-addon">可入住日期</span>
            <input type="text" class="form-control day"name="day[]" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
        <a class="delRoom" onclick="del(this)" href="#"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>Delete</a>
    </div>
@stop
