@extends('activity')
@section('title','民宿详情')
@section('head')
    <link rel="stylesheet" href="/assets/css/activityCasa.css">
@stop
@section('body')
    <div class="bg">
        <div class="detail">
        <img src="/assets/images/activity/detail1.png" alt="">
        <input type="hidden" value="{{$check}}" id="check">
        <div class="divide clear">
            <div class="detailcon">
                @if (empty($wxCasa->casa_id))
                    @foreach ($wxCasa->contents as $content)
                        <h4>{{$content->name}}</h4>
                        @foreach ($content->attachments as $attachment)
                            <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$attachment->filepath}}"/>
                        @endforeach
                        <p style="font-size: smaller">{!!$content->text!!}</p>
                    @endforeach
                @else
                    @foreach ($wxCasa->casa->contents as $content)
                        <h4>{{$content->name}}</h4>
                        @foreach ($content->attachments as $attachment)
                            <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$attachment->filepath}}"/>
                        @endforeach
                        <p>{!!$content->text!!}</p>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="button">
            <a href = "/wx/date/datesleep" id="datesleep">约睡</a>
        </div>
    </div>
    </div>
    <div class="qrcode">
        <div class="qrcodecon">
            <img src="/assets/images/activity/qrcode.png" alt="">
        </div>
        <img src="/assets/images/activity/close.png" alt="" class="md-close">
    </div>
    <script>
        $(function () {
            if($('#check').val()==0) {
                $('#datesleep').removeAttr('href');
                $('#datesleep').click(function () {
                    $('.bg').addClass('blur');
                    $('.qrcode').show();
                });
            }
            $('.md-close').click(function () {
                $('.bg').removeClass('blur');
                $('.qrcode').hide();
            });
            });
    </script>
@stop