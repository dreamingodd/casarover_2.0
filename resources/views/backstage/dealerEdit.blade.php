@extends('back')

@section('title', '探庐者后台-编辑经销商')
@section('head')
<style>
.col-lg-12 {
    margin: 2px 0 3px 0;
}
</style>
@stop
@section('body')
    <input type="hidden" id="page" value="reserve"/>

    <form id="dealer_form" action="/back/dealer/update" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" name="id" value="{{ $dealer->id }}"/>

        <div class="col-lg-11 alert alert-warning">
            Code为经销商call web service 时的凭证和生成url的认证标识。<br />
            会自动生成18位Key作为web service的密钥，注意不要泄漏。
        </div>

        <div class="name col-lg-12">
            <div class="input-group input-group-sm col-lg-3">
                <span class="input-group-addon" id="sizing-addon3">名称</span>
                <input id="name" type="text" class="form-control" aria-describedby="sizing-addon3"
                        name="name" value="{{ $dealer->name }}"/>
            </div>
        </div>
        <div class="code col-lg-12">
            <div class="input-group input-group-sm col-lg-3">
                <span class="input-group-addon" id="sizing-addon3">code</span>
                <input id="name" type="text" class="form-control" aria-describedby="sizing-addon3"
                        name="code" value="{{ $dealer->code }}"/>
            </div>
        </div>
        <div class="code col-lg-12">
            <button class="btn btn-primary">提交</button>
        </div>
    </form>
@stop
