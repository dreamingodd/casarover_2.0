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
                $.getJSON('/back/api/vacation/casa', (data)=> {
                    this.wxcasas = data;
                })
            },
            save(id){
                $.ajax('/back/api/vacation/update', {
                    type: 'post',
                    data: {
                        id:id,
                        orig:$("#orig"+id).val(),
                        price:$("#price"+id).val(),
                        surplus:$("#surplus"+id).val()
                    },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: (data)=>{
                        console.log(data);
                        this.getlist();
                    }
                });
            },
            //添加
            add(id){
                $.getJSON('/back/api/vacation/add/' + id, ()=> {
                    this.getlist();
                })
            },
            del(id){
                $.getJSON('/back/api/vacation/del/'+id, ()=> {
                    this.getlist();
                })
            }
        }})
})