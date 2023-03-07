<?php

declare(strict_types=1);

use Sfbdata\Mvc\Controller\Controller;
use Sfbdata\Mvc\Controller\Erro404Controller;
use Sfbdata\Mvc\Repository\VideoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$dbPath = __DIR__.'/../banco.sqlite';
$pdo = new PDO("sqlite:$dbPath");
$videoRepository = new VideoRepository($pdo);

$routes = require_once __DIR__ . '/../config/routes.php';

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';
$httpMethod = $_SERVER['REQUEST_METHOD'];

$key = "$httpMethod|$pathInfo";
if(array_key_exists($key,$routes)){
    $controllerClass = $routes["$httpMethod|$pathInfo"];
    
    $controller = new $controllerClass($videoRepository);
} else {
    $controller = new Erro404Controller();

}
/**@var Controller $controller  */
$controller->processaRequisicao();