<?php 

namespace Controller;

use Model\Video;
use Model\Theme;
use Model\Abonnement;

use Config\FormatDate;

require (ROOT.DS.'vendor/autoload.php');

class Controller{

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
            self::$twig->addExtension(new \Twig_Extension_Debug());
            self::$twig->addExtension(new FormatDate());
            //self::$twig->addGlobal('session', $_SESSION);
            self::$twig->addGlobal('cookie', $_COOKIE);
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

        $file = $viewName.'.twig';
        $this->rendered = true;
        echo self::loadTwig()->render($file, $this->content);     
    }
    
}


