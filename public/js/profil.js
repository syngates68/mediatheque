$(function(){
    $('#modif_mail').on('click', function(){
        $('.profil_infos input').css('display', 'block');
        $('.profil_infos #mail_user').css('display', 'none');
        $(this).css('display', 'none');
        $('#supp_user').css('display', 'none');
        $('#mail_valid').css('display', 'block');
    });

    $("#delete_user").on('click', function() {
        window.location="http://localhost/mediatheque/public/utilisateur/delete_compte"; 
    });

    
    $('.profil_infos a').on('click', function(){
        if ($(this).find('.fas').hasClass('fa-sort-down')){
            $(this).find('.fas').removeClass('fa-sort-down').addClass('fa-sort-up');
        }
        else{
            $(this).find('.fas').removeClass('fa-sort-up').addClass('fa-sort-down');
        }
    });
    
});
