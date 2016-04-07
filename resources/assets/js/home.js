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
            this.turn(8);
        },

        methods: {
            turn: function (event){
                vm = this;
                $.getJSON('api/home/recom/'+event,function (data) {
                    vm.casas = data;
                }.bind(vm));
            }
        }
    });
});
