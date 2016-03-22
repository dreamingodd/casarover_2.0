@extends('back')

@section('title', '探庐者后台-民宿列表')

@section('body')
    <div class="options vertical5">
        <a href="participate_list.php?status=0">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>待付款列表
        </a>
        <a href="participate_list.php?status=1">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>已付款列表
        </a>
    </div>
     <table class="table table-hover">
            <tr>
                <th>序号</th>
                <th>手机号</th>
                <th>操作</th>
                <th>组号</th>
            </tr>
            <tr>
                <td>123</td>
                <td>123</td>
                <td>123</td>
                <td>123</td>
            </tr>
    </table>
@stop
