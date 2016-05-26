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
            checkareas:null,
            casas:[],
            //用来对新追加的进行转换
            casa:null,
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
            //城市选择
            selcity(cityid){
                this.city = cityid;
                this.getareas();
            },
            //区域选择
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

                //改为单选之后不需要了
                //选中加入数组
                //如果已经选中过，再次点击从数组中删除
                //var areaToggle = this.checkareas.indexOf(clickId);
                //if(areaToggle == -1){
                //    this.checkareas.push(clickId);
                //}else{
                //    this.checkareas.splice(areaToggle,1);
                //}
                this.getCasas();
            },
            //获取区域信息产生联动
            getareas(){
                //清空上一次城市时点击的区域
                this.checkareas=[];
                this.banner.pic = '';
                $.getJSON('/api/areas/'+this.city, (data)=> {
                    this.areas = data;
                    this.getCasas();
                });
            },
            getCasas(){
                $("#casa-list").css('display','none');
                $(".no-more").css('display','none');
                $(".loader").css('display','block');
                let areas = this.checkareas.toString();
                $.getJSON('/api/casas/city/'+this.city+'/areas/'+areas, (data)=> {
                    this.casas = data.data;
                    $(".loader").css('display','none');
                    $("#casa-list").css('display','block');
                });
            },
            nextpage(){
                if (!this.loading) {
                    $(".loader").css('display','block');
                    let areas = this.checkareas.toString();
                    this.page++;
                    $.getJSON('/api/casas/city/'+this.city+'/areas/'+areas+'?page='+this.page, (data)=> {
                        if(data.data.length == 0){
                            $(".no-more").css('display','block');
                        }
                        for(var i=0; i<data.data.length;i++ ){
                            this.casa = data.data[i];
                            this.casas.push(this.casa);
                            this.casa = null;
                        }
                        $(".loader").css('display','none');
                        this.loading = false;
                    });
                    this.loading = true;
                }
            }
        }
    })
}
