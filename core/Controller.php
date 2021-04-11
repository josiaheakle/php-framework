<?php
namespace app\core;

class Controller
{
    public string $layout       = 'main';
    public string $baseColor    = 'amber';

    public function render(string $view, array $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function setLayout(string $layout)
    {
        $this->layout = $layout; 
    }

    /**
     * Follow materialize available colors
     * ---
     * @param string $color : Base color from https://materializecss.com/color.html
     */
    public function setBaseColor(string $color)
    {
        $this->baseColor = $color;
    }
}

?>