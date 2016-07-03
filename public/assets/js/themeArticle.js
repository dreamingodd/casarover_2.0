$(document).ready(function(){
    new Vue({
        el: '#main',
        data: {
            articles: null,
            selected:null
        },
        created: function () {
            this.selected = $("#sel option:first").val();
            this.getArticle(this.selected);
        },
        methods:{
            getArticle(){
                $.getJSON('/api/theme/article/'+this.selected, (data)=> {
                    this.articles = data;
                });
                let seltext = $('#sel').find("option:selected").text();
                window.location.hash = seltext;
            }
        }
    })
})