$(document).ready(function(){
    var recom = new Vue({
        el: '#area-form',
        data: function () {
            return {
                casas:null
            }
        },

        created: function () {
        },

        methods: {
            sed:function(event){
                var head_img = $(".head-img input").val();
                var photos = '';
                $('.oss_hidden_input input').each(function(){
                    photos += $(this).val()+";";
                })
                $("#photos").val(photos);
            }
        }
    })
});