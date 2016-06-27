@extends('back')
@section('body')
@if ($type == 1)
    <input type="hidden" id="page" value="home"/>
@else
    <input type="hidden" id="page" value="area"/>
@endif
    <div class="options vertical5">
        <a href="/back/slide/add/{{ $type }}">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>编号</th>
            <th>标题</th>
            <th>对应民宿</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody id="app">
        <?php $num=1 ?>
        @foreach($slides as $slide)
            <tr>
                <th scope="row">{{ $num++ }}</th>
                <td>
                    @if(empty($slide->title))
                        暂无
                    @else
                        {{ $slide->title }}
                    @endif
                </td>
                <td>{{ $slide->casa->name }}</td>
                <td>
                    <a href="/back/slide/edit/{{ $slide->id }}" class="btn btn-default">编辑</a>
                    <button type="button" onclick="del({{ $slide->id }})" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">
                        <i class="fa fa-times-circle"></i>
                        删除
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
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
                        真的删除吗？
                    </p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="/back/slidedel">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="type" value="{{ $type}}">
                        <input type="hidden" name="id" id="delId">
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
        function del(id){
            $("#delId").val(id);
        }
    </script>
@endsection
