<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\Abonnement;
use Model\Utilisateur;

use Library\FormatDate;
use Library\ShortText;

require (ROOT.DS.'vendor/autoload.php');

class Controller{

    protected $current_controller;

    private $content = array();
    private $rendered = false;
    private static $twig = NULL;

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

        $file = strtolower(str_replace('Controller', '', $this->current_controller)).'/'.$viewName.'.twig';
        $this->rendered = true;
        echo self::loadTwig()->render($file, $this->content);     
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
    
}


