@extends('backBase')
@section('body')
    <div class="head">
        <h3>后台管理-景点介绍</h3>
        <div class="photo">
            <h3>标题大图</h3>
            <span class="reminder">上传一张图(图片宽高比必须在3:1以上)</span>

            <h3>区域名</h3>
            <input type="text" class="form-control" id="name" name="name" value="" />
        </div>
    </div>
    <h3>区域介绍图片</h3>
    <p>上传四张图片</p>
    <p>最佳尺寸520*325</p>
    <div class="uppic">
            <div class="oss_button">
                <button class="show_uploader btn btn-primary btn-sm">插入图片</button>
            </div>
    </div>
    <p style="color:red">每段最佳字数230</p>
        <div class="content">
            <div class="message">
                <h3>介绍内容</h3>
                <h4>第一段</h4>
                <textarea class="form-control" rows="3" name="text1"></textarea>
                <h4>第二段</h4>
                <textarea class="form-control" rows="3" name="text2"></textarea>
                <h4>第三段</h4>
                <textarea class="form-control" rows="3" name="text3"></textarea>
            </div>
        </div>

        <div class="raiders">
            <h3>攻略内容</h3>
            <textarea class="form-control" rows="3" name="radiers"></textarea>
            <hr>
            <h2>景点基本信息</h2>
            <p>到下面的这个网站选取坐标和层级然后复制过来</p>
            <a href="http://api.map.baidu.com/lbsapi/getpoint/index.html" target="_blank">
                百度地图坐标拾取器
            </a>
            <h3>坐标</h3>
            <input type="text" class="form-control" id="position" value="" name="position" placeholder="从坐标拾取复制过来" />
            <h3>层级</h3>
            <input type="text" class="form-control" id="tier" name="tier" placeholder="显示层级" value="" />
        </div>
        <br/>
        <div id="casa_select" class="vertical5 col-lg-12">
            <input type="hidden" name="recommendCasas" id="recommendCasas" value=""/>
            <div id="casa_select_left" class="col-lg-4">
                <select multiple class="form-control" style="height:180px">

                </select>
            </div>
        </div>
        <div class="sub">
            <button id="submit_btn" class="btn btn-primary">保存</button>
            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#modal-delete">
            <i class="fa fa-times-circle"></i>
            删除
            </button>
             确认删除
            <div class="modal fade" id="modal-delete" tabIndex="-1">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
            ×
            </button>
            <h4 class="modal-title">Please Confirm</h4>
            </div>
            <div class="modal-body">
            <p class="lead">
            <i class="fa fa-question-circle fa-lg"></i>
            确定删除吗？
            </p>
            </div>
            <div class="modal-footer">
            <form method="POST" action="{{ route('back.areas.destroy',$id=1 ) }}">
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