$(function(){

    $('.video button').on('click', function(){

        var id = $(this).attr('data-id');

    });

    $(document).on('click', '#showSupprimer', function(){
        var id_com = $(this).attr('data-commentaire');
        $('#supprimer-commentaire_'+id_com).show();
    });    

    $(document).on('click', '.supprimer-commentaire .annuler', function(){
        var id_com = $('#showSupprimer').attr('data-commentaire');
        $('#supprimer-commentaire_'+id_com).css('display', 'none');
    });

    $(document).on('mouseover', '#note ul li', function(){
        var onStar = parseInt($(this).attr('id'), 10); 

        $(this).parent().children('li.fa').each(function(e){
            if (e < onStar) {
              $(this).addClass('checked');
            }
            else {
              $(this).removeClass('checked');
            }
          });
          
        }).on('mouseout', function(){
          $(this).parent().children('li.fa').each(function(e){
            $(this).removeClass('checked');
          });
    });

    $(document).on('click', '#note ul li', function(){
        var onStar = parseInt($(this).attr('id'), 10); // The star currently selected
        var stars = $(this).parent().children('li.fa');
        
        for (i = 0; i < stars.length; i++) {
          $(stars[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
          $(stars[i]).addClass('selected');
        }
        
    });

    $(document).on('keyup', '#com_contain', function(){
        $('#btn_com').css('visibility', 'visible');
        $('#note').css('visibility', 'visible');
        if ($(this).val() == ''){
            $('#btn_com').css('visibility', 'hidden');
            $('#note').css('visibility', 'hidden');
        }
        //var text = $(this).val().replace(':)', '<img src="http://localhost/mediatheque/public/images/smile.png" contentEditable="true">');
        //alert(text);
        //$(this).html(text);
    });

    $(document).on('click', '#btn_com', function(){

        if ($('.video #player').attr('data-id') != undefined){
            var id = $('.video #player').attr('data-id');
        }
        else{
            var id = $('.video #video-control').attr('data-id');
        }

        // JUST RESPONSE (Not needed)
        var content = $('#com_contain').val();
        var note = parseInt($('#note li.selected').last().attr('id'), 10);

        //alert(note);

        $.post('http://localhost/mediatheque/public/ajax/comment', {
            id : id,
            content : content,
            note : note
        },

        function(data){
            $('.commentaires').html(data);
           // alert(data);
        });

        return false;

    });

    $(document).on('click', '#delete_comment', function(){

        var id_com = $(this).attr('data-id');

        if ($('.video iframe').attr('data-id') != undefined){
            var id_video = $('.video iframe').attr('data-id');
        }
        else{
            var id_video = $('.video video').attr('data-id');
        }

        var id_user = $(this).attr('data-user');
        
        $.post('http://localhost/mediatheque/public/ajax/delete_comment', {
            id_com : id_com,
            id_video : id_video,
            id_user : id_user
        },
        function(data){
            $('.commentaires').html(data);
        });

        return false;
    });

    $(document).on('click', '#see_description', function(){
        $('.description p').css('display', 'block');
        $(this).addClass('close_description').text('Fermer la description');
    });

    $(document).on('click', '.close_description', function(){
        $('.description p').css('display', 'none');
        $(this).removeClass('close_description').text('Voir la description');
    });

    $(document).on('click', '#btn-valid-cb', function(){
        var id_video = $(this).attr('data-id');
        var prix = $(this).attr('data-prix');
        
        $.post('http://localhost/mediatheque/public/video/pay_video_cb', {
            id_video : id_video,
            prix : prix
        },
        function(){
            $('#success_payment').html('Votre paiement a bien été accepté! Veuillez patienter, vous allez être redirigé vers la vidéo!').css('display', 'block');
            setTimeout(function(){ window.location.replace('http://localhost/mediatheque/public/video/watch/'+id_video); }, 3000);
        });

    });

});