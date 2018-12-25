<?php session_start();

use App\Autoload;
use App\Router\Router;

define ('DS', DIRECTORY_SEPARATOR);
define ('PUBLIC_ROOT', __DIR__);
define ('ROOT', dirname(PUBLIC_ROOT));
define ('APP', ROOT.DS.'App');

define ('VENDOR', ROOT.DS.'vendor');

$http = empty($_SERVER['HTTPS']) ? 'http' : 'https';
$srv = $_SERVER['SERVER_NAME'];

define ('BASEURL', $http.'://'.$srv.'/mediatheque/public/');

define ('DEFAULT_MODULE', 'home');
define ('DEFAULT_FUNCTION', 'board');

require APP.DS.'Autoload.php'; 
Autoload::register(); 

$router = new Router($_SERVER['REQUEST_URI']);