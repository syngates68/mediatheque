//AFFICHAGE DU MENU SUR MOBILE
$('.open').click(function(){
    $(this).toggleClass('change');
    if ($(this).hasClass('change')){
        $('#side_nav_mobile').fadeIn(500);
    }
    else{
        $('#side_nav_mobile').fadeOut(500);
    }
});

if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) )
{
    $(window).on('resize', function(){
        var width = $(window).width();
    
        if (width > 700){
            //alert('ordi');
            $('#side_nav_mobile').css('display', 'none');
        }
        else{
            //alert('tel');
            if ($('.open').hasClass('change')){
                $('.open').removeClass('change');
            }
        }
    });
}

$('#sign_in #btn_sign_in').on('click', function(){
    if ($('#sign_in #username').val() == ''){
        $('#sign_in #username').attr('placeholder', 'Le nom d\'utilisateur est vide');
        return false;
    }
});


