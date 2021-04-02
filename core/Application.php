<?php

namespace app\core;

/**
 * Class Application
 * ---
 * @author Josiah Eakle <dev@josiaheakle.com>
 * @package app/core
 */
class Application {

    public Router  $router;
    public Request $request;

    function __construct()
    {
        $this->request = new Request();
        $this->router  = new Router($this->request);
    }

    public function run()
    {
        $this->router->resolve();
    }
asdf
}