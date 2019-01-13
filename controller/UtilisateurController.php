<?php 

namespace Controller;

use Model\Abonnement;
use Model\Utilisateur;
use Model\Achat;
use Model\Paiements;

use Config\Factory;

class UtilisateurController extends Controller{

    public function getProfil(){
        if (isset($_SESSION['auth']['id'])){
            $profil = Utilisateur::getUserById($_SESSION['auth']['id']);
            $paiements = Paiements::getAllByUser($_SESSION['auth']['id']);
            $nb_paiements = sizeof(Paiements::getAllByUser($_SESSION['auth']['id']));
            $this->set('profil', $profil);
            $this->set('paiements', $paiements);
            $this->set('nb_paiements', $nb_paiements);
            $this->render('profil');
        }
        else{
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    public function getAchats(){
        if (isset($_SESSION['auth']['id'])){
            $achats = Achat::getAllByUser($_SESSION['auth']['id']);
            $nb_achats = sizeof(Achat::getAllByUser($_SESSION['auth']['id']));
            $this->set('achats', $achats);
            $this->set('nb_achats', $nb_achats);
            $this->render('achats');
        }
        else{
            header('Location:'.BASEURL.'home/login');
            exit;
        }
    }

    static function getSign_Out(){
        //session_start();
        session_destroy();
        setcookie('auth', '', time() - 3600, '/', '', false, true);
        header('Location:'.BASEURL.'home/login');
        exit;
    }
    
}


