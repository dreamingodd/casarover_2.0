function LFtoBR(t){return t?t.split("\n").join("<BR/>"):t}function BRtoLF(t){return t?(t=t.split("<BR/>").join("\n"),t=t.split("&lt;BR/&gt;").join("\n")):t}function getRootUrl(){var t=$("#backstage_url").val();return t?t.replace("casarover/website/backstage/",""):void alert("Backstage url is missing!")}function collectContents(){return contents=[],$(".content").each(function(){var t={};t.name=$(this).children(".name").children(0).val(),t.text=$(this).children("textarea").val(),t.text=LFtoBR(t.text),t.photos=[],$(this).children(".oss_photo_tool").children(".oss_hidden_input").children().each(function(){t.photos.push($(this).val())}),contents.push(t)}),contents}function isCellphoneNumber(t){var n=/^\d{11}$/;return n.test(t)}function isLegalPassword(t){var n=/([a-zA-z]+\d+)|(\d+[a-zA-z]+)/,e=/\w{6,}/;return n.test(t)&&e.test(t)}function isLegalVerify_code(t){var n=/^\d{6}$/;return n.test(t)}$(function(){$("body").on("click",".not_complete",function(t){t.preventDefault(),alert("此功能期待完善！")}),$("body").on("click",".not_completed",function(t){t.preventDefault(),alert("此功能期待完善！")});var t=$("#page").val();console.log(t+" page!"),$("."+t).addClass("active"),$(".goback").click(function(){history.go(-1)})});