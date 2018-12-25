<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\TypeAbonnement;
use App\Factory;

class HomeController extends Controller{

    static function getHome(){
        $template = self::loadTwig()->load('template.twig');
        $videos = Video::getAllVideos();
        //var_dump($videos);
        $themes = Theme::getAllThemes();
        echo self::loadTwig()->render('home.twig', ['videos' => $videos]);
    }

    static function getAbonnement(){
        $template = self::loadTwig()->load('template.twig');
        $abos = TypeAbonnement::getAllTypeAbonnements();
        echo self::loadTwig()->render('abonnement.twig', ['abos' => $abos]);
    }

    static function getLogin(){
        echo self::loadTwig()->render('login.twig');
    }
    
}