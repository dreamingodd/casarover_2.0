@extends('wxBase')
@section('title','我的度假卡')
@section('head')
    <link href="/assets/css/card.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="#" id="navleft" class="goback glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main">
        <h2>我的度假卡</h2>
        @foreach($cards as $card)
            <div class="case clear" >
                <a href="/wx/user/cardCasa/{{ $card->number }}">
                    <div class="casecon clear">
                        <img src="{{ $card->photo_path }}" alt="">
                        <div class="article">
                            <h3>NO.{{ $card->number }}</h3>
                            <p>有效期:</p>
                            <p>{{ $card->startDate }} ~ {{ $card->expireDate }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <script>
    </script>
@stop
