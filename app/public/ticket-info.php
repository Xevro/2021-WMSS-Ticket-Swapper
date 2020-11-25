<?php

// General variables
$basePath = __DIR__ . '/../';
//require database config & functions
require_once $basePath . 'config/database.php';
require_once $basePath . 'src/functions.php';
require_once $basePath . 'src/models/event.php';
require_once $basePath . 'src/models/ticket.php';

// Data
require_once $basePath . 'vendor/autoload.php';
//bootstrap twig
$loader = new \Twig\Loader\FilesystemLoader($basePath . '/resources/templates');
$twig = new \Twig\Environment($loader);

$ticketId = isset($_GET['ticketid']) ? (int) $_GET['ticketid'] : '';

$connection = getDBConnection();
$stmt = $connection->prepare('SELECT * FROM tickets AS t LEFT JOIN evenements AS e ON t.Evenements_idEvenements = e.idEvenements WHERE t.idTickets = ?;'); //OR t.ticketName LIKE ?
$stmt->execute([$ticketId]);
$eventTicket = $stmt->fetchAssociative();


$ticketinfo = new ticket($eventTicket['idTickets'], $eventTicket['ticketName'], $eventTicket['ticketPrice'], $eventTicket['amount'], $eventTicket['reasonForSell']);
$eventinfo = new event($eventTicket['eventName'], $eventTicket['standardTicketPrice'], $eventTicket['startDate'], $eventTicket['endDate'], $eventTicket['location'], $eventTicket['description'], $eventTicket['artists']);

//View
echo $twig->render('pages/ticket-info.twig', ['tickets' => $ticketinfo, 'event' => $eventinfo]);