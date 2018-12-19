<?php

namespace App\Router;

class Router{

    private $url;
    private $routes = [];

    public function __construct($url){
        $this->url = $url;
    }

    public function _get($path, $callable){
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route;
    }

    public function _post($path, $callable){
        $route = new Route($path, $callable);
        $this->routes['POST'][] = $route;
    }

    public function _run(){
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new \Exception('Pas de correspondance');
        }
        else{
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
                if ($route->_match($this->url)){
                    return $route->_call();
                }
            }
            throw new \Exception('La requête n\'a pas aboutie');
        }
    }

}