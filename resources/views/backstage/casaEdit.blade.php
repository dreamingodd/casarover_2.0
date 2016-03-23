@extends('back')

@section('title', '探庐者后台-民宿编辑')
@section('head')
<script src="/assets/js/casa_edit.js"></script>
<script src="/assets/js/integration/json2.js"></script>
@stop
<?php use Illuminate\Support\Facades\Config; ?>
@section('body')
    <input type="hidden" id="page" value="casa"/>

    <input type="hidden" id="casa_id" value="{{$casa->id}}"/>
    <form id="casa_form" action="/back/casaEdit" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input id="casa_JSON_str" type="hidden" name="casa_JSON_str" />
    </form>

    <div class="name">
        <div class="input-group input-group-sm col-lg-3">
            <span class="input-group-addon" id="sizing-addon3">名称</span>
            <input id="name" type="text" class="form-control" aria-describedby="sizing-addon3"
                    value="{{$casa->name}}"/>
        </div>
    </div>
    <br />
    <div class="code">
        <div class="input-group input-group-sm col-lg-3">
            <span class="input-group-addon" id="sizing-addon3">编码</span>
            <input id="code" type="text" class="form-control" aria-describedby="sizing-addon3"
                    value="{{$casa->code}}"/>
        </div>
    </div>
    <br />
    <div class="link">
        <div class="input-group input-group-sm col-lg-10">
            <span class="input-group-addon" id="sizing-addon3">去哪定</span>
            <input id="link" type="text" class="form-control" aria-describedby="sizing-addon3"
                    value="{{$casa->link}}"/>
        </div>
    </div>
    <div class="main-photo">
        <h4>上传民宿缩略图</h4>
        <div class="input-group input-group-sm col-lg-10 reminder">插入多张无意义，只取一张</div>
        <div class="input-group input-group-sm col-lg-10 reminder">最佳分辨率比例1.6：1，比如320：200。</div>
        <!-- OSS start -->
        <div class="oss_photo_tool col-lg-12 clearfix" target_folder="casa" file_prefix="casa" limit_size="1024"
                oss_address="{{Config::get("casarover.oss_external")}}">
            <div class="oss_button">
                <button class="show_uploader btn btn-primary btn-sm">插入图片</button>
            </div>
            <div class="oss_hidden_input">
                @if (!empty($casa->attachment))
                    echo '<input type="hidden" class="hidden_photo" value="{{$casa->attachment->filepath}}"/>';
                @endif
            </div>
            <div class="oss_photo"></div>
        </div>
        <!-- OSS end -->
    </div>
    <div class="tags">
        <h4>标签 <small style="color:red;">自定义标签请使用 "逗号" 分隔，不要使用、\ / 。等等</small>
        </h4>
            @foreach ($officialTags as $tag)
                @if ($tag->selected == 1)
                    <span db_id="{{$tag->id}}" class="label label-info">{{$tag->name}}</span>
                @else
                    <span db_id="{{$tag->id}}" class="label label-default">{{$tag->name}}</span>
                @endif
            @endforeach
    </div>
    <div class="user_tags" style="margin-top: 15px;">
        <div class="input-group input-group-sm col-lg-5">
            <span class="input-group-addon" id="sizing-addon3">自定义标签</span> <input id="user_tags" type="text"
                    value="{{$casa->customTagsStr}}" class="form-control" aria-describedby="sizing-addon3" />
        </div>
    </div>

    <div class="submit-btns">
        <button id="submit_btn" class="btn btn-primary">提交</button>
    </div>
@stop
