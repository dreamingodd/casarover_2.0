function newCasaTr(t,a,s){return $("<tr><td>"+a+"</td><td>"+s+'</td><td><button db_id="'+t+'" type="button" class="select_casa_btn btn btn-info btn-sm">Select</button></td></tr>')}function newContentTemplate(){return $('<div class="content col-lg-12">    <div class="name col-lg-2 vertical5">        <input type="text" class="form-control" value="" aria-describedby="sizing-addon3" />    </div>    <div class="col-lg-10 vertical5">        <button type="button" class="btn btn-info add_content">插入内容</button>        <button type="button" class="btn btn-info del_content">删除内容</button>    </div>    <!-- OSS start -->    <div class="oss_photo_tool col-lg-12 clearfix" target_folder="casa" file_prefix="casa" limit_size="1024"            oss_address="http://casarover.oss-cn-hangzhou.aliyuncs.com">        <div class="oss_button">            <button type="button" class="show_uploader btn btn-info btn-sm">插入图片</button>        </div>        <div class="oss_hidden_input"></div>        <div class="oss_photo"></div>    </div>    <!-- OSS end -->    <textarea class="form-control" rows="3"></textarea></div>')}$(function(){for(var t=0;t<$(".basic_text").length;t++)$(".basic_text")[t].value=BRtoLF($($(".basic_text")[t]).val());"0"!==$("#casa_id").val()&&""!==$("#casa_id").val()||!$("#main_photo").val()||($(".select-method-nav li").removeClass("active"),$(".select-method-nav li").last().addClass("active"),$("#select_casa").removeClass("active"),$("#select_self").addClass("active")),$(".select-method-nav li").click(function(){$(this).siblings().removeClass("active"),$(this).addClass("active");var t=$(this).children().first().attr("data-target");$(t).siblings().removeClass("active"),$(t).addClass("active")}),$("body").on("click",".add_content",function(){$(this).parent().parent().after(newContentTemplate())}),$("body").on("click",".del_content",function(){$(".content").length>1?$(this).parent().parent().remove():alert("再删就没有了哦！")}),$("#showCasaModal").click(function(){$("#casaSelectModal").modal(),0===$("#slimCasaTable tr").length&&$.ajax("/api/casa/slim/all",{type:"get",success:function(t){for(var a in t){var s=t[a],e=newCasaTr(s.id,s.code,s.name);$("#slimCasaTable").append(e)}},errro:function(t){console.log(t),alert("“加载民宿信息失败！”")}})}),$("#casa_id").val()&&"0"!==$("#casa_id").val()&&$("#selectedCasa").show(),$("#slimCasaTable").on("click",".select_casa_btn",function(){var t=$(this).attr("db_id"),a=$(this).parent().siblings().first().html(),s=$(this).parent().siblings().last().html();$("#casaSelectModal").modal("hide"),$("#casa_id").val(t),$("#selectedCasaInfo").html(s+" | "+a),$("#selectedCasa").show()}),$("#delSelectCasa").click(function(){$("#casa_id").val(""),$("#selectedCasa").hide()}),$(".submit_btn").click(function(){for(var t=$("#wx_casa_form"),a=0;a<$(".basic_text").length;a++)$(".basic_text")[a].value=LFtoBR($($(".basic_text")[a]).val());$("#main_photo").val($(".main-photo .hidden_photo").val()),$("#contents").val(JSON.stringify(collectContents())),t.submit()})});