<?php 

namespace Controller;

use Model\Abonnement;
use Model\Utilisateur;
use Model\Commentaire;
use Model\Video;

use Config\Factory;

class AjaxController extends Controller{

    protected $current_controller = 'AjaxController';

    public function postComment(){
        $commentaire = Commentaire::addComment($_SESSION['auth']['id'], $_POST['id'], $_POST['content']);
        $commentaires = Commentaire::getAllCommentaireByVideo($_POST['id']);
        $nb_com = sizeof(Commentaire::getAllCommentaireByVideo($_POST['id']));
        $this->set('commentaire', $commentaire);
        $this->set('commentaires', $commentaires);
        $this->set('nb_com', $nb_com);
        $this->render('commentaires');
    }

    public function postList_videos(){
        $f_type = ''; $f_themes = ''; $order = '';

        //echo $_POST['type'];

        $type = $_POST['type'];
        $themes = $_POST['themes'];
        $tri = $_POST['tri'];

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
                $order = ' ORDER BY v.prix ASC';
            }
            elseif ($tri == 2){
                $order = ' ORDER BY v.prix DESC';
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

        $videos = Video::getVideosFiltre($f_type, $order, $f_themes, $_SESSION['auth']['id']);
        $this->set('videos', $videos);
        $this->render('list_videos');
    }
    
}


