<?php session_start();

use Controller\Controller;
use App\Autoload;

require 'App/Autoload.php'; 
Autoload::register(); 

if (isset($_GET['p'])){
    $p = $_GET['p'];
    if ($p == 'abonnement'){
        Controller::getAbonnement();
    }
    elseif ($p == 'login'){
        Controller::getLogin();
    }
    elseif ($p == 'home'){
        Controller::getHome();
    }
}
else{
    header('HTTP/1.0 404 Not Found');
    exit;
}