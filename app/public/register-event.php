<?php
// General variables
$basePath = __DIR__ . '/../';

// Data
require_once $basePath . 'vendor/autoload.php';

//bootstrap twig
$loader = new \Twig\Loader\FilesystemLoader($basePath . '/resources/templates');
$twig = new \Twig\Environment($loader);

require_once $basePath . 'src/Models/Event.php';

$eventName = isset($_POST['eventName']) ? (string)$_POST['eventName'] : '';
$standardPrice = isset($_POST['standardPrice']) ? (string)$_POST['standardPrice'] : '';
$location = isset($_POST['location']) ? (string)$_POST['location'] : '';
$description = isset($_POST['description']) ? (string)$_POST['description'] : '';
$artists = isset($_POST['artists']) ? (string)$_POST['artists'] : '';
$errorName = '';
$errorPrice = '';
$errorLocation = '';
$errorDescription = '';
$errorArtists = '';


if (isset($_POST['btnRegister'])) {
    $errors = false;
    if ($eventName === '') {
        $errorName = 'Name is required!';
        $errors = true;
    }

    if ($standardPrice === '') {
        $errorPrice = 'Price is required!';
        $errors = true;
    }

    if ($location === '') {
        $errorLocation = 'Location is required!';
        $errors = true;
    }

    if ($description === '') {
        $errorDescription = 'Description is required!';
        $errors = true;
    }

    if ($artists === '') {
        $errorArtists = 'Artists are required!';
        $errors = true;
    }

    /*$datum = DateTime::createFromFormat('Y-m-d H:i:s', $enddate);
    $errors = DateTime::getLastErrors();
    if (empty($errors['warning_count']) || !empty($errors['error_count'])) {
        $msgDate = 'Please enter a valid date';
        $allOK = false;
    }*/

}




// View
echo $twig->render('pages/register-event.twig', [
    'eventName' => $eventName,
    'standardPrice' => $standardPrice,
    'location' => $location,
    'description' => $description,
    'artists' => $artists,
    'errorName' => $errorName,
    'errorPrice' => $errorPrice,
    'errorLocation' => $errorLocation,
    'errorDescription' => $errorDescription,
    'errorArtists' => $errorArtists,
    'action' => $_SERVER['PHP_SELF']
]);


