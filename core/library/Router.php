<?php
namespace Core\Library;

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;
use function FastRoute\simpleDispatcher;

class Router
{
  private array $routes;
  private array $groups;

  public function route(string $method, string $uri, array $controller)
  {
    $this->routes[] = [$method, $uri, $controller];
  }

  public function group(string $prefix, array $routes)
  {
    $this->groups[$prefix] = $routes;
  }

  public function setGroup(RouteCollector $r)
  {
    foreach ($this->groups as $prefix => $routes) {
      $r->addGroup($prefix, function (RouteCollector $r) use ($routes) {
        foreach ($routes as $route) {
          $r->addRoute(...$route);
        }
      });   
    }
  }

  public function run()
  {
    $dispatcher = simpleDispatcher(function (RouteCollector $r) {
      if (!empty($this->groups)) {
        $this->setGroup($r);
      }

      foreach ($this->routes as $route) {
        $r->addRoute(...$route);
      }
    });

    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

    if (false !== $pos = strpos($uri, '?')) {
        $uri = substr($uri, 0, $pos);
    }
    $uri = rawurldecode($uri);

    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
    $this->handler($routeInfo);
  }

  private function handler($routeInfo)
  {
    switch ($routeInfo[0]) {
      case Dispatcher::NOT_FOUND:
          //PASSAR PÁGINA DE ERRO
          // call_user_func_array([new $class, $method], $vars);
          break;
      case Dispatcher::METHOD_NOT_ALLOWED:
          $allowedMethods = $routeInfo[1];
          //PASSAR PÁGINA DE ERRO
          // call_user_func_array([new $class, $method], $vars);
          break;
      case Dispatcher::FOUND:
          $handler = $routeInfo[1];
          $vars = $routeInfo[2];
          [$class, $method] = $handler;
          call_user_func_array([new $class, $method], $vars);
          break;
    }
  }
}