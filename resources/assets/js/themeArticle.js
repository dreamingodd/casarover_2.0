$(document).ready(function(){
    new Vue({
        el: '#main',
        data: {
            articles: null,
            selected:null
        },
        created: function () {
            this.getArticle(2);
        },
        methods:{
            getArticle:function(){
                vm = this;
                $.getJSON('/api/theme/article/'+vm.selected,function (data) {
                    vm.articles = data;
                }.bind(vm));
            }
        }
    })
})