@extends('site')
@section('title',$area->value)
@section('head')
    <link rel="stylesheet" href="/assets/css/area.css">
    @endsection

    @section('body')
            <!-- 民宿大图  -->
    <div class="banner">
        <div class="cover-photo">
            <img src="{{ asset('assets/images/head.png') }}" width="100%" alt="">
        </div>
        <div class="guide-mess">
            <h1>{{ $area->value }}</h1>
            <p>{{ $area->contents['0']->text }}</p>
        </div>

    </div>
    <div class="container">
        <!-- 文字介绍 -->
        <section>
            <div class="article-main">
                <p>{{ $area->contents['1']->text }}</p>
            </div>
        </section>
        <div class="line"></div>
        <!-- 附近景点 -->
        <section>
            <div class="article-nav">附近景点</div>
            <div class="place-list">
                @for($i=2;$i<count($area->contents);$i++)
                    <div class="place-item">
                        <div class="place-img">
                            <img src="{{ asset('assets/images/fang.png') }}" wdith="100%;" alt="">
                        </div>
                        <div class="place-mess">
                            {{ $area->contents[$i]->text }}
                        </div>
                    </div>
                @endfor
            </div>
        </section>
        <div class="line"></div>
        <!-- 附近民宿 -->
        <section>
            <div class="article-nav">附近民宿</div>
            <div class="casa-card">
                <div class="card-c">
                    <a href="">
                        <img src="{{ asset('assets/images/fang.jpg') }}" height="100%">
                        <div class="card">
                            <h3>花千谷</h3>
                        </div>
                        <div class="info">
                            <div class="middle">
                                <h3>花千谷</h3>
                                <p>位于云南省西部，这里冬天依旧温暖<br>
                                    这是多民族聚集区，可以吃到众多的云南小吃；丰富的热带水果；欣赏美丽的孔雀舞</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="casa-card">
                <div class="card-d">
                    <a href="">
                        <img src="{{ asset('assets/images/fang.jpg') }}" height="100%">
                        <div class="card">
                            <h3>花千谷</h3>
                        </div>
                        <div class="info">
                            <div class="middle">
                                <h3>花千谷</h3>
                                <p>位于云南省西部，这里冬天依旧温暖<br>
                                    这是多民族聚集区，可以吃到众多的云南小吃；丰富的热带水果；欣赏美丽的孔雀舞</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="casa-card">
                <div class="card-d">
                    <a href="">
                        <img src="{{ asset('assets/images/fang.jpg') }}" height="100%">
                        <div class="card">
                            <h3>花千谷</h3>
                        </div>
                        <div class="info">
                            <div class="middle">
                                <h3>花千谷</h3>
                                <p>位于云南省西部，这里冬天依旧温暖<br>
                                    这是多民族聚集区，可以吃到众多的云南小吃；丰富的热带水果；欣赏美丽的孔雀舞</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="casa-card">
                <div class="card-c">
                    <a href="">
                        <img src="{{ asset('assets/images/fang.png') }}" height="100%">
                        <div class="card">
                            <h3>花千谷</h3>
                        </div>
                        <div class="info">
                            <div class="middle">
                                <h3>花千谷</h3>
                                <p>位于云南省西部，这里冬天依旧温暖<br>
                                    这是多民族聚集区，可以吃到众多的云南小吃；丰富的热带水果；欣赏美丽的孔雀舞</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection