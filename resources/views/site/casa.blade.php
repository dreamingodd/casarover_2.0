@extends('site')
@section('title',$casa->name)
@section('head')
    <link rel="stylesheet" href="/assets/css/casa.css">
@endsection
@section('body')
    <div class="navtop">
        <h1>{{ $casa->name }}</h1>
        <p><a href="/">首页</a> > <a href="/allcasa/{{ $city->id }}">{{ $city->value }}</a> > <a href=""><span>{{ $casa->name }}</span></a></p>
    </div>
    <article class="casa-article">
        <div class="article-main">
            @foreach($casa->contents as $content)
                <h2>{{ $content->name }}</h2>
                <p>{!! $content->text !!}</p>
                @foreach($content->attachments as $photo)
                    <img src="{{ config('casarover.photo_folder').$photo->filepath }}" alt="" width="100%">
                @endforeach
            @endforeach
        </div>
    </article>
    <div class="casa-mess">
        <div class="tag-list">
            <img src="{{ config('casarover.photo_folder').$casa->attachment->filepath }}" alt="{{ $casa->name }}"  width="100%" >
            <p>标签：
                @foreach($casa->tags as $tag)
                    <span>{{ $tag->name }}</span>
                @endforeach
            </p>
        </div>
    </div>

    <div class="casa-mess" id="others">
        <section>
            <h2>猜你喜欢</h2>
            @foreach($casas as $casa)
                <div class="card">
                    <a href="/casa/{{ $casa->id }}" >
                        <img src="{{ config('casarover.photo_folder').$casa->attachment->filepath }}" width="100%" alt="{{ $casa->name }}">
                        <h3>{{ $casa->name }}</h3>
                        <p>标签：
                            @foreach($casa->tags as $key=>$tag)
                                @if($key<3)
                                    <span class="tip">{{ $tag->name }}</span>
                                @endif
                            @endforeach
                        </p>
                    </a>
                </div>
            @endforeach
        </section>
    </div>
    <script>
        //BR首行缩进
        $(function ($) {
            $('.article-main p ').each(function(){
                $(this).html($(this).html().replace(/BR/ig, 'p><p'));
            });
        });
    </script>
@endsection