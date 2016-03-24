@extends('back')
@section('head')
    <script src="{{ asset('assets/js/vue.js') }}" type="text/javascript"></script>
@endsection
@section('body')
    {{ $message->contents }}
    <div class="head">
        <h3>基本信息</h3>
        <div class="photo">
            <form></form>
            <h3>导航图</h3>
            <span class="reminder">上传一张图(图片宽高比必须在3:1以上)</span>
            <h3>区域名</h3>
            <input type="text" class="form-control" id="name" name="name" value="{{ $message->value }}" />
            <h3>简介</h3>
            <textarea class="form-control" rows="3" ></textarea>
        </div>
    </div>
    <div class="raiders">
        <p>到下面的这个网站选取坐标和层级然后复制过来</p>
        <a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" target="_blank">
            百度地图坐标拾取器
        </a>
        <h3>坐标</h3>
        <input type="text" class="form-control" id="position" value="" name="position" placeholder="从坐标拾取复制过来" />
        <h3>层级</h3>
        <input type="text" class="form-control" id="tier" name="tier" placeholder="显示层级" value="" />
    </div>
    <h3>攻略内容</h3>
    <textarea class="form-control" rows="3" name="radiers"></textarea>
    <hr>
<h3>附近景点</h3>
    <p>建议不要太多，三到四个最佳</p>
<button class="btn btn-default">上传图片</button>
    <textarea class="form-control" rows="3" placeholder="对景点的描述"></textarea>
        <div class="sub">
            <button id="submit_btn" class="btn btn-primary">保存</button>
            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-delete">
            <i class="fa fa-times-circle"></i>
            删除
            </button>
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
            <form method="POST" action="{{ route('back.areas.destroy',$message->id ) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="DELETE">
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
        </div>
    </form>
@endsection