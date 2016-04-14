$(function(){
    var text = $('.articles p').replaceAll('\n', '<br/>');
    $('.articles p').html(text);
});
