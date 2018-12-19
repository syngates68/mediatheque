<?php session_start(); 

use \Mediatheque\Model\Video;
use \Mediatheque\Model\Theme;
use \Mediatheque\Model\Abonnement;

$root = str_replace('\\', '/', dirname(__DIR__));

require_once('Model/Video.php');
require_once('Model/Theme.php');
require_once('Model/Abonnement.php');

function getHome(){
    $videos = Video::getAllVideos();
    $themes = Theme::getAllThemes();
    //$date_format = $model->getTime('');
    require ('view/homeView.php');
}

function getAbonnement(){
    $abos = Abonnement::getAllAbonnements();
    require ('view/abonnementView.php');
}

function getLogin(){
    require ('view/loginView.php');
}

//A REVOIR AVEC BDD
/*function getLogin($mail = '', $pass = ''){
    
    $pass = md5(md5($pass));
    
    $datas = getUser($mail, $pass);
    if (sizeof(getUser($mail, $pass)) == 0){
        $alert = 'Aucun résultat pour ces informations';
    }
    else{
        header('Location: board');
        foreach ($datas as $data){
            $_SESSION['name'] = $data['name'];
        }
    }

    require ('view/backoffice/loginView.php');
}*/


