$(document).on('click', '#btn-valid-cb', function(){
    var id_abo = $(this).attr('data-id');
    var prix = $(this).attr('data-prix');
    
    $.post('http://localhost/mediatheque/public/home/pay_abo_cb', {
        id_abo : id_abo,
        prix : prix
    },
    function(){
        window.location.replace('http://localhost/mediatheque/public/home/board');
    });

});