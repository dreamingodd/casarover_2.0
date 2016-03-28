@extends('back')

@section('title','区域列表')

@section('body')
    <input type="hidden" id="page" value="area"/>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>ID</th>
            <th>名称</th>
            <th>操作</th>
            <th></th>
        </tr>
        <?php $number = 1;?>
        @foreach($areas as $area)
            <tr>
                <td>{{ $number ++ }}</td>
                <td>{{ $area->id }}</td>
                <td>{{ $area->value }}</td>
                <td>
                    <a href='{!! URL::route('back.areas.edit',array('areas'=>$area->id)) !!}'>
                        <button type="button" class="btn btn-xs btn-info">编辑</button>
                    </a>
                </td>
                <td>
                    <a href='/area/{{ $area->id }}' target="_blank">
                        <button type="button" class="btn btn-xs btn-info">查看效果</button>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
