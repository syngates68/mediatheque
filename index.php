<?php session_start();

use Controller\Controller;
use App\Autoload;
use App\Router\Router;

require 'App/Autoload.php'; 
Autoload::register(); 

$router = new Router($_GET['p']);

$router->_get('/', function(){ Controller::getHome(); });
$router->_get('/home', function(){ Controller::getHome(); });
$router->_get('/abonnement', function(){ Controller::getAbonnement(); });
$router->_get('/login', function(){ Controller::getLogin(); });

$router->_run();