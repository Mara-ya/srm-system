<?php

namespace App\Core;

class Router {
    private $routes;

    public function __construct() {
        $this->routes = [
            '/' => 'MainController@index',
            '/login' => 'AuthController@login',
            '/register' => 'AuthController@register',
            '/dashboard' => 'DashboardController@index',
            '/dashboard/addEntry' => 'DashboardController@addEntry',
            '/dashboard/editEntry/:id' => 'DashboardController@editEntry',
        ];
    }

    public function run() {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url)[0];
        foreach ($this->routes as $route => $controllerAction) {
            $pattern = preg_replace('/:\w+/', '(\w+)', $route);
            if (preg_match('#^' . $pattern . '$#', $url, $matches)) {
                list($controller, $action) = explode('@', $controllerAction);
                $controller = 'App\\Controllers\\' . $controller;
                $controllerObject = new $controller();
                array_shift($matches);
                call_user_func_array([$controllerObject, $action], $matches);
                return;
            }
        }
        echo "404 Not Found";
    }
}
