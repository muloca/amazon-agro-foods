<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine project base path (supports local and production setups)
$defaultBasePath = realpath(__DIR__.'/..');
$productionBasePath = realpath(__DIR__.'/../laravel');
$basePath = $productionBasePath ?: $defaultBasePath;

if (! $basePath) {
    http_response_code(500);
    exit('Unable to resolve application base path.');
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = $basePath.'/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require $basePath.'/vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once $basePath.'/bootstrap/app.php';

$app->handleRequest(Request::capture());
