@extends('wechattemp')
@section('title','民宿预订')
@section('head')
    <link href="/assets/css/wxPay.css" rel="stylesheet"/>
@stop
@section('body')
    <p class="title"><span class="glyphicon glyphicon-th-list"></span>套餐选择 <a href="/bookdetails"  class="glyphicon glyphicon-remove"></a></p>
    <div class="room">
        <div class="name"><span><em></em></span><b>标间</b><u>￥929</u></div>
        <div class="detail">
            <div class="count">
            <span>预订<i id="count">1</i>间<span>
            <a class="reduce glyphicon glyphicon-minus"></a>
            <a class="add glyphicon glyphicon-plus"></a>
            </div>
            <p>入住高级房1晚，入住有效期：至2016年5月31日；不适用日期：2016年4月1日至4月3日；5月1日至5月3日；</p>
        </div>
    </div>
    <div class="room">
        <div class="name"><span><em></em></span><b>大床房</b><u>￥1229</u></div>
        <div class="detail">
            <div class="count">
            <span>预订<i id="count">1</i>间<span>
            <a class="reduce glyphicon glyphicon-minus"></a>
            <a class="add glyphicon glyphicon-plus"></a>
            </div>
            <p>入住高级房1晚，入住有效期：至2016年5月31日；不适用日期：2016年4月1日至4月3日；5月1日至5月3日；</p>
        </div>
    </div>
    <form action="" method="">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <input type="hidden" value="" id="counts">
        <p class="title"><span class="glyphicon glyphicon-user"></span>联系人信息</p>
        <div class="person">
            <input type="text" value="" placeholder="请输入姓名" >
            <input type="number" value="" placeholder="请输入11位手机号">
        </div>
        <input type="submit" class="btn" value=" 立即支付" />
    </form>
    <script>
        window.onload=function(){
            $('.name').click(function(){
                $(this).next().toggle();
                $(this).children('span').children('em').toggle();
            });
            $(".reduce").click(function(){
                var i =parseInt($(this).parents('.room').find('#count').html());
                if(i<=1)
                    return 0;
                $(this).parents('.room').find('#count').html(--i);
            });
            $(".add").click(function(){
                var i =parseInt($(this).parents('.room').find('#count').html());
                $(this).parents('.room').find('#count').html(++i);
            });
        }
    </script>
@stop
