$(function(){
    $('#submitBtn').click(function(){
        // 1.Parameter check.
        var personName = $('#personName').val();
        var cellphone = $('#cellphone').val();
        var casaName = $('#casaName').val();
        if (!personName) {
            alert("请输入姓名！");
            return;
        }
        if (!isCellphoneNumber(cellphone)) {
            alert("请输入正确的手机号码！");
            return;
        }
        if (!casaName) {
            alert("请输入民宿名称！");
            return;
        }
        $('#bindApplyForm').submit();
    });
});
