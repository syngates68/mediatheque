function loading(bool, msg)
{
    if(bool)
    {
        $('#loader').css('display', 'block');
        $('#loader p').html(msg);
    }
    else
    {
        $('#loader').css('display', 'none');
    }
}

function charge_liste_videos(type, themes, tri, search){

    loading(true, 'Chargement des vidéos en cours...');
    $('.lv_container').css('display', 'none');

    $.post(baseurl+'ajax/list_videos', {
        type : type,
        tri : tri,
        themes : themes,
        search : search
    },

    function(data){
        loading(false, '');
        $('.video-content').html(data);
    });

}

$('#search input').on('focus', function(){
    $(this).on('keyup', function(e){
        if ($(this).val() != ""){

            $('#button_search').removeClass('disabled');

            if(e.keyCode == 13) { // KeyCode de la touche entrée
                if ($('#filtre #type_video').val() == 3){
                    $('#filtre .tri_prix').css('display', 'block');
                    var type = $('#filtre #type_video').val();
                    var tri = $('#filtre #tri_video').val();
                    var search = $('#search input').val();
                }
                else{
                    $('#filtre .tri_prix').css('display', 'none');
                    var type = $('#filtre #type_video').val();
                    var tri = $('#filtre #tri').val();
                    var search = $('#search input').val();
                }
    
                var themes = new Array();
    
                $('.themes').each(function(){
                    if ($(this).attr('checked') == 'checked'){
                        themes.push($(this).attr('value'));
                    }
                });
    
                charge_liste_videos(type, themes, tri, search);
            }

        }
        else{
            $('#button_search').addClass('disabled');
        }
    });
});

$('#search button').on('click', function(){

    if (!$(this).hasClass('disabled')){
        if ($(this).val() == 3){
            $('#filtre .tri_prix').css('display', 'block');
            var type = $('#filtre #type_video').val();
            var tri = $('#filtre #tri_video').val();
            var search = $('#search input').val();
        }
        else{
            $('#filtre .tri_prix').css('display', 'none');
            var type = $('#filtre #type_video').val();
            var tri = '';
            var search = $('#search input').val();
        }
    
        var themes = new Array();
    
        $('.themes').each(function(){
            if ($(this).attr('checked') == 'checked'){
                themes.push($(this).attr('value'));
            }
        });
    
        charge_liste_videos(type, themes, tri, search);
    }
});

$('#filtre #type_video').on('change', function(){

    if ($(this).val() == 3){
        $('#filtre .tri_prix').css('display', 'block');
        $('#filtre .tri').css('display', 'none');
        var type = $(this).val();
        var tri = $('#filtre #tri_video').val();
        if (tri == 'undefined'){
            var tri = $('#filtre #tri').val();
        }
        var search = $('#search input').val();
    }
    else{
        $('#filtre .tri_prix').css('display', 'none');
        $('#filtre .tri').css('display', 'block');
        var type = $(this).val();
        var tri = '';
        var search = $('#search input').val();
    }

    var themes = new Array();

    $('.themes').each(function(){
        if ($(this).attr('checked') == 'checked'){
            themes.push($(this).attr('value'));
        }
    });

    charge_liste_videos(type, themes, tri, search);

});

$('#filtre #tri_video').on('change', function(){

    var type = $('#filtre #type_video').val();
    var tri = $(this).val();
    var search = $('#search input').val();
    var themes = new Array();

    $('.themes').each(function(){
        if ($(this).attr('checked') == 'checked'){
            themes.push($(this).attr('value'));
        }
    });

    charge_liste_videos(type, themes, tri, search);

});

$('#filtre #tri').on('change', function(){

    var type = $('#filtre #type_video').val();
    var tri = $(this).val();
    var search = $('#search input').val();
    var themes = new Array();

    $('.themes').each(function(){
        if ($(this).attr('checked') == 'checked'){
            themes.push($(this).attr('value'));
        }
    });

    charge_liste_videos(type, themes, tri, search);

});

$('.themes').on('click', function(){

    var type = $('#filtre #type_video').val();
    if (type == 3){
        var tri = $('#filtre #tri_video').val();
    }
    else{
        var tri = $('#filtre #tri').val();
    }
    var search = $('#search input').val();
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

    charge_liste_videos(type, themes, tri, search);
});
