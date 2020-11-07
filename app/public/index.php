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

$connection = getDBConnection();
$events = '';

//Fetch events
$stmt = $connection->prepare('SELECT * FROM Evenementen');
$stmt->execute([]);
$eventsAssociative = $stmt->fetchAssociative();

foreach($eventsAssociative as $event) {
    $events[] = new Event($event['eventName'], $event['standardPrice'],$event['location'], $event['description'], $event['artists'], $event['startdate'], $event['enddate']);
}

// View
echo $twig->render('pages/index.twig', ['events'  => $events]);