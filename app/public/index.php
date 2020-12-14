<?php

// General variables
$basePath = __DIR__ . '/../';
require $basePath . 'vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

// Define routes
$router->get('/', 'EventController@home');
$router->get('/events', 'EventController@events');

$router->get('/events/register', 'EventController@registerEvent');
$router->post('/events/register', 'EventController@registerEvent');

$router->get('/contact', 'EventController@contact');
$router->post('/contact', 'EventController@contact');

$router->get('/events/ticket/add', 'EventController@addTicket');
$router->post('/events/ticket/add', 'EventController@addTicket');

$router->get('/events/(\w+)/tickets', 'EventController@eventTickets');

$router->get('/events/(\w+)/tickets/(\w+)', 'EventController@ticketInfo');

// Run it!
$router->run();

