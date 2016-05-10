@extends('wxBase')
@section('title','商家页面')
@section('head')
@stop
@section('body')
@section('nav')
    <img  src="/assets/images/logow.png" />
@stop
    <div>
        <br/><br/><br/><br/>
        <table>
            @foreach ($orders as $order)
            <tr>
                <td>{{$order->total}}</td>
                <td>{{$order->wxUser->realname}}</td>
                <td>{{$order->wxUser->nickname}}</td>
                <td>{{$order->created_at}}</td>
                <td>
                    <button class="btn btn-xs">消费</button>
                    <button class="btn btn-xs">取消</button>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@stop
