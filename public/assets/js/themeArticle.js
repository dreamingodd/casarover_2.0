"use strict";$(document).ready(function(){new Vue({el:"#main",data:{articles:null,selected:null},created:function(){this.selected=$("#sel option:last").val(),this.getArticle(this.selected)},methods:{getArticle:function(){vm=this,$.getJSON("/api/theme/article/"+vm.selected,function(e){vm.articles=e}.bind(vm))}}})});