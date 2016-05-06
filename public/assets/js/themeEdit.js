function sed(){
    var img = $(".oss_hidden_input input").val();
    $("#pic").val(img);
}
$(document).ready(function(){
    // content 显示设置 替换"<br/>"为"\n", 当然上传的时候也做了相反的替换
    $('textarea').each(function() {
        $(this).html(BRtoLF($(this).val()));
    });
    $('#themeSubmitBtn').click(function(){
        $('textarea').each(function() {
            $('textarea')[0].value = LFtoBR($(this).val());
        });
        $('#themeForm').submit();
    });
});
