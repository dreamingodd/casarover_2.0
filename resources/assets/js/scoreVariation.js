$(document).ready(function(){
    new Vue({
        el: '#app',
        data: function () {
            return {
                points:[],
                userid:null,
                page:1,
                more:null,
                point:null
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
                    if(data.next_page_url){
                        this.more = 1;
                        this.page = 2;
                    }
                })
            },
            nextpage(page){
                $.getJSON('/wx/api/scorevariation/'+this.userid+'?page='+page, (data) => {
                    for(var i=0; i<data.data.length;i++ ){
                        this.point = data.data[i];
                        this.points.push(this.point);
                        this.point = null;
                    }
                    if(data.next_page_url){
                        this.page ++;
                    }else{
                        this.more = null;
                    }
                })
            }
        }
    });
})