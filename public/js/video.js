$(function(){

    $('.video button').on('click', function(){

        var id = $(this).attr('data-id');

    });

    $('.v_infos').on('click', 'button', function(){
        //alert($('.my_video').width());
        if( $('.my_video').width() < 1400){
            $('.my_video').css('padding', '0');
        }
        else{
            $('.my_video').css('padding', '40px 150px');
        }
    });

    $(document).on('keyup', '#com_contain', function(){
        $('#btn_com').css('visibility', 'visible');
        if ($(this).val() == ''){
            $('#btn_com').css('visibility', 'hidden');
        }
    });

    $(document).on('click', '#btn_com', function(){
        
        var id = $('.video embed').attr('data-id');
        var content = $('#com_contain').val();

        $.post('http://localhost/mediatheque/public/ajax/comment', {
            id : id,
            content : content
        },

        function(data){
            $('.commentaires').html(data);
           // alert(data);
        });

        return false;

    });

    var popupCenter = function(url, title, width, height){
        var popupWidth = width || 640;
        var popupHeight = height || 320;
        var windowLeft = window.screenLeft || window.screenX;
        var windowTop = window.screenTop || window.screenY;
        var windowWidth = window.innerWidth || document.documentElement.clientWidth;
        var windowHeight = window.innerHeight || document.documentElement.clientHeight;
        var popupLeft = windowLeft + windowWidth / 2 - popupWidth / 2;
        var popupTop = windowTop + windowHeight / 2 - popupHeight / 2;
        var popup = window.open(url, title, 'scrollbars=yes, width = ' + popupWidth + ', height = ' + popupHeight + ', top=' + popupTop + ', left = ' + popupLeft);
        popup.focus();
        return true;
    }

    document.querySelector('.fb-share-button').addEventListener('click', function(e){
        e.preventDefault();
        var url = this.getAttribute('data-url');
        var title = this.getAttribute('date-title');
        var shareUrl = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url) + "&t=" + encodeURIComponent(title);
        popupCenter(shareUrl, "Partager sur Facebook");
    });

    $(document).on('click', '#delete_comment', function(){

        var id_com = $(this).attr('data-id');
        var id_video = $('.video embed').attr('data-id');
        
        $.post('http://localhost/mediatheque/public/ajax/delete_comment', {
            id_com : id_com,
            id_video : id_video
        },
        function(data){
            location.reload();
        });

        return false;
    });

    //$( "#commentaires" ).load("{{BASEURL}}view/commentaires.twig" );

});