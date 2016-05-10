@extends('back')

@section('title', '探庐者后台-微信商家管理')

@section('head')
@stop

@section('body')

    <input type="hidden" id="page" value="reserve"/>

    <div class="options vertical5">
        <a href="/back/wx/bind">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>列表
        </a>
        <a href="/back/wx/bind/trash/1">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>回收站
        </a>
    </div>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>姓名</th>
            <th>微信名</th>
            <th>手机</th>
            <th>用户输入民宿</th>
            <th>实际绑定民宿</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        <?php $number=1;?>
        @foreach ($wxBinds as $bind)
            <tr>
                <td>{{$number++}}</td>
                <td>{{$bind->wxUser->realname or ''}}</td>
                <td>{{$bind->wxUser->nickname or ''}}</td>
                <td>{{$bind->wxUser->cellphone or ''}}</td>
                <td>{{$bind->casa_name}}</td>
                <td>
                    <button type="button" class="btn btn-xs btn-info">选择</button>
                    {{$bind->wxCasa->name or ''}}
                </td>
                <td>{{$bind->updated_at==''?$bind->created_at:$bind->updated_at}}</td>
                <td>
                    @if ($bind->trashed())
                        <a href='/back/wx/bind/restore/{{$bind->id}}'>
                            <button type="button" class="btn btn-xs btn-warning">还原</button>
                        </a>
                    @else
                        <a href='/back/wx/bind/delete/{{$bind->id}}'>
                            <button type="button" class="btn btn-xs btn-danger">删除</button>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@stop
