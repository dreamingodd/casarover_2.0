@extends('wxBase')
@section('title','积分明细')
@section('head')
    <link rel="stylesheet" href="/assets/css/point.css">
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/test.js"></script>
@stop
@section('body')
    <div id="app">
        <div class="main">
            <div class="list">
                <template v-for="point in points">
                    <div class="point">
                        {{--事件的名字--}}
                        <div class="title">
                            <div class="name">@{{ point.name }}</div>
                            <div class="time">05-17</div>
                        </div>
                        <div class="money">
                            <span>￥123</span>
                        </div>
                    </div>
                </template>
                <template v-if="more">
                    <div class="more">更多</div>
                </template>
            </div>
        </div>
    </div>
@stop