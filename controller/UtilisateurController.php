<?php 

namespace Controller;

use Model\Abonnement;
use Model\Utilisateur;

use Config\Factory;

class UtilisateurController extends Controller{

    static function getProfil(){
        $template = self::loadTwig()->load('template.twig');
        $profil = Utilisateur::getUserById($_SESSION['auth']['id']);
        echo self::loadTwig()->render('profil.twig', ['profil' => $profil]);
    }

    static function getSign_Out(){
        //session_start();
        session_destroy();
        header('Location:'.BASEURL.'home/login');
        exit;
    }
    
}


