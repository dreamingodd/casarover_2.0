@extends('wxBase')
@section('title','购买度假卡')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/assets/css/cardCasaList.css" rel="stylesheet"/>
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/cardCasaList.js"></script>
@stop
@section('nav')
    <a href="/wx/user" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
    <img  src="/assets/images/logow.png" />
@stop
@section('body')
    <div class="main" id="app">
        <div class="casa-mess" v-if="casa">
            <template v-for="content in casa">
                <p>@{{{ content.text }}}</p>
                <template v-for="img in content.imgs">
                    <img :src="'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/'+img.filepath" alt="" width="100%">
                </template>
            </template>
        </div>
        <template v-else>
            <h2>购买度假卡</h2>
            <div class="all">
                <template v-for="casa in casas">
                    <div class="casa">
                        <div class="left">
                            <div class="check-bu" v-on:click="sel($index)">
                                <div class="circle check" v-if="casa.room">
                                    <div class="glyphicon glyphicon-ok"></div>
                                </div>
                                <div class="circle" v-else>
                                    <div class="glyphicon glyphicon-ok"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="title">
                                <h3 v-on:click="getcasa(casa.id)">@{{ casa.name }} <span class="glyphicon glyphicon-menu-right"></span> </h3>
                            </div>
                            <div class="message">
                                <div class="head-img">
                                    <img :src="casa.headImg" v-on:click="getcasa(casa.id)" width="100%" alt="">
                                </div>
                                <div class="sel-mess">
                                    <div style="text-decoration:line-through" class="orig">原价：@{{ casa.orig }}</div>
                                    <div class="price">价格：@{{ casa.price }}</div>
                                    <div class="num">
                                        <span  class="glyphicon glyphicon-minus" v-on:click="minus($index)"></span>
                                        <span class="get-num">@{{ casa.room }}</span>
                                        <span class="glyphicon glyphicon-plus" v-on:click="plus($index)"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <div class="buttom-buy" v-on:click="buy">
                <div class="total">总计：@{{ total }}元</div>
                    <div class="buy">
                        <h2>购买</h2>
                    </div>
            </div>
        </template>
    </div>
    <script>
    </script>
@stop
