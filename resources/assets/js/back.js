$(function(){
    // 未完成功能
    $('body').on('click', '.not_complete', function(e) {
        e.preventDefault();
        alert('此功能期待完善！');
    });
    $('body').on('click', '.not_completed', function(e) {
        e.preventDefault();
        alert('此功能期待完善！');
    });
    // navigator select
    // 确认导航栏当前位置
    var page = $('#page').val();
    console.log(page + " page!");
    $('.' + page).addClass('active');
    // 返回按钮
    $('.goback').click(function(){
        history.go(-1);
    });
});
/**
 * Convert methods for textarea(HTML).
 * The methods' functionalities are obviously self-explanatory.
 */
function LFtoBR(str) {
    if (str) {
        return str.split('\n').join('<BR/>');
    } else return str;
}
function BRtoLF(str) {
    if (str) {
        str = str.split('<BR/>').join('\n');
        str = str.split('&lt;BR/&gt;').join('\n');
        return str;
    } else return str;
}

/**
 * e.g. www.casarover.com/
 */
function getRootUrl() {
    var backstage_url = $('#backstage_url').val();
    if (backstage_url) {
        return backstage_url.replace('casarover/website/backstage/', '');
    } else {
        alert("Backstage url is missing!");
    }
}

/**
 * Collect all the contents on the webpage before submit.
 * Currently invoked by casaEdit.js, exEdit.js
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
    return contents;
}

/**
 * Below 3 methods are input parameter check methods.
 * @param str input
 * @returns whether the input string is standard.
 */
function isCellphoneNumber(str) {
    var pattern = /^\d{11}$/;
    return pattern.test(str);
}
function isLegalPassword(str) {
    var pattern1 = /([a-zA-z]+\d+)|(\d+[a-zA-z]+)/;
    var pattern2 = /\w{6,}/;
    return pattern1.test(str) && pattern2.test(str);
}
function isLegalVerify_code(str) {
    var pattern = /^\d{6}$/;
    return pattern.test(str);
}
/**
* e.g. www.casarover.com/casarover/
*/
// function getBaseUrl() {
//     var backstage_url = $('#backstage_url').val();
//     if (backstage_url) {
//         var end = backstage_url.lastIndexOf('casarover/') + 10;
//         return backstage_url.substring(0, end);
//     } else {
//         alert("Backstage url is missing!");
//     }
// }
/** Below are photo upload action related*********************************************************/
///**The following methods are to upload a photo to Aliyun ECS linux server.
// * Deprecated because we moved all photo resource to Aliyun OSS.
// * Upload photo method.
// * 上传图片公用方法，应用在
// */
//function upload_photo(formId, max_size) {
//    action = getBaseUrl() + 'application/controllers/photo_upload_action.php?max_size=' + max_size;
//    return function() {
//        form = $(formId);
//        form.ajaxSubmit({
//            url : action,
//            dataType : 'json',
//            success : function(data) {
//                console.log('img upload success');
//                showPhoto(data.filename, form, true);
//            },
//            error : function(xhr) {
//                console.log(xhr.responseText);
//                alert('上传失败，ajax返回error，' + xhr.responseText + '，如有疑问请咨询开发人员！');
//            }
//        });
//    };
//}
///**
// * Display photo.
// * 显示图片的方法。
// * @param filepath
// * @param form
// */
//function showPhoto(filepath, dom_before, remove) {
//    var dom_img = newTemplateImg();
//    dom_img.children(0).prop('src', '../../../photo/' + filepath);
//    dom_img.children(0).attr('filepath', filepath);
//    // display image which is just uploaded
//    dom_before.after(dom_img);
//    if (remove) {
//        // remove upload img button(form)
//        dom_before.remove();
//    }
//}
///**
// * Create a new form for photo uploading.
// * 新建一个图片上传form。
// * @returns upload photo form
// */
//function newTemplateUploadForm() {
//    return $(
//            '<form id="template_upload_form" class="photo-form"'
//            +        'method="post" enctype="multipart/form-data">'
//            +    '<div class="col-lg-12 vertical5">'
//            +        '<input type="file" id="fileupload" name="photo"/>'
//            +    '</div>'
//            +'</form>'
//    );
//}
///**
// * Create a new form to display the photo.
// * 新建一个图片显示元素。
// * @returns upload photo form
// */
//function newTemplateImg() {
//    return $(
//            '<div id="template_img" class="photo-wrapper" style="position:relative;float:left;">'
//            +    '<img class="photo img-rounded"/>'
//            +    '<span class="img-remove glyphicon glyphicon-remove" style="position:absolute;z-index:2;opacity:0.7;top:0;left:0;font-size:40px;"></span>'
//            +'</div>'
//    );
//}
