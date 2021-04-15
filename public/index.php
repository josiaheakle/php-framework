<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";

// Error handling
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use app\ {
    core\Application,
    controllers\SiteController,
    controllers\AuthController,
    utils\Util
};
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'appName' => 'Test App',
    'rootDir' => dirname(__DIR__),
    'rootUri' => "http://localhost:8000",
    'db'      => [
        'host' => $_ENV['DB_HOST'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS'],
        'name' => $_ENV['DB_NAME']
    ]
];

$app = new Application($config);

$app->router->get ('/',         [SiteController::class, "home"]);
$app->router->get ('/contact',  [SiteController::class, "contact"]);
$app->router->post('/contact',  [SiteController::class, "handleContact"]);

$app->router->get ('/login',    [AuthController::class, 'login']);
$app->router->post('/login',    [AuthController::class, 'login']);

$app->router->get ('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

define('DEBUG_PATH', Application::$ROOT_DIR . '/public/DEBUG.txt');

Util::clearDebug(DEBUG_PATH);


$app->run();

?>
