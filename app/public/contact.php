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

$name = isset($_POST['name']) ? (string)$_POST['name'] : '';
$firstName = isset($_POST['firstName']) ? (string)$_POST['firstName'] : '';
$subject = isset($_POST['subject']) ? (string)$_POST['subject'] : '';
$message = isset($_POST['message']) ? (string)$_POST['message'] : '';


$errorName = '';
$errorFirstName = '';
$errorSubject = '';
$errorMessage = '';

$connection = getDBConnection();

if (isset($_POST['btnRegister'])) {
    $allOk = true;

    if ($name === '') {
        $errorName = 'A valid name is required!';
        $allOk = false;
    }
    if ($firstName === '') {
        $errorFirstName = 'A valid first name is required!';
        $allOk = false;
    }
    if ($subject === '') {
        $errorSubject = 'A valid subject is required!';
        $allOk = false;
    }
    if ($message === '') {
        $errorMessage = 'A valid message is required!';
        $allOk = false;
    }
    if ($allOk) {
        //add to database
        $stmt = $connection->prepare('INSERT INTO Contact(Name, FirstName, Subject, Message) VALUES (?,?,?,?)');
        $stmt->execute([$name, $firstName, $subject, $message]);
        header('Location: contact.php');
        exit();
    }
}

// View
echo $twig->render('pages/contact.twig', ['name' => $name, 'firstName' => $firstName, 'subject' => $subject,
    'message' => $message, 'errorName' => $errorName, 'errorFirstName' => $errorFirstName, 'errorSubject' => $errorSubject,
    'errorMessage' => $errorMessage, 'action' => $_SERVER['PHP_SELF']]);
