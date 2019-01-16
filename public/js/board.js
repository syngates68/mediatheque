function charge_liste_videos(type, themes, tri){

    $.post('http://localhost/mediatheque/public/ajax/list_videos', {
        type : type,
        tri : tri,
        themes : themes
    },

    function(data){
        $('.list_videos').html(data);
        // alert(data);
    });

}

$('#filtre #type_video').on('change', function(){

    if ($(this).val() == 3){
        $('#filtre .tri_prix').css('display', 'block');
        var type = $(this).val();
        var tri = $('#filtre #tri_video').val();
    }
    else{
        $('#filtre .tri_prix').css('display', 'none');
        var type = $(this).val();
        var tri = '';
    }

    var themes = new Array();

    $('.themes').each(function(){
        if ($(this).attr('checked') == 'checked'){
            themes.push($(this).attr('value'));
        }
    });

    charge_liste_videos(type, themes, tri);

});

$('#filtre #tri_video').on('change', function(){

    var type = $('#filtre #type_video').val();
    var tri = $(this).val();
    var themes = new Array();

    $('.themes').each(function(){
        if ($(this).attr('checked') == 'checked'){
            themes.push($(this).attr('value'));
        }
    });

    charge_liste_videos(type, themes, tri);

});

$('.themes').on('click', function(){

    var type = $('#filtre #type_video').val();
    var tri = $('#filtre #tri_video').val();
    var themes = new Array();

    if ($(this).attr("checked")==undefined) { 
        $(this).attr("checked","checked");
    } 
    else {
        $(this).attr("checked",false);
    }

    $('.themes').each(function(){
        if ($(this).attr('checked') == 'checked'){
            themes.push($(this).attr('value'));
        }
    });

    charge_liste_videos(type, themes, tri);
});
