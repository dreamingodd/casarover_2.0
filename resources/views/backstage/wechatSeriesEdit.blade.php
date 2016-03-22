@extends('back')

@section('title', '探庐者后台-民宿列表')

@section('body')
 <form id="wechat_series_form" method="post" action="wechatSeriesEdits">
        <div class="col-lg-12">
            <h4>类别</h4>
            <div class="text vertical5 col-lg-2">
                <input disabled id="type" name="type" type="text" class="form-control" value="探庐系列" aria-describedby="sizing-addon3"/>
            </div>
        </div>
        <div class="col-lg-12">
            <h4>名称</h4>
            <div class="name vertical5 col-lg-2">
                <input id="name" name="name" type="text" class="form-control" value="" aria-describedby="sizing-addon3" />
            </div>
        </div>
        <div class="col-lg-12">
            <input type="submit" style="margin-left: 15px; margin-top: 30px;" class="btn btn-info" value="提交"/>
        </div>
    </form>
@stop