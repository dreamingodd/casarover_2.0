$(document).ready(function(){new Vue({el:"#app",data:function(){return{points:null,userid:null,page:1,more:null}},ready:function(){var e=$("#id").val();this.userid=e,this.getlist(1)},methods:{getlist:function(e){var t=this;$.getJSON("/wx/api/scorevariation/"+this.userid+"?page="+e,function(e){t.points=e.data,e.prev_page_url&&(t.more=1,t.page=2)})}}})});