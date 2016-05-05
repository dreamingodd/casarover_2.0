
$(function() {
    $('.detail').click(function() {
        $(this).next().toggle();
        $(this).children('span').children('em').toggle();
        total();
    });
    $(".reduce").click(function(){
        var i = parseInt($(this).parents('.room').find('.room_quantity').html());
        if(i<=1) {
            $(this).parents('.room').find('.quantity').hide();
            $(this).parents('.room').find('em').toggle();
            total();
            return 0;
        }
        $(this).parents('.room').find('.room_quantity').html(--i);
        total();
    });
    $(".add").click(function(){
        var i = parseInt($(this).parents('.room').find('.room_quantity').html());
        $(this).parents('.room').find('.room_quantity').html(++i);
        total();
    });
    $('#submitBtn').click(function(){
        // 1.Parameter check.
        var personName = $('#personName').val();
        var cellphone = $('#cellphone').val();
        if (!$('#totalPayment').html() || $('#totalPayment').html() === "0") {
            alert("您还没有选择房间/套餐！");
            return;
        }
        if (!personName) {
            alert("请输入姓名！");
            return;
        }
        if (!isCellphoneNumber(cellphone)) {
            alert("请输入正确的手机号码！");
            return;
        }
        // 2.Collect room information for the order.
        var reservedRooms = [];
        $('.room').each(function(){
            if ($(this).children('.quantity').css('display') == 'block') {
                var reservedRoom = {};
                reservedRoom.id = $(this).attr('db_id');
                reservedRoom.name = $(this).find('.room_name').html();
                reservedRoom.quantity = $(this).find('.room_quantity').html();
                reservedRooms.push(reservedRoom);
            }
        });
        // reservedRoomsJson = JSON.stringify(reservedRooms);
        // console.log("Rooms INFO:" + JSON.stringify(reservedRooms));
        var csrf_token = $('#csrf_token').val();
        // 3.Ajax call to create the order.
        $.ajax({
            type: 'post',
            url : '/wx/order/create',
            dataType : 'json',
            data: {
                "reservedRooms" : reservedRooms,
                "_token" : csrf_token
            },
            success : function(data) {
               // console.log('order create successfully!');
                // 4.Order create successfully, then pay...
                location.href = "/wx/pay/wxorder/" + data.orderId;
                // location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxeafd79d8fcbd74ee" +
                //         // redirect uri to make a order
                //         //"&redirect_uri=http%3A%2F%2Fwww.casarover.com%2FWxpayAPI%2Fexample%2Fjsapi.php?id=" +
                //         "&redirect_uri=http%3A%2F%2Fwww.casarover.com%2Fwx%2Fpay%2Fwxorder%2F" +
                //         // "&redirect_uri=http%3A%2F%2Flocalhost%3A81%2Fwx%2Fpay%2Fwxorder%2F" +
                //         // snsapi_base / snsapi_userinfo
                //         data.orderId + "&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
            },
            error : function(xhr) {
               // console.log(xhr.responseText);
               alert('订单创建失败！\n' + 'ERROR INFO:\n' + xhr.responseText);
            }
        });
    });
});

/** Get the total payment amount. By gs. */
function total(){
    totals = 0;
    price = 0;
    counts = 0;
    $('.room').each(function(){
        if ($(this).children('.quantity').css('display') == 'block') {
            counts =  $(this).find('.room_quantity').html();
            price = $(this).find('.price').html().replace('￥','');
            totals = totals + parseFloat(counts) * parseFloat(price);
        }
    });
    $('#totalPayment').html(totals);
}
