<?php

require '../helpers.php';

require basePath('Database.php');
require basePath('Router.php');

// enabling the router and getting the routes
$router = new Router();
require basePath('routes.php');

// current URI and method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
// passing URI in the route
$router->route($uri, $method);
