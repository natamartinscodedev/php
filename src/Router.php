<?php

namespace ApiPhp;

class Router
{
  protected $routes = [];

  public function create(
    string $method, // Método HTTP.
    string $path,  // URL/rota.
    callable $callback // Função executada nessa rota.
  ) {
    $this->routes[$method][$path] = $callback;
  }

  public function init()
  {
    header('Content-Type: application/json; charset=utf-8');

    $httpMethod = $_SERVER["REQUEST_METHOD"];

    if (isset($this->routes[$httpMethod])) {

      foreach ($this->routes[$httpMethod] as $path => $callback) {

        if ($path === $_SERVER["REQUEST_URI"]) {
          return $callback();
        }
      }
    }
  }
}
