<?php 

namespace Controller;

use Model\Abonnement;
use Model\Utilisateur;

use Config\Factory;

class UtilisateurController extends Controller{

    static function getProfil(){
        if (isset($_SESSION['auth']['id'])){
            $template = self::loadTwig()->load('template.twig');
            $profil = Utilisateur::getUserById($_SESSION['auth']['id']);
            echo self::loadTwig()->render('profil.twig', ['profil' => $profil]);
        }
        else{
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    static function getSign_Out(){
        //session_start();
        session_destroy();
        setcookie('auth', '', time() - 3600, '/', '', false, true);
        header('Location:'.BASEURL.'home/login');
        exit;
    }
    
}


