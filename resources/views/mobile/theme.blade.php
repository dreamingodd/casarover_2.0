@extends('mobile')
@section('title','主题民宿')
@section('head')
    <link rel="stylesheet" href="/assets/css/mobiletheme.css">
    <script src="/assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
@endsection
@section('body')
    <div class="all">
        <div class="main">
            <div class="left">
                <h1>{{ $theme->name }}</h1>
                @foreach($contents as $article)
                    <a
                            @if($article->house)
                            href="/mobile/casa/{{ $article->house }}"
                            @endif
                    >
                        <div class="case">
                            @if(count($article->attachments))
                                <img src="{{ config('casarover.image_folder').$article->attachments[0]->filepath }}" alt="">
                            @endif
                            <div class="articles">
                                <h2>{{ $article->name }}</h2>
                                <p>{!! $article->text !!}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="right">
                <h2>其他主题</h2>
                @foreach($others as $theme)
                    <div class="line"></div>
                    <a href="/mobile/theme/{{ $theme->id }}">
                        <p>{{ $theme->name }}</p>
                    </a>
                @endforeach
                {{--<div class="flexslider">--}}
                    {{--<ul class="slides">--}}
                        {{--@foreach($others as $theme)--}}
                            {{--<li style="background:url({{ $theme->pic }}) ; background-size:100% 100%;">--}}
                                {{--<a href="{{ $theme->id }}" target="_blank" class="slide-a">--}}
                                    {{--<div class="slide-mess">--}}
                                        {{--{{$theme->name }}--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                    {{--</ul>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@stop
