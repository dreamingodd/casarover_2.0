@extends('site')
@section('head')


@endsection

@section('body')
        <!-- 民宿大图  -->
<div class="head-photo">
    <div class="cover-photo">
        <img src="{{ asset('assets/images/head.png') }}" width="100%" alt="">
    </div>
    <div class="guide-mess">
        <h1>白乐桥</h1>
        <p>这个就是白乐桥</p>
    </div>

</div>
<div class="container">
    <!-- 文字介绍 -->
    <section>
        <div class="article-main">
            <p>这个是文字介绍这个是文字介绍这个是文字介绍这个是文字介绍这个是文字介绍这个是文字介绍</p>
        </div>
    </section>
    <div class="line"></div>
    <!-- 附近景点 -->
    <section>
        <div class="article-nav">附近景点</div>
        <div class="place-list">
            <?php for($i=0;$i<4;$i++): ?>
            <div class="place-item">
                <div class="place-img">
                    <img src="{{ asset('assets/images/fang.png') }}" wdith="100%;" alt="">
                </div>
                <div class="place-mess">
                    <h2>灵隐寺</h2>
                    <p>这个是介绍的内容这个是介绍的内容这个是介绍的内容这个是介绍的内容</p>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </section>
    <div class="line"></div>
    <!-- 附近民宿 -->
    <section>
        <div class="article-nav">附近民宿</div>
        <div class="item">
            <div class="item-c">
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
        <div class="item">
            <div class="item-d">
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
        <div class="item">
            <div class="item-d">
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
        <div class="item">
            <div class="item-c">
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