<?php 

namespace Controller;

use Model\Abonnement;
use Model\Utilisateur;
use Model\Commentaire;
use Model\Video;

use Config\Factory;

class AjaxController extends Controller{

    static function postComment(){
        $commentaire = Commentaire::addComment($_SESSION['auth']['id'], $_POST['id'], $_POST['content']);
        $commentaires = Commentaire::getAllCommentaireByVideo($_POST['id']);
        $nb_com = sizeof(Commentaire::getAllCommentaireByVideo($_POST['id']));
        //var_dump($commentaires);
        echo self::loadTwig()->render('commentaires.twig', ['commentaires' => $commentaires, 'nb_com' => $nb_com]);
    }
    
}


