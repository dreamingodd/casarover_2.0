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
    });
    //        显示收起二维码
    $("#qrcode").hover(function(){
        $("#qrcode span").show();
    },function(){
        $("#qrcode span").hide();
    });
});
window.onload=function() {
    $(window).scroll(function() {
        if($(this).scrollTop()<=100){
            $("#toTop").hide();
        }
        if($(this).scrollTop()!=0){
            $("#toTop").show();
        }
        var screenT = $(window).scrollTop();
        var doc = $(document).height();
        var win = $(window).height();
        if(doc - win - screenT < 170) {
            vm.nextpage();
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
            checkareas:[],
            casas:[],
            //用来对新追加的进行转换
            casa:null,
            page:1,
            loading: false
        },
        ready:function(){
            this.getareas();
        },
        methods:{
            //城市选择
            selcity:function(cityid){
                this.city = cityid;
                this.getareas();
            },
            //区域选择
            selarea:function(obj){
                var clickId = obj.area.id;
                var domId = obj.$index;
                $(".area li:eq("+domId+") a").toggleClass("active");
                //选中加入数组
                //如果已经选中过，再次点击从数组中删除
                var areaToggle = this.checkareas.indexOf(clickId);
                if(areaToggle == -1){
                    this.checkareas.push(clickId);
                }else{
                    this.checkareas.splice(areaToggle,1);
                }
                this.getCasas();
            },
            //获取区域信息产生联动
            getareas:function(){
                //清空上一次城市时点击的区域
                this.checkareas=[];
                vm = this;
                $.getJSON('/api/areas/'+vm.city,function (data) {
                    vm.areas = data;
                    this.getCasas();
                }.bind(vm));
            },
            getCasas:function(){
                var vmcasas = this;
                $("#casa-list").css('display','none');
                $(".no-more").css('display','none');
                $(".loader").css('display','block');
                var areas = vmcasas.checkareas.toString();
                $.getJSON('/api/casas/city/'+vmcasas.city+'/areas/'+areas,function (data) {
                    vmcasas.casas = data.data;
                    console.log(data.data);
                    $(".loader").css('display','none');
                    $("#casa-list").css('display','block');
                }.bind(vmcasas));
            },
            nextpage:function(){
                if (!this.loading) {
                    var vmcasa = this;
                    $(".loader").css('display','block');
                    var areas = vmcasa.checkareas.toString();
                    vmcasa.page++;
                    $.getJSON('/api/casas/city/'+vmcasa.city+'/areas/'+areas+'?page='+vmcasa.page,function (data) {
                        if(data.data.length == 0){
                            $(".no-more").css('display','block');
                        }
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