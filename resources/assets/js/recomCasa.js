$(document).ready(function(){
    new Vue({
        el: '#main',
        data: {
            casas: null,
            checkedNames: [],
            selected:2
        },
        methods:{
            getcasa:function(){
                vm = this;
                $.getJSON('/api/casa/recom/'+vm.selected,function (data) {
                    vm.casas = data;
                }.bind(vm));
            }
        }
    })
})