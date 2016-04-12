@extends('back')
@section('head')
    <script src="{{ asset('assets/js/integration/vue.js') }}" type="text/javascript"></script>
@endsection
@section('body')
    <div class="options vertical5">
        <a href="/back/theme/add">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>编号</th>
            <th>标题</th>
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
                    <button class="btn btn-default"><a href="/back/theme/edit/{{ $theme->id }}">编辑</a></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection