@extends('back')

@section('title', '探庐者后台-民宿列表')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/wechatSerieslist.js"></script>
@endsection
@section('body')
    <h4>探庐系列微信端和网站端一致</h4>
    <div class="options vertical5">
        <a href="/back/wechatSeriesadd">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加
        </a>
    </div>
    <input type="hidden" id="page" value="wechat"/>
    <table class="table table-hover">
        <tr>
            <th>序号</th>
            <th>名称</th>
            <th>父标题</th>
            <th>是否显示在网站首页</th>
            <th>操作</th>
        </tr>
        <?php $number=1;?>
        @foreach ($wechatSeries as $series)
            <tr>
                <td>{{$number++}}</td>
                <td>{{$series->name}}</td>
                <td>探庐系列</td>
                <td>
                    <input type="checkbox" @if($series->status) checked="checked" @endif onclick="setchange({{ $series->id }})" >
                </td>
                <td>
                    <a href="/back/wechatSeriesEdit/{{ $series->id }}">
                        <button  type="button" class="btn btn-default">编辑</button>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@stop
