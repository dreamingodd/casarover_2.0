$(document).ready(function(){new Vue({el:"#app",data:function(){return{wxcasas:null}},ready:function(){this.getlist()},methods:{getlist:function(){var t=this;$.getJSON("/back/api/vacation/casa",function(a){t.wxcasas=a})},save:function(t){var a=this;$.ajax("/back/api/vacation/update",{type:"post",data:{id:t,orig:$("#orig"+t).val(),price:$("#price"+t).val(),surplus:$("#surplus"+t).val()},headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},success:function(t){console.log(t),a.getlist()}})},add:function(t){var a=this;$.getJSON("/back/api/vacation/add/"+t,function(){a.getlist()})},del:function(t){var a=this;$.getJSON("/back/api/vacation/del/"+t,function(){a.getlist()})}}})});