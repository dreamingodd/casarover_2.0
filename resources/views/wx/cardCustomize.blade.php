@extends('wxBase')
@section('title','购买探庐者度假卡')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="/assets/css/cardCustomize.css" rel="stylesheet"/>
    <script src="/assets/js/integration/vue.js" type="text/javascript"></script>
    <script src="/assets/js/wxBase.js"></script>
    <script src="/assets/js/cardCustomize.js"></script>
@stop
@section('nav')
    <a href="#" id="navleft" class="glyphicon glyphicon-chevron-left"></a>
    <img  src="/assets/images/logow.png" />
    <a href="tel:{{Config::get('config.help_telephone')}}" id="navright" class="glyphicon glyphicon-earphone"></a>
@stop
@section('body')
    <div class="main" id="app">
        {{--这个是点击民宿名字和图片之后显示详细信息的模板--}}
        <div class="casa-mess" v-if="casa">
            <template v-for="content in casa.contents">
                <p>@{{{ content.text }}}</p>
                <template v-for="img in content.imgs">
                    <img :src="'http://casarover.oss-cn-hangzhou.aliyuncs.com/casa/'+img.filepath" alt="" width="100%">
                </template>
            </template>
            <div class="now-price">
                <h4>房间类型</h4>
                <template v-for="room in casa.rooms">
                    <p>@{{ room.name }}-市场价@{{ room.price }}</p>
                </template>
            </div>
        </div>
        <template v-else>
            <h2>购买度假卡</h2>
            <br />
            <div class="personName">
                <label for="personName">姓名：</label>
                <input type="text" id="username" value="{{$user->realname}}" placeholder="请输入姓名" >
            </div>
            <div class="cellphone">
                <label for="cellphone">手机：</label>
                <input type="number" id="cellphone" value="{{$user->cellphone}}" placeholder="请输入11位手机号">
            </div>
            <div class="all">
                <template v-for="casa in casas">
                    <div class="casa" v-if="casa.surplus>0">
                        <div class="left">
                            <div class="check-bu" v-on:click="sel($index)">
                                <div v-if="casa.room == 0" class="circle">
                                    <div class="glyphicon glyphicon-ok"></div>
                                </div>
                                <div v-else class="circle check">
                                    <div class="glyphicon glyphicon-ok"></div>
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <div class="title">
                                <h4 v-on:click="getcasa(casa.id)">@{{ casa.name }} <span class="glyphicon glyphicon-menu-right"></span> </h4>
                            </div>
                            <div class="message">
                                <div class="head-img">
                                    <img :src="casa.headImg" v-on:click="getcasa(casa.id)" width="100%" alt="">
                                </div>
                                <div class="sel-mess">
                                    <div style="text-decoration:line-through" class="orig">原价：@{{ casa.orig }}</div>
                                    <div class="price">价格：@{{ casa.price }}
                                        <span class="room-left" v-if="casa.surplus < 50">(房间数量紧张)</span>
                                    </div>
                                    <div class="num">
                                        <span  class="glyphicon glyphicon-minus" v-on:click="minus($index)"></span>
                                        <input class="get-num" type="number" v-on:keyup="calculateTotal" v-model="casa.room"  />
                                        <span class="glyphicon glyphicon-plus" v-on:click="plus($index)"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <div class="buttom-buy" v-on:click="buy">
                <div class="total">总计：@{{ total | roundDisplay }}元</div>
                <div class="buy">
                    <h2>购买</h2>
                </div>
            </div>
        </template>
    </div>
    <script>
    </script>
@stop
