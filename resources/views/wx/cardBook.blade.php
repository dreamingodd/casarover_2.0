@extends('wxBase')
@section('title','民宿预订')
@section('head')
    <link href="/assets/css/cardBook.css" rel="stylesheet"/>
    <script src="/assets/js/wxBase.js" type="text/javascript"></script>
@stop
@section('body')
    <div class="main">
        @if($isMe)
            <h2>民宿预订</h2>
        @else
            <h2>申请预订</h2>
        @endif
        <div class="case clear" >
            <div class="casecon clear">
                <input type="hidden" id="left" value="{{ $casa->Opportunity->left_quantity }}">
                <img src="{{ $casa->photo_path }}" alt="">
                <div class="article">
                    <h3>{{ $casa->name }}</h3>
                    <div class="articlecon">
                        <p>预订间数：</p>
                        <span  class="glyphicon glyphicon-minus" onclick="minus()"></span>
                        <span id="number">1</span>
                        <span class="glyphicon glyphicon-plus" onclick="plus()"></span>
                        <p>剩余间数：{{ $casa->Opportunity->left_quantity }}</p>
                    </div>
                </div>
            </div>
        </div>
        <form action="/wx/user/card/book" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <input type="hidden" name="id" value="{{ $casa->id }}">
            <input type="hidden" name="number" id="booknumber">
            <div class="input">
                <label for="name">*姓名</label>
                <input type="text" name="name" id="name" value="{{ $user->realname or '' }}">
            </div>
            <div class="input">
                <label for="tel">*手机号码</label>
                <input type="text" name="tel" value="{{ $user->cellphone or '' }}" id="tel">
            </div>
            <div class="input">
                {{--<label for="remark">备注</label>--}}
                {{--<input type="text" name="remark" id="remark">--}}
            </div>
    @if($isMe)
        {{--自己购买--}}
        <button type="submit" class="sub" onclick="send()">提&nbsp;&nbsp;交</button>
    @else
        {{--别人进行申请--}}
        <button type="submit" class="sub" onclick="send()">申&nbsp;&nbsp;请</button>
        @endif
        </form>

        <script>
            function plus(){
                var i=$('#number').html();
                var i = parseInt(i);
                var left = $('#left').val();
                if(i >= left){
                    return null;
                }
                $('#number').html(++i);
            }
            function minus(){
                var i=$('#number').html();
                if(i<=1)
                    return 0;
                $('#number').html(--i);
            }
            function send(){
                var number = $('#number').html();
                $("#booknumber").val(number);
            }
        </script>
@stop
