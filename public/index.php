<?php

use app\controllers\AuthController;
use app\controllers\BlogController;
use app\controllers\SiteController;
use app\core\Application;

require_once __DIR__.'/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// TODO: create secure vault to store the db credentials
$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
        'dbname' => $_ENV['DB_NAME']
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);

$app->router->get('/logout', [AuthController::class, 'logout']);

$app->router->get('/create-blog', [BlogController::class, 'create']);
$app->router->post('/create-blog', [BlogController::class, 'create']);

$app->router->get('/blog-post', [BlogController::class, 'view']);

$app->run();