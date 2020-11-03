<?php

// General variables
$basePath = __DIR__ . '/../';

// Data
require_once $basePath . 'vendor/autoload.php';

//bootstrap twig
$loader = new \Twig\Loader\FilesystemLoader($basePath . '/resources/templates');
$twig = new \Twig\Environment($loader);

// View


echo 'test';


echo $twig->render('pages/index.twig', []);