<?php 

namespace Controller;

use Model\TypeAbonnement;
use App\Factory;

class AbonnementController extends Controller{

    static function getAbonnement(){
        $template = self::loadTwig()->load('template.twig');
        $abos = TypeAbonnement::getAllTypeAbonnements();
        echo self::loadTwig()->render('abonnement.twig', ['abos' => $abos]);
    }
    
}


