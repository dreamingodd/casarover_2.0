function addDate(){var t=$($(".date_template")[0].outerHTML);t.css("display","block"),$("#date_container").append(t)}function del(t){var e=$(t).parent();e.detach()}function checksubmit(){var t=!0;return length=$(".year").length,console.log(length),i=1,$(".year").each(function(){return i==length?!1:($(this).val()||(t=!1,alert("请输入年份！")),void++i)}),i=1,$(".month").each(function(){return i==length?!1:($(this).val()||(t=!1,alert("请输入月份！")),void++i)}),i=1,$(".day").each(function(){if(i==length)return!1;for(var e=$(this).val().split(""),a=0;a<e.length;a++)if(isNaN(parseInt(e[a]))&&","!=e[a]){alert("可入住日期输入有误，请以数字加英文逗号的形式输入。"),t=!1;break}$(this).val()||(t=!1,alert("请输入可入住日期！")),++i}),t}$(function(){0==$("#date_container").children().length&&addDate(),$(".addDate").click(function(){addDate()})});