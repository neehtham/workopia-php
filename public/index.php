<?php
session_start();
require __DIR__ . '/../vendor/autoload.php';
require '../helpers.php';

use Framework\Router;

// enabling the router and getting the routes
$router = new Router();
require basePath('routes.php');

// current URI and method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// passing URI in the route
$router->route($uri);
