<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\TypeAbonnement;
use Model\utilisateur;

use App\Factory;

class HomeController extends Controller{

    static function getBoard(){
        $template = self::loadTwig()->load('template.twig');
        $videos = Video::getAllVideos();
        //var_dump($videos);
        $themes = Theme::getAllThemes();
        echo self::loadTwig()->render('board.twig', ['videos' => $videos]);
    }

    static function getAbonnement(){
        $template = self::loadTwig()->load('template.twig');
        $abos = TypeAbonnement::getAllTypeAbonnements();
        echo self::loadTwig()->render('abonnement.twig', ['abos' => $abos]);
    }

    static function getLogin(){
        echo self::loadTwig()->render('login.twig');
    }

    static function postConnect(){
        $user = Utilisateur::getUser($_POST['mail'], md5(md5($_POST['pass'])));
        if (!empty($user)){
            foreach ($user as $u){
                header('location:'.BASEURL.'home/board');
            }
        }
        else{
            header('location:'.BASEURL.'home/login');
        }
    }

    static function postInscription(){
        
    }
    
}