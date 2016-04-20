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
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
