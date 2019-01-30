<?php 

namespace Controller;

use Model\Abonnement;
use Model\Utilisateur;
use Model\Achat;
use Model\Paiements;
use Model\Commentaire;

use Library\Form;

use Config\Factory;

class UtilisateurController extends Controller{

    protected $current_controller = 'UtilisateurController';

    /**
     * Method: GET
     * URL : /utilisateur/profil/
     * Permet d'accéder au compte de l'utilisateur
    **/
    public function getProfil(){
        if (isset($_SESSION['auth']['id'])){
            if (isset($_SESSION['success_modification'])){
                $this->set('success_message', $_SESSION['success_modification']);
                unset($_SESSION['success_modification']);
            }
            if (isset($_SESSION['error_modification'])){
                $this->set('error_message', $_SESSION['error_modification']);
                unset($_SESSION['error_modification']);
            }
            $profil = Utilisateur::getUserById($_SESSION['auth']['id']);
            $paiements = Paiements::getAllByUser($_SESSION['auth']['id']);
            $nb_paiements = sizeof(Paiements::getAllByUser($_SESSION['auth']['id']));
            $commentaires = Commentaire::getCommentsByUser($_SESSION['auth']['id']);
            $this->set('profil', $profil);
            $this->set('paiements', $paiements);
            $this->set('nb_paiements', $nb_paiements);
            $this->set('commentaires', $commentaires);
            $this->render('profil');
        }
        else{
            $_SESSION['error_access'] = 'Vous devez être connecté pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    /**
     * Method: GET
     * URL : /utilisateur/achats/
     * Permet d'accéder aux achats de l'utilisateur
    **/
    public function getAchats(){
        if (isset($_SESSION['auth']['id'])){
            $achats = Achat::getAllByUser($_SESSION['auth']['id']);
            $nb_achats = sizeof(Achat::getAllByUser($_SESSION['auth']['id']));
            $this->set('achats', $achats);
            $this->set('nb_achats', $nb_achats);
            $this->render('achats');
        }
        else{
            $_SESSION['error_access'] = 'Vous devez être connecté pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    /**
     * Method: POST
     * URL : /utilisateur/updateMail/
     * Permet de modifier l'adresse mail d'un utilisateur
    **/
    static function postUpdateMail(){
        $form = new Form();
        if ($form->check_post_raw_values_not_empty(['mail'])){
            $mail = $_POST['mail'];
            $mail_count = Utilisateur::getMailExist($mail);
            if (!$mail_count){
                if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
                    $user = Utilisateur::updateMail($mail, $_SESSION['auth']['id']);
                    $_SESSION['success_modification'] = 'Votre adresse mail a été changée avec succès, vous pourrez désormais vous connecter avec le mail '.$mail;
                    header('location:'.BASEURL.'utilisateur/profil');
                    exit;
                }
                else{
                    $_SESSION['error_modification'] = 'L\'adresse mail rentrée ne respecte pas le bon format';
                    header('location:'.BASEURL.'utilisateur/profil');
                    exit;
                }
            }
            else{
                $_SESSION['error_modification'] = 'Cette adresse mail est déjà utilisée par un autre utilisateur';
                header('location:'.BASEURL.'utilisateur/profil');
                exit;
            }
        }
        else{
            $_SESSION['error_modification'] = 'Le champ ne peut pas rester vide';
            header('location:'.BASEURL.'utilisateur/profil');
            exit;
        }
    }

    /**
     * Method: GET
     * URL : /utilisateur/delete_compte/
     * Permet de supprimer le compte d'un utilisateur
    **/
    static function getDelete_compte(){
        $u = Utilisateur::getUserById($_SESSION['auth']['id']);
        $dossier = self::rrmdir('profils/'.$u->get_pseudo());
        $user = Utilisateur::deleteUser($_SESSION['auth']['id']);
        session_destroy();
        setcookie('auth', '', time() - 3600, '/', '', false, true);
        setcookie('supprime_compte', 'Votre compte a bien été supprimé!', time() + 3600, '/', '', false, true);
        header('Location:'.BASEURL.'home/login');
        exit;
    }

    /**
     * Method: GET
     * URL : /utilisateur/sign_out/
     * Permet de déconnecter un utilisateur
    **/
    static function getSign_Out(){
        //session_start();
        session_destroy();
        setcookie('auth', '', time() - 3600, '/', '', false, true);
        header('Location:'.BASEURL.'home/login');
        exit;
    }
    
}


