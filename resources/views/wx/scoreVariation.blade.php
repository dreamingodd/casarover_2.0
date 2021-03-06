@extends('wxBase')
@section('title','积分明细')
@section('head')
    <link rel="stylesheet" href="/assets/css/point.css">
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/scoreVariation.js"></script>
@stop
@section('body')
<input type="hidden" id="id" value="{{ $userid or null }}">
<div id="app">
    <div class="main">
        <div class="list">
            <template v-for="point in points">
                <div class="point">
                    {{--事件的名字--}}
                    <div class="title">
                        <div class="name">@{{ point.name }}</div>
                        <div class="time">@{{ point.time }}</div>
                    </div>
                    <div class="money">
                        <span>@{{ point.money }}</span>
                    </div>
                </div>
            </template>
            <template v-if="more">
                <div class="more" v-on:click="getlist(page)">更多</div>
            </template>
        </div>
    </div>
</div>
@stop
