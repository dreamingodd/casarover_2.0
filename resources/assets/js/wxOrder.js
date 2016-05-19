
$(function() {
    $('#scoreConsume').click(function() {
        $(this).children('span').children('em').toggle();
        $('#scoreDiv').toggle();
    });
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
    $(".add").click(function() {
        var i = parseInt($(this).parents('.room').find('.room_quantity').html());
        $(this).parents('.room').find('.room_quantity').html(++i);
        total();
    });

    // 提交订单
    $('#submitBtn').click(function(){
        // 1.Parameter check.
        if (!checkParameters()) {
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
        console.log("Rooms INFO:" + JSON.stringify(reservedRooms));
        var csrf_token = $('#csrf_token').val();
        var personName = $('#personName').val();
        var cellphone = $('#cellphone').val();
        if ($('#scoreDiv').css('display') == 'none' || !$('#score').val()) {
            var score = 0;
        } else {
            var score = parseInt($('#score').val());
        }
        // 3.Ajax call to create the order.
        $.ajax({
            type: 'post',
            url : '/wx/order/create',
            dataType : 'json',
            data: {
                "realname" : personName,
                "cellphone" : cellphone,
                "wxCasaId" : $('#wxCasaId').val(),
                "reservedRooms" : reservedRooms,
                "score" : score,
                "_token" : csrf_token
            },
            success : function(data) {
                console.log('order create successfully!');
                // 4.Order create successfully, then pay...
                console.log(data);
                location.href = "/wx/pay/wxorder/" + data.orderId;
                // location.href = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxeafd79d8fcbd74ee" +
                //         // redirect uri to make a order
                //         //"&redirect_uri=http%3A%2F%2Fwww.casarover.com%2FWxpayAPI%2Fexample%2Fjsapi.php?id=" +
                //         "&redirect_uri=http%3A%2F%2Fwww.casarover.com%2Fwx%2Fpay%2Fwxorder%2F" +
                //         // snsapi_base / snsapi_userinfo
                //         data.orderId + "&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";
            },
            error : function(xhr) {
               console.log(xhr.responseText);
               alert('订单创建失败！\n' + 'ERROR INFO:\n' + xhr.responseText);
            }
        });
    });
});

/**
 * 提交订单前检查上传参数。
 */
function checkParameters() {
    var personName = $('#personName').val();
    var cellphone = $('#cellphone').val();
    var totalPayment = $('#totalPayment').html();
    if (!totalPayment || totalPayment === "0") {
        alert("您还没有选择房间/套餐！");
        return false;
    }
    if (!personName) {
        alert("请输入姓名！");
        return false;
    }
    if (!isCellphoneNumber(cellphone)) {
        alert("请输入正确的手机号码！");
        return false;
    }
    // 积分检查
    var score = parseInt($('#score').val());
    var usableScore = parseInt($('#usableScore').html());
    var maxDiscount = parseFloat(totalPayment) * 3;
    if (score > usableScore) {
        alert("您输入的积分超过当前可用的积分！");
        return false;
    }
    if (score > maxDiscount) {
        alert("您输入的积分超过了房价的30%！");
        return false;
    }
    return true;
}

/** Get the total payment amount. By gs. */
function total() {
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
