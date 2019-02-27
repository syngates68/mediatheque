$(function(){
    $('#modif_mail').on('click', function(){
        $('.profil_infos #input_mail').css('display', 'block').focus();
        $('.profil_infos #mail_user').css('display', 'none');
        $(this).css('display', 'none');
        $('#supp_user').css('display', 'none');
        $('#mail_valid').css('display', 'inline-block');
        $('#mail_annule').css('display', 'inline-block');
    });

    $('#mail_annule').on('click', function(){
        $('.profil_infos #input_mail').css('display', 'none');
        $('.profil_infos #mail_user').css('display', 'block');
        $('#modif_mail').css('display', 'inline-block');
        $('#supp_user').css('display', 'inline-block');
        $('#mail_valid').css('display', 'none');
        $(this).css('display', 'none');
    });

    $("#delete_user").on('click', function() {
        window.location="http://localhost/mediatheque/public/utilisateur/delete_compte"; 
    });

    $("input:file").change(function (e){

        var fd = new FormData();
        var files = this.files[0];
        fd.append('file',files);

        $.ajax({
            url: 'http://localhost/mediatheque/public/utilisateur/update_photo',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                location.reload();
            },
        });

    });

    $(document).on('click', '#stop_abo', function(){
        $('#resilier_abonnement').show();
    });

    $(document).on('click', '.annuler', function(){
        $('#resilier_abonnement').hide();
    });

    $(document).on('click', '#delete_abo', function(){
        var id = $(this).attr('data-id');
        
        $.post('http://localhost/mediatheque/public/ajax/fin_abo', {
            id : id
        },
    
        function(){
            location.reload();
        });
    });

});