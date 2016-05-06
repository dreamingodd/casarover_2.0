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
            save(orderId){
                $.ajax('/api/wxorder/changetype/', {
                    type: 'post',
                    data: {
                        orderid:orderId,
                        message:this.message
                    },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(data){
                        console.log(data);
                        this.getOrder();
                    }
                });
            }
            //changeType(orderId){
            //    var changeType = $("#sel"+orderId).val();
            //    $.getJSON('/api/wxorder/changetype/'+orderId+'/'+changeType, (data)=> {
            //        console.log(data);
            //        this.getOrder();
            //    });
            //}
        }
    })
})