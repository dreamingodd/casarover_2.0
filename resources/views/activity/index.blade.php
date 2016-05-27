@extends('activity')
@section('title','约睡')
@section('head')
    <link rel="stylesheet" href="/assets/css/activity.css">
@stop
@section('body')
    <div class="banner">
        <img src="/assets/images/activity/banner.png" alt="">
    </div>
    <div class="main clear">
        @foreach($data as $key=>$casa)
            <a href="/wx/date/casa/{{ $casa->id }}">
                <div class="case">
                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$casa->thumbnail}}"
                         alt="{{$casa->thumbnail}}">
                    <span>{{ $key+1 }}</span>
                    <img src="/assets/images/activity/mask.png" alt="mask" class="mask">
                    <div class="article">
                        <h3>{{ $casa->name }}</h3>
                        <h4>想睡：{{ $casa->gross }}人</h4>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <script>
        //        $(function () {
        //            $('.case').each(function(i){
        //            $(this).click(function () {
        //                $('.detail').eq(i).show();
        //                $('.bg').addClass('blur');
        //                $('body').css('overflow','hidden');
        //                });
        //            });
        //            $('.md-close').click(function () {
        //                $(this).parent().hide();
        //                $('.bg').removeClass('blur');
        //                $('body').css('overflow','auto');
        //                    }
        //            )
        //        });
    </script>
@stop