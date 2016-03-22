@extends('back')

@section('title', '探庐者后台-民宿列表')

@section('body')
 <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>手机号</th>
            <th>操作</th>
            <th>组号</th>
        </tr>
		<?php $number=1; ?>
        @foreach ($casas as $casa)
            @if ($casa->deleted == $deleted)
                <tr>
                    <td>{{$number++}}</td>
                    <td>{{$casa->code}}</td>
                    <td>{{$casa->name}}</td>
                    <td>{{$casa->area_name}}</td>
            @endif
        @endforeach
    </table>
@stop
