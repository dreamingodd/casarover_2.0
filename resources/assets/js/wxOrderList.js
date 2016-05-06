$(document).ready(function(){
    Vue.component('goodlist',{   //这里就是注册的内容
        template : '#goodlist',
        props : ['goods']
    });
    new Vue({
        el: '#app',
        data: {
            orders: null,
            type:0,
        },

        created: function () {
            this.getOrder();
        },
        methods:{
            getOrder(){
                $.getJSON('/api/wxorder/list/'+'1', (data)=> {
                    console.log(data);
                    this.orders = data.data;
                });
            }
        }
    })
})