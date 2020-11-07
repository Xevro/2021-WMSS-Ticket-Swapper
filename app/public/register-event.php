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

$eventName = isset($_POST['eventName']) ? (string)$_POST['eventName'] : '';
$standardPrice = isset($_POST['standardPrice']) ? (string)$_POST['standardPrice'] : '';
$location = isset($_POST['location']) ? (string)$_POST['location'] : '';
$description = isset($_POST['description']) ? (string)$_POST['description'] : '';
$artists = isset($_POST['artists']) ? (string)$_POST['artists'] : '';
$startDate = isset($_POST['startdate']) ? (string)$_POST['startdate'] : date("d/m/Y H:i");
$endDate = isset($_POST['enddate']) ? (string)$_POST['enddate'] : date('d/m/Y H:i');

$errorName = '';
$errorPrice = '';
$errorLocation = '';
$errorDescription = '';
$errorArtists = '';
$errorStartDate = '';
$errorEndDate = '';

$connection = getDBConnection();

$stmt = $connection->prepare('SELECT * FROM Evenementen');
$stmt->execute([]);
$eventsAssociative = $stmt->fetchAssociative();



if (isset($_POST['btnRegister'])) {
    $allOk = true;
    $allOkDateStart = true;
    $allOkDateEnd = true;

    $dateformats = ['Y-m-d', 'd-m-Y', 'Y/m/d', 'd/m/Y', 'Y-m-d H:i', 'd-m-Y H:i', 'Y/m/d H:i', 'd/m/Y H:i'];
    for ($i = 0; $i < count($dateformats); $i++) {
        $date = DateTime::createFromFormat($dateformats[$i], $startDate);
        if (!($date !== false)) {
            $errorStartDate = 'Please enter a valid date';
            $allOkDateStart = false;
        } else {
            $allOkDateStart = true;
            $errorStartDate = '';
            break;
        }
    }
    for ($i = 0; $i < count($dateformats); $i++) {
        $dateEnd = DateTime::createFromFormat($dateformats[$i], $endDate);
        if (!($dateEnd !== false)) {
            $errorEndDate = 'Please enter a valid date';
            $allOkDateEnd = false;
        } else {
            $allOkDateEnd = true;
            $errorEndDate = '';
            break;
        }
    }

    if ($eventName === '') {
        $errorName = 'An event name is required!';
        $allOk = false;
    }
    if ($standardPrice === '') {
        $errorPrice = 'A valid price is required!';
        $allOk = false;
    }
    if ($location === '') {
        $errorLocation = 'A location is required!';
        $allOk = false;
    }
    if ($description === '') {
        $errorDescription = 'A description is required!';
        $allOk = false;
    }
    if ($artists === '') {
        $errorArtists = 'Artists is required!';
        $allOk = false;
    }
    if($endDate === '') {
        $errorEndDate = 'Please enter a valid date';
        $allOk = false;
    }

    if($startDate === '') {
        $errorStartDate = 'Please enter a valid date';
        $allOk = false;
    }

    if ($allOk  && $allOkDateStart && $allOkDateEnd) {
        //add to database
        $stmt = $connection->prepare('INSERT INTO Evenementen(Naam, standaard_ticketprijs, Aanvangstijd, Sluitingstijd, Locatie, Beschrijving, Aanwezige_artiesten) VALUES (?,?,?,?,?,?,?)');
        $stmt->execute([$eventName, $standardPrice, $startDate, $endDate, $location, $description, $artists]);
        header('Location: register-event.php');
        exit();
    }
}

// View
echo $twig->render('pages/register-event.twig', ['eventName' => $eventName, 'standardPrice' => $standardPrice, 'location' => $location,
    'description' => $description, 'artists' => $artists, 'startDate' => $startDate, 'endDate' => $endDate, 'errorName' => $errorName, 'errorPrice' => $errorPrice, 'errorLocation' => $errorLocation,
    'errorDescription' => $errorDescription, 'errorArtists' => $errorArtists, 'errorStartDate' => $errorStartDate, 'errorEndDate' => $errorEndDate,
    'action' => $_SERVER['PHP_SELF']]);