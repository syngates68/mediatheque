<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\TypeAbonnement;
use Model\Utilisateur;
use Model\Commentaire;
use Model\Paiements;
use Model\Achat;
use Model\Carte;
use Model\Notes;
use Model\Abonnement;

use Library\Form;

class VideoController extends Controller{

    public $controller_name = 'video';

    /**
     * Method: GET
     * URL : /video/watch/
     * Permet d'accéder à une vidéo donnée
    **/
    public function getWatch($id){
        if (isset($_SESSION['auth']['id'])){
            if (is_numeric($id)){
                if (Video::getNbrVideoById($id) != 0){
                    $video = Video::getVideoById($id);
                    $this->set('video', $video);
        
                    $this->set('video_id', $video->get_id());
                    $this->set('video_title', $video->get_titre());
                    $this->set('video_link', $video->get_miniature());
                    $this->set('video_prix', $video->get_prix());
        
                    $user_achat = Achat::getByVideo($video->get_id(), $_SESSION['auth']['id']);
                    $abonnement = Abonnement::getByUser($_SESSION['auth']['id']);
                    if ($video->get_prix() == NULL || !empty($user_achat) || !empty($abonnement)){
                        if (isset($_SESSION['success_add'])){
                            $this->set('success_add', $_SESSION['success_add']);
                            unset($_SESSION['success_add']);
                        }
                        $commentaires = Commentaire::getAllCommentaireByVideo($id);
                        $com = Commentaire::getByUserAndVideo($_SESSION['auth']['id'], $id);
                        $nb_com = sizeof(Commentaire::getAllCommentaireByVideo($id));
                        $note = Notes::getNoteByUser($video->get_id(), $_SESSION['auth']['id']);
                        $moyenne = Notes::getMoyenneByVideo($video->get_id());
                        if ($note){
                            $this->set('note', $note);
                        }
                        if (!empty($com)){
                            $this->set('com', $com);
                        }
                        $this->set('commentaires', $commentaires);
                        $this->set('nb_com', $nb_com);
                        $this->set('current_user', $_SESSION['auth']['id']);
                        $this->set('moyenne', $moyenne);
                        $this->render('watch');
                    }
                    else{ 
                        $this->getPay($video->get_id()); 
                    }
                }
                else{
                    header('Location:'.BASEURL.'home/404');
                    exit;
                }
            }
            else{
                header('Location:'.BASEURL.'home/404');
                exit;
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
            $video = Video::getVideoById($id);
            $carte_exist = sizeof(Carte::getByUser($_SESSION['auth']['id']));
            $this->set('video', $video);
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

    /**
     * Method: POST
     * URL : /video/addCarte/
     * Permet d'ajouter une CB
    **/
    public function postAddCarte(){
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
                            $carte = new Carte([
                                'numero_carte' => md5(sha1($numero)),
                                'date_expiration' => md5(sha1($date_expir)),
                                'cryptogramme' => md5(sha1($crypto)),
                                'id_user' => $_SESSION['auth']['id']
                            ]);
                            
                            $carte->carte_create();

                            $_SESSION['success_add'] = 'Votre carte a bien été enregistrée';

                            $_SESSION['value_numero'] = $numero;
                            $_SESSION['value_date_expir'] = $date_expir;
                            $_SESSION['value_crypto'] = $crypto;
                        }
                        else{
                            $_SESSION['error_add'] = 'Le mois de la date d\'expiration n\'est pas valide';

                            $_SESSION['value_numero'] = $numero;
                            $_SESSION['value_date_expir'] = $date_expir;
                            $_SESSION['value_crypto'] = $crypto;
                        }

                    } 
                    else {
                        $_SESSION['error_add'] = 'La date d\'expiration n\'est pas au format valide';

                        $_SESSION['value_numero'] = $numero;
                        $_SESSION['value_date_expir'] = $date_expir;
                        $_SESSION['value_crypto'] = $crypto;
                    }
                }
                else{
                    $_SESSION['error_add'] = 'Le cryptogramme n\'est pas au format valide';

                    $_SESSION['value_numero'] = $numero;
                    $_SESSION['value_date_expir'] = $date_expir;
                    $_SESSION['value_crypto'] = $crypto;
                }
            } 
            else{
                $_SESSION['error_add'] = 'Le numéro de carte n\'est pas au format valide';

                $_SESSION['value_numero'] = $numero;
                $_SESSION['value_date_expir'] = $date_expir;
                $_SESSION['value_crypto'] = $crypto;
            }
        }   
        else{
            $_SESSION['error_add'] = 'Tous les champs doivent être remplis';

            $_SESSION['value_numero'] = $_POST['numero'];
            $_SESSION['value_date_expir'] = $_POST['date_expir'];
            $_SESSION['value_crypto'] = $_POST['crypto'];
        }
    }

    /**
     * Method: POST
     * URL : /video/pay_video_cb/
     * Permet de payer une vidéo par CB
    **/
    public function postPay_video_cb(){
        $achat = new Achat([
            'id_utilisateur' => $_SESSION['auth']['id'],
            'id_video' => $_POST['id_video']
        ]);
        $achat->achat_create();

        $user = Utilisateur::getUserById($_SESSION['auth']['id']);

        $paiement = new Paiements([
            'payment_id' => 'CB0000'.$_SESSION['auth']['id'].$_POST['id_video'],
            'payment_status' => 'approved',
            'payment_amount' => $_POST['prix'],
            'payment_currency' => 'EUR',
            'payer_email' => $user->get_mail(),
            'payer_id' => $_SESSION['auth']['id']
        ]);
        $paiement->paiement_create();

    }

    /**
     * Method: POST
     * URL : /video/pay/
     * Permet de payer une vidéo par CB
    **/
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
                            $achat = new Achat([
                                'id_utilisateur' => $_SESSION['auth']['id'],
                                'id_video' => $_POST['id_video']
                            ]);
                            $achat->achat_create();
                    
                            $user = Utilisateur::getUserById($_SESSION['auth']['id']);
                    
                    
                            $paiement = new Paiements([
                                'payment_id' => 'CB0000'.$_SESSION['auth']['id'].$_POST['id_video'],
                                'payment_status' => 'approved',
                                'payment_amount' => $_POST['prix'],
                                'payment_currency' => 'EUR',
                                'payer_email' => $user->get_mail(),
                                'payer_id' => $_SESSION['auth']['id']
                            ]);
                            $paiement->paiement_create();

                            $_SESSION['success_add'] = 'Votre paiement a bien été pris en compte!';

                            header('Location:'.BASEURL.'video/watch/'.$_POST['id_video']);
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

}