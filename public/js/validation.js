$('.remember').on('click', function(){
    if ($(this).attr("checked")==undefined) { 
        $(this).attr("checked","checked");
    } 
    else {
        $(this).attr("checked",false);
    }
});