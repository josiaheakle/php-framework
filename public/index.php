<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

// Error handling
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use app\ {
    core\Application,
    controllers\SiteController,
    controllers\AuthController
};

$app = new Application( "Test App", dirname(__DIR__), "http://localhost:8000");

$app->router->get ('/',         [SiteController::class, "home"]);
$app->router->get ('/contact',  [SiteController::class, "contact"]);
$app->router->post('/contact',  [SiteController::class, "handleContact"]);

$app->router->get ('/login',    [AuthController::class, 'login']);
$app->router->post('/login',    [AuthController::class, 'login']);

$app->router->get ('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->run();

?>
