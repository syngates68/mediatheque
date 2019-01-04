$(function(){

    //AFFICHAGE DU MENU SUR PC
    $('.open').click(function(){
        $(this).toggleClass('change');
        if ($(this).hasClass('change')){
            $('.hide_navbar').addClass('opened');
            $('.site_content').addClass('with_sidebar');
        }
        else{
            $('.hide_navbar').removeClass('opened');
            $('.site_content').removeClass('with_sidebar');
        }
    });

    $('.site_content').click(function(){
        $('.hide_navbar').removeClass('opened');
        $('.site_content').removeClass('with_sidebar');
        if ($('.open').hasClass('change')){
            $('.open').toggleClass('change');
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

});