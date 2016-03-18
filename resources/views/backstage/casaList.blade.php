@extends('back')

@section('title', '探庐者后台-民宿列表')

@section('body')
    <input type="hidden" id="page" value="casa"/>
    <div class="options vertical5">
        <a href="/back/casaEdit.php">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
        <a href="/back/casaList.php">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>列表
        </a>
        <a href="/back/casaList?deleted=1">
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
        @inject('areaService', 'App\Services\AreaService')
        <?php $number=1; ?>
        @foreach ($casas as $casa)
            @if ($casa->deleted == $deleted)
                <tr>
                    <td>{{$number++}}</td>
                    <td>{{$casa->code}}</td>
                    <td>{{$casa->name}}</td>
                    <td>{{$areaService->getLeafFullName($casa->dictionary_id)}}</td>
                    <td>
                        @if ($casa->deleted)
                            <a id="casa_recover" href='../../application/controllers/casa_recycle_action.php?id=<?php echo $casa->id?>&option=recover&deleted=1'>
                                <button type="button" class="btn btn-xs btn-warning">还原</button>
                            </a>
                        @else
                            <a id="casa_continue" href='casa_edit.php?casa_id=<?php echo $casa->id?>'>
                                <button type="button" class="btn btn-xs btn-info">编辑</button>
                            </a>
                            <a id="casa_effect" target="_blank" href='../casa.php?casa_id=<?php echo $casa->id?>'>
                                <button type="button" class="btn btn-xs btn-info">查看效果</button>
                            </a>
                            <a id="casa_recycle" href='../../application/controllers/casa_recycle_action.php?id=<?php echo $casa->id?>&option=recycle&deleted=0'>
                                <button type="button" class="btn btn-xs btn-danger">删除</button>
                            </a>
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
@stop
