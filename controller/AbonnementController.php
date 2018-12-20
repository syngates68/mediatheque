<?php 

namespace Controller;

use Model\Abonnement;
use App\Factory;

class AbonnementController extends Controller{

    static function getAbonnement(){
        $template = self::loadTwig()->load('template.twig');
        $abos = Abonnement::getAllAbonnements();
        echo self::loadTwig()->render('abonnement.twig', ['abos' => $abos]);
    }
    
}


