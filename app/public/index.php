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

$connection = getDBConnection();
$events = [];

//Fetch events
require_once $basePath . 'src/Models/event.php';

$searchEvents = isset($_GET['searchEvents']) ? (string) $_GET['searchEvents'] : '';

if($searchEvents) {
    $stmt = $connection->prepare('SELECT * FROM Evenements WHERE eventName LIKE ?');
    $stmt->execute(['%' . $searchEvents . '%']);
    $eventsAssociative = $stmt->fetchAllAssociative();
} else {
    $stmt = $connection->prepare('SELECT * FROM Evenements');
    $stmt->execute([]);
    $eventsAssociative = $stmt->fetchAllAssociative();
}

foreach ($eventsAssociative as $event) {
    $events[] = new event($event['eventName'], $event['standardTicketPrice'], $event['startDate'], $event['endDate'], $event['location'], $event['description'], $event['artists']);
}

// View
echo $twig->render('pages/index.twig', ['events' => $events, 'searchTerm' => $searchEvents]);