<?php

namespace App\Router;

use Exception;

class Router{

    private $url;
    private $controller = DEFAULT_MODULE;
    private $method = DEFAULT_FUNCTION;
    private $routes = [];

    public function __construct($url){
        $this->url = $url;
        $this->parseUrl($this->url);
        $route = new Route($this->controller, $this->method);
        $this->routes[] = $route;
        $this->_run();
    }

    public function parseUrl($url){
        $url = explode('/', $url);
        //var_dump($url);
        $this->controller = $this->loadController($url[3]);
        $this->method = $this->loadMethod($url[4]);
    }

    public function loadController($c){
        return ucfirst($c.'Controller');
    }

    public function loadMethod($m){
        return strtolower($_SERVER['REQUEST_METHOD']).''.ucfirst($m);
    }

    public function _run(){
        if (!isset($this->routes)){
            throw new Exception('Pas de correspondance');
        }
        else{
            foreach ($this->routes as $route){
                if ($route->_match($this->controller, $this->method)){
                    return true;
                }
            }
            //throw new Exception('La requête n\'a pas aboutie');
        }
    }

}