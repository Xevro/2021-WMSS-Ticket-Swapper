-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mysqldb
-- Gegenereerd op: 14 dec 2020 om 19:52
-- Serverversie: 5.7.32
-- PHP-versie: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketswap`
--
CREATE DATABASE IF NOT EXISTS `ticketswapper` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ticketswapper`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `standard_ticket_price` float(6,2) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `location` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `artist` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `standard_ticket_price`, `start_date`, `end_date`, `location`, `description`, `artist`) VALUES
(1, 'Tomorrowland', 388.00, '2020-07-25 13:00:00', '2020-07-30 01:00:00', 'Boom', 'Crazy awesome festival', 'Martin Garrix, Netsky, Holy Hoof,...'),
(2, ' Rock Werchter', 109.99, '2020-07-01 14:00:00', '2020-07-05 02:00:00', 'Werchter, Belgium', 'Rock Werchter is an annual music festival held in the village of Werchter, near Leuven, Belgium.', 'Pearl Jam, Kendrick Lamar, System Of A Down, The Strokes and more…'),
(3, 'Pukkelpop', 98.00, '2020-05-10 00:00:00', '2020-05-13 00:00:00', 'Hasselt, Belgium', 'Pukkelpop is een jaarlijks terugkerend Belgisch popmuziekfestival in Kiewit, Hasselt. Het festival vindt gewoonlijk plaats in de tweede helft van augustus en duurde tot 2014 drie dagen. In 2015 werd het een vierdaags festival', 'Pearl Jam, Kendrick Lamar, System Of A Down, The Strokes and more…');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `subject` varchar(45) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `contact`
--

INSERT INTO `contact` (`name`, `first_name`, `subject`, `message`) VALUES
('De Bruyne', 'Timon', 'Test subject', 'testing message'),
('uoipop', 'iuop', 'ioup', 'upiooiupo'),
('De Bruynetwee', 'Timontwee', 'This is my subjecttwee', 'this is my second message with my second problem you guys have to fix contact'),
('dsfdfsq', 'qdsf', 'fdsq', 'fsdq'),
('zreer', 'zea', 'esrq', 'fs');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `ticket_name` varchar(100) NOT NULL,
  `ticket_price` float(6,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `reason_for_sell` varchar(255) NOT NULL,
  `ticket_file_location` varchar(300) DEFAULT NULL,
  `events_id_event` int(11) NOT NULL,
  `users_gebruiker_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `ticket_name`, `ticket_price`, `amount`, `reason_for_sell`, `ticket_file_location`, `events_id_event`, `users_gebruiker_id`) VALUES
(1, 'Comboticket', 129.00, 1, 'can\'t go', '/', 1, 1),
(2, 'Day pass', 48.00, 1, 'Have other plans', NULL, 2, 1),
(3, 'Day ticket', 48.00, 2, 'Going on a city trip', NULL, 3, 1),
(4, 'Combi + camping', 730.00, 1, 'Have to work that weekend...', NULL, 1, 1),
(5, 'sd', 3.00, 3, 'sdgqs', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `gebruiker_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `couponcode` varchar(8) NOT NULL,
  `invite_number` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`gebruiker_id`, `first_name`, `last_name`, `address`, `couponcode`, `invite_number`) VALUES
(1, 'Louis', 'D\'Hont', 'Dorp 71A', 'ABCDE', '0');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexen voor tabel `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `fk_tickets_events1_idx` (`events_id_event`),
  ADD KEY `fk_tickets_users1_idx` (`users_gebruiker_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`gebruiker_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `gebruiker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_tickets_events1` FOREIGN KEY (`events_id_event`) REFERENCES `events` (`event_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tickets_users1` FOREIGN KEY (`users_gebruiker_id`) REFERENCES `users` (`gebruiker_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
