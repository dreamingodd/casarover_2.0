@extends('wxBase')
@section('title','度假卡民宿列表')
@section('head')
    <link href="/assets/css/cardCasa.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="/wx/user" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main">
        <h2>度假卡民宿列表</h2>
        {{--foreach--}}
        @foreach($cardCasas as $casa)
            <div class="case clear" >
                <div class="casecon clear">
                    <img src="{{ $casa->photo_path }}" alt="">
                    <div class="article">
                        <h3>{{$casa->name}}</h3>
                        <div class="articlecon">
                            <span>剩余间数：<i>{{$casa->Opportunity->left_quantity}}</i></span>
                            @if($casa->Opportunity->left_quantity > 0)
                                <a class="click" href="/wx/user/cardBook/{{ $casa->id }}">预&nbsp;&nbsp;约</a>
                            @else
                                {{--这个最好应该链接到民宿详情里面--}}
                                <a class="click">不可预约</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <script>
    </script>
@stop
