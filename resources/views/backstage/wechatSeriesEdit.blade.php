@extends('back')

@section('title', '探庐者后台-民宿列表')
@section('head')
    <script src="//requirejs.org/docs/release/2.1.11/comments/require.js" data-main="/assets/js/OssPhotoUploader.js"></script>
    <script src="/assets/js/wechatSeriesEdit.js" type="text/javascript"></script>
@endsection
@section('body')
 <form id="wechat_series_form" method="post" action="/back/wechatSeriesStore">
    <input name="_token" type="hidden" value="<?php echo csrf_token(); ?>">
     <input type="hidden" name="pic" value="{{ $series->attachment->filepath or null }}" id="pic">
     <input type="hidden" name="id" value="{{ $series->id or null }}">
     <div class="col-lg-12">
            <h4>类别</h4>
            <div class="text vertical5 col-lg-2">
                <input disabled id="type" name="type" type="text" class="form-control" value="探庐系列" aria-describedby="sizing-addon3"/>
            </div>
        </div>
        <div class="col-lg-12">
            <h4>名称</h4>
            <div class="name vertical5 col-lg-2">
                <input id="name" name="name" type="text" class="form-control" value="{{ $series->name or null }}" aria-describedby="sizing-addon3" />
            </div>
        </div>
     <div class="col-md-12">
         <p>上传介绍图片</p>
         <!-- OSS start -->
         <div class="oss_photo_tool col-lg-12 clearfix" target_folder="image" file_prefix="image" limit_size="1024"
              oss_address="{{Config::get("casarover.oss_external")}}">
             <div class="oss_button">
                 <button class="show_uploader btn btn-primary btn-sm" type="button">插入图片</button>
             </div>
             <div class="oss_hidden_input">
                 @if(isset($series->attachment))
                     <input type="hidden" class="hidden_photo" value="{{ $series->attachment->filepath }}"/>
                 @endif
             </div>
             <div class="oss_photo"></div>
         </div>
         <!-- OSS end -->
         <label for="text">简介</label>
         <textarea name="brief" id="" cols="30" rows="10" class="form-control">{{ $series->brief or null }}</textarea>
     </div>
        <div class="col-lg-12">
            <input type="submit" style="margin-left: 15px; margin-top: 30px;" class="btn btn-info" onclick="sed()" value="提交"/>
            @if($errors->any())
                <ul class="list-group">
                    @foreach($errors->all() as $error)
                        <li class=" list-group-item list-group-item-warning" style="margin-top: 5px">{{$error}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </form>

@stop