$(document).ready(function(){$(".flexslider").flexslider({directionNav:!0,pauseOnAction:!1}),$(".search-input input").click(function(){$(".search-place").css("display","block")}),$(".search-input input").blur(function(){$(".search-place").css("display","none")}),Vue.component("card",{template:"#card",props:["casa"]}),new Vue({el:"#app",data:function(){return{casas:null,themes:null,series:null,city:null,scroll:null}},ready:function(){this.turn(7)},methods:{turn:function(t){var e=this;$(".loader").css("display","block"),this.city=t,$.getJSON("/api/home/recom/"+t,function(s){e.casas=s,$(".loader").css("display","none"),e.setActive(t),e.getthemes()})},getthemes:function(){var t=this;$.getJSON("/api/home/themes/",function(e){t.themes=e,t.getseries()})},getseries:function(){var t=this;$.getJSON("/api/home/series/",function(e){t.series=e,t.scrollTo(),t.changeBr()})},scrollTo:function(){if(!this.scroll){var t=window.location.hash;t&&($("html,body").animate({scrollTop:$(t).offset().top}),this.scroll=1)}},setActive:function(t){$(".city-list a").each(function(){var e=$(this).attr("value");$(this).removeClass("active"),e==t&&$(this).addClass("active")})},changeBr:function(){$(".middle p").each(function(){var t=$(this).html();t=t.split("<BR/>").join("\n"),t=t.split("&lt;BR/&gt;").join("\n"),$(this).text(t)})}}})});