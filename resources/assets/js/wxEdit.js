$(function() {
    /* Tab默认：两种模式 */
    if ($('input[name="casa_id"]').val() == 0 && $('#main_photo').val()) {
        console.log($('.select-method-nav').last());
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

    $('.submit_btn').click(function(){
        var form = $('#wx_casa_form');
        $('#main_photo').val($('.main-photo .hidden_photo').val());
        $('#contents').val(JSON.stringify(collectContents()));
        form.submit();
    });
});

/**
 * Collect all the contents on the webpage before submit.
 */
function collectContents() {
    contents = [];
    $('.content').each(function() {
        var content = {};
        content.name = $(this).children('.name').children(0).val();
        content.text = $(this).children('textarea').val();
        content.text = LFtoBR(content.text);
        content.photos = [];
        $(this).children('.oss_photo_tool').children('.oss_hidden_input').children().each(function() {
            content.photos.push($(this).val());
        });
        contents.push(content);
    });
    // console.log(contents);
    return contents;
}

/**
 * 新建一个内容模块
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
