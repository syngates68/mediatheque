<?php

namespace Config\Router;

/**
 * Class : Request
 * Namespace : Config\Router
 * Author : Quentin SCHIFFERLE
 * Description :
 *     Classe représentant une requête au serveur
**/
class Request{

    public $url;

    public function __construct(){
        $this->url = $_SERVER['REQUEST_URI'];

        if (isset($_SERVER['PATH_INFO']))
            $this->path_info = $_SERVER['PATH_INFO'];
        else 
            $this->path_info = '';
    }

}