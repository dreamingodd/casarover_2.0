$(document).ready(function(){$(".flexslider").flexslider({directionNav:!0,pauseOnAction:!1}),$(".search-input input").click(function(){$(".search-place").css("display","block")}),$(".search-input input").blur(function(){$(".search-place").css("display","none")});var t=new Vue({el:"#app",data:function(){return{casas:null,themes:null,series:null,scroll:null}},compiled:function(){this.changeBr()},ready:function(){this.turn(7)},methods:{turn:function(i){t=this,$(".loader").css("display","block"),$.getJSON("/api/home/recom/"+i,function(e){t.casas=e,$(".loader").css("display","none"),this.setActive(i),this.getthemes()}.bind(t))},getthemes:function(){t=this,$.getJSON("/api/home/themes/",function(i){t.themes=i,this.getseries()}.bind(t))},getseries:function(){t=this,$.getJSON("/api/home/series/",function(i){t.series=i,this.scrollTo()}.bind(t))},scrollTo:function(){if(!this.scroll){var t=window.location.hash;t&&($("html,body").animate({scrollTop:$(t).offset().top}),this.scroll=1)}},setActive:function(t){$(".city-list a").each(function(){var i=$(this).attr("value");$(this).removeClass("active"),i==t&&$(this).addClass("active")})},changeBr:function(){$(".info p").each(function(){console.log(123);var t=$(this).html();t=t.split("<BR/>").join("\n"),t=t.split("&lt;BR/&gt;").join("\n"),$(this).text(t)})}}})});