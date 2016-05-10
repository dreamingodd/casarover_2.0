@extends('back')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/theme.js"></script>
@endsection
@section('body')
    <input type="hidden" id="page" value="home"/>
    <div class="options vertical5">
        <a href="#" aria-label="Previous" onclick="history.back()">
            <span aria-hidden="true">&laquo;返回</span>
        </a>
        <a href="/back/theme/add">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加主题
        </a>
    </div>
    <div class="alert alert-success tip" role="alert">修改成功</div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>编号</th>
            <th>标题</th>
            <th>是否显示在首页</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody id="app">
        <?php $num=1 ?>
        @foreach($themes as $theme)
            <tr>
                <th scope="row">{{ $num++ }}</th>
                <td>{{ $theme->name }}</td>
                <td>
                    <input type="checkbox" @if($theme->status) checked="checked" @endif onclick="setchange({{ $theme->id }})" >
                </td>
                <td>
                    <a href="/back/theme/edit/{{ $theme->id }}">
                    <button class="btn btn-default">编辑</button>
                    </a>
                    <button type="button" class="btn btn-danger" onclick="del({{ $theme->id }})" data-toggle="modal" data-target="#modal-delete">
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
                        如果删除主题，下属文章将会被一并删除，建议先将文章移动到其他主题中
                    </p>
                </div>
                <div class="modal-footer">
                    <form method="post" action="/back/theme/del">
                        <input type="hidden" name="id" id="delId">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
