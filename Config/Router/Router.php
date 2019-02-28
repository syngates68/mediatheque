<?php

namespace Config\Router;

use Exception;
use Config\Config;

/**
 * Class : Router
 * Namespace : Config\Router
 * Author : Quentin SCHIFFERLE
 * Description :
 *     Classe permettant de déterminer le controller et sa méthode appelés via l'URL
**/
class Router{

    private $url;
    private $controller;
    private $method;
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
        $this->controller = (empty($url[$i+2]) || $url[$i+2] == '-') ? $this->loadController(Config::DEFAULT_CONTROLLER) : $this->loadController($url[$i+2]);
        $this->method = (empty($url[$i+3]) || $url[$i+3] == '-') ? $this->loadMethod(Config::DEFAULT_METHOD) : $this->loadMethod($url[$i+3]);
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