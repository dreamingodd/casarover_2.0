@extends('back')
@section('head')
    <script src="//requirejs.org/docs/release/2.1.11/comments/require.js" data-main="/assets/js/OssPhotoUploader.js"></script>
    <script src="/assets/js/areaedit.js" type="text/javascript"></script>
@endsection
@section('body')
    <input type="hidden" id="page" value="area"/>
    <form action="{{ route('back.areas.update',$message->id) }}" id="area-form" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="_method" value="PUT">
        {{--所有图片的字段--}}
        <input type="hidden" name="photos" id="photos" value=>
        <div class="head">
            <h3>基本信息</h3>
            <div class="photo">
                <h3>导航图</h3>
                <span class="reminder">上传一张图(图片宽高比必须在3:1以上)</span>
                <!-- OSS start -->
                <div class="oss_photo_tool col-lg-12 clearfix" target_folder="area" file_prefix="area" limit_size="1024"
                     oss_address="{{Config::get("casarover.oss_external")}}">
                    <div class="oss_button">
                        <button class="show_uploader btn btn-primary btn-sm" type="button">插入图片</button>
                    </div>
                    <div class="oss_hidden_input">
                        @if(isset($message->contents[1]))
                            @if(isset($message->contents[1]->attachments[0]))
                                <input type="hidden" class="hidden_photo" value="{{ $message->contents[1]->attachments[0]->filepath }}"/>
                            @endif
                        @endif
                    </div>
                    <div class="oss_photo"></div>
                </div>
                <!-- OSS end -->
                <h3>区域名</h3>
                <input type="text" class="form-control" name="name" value="{{ $message->value }}" />
                <h3>简介</h3>
                <textarea class="form-control" name="content0" rows="3" >@if(isset($message->contents[0])){{ $message->contents[0]->text }}@endif</textarea>
            </div>
        </div>
        <h3>攻略内容</h3>
        <textarea class="form-control" rows="3" name="content1">@if(isset($message->contents[1])){{ $message->contents[1]->text }}@endif</textarea>
        <hr>
        <div class="raiders">
            <p>到下面的这个网站选取坐标和层级然后复制过来</p>
            <a href="http://lbs.amap.com/console/show/picker" target="_blank">
                高德地图坐标拾取器
            </a>
            <h3>坐标</h3>
            <input type="text" class="form-control"  value="{{ $message->position }}" name="position" placeholder="从坐标拾取复制过来" />
            <h3>层级(没有特殊需求填写15)</h3>
            <input type="text" class="form-control"  value="{{ $message->tier }}" name="tier" placeholder="显示层级" />
        </div>

        <h3>附近景点</h3>
        <p class="text-danger">一个景点一张图片，请把多余的删掉(图片大小490*300)</p>
        @for($con=2; $con<5; $con++)
                <!-- OSS start -->
        <div class="oss_photo_tool col-lg-12 clearfix" target_folder="area" file_prefix="area" limit_size="1024"
             oss_address="{{Config::get("casarover.oss_external")}}">
            <div class="oss_button">
                <button class="show_uploader btn btn-primary btn-sm" type="button">插入图片</button>
            </div>
            <div class="oss_hidden_input place-photos">
                @if(isset($message->contents[$con]))
                    @if (empty($message->contents[$con]->attachments))
                        @foreach($message->contents[$con]->attachments as $photo)
                            <input type="hidden" class="hidden_photo " value="{{ $photo->filepath }}"/>
                        @endforeach
                    @endif
                @endif
            </div>
            <div class="oss_photo"></div>
        </div>

        <!-- OSS end -->
        <textarea class="form-control" rows="4" name="content{{ $con }}" placeholder="对景点的描述">@if(isset($message->contents[$con])){{ $message->contents[$con]->text }}@endif</textarea>
        @endfor

        <div class="sub">
            <button onclick="sed()" type="submit" class="btn btn-primary">保存</button>
    </form>
    </div>
    </form>
@endsection
