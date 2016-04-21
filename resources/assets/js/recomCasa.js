$(document).ready(function(){
    new Vue({
        el: '#main',
        data: {
            casas: null,
            checkedNames: [],
            selected:2
        },
        created: function () {
            this.getcasa(2);
        },
        methods:{
            getcasa:function(){
                vm = this;
                $.getJSON('/api/casa/recom/'+vm.selected,function (data) {
                    vm.casas = data;
                    vm.sel();
                }.bind(vm));
            },
            save:function(){
                vm = this;
                $.ajax('/api/recom/save', {
                    type: 'post',
                    data: {
                        city:vm.selected,
                        casa:vm.checkedNames
                    },
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(data){
                        if(data.msg){
                            $('.alert').css('display','block');
                            $('.alert').delay("slow").slideUp(500);
                            vm.sel();
                        }
                    }
                });
                vm.checkedNames=[];
            },
            sel:function(){
                vm = this;
                $.getJSON('/api/home/recom/'+vm.selected,function (data) {
                    for(var k=0; k < data.length; k++){
                        vm.checkedNames.push(data[k].id.toString());
                    }
                });
            }
        }
    })
})