@extends('site')
@section('title','民宿')
@section('head')
    <link rel="stylesheet" href="/assets/css/themerecommend.css">
@endsection
@section('body')
    <div class="main">
        <div class="left">
            <h1>{{ $theme->name }}</h1>
            @foreach($theme->contents as $article)
                <a href="/">
                    <div class="case">
                        @if(count($article->attachments))
                            <img src="{{ config('casarover.image_folder').$article->attachments[0]->filepath }}" alt="">
                        @endif
                        <div class="articles">
                            <h2>{{ $article->name }}</h2>
                            <p>{{ $article->text }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="right">
            <h2>其他主题：</h2>
            {{--@foreach($others as $theme)--}}
            <div class="other">
                <a href="/">
                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/casa_201601291648068414.png" alt="">
                    <p>{{ $theme->name }}</p>
                </a>
            </div>
            {{--@endforeach--}}
        </div>
    </div>
@endsection
