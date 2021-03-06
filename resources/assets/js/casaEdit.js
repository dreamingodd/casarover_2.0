$(function() {

    /* Mode confirmation: ADD or EDIT */
    var casa_id = $('#casa_id').val();
    if (casa_id) {
        $('title').html('探庐者后台-编辑民宿');
    }

    // content 显示设置 替换"<br/>"为"\n", 当然上传的时候也做了相反的替换
    $('textarea').each(function() {
        $(this).html(BRtoLF($(this).html()));
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

    /* Below are TAG editing related. */
    // 点击标签事件
    $('.tags span').click(function() {
        if ($(this).hasClass('label-default')) {
            $(this).removeClass('label-default');
            $(this).addClass('label-info');
        } else if ($(this).hasClass('label-info')) {
            $(this).removeClass('label-info');
            $(this).addClass('label-default');
        }
    });

    /* Below are area select related */
    $('#cities').hide();
    $('#districts').hide();
    var areas_json = $('#areas_json').val();
    var areas = JSON.parse(areas_json);
    for ( var id in areas) {
        var area = areas[id];
        var li = createAreaLi(area);
        $('#province_ul').append(li);
    }
    $('body').on(
            'click',
            '#area_div li',
            function() {
                var id = $(this).attr('db_id');
                var parentid = $(this).attr('parentid');
                var islast = $(this).attr('islast');
                $(this).parent().parent().children('.btn').children(
                        '.area_text').html($(this).html());
                // 点击省, 数据库里1是中国
                var city, li = null;
                if (parentid == 1) {
                    $('#districts').hide();
                    $('#city_ul').html('');
                    $('#cities .area_text').html('市');
                    var province = areas[id];
                    for ( var city_id in province.sub_areas) {
                        city = province.sub_areas[city_id];
                        li = createAreaLi(city);
                        $('#city_ul').append(li);
                    }
                    $('#cities').show();
                }
                // 点击叶子节点
                else if (islast == 1) {
                    $('#area').val(id);
                    $('#area_fullname').remove();
                }
                // 点击市(上海这种地方的区进入上面那个判断)
                else {
                    $('#district_ul').html('');
                    city = areas[parentid].sub_areas[id];
                    for ( var district_id in city.sub_areas) {
                        var district = city.sub_areas[district_id];
                        li = createAreaLi(district);
                        $('#district_ul').append(li);
                    }
                    $('#districts').show();
                }
            });

    /* Below are the casa form submitting related. */
    /*
     * 民宿对象 Casa: name, code, area(int) tags[](int), user_tags[] contents[]
     * Content: name, content, photos[]
     */
    // 点击提交
    $('#submit_btn').click(function() {
        // 1.构建民宿对象
        var casa = createCasa();
        if (!casa)
            return;
        // 2.解析页面必选标签
        casa.tags = collectTags();
        // 3.解析自定义标签
        casa.user_tags = collectUserTags();
        // 4.解析内容模块
        casa.contents = collectContents();
        // 5.提交
        $('#casa_JSON_str').val(JSON.stringify(casa));
        $('#casa_form').submit();
    });
});

/**
 * 将一个区域对象转换成一个li DOM节点.
 *
 * @param area
 *            省/市/区
 * @returns
 */
function createAreaLi(area) {
    var li = $("<li></li>");
    li.attr('db_id', area.id);
    li.attr('islast', area.islast);
    li.attr('parentid', area.parentid);
    li.html(area.name);
    return li;
}

/**
 * 创建民宿对象
 * @returns casa object
 */
function createCasa() {
    var casa = {};
    casa.id = $('#casa_id').val();
    casa.name = $.trim($('#name').val());
    casa.code = $.trim($('#code').val());
    casa.area = Number($.trim($('#area').val()));
    casa.link = $('#link').val();
    casa.main_photo = $('.main-photo .hidden_photo').val();
    if (!casa.name || !casa.code || !casa.area || !casa.main_photo) {
        alert('民宿名称、编码、地区、默认图片均不能为空！');
        return;
    }
    return casa;
}
/**
 * 从页面收集被点击过的标签（蓝色）.
 * @returns 标签集合
 */
function collectTags() {
    tags = [];
    $('.tags span').each(function() {
        if ($(this).hasClass('label-info')) {
            tags.push(Number($(this).attr('db_id')));
        }
    });
    return tags;
}
/**
 * 转换text input's value to 自定义标签集合.
 * @returns 自定义标签集合
 */
function collectUserTags() {
    user_tags = [];
    // 替换英文逗号
    if ($('#user_tags').val()) {
        user_tags_str = $('#user_tags').val().replace(new RegExp(',', 'gm'),
                '，');
        user_tags = user_tags_str.split('，');
        for ( var i = 0; i < user_tags.length; i++) {
            user_tags[i] = $.trim(user_tags[i]);
        }
    }
    return user_tags;
}
function newContentTemplate() {
    return $(
        '<div class="content">' +
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
