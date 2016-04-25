$(function ($)
{
    $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false
    });
    //        显示收起标签
    $('.show').click (function ()
    {
        if($(this).find('a').html()=='显示全部'){
            $(this).find('a').html('收起');
            $(this).prev().addClass('extend');
        }
        else {
            $(this).find('a').html('显示全部');
            $(this).prev().removeClass('extend');
        }
    });
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

    //vue
    new Vue({
        el: '#app',
        data: {
            city:7,
            areas:[],
            checkareas:[],
            casas:[],
            page:1,
            //用来对新追加的进行转换
            casa:null
        },
        created: function () {
            this.getareas();
        },
        ready:function(){
          //this.getCasas();
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
                vmcasa = this;
                $(".loader").css('display','block');
                var areas = vmcasa.checkareas.toString();
                $.getJSON('/api/casas/city/'+vmcasa.city+'/areas/'+areas+'?page=2',function (data) {
                    //console.log(data.data);
                    for(var i=0; i<data.data.length;i++ ){
                        vmcasa.casa = data.data[i];
                        vmcasa.casas.push(vmcasa.casa);
                        vmcasa.casa = null;
                    }
                    $(".loader").css('display','none');
                }.bind(vmcasa));
            }
        }
    })


}