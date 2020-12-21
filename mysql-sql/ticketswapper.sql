-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mysqldb
-- Gegenereerd op: 21 dec 2020 om 23:02
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
-- Database: `ticketswapper`
--

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
('De Bruyne', 'Timon', 'Final test', 'If you see this, the contact form works!');

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
  `artist` varchar(1000) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `standard_ticket_price`, `start_date`, `end_date`, `location`, `description`, `artist`, `slug`) VALUES
(1, 'Tomorrowland', 388.00, '2020-07-25 13:00:00', '2020-07-30 01:00:00', 'Boom, Belgium', 'Crazy awesome festival', 'Martin Garrix, Netsky, Holy Hoof,...', 'tomorrowland'),
(2, 'Rock Werchter', 109.99, '2020-07-01 14:00:00', '2020-07-05 02:00:00', 'Werchter, Belgium', 'Rock Werchter is an annual music festival held in the village of Werchter, near Leuven, Belgium.', 'Pearl Jam, Kendrick Lamar, System Of A Down, The Strokes and more…', 'rockwerchter'),
(3, 'Pukkelpop', 98.00, '2020-05-10 00:00:00', '2020-05-13 00:00:00', 'Hasselt, Belgium', 'Pukkelpop is een jaarlijks terugkerend Belgisch popmuziekfestival in Kiewit, Hasselt. Het festival vindt gewoonlijk plaats in de tweede helft van augustus en duurde tot 2014 drie dagen. In 2015 werd het een vierdaags festival', 'Pearl Jam, Kendrick Lamar, System Of A Down, The Strokes and more…', 'pukkelpop'),
(4, 'Dance D Vision', 50.00, '2020-12-16 18:07:00', '2020-12-16 18:07:00', 'Zottegem, Belgium', 'Dance festival', 'Oliver heldens,...', 'dancedvision'),
(5, 'Graspop', 150.00, '2021-06-17 21:39:00', '2021-06-20 21:39:00', 'Dessel', 'Het paradijs voor de rock- en metalliefhebbers: Graspop. Op dit festival staat het stevige werk centraal met gierende gitaren, een dubbele bass en vernietigende vocalen. De complete wereldtop binnen deze genres heeft al eens op het festival opgetreden. Ook dit jaar weet het festival weer een indrukwekkende selectie aan exclusieve acts te boeken. Dit gepaard met de gemoedelijke sfeer die in Dessel altijd te vinden is, maakt het tot één van de beste festivals in België.', 'Aerosmith, Volbeat, Faith No More, Judas Priest, Korn', 'graspop'),
(6, 'Dour Festival', 95.75, '2021-07-14 21:42:00', '2021-07-18 21:42:00', 'Dour', 'Wanneer je je bezighoudt met wat meer underground artiesten is de keuze voor Dour snel gemaakt. Al jaren staat het festival bekend om de minder commerciële selectie van honderden artiesten binnen een dag- en nachtprogramma. Voorheen werd het affiche voornamelijk gevuld met dj’s en hiphop, maar sinds een aantal jaar kan ook de rocker zich hier thuis voelen. Het festival introduceerde namelijk in 2019 een podium met als missie ‘rock only’. Dour Festival is er eentje voor de rauwdouwers!', 'A$AP Rocky, Amelie Lens, Carl Cox, Palms Trax, Honey Dijon', 'dourfestival'),
(7, 'TW Classic', 45.70, '2021-08-03 21:43:00', '2021-08-08 12:00:00', 'Werchter, Belgium', 'Ondanks dat TW Classic als eendags-festival door het leven gaat is het zeker één van de top festivals in België. Op deze ene dag krijg je als bezoeker een handvol headliner-waardige acts voorgeschoteld. In voorgaande jaren kreeg het festival namen als Guns N’ Roses, The Rolling Stones, Santana en Bruce Springsteen op bezoek. Doordat TW Classic in het leven is geroepen als zusje van Rock Werchter tref je hier verschillende elementen die je ook op Werchter treft. De machtige ingang, ‘The Slope’ en het beruchte frietje stoofvlees. Het is er allemaal!', 'Alt-J, Big Thief, Black Pumas, Twenty One Pilots, The Lumineers, Red Hot Chili Peppers', 'twclassic'),
(8, 'Suikerrock', 95.50, '2021-07-21 21:45:00', '2021-08-01 21:45:00', 'Tienen', 'In tegenstelling tot veel festivals vindt Suikerrock plaats in een stadscentrum. Op het marktplein van Tienen is gezelligheid het uitgangspunt, en dat ontgaat niemand. Het 3-daagse concept kent een rock-dag, pop-dag en familiedag. Op elk van deze dagen is het goed vertoeven voor zowel jong als oud. Dat een zoete wafel en een glas limonade soms plaats maken voor een verfrissend biertje, is dan ook een ongeschreven regel.', 'Tom Jones, De Kreuners, Peter Koelewijn & The Rockets, Mathias Vergels', 'suikerrock'),
(9, 'Les Ardentes', 125.35, '2021-07-08 21:46:00', '2021-07-11 21:46:00', 'Luik', 'Vier dagen lang genieten van de crème de la crème binnen de hiphop. In Luik komen tienduizenden festivalbezoekers bijeen om zich compleet te verliezen in de hardste beats, grootste moshpits en aangename sfeer. Les Ardentes staat bekend om het boeken van simpelweg steengoede artiesten en shows, wat precies is waar jij als bezoeker voor komt. Ook zet de organisatie ieder jaar een aantal onbekende namen op het affiche, waarmee het ook geschikt is voor de bucketlist van de talent-spotters.', 'Future, Bad Bunny, DJ Snake, PNL, Burna Boy, Rae Sremmurd, A$AP Ferg, Cardi B', 'lesardentes'),
(10, 'Couleur Café', 15.00, '2021-06-25 21:47:00', '2021-06-27 21:47:00', 'Brussel', 'Al sinds 1990 brengt Couleur Cafe het beste van funk, hiphop, reggae, soul en heel veel meer ritmische genres. Dit doen ze bij het Atomium in Brussel, waar het aantal culturen in de stad ook een afspiegeling is van het publiek en de artiesten die je op het festival vindt. Couleur Cafe wordt met recht dan ook een multicultureel evenement genoemd. En het gaat verder dan alleen muziek. De vrije urban lifestyle vind je ook terug op de kunsttentoonstelling, een grote markt en aanbod van keukens uit tientallen landen.', 'Fally Ipupa, Dub Inc, Romeo Elvis', 'couleurcafé'),
(11, 'Alcatraz Festival', 75.00, '2021-08-12 21:48:00', '2021-08-15 21:48:00', 'Kortrijk', 'Je hebt hard, harder… en Alcatraz. De volledige naam ‘Alcatraz Hard Rock & Metal Festival’ zegt precies waar het op staat. Het festival boekt enkel de hardste gitaren en hevigste drums. Een hanenkam bij de burgertent of een stagedive tijdens elk optreden is dan ook heel normaal, wat de sfeer er goed inhoudt. Enkele dagen voor de start van het festival vindt er een Heavy Metal Night plaats, waar je in combinatie met een combiticket gratis naar binnen mag. Twee vliegen in één klap!', 'Testament, Heilung, Emperor, Cradle of Filth', 'alcatrazfestival'),
(12, 'Creamfields', 189.00, '2021-08-25 21:49:00', '2021-08-29 21:49:00', 'Daresbury', 'Als een van de twee, of misschien drie, meest prestigieuze dance festivals op onze planeet, nodigt Creamfields altijd wereldberoemde supersterren uit. Wat jouw smaak qua elektronische muziek ook mag zijn, op Creamfields zul je meer vinden dan waar je om vraagt', 'deadmau5, Carl Cox, Martin Garrix, Adam Beyer, Tiësto, Timmy Trumpet, Erix Prydz, Dimitri Vegas & Like Mike', 'creamfields'),
(13, 'Primavera Sound', 35.00, '2021-06-02 21:51:00', '2021-06-06 21:51:00', 'Barcelona, Spanje', 'Als \'Indie King\' en invloedrijke supporter van nieuwe muziek, wordt Primavera Sound geprezen om het vertegenwoordigen van de alternatieve scene. Creativiteit is waar het om draait, met headliners die zich vaak weten te onderscheiden van de rest.', 'The Strokes, Gorillaz, Tame Impala, FKA Twigs, Tyler, the Creator, Jorja Smith, Iggy Pop, Disclosure', 'primaverasound'),
(14, 'Rock am Ring & Rock im Park', 225.00, '2021-06-11 21:52:00', '2021-06-13 21:52:00', 'Mendig en Neurenberg, Duitsland', 'Als rock en heavy metal in jouw ding is, dan heeft Duitsland\'s Rock am Ring geen introductie nodig. Samen met zusterfestival Rock im Park, weet het jaar na jaar ongeëvenaarde line-ups te presenteren en heeft het zichzelf bevestigd als een van de best bezochte weekenden ter wereld.', 'System of a Down, Green Day, Volbeat, Deftones, Billy Talent, Korn, Weezer, Broilers', 'rockamring&rockimpark'),
(15, 'Isle of Wight Festival', 68.00, '2021-06-17 21:53:00', '2021-06-20 21:53:00', 'Isle of Wight', 'Isle of Wight Festival is beroemd om exclusieve, legendarische headliners als Fleetwood Mac, The Stone Roses, Bruce Springsteen, en eclectische line-ups die eerbetoon brengen aan de eigen indrukwekkende geschiedenis van het festival. Inmiddels bestaat het festival meer dan 50 jaar en is IOW sterker dan ooit tevoren.', 'Lionel Richie, Lewis Capaldi, Snow Patrol, Duran Duran, Happy Mondays, Primal Scream, Razorlight, Jess Glynne', 'isleofwightfestival');

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
(1, 'Comboticket', 129.00, 5, 'can\'t go', '/', 1, 1),
(2, 'Day pass', 48.00, 1, 'Have other plans', NULL, 2, 2),
(3, 'Day ticket', 48.00, 2, 'Going on a city trip', NULL, 3, 2),
(4, 'Combi + camping', 730.00, 1, 'Have to work that weekend...', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `gebruiker_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `couponcode` varchar(10) NOT NULL,
  `invite_number` varchar(45) DEFAULT '0',
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`gebruiker_id`, `first_name`, `last_name`, `address`, `couponcode`, `invite_number`, `email`, `password`) VALUES
(1, 'Louis', 'D\'Hont', 'Dorp 71A, Oosterzele', 'sD4oFcma9c', '0', 'dhontlouis@gmail.com', '$2y$10$c1sEgmT2nGWGCZXGybKtuuk4Fsw97niUWrfNd2OlPM/dG46g4K4n2'),
(2, 'Joris', 'Maervoet', 'Gebroeders de Smetstraat 1, 9000 Gent', 'fo2qmt17xr', '0', 'joris.maervoet@odisee.be', '$2y$10$qpMTkVbvc6E.4dt2uk9BlOOadOXiz3J5tqiBwtcmWMupGiX5GiO/q'),
(3, 'Timon', 'De Bruyne', 'randomStraat 9, 9000 Gent', 'f2TIKVJ2KP', '0', 'timon.debruyne@student.odisee.be', '$2y$10$KqrUuDwLRFHEBX/Ul2wEMOthuLZqRYa0cL0xhYaLcknux7jNAETxO');

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
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT voor een tabel `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `gebruiker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
