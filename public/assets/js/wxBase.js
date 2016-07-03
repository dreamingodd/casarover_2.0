$(function(){
    $('.goback').click(function() {
        history.go(-1);
    });
});

function isCellphoneNumber(str) {
   var pattern = /^\d{11}$/;
   return pattern.test(str);
}
