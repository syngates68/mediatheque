<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\TypeAbonnement;
use Model\Utilisateur;

use Config\Factory;

class HomeController extends Controller{

    static function getBoard(){
        if (isset($_SESSION['auth']['id'])){
            $template = self::loadTwig()->load('template.twig');
            $videos = Video::getAllVideos();
            $last_video = Video::getLastVideo();
            //var_dump($videos);
            $themes = Theme::getAllThemes();
            echo self::loadTwig()->render('board.twig', ['videos' => $videos, 'last_video' => $last_video]);
        }
        else{
            header('Location:'.BASEURL.'home/login');
            exit;
        }
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
                $_SESSION['auth']['id'] = $u->get_id();
                header('location:'.BASEURL.'home/board');
                exit;
            }
        }
        else{
            $_SESSION['error_connect'] = 'Mauvaises informations rentrées';
            header('location:'.BASEURL.'home/login');
            exit;
        }
    }

    static function postInscription(){
        $_SESSION['errors'] = [];
        if ($_POST['pass'] != $_POST['pass2']){
        }
        
        if (empty($_SESSION['errors'])){
            $user = Utilisateur::addUser($_POST['nom'], $_POST['prenom'], $_POST['pseudo'], $_POST['mail'], md5(md5($_POST['pass'])));
            $_SESSION['success_inscription'] = 'Vous êtes désormais inscrit';
            header('location:'.BASEURL.'home/login');
            exit;
        }
    }
    
}