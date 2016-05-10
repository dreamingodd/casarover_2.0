function selectCasa(id,name){
    var dom = $("#select-casa");
    var domvalue = $("#casa-id");
    domvalue.val(id);
    dom.val(name);
}
$(function()
{
    $('#enlarge').click( function (e){
        $('.modal .table-hover tr').hide();
        var searchText = $('#search').val();
        $('.modal .table-hover td').each(function(){
            var contain = $(this).text().indexOf(searchText) > -1;/*是否包含字段*/
            if (contain) {
                $(this).parent().show();
            }
        });
        e.preventDefault();
    });
    $('#reset').click(function ()
    {
        $('.modal .table-hover tr').show();
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
