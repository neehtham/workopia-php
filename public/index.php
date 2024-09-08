<?php
require '../helpers.php';
$routes = [
    '/' => 'controller/home.php',
    '/listings' => 'controller/listings/index.php',
    '/listings/create' => 'controller/listings/create.php',
    '404' => 'controller/error/404.php',
];
$uri = $_SERVER['REQUEST_URI'];
if (array_key_exists($uri, $routes)) {
    require(basePath($routes[$uri]));
} else {
    require(basePath($routes['404']));
};
