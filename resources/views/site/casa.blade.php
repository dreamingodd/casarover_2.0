@extends('site')
@section('title',$casa->name)
@section('body')
        <!-- 民宿大图  -->
<div class="head-photo">
    <div class="cover-photo">
        <img src="{{ $casa->headImg }}" width="100%" alt="">
    </div>
    <div class="show-mess">
        <!-- <div class="mark">浏览233</div> -->
        <h1>{{ $casa->name }}</h1>
    </div>

</div>
</header>
<!-- 民宿介绍内容 -->
<article>
    <div class="article-main">
        @foreach($casa->contents as $content)
            @foreach($content->attachments as $photo)
                <img src="{{ config('casarover.photo_folder').$photo->filepath }}" alt="" width="100%">
            @endforeach
            <br>
            {!! $content->text !!}
        @endforeach
    </div>
</article>
<div class="casa-mess">
    <div class="tag-list">
        @foreach($casa->tags as $tag)
            <a href="">{{ $tag->name }}</a>
        @endforeach
    </div>
</div>
<div class="casa-map">
    <!-- 地图api显示位置 -->
    <div id="allmap"></div>
</div>
@endsection