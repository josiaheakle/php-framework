<?php

// Autoload 
require_once dirname(__DIR__) . "/vendor/autoload.php";

// Namespace imports
use app\ {
    core\Application,
    controllers\SiteController,
    controllers\AuthController,
    utils\Util
};
use Dotenv\Dotenv;

// Initialize .env
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Create config
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

// Create new app with config
$app = new Application($config);

// DEBUG setup
define('DEBUG_PATH', Application::$ROOT_DIR . '/public/DEBUG.txt');
Util::clearDebug(DEBUG_PATH);

// Set routes
$app->router->get ('/',         [SiteController::class, "home"]);
$app->router->get ('/contact',  [SiteController::class, "contact"]);
$app->router->post('/contact',  [SiteController::class, "handleContact"]);

$app->router->get ('/login',    [AuthController::class, 'login']);
$app->router->post('/login',    [AuthController::class, 'login']);

$app->router->get ('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

$app->run();

?>
