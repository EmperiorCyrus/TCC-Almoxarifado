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

$router->group("/produtos", [
  ['GET', '', [ControllerProduct::class, 'index']],
  ['GET', '/criar', [ControllerProduct::class, 'create']],
  ['POST', '', [ControllerProduct::class, 'save']],
]);

$router->group("/notas", [
  ['GET', '', [ControllerNote::class, 'index']],
  ['GET', '/criar', [ControllerNote::class, 'create']],
  ['POST', '', [ControllerNote::class, 'save']],
]);

$router->group("/lotes", [
  ['GET', '', [ControllerBatch::class, 'index']],
  
  ['GET', '/criar', [ControllerBatch::class, 'create']],
  ['POST', '', [ControllerBatch::class, 'save']],
]);

$router->group("/entradas", [
  ['GET', '', [ControllerEntrance::class, 'index']],
  ['GET', '/criar', [ControllerEntrance::class, 'create']],
  ['POST', '', [ControllerEntrance::class, 'save']],
]);

$router->group("/saidas", [
  ['GET', '', [ControllerOutput::class, 'index']],
  ['GET', '/criar', [ControllerOutput::class, 'create']],
  ['POST', '', [ControllerOutput::class, 'save']],
]);

//DEFINIR AGRUPAMENTO DE ROTAS POR UM PREFIXO
$router->group('/admin', [
  ['GET', '', [HomeController::class, 'admin']],
  ['GET', '/criar', [HomeController::class, 'adminCreate']],
  ['GET', '/{id:\d+}', [HomeController::class, 'adminSearch']],
]);

$router->run();