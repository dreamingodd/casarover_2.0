function setchange(themeId,obj){
    var checkDom = obj;
    $.ajax('/api/wechat/change', {
        type: 'post',
        data: {
            id:themeId
        },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data){
            if(data.msg == 'ok'){
                $('.alert').css('display','block');
                $('.alert').delay("slow").slideUp(500);
            }else{
                alert(data.msg);
                checkDom.checked = false;
            }
        }
    });
}