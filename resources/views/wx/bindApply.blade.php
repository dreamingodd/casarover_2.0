@extends('wxBase')
@section('title','商家入口')
@section('head')
<script src="/assets/js/back.js"></script>
<script src="/assets/js/bindApply.js"></script>
@stop
@section('body')
@section('nav')
    <img  src="/assets/images/logow.png" />
@stop
    <div style="margin: 0 auto; width:300px;">
        <br/><br/><br/><br/>
        <form id="bindApplyForm" action="/wx/bind/apply" method="post">
            <input type="hidden" id="csrf_token" name="_token" value="{{csrf_token()}}"/>
            <input type="hidden" id="userId" name="userId" value="{{$user->id}}"/>
            <div class="personName">
                <label for="personName">姓名：</label>
                <input type="text" id="personName" name="realname" value="{{$user->realname or ''}}"
                        placeholder="请输入姓名">
            </div>
            <div class="cellphone">
                <label for="cellphone">手机：</label>
                <input type="number" id="cellphone" name="cellphone" value="{{$user->cellphone or ''}}"
                        placeholder="请输入手机号">
            </div>
            <div class="cellphone">
                <label for="cellphone">民宿：</label>
                <input type="text" id="casaName" name="casaName" value="" placeholder="民宿名称">
            </div>
            <button id="submitBtn" type="button">提交</button>
            <a href="tel:{{Config::get('config.help_telephone')}}" class="glyphicon glyphicon-earphone" style="margin-left: 80px;">电话咨询</a>
        </form>
    </div>
@stop
