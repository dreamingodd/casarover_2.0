$(document).ready(function(){$(".flexslider").flexslider({directionNav:!0,pauseOnAction:!1}),$(".search-input input").click(function(){$(".search-place").css("display","block")}),$(".search-input input").blur(function(){$(".search-place").css("display","none")});new Vue({el:"#recom",data:function(){return{casas:null}},created:function(){this.turn(8)},methods:{turn:function(n){vm=this,$.getJSON("api/home/recom/"+n,function(n){vm.casas=n}.bind(vm))}}})});