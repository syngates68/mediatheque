$(function() {
    //$('#sign_up .alert').css('display', 'none');
    $('#sign_up button').on('click', function(){
        if ($('#sign_up #name').val() != '' && $('#sign_up #prenom').val() != '' && $('#sign_up #mail').val() != '' && $('#sign_up #username').val() != '' && $('#sign_up #pass').val() != '' && $('#sign_up #pass2').val() != ''){
            return true;
        }
        else{
            $('#sign_up .alert').css('display', 'block');
            return false;
        }
    });
});