<?php

namespace app\core;

/**
 * Class Application
 * ---
 * @author Josiah Eakle <dev@josiaheakle.com>
 * @package app/core
 */
class Application {

    public static Application   $app;
    
    public        Router        $router;
    public        Request       $request;
    public        Response      $response;
    public        Controller    $controller;
    public        Database      $database;

    public static string        $ROOT_DIR;
    public static string        $APP_NAME;
    public static string        $ROOT_URI;

    /**
     * Creates instance of Request, Response, and Router
     * ---
     * @param string $appName
     * @param string $rootDir
     * @param string $rootUri
     * 
     */
    function __construct(array $config)
    {
        // REQUIRED
        self::$APP_NAME = $config['appName'];
        self::$ROOT_DIR = $config['rootDir'];
        self::$ROOT_URI = $config['rootUri'];

        self::$app      = $this;        

        $this->database = new Database($config['db']);
        $this->request  = new Request();
        $this->response = new Response();
        $this->router   = new Router($this->request, $this->response);
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Renders route
     */
    public function run()
    {
        echo $this->router->resolve();
    }

}