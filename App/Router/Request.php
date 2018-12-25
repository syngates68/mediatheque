<?php

namespace App\Router;

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