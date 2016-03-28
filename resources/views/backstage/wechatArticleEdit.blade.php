@extends('back')
@section('title', '探庐者后台-微信文章列表')
@section('head')
<script src="//requirejs.org/docs/release/2.1.11/comments/require.js" data-main="/assets/js/OssPhotoUploader.js"></script>
<script src="/assets/js/wechat_article_edit.js"></script>
@stop
@section('body')
    <input type="hidden" id="page" value="wechat"/>
    <div class="options vertical5">
        <a href="/back/wechatEdit">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加微信文章
        </a>
        <a href="/back/wechatList/1">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>探庐系列
        </a>
        <a href="/back/wechatList/2">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>民宿风采
        </a>
        <a href="/back/wechatList/3">
            <span class="glyphicon glyphicon-list" aria-hidden="true"></span>主题民宿
        </a>
        <a href="/back/wechatList/1/1">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>回收站
        </a>
    </div> 
    <div class="col-lg-12">
        <div class="dropdown col-lg-12 vertical5">
            <div id="" style="float:left;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="type_text">{{$fname}}</span> 
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li class="type_li" db_id="1">探庐系列</li>
                    <li class="type_li" db_id="2">民宿推荐</li>
                    <li class="type_li" db_id="3">主题民宿</li>
                </ul>
            </div>
           <div id="" style="float:left; margin-left:5px">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="series_text">{{$sname}}</span> <span class="caret"></span>
                </button>
                <ul id="series_ul" class="dropdown-menu" aria-labelledby="dropdownMenu2"
                        style="margin-left:115px;">
                </ul>
            </div>
        </div>
    </div>
    <!-- Here's the list of WechatSeries items. -->
    <div id="series_list" style="display: none;">
                <?php $number=1;?>
                @foreach ($wechatSeries as $series)
                    <span db_id="{{$number=1}}" name="{{$series->name}}" type="1"></span>
                @endforeach
            </div>
    <!-- Here's the list of WechatSeries items. -->
    <div class="small-photo col-lg-12">
        <h4>上传文章缩略图</h4>
        <div class="input-group input-group-sm col-lg-10
                reminder">最佳分辨率比例1.6：1，比如96:60。考虑微信页加载速度，图片大小不超过36K！</div>

        <!-- OSS start -->
        <div class="oss_photo_tool col-lg-12 clearfix" target_folder="casa" file_prefix="wechat" limit_size="36"
                oss_address="http://casarover.oss-cn-hangzhou.aliyuncs.com">
            <div class="oss_button">
                <button class="show_uploader btn btn-primary btn-sm">插入图片</button>
            </div>
            <div class="oss_hidden_input">
                            </div>
            <div class="oss_photo"></div>
        </div>
        <!-- OSS end -->
    </div>
    <form id="wechat_article_form" method="post" action="wechatEdit/{id?}">
        <input type="hidden" id="id" name="id" value=""/>
        <input type="hidden" id="attachment_id" name="attachment_id" value=""/>
        <input type="hidden" id="type" name="type" value="1"/>
        <input type="hidden" id="series" name="series" value=""/>
        <input type="hidden" id="deleted" name="deleted" value=""/>
        <div class="col-lg-12" style="margin-top: 30px;">
            <div class="input-group input-group-sm col-lg-10">
                <span class="input-group-addon" id="sizing-addon3">微信链接（必须微信端复制链接）</span>
                <input id="address" type="text" class="form-control" aria-describedby="sizing-addon3"
                        name="address" value="{{$wechatadd}}"/>
            </div>
        </div>
        <div class="col-lg-12">
            <h4>标题</h4>
            <div class="name vertical5 col-lg-3">
                <input id="title" name="title" type="text" class="form-control" value="{{$title}}" aria-describedby="sizing-addon3" />
            </div>
        </div>
        <div class="col-lg-12">
            <h4>简介</h4>
            <div class="text col-lg-12 vertical5">
                <textarea id="brief" name="brief" rows="3" cols="150">{{$brief}}</textarea>
            </div>
        </div>
    </form>
    <div class="col-lg-12">
        <button style="margin-left: 15px; margin-top: 30px;" class="btn btn-info" id="submit">提交</button>
    </div>
@stop