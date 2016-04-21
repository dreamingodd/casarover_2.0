function setchange(themeId){
    $.ajax('/api/wechat/change', {
        type: 'post',
        data: {
            id:themeId
        },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data){
            $("body").append(data);
            if(data.msg){
                $('.alert').css('display','block');
                $('.alert').delay("slow").slideUp(500);
            }
        }
    });
}