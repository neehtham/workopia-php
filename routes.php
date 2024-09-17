<?php
$router->get('/', 'controller/home.php');
$router->get('/login', 'controller/login.php');
$router->get('/listings', 'controller/listings/index.php',);
$router->get('/listings/create', 'controller/listings/create.php',);
$router->get('/listing', 'controller/listings/show.php',);
