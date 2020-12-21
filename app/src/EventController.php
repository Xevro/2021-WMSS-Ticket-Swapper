<?php

class EventController {

    protected Doctrine\DBAL\Connection $db;
    protected \Twig\Environment $twig;

    public function __construct() {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }
        $this->user = $_SESSION['user'];
        // bootstrap Twig
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../resources/templates');
        $this->twig = new \Twig\Environment($loader);
        //Database connection
        $this->db = getDBConnection();
    }

    public function home() {
        $events = [];

        //Fetch events
        $searchEvents = isset($_GET['searchEvents']) ? (string)$_GET['searchEvents'] : '';

        if ($searchEvents) {
            $stmt = $this->db->prepare('SELECT * FROM events WHERE event_name LIKE ?');
            $stmt->execute(['%' . $searchEvents . '%']);
            $eventsAssociative = $stmt->fetchAllAssociative();
        } else {
            $stmt = $this->db->prepare('SELECT * FROM events');
            $stmt->execute([]);
            $eventsAssociative = $stmt->fetchAllAssociative();
        }

        foreach ($eventsAssociative as $event) {
            $events[] = new event($event['event_name'], $event['standard_ticket_price'], $event['start_date'], $event['end_date'], $event['location'], $event['description'], $event['artist'], $event['slug']);
        }
        // View
        echo $this->twig->render('pages/index.twig', ['events' => $events, 'searchTerm' => $searchEvents]);
    }

    public function events() {
        $events = [];

        $searchEvents = isset($_GET['searchEvents']) ? (string)$_GET['searchEvents'] : '';

        if ($searchEvents) {
            $stmt = $this->db->prepare('SELECT * FROM events WHERE slug LIKE ?');
            $stmt->execute(['%' . $searchEvents . '%']);
            $eventsAssociative = $stmt->fetchAllAssociative();
        } else {
            $stmt = $this->db->prepare('SELECT * FROM events');
            $stmt->execute([]);
            $eventsAssociative = $stmt->fetchAllAssociative();
        }
        foreach ($eventsAssociative as $event) {
            $events[] = new event($event['event_name'], $event['standard_ticket_price'], $event['start_date'], $event['end_date'], $event['location'], $event['description'], $event['artist'], $event['slug']);
        }
        // View
        echo $this->twig->render('pages/events.twig', ['events' => $events, 'searchTerm' => $searchEvents]);
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
            if ($standardPrice == '0') {
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
                $stmt = $this->db->prepare('INSERT INTO events(event_name, standard_ticket_price, start_date, end_date, location, description, artist, slug) VALUES (?,?,?,?,?,?,?,?)');
                $stmt->execute([$eventName, $standardPrice, date($selectedFormat, strtotime($startDate)), date($selectedFormat, strtotime($endDate)), $location, $description, $artists, str_replace(' ', '', trim(strtolower($eventName)))]);
                header('Location: /');
                exit();
            }
        }
        // View
        echo $this->twig->render('pages/register-event.twig', ['eventName' => $eventName, 'standardPrice' => $standardPrice, 'location' => $location,
            'description' => $description, 'artists' => $artists, 'startDate' => $startDate, 'endDate' => $endDate, 'errorName' => $errorName, 'errorPrice' => $errorPrice, 'errorLocation' => $errorLocation,
            'errorDescription' => $errorDescription, 'errorArtists' => $errorArtists, 'errorStartDate' => $errorStartDate, 'errorEndDate' => $errorEndDate,
            'action' => '/events/register']);
    }

    public function contact() {
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
                $stmt = $connection->prepare('INSERT INTO contact(name, first_name, subject, message) VALUES (?,?,?,?)');
                $stmt->execute([$name, $firstName, $subject, $message]);
                header('Location: /contact');
                exit();
            }
        }

        // View
        echo $this->twig->render('pages/contact.twig', ['name' => $name, 'firstName' => $firstName, 'subject' => $subject,
            'message' => $message, 'errorName' => $errorName, 'errorFirstName' => $errorFirstName, 'errorSubject' => $errorSubject,
            'errorMessage' => $errorMessage, 'action' => '/contact']);
    }

    public function addTicket() {
        $ticketName = isset($_POST['ticketName']) ? (string)$_POST['ticketName'] : '';
        $ticketPrice = isset($_POST['ticketPrice']) ? (float)$_POST['ticketPrice'] : '';
        $amount = isset($_POST['amount']) ? (int)$_POST['amount'] : '';
        $reasonForSell = isset($_POST['reasonForSell']) ? (string)$_POST['reasonForSell'] : '';
        $eventId = isset($_POST['events']) ? (integer)$_POST['events'] : 0;

        $errorName = '';
        $errorPrice = '';
        $errorAmount = '';
        $errorReason = '';
        $errorEvents = '';
        $errorFile = '';
        $events = [];

        $stmt = $this->db->prepare('SELECT event_id, event_name FROM events');
        $stmt->execute([]);
        $eventsDB = $stmt->fetchAllAssociative();

        //fill events array for box
        foreach ($eventsDB as $event) {
            $events[$event['event_id']] = $event;
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
            if ($eventId == 0 && (!in_array($eventId, $events))) {
                $errorEvents = 'This event does not exist';
                $allOk = false;
            }

            $fileTmpName = $_FILES['ticketFile']['tmp_name'];
            $array = explode('.', $_FILES['ticketFile']['name']);
            $fileExtension = strtolower(end($array));
            $imageDirectory = "/tickets/" . basename($fileTmpName . '.' . $fileExtension);
            $uploadDirectory = getcwd() . $imageDirectory;
            $fileExtensionsAllowed = ['jpeg', 'jpg', 'png', 'pdf'];

            // Allow certain file formats
            if (!in_array($fileExtension, $fileExtensionsAllowed)) {
                $errorFile = "Sorry, only JPG, JPEG, PNG & PDF files are allowed.";
                $allOk = false;
            }

            if ($allOk) {
                //add to database
                if (move_uploaded_file($fileTmpName, $uploadDirectory)) {
                    $stmt = $this->db->prepare('INSERT INTO Tickets(ticket_name, ticket_price, amount, ticket_file_location, reason_for_sell, events_id_event, users_gebruiker_id) VALUES (?,?,?,?,?,?,?)');
                    $stmt->execute([$ticketName, $ticketPrice, $amount, $imageDirectory, $reasonForSell, $eventId, $_SESSION['user']['gebruiker_id']]);
                    header('Location: /');
                    exit();
                }
            }
        }
        // View
        echo $this->twig->render('pages/add-ticket.twig', ['ticket_name' => $ticketName, 'ticket_price' => $ticketPrice, 'amount' => $amount,
            'reasonForSell' => $reasonForSell, 'events' => $events, 'eventId' => $eventId, 'errorName' => $errorName, 'errorPrice' => $errorPrice, 'errorAmount' => $errorAmount,
            'errorReason' => $errorReason, 'errorEvents' => $errorEvents, 'errorFile' => $errorFile, 'reason_for_sell' => $reasonForSell, 'action' => '/events/ticket/add']);
    }

    public function eventTickets(string $eventName) {
        $searchTickets = isset($_GET['searchTickets']) ? (string)$_GET['searchTickets'] : '';
        $tickets = [];
        $stmt = $this->db->prepare('SELECT * FROM tickets AS t LEFT JOIN events AS e ON t.events_id_event = e.event_id WHERE e.slug = ?;');
        $stmt->execute([$eventName]);
        $eventTickets = $stmt->fetchAllAssociative();

        foreach ($eventTickets as $ticket) {
            $tickets[] = new ticket($ticket['ticket_id'], $ticket['ticket_name'], $ticket['ticket_price'], $ticket['amount'], $ticket['reason_for_sell']);
        }
        //View
        echo $this->twig->render('pages/event-tickets.twig', ['tickets' => $tickets, 'eventName' => $eventName, 'searchTerm' => $searchTickets]);
    }

    public function ticketInfo(string $eventName, string $id) {
        $stmt = $this->db->prepare('SELECT * FROM tickets AS t LEFT JOIN events AS e ON t.events_id_event = e.event_id WHERE t.ticket_id = ?;');
        $stmt->execute([$id]);
        $eventTicket = $stmt->fetchAssociative();

        $ticketinfo = new ticket($eventTicket['ticket_id'], $eventTicket['ticket_name'], $eventTicket['ticket_price'], $eventTicket['amount'], $eventTicket['reason_for_sell']);
        $eventinfo = new event($eventTicket['event_name'], $eventTicket['standard_ticket_price'], $eventTicket['start_date'], $eventTicket['end_date'], $eventTicket['location'], $eventTicket['description'], $eventTicket['artist'], $eventTicket['slug']);

        //View
        echo $this->twig->render('pages/ticket-info.twig', ['tickets' => $ticketinfo, 'event' => $eventinfo]);
    }
}