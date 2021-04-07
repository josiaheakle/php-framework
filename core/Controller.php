<?php
namespace app\core;

class Controller
{
    public string $layout = 'main';
    public function render(string $view, array $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout(string $layout)
    {
        $this->layout = $layout; 
    }
}

?>