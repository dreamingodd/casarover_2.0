@extends('back')
@section('title', '探庐者后台-度假卡列表')
@section('head')
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    {{--<script src="/assets/js/eighteen.js"></script>--}}
@stop
@section('body')
    <input type="hidden" id="page" value="reserve"/>
    <div class="options vertical5">
        <a href="/back/vacation/edit">
            <span class="glyphicon glyphicon-plus" aria-hidden="true">添加</span>
        </a>
    </div>
    <div id="app">
        <table class="table">
            <thead>
            <tr>
                <th>序号</th>
                <th>度假卡</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cards as $key=>$card)
                <tr >
                    <th>
                        {{$key+1}}
                    </th>
                    <th scope="row">
                        {{$card->name }}
                    </th>
                    <th>
                        <a href='/back/vacation/edit/{{$card->id}}'>
                            <button type="button" class="btn btn-xs btn-info">编辑</button>
                        </a>
                        <a href='/back/vacation/del/{{$card->id}}'>
                            <button class="btn btn-xs btn-danger" >删除</button>
                        </a>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
