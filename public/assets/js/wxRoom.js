$(function(){
        // If there's no room in this casa, add an empty one.
        if ($('#room_container').children().length === 0) {
            addRoom();
        }
        // When one presses the add icon
        $('.addRoom').click(function() {
            addRoom();
        });
    // When one presses the delete icon.
    $('#room_container').on('click', '.delRoom', function() {
        // TODO ajax check to confirm whether the room is deletable.
        if (deleted) {
            $(this).parent().remove();
        }
    });
    // Submit the form, aggregate all the data we have.
    $('.submit_btn').click(function(){
        var rooms = [];
        var validate = true;
        var roomDoms = $('#room_container .room');
        // Here's a closure last variable problem,
        // I need to investigate how to solve this.
        for (var i = 0; i < roomDoms.length; i++) {
            var roomDom = $(roomDoms[i]);
            var room = {};
            room.id = roomDom.attr('db_id');
            room.name = roomDom.children('.roomNameDiv').children('.roomName').val();
            room.price = roomDom.children('.roomPriceDiv').children('.roomPrice').val();
            console.log(room);
            if (!validateRoom(room)) {
                validate = false;
                break;
            }
            rooms.push(room);
        }
        // var i = 0;
        // $('#room_container .room').each((function(i) {
        //     var room = {};
        //     var roomDom = $($('#room_container .room')[i]);
        //     room.id = roomDom.attr('db_id');
        //     room.name = roomDom.children('.roomNameDiv').children('.roomName').val();
        //     room.price = roomDom.children('.roomPriceDiv').children('.roomPrice').val();
        //     console.log(room);
        //     if (!validateRoom(room)) {
        //         validate = false;
        //         return;
        //     }
        //     rooms.push(room);
        //     i++;
        //     // Solve closure last variable problem.
        // })(i));
        if (!validate) return;
        var roomsJson = JSON.stringify(rooms);
        console.log(roomsJson);
        $('#wxRooms').val(roomsJson);
        $('#wxRoomForm').submit();
    });
});
function addRoom() {
    var newRoom = $($('.room_template')[0].outerHTML);
    newRoom.css('display', 'block');
    $('#room_container').append(newRoom);
}
/**
 * Validate the room's attributes.
 */
function validateRoom(room) {
    var numRegex = /^[0-9]*$/;
    if (!room.name || !room.price) {
        alert("名称和价格均不能为空！");
        return false;
    } else if (!numRegex.test(room.price)) {
        alert('价格必须为整数字！');
        return false;
    }
    return true;
}
