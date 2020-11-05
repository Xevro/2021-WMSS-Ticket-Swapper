<?php

// General variables
$basePath = __DIR__ . '/../';

//require database config & functions
require_once $basePath . 'config/database.php';
require_once $basePath . 'src/functions.php';

require_once $basePath . 'vendor/autoload.php';
//bootstrap twig
$loader = new \Twig\Loader\FilesystemLoader($basePath . '/resources/templates');
$twig = new \Twig\Environment($loader);

require_once $basePath . 'src/Models/Event.php';

//$connection = getDBConnection();
$events = '';

//Ophalen bedrijfsinfo
//$stmt = $connection->prepare('SELECT * FROM events');
//$stmt->execute([]);
//while ($eventsDB = $stmt->fetchAllAssociative()) {
//    $events = new Event();
//}//string $eventName, double $standardPrice, string $location, string $description, string $artists

// View
echo $twig->render('pages/index.twig', ['events'  => $events]);