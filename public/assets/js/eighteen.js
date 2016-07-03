$(document).ready(function(){
    new Vue({
        el: '#app',
        data: function () {
            return {
                wxcasas:null
            };
        },
        ready:function() {
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
            },
            
            displayOrderEdit(e) {
                // Clicked element.
                var self = $(e.target);
                self.parent().hide();
                self.parent().siblings().show();
            },
            displayOrderSave(e) {
                // Clicked element.
                var self = $(e.target);
                var casaId = self.attr('db_id');
                var displayOrder = self.siblings().first().val();
                location.href = '/back/wx/casa/display/order/' + casaId + '/' + displayOrder;
            }
        }
    });
})
