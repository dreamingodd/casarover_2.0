$(document).ready(function(){
    new Vue({
        el: '#main',
        data: {
            articles: null,
            selected:null
        },
        created: function () {
            this.selected = $("#sel option:last").val();
            this.getArticle(this.selected);

        },
        methods:{
            getArticle(){
                $.getJSON('/api/theme/article/'+this.selected, (data)=> {
                    this.articles = data;
                });
            }
        }
    })
})