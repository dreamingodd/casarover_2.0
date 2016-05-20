$(document).ready(function(){
    new Vue({
        el: '#app',
        data: function () {
            return {
                points:null,
                userid:null,
                page:1,
                more:null
            };
        },
        ready:function(){
            let userid = $("#id").val();
            this.userid = userid;
            this.getlist(1);
        },
        methods: {
            getlist (page){
                $.getJSON('/wx/api/scorevariation/'+this.userid+'?page='+page, (data) => {
                    this.points = data.data;
                    if(data.prev_page_url){
                        this.more = 1;
                        this.page = 2;
                    }
                })
            }
        }
    });
})