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

    var recom = new Vue({
        el: '#recom',
        data: function () {
            return {
                casas:null,
                status:2
            };
        },

        created: function () {
            //默认显示，感觉这个是有点问题的
            this.turn(7);
        },

        methods: {
            turn: function (event){
                vm = this;
                $.getJSON('/api/home/recom/'+event,function (data) {
                    vm.casas = data;
                    this.setActive(event);
                }.bind(vm));
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
    var theme = new Vue({
        el: '#theme',
        data: function () {
            return {
                themes:null,
            };
        },
        created: function () {
            this.getthemes();
        },
        methods: {
            getthemes: function (){
                vmtheme = this;
                $.getJSON('/api/home/themes/',function (data) {
                    vmtheme.themes = data;
                }.bind(vmtheme));
            }
        }
    })

});
