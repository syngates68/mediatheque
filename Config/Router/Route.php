<?php

namespace Config\Router;

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

        if (!file_exists($req)){
            http_response_code(404);
            header('Location:'.BASEURL.'home/404'); // provide your own HTML for the error page
            exit;
        }
        else{
            
            require_once $req;

            if (class_exists($this->class_name)){

                $c = new $this->class_name;

                $method = array($c, $this->method);

                if (is_callable($method, false, $callable_name)){
                    if (!empty($this->param)){
                        return call_user_func_array($method, $this->param); 
                    }
                    else{
                        return call_user_func($method);
                    }
                }
                else{
                    http_response_code(404);
                    header('Location:'.BASEURL.'home/404'); // provide your own HTML for the error page
                    exit; 
                }
         
            }
            else{
                http_response_code(404);
                header('Location:'.BASEURL.'home/404'); // provide your own HTML for the error page
                exit;
            }

        }
    }

}