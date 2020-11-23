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
$standardPrice = isset($_POST['standardPrice']) ? (float)$_POST['standardPrice'] : '';
$location = isset($_POST['location']) ? (string)$_POST['location'] : '';
$description = isset($_POST['description']) ? (string)$_POST['description'] : '';
$artists = isset($_POST['artists']) ? (string)$_POST['artists'] : '';
$startDate = isset($_POST['startdate']) ? (string)$_POST['startdate'] : date("Y-m-d H:i");
$endDate = isset($_POST['enddate']) ? (string)$_POST['enddate'] : date('Y-m-d H:i');

$errorName = '';
$errorPrice = '';
$errorLocation = '';
$errorDescription = '';
$errorArtists = '';
$errorStartDate = '';
$errorEndDate = '';

$connection = getDBConnection();

if (isset($_POST['btnRegister'])) {
    $allOk = true;
    $allOkDateStart = true;
    $allOkDateEnd = true;

    $selectedFormat = '';
    $dateformats = ['Y-m-d', 'Y/m/d', 'Y-m-d H:i', 'Y/m/d H:i'];
    for ($i = 0; $i < count($dateformats); $i++) {
        $date = DateTime::createFromFormat($dateformats[$i], $startDate);
        if (!($date !== false)) {
            $errorStartDate = 'Please enter a valid date';
            $allOkDateStart = false;
        } else {
            $selectedFormat = $dateformats[$i];
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
            $selectedFormat = $dateformats[$i];
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
    if ($endDate === '') {
        $errorEndDate = 'Please enter a valid date';
        $allOk = false;
    }

    if ($startDate === '') {
        $errorStartDate = 'Please enter a valid date';
        $allOk = false;
    }

    if ($allOk && $allOkDateStart && $allOkDateEnd) {
        //add to database
        $stmt = $connection->prepare('INSERT INTO Evenements(eventName, standardTicketPrice, startDate, endDate, location, description, artists) VALUES (?,?,?,?,?,?,?)');
        $stmt->execute([$eventName, $standardPrice, date($selectedFormat, strtotime($startDate)), date($selectedFormat, strtotime($endDate)), $location, $description, $artists]);
        header('Location: index.php');
        exit();
    }
}

// View
echo $twig->render('pages/register-event.twig', ['eventName' => $eventName, 'standardPrice' => $standardPrice, 'location' => $location,
    'description' => $description, 'artists' => $artists, 'startDate' => $startDate, 'endDate' => $endDate, 'errorName' => $errorName, 'errorPrice' => $errorPrice, 'errorLocation' => $errorLocation,
    'errorDescription' => $errorDescription, 'errorArtists' => $errorArtists, 'errorStartDate' => $errorStartDate, 'errorEndDate' => $errorEndDate,
    'action' => $_SERVER['PHP_SELF']]);