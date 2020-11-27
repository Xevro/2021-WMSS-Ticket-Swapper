-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mysqldb
-- Gegenereerd op: 27 nov 2020 om 15:26
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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Contact`
--

CREATE TABLE `Contact` (
  `Name` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `Subject` varchar(45) NOT NULL,
  `Message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Contact`
--

INSERT INTO `Contact` (`Name`, `FirstName`, `Subject`, `Message`) VALUES
('De Bruyne', 'Timon', 'Test subject', 'testing message'),
('uoipop', 'iuop', 'ioup', 'upiooiupo'),
('De Bruynetwee', 'Timontwee', 'This is my subjecttwee', 'this is my second message with my second problem you guys have to fix lol');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Evenements`
--

CREATE TABLE `Evenements` (
  `idEvenements` int(11) NOT NULL,
  `eventName` varchar(100) NOT NULL,
  `standardTicketPrice` float(6,2) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `location` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `artists` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Evenements`
--

INSERT INTO `Evenements` (`idEvenements`, `eventName`, `standardTicketPrice`, `startDate`, `endDate`, `location`, `description`, `artists`) VALUES
(1, 'Tomorrowland', 388.00, '2020-07-25 13:00:00', '2020-07-30 01:00:00', 'Boom', 'Crazy awesome festival', 'Martin Garrix, Netsky, Holy Hoof,...'),
(2, ' Rock Werchter', 109.99, '2020-07-01 14:00:00', '2020-07-05 02:00:00', 'Werchter, Belgium', 'Rock Werchter is an annual music festival held in the village of Werchter, near Leuven, Belgium.', 'Pearl Jam, Kendrick Lamar, System Of A Down, The Strokes and more…'),
(3, 'Pukkelpop', 98.00, '2020-05-10 00:00:00', '2020-05-13 00:00:00', 'Hasselt, Belgium', 'Pukkelpop is een jaarlijks terugkerend Belgisch popmuziekfestival in Kiewit, Hasselt. Het festival vindt gewoonlijk plaats in de tweede helft van augustus en duurde tot 2014 drie dagen. In 2015 werd het een vierdaags festival', 'Pearl Jam, Kendrick Lamar, System Of A Down, The Strokes and more…');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Tickets`
--

CREATE TABLE `Tickets` (
  `idTickets` int(11) NOT NULL,
  `ticketName` varchar(100) NOT NULL,
  `ticketPrice` float(6,2) NOT NULL,
  `amount` int(11) NOT NULL,
  `reasonForSell` varchar(255) NOT NULL,
  `ticketFileLocation` varchar(300) DEFAULT NULL,
  `Evenements_idEvenements` int(11) NOT NULL,
  `Users_idGebruikers` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Tickets`
--

INSERT INTO `Tickets` (`idTickets`, `ticketName`, `ticketPrice`, `amount`, `reasonForSell`, `ticketFileLocation`, `Evenements_idEvenements`, `Users_idGebruikers`) VALUES
(1, 'Comboticket', 129.00, 1, 'can\'t go', '/', 1, 1),
(2, 'Day pass', 48.00, 1, 'Have other plans', NULL, 2, 1),
(3, 'Day ticket', 48.00, 2, 'Going on a city trip', NULL, 3, 1),
(4, 'Combi + camping', 730.00, 1, 'Have to work that weekend...', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users`
--

CREATE TABLE `Users` (
  `idGebruikers` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `couponcode` varchar(8) NOT NULL,
  `numberOfInvites` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`idGebruikers`, `firstName`, `lastName`, `address`, `couponcode`, `numberOfInvites`) VALUES
(1, 'Louis', 'D\'Hont', 'Dorp 71A', 'ABCDE', '0');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Evenements`
--
ALTER TABLE `Evenements`
  ADD PRIMARY KEY (`idEvenements`);

--
-- Indexen voor tabel `Tickets`
--
ALTER TABLE `Tickets`
  ADD PRIMARY KEY (`idTickets`),
  ADD KEY `fk_Tickets_Evenements1_idx` (`Evenements_idEvenements`),
  ADD KEY `fk_Tickets_Users1_idx` (`Users_idGebruikers`);

--
-- Indexen voor tabel `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`idGebruikers`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Evenements`
--
ALTER TABLE `Evenements`
  MODIFY `idEvenements` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `Tickets`
--
ALTER TABLE `Tickets`
  MODIFY `idTickets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `idGebruikers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `Tickets`
--
ALTER TABLE `Tickets`
  ADD CONSTRAINT `fk_Tickets_Evenements1` FOREIGN KEY (`Evenements_idEvenements`) REFERENCES `Evenements` (`idEvenements`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Tickets_Users1` FOREIGN KEY (`Users_idGebruikers`) REFERENCES `Users` (`idGebruikers`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
