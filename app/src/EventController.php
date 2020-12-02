<?php

class EventController{

    protected \Doctrine\DBAL\Connection $db;
    protected \Twig\Environment $twig;

    public function __construct(){
        // bootstrap Twig
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../resources/templates');
        $this->twig = new \Twig\Environment($loader);
    }

    public function home(){
        $connection = getDBConnection();
        $events = [];

//Fetch events
        $searchEvents = isset($_GET['searchEvents']) ? (string) $_GET['searchEvents'] : '';

        if($searchEvents) {
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
}