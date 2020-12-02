<?php

// General variables
$basePath = __DIR__ . '/../';
require $basePath . 'vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

// Define routes
$router->get('/', 'EventController@home');
$router->get('/events', 'EventController@events');
$router->get('/register-event', 'EventController@registerEvent');
$router->post('/register-event', 'EventController@registerEvent');

// Run it!
$router->run();

