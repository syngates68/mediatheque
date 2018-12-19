<?php session_start(); 

$root = str_replace('\\', '/', dirname(__DIR__));

require('model/model.php');

function getHome(){
    $videos = getAll('video v', ' v.titre, v.id_theme, v.gratuite, v.lien, v.prix, v.date_ajout, t.nom as theme, t.couleur ', ' left join theme t on v.id_theme = t.id ', '', '', ' ORDER BY v.gratuite DESC');
    $themes = getAll('theme', ' id, nom, couleur ', '', '', '', '');
    getTime('');
    require ('view/homeView.php');
}

function getAbonnement(){
    $abos = getAll('type_abonnement', ' id, nom, essai ', '', '', '', '');
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


