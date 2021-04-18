<?php

// Autoload 
require_once __DIR__ . "/vendor/autoload.php";

// Namespace imports
use app\ {
    core\Application,
    utils\Util
};
use Dotenv\Dotenv;

// Initialize .env
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create config
$config = [
    'appName' => 'Test App',
    'rootDir' => __DIR__,
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
$app->database->applyMigrations();