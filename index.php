<?php

require 'vendor/autoload.php';
use App\Controller\HomeController;
use Core\Library\Router;

$router = new Router;

//DEFINIR ROTAS UNICAS
$router->route('GET', '/', [HomeController::class, 'index']);
$router->route('POST', '/teste', [HomeController::class, 'create']);

//DEFINIR AGRUPAMENTO DE ROTAS POR UM PREFIXO
$router->group('/admin', [
  ['GET', '', [HomeController::class, 'admin']],
  ['GET', '/criar', [HomeController::class, 'adminCreate']],
  ['GET', '/{id:\d+}', [HomeController::class, 'adminSearch']],
]);

$router->run();