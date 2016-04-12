@extends('back')
@section('head')
    <script src="{{ asset('assets/js/integration/vue.js') }}" type="text/javascript"></script>
    <script src="//requirejs.org/docs/release/2.1.11/comments/require.js" data-main="/assets/js/OssPhotoUploader.js"></script>
    <script src="{{ asset('assets/js/areaedit.js') }}" type="text/javascript"></script>
@endsection
@section('body')
    <div class="container"></div>
    <form action="back/theme/save" id="area-form" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <p>所属主题</p>
        <select name="" id="" class="form-control">
            <option value="">第一个主题</option>
            <option value="">第二个主题</option>
        </select>
        <p>上传介绍图片</p>
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
        <label for="title">标题</label>
        <input type="text" name="title" class="form-control">
        <label for="text">介绍内容</label>
        <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>
        <div class="sub">
            <button v-on:click="sed()" type="submit" class="btn btn-primary">保存</button>
    </form>
    {{--<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete">--}}
    {{--<i class="fa fa-times-circle"></i>--}}
    {{--删除--}}
    {{--</button>--}}
    {{--<div class="modal fade" id="modal-delete" tabIndex="-1">--}}
    {{--<div class="modal-dialog">--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<button type="button" class="close" data-dismiss="modal">--}}
    {{--×--}}
    {{--</button>--}}
    {{--<h4 class="modal-title">注意</h4>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}
    {{--<p class="lead">--}}
    {{--<i class="fa fa-question-circle fa-lg"></i>--}}
    {{--确定删除吗？--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--<div class="modal-footer">--}}
    {{--<form method="POST" action="{{ route('back.areas.destroy',$message->id ) }}">--}}
    {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
    {{--<input type="hidden" name="_method" value="DELETE">--}}
    {{--<button type="button" class="btn btn-default" data-dismiss="modal">关闭--}}
    {{--</button>--}}
    {{--<button type="submit" class="btn btn-danger">--}}
    {{--<i class="fa fa-times-circle"></i> 确定删除--}}
    {{--</button>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    </div>
    </form>
@endsection