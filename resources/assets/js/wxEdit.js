$(function() {
    // textarea <BR/>显示为\n
    for (var i = 0; i < $('.basic_text').length; i++) {
        $('.basic_text')[i].value = BRtoLF($($('.basic_text')[i]).val());
    }
    /* Tab默认：两种模式 */
    if (($('#casa_id').val() === '0' || $('#casa_id').val() === '') && $('#main_photo').val()) {
        $('.select-method-nav li').removeClass('active');
        $('.select-method-nav li').last().addClass('active');
        $('#select_casa').removeClass('active');
        $('#select_self').addClass('active');
    }
    /* Tab选择：两种模式 */
    $('.select-method-nav li').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        var target = $(this).children().first().attr('data-target');
        $(target).siblings().removeClass('active');
        $(target).addClass('active');
    });
    /* 添加和删除内容功能 */
    $('body').on('click', '.add_content', function(){
        $(this).parent().parent().after(newContentTemplate());
    });
    $('body').on('click', '.del_content', function(){
        if ($('.content').length > 1) {
            $(this).parent().parent().remove();
        } else {
            alert('再删就没有了哦！');
        }
    });

    /* Click to show the modal and to load slim casas of the modal. */
    $('#showCasaModal').click(function(){
        $('#casaSelectModal').modal();
        if ($('#slimCasaTable tr').length === 0) {
            $.ajax('/api/casa/slim/all', {
                type: 'get',
                // This is probably for post.
                // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(data){
                    for (var i in data) {
                        var casa = data[i];
                        var casaTr = newCasaTr(casa.id, casa.code, casa.name);
                        $('#slimCasaTable').append(casaTr);
                    }
                },
                errro: function(response){
                    console.log(response);
                    alert("“加载民宿信息失败！”");
                }
            });
        }
    });

    /* 是否显示已选择民宿 */
    if ($('#casa_id').val() && $('#casa_id').val() !== '0') {
        $('#selectedCasa').show();
    }
    /* Click select button to select a casa. */
    $('#slimCasaTable').on('click', '.select_casa_btn', function(){
        var id = $(this).attr('db_id');
        var name = $(this).parent().siblings().first().html();
        var code = $(this).parent().siblings().last().html();
        // Hide the modal
        $('#casaSelectModal').modal('hide');
        // Store the casa in submit data on page.
        $('#casa_id').val(id);
        $('#selectedCasaInfo').html(code + ' | ' + name);
        $('#selectedCasa').show();
    });
    /* Click delete casa button to remove the casa_id value and hide selectedCasa */
    $('#delSelectCasa').click(function() {
        $('#casa_id').val('');
        $('#selectedCasa').hide();
    });

    /* Collect data preceding submit */
    $('.submit_btn').click(function(){
        var form = $('#wx_casa_form');
        for (var i = 0; i < $('.basic_text').length; i++) {
            $('.basic_text')[i].value = LFtoBR($($('.basic_text')[i]).val());
        }
        $('#main_photo').val($('.main-photo .hidden_photo').val());
        $('#contents').val(JSON.stringify(collectContents()));
        form.submit();
    });
});

/**
 * Build a new tr dom to show casa information.
 *
 */
function newCasaTr(id, code, name) {
    return $(
        '<tr>' +
            '<td>' + code + '</td>' +
            '<td>' + name + '</td>' +
            '<td><button db_id="' + id +
                '" type="button" class="select_casa_btn btn btn-info btn-sm">Select</button>' +
            '</td>' +
        '</tr>'
    );
}

/**
 * 新建一个内容模块
 * TODO move the html code to html file.
 */
function newContentTemplate() {
    return $(
        '<div class="content col-lg-12">' +
        '    <div class="name col-lg-2 vertical5">' +
        '        <input type="text" class="form-control" value="" aria-describedby="sizing-addon3" />' +
        '    </div>' +
        '    <div class="col-lg-10 vertical5">' +
        '        <button type="button" class="btn btn-info add_content">插入内容</button>' +
        '        <button type="button" class="btn btn-info del_content">删除内容</button>' +
        '    </div>' +
        '    <!-- OSS start -->' +
        '    <div class="oss_photo_tool col-lg-12 clearfix" target_folder="casa" file_prefix="casa" limit_size="1024"' +
        '            oss_address="{{Config::get("casarover.oss_external")}}">' +
        '        <div class="oss_button">' +
        '            <button class="show_uploader btn btn-info btn-sm">插入图片</button>' +
        '        </div>' +
        '        <div class="oss_hidden_input"></div>' +
        '        <div class="oss_photo"></div>' +
        '    </div>' +
        '    <!-- OSS end -->' +
        '    <textarea class="form-control" rows="3"></textarea>' +
        '</div>'
    );
}
