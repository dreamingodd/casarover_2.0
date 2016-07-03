function selectCasa(id,name){
    var dom = $("#select-casa");
    var domvalue = $("#casa-id");
    domvalue.val(id);
    dom.val(name);
}
$(function()
{
    $('#enlarge').click(function (e)
    {
        x=$('#search').val();
        a=1;
        $('.table-hover td').each(function()
        {
            var t = $(this).text().indexOf(x);/*是否包含字段*/
            if(t>-1)
            {
                if(a==1)/*第二次找到符合关键字的信息后不隐藏之前符合的信息*/
                    $('.table-hover tr').hide();
                $(this).parent().show();
                a++;
            }
        });
        e.preventDefault();
    });
    $('#reset').click(function ()
    {
        $('.table-hover tr').show();
    });
    $("#search").keydown(function(event){
        event=document.all?window.event:event;
        if((event.keyCode || event.which)==13){
            $('#enlarge').click();
            event.preventDefault();
        }
    });
    $("#search").keydown(function(event){
        event=document.all?window.event:event;
        if((event.keyCode || event.which)==16){
            $('#reset').click();
        }
    });
});
