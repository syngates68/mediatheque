<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use App\Factory;

class HomeController extends Controller{

    static function getHome(){
        $template = self::loadTwig()->load('template.twig');
        $videos = Video::getAllVideos();
        $themes = Theme::getAllThemes();
        echo self::loadTwig()->render('home.twig', ['videos' => $videos]);
    }
    
}