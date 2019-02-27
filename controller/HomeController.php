<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\TypeAbonnement;
use Model\Utilisateur;
use Model\Achat;
use Model\Carte;
use Model\Abonnement;
use Model\Paiements;

use Library\Form;

use Config\Factory;
use Controller\MailController;

class HomeController extends Controller{

    public $controller_name = 'home';

    /**
     * Method: GET
     * URL : /home/board/
     * Permet d'afficher le tableau de bord
    **/
    public function getBoard(){
        if (isset($_SESSION['auth']['id'])){
            if (isset($_SESSION['success_connect'])){
                $this->set('success_message', $_SESSION['success_connect']);
                unset($_SESSION['success_connect']);
            }
            if (isset($_SESSION['success_add'])){
                $this->set('success_message', $_SESSION['success_add']);
                unset($_SESSION['success_add']);
            }
            $videos = Video::getAllVideos($_SESSION['auth']['id']); 
            $nb_videos = sizeof(Video::getAllVideos($_SESSION['auth']['id']));
            $last_video = Video::getLastVideo();
            $abos = TypeAbonnement::getAllTypeAbonnements($_SESSION['auth']['id']);
            $themes = Theme::getAllThemes();
            $this->set('videos', $videos);
            $this->set('nb_videos', $nb_videos);
            $this->set('last_video', $last_video);
            $this->set('abos', $abos);
            $this->set('themes', $themes);
            $this->render('board');
        }
        else{
            $_SESSION['error_access'] = 'Vous devez être connecté pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    /**
     * Method: GET
     * URL : /home/abonnement/
     * Permet d'accéder aux abonnements
    **/
    public function getAbonnement(){
        if (isset($_SESSION['auth']['id'])){
            $abos = TypeAbonnement::getAllTypeAbonnements($_SESSION['auth']['id']);
            $a = Abonnement::getByUser($_SESSION['auth']['id']);
            if (!empty($a)){
                $this->set('abo_exist', $a);
            }
            $this->set('abos', $abos);
            $this->render('abonnement');
        }
        else{
            $_SESSION['error_access'] = 'Vous devez être connecté pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    /**
     * Method: GET
     * URL : /home/valid_abo/
     * Permet d'accéder à la période d'essai de l'abonnement mensuel
    **/
    public function getValid_abo(){
        if (isset($_SESSION['auth']['id'])){
            $abonnement = new Abonnement([
                'id_type' => 3,
                'id_utilisateur' => $_SESSION['auth']['id']
            ]);
            $abonnement->abonnement_create();

            $_SESSION['success_add'] = 'Votre choix a bien été pris en compte, votre période d\'essai prendra fin dans 7 jours';

            header('location:'.BASEURL.'home/board');
            exit;
        }
        else{
            $_SESSION['error_access'] = 'Vous devez être connecté pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    public function postPay_abo_cb(){
        $abonnement = new Abonnement([
            'id_type' => $_POST['id_abo'],
            'id_utilisateur' => $_SESSION['auth']['id']
        ]);
        $abonnement->abonnement_create();
        
        $user = Utilisateur::getUserById($_SESSION['auth']['id']);
                                  
        $paiement = new Paiements([
            'payment_id' => 'CB0000'.$_SESSION['auth']['id'].$_POST['id_type'].date('Y_m_d'),
            'payment_status' => 'approved',
            'payment_amount' => $_POST['prix'],
            'payment_currency' => 'EUR',
            'payer_email' => $user->get_mail(),
            'payer_id' => $_SESSION['auth']['id']
        ]);
        $paiement->paiement_create();

        $_SESSION['success_add'] = 'Votre paiement a bien été pris en compte!';

    }


    /**
     * Method: GET
     * URL : /home/login/
     * Permet d'accéder à la page de connexion
    **/
    public function getLogin(){
        if (isset($_SESSION['error_connect'])){
            $this->set('error_message', $_SESSION['error_connect']);
            unset($_SESSION['error_connect']);
        }
        if (isset($_SESSION['error_access'])){
            $this->set('error_message', $_SESSION['error_access']);
            unset($_SESSION['error_access']);
        }
        if (isset($_SESSION['value_mail'])){
            $this->set('value_mail', $_SESSION['value_mail']);
            unset($_SESSION['value_mail']);
        }
        if (isset($_SESSION['value_pass'])){
            $this->set('value_pass', $_SESSION['value_pass']);
            unset($_SESSION['value_pass']);
        }
        if (isset($_COOKIE['supprime_compte'])){
            $this->set('success_message', $_COOKIE['supprime_compte']);
            setcookie('supprime_compte', '', time() - 3600, '/', '', false, true);
        }
        if (isset($_SESSION['success_reset'])){
            $this->set('success_message', $_SESSION['success_reset']);
            unset($_SESSION['success_reset']);
        }
        $this->render('login');
    }

    /**
     * Method: GET
     * URL : /home/signUp/
     * Permet d'accéder à la page d'inscription
    **/
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

    /**
     * Method: POST
     * URL : /home/login/
     * Permet de connecter un utilisateur
    **/
    static function postLogin(){
        if (isset($_COOKIE['auth'])){
            //setcookie('auth', '', time() - 3600, '/', '', false, true);
            //echo 'ok';
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

                $user = Utilisateur::getUserByMail($email, md5(sha1($password)));
                if (!empty($user)){
                    if (!empty(Utilisateur::getUserConfirm($user->get_id()))){
                        if (isset($_POST['cookie_init'])){
                            setcookie('auth', $user->get_id() . '----' . sha1($user->get_pseudo() . $user->get_pass()), time() + 3600 * 24 * 3, '/', '', false, true);
                        }
                        $_SESSION['auth']['id'] = $user->get_id();
    
                        $_SESSION['success_connect'] = 'Content de vous revoir '.$user->get_prenom();
    
                        header('location:'.BASEURL.'home/board');
                        exit;
                    }
                    else{
                        $_SESSION['error_connect'] = 'Votre inscription n\'a pas encore été confirmée';
                    
                        $_SESSION['value_mail'] = $email;
                        $_SESSION['value_pass'] = $password;
    
                        header('location:'.BASEURL.'home/login');
                        exit;
                    }
                }
                else{
                    $user = Utilisateur::getUserByPseudo($email, md5(sha1($password)));

                    if (!empty($user)){
                        if (!empty(Utilisateur::getUserConfirm($user->get_id()))){
                            if (isset($_POST['cookie_init'])){
                                setcookie('auth', $user->get_id() . '----' . sha1($user->get_pseudo() . $user->get_pass()), time() + 3600 * 24 * 3, '/', '', false, true);
                            }
                            $_SESSION['auth']['id'] = $user->get_id();
    
                            $_SESSION['success_connect'] = 'Content de vous revoir '.$user->get_prenom();
    
                            header('location:'.BASEURL.'home/board');
                            exit;
                        }
                        else{
                            $_SESSION['error_connect'] = 'Votre inscription n\'a pas encore été confirmée';
                    
                            $_SESSION['value_mail'] = $email;
                            $_SESSION['value_pass'] = $password;
        
                            header('location:'.BASEURL.'home/login');
                            exit;
                        }
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

    /**
     * Method: POST
     * URL : /home/inscription/
     * Permet d'inscrire un utilisateur
    **/
    static function postInscription(){
        $form = new Form();
        if ($form->check_post_raw_values_not_empty(['nom', 'prenom', 'pseudo', 'mail', 'pass', 'pass2'])){

            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $pseudo = $_POST['pseudo'];
            $mail = $_POST['mail'];
            $pass = $_POST['pass'];
            $pass2 = $_POST['pass2'];

            if (preg_match("/[a-zA-Z0-9]{1,20}/", $nom) && preg_match("/[a-zA-Z0-9]{1,20}/", $prenom) && preg_match("/[a-zA-Z0-9]{1,20}/", $pseudo)){

                if (strlen($pseudo) >= 5){

                    if ($pass == $pass2){
                        $pseudo_count = Utilisateur::getUserExist($pseudo);
                        if (!$pseudo_count){
                            $mail_count = Utilisateur::getMailExist($mail);
                            if (!$mail_count){
                                if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
                                    $code = '';
        
                                    for ($i = 0; $i < 4; $i++){
                                        $s = rand(0,9);
                                        $code .= $s;
                                    }
        
                                    $user = new Utilisateur([
                                        'nom' => $nom,
                                        'prenom' => $prenom,
                                        'pseudo' => $pseudo,
                                        'mail' => $mail,
                                        'pass' => md5(sha1($pass)),
                                        'confirm_key' => $code
                                    ]);
                                    $user->utilisateur_create();
        
                                    //$user = Utilisateur::addUser($nom, $prenom, $pseudo, $mail, md5(sha1($pass)), $code);
                                    $u = Utilisateur::getUserByPseudo($pseudo, md5(sha1($pass)));
                                    $_SESSION['pseudo'] = $pseudo;
                                    mkdir("profils/".$pseudo, 0700); //Création d'un dossier au nom de l'utilisateur
                                    MailController::confirm_inscription($u, $code);
                                    header('location:'.BASEURL.'home/confirm');
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
                    $_SESSION['error_inscription'] = 'Le nom d\'utilisateur doit posséder au moins 5 caractères';
                
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
                $_SESSION['error_inscription'] = 'Les caractères spéciaux ne sont pas autorisés';
            
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

    public function getConfirm(){
        if (isset($_SESSION['pseudo'])){
            if (isset($_SESSION['error_confirm'])){
                $this->set('error_message', $_SESSION['error_confirm']);
                unset($_SESSION['error_confirm']);
            }
            $this->render('confirm');
        }
        else{
            $_SESSION['error_access'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    public function postConfirm(){
        if (isset($_SESSION['pseudo'])){
            if (isset($_POST['confirm_key']) && !empty($_POST['confirm_key'])){
                if (is_numeric($_POST['confirm_key'])){
                    $u = Utilisateur::getUserExist($_SESSION['pseudo']);

                    if ($_POST['confirm_key'] == $u->get_confirm_key()){
                        $uc = Utilisateur::updateConfirm($u->get_id());
                        $_SESSION['auth']['id'] = $u->get_id();
                        unset($_SESSION['pseudo']);
                        header('Location:'.BASEURL.'home/board');
                        exit;
                    }
                    else{
                        $_SESSION['error_confirm'] = 'Le code rentré est incorrect';
                        header('Location:'.BASEURL.'home/confirm');
                        exit;
                    }
                }
                else{
                    $_SESSION['error_confirm'] = 'Le format du code est erroné';
                    header('Location:'.BASEURL.'home/confirm');
                    exit;
                }
            }
            else{
                $_SESSION['error_confirm'] = 'Le champ ne doit pas rester vide';
                header('Location:'.BASEURL.'home/confirm');
                exit;
            }

        }
        else{
            $_SESSION['error_access'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    public function getEnter_mail(){
        if (isset($_SESSION['error_mail'])){
            $this->set('error_message', $_SESSION['error_mail']);
            unset($_SESSION['error_mail']);
        }
        $this->render('enter_mail');
    }

    public function postEnter_mail(){
        if (isset($_POST['mail'])){
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
                $u = Utilisateur::getMailExist($_POST['mail']);
                if (!empty($u)){
                    $char = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
                    $code = '';
                    for($j = 0; $j < 8; $j++){
                        $code .= $char[rand(0, strlen($char)-1)];
                    }
                    $_SESSION['mail'] = $u->get_mail();
                    MailController::forgotten_password($u, $code);
                    $up = Utilisateur::updatePassword(md5(sha1(md5($code))), $u->get_id());
                    header('Location:'.BASEURL.'home/code_mail');
                    exit;
                }
                else{
                    $_SESSION['error_mail'] = 'Cette adresse mail ne correspond à aucun compte existant.';
                    header('Location:'.BASEURL.'home/enter_mail');
                    exit;
                }
            }
            else{
                $_SESSION['error_mail'] = 'Veuillez entrer une adresse mail valide';
                header('Location:'.BASEURL.'home/enter_mail');
                exit;
            }
        }
        else{
            $_SESSION['error_mail'] = 'Le champ ne doit pas rester vide';
            header('Location:'.BASEURL.'home/enter_mail');
            exit;
        }
    }

    public function getCode_mail(){
        if (isset($_SESSION['mail'])){
            if (isset($_SESSION['error_mail'])){
                $this->set('error_message', $_SESSION['error_mail']);
                unset($_SESSION['error_mail']);
            }
            $this->render('code_mail');
        }
        else{
            $_SESSION['error_access'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    public function postCode_mail(){
        if (isset($_POST['code_mdp'])){
            if (strlen($_POST['code_mdp']) == 8){
                $u = Utilisateur::getMailExist($_SESSION['mail']);
                if (md5(sha1(md5($_POST['code_mdp']))) == $u->get_pass()){
                    $_SESSION['temp_id'] = $u->get_id();
                    unset($_SESSION['mail']);
                    header('Location:'.BASEURL.'home/reset_password');
                    exit;
                }
                else{
                    $_SESSION['error_mail'] = 'Le code rentré est incorrect';
                    header('Location:'.BASEURL.'home/code_mail');
                    exit;
                }
            }
            else{
                $_SESSION['error_mail'] = 'Le code rentré ne contient pas 8 caractères';
                header('Location:'.BASEURL.'home/code_mail');
                exit;
            }
        }
        else{
            $_SESSION['error_mail'] = 'Le champ ne doit pas rester vide';
            header('Location:'.BASEURL.'home/code_mail');
            exit;
        }
    }

    public function getReset_password(){
        if (isset($_SESSION['temp_id'])){
            if (isset($_SESSION['error_mdp'])){
                $this->set('error_message', $_SESSION['error_mdp']);
                unset($_SESSION['error_mdp']);
            }
            $this->render('reset_password');
        }
        else{
            $_SESSION['error_access'] = 'Vous n\'avez pas les droits requis pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    public function postReset_password(){
        if (isset($_POST['pass']) && isset($_POST['pass2'])){
            if ($_POST['pass'] == $_POST['pass2']){
                $up = Utilisateur::updatePassword(md5(sha1($_POST['pass'])), $_SESSION['temp_id']);
                unset($_SESSION['temp_id']);
                $_SESSION['success_reset'] = 'Votre mot de passe a bien été réinitialisé';
                header('Location:'.BASEURL.'home/login');
                exit;
            }
            else{
                $_SESSION['error_mail'] = 'Le code rentré est incorrect';
                header('Location:'.BASEURL.'home/code_mail');
                exit;
                }
        }
        else{
            $_SESSION['error_mail'] = 'Les deux champs doivent être remplis';
            header('Location:'.BASEURL.'home/code_mail');
            exit;
        }
    }

    /**
     * Method: GET
     * URL : /home/pay/
     * Permet d'accéder à la page de paiement d'un abonnement
    **/
    public function getPay($id){
        if (isset($_SESSION['auth']['id'])){
            if (isset($_SESSION['error_add'])){
                $this->set('error_message', $_SESSION['error_add']);
                unset($_SESSION['error_add']);
            }
            if (isset($_SESSION['success_add'])){
                $this->set('success_message', $_SESSION['success_add']);
                unset($_SESSION['success_add']);
            }
            if (isset($_SESSION['value_numero'])){
                $this->set('value_numero', $_SESSION['value_numero']);
                unset($_SESSION['value_numero']);
            }
            if (isset($_SESSION['value_date_expir'])){
                $this->set('value_date_expir', $_SESSION['value_date_expir']);
                unset($_SESSION['value_date_expir']);
            }
            if (isset($_SESSION['value_crypto'])){
                $this->set('value_crypto', $_SESSION['value_crypto']);
                unset($_SESSION['value_crypto']);
            }
            $abo = TypeAbonnement::getById($id);
            $carte_exist = sizeof(Carte::getByUser($_SESSION['auth']['id']));
            $this->set('abo', $abo);
            $this->set('carte_exist', $carte_exist);
            $this->set('id_utilisateur', $_SESSION['auth']['id']);
            $this->render('pay');
        }
        else{
            $_SESSION['error_access'] = 'Vous devez être connecté pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }
    
    public function postPay(){

        $form = new Form();
        if ($form->check_post_raw_values_not_empty(['numero', 'date_expir', 'crypto'])){

            $numero = $_POST['numero'];
            $date_expir = $_POST['date_expir'];
            $crypto = $_POST['crypto'];

            if (ctype_digit($numero) && strlen($numero) == 16){
                if (ctype_digit($crypto) && strlen($crypto) == 3){
                    $regex = "^\\d{2}/\\d{2}^";
                    if (preg_match($regex, $date_expir)) {
                        $date_expir_tab = explode('/', $date_expir);
                        $mois_valid = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];

                        if (in_array($date_expir_tab[0], $mois_valid)){
                            $abonnement = new Abonnement([
                                'id_type' => $_POST['id_type'],
                                'id_utilisateur' => $_SESSION['auth']['id']
                            ]);
                            $abonnement->abonnement_create();
                    
                            $user = Utilisateur::getUserById($_SESSION['auth']['id']);
                                  
                            $paiement = new Paiements([
                                'payment_id' => 'CB0000'.$_SESSION['auth']['id'].$_POST['id_type'].date('Y_m_d'),
                                'payment_status' => 'approved',
                                'payment_amount' => $_POST['prix'],
                                'payment_currency' => 'EUR',
                                'payer_email' => $user->get_mail(),
                                'payer_id' => $_SESSION['auth']['id']
                            ]);
                            $paiement->paiement_create();

                            $_SESSION['success_add'] = 'Votre paiement a bien été pris en compte!';

                            header('Location:'.BASEURL.'home/board');
                            exit;
                        }
                        else{
                            $_SESSION['error_add'] = 'Le mois de la date d\'expiration n\'est pas valide';

                            $_SESSION['value_numero'] = $numero;
                            $_SESSION['value_date_expir'] = $date_expir;
                            $_SESSION['value_crypto'] = $crypto;

                            header('location:'.BASEURL.'video/pay/'.$_POST['id_video']);
                            exit;
                        }

                    } 
                    else {
                        $_SESSION['error_add'] = 'La date d\'expiration n\'est pas au format valide';

                        $_SESSION['value_numero'] = $numero;
                        $_SESSION['value_date_expir'] = $date_expir;
                        $_SESSION['value_crypto'] = $crypto;

                        header('location:'.BASEURL.'video/pay/'.$_POST['id_video']);
                        exit;
                    }
                }
                else{
                    $_SESSION['error_add'] = 'Le cryptogramme n\'est pas au format valide';

                    $_SESSION['value_numero'] = $numero;
                    $_SESSION['value_date_expir'] = $date_expir;
                    $_SESSION['value_crypto'] = $crypto;

                    header('location:'.BASEURL.'video/pay/'.$_POST['id_video']);
                    exit;
                }
            } 
            else{
                $_SESSION['error_add'] = 'Le numéro de carte n\'est pas au format valide';

                $_SESSION['value_numero'] = $numero;
                $_SESSION['value_date_expir'] = $date_expir;
                $_SESSION['value_crypto'] = $crypto;

                header('location:'.BASEURL.'video/pay/'.$_POST['id_video']);
                exit;
            }
        }   
        else{
            $_SESSION['error_add'] = 'Tous les champs doivent être remplis';

            $_SESSION['value_numero'] = $_POST['numero'];
            $_SESSION['value_date_expir'] = $_POST['date_expir'];
            $_SESSION['value_crypto'] = $_POST['crypto'];

            header('location:'.BASEURL.'video/pay/'.$_POST['id_video']);
            exit;
        }

    }

    /**
     * Method: GET
     * URL : /home/cgu/
     * Permet d'accéder aux CGU du site
    **/
    public function getCgu(){
        if (isset($_SESSION['auth']['id'])){
            $this->render('cgu');
        }
        else{
            $_SESSION['error_access'] = 'Vous devez être connecté pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    /**
     * Method: GET
     * URL : /home/cgv/
     * Permet d'accéder aux CGV du site
    **/
    public function getCgv(){
        if (isset($_SESSION['auth']['id'])){
            $this->render('cgv');
        }
        else{
            $_SESSION['error_access'] = 'Vous devez être connecté pour accéder à cette page';
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    public function get404(){
        $this->render('404');
    }
    
}