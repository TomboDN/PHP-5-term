<?php

namespace core;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $arr = require 'api/config/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    public function add($route, $params)
    {
        $route = '#^' . $route . '$#';
        $this->routes[$route] = $params;
    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function run()
    {
        if ($this->match()) {
            $path = 'controller\\' . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($path)) {
                $action = $this->params['action'] . 'Action';
                if (method_exists($path, $action)) {
                    if ($action != 'login' && !isset($_COOKIE['login'])){
                        header("Location: http://localhost:8081/signin.html");
                    }
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    View::errorCode(404, 'Метод контроллера не найден');
                }
            } else {
                View::errorCode(404, 'Класс контроллера не найден');
            }
        } else {
            View::errorCode(404, 'Неверный URL(Такого URL нет в списке зарегистрированных роутов)');
        }
    }
}