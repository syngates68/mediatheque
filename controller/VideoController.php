<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\TypeAbonnement;
use Model\Utilisateur;
use Model\Commentaire;
use Model\Paiements;
use Model\Achat;

//use Vendor\PaypalPayment;

use Config\Factory;

class VideoController extends Controller{

    public function getWatch($id){
        if (isset($_SESSION['auth']['id'])){
            $video = Video::getVideoById($id);
            $this->set('video', $video);
            foreach ($video as $v){
                $video_id = $v->get_id();
                $this->set('video_id', $video_id);
                $video_title = $v->get_titre();
                $this->set('video_title', $video_title);
                $video_link = $v->get_miniature();
                $this->set('video_link', $video_link);
                $video_prix = $v->get_prix();
                $this->set('video_prix', $video_prix);
            }
            $user_achat = Achat::getByVideo($video_id, $_SESSION['auth']['id']);
            if ($video_prix == NULL || !empty($user_achat) ){
                $commentaires = Commentaire::getAllCommentaireByVideo($id);
                $nb_com = sizeof(Commentaire::getAllCommentaireByVideo($id));
                $this->set('commentaires', $commentaires);
                $this->set('nb_com', $nb_com);
                $this->render('watch');
            }
            else{   
                $this->getPay($video_id); 
            }
        }
        else{
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    public function getPay($id){
        if (isset($_SESSION['auth']['id'])){
            $video = Video::getVideoById($id);
            $this->set('video', $video);
            $this->render('pay');
        }
        else{
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

}