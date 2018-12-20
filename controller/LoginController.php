<?php 

namespace Controller;

class LoginController extends Controller{
    
    static function getLogin(){
        echo self::loadTwig()->render('login.twig');
    }
    
}


