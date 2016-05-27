function sed(){
    let photos = '';
    $('.oss_hidden_input input').each(function(){
        photos += $(this).val()+";";
    })
    $("#photos").val(photos);
}