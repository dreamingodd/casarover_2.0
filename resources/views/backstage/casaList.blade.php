@extends('back')

@section('title', '探庐者后台-民宿列表')

@section('body')
    <input type="hidden" id="page" value="casa"/>
    <div class="options vertical5">
        <a href="/back/casa">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
        <a href="/back/casaList">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>列表
        </a>
        <a href="/back/casaList/1">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>回收站
        </a>
    </div>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>编码</th>
            <th>名称</th>
            <th>地区</th>
            <th>操作</th>
        </tr>
        <?php $number=1; ?>
        @foreach ($casas as $casa)
            @if ($casa->deleted == $deleted)
                <tr>
                    <td>{{$number++}}</td>
                    <td>{{$casa->code}}</td>
                    <td>{{$casa->name}}</td>
                    <td>{{$casa->area_name}}</td>
                    <td>
                        @if ($casa->deleted)
                            <a id="casa_recover" href='/back/casaDel/{{$casa->id}}/0'>
                                <button type="button" class="btn btn-xs btn-warning">还原</button>
                            </a>
                            <a  href='/back/casa/realDel/{{$casa->id}}'>
                                <button type="button" class="btn btn-xs btn-danger">永久删除</button>
                            </a>
                        @else
                            <a id="casa_continue" href='/back/casa/{{$casa->id}}'>
                                <button type="button" class="btn btn-xs btn-info">编辑</button>
                            </a>
                            <a id="casa_effect" target="_blank" href='/casa/{{$casa->id}}'>
                                <button type="button" class="btn btn-xs btn-info">查看效果</button>
                            </a>
                            <a id="casa_recycle" href='/back/casaDel/{{$casa->id}}/1'>
                                <button type="button" class="btn btn-xs btn-danger">删除</button>
                            </a>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
@stop
