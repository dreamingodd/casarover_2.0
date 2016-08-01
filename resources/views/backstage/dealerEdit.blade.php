@extends('back')

@section('title', '探庐者后台-编辑经销商')
@section('head')
<script>
$(function(){
    $("#check_deal").attr('checked', $('#deal_mode').val() == 1 ? 1 : null);
    $("#check_coupon").attr('checked', $('#coupon_mode').val() == 1 ? 1 : null);
    $('#check_deal').click(function(){
        $('#deal_mode').val($('#deal_mode').val() == 1 ? 0 : 1);
    });
    $('#check_coupon').click(function(){
        $('#coupon_mode').val($('#coupon_mode').val() == 1 ? 0 : 1);
    });
});
</script>
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
        <input type="hidden" name="deal_mode" id="deal_mode" value="{{ $dealer->deal_mode }}"/>
        <input type="hidden" name="coupon_mode" id="coupon_mode" value="{{ $dealer->coupon_mode }}"/>

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
            <input type="checkbox" id="check_deal"/>&nbsp;链接模式 <br />
            <input type="checkbox" id="check_coupon"/>&nbsp;抵价券模式
        </div>
        <div class="code col-lg-12">
            <button class="btn btn-primary">提交</button>
        </div>
    </form>
@stop
