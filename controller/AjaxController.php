<?php 

namespace Controller;

use Model\Abonnement;
use Model\Utilisateur;
use Model\Commentaire;
use Model\Video;

use Config\Factory;

class AjaxController extends Controller{

    protected $current_controller = 'AjaxController';

    /**
     * Method: POST
     * URL : /ajax/commentaires/
     * Permet de poster un commentaire
    **/
    public function postComment(){
        if (isset($_SESSION['success_comment'])){
            $this->set('success_message', $_SESSION['success_comment']);
            unset($_SESSION['success_comment']);
        }
        $commentaire = Commentaire::addComment($_SESSION['auth']['id'], $_POST['id'], $_POST['content']);
        $commentaires = Commentaire::getAllCommentaireByVideo($_POST['id']);
        $nb_com = sizeof(Commentaire::getAllCommentaireByVideo($_POST['id']));
        $this->set('commentaire', $commentaire);
        $this->set('commentaires', $commentaires);
        $this->set('current_user', $_SESSION['auth']['id']);
        $this->set('nb_com', $nb_com);
        $_SESSION['success_comment'] = 'Votre avis a bien été ajouté! Merci de votre apport à la plateforme!';
        $this->render('commentaires');
    }

    /**
     * Method: POST
     * URL : /ajax/delete_comment/
     * Permet de supprimer un commentaire
    **/
    public function postDelete_comment(){
        $commentaire = Commentaire::deleteCommentaire($_POST['id_com']);
        $commentaires = Commentaire::getAllCommentaireByVideo($_POST['id_video']);
        $nb_com = sizeof(Commentaire::getAllCommentaireByVideo($_POST['id_video']));
        //$this->set('commentaire', $commentaire);
        $this->set('commentaires', $commentaires);
        $this->set('nb_com', $nb_com);
        $this->set('current_user', $_SESSION['auth']['id']);
        $this->render('commentaires');
    }

    /**
     * Method: POST
     * URL : /ajax/list_videos/
     * Permet de récupérer les vidéos selon les filtres
    **/
    public function postList_videos(){
        $f_type = ''; $f_themes = ''; $order = ''; $f_search = '';

        //echo $_POST['type'];

        $type = $_POST['type'];
        $themes = (isset($_POST['themes'])) ? $_POST['themes'] : NULL;
        $tri = $_POST['tri'];
        $search = (isset($_POST['search'])) ? $_POST['search'] : NULL;

        if ($type != '' && $type != 1){
            if ($type == 2){
                $f_type = ' v.gratuite = 1';
            }
            elseif ($type == 3){
                $f_type = ' v.gratuite = 0';
            }
        }

        if ($tri != ''){
            if ($tri == 1){
                $order = ' GROUP BY v.id ORDER BY v.prix ASC';
            }
            elseif ($tri == 2){
                $order = ' GROUP BY v.id ORDER BY v.prix DESC';
            }
        }

        if ($search != ''){
            if (($type != '' || $type != 1) && !empty($themes)){
                $f_search = ' AND v.titre like "%'.$search.'%"';
            }
            else{
                $f_search = ' v.titre like "%'.$search.'%"';
            }
        }

        //var_dump($themes);
        //echo sizeof($themes);

        //echo $type;

        if (!empty($themes)){
            if ($type != '' && $type != 1){
                if (sizeof($themes) == 1){
                    $f_themes = ' AND v.id_theme = '.implode(", ", $themes);
                }
                else{
                    $f_themes = ' AND v.id_theme IN ('.implode(", ", $themes).')';
                }
            }
            else{
                if (sizeof($themes) == 1){
                    $f_themes = ' v.id_theme = '.implode(", ", $themes);
                }
                else{
                    $f_themes = ' v.id_theme IN ('.implode(", ", $themes).')';
                }
            }
        }

        //echo $f_themes;

        $videos = Video::getVideosFiltre($f_type, $order, $f_themes, $f_search, $_SESSION['auth']['id']);
        $this->set('videos', $videos);
        $this->render('list_videos');
    }
    
}


