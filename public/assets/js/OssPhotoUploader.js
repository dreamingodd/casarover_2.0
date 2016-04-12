require.config({paths:{oss_uploader:"/assets/js/integration/oss_plupload.full.min",jquery:"//cdn.bootcss.com/jquery/2.1.2/jquery.min",domready:"/assets/js/integration/domready"}}),require(["jquery","oss_uploader","domready!"],function($,oss_uploader,domready){function addImg(e){$("#postfiles").parent().next().append($('<input type="hidden" class="hidden_photo" value="'+e+'"/>'));var t=$("#postfiles").parent().parent().attr("oss_address")+"/"+$("#postfiles").parent().parent().attr("target_folder")+"/"+e;$("#postfiles").parent().next().next().append($('<img class="img-thumbnail col-lg-3" style="height:200px;"title="双击删除" src="'+t+'"/>'))}function isPhoto(e){var t=e.name,s=["jpg","gif","bmp","jpeg","png","JPG","GIF","BMP","JPEG","PNG"];if(t){if(t.lastIndexOf(".")>0){var r=t.split(".")[t.split(".").length-1];for(var a in s){var n=s[a];if(n==r)return!0}return!1}return!1}return!1}function smallThanLimitSize(e){var t=e.origSize;return $("#selectfiles").parent().parent().attr("limit_size")&&(limit_size=1e3*$("#selectfiles").parent().parent().attr("limit_size")),limit_size>=t}function generateFilename(e){if(e.lastIndexOf(".")>0){var t=e.split(".")[e.split(".").length-1],s=new Date,r=formatDate(s,"yyyyMMdd-hhmmss-S"),a=$("#selectfiles").parent().parent().attr("file_prefix");a||(a="test");var n=Math.round(Math.random()*Math.pow(10,4));return a+"_"+r+"r"+n+"."+t}return null}function formatDate(e,t){var s={"M+":e.getMonth()+1,"d+":e.getDate(),"h+":e.getHours(),"m+":e.getMinutes(),"s+":e.getSeconds(),"q+":Math.floor((e.getMonth()+3)/3),S:e.getMilliseconds()};/(y+)/.test(t)&&(t=t.replace(RegExp.$1,(e.getFullYear()+"").substr(4-RegExp.$1.length)));for(var r in s)new RegExp("("+r+")").test(t)&&(t=t.replace(RegExp.$1,1==RegExp.$1.length?s[r]:("00"+s[r]).substr((""+s[r]).length)));return t}function send_request(){var e=null;if(window.XMLHttpRequest?e=new XMLHttpRequest:window.ActiveXObject&&(e=new ActiveXObject("Microsoft.XMLHTTP")),null!=e){$("#selectfiles").parent().parent().attr("target_folder")&&(target_folder=$("#selectfiles").parent().parent().attr("target_folder"));var t="target_folder="+target_folder,s="";return s="/oss/signature?"+t,e.open("GET",s,!1),e.send(null),console.log("signature: "+e.responseText),e.responseText}alert("Your browser does not support XMLHTTP.")}function get_signature(){now=timestamp=Date.parse(new Date)/1e3,console.log("get_signature ..."),console.log("expire:"+expire.toString()),console.log("now:",+now.toString()),console.log("get new sign"),body=send_request();var obj=eval("("+body+")");return host=obj.host,policyBase64=obj.policy,accessid=obj.accessid,signature=obj.signature,expire=parseInt(obj.expire),key=obj.dir,!0}function set_upload_param(e){var t=get_signature();if(1==t){var s="${filename}";uploader.seq<e.files.length&&(s=e.files[uploader.seq].name,s=generateFilename(s),e.files[uploader.seq].name=s),new_multipart_params={key:key+s,policy:policyBase64,OSSAccessKeyId:accessid,success_action_status:"200",signature:signature},e.setOption({url:host,multipart_params:new_multipart_params}),console.log("reset uploader")}}function createUploader(){return new plupload.Uploader({runtimes:"html5,flash,silverlight,html4",browse_button:"selectfiles",flash_swf_url:"../oss/lib/plupload-2.1.2/js/Moxie.swf",silverlight_xap_url:"../oss/lib/plupload-2.1.2/js/Moxie.xap",url:"http://oss.aliyuncs.com",init:{PostInit:function(){$("#postfiles").click(function(e){return set_upload_param(uploader),uploader.start(),!1})},FilesAdded:function(e,t){for(var s=[],r=0;r<t.length;r++){var a=t[r];isPhoto(a)||(alert(a.name+"--格式不支持！"),$("#postfiles").parent().children().first().siblings().remove()),smallThanLimitSize(a)||(alert(a.name+"--图片大小超过限定大小！"),$("#postfiles").parent().children().first().siblings().remove()),s.push(a)}plupload.each(s,function(e){$("#postfiles").parent().append($('<div id="'+e.id+'">'+e.name+" ("+plupload.formatSize(e.size)+')<b></b><div class="progress" style="width:300px;"><div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div></div></div>'))})},UploadProgress:function(e,t){var s=document.getElementById(t.id);s.getElementsByTagName("b")[0].innerHTML="&nbsp;<span>"+(100==t.percent?99:t.percent)+"%</span>";var r=s.getElementsByTagName("div")[0],a=r.getElementsByTagName("div")[0];a.style.width=3*t.percent+"px",a.setAttribute("aria-valuenow",t.percent)},FileUploaded:function(e,t,s){console.log("uploaded"),console.log(t),s.status>=200||s.status<200?(document.getElementById(t.id).getElementsByTagName("b")[0].innerHTML="100%",addImg(e.files[e.seq].name),e.seq++):document.getElementById(t.id).getElementsByTagName("b")[0].innerHTML=s.response,set_upload_param(e)},Error:function(e,t){set_upload_param(e),console.log(t.response)}}})}var accessid="",host="",policyBase64="",signature="",key="",expire=0,now=Date.parse(new Date)/1e3,limit_size=1024e3,target_folder="test",uploader=null,oss_uploader_html='<button id="selectfiles" class="oss_uploader btn btn-default btn-sm">选择文件</button><button id="postfiles" class="oss_uploader btn btn-default btn-sm">开始上传</button>';$("body").on("click",".oss_button .show_uploader",function(){$(".oss_uploader").remove(),$(this).after($(oss_uploader_html)),uploader=createUploader(),uploader.init(),uploader.seq=0,$(".progress").parent().remove()}),$(".oss_hidden_input .hidden_photo").each(function(){var e=$(this).parent().parent().attr("oss_address")+"/"+$(this).parent().parent().attr("target_folder")+"/"+$(this).val();$(this).parent().next().append($('<img class="img-thumbnail col-lg-3" style="height:200px;"title="双击删除" src="'+e+'"/>'))}),$("body").on("dblclick",".oss_photo img",function(){index=$(this).parent().children().index($(this)),$(this).parent().prev().children().eq(index).remove(),$(this).remove()})});