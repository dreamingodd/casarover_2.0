function total(){totals=0,price=0,counts=0,$(".room").each(function(){"block"==$(this).children(".quantity").css("display")&&(counts=$(this).find(".room_quantity").html(),price=$(this).find(".price").html().replace("￥",""),totals+=parseFloat(counts)*parseFloat(price))}),$("#totalPayment").html(totals)}$(function(){$(".detail").click(function(){$(this).next().toggle(),$(this).children("span").children("em").toggle(),total()}),$(".reduce").click(function(){var t=parseInt($(this).parents(".room").find(".room_quantity").html());return 1>=t?($(this).parents(".room").find(".quantity").hide(),$(this).parents(".room").find("em").toggle(),total(),0):($(this).parents(".room").find(".room_quantity").html(--t),void total())}),$(".add").click(function(){var t=parseInt($(this).parents(".room").find(".room_quantity").html());$(this).parents(".room").find(".room_quantity").html(++t),total()}),$("#submitBtn").click(function(){var t=$("#personName").val(),o=$("#cellphone").val();if(!$("#totalPayment").html()||"0"===$("#totalPayment").html())return void alert("您还没有选择房间/套餐！");if(!t)return void alert("请输入姓名！");if(!isCellphoneNumber(o))return void alert("请输入正确的手机号码！");var n=[];$(".room").each(function(){if("block"==$(this).children(".quantity").css("display")){var t={};t.id=$(this).attr("db_id"),t.name=$(this).find(".room_name").html(),t.quantity=$(this).find(".room_quantity").html(),n.push(t)}});var i=$("#csrf_token").val();$.ajax({type:"post",url:"/wx/order/create",dataType:"json",data:{reservedRooms:n,_token:i},success:function(t){location.href="/wx/pay/wxorder/"+t.orderId},error:function(t){alert("订单创建失败！\nERROR INFO:\n"+t.responseText)}})})});