@extends('wxBase')
@section('title','商家入口')
@section('head')
@stop
@section('nav')
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div style="margin: 0 auto; width:200px;">
        <br/><br/><br/><br/>
        操作成功！
        <a href="/wx/bind">
            <button btn="btn btn-lg btn-default">返回订单列表</button>
        </a>
    </div>
@stop
