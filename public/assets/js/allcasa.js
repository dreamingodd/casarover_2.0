$(function(a){a(".flexslider").flexslider({directionNav:!0,pauseOnAction:!1}),a(".show").click(function(){var s="显示全部"==a(this).find("a").html()?"收起":"显示全部";a(this).find("a").html(s),a(this).prev().toggleClass("extend")}),a(".casa a").click(function(){a(".casa a").removeClass(),a(this).addClass("active")}),a("#qrcode").hover(function(){a("#qrcode span").show()},function(){a("#qrcode span").hide()})}),window.onload=function(){$(window).scroll(function(){$(this).scrollTop()<=100&&$("#toTop").hide(),0!=$(this).scrollTop()&&$("#toTop").show();var s=$(window).scrollTop(),i=$(document).height(),e=$(window).height();170>i-e-s?(a.nextpage(),$(".scroll-back").addClass("top")):$(".scroll-back").removeClass("top")}),$("#toTop").click(function(a){$("html,body").animate({scrollTop:"0px"},666)});var a=new Vue({el:"#app",data:{city:7,areas:[],checkareas:null,casas:[],casa:null,page:1,loading:!1,areapic:null,banner:{pic:null,title:null,mess:null}},ready:function(){this.getareas()},methods:{selcity:function(a){this.city=a,this.getareas()},selarea:function(a){var s=a.area.id,i=a.$index;$(".area li a").removeClass("active"),$(".area li:eq("+i+") a").addClass("active"),this.banner.id=this.areas[i].id,this.banner.pic=this.areas[i].pic,this.banner.title=this.areas[i].value,this.banner.mess=this.areas[i].mess,this.checkareas=s,this.getCasas()},getareas:function(){this.checkareas=[],a=this,a.banner.pic="",$.getJSON("/api/areas/"+a.city,function(s){a.areas=s,this.getCasas()}.bind(a))},getCasas:function(){var a=this;$("#casa-list").css("display","none"),$(".no-more").css("display","none"),$(".loader").css("display","block");var s=a.checkareas.toString();$.getJSON("/api/casas/city/"+a.city+"/areas/"+s,function(s){a.casas=s.data,$(".loader").css("display","none"),$("#casa-list").css("display","block")}.bind(a))},nextpage:function(){if(!this.loading){var a=this;$(".loader").css("display","block");var s=a.checkareas.toString();a.page++,$.getJSON("/api/casas/city/"+a.city+"/areas/"+s+"?page="+a.page,function(s){0==s.data.length&&$(".no-more").css("display","block");for(var i=0;i<s.data.length;i++)a.casa=s.data[i],a.casas.push(a.casa),a.casa=null;$(".loader").css("display","none"),a.loading=!1}.bind(a)),a.loading=!0}}}})};