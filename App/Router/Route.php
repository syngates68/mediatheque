<?php

namespace App\Router;

class Route{

    private $controller;
    private $method;
    private $param;
    private $class_name;

    public function __construct($controller, $method, $param){
        $this->controller = trim($controller, '/');
        $this->method = $method;
        $this->param = $param;
    }

    public function _match($controller, $method){
        $req = ROOT.DS.'Controller'.DS.$this->controller.'.php';
        //echo $this->controller;
        $this->class_name = 'Controller\\'.$this->controller;

        if (!file_exists($req))
            return false;
        else{
            
            require_once $req;

            if (class_exists($this->class_name)){

                $c = new $this->class_name;

                $method = array($c, $this->method);

                if (!is_callable($method, true, $callable_name)){
                    return false;
                }
                if ($this->param != NULL){
                    return call_user_func_array($method, array($this->param)); 
                }
                return call_user_func($method);           
            }

        }
    }

}