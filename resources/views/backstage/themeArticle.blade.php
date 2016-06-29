@extends('back')
@section('head')
    <script src="{{ asset('assets/js/integration/vue.js') }}" type="text/javascript"></script>
    <script src="/assets/js/themeArticle.js"></script>
@endsection
@section('body')
    <input type="hidden" id="page" value="home"/>
    <div id="main">
        <div class="col-md-4">
            <h4>按主题查看</h4>
            <select name="" id="sel" class="form-control" v-model="selected" v-on:change="getArticle">
                @foreach($themes as $theme)
                    <option  value={{ $theme->id }}>{{ $theme->name }}</option>
                @endforeach
            </select>
            <br>
            <div class="options vertical5">
                <a href="/back/theme/article/add">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加文章
                </a>
                <a href="/back/theme/">
                    <span class="" aria-hidden="true"></span>管理主题
                </a>
            </div>
        </div>
        <div class="col-md-12">
            <h4>主题下属文章</h4>
        </div>
        <table class="table ">
            <thead>
            <tr>
                <th>编号</th>
                <th>标题</th>
                <th>关联民宿</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="app" v-for="article in articles" transition="expand" >
            <tr v-cloak>
                <th scope="row">@{{ $index+1 }}</th>
                <td>@{{ article.name }}</td>
                <td>@{{ article.houseName }}</td>
                <td>
                    <a href="/back/theme/article/edit/@{{ article.id }}">
                        <button class="btn btn-default">编辑</button>
                    </a>
                    <button type="button" class="btn btn-danger" onclick="del(@{{ article.id }})" data-toggle="modal" data-target="#modal-delete">
                        <i class="fa fa-times-circle"></i>
                        删除
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

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
                    <form method="POST" action="/back/theme/article/del">
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
