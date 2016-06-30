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
        @foreach($areas as $key => $area)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $area->id }}</td>
                <td>{{ $area->value }}</td>
                <td>
                    <a href='{!! URL::route('back.areas.edit',array('areas'=>$area->id)) !!}'>
                        <button type="button" class="btn  btn-info">编辑</button>
                    </a>
                    <button type="button" onclick="del({{ $area->id }})" class="btn  btn-danger" data-toggle="modal" data-target="#modal-delete">
                    <i class="fa fa-times-circle"></i>
                    删除
                    </button>
                </td>
                <td>
                    <a href='/area/{{ $area->id }}' target="_blank">
                        <button type="button" class="btn  btn-info">查看效果</button>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="modal fade" id="modal-delete" tabIndex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">注意</h4>
                </div>
                <div class="modal-body">
                    <p class="lead">
                        <i class="fa fa-question-circle fa-lg"></i>
                        确定删除吗？
                    </p>
                </div>
                <div class="modal-footer">
                    <form method="POST" id="del" action="/back/areas/">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-times-circle"></i> 确定删除
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function del(areaId) {
            $("#del").attr('action','/back/areas/'+areaId);
        }
    </script>
@endsection
