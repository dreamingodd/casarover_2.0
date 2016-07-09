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
            pages:null
        },
        created: function () {
            this.getOrder();
        },
        methods:{
            getOrder(page){
                $('.pagination li').removeClass('active');
                $('.pagination li:eq('+(page-1)+')').addClass('active');
                $.getJSON('/back/api/wxorder/list/?page='+page, (data)=> {
                    this.orders = data.result.data;
                    this.pageArr(data.result.last_page);
                });
            },
            pageArr(page){
                var allpages = [];
                for(var i=1; i<=page;i++){
                    allpages.push(i);
                }
                this.pages = allpages;
            },
            del(orderId){
                $.ajax('/back/api/wxorder/del', {
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
});
