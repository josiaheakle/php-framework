<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

use app\core\Application;

$app = new Application();

$app->router->get('/', function() {
    return "Hello World";
});

$app->router->get('/user', function() {
    return "Hello, user";
});

$app->run();

?>
