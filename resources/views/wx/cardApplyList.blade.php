@extends('wxBase')
@section('title','申请记录')
@section('head')
    <link href="/assets/css/cardApply.css" rel="stylesheet"/>
@stop
@section('nav')
    <a href="#" id="navleft" class="goback glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main">
        <h2>申请记录</h2>
        @foreach($applyList as $key)
            <div class="case clear" >
                <div class="info">
                    <p>申请人：{{ $key->username }}</p>
                    <p>电话号码：{{ $key->cellphone }}</p>
                </div>
                <div class="casecon clear">
                    <img src="{{ $key->casapic }}" alt="">
                    <div class="article">
                        <h3>{{ $key->casaname }}</h3>
                        <div class="articlecon">
                            <span>申请间数: <i>{{ $key->quantity }}</i></span>
                        </div>
                        @if($isMe)
                            <p>{{ $key->statusWords }}</p>
                        @else
                            @if($key->status)
                                <p>{{ $key->statusWords }}</p>
                            @else
                                <div class="handle">
                                    <a href="/wx/user/card/apply/agree/{{ $key->id }}" class="btn btn-success">同意</a>
                                    <a href="/wx/user/card/apply/refuse/{{ $key->id }}" class="btn btn-danger">拒绝</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script>
    @if(Session::get('msg'))
      alert('{{ Session::get('msg') }}');
      @endif
    </script>
@stop
