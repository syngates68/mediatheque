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

    protected $current_controller = 'VideoController';

    /**
     * Method: GET
     * URL : /video/watch/
     * Permet d'accéder à une vidéo donnée
    **/
    public function getWatch($id){
        if (isset($_SESSION['auth']['id'])){
            $video = Video::getVideoById($id);
            $this->set('video', $video);

            $this->set('video_id', $video->get_id());
            $this->set('video_title', $video->get_titre());
            $this->set('video_link', $video->get_miniature());
            $this->set('video_prix', $video->get_prix());

            $user_achat = Achat::getByVideo($video->get_id(), $_SESSION['auth']['id']);
            if ($video->get_prix() == NULL || !empty($user_achat) ){
                $commentaires = Commentaire::getAllCommentaireByVideo($id);
                $nb_com = sizeof(Commentaire::getAllCommentaireByVideo($id));
                $this->set('commentaires', $commentaires);
                $this->set('nb_com', $nb_com);
                $this->set('current_user', $_SESSION['auth']['id']);
                $this->render('watch');
            }
            else{ 
                $this->getPay($video->get_id()); 
            }
        }
        else{
            $_SESSION['error_access'] = 'Vous devez être connecté pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    /**
     * Method: GET
     * URL : /video/pay/
     * Permet d'accéder à la page de paiement d'une vidéo
    **/
    public function getPay($id){
        if (isset($_SESSION['auth']['id'])){
            $video = Video::getVideoById($id);
            $this->set('video', $video);
            $this->set('id_utilisateur', $_SESSION['auth']['id']);
            $this->render('pay');
        }
        else{
            $_SESSION['error_access'] = 'Vous devez être connecté pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

}