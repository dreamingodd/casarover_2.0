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
                casas:null
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
                }.bind(vm));
            }
        }
    });
});
