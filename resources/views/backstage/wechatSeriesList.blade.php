@extends('back')

@section('title', '探庐者后台-民宿列表')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/wechatSerieslist.js"></script>
@endsection
@section('body')
    <div class="alert alert-success tip"  role="alert">修改成功</div>
    <h4>探庐系列微信端和网站端一致</h4>
    <p class="text-danger">请上传好图片后再勾选显示在首页</p>
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
                    <input type="checkbox" @if($series->status) checked="checked" @endif onclick="setchange({{ $series->id }},this)" >
                </td>
                <td>
                    <a href="/back/wechatSeriesEdit/{{ $series->id }}">
                        <button  type="button" class="btn btn-default">编辑</button>
                    </a>
                    <button type="button" class="btn btn-danger" onclick="del({{ $series->id }})" data-toggle="modal" data-target="#modal-delete">
                        <i class="fa fa-times-circle"></i>
                        删除
                    </button>
                </td>
            </tr>
        @endforeach
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
                            确定删除吗？
                        </p>
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="/back/wechatSeriesDel">
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
@stop
