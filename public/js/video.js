$(function(){

    $('.video button').on('click', function(){

        var id = $(this).attr('data-id');

    });

    $('.v_infos').on('click', 'button', function(){
        if( $('.my_video').width() < 1000){
            $('.my_video').css('width', '100%');
        }
        else{
            $('.my_video').css('width', '70%');
        }
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

});