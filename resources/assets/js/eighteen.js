$(document).ready(function(){
    new Vue({
        el: '#app',
        data: function () {
            return {
                wxcasas:null
            };
        },
        ready:function(){
            this.getlist();
        },
        methods: {
            //获取民宿列表方法
            getlist(){
                $.getJSON('/api/eighteen/', (data)=> {
                    this.wxcasas = data;
                })
            },
            //添加
            add(id){
                $.getJSON('/back/api/eighteen/add/' + id, ()=> {
                    this.getlist();
                })
            },
            del(id){
                $.getJSON('/back/api/eighteen/del/'+id, ()=> {
                    this.getlist();
                })
            }
        }})
})