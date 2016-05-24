@extends('back')

@section('title', '探庐者后台-微信预定民宿管理')

@section('head')
<script type="text/javascript">
$(function(){
    /* 显示房间信息 */
    $('.wx_casa_name').mouseover(function() {
        $(this).popover('show');
    });
    $('.wx_casa_name').mouseout(function() {
        $(this).popover('hide');
    });
});
</script>
@stop

@section('body')

    <input type="hidden" id="page" value="reserve"/>

    <div class="options vertical5">
        <a href="/back/wx/casa">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
        <a href="/back/wx">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>列表
        </a>
        <a href="/back/wx/trash/1">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>回收站
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
                <td>
                    <a tabindex="0" class="wx_casa_name btn btn-sm" role="button" data-html="true"
                        data-toggle="popover" data-trigger="focus" title="点击编辑民宿房间信息"
                        data-content="{{$casa->roomString}}"
                        href="/back/wx/room/{{$casa->id}}">{{$casa->name}}</a>
                </td>
                <td class="brief">{{$casa->brief}}</td>
                <td>{{$casa->updated_at==''?$casa->created_at:$casa->updated_at}}</td>
                <td>
                    @if ($casa->trashed())
                        <a href='/back/wx/casa/restore/{{$casa->id}}'>
                            <button type="button" class="btn btn-xs btn-warning">还原</button>
                        </a>
                    @else
                        <a href='/back/wx/casa/{{$casa->id}}'>
                            <button type="button" class="btn btn-xs btn-info">编辑</button>
                        </a>
                        <a href='/back/wx/room/{{$casa->id}}'>
                            <button type="button" class="btn btn-xs btn-info">编辑房间</button>
                        </a>
                        @if ($casa->test)
                            <a href='/back/wx/casa/test/unset/{{$casa->id}}'>
                                <button type="button" class="btn btn-xs btn-warning">恢复</button>
                            </a>
                        @else
                            <a href='/back/wx/casa/test/set/{{$casa->id}}'>
                                <button type="button" class="btn btn-xs btn-info">测试</button>
                            </a>
                        @endif
                        <a href='/back/wx/casa/del/{{$casa->id}}'>
                            <button type="button" class="btn btn-xs btn-danger">删除</button>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@stop
