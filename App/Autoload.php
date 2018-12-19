<?php

namespace App;

class Autoload{

    static function register(){
        spl_autoload_register(array(__CLASS__, '__autoload'));
    }

    static function __autoload($class_name){
        $class_name = str_replace('\\', '/', $class_name);
        require($class_name.'.php');
    }

}