<?php
$basePath = __DIR__ . '/../';
use Doctrine\DBAL\Connection;
//require database config & functions

require_once $basePath . 'config/database.php';
require_once $basePath . 'src/models/Ticket.php';
require_once $basePath . 'src/models/Event.php';

function getDBConnection(): Connection {
    $connectionParams = [
        'host' => DB_HOST,
        'dbname' => DB_NAME,
        'user' => DB_USER,
        'password' => DB_PASS,
        'driver' => 'pdo_mysql',
        'charset' => 'utf8mb4'
    ];

    $connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);

    try {
        $connection->connect();
        return $connection;
    } catch (\Doctrine\DBAL\Exception\ConnectionException $e) {
        echo 'Could not connect to database';
        exit;
    }
}