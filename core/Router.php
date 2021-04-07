<?php

namespace app\core;

/**
 * Class Router
 * ---
 * @author Josiah Eakle <dev@josiaheakle.com>
 * @package app/core
 */
class Router 
{

    protected array $routes;

    public Request  $request;
    public Response $response;

    /**
     * Router constructor
     * ---
     * @param \app\core\Request  $request
     * @param \app\core\Response $response
     */
    function __construct(Request $request, Response $response)
    {
        $this->request  = $request;
        $this->response = $response;
    }

    /**
     * Handles routing for get on specified path.
     * ---
     * @param string $path     : "/pagename"
     * @param array  $callback : [controller: view/callback]
     */
    public function get(string $path, array $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * Handles routing for post on specified path.
     * ---
     * @param string $path
     * @param array $callback [controller: action]
     *
     */
    public function post(string $path, array $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * Returns view or data for current uri
     */
    public function resolve()
    {
        $path     = $this->request->getPath();
        $method   = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        // If no route has been set return 404
        if($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView("_404page");
        } 
        // If route is a string, render the associated view
        if(is_string($callback)) {
            return $this->renderView($callback);
        } 
        // If array [controller::class, 'method'], create controller instance
        if(is_array(($callback))) {
            Application::$app->setController(new $callback[0]());
            $callback[0] = Application::$app->controller;
        }

        return call_user_func($callback, $this->request);
    }

    /**
     * Renders specified view
     * ---
     * @param string $view 
     * @return string html content returned from view
     */
    public function renderView(string $view, array $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent   = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Renders content
     * ---
     * @param string $content
     * @param string $view    [not required]
     * @return string html content
     */
    public function renderContent(string $content)
    {
        $layoutContent = $this->layoutContent();
        $viewContent   = $content;
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Gets specified layout content
     * ---
     * @param string $layout which layout to use [not required]
     * @return string html content
     */
    protected function layoutContent()
    {
        $layout = Application::$app->getController()->layout;
        \ob_start();
        include_once (Application::$ROOT_DIR . "/views/layouts/" . $layout . ".php");
        return \ob_get_clean();
    }

    /**
     * Gets specified view without content
     * ---
     * @param string $view which view to use
     * @return string html content 
     */
    protected function renderOnlyView(string $view, array $params = [])
    {
        foreach($params as $k => $v) {
            $$k = $v;
        }
        \ob_start();
        include_once (Application::$ROOT_DIR . "/views/" . $view . ".php");
        return \ob_get_clean();
    }

}