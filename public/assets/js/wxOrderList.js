"use strict";$(document).ready(function(){Vue.component("goodlist",{template:"#goodlist",props:["goods"]}),new Vue({el:"#app",data:{orders:null,type:0},created:function(){this.getOrder()},methods:{getOrder:function(){var e=this;$.getJSON("/api/wxorder/list/1",function(t){console.log(t),e.orders=t.data})}}})});