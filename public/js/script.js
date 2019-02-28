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
                $('.hide_navbar').css('display', 'none');
                $('.site_content').removeClass('with_sidebar');
            }
            else{
                $('.hide_navbar').css('display', 'block');
                if ($('.open').hasClass('change')){
                    $('.open').removeClass('change');
                    $('.hide_navbar').removeClass('opened');
                }
            }
        });
    }

    $(window).on('scroll', function(){
        if($(this).scrollTop() > 20){
            $('#navbar').css('line-height', '50px');
            $('#navbar .navbar-brand').css('transform', 'translateX(-150%)');
            $('#navbar .navbar-nav').css('transform', 'translateX(-20%)');
        }
        else{
            $('#navbar').css('line-height', '28px');
            $('#navbar .navbar-brand').css('transform', 'translateX(0)');
            $('#navbar .navbar-nav').css('transform', 'translateX(0)');
        }
    });

    $(document).on('click', '.sommaire a', function(e){
        e.preventDefault();
        var target = $(this).attr('href');
        $('html, body').animate({scrollTop: $(target).offset().top}, 1000 );
    });

});