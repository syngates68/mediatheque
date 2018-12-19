<?php

require ('controller/controller.php');

if (isset($_GET['p'])){
    $p = $_GET['p'];
    if ($p == 'abonnement'){
        getAbonnement();
    }
    elseif ($p == 'login'){
        getLogin();
    }
    //A REVOIR AVEC BDD
    /*elseif ($p == 'login'){
        if (isset($_POST['mail']) && isset($_POST['pass'])){
            getLogin($_POST['mail'], $_POST['pass']);
        }
        else{
            getLogin('', '');
        }
    }*/
}
else{
    getHome();
}