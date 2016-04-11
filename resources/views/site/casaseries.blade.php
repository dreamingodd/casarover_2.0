@extends('site')
@section('title','探庐系列')
@section('head')
    <link rel="stylesheet" href="/assets/css/casaseries.css">
    @endsection
@section('body')
<section class='tanlu'>
    <div class='tanlutop'>
        <h2>探庐·临安</h2>
        <p>临安介绍 xxxxxxxxxxxxxxxxxxxxxxxxx</p>
    </div>
    @foreach($articles as $article)
    <div id="list" class="article_list">
        <a href="#">
            <div class="articles">
                <div class="left">
                    @foreach($attachments as $attachment)
                        @if($attachment->id==$article->attachment_id)
                        <?php $attachmentpath=$attachment->filepath;break;?>
                        @endif
                    @endforeach
                    <img src="http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/{{$attachmentpath}}"/>
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
