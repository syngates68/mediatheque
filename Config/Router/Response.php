<?php

namespace Config\Router;

/**
 * Class : Response
 * Namespace : FrameWork\Routing
 * Author : Florian GOMES
 * Last modification : 08/11/2017
 * Description :
 *     Class use to store the differents information about a response.
**/
class Response { 
    private $headers = []; 
    private $body;
    private $send = false;

    function __construct() {
        
    }

    public function setBody($text) {
        $this->body = $text;
    }

    public function getBody() { return $this->body; }

    public function addHeader($key, $value) {
        $this->headers[$key] = $value;
    }

    public function getHeader($key) {
        return $this->headers[$key];
    }

    public function send() {
        if($this->send)
            return;
        foreach($this->headers as $key => $value) {
            header($key.':'.$value);
        }
        echo $this->getBody();
        $this->send = true;
    }
}