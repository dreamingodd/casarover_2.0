@extends('site')
@section('title',$area->value)
@section('head')
    <link rel="stylesheet" href="/assets/css/area.css">
    <script src="http://webapi.amap.com/maps?v=1.3&key=6490a159a96f22a0436c5b87e0f71672"></script>
    @endsection
    @section('body')
            <!-- 民宿大图  -->
    <div class="banner">
        <div class="cover-photo">
            @if($area->contents[1]->attachmets)
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
        <div id="mapContainer"></div>
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
            @for($i=0;$i<count($casas);$i++)
                <div class="casa-card">
                    <div class="card-c">
                        <a href="/casa/{{ $casas[$i]->id }}">
                            <img src="{{ config('casarover.photo_folder').$casas[$i]->attachment->filepath }}" height="100%">
                            <div class="card">
                                <h3>{{ $casas[$i]->name }}</h3>
                            </div>
                            <div class="info">
                                <div class="middle">
                                    <h3>{{ $casas[$i]->name }}</h3>
                                    <p>{{ $casas[$i]->contents[0]->text }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endfor
        </section>
    </div>
    <script>
        var map = new AMap.Map('mapContainer', {
            center: [{{ $area->position }}],
            lang:'zh_en',
            zoom:{{ $area->tier }},
            zoomEnable:false,
            dragEnable:false
        });
    </script>
    <script>
        //        底部民宿卡片添加多种显示方式
        $(".card-c").each(function(i){
            if(i ==1 || i ==2 ){
                $(this).addClass('card-d');
            }
        })
    </script>
@endsection