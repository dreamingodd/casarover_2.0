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
        <?php $number = 1; ?>
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
                    <form method="POST" action="{{ route('back.areas.destroy', $area->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i> Yes
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
