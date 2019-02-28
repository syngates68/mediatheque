<?php 

namespace Controller;

use Model\Abonnement;
use Model\Utilisateur;
use Model\Commentaire;
use Model\Video;
use Model\Notes;

class AjaxController extends Controller{

    public $controller_name = 'ajax';

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
        if (isset($_SESSION['success_add'])){
            $this->set('success_message', $_SESSION['success_add']);
            unset($_SESSION['success_add']);
        }
        if ($_POST['note'] != 'NaN'){
            $n = new Notes([
                'id_video' => $_POST['id'],
                'id_utilisateur' => $_SESSION['auth']['id'],
                'note' => $_POST['note']
            ]);
            $n->note_create();
            $this->set('note');
        }

        $commentaire = new Commentaire([
            'id_utilisateur' => $_SESSION['auth']['id'],
            'id_video' => $_POST['id'],
            'commentaire' => $_POST['content']
        ]);

        $commentaire->commentaire_create();

        $commentaires = Commentaire::getAllCommentaireByVideo($_POST['id']);
        $com = Commentaire::getByUserAndVideo($_SESSION['auth']['id'], $_POST['id']);
        $nb_com = sizeof(Commentaire::getAllCommentaireByVideo($_POST['id']));
        $note = Notes::getNoteByUser($_POST['id'], $_SESSION['auth']['id']);
        $moyenne = Notes::getMoyenneByVideo($_POST['id']);
        $this->set('commentaire', $commentaire);
        $this->set('commentaires', $commentaires);
        $this->set('current_user', $_SESSION['auth']['id']);
        $this->set('nb_com', $nb_com);
        if ($note){
            $this->set('note', $note);
        }
        if ($com){
            $this->set('com', $com);
        }
        $this->set('moyenne', $moyenne);
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
        $n = Notes::deleteNote($_POST['id_user'], $_POST['id_video']);
        $commentaires = Commentaire::getAllCommentaireByVideo($_POST['id_video']);
        $com = Commentaire::getByUserAndVideo($_SESSION['auth']['id'], $_POST['id_video']);
        $nb_com = sizeof(Commentaire::getAllCommentaireByVideo($_POST['id_video']));
        $note = Notes::getNoteByUser($_POST['id_video'], $_SESSION['auth']['id']);
        $moyenne = Notes::getMoyenneByVideo($_POST['id_video']);
        //$this->set('commentaire', $commentaire);
        $this->set('commentaires', $commentaires);
        $this->set('nb_com', $nb_com);
        if ($note){
            $this->set('note', $note);
        }
        if (!empty($com)){
            $this->set('com', $com);
        }
        $this->set('moyenne', $moyenne);
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
            elseif ($type == 4){
                $f_type = ' a1.nombre is not null';
            }
        }

        if ($tri != '' && $tri != 0){
            if ($tri == 1){
                $order = ' GROUP BY v.id ORDER BY v.prix ASC';
            }
            elseif ($tri == 2){
                $order = ' GROUP BY v.id ORDER BY v.prix DESC';
            }
            elseif ($tri == 3){
                $order = ' GROUP BY v.id ORDER BY moyenne DESC, nbr_notes DESC';
            }
        }

        if ($search != '' && preg_match("/[a-zA-Z0-9]{1,20}/", $search)){
            if (($type != '' || $type != 1) && !empty($themes)){
                $f_search = ' AND CONCAT(v.titre, v.description) like "%'.$search.'%"';
            }
            else{
                $f_search = ' CONCAT(v.titre, v.description) like "%'.$search.'%"';
            }
        }

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

        $videos = Video::getVideosFiltre($f_type, $order, $f_themes, $f_search, $_SESSION['auth']['id']);
        $nb_videos = sizeof(Video::getVideosFiltre($f_type, $order, $f_themes, $f_search, $_SESSION['auth']['id']));
        $this->set('videos', $videos);
        $this->set('nb_videos', $nb_videos);
        $this->set('recherche', $search);
        $this->render('list_videos');
    }

    /**
     * Method: POST
     * URL : /ajax/fin_abo/
     * Permet de désactiver un abonnement
    **/
    public function postFin_abo(){
        $abo = Abonnement::stopAbo($_SESSION['auth']['id'], $_POST['id']);
    }
    
}


