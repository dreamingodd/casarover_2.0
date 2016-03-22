$(document).ready(function(){
    $('.flexslider').flexslider({
        directionNav: true,
        pauseOnAction: false
    });
    $('.search-input input').click(function(){
        $('.search-place').css('display','block');
    })
    $('.search-input input').blur(function(){
        $('.search-place').css('display','none');
    })

    var recom = new Vue({
        el: '#recom',
        data: function () {
            return null
        },

        created: function () {
            this.data=  {
                casas:[{'id':'1','name':'qwe',pic:"assets/images/fang.jpg"}]
            };
            console.log(this.data);
        },

        methods: {
            turn: function (event){
                console.log(event);
                //$.getJSON('http://localhost/casarover/website/2.0/api/home.php',function (tests) {
                //    //vm.items = tests;
                //    //console.log(tests);
                //    // window.scrollTo(0,document.body.clientHeight);
                //    // 这样 获取的值还是一样的
                //    // console.log($(document.body).outerHeight(true));
                //    //$("html,body").animate({"scrollTop": "1700px"}, 1000);
                //}.bind(this));
            }
        }
    })
})
