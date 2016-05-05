@extends('back')

@section('title', '探庐者后台-微信预定民宿管理')

@section('head')
    <script src="/assets/js/integration/json2.js"></script>
    {{--<script src="/assets/js/wxRoomDate.js"></script>--}}
    <style type="text/css">
    </style>
@stop

@section('body')
    <input type="hidden" id="page" value="reserve"/>

    <form id="wxRoomForm" action="/back/wx/room/date/1" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
    </form>
    <h2>民宿名</h2>
    <h3>房间名</h3>
    <div class="col-lg-11">
        <a class="addDate" href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add</a>
    </div>
    <div class="col-lg-11" >
        <div class="input-group input-group-sm col-lg-2" style="margin:10px 0;">
            <span class="input-group-addon">年份</span>
            <input type="text" class="form-control" name="year" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
        <div class="input-group input-group-sm col-lg-1" style="margin:10px 0;">
            <span class="input-group-addon">月份</span>
            <input type="text" class="form-control"name="month" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
        <div class="input-group input-group-sm col-lg-3" style="margin:10px 0;">
            <span class="input-group-addon">工作日</span>
            <input type="text" class="form-control"name="month" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
        <div class="input-group input-group-sm col-lg-3" style="margin:10px 0;">
            <span class="input-group-addon">双休日</span>
            <input type="text" class="form-control"name="month" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
        <div class="input-group input-group-sm col-lg-3" style="margin:10px 0;">
            <span class="input-group-addon">节假日</span>
            <input type="text" class="form-control"name="month" aria-describedby="sizing-addon3"
                   value=""/>
        </div>
    </div>
@stop
