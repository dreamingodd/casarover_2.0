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
        el: '#app',
        data: function () {
            return {
                casas:null,
                themes:null,
                series:null,
                scroll:null
            };
        },
        compiled:function(){
            this.changeBr();
        },
        ready:function(){
          this.turn(7);
        },
        methods: {
            turn: function (event){
                vm = this;
                $(".loader").css('display','block');
                $.getJSON('/api/home/recom/'+event,function (data) {
                    vm.casas = data;
                    $(".loader").css('display','none');
                    this.setActive(event);
                    this.getthemes();
                }.bind(vm));
            },
            getthemes: function (){
                vm = this;
                $.getJSON('/api/home/themes/',function (data) {
                    vm.themes = data;
                    this.getseries();
                }.bind(vm));
            },
            getseries: function (){
                vm = this;
                $.getJSON('/api/home/series/',function (data) {
                    vm.series = data;
                    //this.changeBr();
                    this.scrollTo();
                }.bind(vm));
            },
            scrollTo:function(){
                if(this.scroll){
                    return;
                }
                var thisId = window.location.hash;
                if(thisId){
                    $("html,body").animate({scrollTop:$(thisId).offset().top});
                    this.scroll = 1;
                }
            },
            setActive:function(event){
                $('.city-list a').each(function(){
                    var clickdom = $(this).attr("value");
                    $(this).removeClass('active');
                    if(clickdom == event){
                        $(this).addClass('active');
                    }
                });
            },
            changeBr:function(){
                //对info中的br进行处理
                $('.info p').each(function () {
                    console.log(123);
                    var str = $(this).html();
                    str = str.split('<BR/>').join('\n');
                    str = str.split('&lt;BR/&gt;').join('\n');
                    $(this).text(str);
                });
            }
        }
    });
});
