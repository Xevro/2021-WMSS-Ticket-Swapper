<?php

// General variables
$basePath = __DIR__ . '/../';
require $basePath . 'vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

// Define routes
$router->get('/', 'EventController@home');

// Run it!
$router->run();

