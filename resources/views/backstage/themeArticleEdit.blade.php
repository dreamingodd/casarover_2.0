@extends('back')
@section('head')
    <script src="{{ asset('assets/js/integration/vue.js') }}" type="text/javascript"></script>
    <script src="//requirejs.org/docs/release/2.1.11/comments/require.js" data-main="/assets/js/OssPhotoUploader.js"></script>
    <script src="{{ asset('assets/js/themeEdit.js') }}" type="text/javascript"></script>
    <script src="/assets/js/casaSelectModal.js"></script>
@endsection
@section('body')
    <input type="hidden" id="page" value="home"/>
    <form action="/back/theme/article/store" id="themeForm" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="id" value="{{ $article->id or null }}">
        <input type="hidden" name="pic" value="{{ $article->contents[0]->attachment->filepath or null }}" id="pic">
        <p>选择文章所属主题</p>
        <select name="theme" id="sel" class="form-control">
            @foreach($themes as $theme)
                <option value="{{ $theme->id }}" >{{ $theme->name }}</option>
            @endforeach
        </select>
        <label for="title">标题</label>
        <input type="text" name="name" class="form-control" value="{{ $article->name or null }}">
        <h4 style="color: red">最佳像素400*260</h4>
        <p>上传介绍图片</p>
        <!-- OSS start -->
        <div class="oss_photo_tool col-lg-12 clearfix" target_folder="image" file_prefix="image" limit_size="1024"
             oss_address="{{Config::get("casarover.oss_external")}}">
            <div class="oss_button">
                <button class="show_uploader btn btn-primary btn-sm" type="button">插入图片</button>
            </div>
            <div class="oss_hidden_input">
                @if(isset($article))
                    @if(count($article->attachments))
                        <input type="hidden" class="hidden_photo" value="{{ $article->attachments[0]->filepath }}"/>
                    @endif
                @endif
            </div>
            <div class="oss_photo"></div>
        </div>
        <!-- OSS end -->
        <label for="text">介绍内容</label>
        <textarea name="text" id="" cols="30" rows="10" class="form-control">{{ $article->text or null }}</textarea>
        <div class="col-md-4" style="margin: 10px">
            <p>点击选择关联民宿</p>
            <input type="text" id="select-casa" class="form-control disabled" data-toggle="modal"
                   data-target="#casaSelectModal" readonly value="{{ $casa->name or '选择所属民宿' }}">
            <input type="hidden" id="casa-id" name="casa" value="{{ $casa->id or null }}">
        </div>
        <div class="col-md-12">
            <p>排序(1-20之间的整数)</p>
            {{--最好的方式应该是和上面的选择主题框进行联动--}}
            <div class="col-md-4">
                <input type="text" name="order" class="form-control" value="{{ $article->display_order or null }}">
                <br>
            </div>
        </div>
        <div class="col-md-12">
            <div class="sub">
                <button id="themeSubmitBtn" type="button" class="btn btn-primary" onclick="sed()">保存</button>
            </div>
        </div>
    </form>
    <div class="modal fade" id="casaSelectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">搜索</h4>
                </div>
                <div class="modal-body" style="height:500px; overflow:scroll;">
                    <div class="search">
                        <input type="text" value="" id="search" />
                        <button class="glyphicon glyphicon-search" type="button" id="enlarge"></button>
                        <button class="glyphicon glyphicon-repeat" type="button" id="reset"></button>
                    </div>
                    <table class="table table-hover">
                        @foreach($casas as $casa)
                            <tr>
                                <td>{{ $casa->code }}</td>
                                <td>{{ $casa->name }}</td>
                                <td><button type="button" class="btn btn-info btn-sm" data-dismiss="modal" onclick='selectCasa({{ $casa->id }},"{{ $casa->name }}")'>选择</button></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    </form>
    <script>
        $("#sel-casa").val('{{ $article->house or null }}');
        @if(isset($article))
        $("#sel").val('{{ $article->themes[0]->id }}');
        @endif
    </script>
@endsection
