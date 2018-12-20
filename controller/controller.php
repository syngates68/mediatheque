<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\Abonnement;

require ('vendor/autoload.php');

class Controller{

    private static $twig = NULL;

    static function loadTwig(){    
        \ComposerAutoloaderInitb80da45cb6974f22f3f089979c4acd7e::getLoader();
        $loader = new \Twig_Loader_Filesystem('view');
        if (is_null(self::$twig)){
            return self::$twig = new \Twig_Environment($loader);
        }
        return self::$twig;
    }
    
}


