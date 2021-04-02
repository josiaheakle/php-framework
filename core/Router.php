<?php

namespace app\core;

/**
 * Class Router
 * ---
 * @author Josiah Eakle <dev@josiaheakle.com>
 * @package app/core
 */
class Router {

    protected array $routes;
    public Request  $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(string $path, callable $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path     = $this->request->getPath();
        $method   = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if($callback === false) {
            echo "Not found";
            exit;
        } 
        echo call_user_func($callback);
    }

}