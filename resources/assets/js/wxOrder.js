
$(function() {
    window.onload = function(){
        $('.detail').click(function() {
            $(this).next().toggle();
            $(this).children('span').children('em').toggle();
            total();
        });
        $(".reduce").click(function(){
            var i = parseInt($(this).parents('.room').find('.room_quantity').html());
            if(i<=1)
            return 0;
            $(this).parents('.room').find('.room_quantity').html(--i);
            total();
        });
        $(".add").click(function(){
            var i = parseInt($(this).parents('.room').find('.room_quantity').html());
            $(this).parents('.room').find('.room_quantity').html(++i);
            total();
        });
    };
    $('#submitBtn').click(function(){
        var reservedRooms = [];
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
        $('.room').each(function(){
            if ($(this).children('.quantity').css('display') == 'block') {
                var reservedRoom = {};
                reservedRoom.id = $(this).attr('db_id');
                reservedRoom.name = $(this).find('.room_name').html();
                reservedRoom.quantity = $(this).find('.room_quantity').html();
                reservedRooms.push(reservedRoom);
            }
        });
        console.log(reservedRooms);
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
            console.log(totals);
        }
    });
    $('#totalPayment').html(totals);
}
