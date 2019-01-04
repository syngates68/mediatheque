<?php

namespace Config;

class Autoload{

    static function register(){
        spl_autoload_register(array(__CLASS__, '__autoload'));
    }

    static function __autoload($class_name){
        $path = ROOT.DS.$class_name;
        $path = str_replace('\\', '/', $path);
        //echo $path;
        require_once($path . '.php');
    }

}