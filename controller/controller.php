<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\Abonnement;

require ('vendor/autoload.php');

//$root = str_replace('\\', '/', dirname(__DIR__));

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

    static function getHome(){
        $template = self::loadTwig()->load('template.twig');
        $videos = Video::getAllVideos();
        $themes = Theme::getAllThemes();
        echo self::loadTwig()->render('home.twig', ['videos' => $videos]);
    }
    
    static function getAbonnement(){
        $template = self::loadTwig()->load('template.twig');
        $abos = Abonnement::getAllAbonnements();
        echo self::loadTwig()->render('abonnement.twig', ['abos' => $abos]);
    }
    
    static function getLogin(){
        echo self::loadTwig()->render('login.twig');
    }
    
}


