function checkParameters(a,s,t){return a?isCellphoneNumber(s)?!(t<3)||(alert("请至少选择三家民宿"),!1):(alert("请输入正确的手机号码！"),!1):(alert("请输入姓名！"),!1)}$(document).ready(function(){window.onhashchange=function(){var s=window.location.hash;return"show"==s?null:void(a.casa=null)},$("#navleft").click(function(){a.casa?($("#navleft").attr("href","#"),a.casa=null):$("#navleft").attr("href","/wx/user")}),Vue.filter("roundDisplay",function(a){return a.toFixed(2)});var a=new Vue({el:"#app",data:{casas:null,casa:null,total:0,goods:[]},created:function(){this.getcasas()},methods:{getcasas:function(){var a=this;$.getJSON("/wx/api/cardCasaList",function(s){a.casas=s})},getcasa:function(a){var s=this;$.getJSON("/wx/api/cardCasa/"+a,function(a){s.casa=a});var t="show";window.location.hash=t},buy:function(){this.goods=[];var a=$("#username").val(),s=$("#cellphone").val(),t=this.selectd().length;checkParameters(a,s,t)&&$.ajax("/wx/api/cardCasaBuy",{type:"post",data:{casas:this.goods,username:a,cellphone:s},headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},success:function(a){console.log("order create successfully!"),console.log(a),a.orderId?location.href="/wx/pay/wxorder/"+a.orderId:(console.log(a),alert("探庐君处理你的请求时晕倒了, 请稍后再试！"))}})},plus:function(a){this.total+=this.casas[a].price,this.casas[a].room++},minus:function(a){this.casas[a].room<=0||(this.casas[a].room--,this.total-=this.casas[a].price)},sel:function(a){this.casas[a].room>0?(this.total=this.total-this.casas[a].price*this.casas[a].room,this.casas[a].room=0):(this.total+=this.casas[a].price,this.casas[a].room++)},calculateTotal:function(){for(var a=0,s=0;s<this.casas.length;s++)a+=this.casas[s].price*this.casas[s].room;this.total=a},selectd:function(){for(var a in this.casas)if(this.casas[a].room>0){var s={id:this.casas[a].id,headImg:this.casas[a].headImg,room:this.casas[a].room};this.goods.push(s)}return this.goods}}})});