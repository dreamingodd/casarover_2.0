@extends('activity')
@section('title','民宿详情')
@section('head')
    <link rel="stylesheet" href="/assets/css/activityCasa.css">
@stop
@section('body')
    <div class="detail">
        <img src="/assets/images/activity/detail1.png" alt="">
        {{--<img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$wxCasa->thumbnail}}" alt="">--}}
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
            <a href="/activity/datesleep">约睡</a>
        </div>
    </div>
@stop