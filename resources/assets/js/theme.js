function setchange(themeId){
    $.ajax('/api/theme/change', {
        type: 'post',
        data: {
            id:themeId
        },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function(data){
            console.log(data);
            if(data.msg){
                alert("保存成功");
            }
        }
    });
}