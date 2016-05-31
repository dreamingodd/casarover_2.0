@extends('mobile')
@section('title','民宿推荐')
@section('head')
    <link rel="stylesheet" href="/assets/css/mobileCasa.css">
@endsection
@section('body')
    <div class="main">
        <!-- 民宿大图  -->
        <div class="banner">
            {{--<div class="cover-photo">--}}
            {{--<img src="{{ $casa->headImg }}" width="100%" alt="">--}}
            {{--</div>--}}
            <div class="show-mess">
                <h1>{{ $casa->name }}</h1>
            </div>

        </div>
        </header>
        <div class="line"></div>
        <!-- 民宿介绍内容 -->
        <article class="casa-article">
            <div class="article-main">
                @foreach($casa->contents as $content)
                    <h2>{{ $content->name }}</h2>
                    <p>{!! $content->text !!}</p>
                    @foreach($content->attachments as $photo)
                        <img src="{{ config('config.photo_folder').$photo->filepath }}" alt="" width="100%">
                    @endforeach
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
        <div class="bottom">
            <h2>猜你喜欢</h2>
            @foreach($casas as $casa)
                <div class="m-casa-guess">
                    <a href="{{ $casa->id }}" class="slide-a">
                        <div class="head-img">
                            <img src="{{ config('config.photo_folder').$casa->attachment->filepath }}" width="100%" alt="casaheadimg">
                        </div>
                        <div class="title">
                            <p>
                                {{$casa->name }}
                            </p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@stop
