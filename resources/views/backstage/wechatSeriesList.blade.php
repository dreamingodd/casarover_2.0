@extends('back')

@section('title', '探庐者后台-民宿列表')

@section('body')
    <div class="options vertical5">
        <a href="/back/wechatSeriesEdit">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
    </div>
     <input type="hidden" id="page" value="wechat"/>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>父标题</th>
            <th>操作</th>
        </tr>
        {{$number=1}};
        @foreach ($wechatSeries as $series)
            <tr>
            <td>{{$number++}}</td>
            <td>{{$series->name}}</td>
            <td>探庐系列</td>
            <td>
                <a href='wechat_series_del_action.php?id=1'>
                    <button disabled type="button" class="btn btn-xs btn-danger">删除</button>
                </a>
            </td>
        </tr>
        @endforeach
        </table>

@stop
