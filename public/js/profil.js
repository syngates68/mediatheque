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

        /*var file = this.files[0];
        //var form = new FormData($("#modif-photo-form"));

        //alert(form[0]);

        var name = file.name;  
        var size = file.size;  
        var type = file.type;       
        var path = URL.createObjectURL(e.target.files[0]);

        $.post('http://localhost/mediatheque/public/utilisateur/update_photo', {
            name : name,
            size : size,
            type : type,
            path : path
        },

        function(data){
            //$('#delete_user').html(data);
            location.reload();
        });*/

    });

});