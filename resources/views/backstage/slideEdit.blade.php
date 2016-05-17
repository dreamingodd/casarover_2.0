@extends('back')
@section('head')
    <script src="//requirejs.org/docs/release/2.1.11/comments/require.js" data-main="/assets/js/OssPhotoUploader.js"></script>
@endsection
@section('body')
    {{--<input type="hidden" id="page" value="home"/>--}}
    <form action="/back/slide/store" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="id" value="{{ $slide->id or '' }}">
        <input type="hidden" name="type" value="{{ $slide->type or $type }}">
        <input type="hidden" name="photo" id="photos" value=>
        <h3>标题</h3>
        <input type="text" class="form-control" name="title" value="{{ $slide->title or '' }}">
        <h3>简介</h3>
        <textarea name="brief" id="" cols="30" rows="3" class="form-control">{{ $slide->brief or '' }}</textarea>
        <h3>大图(1350*450以上)</h3>
        <!-- OSS start -->
        <div class="oss_photo_tool col-lg-12 clearfix" target_folder="casa" file_prefix="casa" limit_size="1024"
             oss_address="{{Config::get("casarover.oss_external")}}">
            <div class="oss_button">
                <button class="show_uploader btn btn-primary btn-sm" type="button">插入图片</button>
            </div>
            <div class="oss_hidden_input">
                @if(!empty($slide->attachment->filepath))
                    <input type="hidden" class="hidden_photo" name="pic" value="{{ $slide->attachment->filepath}}"/>
                @endif
            </div>
            <div class="oss_photo"></div>
        </div>
        <!-- OSS end -->
        <h3>对应民宿</h3>
        <select name="casa" class="form-control" id="sel">
            @foreach($casas as $casa)
                <option value="{{ $casa->id }}">{{ $casa->id }}--{{ $casa->name }}</option>
            @endforeach
        </select>
        <button class="btn btn-primary" type="submit" id="submit">保存</button>
    </form>

    <script>
        $("#sel").val("{{ $slide->casa_id or 1 }}");
        $("#submit").click(function(){
            var photo = $(".oss_hidden_input input").val();
            $("#photos").val(photo);
        })
    </script>
@endsection
