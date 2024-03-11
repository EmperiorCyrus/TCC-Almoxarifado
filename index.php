<?php

require 'vendor/autoload.php';
use App\Controller\ControllerBatch;
use App\Controller\ControllerEntrance;
use App\Controller\ControllerNote;
use App\Controller\ControllerOutput;
use App\Controller\ControllerProduct;
use App\Controller\HomeController;
use Core\Library\Router;

$router = new Router;

//DEFINIR ROTAS UNICAS
$router->route('GET', '/', [HomeController::class, 'index']);
$router->route('GET', '/perfil', [HomeController::class, 'perfil']);
$router->route('GET', '/produtos', [ControllerProduct::class, 'index']);
$router->route('GET', '/produtos/criar', [ControllerProduct::class, 'create']);
$router->route('GET', '/entradas', [ControllerEntrance::class, 'index']);
$router->route('GET', '/entradas/criar', [ControllerEntrance::class, 'create']);
$router->route('GET', '/lotes', [ControllerBatch::class, 'index']);
$router->route('GET', '/lotes/criar', [ControllerBatch::class, 'create']);
$router->route('GET', '/notas', [ControllerNote::class, 'index']);
$router->route('GET', '/notas/criar', [ControllerNote::class, 'create']);
$router->route('GET', '/saidas', [ControllerOutput::class, 'create']);
$router->route('GET', '/saidas/criar', [ControllerOutput::class, 'create']);

//DEFINIR AGRUPAMENTO DE ROTAS POR UM PREFIXO
$router->group('/admin', [
  ['GET', '', [HomeController::class, 'admin']],
  ['GET', '/criar', [HomeController::class, 'adminCreate']],
  ['GET', '/{id:\d+}', [HomeController::class, 'adminSearch']],
]);

$router->run();