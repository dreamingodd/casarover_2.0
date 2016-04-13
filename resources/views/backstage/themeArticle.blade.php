@extends('back')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('assets/js/integration/vue.js') }}" type="text/javascript"></script>
    <script src="/assets/js/themeArticle.js"></script>
@endsection
@section('body')
    <div class="options vertical5">
        <a href="/back/theme/article/add">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
    </div>
    <div id="main">
        <select name="" id="" class="form-control" v-model="selected" v-on:change="getArticle">
            @foreach($themes as $theme)
                <option value={{ $theme->id }}>{{ $theme->name }}</option>
            @endforeach
        </select>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>编号</th>
                <th>标题</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="app" v-for="article in articles">
            <tr>
                <th scope="row">@{{ $index+1 }}</th>
                <td>@{{ article.name }}</td>
                <td>
                    <a href="/back/theme/article/edit/@{{ article.id }}">
                        <button class="btn btn-default">编辑</button>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection