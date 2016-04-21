//        显示收起标签
$(function ($)
{
    $('.show').click (function ()
    {
        if($(this).html()=='显示全部'){
            $(this).html('收起');
            $(this).parent().next().css('overflow','visible');
        }
        else {
            $(this).html('显示全部');
            $(this).parent().next().css('overflow','hidden');
        }
    });
    $('.casa a').click(function () {
        $('.casa a').removeClass();
        $(this).addClass('active');
    })
    $('.casas a').click(function () {
        $('.casas a').removeClass();
        $(this).addClass('active');
    })
});
//回到头部
window.onload=function() {
    if($(this).scrollTop()==0){
        $("#toTop").hide();
    }
    $(window).scroll(function(event) {
        /* Act on the event */
        if($(this).scrollTop()<=100){
            $("#toTop").hide();
        }
        if($(this).scrollTop()!=0){
            $("#toTop").show();
        }
    });
    $("#toTop").click(function(event) {
        /* Act on the event */
        $("html,body").animate({
                scrollTop:"0px"},
            666
        )
    });
    $(window).scroll(function() {
        var a = $("#toTop").offset().top;
        var b = $("footer").offset().top;
        if($(document).height() - $(window).height() -$(window).scrollTop()<170) {
            $("#toTop").css({"position":"#absolute","bottom":"330px"});
            $("#advice").css({"position":"#absolute","bottom":"286px"});
            $("#qrcode").css({"position":"#absolute","bottom":"242px"});
        }
        else {
            $("#toTop").css({"position":"#fixed","bottom":"138px"});
            $("#advice").css({"position":"#fixed","bottom":"94px"});
            $("#qrcode").css({"position":"#fixed","bottom":"50px"});
        }
    });
}