<template>
    <div class="city clear" >
        <div class="left">
            <h3>当前选择</h3>
        </div>
        <div class="right">
            <h3 id="close">完成</h3>
        </div>
        <div class="line"></div>
        <span id="city_checked"></span>
        <span id="area_checked"></span>
        <h3>选择城市</h3>
        <div class="line"></div>
        <ul class="casa clear">
            @foreach($citys as $city)
                <li><a  v-on:click="selcity({{ $city->id }})"
                        @if($city->id == $sel)
                        id="active"
                            @endif
                    >{{ $city->value }}</a></li>
            @endforeach
        </ul>
        <h3>选择区域</h3>
        <div class="line"></div>
        <ul class="area">
            <template v-for="area in areas">
                <li >
                    <a onclick="selarea(this)" v-on:click="selarea(this)">@{{ area.value }}</a>
                </li>
            </template>
        </ul>
    </div>
               selcity(cityid){
                this.city = cityid;
                this.casas = [];
                this.page = 1;
                this.getareas();
            },
            selarea(obj){
                let clickId = obj.area.id;
                let domId = obj.$index;
                $(".area li a").removeClass("active");
                $(".area li:eq("+domId+") a").addClass("active");
                this.banner.id = this.areas[domId].id;
                this.banner.pic = this.areas[domId].pic;
                this.banner.title = this.areas[domId].value;
                this.banner.mess = this.areas[domId].mess;

                this.checkareas = clickId;

                this.page = 1;
                this.casas = [];
                this.getCasas();
            },
</template>