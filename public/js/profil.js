$(function(){
    $('#modif_mail').on('click', function(){
        $('.profil_infos #input_mail').css('display', 'block').focus();
        $('.profil_infos #mail_user').css('display', 'none');
        $(this).css('display', 'none');
        $('#supp_user').css('display', 'none');
        $('#mail_valid').css('display', 'block');
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

});