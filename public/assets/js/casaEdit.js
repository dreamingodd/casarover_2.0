function createAreaLi(t){var a=$("<li></li>");return a.attr("db_id",t.id),a.attr("islast",t.islast),a.attr("parentid",t.parentid),a.html(t.name),a}function createCasa(){var t={};return t.id=$("#casa_id").val(),t.name=$.trim($("#name").val()),t.code=$.trim($("#code").val()),t.area=Number($.trim($("#area").val())),t.link=$("#link").val(),t.main_photo=$(".main-photo .hidden_photo").val(),t.name&&t.code&&t.area&&t.main_photo?t:void alert("民宿名称、编码、地区、默认图片均不能为空！")}function collectTags(){return tags=[],$(".tags span").each(function(){$(this).hasClass("label-info")&&tags.push(Number($(this).attr("db_id")))}),tags}function collectUserTags(){if(user_tags=[],$("#user_tags").val()){user_tags_str=$("#user_tags").val().replace(new RegExp(",","gm"),"，"),user_tags=user_tags_str.split("，");for(var t=0;t<user_tags.length;t++)user_tags[t]=$.trim(user_tags[t])}return user_tags}function collectContents(){return contents=[],$(".content").each(function(){var t={};t.name=$(this).children(".name").children(0).val(),t.text=$(this).children(".text").children(0).val(),t.text=LFtoBR(t.text),t.photos=[],$(this).children(".oss_photo_tool").children(".oss_hidden_input").children().each(function(){t.photos.push($(this).val())}),contents.push(t)}),contents}function newContentTemplate(){return $('<div class="content">    <div class="name col-lg-2 vertical5">        <input type="text" class="form-control" value="" aria-describedby="sizing-addon3" />    </div>    <div class="col-lg-10 vertical5">        <button type="button" class="btn btn-info add_content">插入内容</button>        <button type="button" class="btn btn-info del_content">删除内容</button>    </div>    <!-- OSS start -->    <div class="oss_photo_tool col-lg-12 clearfix" target_folder="casa" file_prefix="casa" limit_size="1024"            oss_address="{{Config::get("casarover.oss_external")}}">        <div class="oss_button">            <button class="show_uploader btn btn-primary btn-sm">插入图片</button>        </div>        <div class="oss_hidden_input"></div>        <div class="oss_photo"></div>    </div>    <!-- OSS end -->    <div class="text col-lg-12 vertical5">        <textarea rows="3" cols="150"></textarea>    </div></div>')}$(function(){var t=$("#casa_id").val();t&&$("title").html("探庐者后台-编辑民宿"),$("textarea").each(function(){$(this).html(BRtoLF($(this).html()))}),$("body").on("click",".add_content",function(){$(this).parent().parent().after(newContentTemplate())}),$("body").on("click",".del_content",function(){$(this).parent().parent().remove()}),$(".tags span").click(function(){$(this).hasClass("label-default")?($(this).removeClass("label-default"),$(this).addClass("label-info")):$(this).hasClass("label-info")&&($(this).removeClass("label-info"),$(this).addClass("label-default"))}),$("#cities").hide(),$("#districts").hide();var a=$("#areas_json").val(),e=JSON.parse(a);for(var s in e){var i=e[s],n=createAreaLi(i);$("#province_ul").append(n)}$("body").on("click","#area_div li",function(){var t=$(this).attr("db_id"),a=$(this).attr("parentid"),s=$(this).attr("islast");if($(this).parent().parent().children(".btn").children(".area_text").html($(this).html()),1==a){$("#districts").hide(),$("#city_ul").html(""),$("#cities .area_text").html("市");var i=e[t];for(var n in i.sub_areas){var r=i.sub_areas[n],l=createAreaLi(r);$("#city_ul").append(l)}$("#cities").show()}else if(1==s)$("#area").val(t),$("#area_fullname").remove();else{$("#district_ul").html("");var r=e[a].sub_areas[t];for(var o in r.sub_areas){var c=r.sub_areas[o],l=createAreaLi(c);$("#district_ul").append(l)}$("#districts").show()}}),$("#submit_btn").click(function(){var t=createCasa();t&&(t.tags=collectTags(),t.user_tags=collectUserTags(),t.contents=collectContents(),$("#casa_JSON_str").val(JSON.stringify(t)),$("#casa_form").submit())})});