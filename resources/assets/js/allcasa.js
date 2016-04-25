$(function ($)
{
    //轮播
    $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false
    });
    //收起显示切换
    $('.show').click (function ()
    {
        var value = $(this).find('a').html()=='显示全部'? '收起':'显示全部';
        $(this).find('a').html(value);
        $(this).prev().toggleClass('extend');
    });
    //城市点击
    $('.casa a').click(function () {
        $('.casa a').removeClass();
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
        var screenT = $(window).scrollTop();
        var doc = $(document).height();
        var win = $(window).height();
        if (screenT >= doc - win-180) {
            vm.nextpage();
        };
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

    //vue
    var vm = new Vue({
        el: '#app',
        data: {
            city:7,
            areas:[],
            checkareas:[],
            casas:[],
            page:1,
            //用来对新追加的进行转换
            casa:null,
            loading: false
        },
        ready:function(){
            this.getareas();
        },
        methods:{
            selcity:function(cityid){
                this.city = cityid;
                this.getareas();
            },
            selarea:function(obj){
                var clickId = obj.area.id;
                var k = obj.$index;
                $(".area li:eq("+k+") a").toggleClass("active");
                var areaToggle = this.checkareas.indexOf(clickId);
                if(areaToggle == -1){
                    this.checkareas.push(clickId);
                }else{
                    this.checkareas.splice(areaToggle,1);
                }
                this.getCasas();
            },
            getareas:function(){
                this.checkareas=[];
                vm = this;
                $.getJSON('/api/areas/'+vm.city,function (data) {
                    vm.areas = data;
                    this.getCasas();
                }.bind(vm));
            },
            getCasas:function(){
                vmcasas = this;
                $(".loader").css('display','block');
                var areas = vmcasas.checkareas.toString();
                $.getJSON('/api/casas/city/'+vmcasas.city+'/areas/'+areas,function (data) {
                    vmcasas.casas = data.data;
                    $(".loader").css('display','none');
                }.bind(vmcasas));
            },
            nextpage:function(){
                if (!this.loading) {
                    vmcasa = this;
                    $(".loader").css('display','block');
                    var areas = vmcasa.checkareas.toString();
                    vmcasa.page++;
                    $.getJSON('/api/casas/city/'+vmcasa.city+'/areas/'+areas+'?page='+vmcasa.page,function (data) {
                        for(var i=0; i<data.data.length;i++ ){
                            vmcasa.casa = data.data[i];
                            vmcasa.casas.push(vmcasa.casa);
                            vmcasa.casa = null;
                        }
                        $(".loader").css('display','none');
                        vmcasa.loading = false;
                    }.bind(vmcasa));
                    vmcasa.loading = true;

                }
            }
        }
    })


}