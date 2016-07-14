$(document).ready(function(){
    new Vue({
        el: '#app',
        data: function () {
            return {
                vacaProducts : null
            };
        },
        ready:function(){
            this.getlist();
        },
        methods: {
            //获取民宿列表方法
            getlist(){
                $.getJSON('/back/api/vacation/casa', (data)=> {
                    this.vacaProducts = data;
                })
            },
            save(id){
                $.ajax('/back/api/vacation/update', {
                    type: 'post',
                    data: {
                        id: id,
                        name: $('#name' + id).val(),
                        orig: $("#orig" + id).val(),
                        price: $("#price" + id).val(),
                        surplus: $("#surplus" + id).val(),
                        isWhole: $('#isWhole' + id).prop('checked') == true ? 1 : 0
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
