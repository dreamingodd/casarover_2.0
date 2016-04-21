@extends('back')
@section('head')
<script src="{{ asset('assets/js/integration/vue.js') }}" type="text/javascript"></script>
@endsection
@section('body')
    <input type="hidden" id="page" value="home"/>
    <div class="options vertical5">
        <a href="/back/slide/add">
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
               <button class="btn btn-default"><a href="/back/slide/edit/{{ $slide->id }}">编辑</a></button>
            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
@endsection
