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
            message:null,
        },
        created: function () {
            this.getOrder();
        },
        methods:{
            getOrder(){
                $.getJSON('/api/wxorder/list/', (data)=> {
                    this.orders = data.data;
                });
            },
            del(orderId){
                $.ajax('/api/wxorder/del', {
                    type: 'post',
                    data: {
                        id:orderId
                    },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: (data)=>{
                        console.log(data);
                        this.getOrder();
                    }
                });
            }
        }
    })
})