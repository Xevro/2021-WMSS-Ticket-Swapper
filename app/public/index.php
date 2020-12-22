<?php

// General variables
$basePath = __DIR__ . '/../';
require $basePath . 'vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->before('GET|POST', '/.*', function () {
    session_start();
});

$router->get('/', 'EventController@home');
$router->get('/overview', 'EventController@events');
$router->get('/overview/(\w+)/tickets', 'EventController@eventTickets');

$router->get('/overview/(\w+)/tickets/(\d+)', 'EventController@ticketInfo');

$router->get('/contact', 'EventController@contact');
$router->post('/contact', 'EventController@contact');

$router->get('/login', 'AuthController@showLogin');
$router->post('/login', 'AuthController@login');
$router->get('/register', 'AuthController@showRegister');
$router->post('/register', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');

$router->before('GET|POST', '/events.*', function () {
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit();
    }
});

$router->get('/account', 'EventController@myAccount');

$router->mount('/events', function () use ($router) {

// Define routes
$router->get('/register', 'EventController@registerEvent');
$router->post('/register', 'EventController@registerEvent');

$router->get('/ticket/add', 'EventController@addTicket');
$router->post('/ticket/add', 'EventController@addTicket');

$router->get('/ticket/(\d+)/purchase', 'EventController@showPurchaseTicket');
$router->post('/ticket/(\d+)/purchase', 'EventController@purchaseTicket');

$router->get('/ticket/(\d+)/download', 'EventController@downloadTicket');
});

// Run it!
$router->run();