@extends('back')

@section('title', '探庐者后台-新建民宿')
@section('head')
<script src="//requirejs.org/docs/release/2.1.11/comments/require.js" data-main="/assets/js/OssPhotoUploader.js"></script>
<script src="/assets/js/casa_edit.js"></script>
<script src="/assets/js/integration/json2.js"></script>
<style>
.col-lg-12 {
    margin: 2px 0 3px 0;
}
</style>
@stop
<?php use Illuminate\Support\Facades\Config; ?>
@section('body')
    <input type="hidden" id="page" value="casa"/>

    <input type="hidden" id="casa_id" value="{{isset($casa)?$casa->id:""}}"/>
    <form id="casa_form" action="/back/casaEdit" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input id="casa_JSON_str" type="hidden" name="casa_JSON_str" />
    </form>

    <div class="name col-lg-12">
        <div class="input-group input-group-sm col-lg-3">
            <span class="input-group-addon" id="sizing-addon3">名称</span>
            <input id="name" type="text" class="form-control" aria-describedby="sizing-addon3"
                    value="{{isset($casa)?$casa->name:""}}"/>
        </div>
    </div>
    <div class="code col-lg-12">
        <div class="input-group input-group-sm col-lg-3">
            <span class="input-group-addon" id="sizing-addon3">编码</span>
            <input id="code" type="text" class="form-control" aria-describedby="sizing-addon3"
                    value="{{isset($casa)?$casa->code:""}}"/>
        </div>
    </div>
    <div class="link col-lg-12">
        <div class="input-group input-group-sm col-lg-10">
            <span class="input-group-addon" id="sizing-addon3">去哪定</span>
            <input id="link" type="text" class="form-control" aria-describedby="sizing-addon3"
                    value="{{isset($casa)?$casa->link:""}}"/>
        </div>
    </div>
    <div class="main-photo col-lg-12">
        <h4>上传民宿缩略图</h4>
        <div class="input-group input-group-sm col-lg-10 reminder">插入多张无意义，只取第一张</div>
        <div class="input-group input-group-sm col-lg-10 reminder">最佳分辨率比例1.6：1，比如320：200。</div>
        <!-- OSS start -->
        <div class="oss_photo_tool col-lg-12 clearfix" target_folder="casa" file_prefix="casa" limit_size="1024"
                oss_address="{{Config::get("casarover.oss_external")}}">
            <div class="oss_button">
                <button class="show_uploader btn btn-primary btn-sm">插入图片</button>
            </div>
            <div class="oss_hidden_input">
                @if (isset($casa->attachment))
                    <input type="hidden" class="hidden_photo" value="{{$casa->attachment->filepath}}"/>
                @endif
            </div>
            <div class="oss_photo"></div>
        </div>
        <!-- OSS end -->
    </div>
    <!-- Tag section starts -->
    <div class="tags col-lg-12">
        <h4>标签 <small style="color:red;">自定义标签请使用 "逗号" 分隔，不要使用、\ / 。等等</small>
        </h4>
        @if (isset($officialTags))
            @foreach ($officialTags as $tag)
                @if ($tag->selected == 1)
                    <span db_id="{{$tag->id}}" class="label label-info">{{$tag->name}}</span>
                @else
                    <span db_id="{{$tag->id}}" class="label label-default">{{$tag->name}}</span>
                @endif
            @endforeach
        @endif
    </div>
    <div class="user_tags col-lg-12">
        <div class="input-group input-group-sm col-lg-5">
            <span class="input-group-addon" id="sizing-addon3">自定义标签</span> <input id="user_tags" type="text"
                    value="{{isset($casa)?$casa->customTagsStr:""}}" class="form-control" aria-describedby="sizing-addon3" />
        </div>
    </div>
    <!-- Tag section ends. -->

    <!-- Area section starts -->
    <div id="area_div" class="area col-lg-12">
        <input id="area" type="hidden" value="{{isset($casa)?$casa->area->id:''}}"/>
        <h4>地区</h4>
        <span id="area_fullname" style="margin-left:15px;">{{isset($casa)?$casa->area_name:''}}</span>
        <input type="hidden" id="areas_json" value="{{$areaHierarchyJson}}"/>
        <div class="dropdown col-lg-12 vertical5">
            <div id="provinces" style="float: left; margin-right: 5px;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="area_text">省</span> <span class="caret"></span>
                </button>
                <ul id="province_ul" class="dropdown-menu" aria-labelledby="dropdownMenu1">
                </ul>
            </div>
            <div id="cities" style="float: left; margin-right: 5px;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="area_text">市</span> <span class="caret"></span>
                </button>
                <ul id="city_ul" class="dropdown-menu" aria-labelledby="dropdownMenu1">
                </ul>
            </div>
            <div id="districts" style="float: left;">
                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <span class="area_text">区</span> <span class="caret"></span>
                </button>
                <ul id="district_ul" class="dropdown-menu" aria-labelledby="dropdownMenu1">
                </ul>
            </div>
        </div>
    </div>
    <!-- Area section ends. -->

    <h4>内容</h4>
    @if (isset($casa))
        <!-- Content section starts -->
        @foreach ($casa->contents as $content)
            <div class="content">
                <div class="name col-lg-2 vertical5">
                    <input type="text" class="form-control" value="{{$content->name}}" aria-describedby="sizing-addon3" />
                </div>
                <div class="col-lg-10 vertical5">
                    <button type="button" class="btn btn-info add_content">插入内容</button>
                    <button type="button" class="btn btn-info del_content">删除内容</button>
                </div>
                <!-- OSS start -->
                <div class="oss_photo_tool col-lg-12 clearfix" target_folder="casa" file_prefix="casa" limit_size="1024"
                        oss_address="{{Config::get("casarover.oss_external")}}">
                    <div class="oss_button">
                        <button class="show_uploader btn btn-primary btn-sm">插入图片</button>
                    </div>
                    <div class="oss_hidden_input">
                            <input type="hidden" class="hidden_photo" value=""/>
                    </div>
                    <div class="oss_photo"></div>
                </div>
                <!-- OSS end -->
                <div class="text col-lg-12 vertical5">
                    <textarea rows="3" cols="150">{{$content->text}}</textarea>
                </div>
            </div>
        @endforeach
        <!-- Content section ends. -->

    @else

        <!-- Content's Template starts. -->
        <?php include_once '\assets\html\contentsTemplate.html' ?>
        <!-- Content's Template ends. -->
    @endif

    <div class="submit-btns">
        <button id="submit_btn" class="btn btn-primary">提交</button>
    </div>

    <!-- a method to clear fix -->
    <textarea style="visibility:hidden;" rows="1" cols="150"></textarea>
    <!-- a method to clear fix -->
@stop
