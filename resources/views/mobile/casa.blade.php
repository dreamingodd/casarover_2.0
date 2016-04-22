@extends('mobile')
@section('title','民宿推荐')
@section('head')
    {{--<link rel="stylesheet" href="/assets/css/home.css">--}}
    <script src="/assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <style>
        .main{
            padding: 0 1rem;
            margin-bottom: 1rem;
        }
    </style>
@endsection
@section('body')
    <div class="main">
        <!-- 民宿大图  -->
    <div class="banner">
        <div class="cover-photo">
            <img src="{{ $casa->headImg }}" width="100%" alt="">
        </div>
        <div class="show-mess">
            <!-- <div class="mark">浏览233</div> -->
            <h1>{{ $casa->name }}</h1>
        </div>

    </div>
    </header>
    <!-- 民宿介绍内容 -->
    <article class="casa-article">
        <div class="article-main">
            @foreach($casa->contents as $content)
                @foreach($content->attachments as $photo)
                    <img src="{{ config('casarover.photo_folder').$photo->filepath }}" alt="" width="100%">
                @endforeach
                <h2>{{ $content->name }}</h2>
                <p>{!! $content->text !!}</p>
            @endforeach
        </div>
    </article>
    <div class="casa-mess">
        <div class="tag-list">
            @foreach($casa->tags as $tag)
                <a href="">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
    </div>
@stop