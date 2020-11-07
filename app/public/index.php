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
require_once $basePath . 'src/Models/Event.php';

$stmt = $connection->prepare('SELECT * FROM Evenementen');
$stmt->execute([]);
$eventsAssociative = $stmt->fetchAllAssociative();

foreach ($eventsAssociative as $Event) {
    $events[] = new Event($Event['Naam'], $Event['Standaard_ticketprijs'], $Event['Aanvangstijd'], $Event['Sluitingstijd'], $Event['Locatie'], $Event['Beschrijving'], $Event['Aanwezige_artiesten']);
}

// View
echo $twig->render('pages/index.twig', ['events' => $events]);