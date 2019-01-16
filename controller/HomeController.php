<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\TypeAbonnement;
use Model\Utilisateur;
use Model\Achat;

use Library\Form;

use Config\Factory;

class HomeController extends Controller{

    protected $current_controller = 'HomeController';

    public function getBoard(){
        if (isset($_SESSION['auth']['id'])){
            if (isset($_SESSION['success_connect'])){
                $this->set('success_connect', $_SESSION['success_connect']);
                unset($_SESSION['success_connect']);
            }
            $videos = Video::getAllVideos($_SESSION['auth']['id']); 
            $last_video = Video::getLastVideo();
            $abos = TypeAbonnement::getAllTypeAbonnements();
            $themes = Theme::getAllThemes();
            $this->set('videos', $videos);
            $this->set('last_video', $last_video);
            $this->set('abos', $abos);
            $this->set('themes', $themes);
            $this->render('board');
        }
        else{
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    public function getAbonnement(){
        if (isset($_SESSION['auth']['id'])){
            $abos = TypeAbonnement::getAllTypeAbonnements();
            $this->set('abos', $abos);
            $this->render('abonnement');
        }
        else{
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    public function getLogin(){
        if (isset($_SESSION['error_connect'])){
            $this->set('error_message', $_SESSION['error_connect']);
            unset($_SESSION['error_connect']);
        }
        if (isset($_SESSION['value_mail'])){
            $this->set('value_mail', $_SESSION['value_mail']);
            unset($_SESSION['value_mail']);
        }
        if (isset($_SESSION['value_pass'])){
            $this->set('value_pass', $_SESSION['value_pass']);
            unset($_SESSION['value_pass']);
        }
        $this->render('login');
    }

    public function getSignUp(){
        if (isset($_SESSION['error_inscription'])){
            $this->set('error_message', $_SESSION['error_inscription']);
            unset($_SESSION['error_inscription']);
        }
        if (isset($_SESSION['success_inscription'])){
            $this->set('success_message', $_SESSION['success_inscription']);
            unset($_SESSION['success_inscription']);
        }
        if (isset($_SESSION['value_nom_insc'])){
            $this->set('value_nom_insc', $_SESSION['value_nom_insc']);
            unset($_SESSION['value_nom_insc']);
        }
        if (isset($_SESSION['value_prenom_insc'])){
            $this->set('value_prenom_insc', $_SESSION['value_prenom_insc']);
            unset($_SESSION['value_prenom_insc']);
        }
        if (isset($_SESSION['value_pseudo_insc'])){
            $this->set('value_pseudo_insc', $_SESSION['value_pseudo_insc']);
            unset($_SESSION['value_pseudo_insc']);
        }
        if (isset($_SESSION['value_mail_insc'])){
            $this->set('value_mail_insc', $_SESSION['value_mail_insc']);
            unset($_SESSION['value_mail_insc']);
        }
        if (isset($_SESSION['value_pass_insc'])){
            $this->set('value_pass_insc', $_SESSION['value_pass_insc']);
            unset($_SESSION['value_pass_insc']);
        }
        if (isset($_SESSION['value_pass2_insc'])){
            $this->set('value_pass2_insc', $_SESSION['value_pass2_insc']);
            unset($_SESSION['value_pass2_insc']);
        }
        $this->render('signUp');
    }

    static function postLogin(){
        if (isset($_COOKIE['auth'])){
            $auth = $_COOKIE['auth'];
            $auth = explode('----', $auth);
            $user = Utilisateur::getUserById($auth[0]);
            foreach ($user as $u){
                $key = sha1($u->get_pseudo() . $u->get_pass());
                if ($key = $auth[1]){
                    $_SESSION['auth']['id'] = $u->get_id();
                    setcookie('auth', $u->get_id() . '----' . sha1($u->get_pseudo() . $u->get_pass()), time() + 3600 * 24 * 3, '/', '', false, true);
                    header('location:'.BASEURL.'home/board');
                    exit;
                }
                else{
                    setcookie('auth', '', time() - 3600, '/', '', false, true);
                }
            }
        }
        else{
            $form = new Form();
            if ($form->check_post_raw_values_not_empty(['mail', 'pass'])){

                $email = $_POST['mail'];
                $password = $_POST['pass'];

                $user = Utilisateur::getUserByMail($email, md5(md5($password)));
                if (!empty($user)){
                    foreach ($user as $u){
                        if (isset($_POST['cookie_init'])){
                            setcookie('auth', $u->get_id() . '----' . sha1($u->get_pseudo() . $u->get_pass()), time() + 3600 * 24 * 3, '/', '', false, true);
                        }
                        $_SESSION['auth']['id'] = $u->get_id();

                        $_SESSION['success_connect'] = 'Content de vous revoir '.$u->get_pseudo();

                        header('location:'.BASEURL.'home/board');
                        exit;
                    }
                }
                else{
                    $user = Utilisateur::getUserByPseudo($email, md5(md5($password)));

                    if (!empty($user)){
                        if (isset($_POST['cookie_init'])){
                            setcookie('auth', $user->get_id() . '----' . sha1($user->get_pseudo() . $user->get_pass()), time() + 3600 * 24 * 3, '/', '', false, true);
                        }
                        $_SESSION['auth']['id'] = $user->get_id();

                        $_SESSION['success_connect'] = 'Content de vous revoir '.$user->get_pseudo();

                        header('location:'.BASEURL.'home/board');
                        exit;
                    }
                    else{
                        $_SESSION['error_connect'] = 'Aucun compte ne semble correspondre aux informations rentrées';
                    
                        $_SESSION['value_mail'] = $email;
                        $_SESSION['value_pass'] = $password;
    
                        header('location:'.BASEURL.'home/login');
                        exit;
                    }
                }
            }
            else{
                $_SESSION['error_connect'] = 'Tous les champs doivent êtres remplis';

                $_SESSION['value_mail'] = $_POST['mail'];
                $_SESSION['value_pass'] = $_POST['pass'];
    
                header('location:'.BASEURL.'home/login');
                exit;
            }
        }
    }

    static function postInscription(){
        $form = new Form();
        if ($form->check_post_raw_values_not_empty(['nom', 'prenom', 'pseudo', 'mail', 'pass', 'pass2'])){

            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $pseudo = $_POST['pseudo'];
            $mail = $_POST['mail'];
            $pass = $_POST['pass'];
            $pass2 = $_POST['pass2'];

            if ($pass == $pass2){
                $pseudo_count = Utilisateur::getUserExist($pseudo);
                if (!$pseudo_count){
                    $mail_count = Utilisateur::getMailExist($mail);
                    if (!$mail_count){
                        if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
                            $user = Utilisateur::addUser($nom, $prenom, $pseudo, $mail, md5(md5($pass)));
                            $_SESSION['success_inscription'] = 'Vous êtes désormais inscrit sous le nom d\'utilisateur '.$pseudo;
                            mkdir("profils/".$pseudo, 0700); //Création d'un dossier au nom de l'utilisateur
                            header('location:'.BASEURL.'home/signUp');
                            exit;
                        }
                        else{
                            $_SESSION['error_inscription'] = 'L\'adresse mail rentrée n\'a pas un format correct';
        
                            $_SESSION['value_nom_insc'] = $nom;
                            $_SESSION['value_prenom_insc'] = $prenom;
                            $_SESSION['value_pseudo_insc'] = $pseudo;
                            $_SESSION['value_mail_insc'] = $mail;
                            $_SESSION['value_pass_insc'] = $pass;
                            $_SESSION['value_pass2_insc'] = $pass2;
    
                            header('location:'.BASEURL.'home/signUp');
                            exit;
                        }
                    }
                    else{
                        $_SESSION['error_inscription'] = 'Cette adresse mail est déjà associée à un autre compte';
        
                        $_SESSION['value_nom_insc'] = $nom;
                        $_SESSION['value_prenom_insc'] = $prenom;
                        $_SESSION['value_pseudo_insc'] = $pseudo;
                        $_SESSION['value_mail_insc'] = $mail;
                        $_SESSION['value_pass_insc'] = $pass;
                        $_SESSION['value_pass2_insc'] = $pass2;

                        header('location:'.BASEURL.'home/signUp');
                        exit;
                    }
                }
                else{
                    $_SESSION['error_inscription'] = 'Ce nom d\'utilisateur n\'est pas disponible';
        
                    $_SESSION['value_nom_insc'] = $nom;
                    $_SESSION['value_prenom_insc'] = $prenom;
                    $_SESSION['value_pseudo_insc'] = $pseudo;
                    $_SESSION['value_mail_insc'] = $mail;
                    $_SESSION['value_pass_insc'] = $pass;
                    $_SESSION['value_pass2_insc'] = $pass2;

                    header('location:'.BASEURL.'home/signUp');
                    exit;
                }
            }
            else{
                $_SESSION['error_inscription'] = 'Les mots de passe doivent être identiques';
        
                $_SESSION['value_nom_insc'] = $nom;
                $_SESSION['value_prenom_insc'] = $prenom;
                $_SESSION['value_pseudo_insc'] = $pseudo;
                $_SESSION['value_mail_insc'] = $mail;
                $_SESSION['value_pass_insc'] = $pass;
                $_SESSION['value_pass2_insc'] = $pass2;

                header('location:'.BASEURL.'home/signUp');
                exit;
            }
        }
        else{
            $_SESSION['error_inscription'] = 'Tous les champs doivent être remplis';

            $_SESSION['value_nom_insc'] = $_POST['nom'];
            $_SESSION['value_prenom_insc'] = $_POST['prenom'];
            $_SESSION['value_pseudo_insc'] = $_POST['pseudo'];
            $_SESSION['value_mail_insc'] = $_POST['mail'];
            $_SESSION['value_pass_insc'] = $_POST['pass'];
            $_SESSION['value_pass2_insc'] = $_POST['pass2'];

            header('location:'.BASEURL.'home/signUp');
            exit;
        }
        
    }
    
}