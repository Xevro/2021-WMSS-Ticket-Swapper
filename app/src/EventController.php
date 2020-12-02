<?php

class EventController {

    protected Doctrine\DBAL\Connection $db;
    protected \Twig\Environment $twig;

    public function __construct() {
        // bootstrap Twig
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../resources/templates');
        $this->twig = new \Twig\Environment($loader);
    }

    public function home() {
        $connection = getDBConnection();
        $events = [];

        //Fetch events
        $searchEvents = isset($_GET['searchEvents']) ? (string)$_GET['searchEvents'] : '';

        if ($searchEvents) {
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
        echo $this->twig->render('pages/index.twig', ['events' => $events, 'searchTerm' => $searchEvents]);
    }

    public function events() {
        $connection = getDBConnection();
        $events = [];

        $stmt = $connection->prepare('SELECT * FROM Evenements');
        $stmt->execute([]);
        $eventsAssociative = $stmt->fetchAllAssociative();

        foreach ($eventsAssociative as $Event) {
            $events[] = new event($Event['eventName'], $Event['standardTicketPrice'], $Event['startDate'], $Event['endDate'], $Event['location'], $Event['description'], $Event['artists']);
        }
        // View
        echo $this->twig->render('pages/events.twig', ['events' => $events]);
    }

    public function registerEvent() {
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
                header('Location: /');
                exit();
            }
        }
        // View
        echo $this->twig->render('pages/register-event.twig', ['eventName' => $eventName, 'standardPrice' => $standardPrice, 'location' => $location,
            'description' => $description, 'artists' => $artists, 'startDate' => $startDate, 'endDate' => $endDate, 'errorName' => $errorName, 'errorPrice' => $errorPrice, 'errorLocation' => $errorLocation,
            'errorDescription' => $errorDescription, 'errorArtists' => $errorArtists, 'errorStartDate' => $errorStartDate, 'errorEndDate' => $errorEndDate,
            'action' => '/register-event']);
    }
}