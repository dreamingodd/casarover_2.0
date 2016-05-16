@extends('mobile')
@section('title',$serie->name)
@section('head')
    <link rel="stylesheet" href="/assets/css/mobilecasaseries.css">
    <script src="/assets/js/integration/jquery.flexslider-min.js" type="text/javascript"></script>
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
@endsection
@section('body')
    <div class="main">
        <section class='tanlu'>
            <div class='tanlutop' style="background: url({{ config('casarover.image_folder').$serie->attachment->filepath }});background-repeat:no-repeat;background-size:cover;-moz-background-size:cover;-webkit-background-size:cover;">
                <div class="guide-mess">
                    <h2 style="color: #FFFFFF">{{ $serie->name }}</h2>
                    <p>{{ $serie->brief }}</p>
                </div>
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
    </div>
@stop
