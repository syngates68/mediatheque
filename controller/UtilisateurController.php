<?php 

namespace Controller;

use Model\Abonnement;
use App\Factory;

class UtilisateurController extends Controller{

    static function getProfil(){
        $template = self::loadTwig()->load('template.twig');
        //$profil = Profil::getUser();
        echo self::loadTwig()->render('profil.twig');
    }
    
}


