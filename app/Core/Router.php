<?php

namespace App\Core;

class Router
{
    protected $routes = [];

    private function addRoute($method, $route, $controller, $action)
    {
        $this->routes[$method][$route] = [
          'controller' => $controller,
          'action' => $action,
        ];
    }

    public function get($route, $controller, $action)
    {
        $this->addRoute('GET', $route, $controller, $action);
    }

    public function post($route, $controller, $action)
    {
        $this->addRoute('POST', $route, $controller, $action);
    }

    public function put($route, $controller, $action)
    {
        $this->addRoute('PUT', $route, $controller, $action);
    }

    public function delete($route, $controller, $action)
    {
        $this->addRoute('Delete', $route, $controller, $action);
    }

    public function patch($route, $controller, $action)
    {
        $this->addRoute('PATCH', $route, $controller, $action);
    }

    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method = $_SERVER['REQUEST_METHOD'];

        if(array_key_exists($uri, $this->routes[$method])) {
            $controller = $this->routes[$method][$uri]['controller'];
            $action = $this->routes[$method][$uri]['action'];

            $controller = new $controller();
            $controller->$action();
        } else {
            $this->abort();
        }
    }

    public function abort($statusCode = 404)
    {
        http_response_code($statusCode);
        include "Views/$statusCode.php";
        die();
    }

}
