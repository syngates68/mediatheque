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
        $last_video = Video::getLastVideo();
        //var_dump($videos);
        $themes = Theme::getAllThemes();
        echo self::loadTwig()->render('board.twig', ['videos' => $videos, 'last_video' => $last_video]);
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
                $_SESSION['id'] = $u->get_id();
                $_SESSION['pseudo'] = $u->get_pseudo();
                $_SESSION['date_creation'] = $u->get_date_creation();
                $_SESSION['nom'] = $u->get_nom();
                $_SESSION['prenom'] = $u->get_prenom();
                $_SESSION['mail'] = $u->get_mail();
                $_SESSION['pic'] = $u->get_pic();
                header('location:'.BASEURL.'home/board');
            }
        }
        else{
            $_SESSION['error_connect'] = 'Mauvaises informations rentrées';
            //unset($_SESSION['error_connect']);
            header('location:'.BASEURL.'home/login');
        }
    }

    static function postInscription(){
        
    }
    
}