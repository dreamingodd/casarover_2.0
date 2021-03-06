@extends('wxBase')
@section('title','度假卡民宿列表')
@section('head')
    <link href="/assets/css/cardCasa.css" rel="stylesheet"/>
    <script src="/assets/js/wxBase.js" type="text/javascript"></script>
@stop
@section('body')
    <div class="main">
        {{-- <h2>度假卡民宿列表</h2> --}}
        {{--foreach--}}
        @foreach($cardCasas as $casa)
            <div class="case clear" >
                <div class="casecon clear">
                    <img src="{{ $casa->photo_path }}" alt="">
                    <div class="article">
                        <h3>{{$casa->name}}</h3>
                        <div class="articlecon">
                            @if($casa->Opportunity->left_quantity > 0)
                                <a class="click" href="/wx/user/card/prepare/book/{{ $casa->id }}">预&nbsp;&nbsp;约</a>
                                <span>剩余间数：<i>{{$casa->Opportunity->left_quantity}}</i></span>
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
