-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 okt 2023 om 13:55
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `entries`
--

CREATE TABLE `entries` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `admin` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `entries`
--

INSERT INTO `entries` (`id`, `email`, `color`, `admin`, `text`) VALUES
(1, 'voorbeeld@email.com', 'blauw', 1, 'Dit is een voorbeeldtekst'),
(2, 'voorbeeld@email.com', 'blauw', 1, 'Dit is een voorbeeldtekst'),
(3, 'ensar@email.com', 'blauw', 0, 'Dit is een voorbeeldtekst'),
(4, 'ensar@email.com', 'blauw', 0, 'Dit is een voorbeeldtekst'),
(5, 'ensar@email.com', 'blauw', 0, 'Dit is een voorbeeldtekst');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'ensar', '2144169@gmail.com', 'test1231'),
(2, 'ensar', 'eeee@gmail.com', 'test123'),
(3, 'ensar', 'eeee@gmail.com', 'test123'),
(4, 'ensar', 'eeeee@gmail.com', 'test123'),
(5, 'ensar', 'eeeee@gmail.com', 'test123'),
(6, 'ensar', 'eeeeee@gmail.com', 'test123');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `entries`
--
ALTER TABLE `entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `entries`
--
ALTER TABLE `entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
