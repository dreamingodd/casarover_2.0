function setchange(e){$.ajax("/api/theme/change",{type:"post",data:{id:e},headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},success:function(e){console.log(e),e.msg&&($(".alert").css("display","block"),$(".alert").delay("slow").slideUp(500))}})}