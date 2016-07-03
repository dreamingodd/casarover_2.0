function addDate() {
    var newRoom = $($('.date_template')[0].outerHTML);
    newRoom.css('display', 'block');
    $('#date_container').append(newRoom);
}
$(function() {
    // If there's no room in this casa, add an empty one.
    if ($('#date_container').children().length == 0) {
        addDate();
    }
    // When one presses the add icon
    $('.addDate').click(function () {
        addDate();
    });
});
// Delete Date
function del(obj) {
    var parent=$(obj).parent();
    parent.detach();
}
function checksubmit()
{
    var submit = true;
    length = $ ('.year').length;
        console.log(length);
    i=1;
    $('.year').each(function () {
        if(i==length)
            return false;
        if (!$(this).val()) {
            submit = false;
            alert('请输入年份！');
        }
        ++i;
    });
    i=1;
    $('.month').each(function () {
        if(i==length)
            return false;
        if (!$(this).val()) {
            submit = false;
            alert('请输入月份！');
        }
        ++i;
    });
    i=1;
    $('.day').each(function () {
        if(i==length)
            return false;
        var str=$(this).val().split('');
        for(var j= 0;j<str.length;j++){
            if(isNaN(parseInt(str[j])) && str[j]!=',' ) {
                alert('可入住日期输入有误，请以数字加英文逗号的形式输入。');
                submit = false;
                break;
            }
        }
        if (!$(this).val()) {
            submit = false;
            alert('请输入可入住日期！');
        }
        ++i;
    });
    return submit;
}