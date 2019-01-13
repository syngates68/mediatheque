<?php 

namespace Controller;

use Model\Abonnement;
use Model\Utilisateur;
use Model\Commentaire;
use Model\Video;

use Config\Factory;

class AjaxController extends Controller{

    public function postComment(){
        $commentaire = Commentaire::addComment($_SESSION['auth']['id'], $_POST['id'], $_POST['content']);
        $commentaires = Commentaire::getAllCommentaireByVideo($_POST['id']);
        $nb_com = sizeof(Commentaire::getAllCommentaireByVideo($_POST['id']));
        $this->set('commentaire', $commentaire);
        $this->set('commentaires', $commentaires);
        $this->set('nb_com', $nb_com);
        $this->render('commentaires');
    }
    
}


