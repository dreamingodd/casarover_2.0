@extends('back')

@section('title', '探庐者后台-微信预定民宿编辑')

@section('head')
<script src="//requirejs.org/docs/release/2.1.11/comments/require.js" data-main="/assets/js/OssPhotoUploader.js"></script>
<script src="/assets/js/integration/json2.js"></script>
<script src="/assets/js/wxEdit.js"></script>
<script src="/assets/js/casaSelectModal.js"></script>
<style>
.col-lg-11 {
    margin: 2px 0 3px 20px;
}
.nav-tabs {
    width: 100%;
    float: left;
}
.content textarea {
    margin: 5px 0 0 15px;
    float: left;
}
.table thead tr td {
    padding: 2px;
}
.search{
    width:257px;
    height:26px;
    float:left;
    border-radius: 10px;
    padding-left:17px;
    margin:7px 0;
    border: 1px solid #d5d5d5;
}
.search  #search{
    float:left;
    margin-top:2px;
    border:0;
    height:22px;
    line-height:22px;
    width:178px;
}
.search button{
    margin-top:0;
    border:0;
    width:22px;
    height:22px;
    color: #6e6e6e;
    background: #fff;
}
.search #reset{
    margin-top:0;
    border:0;
    width:22px;
    height:22px;
    color: #6e6e6e;
    background: #fff;
}
</style>
@stop

@section('body')

    <input type="hidden" id="page" value="wechat"/>

    <div class="col-lg-11" style="margin-top: -15px">
        <h3>微信预定民宿编辑</h3>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger col-lg-11">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="btn_div col-lg-11">
        <button class="btn btn-primary submit_btn">提交</button>
    </div>
    <br/>
    <form id="wx_casa_form" action="/back/wx/edit" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="{{ $wxCasa->id or 0 }}"/>
        <input type="hidden" name="casa_id" value="{{ $wxCasa->casa_id or 0 }}"/>
        <input type="hidden" name="main_photo" id="main_photo" value="{{ $wxCasa->attachment->filepath or '' }}"/>
        <div class="name col-lg-11">
            <div class="input-group input-group-sm col-lg-3">
                <span class="input-group-addon">名称</span>
                <input name="name" type="text" class="form-control" aria-describedby="sizing-addon3"
                        value="{{$wxCasa->name or ''}}"/>
            </div>
        </div>
        <div class="brief col-lg-11">
            <div class="input-group input-group-sm col-lg-9">
                <span class="input-group-addon">一句话简介</span>
                <input name="brief" type="text" class="form-control" aria-describedby="sizing-addon3"
                        value="{{$wxCasa->brief or ''}}" placeholder="不要超过25个字"/>
            </div>
        </div>
        <div class="phone col-lg-11">
            <div class="input-group input-group-sm col-lg-2">
                <span class="input-group-addon">预订电话</span>
                <input name="phone" type="text" class="form-control" aria-describedby="sizing-addon3"
                        value="{{$wxCasa->phone or ''}}"/>
            </div>
        </div>
        <div class="col-lg-11">
            <h4>产品详情</h4>
            <textarea name="desc" class="form-control" rows="5">{{ $wxCasa->desc or '' }}</textarea>
        </div>
        <div class="col-lg-11">
            <h4>使用说明</h4>
            <textarea name="spec" class="form-control" rows="5">{{ $wxCasa->spec or '' }}</textarea>
        </div>
        <div class="col-lg-11">
            <h4>改退规则</h4>
            <textarea name="rule" class="form-control" rows="5">{{ $wxCasa->rule or '' }}</textarea>
        </div>
        <div class="col-lg-11">
            <h4>图文说明</h4>
            <ul class="nav nav-tabs select-method-nav">
                <li class="active">
                    <a href="#select_casa" data-target="#select_casa" aria-expanded="false">使用已上传民宿</a>
                </li>
                <li>
                    <a href="#select_self" data-target="#select_self" aria-expanded="false">手动编写</a>
                </li>
            </ul>
            <div class="tab-content col-lg-11">
                <div class="tab-pane active" id="select_casa">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#casaSelectModal">
                        选择民宿
                    </button>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                </div>
                <div class="tab-pane" id="select_self">
                    <!-- 主图 -->
                    <div class="main-photo col-lg-12">
                        <h4>上传民宿缩略图</h4>
                        <div class="input-group input-group-sm col-lg-10 reminder">插入多张无意义，只取第一张</div>
                        <div class="input-group input-group-sm col-lg-10 reminder">最佳分辨率比例1.6：1，比如320：200。</div>
                        <!-- OSS start -->
                        <div class="oss_photo_tool col-lg-12 clearfix" target_folder="casa" file_prefix="casa" limit_size="1024"
                                oss_address="{{Config::get("casarover.oss_external")}}">
                            <div class="oss_button">
                                <button type="button" class="show_uploader btn btn-info btn-sm">插入图片</button>
                            </div>
                            <div class="oss_hidden_input">
                                @if (isset($wxCasa->attachment))
                                    <input type="hidden" class="hidden_photo" value="{{$wxCasa->attachment->filepath}}"/>
                                @endif
                            </div>
                            <div class="oss_photo"></div>
                        </div>
                        <!-- OSS end -->
                    </div>
                    <!-- 民宿图文内容 -->
                    <div class="content col-lg-12">
                        <h4>图文内容</h4>
                        <div class="name col-lg-2 vertical5">
                            <input type="text" class="form-control" value="{{$content->name or ''}}" aria-describedby="sizing-addon3" />
                        </div>
                        <div class="col-lg-10 vertical5">
                            <button type="button" class="btn btn-info add_content">插入内容</button>
                            <button type="button" class="btn btn-info del_content">删除内容</button>
                        </div>
                        <!-- OSS start -->
                        <div class="oss_photo_tool col-lg-12 clearfix" target_folder="casa" file_prefix="casa" limit_size="1024"
                                oss_address="{{Config::get("casarover.oss_external")}}">
                            <div class="oss_button">
                                <button type="button" class="show_uploader btn btn-info btn-sm">插入图片</button>
                            </div>
                            <div class="oss_hidden_input">
                            </div>
                            <div class="oss_photo"></div>
                        </div>
                        <!-- OSS end -->
                        <textarea name="text" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="btn_div col-lg-11">
        <button class="btn btn-primary submit_btn">提交</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="casaSelectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">选择一家民宿</h4>
          </div>
          <div class="modal-body" style="height:500px; overflow:scroll;">
              <div class="search">
                  <input type="text" value="" id="search" />
                  <button class="glyphicon glyphicon-search" id="enlarge"></button>
                  <button class="glyphicon glyphicon-repeat" id="reset"></button>
              </div>
              <table class="table table-hover">
                  <tr>
                      <td>1-1</td>
                      <td>上海宏泉艾瑞酒店</td>
                      <td><button type="button" class="btn btn-info btn-sm">Select</button></td>
                  </tr>
                  <tr>
                      <td>1-2</td>
                      <td>微风山谷旅店</td>
                      <td><button type="button" class="btn btn-info btn-sm">Select</button></td>
                  </tr>
              </table>
          </div>
        </div>
      </div>
    </div>
@stop
