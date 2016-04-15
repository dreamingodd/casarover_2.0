@extends('back')

@section('title', '探庐者后台-微信预定民宿管理')

@section('body')

    <input type="hidden" id="page" value="wechat"/>

    <div class="options vertical5">
        <a href="/back/wx/casa">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
    </div>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>一句话简介</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        <?php $number=1;?>
        @foreach ($wxCasas as $casa)
            <tr>
                <td>{{$number++}}</td>
                <td>{{$casa->name}}</td>
                <td class="brief">{{$casa->brief}}</td>
                <td>{{$casa->updated_at==''?$casa->created_at:$casa->updated_at}}</td>
                <td>
                    <a href='/back/wx/casa/{{$casa->id}}'>
                        <button type="button" class="btn btn-xs btn-info">编辑</button>
                    </a>
                    <a href='/back/wx/casa_del/{{$casa->id}}'>
                        <button type="button" class="btn btn-xs btn-danger">删除</button>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@stop
