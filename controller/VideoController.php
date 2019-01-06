<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\TypeAbonnement;
use Model\Utilisateur;
use Model\Commentaire;

use Config\Factory;

class VideoController extends Controller{

    static function getWatch($id){
        if (isset($_SESSION['auth']['id'])){
            $template = self::loadTwig()->load('template.twig');
            $video = Video::getVideoById($id);
            foreach ($video as $v){
                $video_id = $v->get_id();
                $video_title = $v->get_titre();
                $video_link = $v->get_miniature();
            }
            $commentaires = Commentaire::getAllCommentaireByVideo($id);
            $nb_com = sizeof(Commentaire::getAllCommentaireByVideo($id));
            echo self::loadTwig()->render('watch.twig', ['video' => $video, 'commentaires' => $commentaires, 'nb_com' => $nb_com, 'video_title' => $video_title, 'video_link' => $video_link, 'video_id' => $video_id]);
        }
        else{
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

}