<?php
// General variables
$basePath = __DIR__ . '/../';
//require database config & functions
require_once $basePath . 'config/database.php';
require_once $basePath . 'src/functions.php';

// Data
require_once $basePath . 'vendor/autoload.php';
//bootstrap twig
$loader = new \Twig\Loader\FilesystemLoader($basePath . '/resources/templates');
$twig = new \Twig\Environment($loader);

$ticketName = isset($_POST['ticketName']) ? (string)$_POST['ticketName'] : '';
$ticketPrice = isset($_POST['ticketPrice']) ? (float)$_POST['ticketPrice'] : '';
$amount = isset($_POST['amount']) ? (int)$_POST['amount'] : '';
$reasonForSell = isset($_POST['reasonForSell']) ? (string)$_POST['reasonForSell'] : '';
$eventName = isset($_POST['events']) ? (integer)$_POST['events'] : 0;

$events = [];

$errorName = '';
$errorPrice = '';
$errorAmount = '';
$errorReason = '';

$connection = getDBConnection();

//Events fetchen
$stmt = $connection->prepare('SELECT idEvenements, eventName FROM Evenements');
$stmt->execute([]);
$eventsDB = $stmt->fetchAllAssociative();

//fill events array for box
foreach ($eventsDB as $event) {
    $events[$event['idEvenements']] = $event;
}
asort($events);


if (isset($_POST['btnRegister'])) {
    $allOk = true;

    if ($ticketName === '') {
        $errorName = 'A valid ticket name is required!';
        $allOk = false;
    }
    if ($ticketPrice == '0') {
        $errorPrice = 'A valid price is required!';
        $allOk = false;
    }
    if ($amount == '0') {
        $errorAmount = 'A valid amount is required!';
        $allOk = false;
    }
    if ($reasonForSell === '') {
        $errorReason = 'A valid reason is required!';
        $allOk = false;
    }
    if (($eventName === '') && (!in_array($eventName, $events['idEvenements']))) {
        $error['$eventName'] = 'This event does not exist';
        $allOK = false;
    }
    if ($allOk) {
        //add to database
        echo $eventName;
        $stmt = $connection->prepare('INSERT INTO Tickets(ticketName, ticketPrice, amount, reasonForSell, Evenements_idEvenements, Users_idGebruikers) VALUES (?,?,?,?, ?, ?)');
        $stmt->execute([$ticketName, $ticketPrice, $amount, $reasonForSell, $eventName, 1]); // change 1 to userid
        header('Location: index.php');
        exit();
    }
}

// View
echo $twig->render('pages/add-ticket.twig', ['ticketName' => $ticketName, 'ticketPrice' => $ticketPrice, 'amount' => $amount,
    'reasonForSell' => $reasonForSell, 'events' => $events, 'event2' => $eventName, 'errorName' => $errorName, 'errorPrice' => $errorPrice, 'errorAmount' => $errorAmount,
    'errorReason' => $errorReason, 'action' => $_SERVER['PHP_SELF']]);