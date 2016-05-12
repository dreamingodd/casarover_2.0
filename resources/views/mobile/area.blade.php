@extends('mobile')
@section('title',"探庐者-$area->value")
@section('head')
    <link rel="stylesheet" href="/assets/css/mobileArea.css">
    @endsection
    @section('body')
            <!-- 民宿大图  -->
    <div class="banner">
        <div class="cover-photo">
            @if(!empty($area->contents[1]->attachments[0]))
                <img src="{{ config('casarover.oss_external').'/area/'.$area->contents[1]->attachments[0]->filepath }}" width="100%" alt="">
            @endif
        </div>
        <div class="guide-mess">
            <h1>{{ $area->value }}</h1>
            <p>{{ $area->contents['0']->text or null}}</p>
        </div>

    </div>
    <div class="container">
        <!-- 文字介绍 -->
        <section>
            <div class="article-main">
                <p>{{ $area->contents['1']->text or null}}</p>
            </div>
        </section>
        <div class="line"></div>
        {{--地图显示位置--}}
        <div id="mapContainer">
            <img src="http://restapi.amap.com/v3/staticmap?location={{ $area->position }}&zoom=14&size=450*300&markers=mid,,A:{{ $area->position }}&key=2886eb6e218fcd008bbdb478c16756dc" alt="">
        </div>
        <!-- 附近景点 -->
        <section>
            <div class="article-nav">附近景点</div>
            <div class="place-list">
                @for($i=2;$i<count($area->contents);$i++)
                    <div class="place-item">
                        <div class="place-img">
                            @if(count($area->contents[$i]->attachments))
                                <img src="{{ config('casarover.oss_external').'/area/'.$area->contents[$i]->attachments[0]->filepath }}" wdith="100%;" alt="">
                            @endif
                        </div>
                        <div class="place-mess">
                            <p>
                                {{ $area->contents[$i]->text or null }}
                            </p>
                        </div>
                    </div>
                @endfor
            </div>
        </section>
        <div class="line"></div>
        <!-- 附近民宿 -->
        <section>
            <div class="article-nav">附近民宿</div>
            <div class="near-casa">
                @foreach($casas as $casa)
                    <div class="casa-card">
                        <div class="card-b">
                            <a href="/mobile/casa/{{ $casa->id }}" target="_blank">
                                <img src="{{ config('casarover.photo_folder').$casa->attachment->filepath }}" height="100%">
                                <div class="card">
                                    <h3>{{ $casa->name }}</h3>
                                </div>
                                {{--<div class="info">--}}
                                {{--<div class="middle">--}}
                                {{--<h3>{{ $casa->name }}</h3>--}}
                                {{--<p>{{ $casa->contents[0]->text }}</p>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@stop