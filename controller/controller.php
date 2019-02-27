<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\Abonnement;
use Model\Utilisateur;

use Config\Router\Response;

use Library\FormatDate;
use Library\ShortText;

require (ROOT.DS.'vendor/autoload.php');

class Controller{

    public static $current_controller;
    public $controller_name;

    private $content = array();
    private $rendered = false;
    private static $twig = NULL;

    public function __construct(){
        $this->set('BASEURL', BASEURL);
        self::$current_controller = $this;
        $this->response = new Response();
    }

    static function loadTwig(){    
        \ComposerAutoloaderInitb80da45cb6974f22f3f089979c4acd7e::getLoader();
        $loader = new \Twig_Loader_Filesystem(ROOT.DS.'view');
        if (is_null(self::$twig)){
            self::$twig = new \Twig_Environment($loader, [
                'debug' => true,
                'cache' => false
            ]);
            if (isset($_SESSION['auth']['id'])){
                $profil = Utilisateur::getUserById($_SESSION['auth']['id']);
                self::$twig->addGlobal('profil', $profil);
                foreach (Abonnement::getByUser($_SESSION['auth']['id']) as $a){
                    if ($a['date_end'] <= date("Y-m-d H:i:s")){
                        Abonnement::stopAbo($_SESSION['auth']['id'], $a['id']);
                    }
                } 
                $abo = Abonnement::getByUser($_SESSION['auth']['id']);
                //var_dump($abo);
                if (!empty($abo)){            
                    self::$twig->addGlobal('abonne', $abo);
                } 
            }
            self::$twig->addExtension(new \Twig_Extension_Debug());
            self::$twig->addExtension(new FormatDate());
            self::$twig->addExtension(new ShortText());
            //self::$twig->addGlobal('session', $_SESSION);
            //self::$twig->addGlobal('cookie', $_COOKIE);
            return self::$twig;
        }
        return self::$twig;
    }

    public function set($key, $value = NULL){
        if (is_array($key)){
           $this->content += $key;
        }
        elseif(isset($value)){
            $this->content[$key] = $value;
        }
    }

    public function render($viewName){
        if($this->rendered){
            return false;
        }

        $file = strtolower($this->controller_name).'/'.$viewName.'.twig';
        $this->rendered = true;
        $this->response->setBody($this->loadTwig()->render($file, $this->content));
        $this->response->send();
    }

    protected static function rrmdir($dir) {
    if (is_dir($dir)) { // si le paramètre est un dossier
        $objects = scandir($dir); // on scan le dossier pour récupérer ses objets
        foreach ($objects as $object) { // pour chaque objet
                if ($object != "." && $object != "..") { // si l'objet n'est pas . ou ..
                    if (filetype($dir."/".$object) == "dir") rmdir($dir."/".$object);else unlink($dir."/".$object); // on supprime l'objet
                    }
        }
        reset($objects); // on remet à 0 les objets
        rmdir($dir); // on supprime le dossier
        }
    }

    public function getResponse(){
        return $this->response;
    }
    
}


