@extends('site')
@section('title','探庐系列')
@section('head')
    <link rel="stylesheet" href="/assets/css/casaseries.css">
@endsection
@section('body')
    <section class='tanlu'>
        <div class='tanlutop' style="background: url({{ $serie->pic or '/assets/images/head.png' }});">
            <h1>{{ $series->name }}</h1>
            <p>{{ $series->brief or null }}</p>
        </div>
        @foreach($articles as $article)
            <div id="list" class="article_list">
                <a href="{{$article->address}}" >
                    <div class="articles">
                        <div class="left">
                            <img src="{{config('casarover.photo_folder').$article->attachment->filepath}}"/>
                        </div>
                        <div class="right">
                            <span class="title">{{$article->title}}</span>
                            <br/>
                            <span class="content">{{$article->brief}}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </section>
@endsection
