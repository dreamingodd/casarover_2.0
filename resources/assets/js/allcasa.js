$(function ($)
{
    //slider
    $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false
    });
    //收起显示切换
    $('.show').click (function ()
    {
        let value = $(this).find('a').html()=='显示全部'? '收起':'显示全部';
        $(this).find('a').html(value);
        $(this).prev().toggleClass('extend');
    });
    //城市点击
    $('.casa a').click(function () {
        $('.casa a').removeClass();
        $(this).addClass('active');
    });
    //        显示收起二维码
    $("#qrcode").hover(function(){
        $("#qrcode span").show();
    },function(){
        $("#qrcode span").hide();
    });
});
window.onload=function() {
    $("#toTop").hide();
    $(window).scroll(function() {
        if($(this).scrollTop()<=200){
            $("#toTop").hide();
        }
        else{
            $("#toTop").show();
        }
        var screenT = $(window).scrollTop();
        var doc = $(document).height();
        var win = $(window).height();
        if(doc - win - screenT < 170) {
            vm.getCasas();
            $(".scroll-back").addClass('top');
        }
        else {
            $(".scroll-back").removeClass('top');
        }
    });
    //返回顶部
    $("#toTop").click(function(event) {
        $("html,body").animate({
                scrollTop:"0px"},
            666
        )
    });

    //vue
    var vm = new Vue({
        el: '#app',
        data: {
            city:7,
            areas:[],
            checkareas:null,
            casas:[],
            page:1,
            loading: false,
            areapic:null,
            banner:{
                pic:null,
                title:null,
                mess:null
            }
        },
        ready:function(){
            this.getareas();
        },
        methods:{
            selcity(cityid){
                this.city = cityid;
                this.casas = [];
                this.page = 1;
                this.getareas();
            },
            selarea(obj){
                let clickId = obj.area.id;
                let domId = obj.$index;
                $(".area li a").removeClass("active");
                $(".area li:eq("+domId+") a").addClass("active");
                this.banner.id = this.areas[domId].id;
                this.banner.pic = this.areas[domId].pic;
                this.banner.title = this.areas[domId].value;
                this.banner.mess = this.areas[domId].mess;

                this.checkareas = clickId;

                this.page = 1;
                this.casas = [];
                this.getCasas();
            },
            //get area message by city
            getareas(){
                //clear selected last time
                this.checkareas=[];
                this.banner.pic = '';
                $.getJSON('/api/areas/'+this.city, (data)=> {
                    this.areas = data;
                    this.getCasas();
                });
            },
            getCasas(){
                if (!this.loading) {
                    $(".no-more").css('display','none');
                    $(".loader").css('display','block');
                    let areaId = this.checkareas.toString();
                    if (areaId) areaId = "/" + areaId;
                    $.getJSON('/api/casas/city/' + this.city + '/areas/' + areaId + '?page='+this.page, (data)=> {
                        console.log(123);
                        if(data.data.length == 0){
                            $(".no-more").css('display','block');
                        }
                        this.casas = [...this.casas,...data.data];
                        $(".loader").css('display','none');
                        this.loading = false;
                    });
                    this.loading = true;
                    this.page++;
                }
            },
        }
    })
}
