$(document).ready(function(){
    $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false
    });
    $('.search-input input').click(function(){
        $('.search-place').css('display','block');
    });
    $('.search-input input').blur(function(){
        $('.search-place').css('display','none');
    });
    //scroll 是记录是否已经进行了滚动操作，
    //为了防止在重新进行turn的时候再次执行scrollTo
    var vm = new Vue({
        el: '#main',
        data: function () {
            return {
                casas:null,
                themes:null,
                status:2,
                scroll:null
            };
        },

        created: function () {
            //默认显示，感觉这个是有点问题的
            //this.turn(7);
        },
        ready:function(){
          this.turn(7);
        },
        methods: {
            turn: function (event){
                vm = this;
                $.getJSON('/api/home/recom/'+event,function (data) {
                    vm.casas = data;
                    this.setActive(event);
                    this.getthemes();
                }.bind(vm));
            },
            getthemes: function (){
                vmtheme = this;
                $.getJSON('/api/home/themes/',function (data) {
                    vmtheme.themes = data;
                    this.scrollTo();
                }.bind(vmtheme));
            },
            scrollTo:function(){
                if(this.scroll){
                    return;
                }
                var thisId = window.location.hash;
                $("html,body").animate({scrollTop:$(thisId).offset().top});
                this.scroll = 1;
            },
            setActive:function(event){
                $('.city-list a').each(function(){
                    var clickdom = $(this).attr("value");
                    $(this).removeClass('active');
                    if(clickdom == event){
                        $(this).addClass('active');
                    }
                });
            }
        }
    });
    //var series = new Vue({
    //    el: '#series',
    //    data: function () {
    //        return {
    //            series:null,
    //        };
    //    },
    //    created: function () {
    //        this.getseries();
    //    },
    //    methods: {
    //        getseries: function (){
    //            vmseries = this;
    //            $.getJSON('/api/home/series/',function (data) {
    //                vmseries.series = data;
    //            }.bind(vmseries));
    //        }
    //    }
    //});
});
