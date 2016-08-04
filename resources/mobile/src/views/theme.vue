<template>
    <div class="all">
        <div class="main">
            <div class="left">
                <h1>{{ $theme->name }}</h1>
                @foreach($contents as $article)
                    <a
                            @if($article->house)
                            href="/mobile/casa/{{ $article->house }}"
                            @endif
                    >
                        <div class="case">
                            @if(count($article->attachments))
                                <img src="{{ config('config.image_folder').$article->attachments[0]->filepath }}" alt="">
                            @endif
                            <div class="articles">
                                <h2>{{ $article->name }}</h2>
                                <p>{!! $article->text !!}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="right">
                <h2>其他主题</h2>
                @foreach($others as $theme)
                    <div class="line"></div>
                    <a href="/mobile/theme/{{ $theme->id }}">
                        <p>{{ $theme->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</template>
<style>
    .all{
      padding: 0 1rem;
      margin-bottom: 1rem;
      img{
        width: 100%;
      }
    }
    .slides{
      li{
        height: 18rem;
      }
    }
    .slide-a{
      text-align: center;
    }
    .right{
      h2{
        color: #333333;
        text-align: left;
        font-size: 1.5rem;
      }
      p{
        font-size: 1rem;
      }
    }
    .slide-mess{
      position: absolute;
      width: 16rem;
      left: 50%;
      margin-left: -8rem ;
      font-size: 2rem;
      text-shadow: 0 1px 3px #000;
    }
</style>
