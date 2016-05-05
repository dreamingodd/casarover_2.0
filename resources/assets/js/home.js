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
    Vue.component('card',{   //这里就是注册的内容
        template : '#card',
        props : ['casa']
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
                city:null,
                scroll:null
            };
        },
        ready:function(){
            this.turn(7);
        },
        methods: {
            turn (event){
                $(".loader").css('display','block');
                this.city = event;
                $.getJSON('/api/home/recom/'+event, (data) => {
                    this.casas = data;
                    $(".loader").css('display','none');
                    this.setActive(event);
                    this.getthemes();
                })
            },
            getthemes(){
                $.getJSON('/api/home/themes/', (data) => {
                    this.themes = data;
                    this.getseries();
                })
            },
            getseries(){
                $.getJSON('/api/home/series/', (data) => {
                    this.series = data;
                    this.scrollTo();
                    this.changeBr();
                })
            },
            scrollTo(){
                if(this.scroll){
                    return;
                }
                var thisId = window.location.hash;
                if(thisId){
                    $("html,body").animate({scrollTop:$(thisId).offset().top});
                    this.scroll = 1;
                }
            },
            setActive(event){
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
                $('.middle p').each(function () {
                    var str = $(this).html();
                    str = str.split('<BR/>').join('\n');
                    str = str.split('&lt;BR/&gt;').join('\n');
                    $(this).text(str);
                });
            }
        }
    });
});
