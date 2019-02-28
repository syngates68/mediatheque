$(document).on('click', '#btn-valid-cb', function(){
    var id_abo = $(this).attr('data-id');
    var prix = $(this).attr('data-prix');
    
    $.post(baseurl+'home/pay_abo_cb', {
        id_abo : id_abo,
        prix : prix
    },
    function(){
        window.location.replace(baseurl+'home/board');
    });

});