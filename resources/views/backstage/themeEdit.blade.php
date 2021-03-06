@extends('back')
@section('head')
    <script src="//requirejs.org/docs/release/2.1.11/comments/require.js" data-main="/assets/js/OssPhotoUploader.js"></script>
    <script src="{{ asset('assets/js/themeEdit.js') }}" type="text/javascript"></script>
@endsection
@section('body')
    <input type="hidden" id="page" value="home"/>
    <div class="container"></div>
    <form action="/back/theme/store" id="area-form" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="id" value="{{ $theme->id or null }}">
        <p>PS:新建主题默认不会显示在首页中</p>
        <p>主题名字</p>
        <input type="text" name="name" value="{{ $theme->name or null }}" class="form-control">
        <input type="hidden" name="pic" value="{{ $theme->attachment->filepath or null }}" id="pic">
        <p>上传介绍图片</p>
        <!-- OSS start -->
        <div class="oss_photo_tool col-lg-12 clearfix" target_folder="image" file_prefix="image" limit_size="1024"
             oss_address="{{Config::get("casarover.oss_external")}}">
            <div class="oss_button">
                <button class="show_uploader btn btn-primary btn-sm" type="button">插入图片</button>
            </div>
            <div class="oss_hidden_input">
                @if(isset($theme->attachment))
                    <input type="hidden" class="hidden_photo" value="{{ $theme->attachment->filepath }}"/>
                @endif
            </div>
            <div class="oss_photo"></div>
        </div>
        <!-- OSS end -->
        <label for="text">简介</label>
        <textarea name="brief" id="" cols="30" rows="10" class="form-control">{{ $theme->brief or null }}</textarea>
        <div class="sub">
            <button onclick="sed()" type="btn" class="btn btn-primary">保存</button>
        </div>
    </form>
    </div>
    </form>
@endsection
