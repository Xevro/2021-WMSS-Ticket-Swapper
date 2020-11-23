<?php

// General variables
$basePath = __DIR__ . '/../';
//require database config & functions
require_once $basePath . 'config/database.php';
require_once $basePath . 'src/functions.php';
require_once $basePath . 'src/models/ticket.php';

// Data
require_once $basePath . 'vendor/autoload.php';
//bootstrap twig
$loader = new \Twig\Loader\FilesystemLoader($basePath . '/resources/templates');
$twig = new \Twig\Environment($loader);

$eventName = isset($_GET['eventName']) ? (string) $_GET['eventName'] : '';
$tickets = [];

$connection = getDBConnection();
$stmt = $connection->prepare('SELECT * FROM tickets AS t LEFT JOIN evenements AS e ON t.Evenements_idEvenements = e.idEvenements WHERE e.eventName = ?;');
$stmt->execute([$eventName]);
$eventTickets = $stmt->fetchAllAssociative();

foreach ($eventTickets as $ticket) {
    $tickets[] = new ticket($ticket['ticketName'], $ticket['ticketPrice'], $ticket['amount'], $ticket['reasonForSell']);
}

//View
echo $twig->render('pages/event-tickets.twig', ['tickets' => $tickets]);