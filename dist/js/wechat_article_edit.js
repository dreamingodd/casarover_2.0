function collectSeriesList(){var t=[];return $("#series_list").children().each(function(){var e={};e.id=$(this).attr("db_id"),e.name=$(this).attr("name"),e.type=$(this).attr("type"),t.push(e)}),t}function fillSeriesUl(t,e){$("#series_ul").children().remove();for(var i=0;i<t.length;i++){var l=t[i];if(e==l.type){var s=$('<li class="series_li"></li>');s.html(l.name),s.attr("db_id",l.id),$("#series_ul").append(s)}}}$(function(){var t=collectSeriesList();if($(".type_li").click(function(){$(".type_text").html($(this).html()),$("#type").val($(this).attr("db_id")),fillSeriesUl(t,$(this).attr("db_id")),"探庐系列"==$(".type_text").html()?($("#dropdownMenu2").attr("disabled",!1),$(".series_li").click(function(){$(".series_text").html($(this).html())})):($(".series_text").html(""),$("#dropdownMenu2").attr("disabled",!0))}),$(".type_li").each(function(){var t=$("#type").val();t==$(this).attr("db_id")&&$(".type_text").html($(this).html())}),$("#type").val()&&fillSeriesUl(t,$("#type").val()),$(".series_li").click(function(){$(".series_text").html($(this).html())}),$("#series").val()){for(var e=null,i=0;i<t.length;i++)$("#series").val()==t[i].id&&(e=t[i]);e&&($(".series_text").html(e.name),$("#series").val(e.id))}$("body").on("click",".series_li",function(){$(".series_text").html($(this).html()),$("#series").val($(this).attr("db_id"))}),$("#submit").click(function(){var t=!0;if($(".hidden_photo")&&$(".hidden_photo").val()||(t=!1,alert("请上传图片！")),$("#address").val()||(t=!1,alert("请输入链接！")),$("#title").val()||(t=!1,alert("请输入标题！")),$("#brief").val()||(t=!1,alert("请输入简介！")),t){var e=$(".hidden_photo").val(),i=$("#wechat_article_form");i.attr("action",i.attr("action")+"?filepath="+e),i.submit()}})});