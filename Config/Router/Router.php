<?php

namespace Config\Router;

use Exception;

class Router{

    private $url;
    private $controller = DEFAULT_MODULE;
    private $method = DEFAULT_FUNCTION;
    private $param = NULL;
    private $routes = [];

    public function __construct($url){
        $this->url = $url;
        $this->parseUrl($this->url);
        $route = new Route($this->controller, $this->method, $this->param);
        $this->routes[] = $route;
        $this->_run();
    }

    public function parseUrl($url){
        $url = explode('/', trim($url, '/'));
        //var_dump($url);
        $i = 0;
        $this->controller = $this->loadController($url[$i+2]);
        $this->method = $this->loadMethod($url[$i+3]);
        $this->param = array_slice($url, $i+4);
        //var_dump($this->param);
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