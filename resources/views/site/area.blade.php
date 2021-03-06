@extends('site')
@section('title',$area->value)
@section('head')
    <link rel="stylesheet" href="/assets/css/area.css">
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
            <img src="http://restapi.amap.com/v3/staticmap?location={{ $area->position }}&zoom=14&size=1280*400&markers=mid,,A:{{ $area->position }}&key=2886eb6e218fcd008bbdb478c16756dc" alt="">
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
            @foreach($casas as $casa)
            <div class="casa-card">
                <div class="card-b">
                    <a href="/casa/{{ $casa->id }}" target="_blank">
                        <img src="{{ config('config.photo_folder').$casa->attachment->filepath }}" height="100%">
                        <div class="card">
                            <h3>{{ $casa->name }}</h3>
                        </div>
                        <div class="info">
                            <div class="middle">
                                <h3>{{ $casa->name }}</h3>
                                <p>{{ $casa->contents[0]->text }}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach

            {{--因为民宿的首图被去除所以不同的显示效果不能实现--}}
            {{--@for($i=0;$i<count($casas);$i++)--}}
                {{--<div class="casa-card">--}}
                    {{--<div class="card-c">--}}
                        {{--<a href="/casa/{{ $casas[$i]->id }}">--}}
                            {{--<img src="{{ config('config.photo_folder').$casas[$i]->attachment->filepath }}" height="100%">--}}
                            {{--<div class="card">--}}
                                {{--<h3>{{ $casas[$i]->name }}</h3>--}}
                            {{--</div>--}}
                            {{--<div class="info">--}}
                                {{--<div class="middle">--}}
                                    {{--<h3>{{ $casas[$i]->name }}</h3>--}}
                                    {{--<p>{{ $casas[$i]->contents[0]->text }}</p>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endfor--}}
        </section>
    </div>
    {{--<script>--}}
        {{--//        底部民宿卡片添加多种显示方式--}}
        {{--$(".card-c").each(function(i){--}}
            {{--if(i ==1 || i ==2 ){--}}
                {{--$(this).addClass('card-d');--}}
            {{--}--}}
        {{--})--}}
    {{--</script>--}}
@endsection