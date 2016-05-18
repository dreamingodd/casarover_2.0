$(document).ready(function(){
    new Vue({
        el: '#app',
        data: function () {
            return {
                points:[
                    {'name':'小米'},
                    {'name':'大米'}
                ],
                more:null
            };
        },
        ready:function(){
        },
        methods: {
            getlist (event){

            }
        }
    });
})