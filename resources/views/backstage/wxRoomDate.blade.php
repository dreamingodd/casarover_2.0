@extends('back')

@section('title', '探庐者后台-微信预定民宿管理')

@section('head')
    <script src="/assets/js/integration/json2.js"></script>
    {{--<script src="/assets/js/wxRoomDate.js"></script>--}}
    <style type="text/css">
        h2,h3{
            margin-left: 35px;
        }
    </style>
@stop

@section('body')
    <input type="hidden" id="page" value="reserve"/>

    <form id="wxRoomForm" action="/back/wx/room/date/{{$wxRooms->id}}" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="room_id" value="{{$wxRooms->id}}">
    <h2>{{$wxRooms->wxCasa->name }}</h2>
    <h3>{{$wxRooms->name }}</h3>
    <div class="col-lg-11">
        <a class="addDate" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
    </div>
    <div id="date_container">
    <div class="col-lg-11" >
        <div class="input-group input-group-sm col-lg-2" style="margin:10px 0;">
            <span class="input-group-addon">年份</span>
            <input type="text" class="form-control" name="year[]" aria-describedby="sizing-addon3"
                   value="{{$date->year or null}}"/>
        </div>
        <div class="input-group input-group-sm col-lg-1" style="margin:10px 0;">
            <span class="input-group-addon">月份</span>
            <input type="text" class="form-control"name="month[]" aria-describedby="sizing-addon3"
                   value="{{$date->month or null}}"/>
        </div>
        <div class="input-group input-group-sm col-lg-3" style="margin:10px 0;">
            <span class="input-group-addon">工作日</span>
            <input type="text" class="form-control"name="weekday[]" aria-describedby="sizing-addon3"
                   value="{{$date->weekday or null}}"/>
        </div>
        <div class="input-group input-group-sm col-lg-3" style="margin:10px 0;">
            <span class="input-group-addon">双休日</span>
            <input type="text" class="form-control"name="weekend[]" aria-describedby="sizing-addon3"
                   value="{{$date->weekend or null}}"/>
        </div>
        <div class="input-group input-group-sm col-lg-3" style="margin:10px 0;">
            <span class="input-group-addon">节假日</span>
            <input type="text" class="form-control"name="holiday[]" aria-describedby="sizing-addon3"
                   value="{{$date->holiday or null}}"/>
        </div>
    </div>
    </div>
    <div class="col-lg-11">
        <input type="submit" class="btn btn-info submit_btn" value="提交" />
        <button type="button" class="btn btn-default goback">返回</button>
    </div>
    </form>
    <div class="date_template col-lg-11" style="display: none" >
        <div class="input-group input-group-sm col-lg-2" style="margin:10px 0;">
            <span class="input-group-addon">年份</span>
            <input type="text" class="form-control" name="year[]" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
        <div class="input-group input-group-sm col-lg-1" style="margin:10px 0;">
            <span class="input-group-addon">月份</span>
            <input type="text" class="form-control"name="month[]" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
        <div class="input-group input-group-sm col-lg-3" style="margin:10px 0;">
            <span class="input-group-addon">工作日</span>
            <input type="text" class="form-control"name="weekday[]" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
        <div class="input-group input-group-sm col-lg-3" style="margin:10px 0;">
            <span class="input-group-addon">双休日</span>
            <input type="text" class="form-control"name="weekend[]" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
        <div class="input-group input-group-sm col-lg-3" style="margin:10px 0;">
            <span class="input-group-addon">节假日</span>
            <input type="text" class="form-control"name="holiday[]" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
    </div>
    <script>
        function addDate() {
            var newRoom = $($('.date_template')[0].outerHTML);
            newRoom.css('display', 'block');
            $('#date_container').append(newRoom);
        }
        $(function() {
            // If there's no room in this casa, add an empty one.
//            if ($('#room_container').children().length == 0) {
//                addDate();
//            }
            // When one presses the add icon
            $('.addDate').click(function () {
                addDate();
            });
        });
    </script>
@stop
