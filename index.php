<?php session_start();

use Controller\HomeController;
use Controller\AbonnementController;
use Controller\LoginController;
use App\Autoload;
use App\Router\Router;

require 'App/Autoload.php'; 
Autoload::register(); 

//require ('Controller/Controller.php');

define ('DEFAULT_MODULE', 'home');
define ('DEFAULT_FUNCTION', 'index');
 
define ('DIR_CLASS', __DIR__.'/Controller/');
define ('DIR_MODEL', __DIR__.'/Model/');
define ('DIR_VIEW',  __DIR__.'/view/');

$router = new Router($_GET['p']);

$router->_get('/', function(){ HomeController::getHome(); });
$router->_get('/home', function(){ HomeController::getHome(); });
$router->_get('/abonnement', function(){ AbonnementController::getAbonnement(); });
$router->_get('/login', function(){ LoginController::getLogin(); });

$router->_run();