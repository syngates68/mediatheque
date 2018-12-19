<?php

namespace App\Router;

class Route{

    private $path;
    private $callable;
    private $matches;

    public function __construct($path, $callable){
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    public function _match($url){
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $regex = "#^$path$#i";

        if (!preg_match($regex, $url, $matches)){
            return false;
        }
        $this->matches = $matches;
        return true;
        //array_shift($matches);
        //var_dump($matches);
    }

    public function _call(){
        return call_user_func_array($this->callable, $this->matches);
    }

}