-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Gostitelj: 127.0.0.1
-- Čas nastanka: 20. avg 2020 ob 11.20
-- Različica strežnika: 10.4.11-MariaDB
-- Različica PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Zbirka podatkov: `avtonet`
--

-- --------------------------------------------------------

--
-- Struktura tabele `brands`
--

CREATE TABLE `brands` (
  `id_brands` int(11) NOT NULL,
  `brand` varchar(100) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `brands`
--

INSERT INTO `brands` (`id_brands`, `brand`) VALUES
(0, 'Mercedes');

-- --------------------------------------------------------

--
-- Struktura tabele `cars`
--

CREATE TABLE `cars` (
  `id_cars` int(11) NOT NULL,
  `gear_shifts` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `year_of_registration` year(4) NOT NULL,
  `engine` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `id_fuel` int(11) DEFAULT NULL,
  `id_models` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `coments`
--

CREATE TABLE `coments` (
  `id_coments` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `content` text COLLATE utf8_slovenian_ci NOT NULL,
  `id_pictures` int(11) DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `fuel`
--

CREATE TABLE `fuel` (
  `id_fuel` int(11) NOT NULL,
  `fuel_type` varchar(100) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `cities` varchar(100) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `models`
--

CREATE TABLE `models` (
  `id_models` int(11) NOT NULL,
  `model` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `id_brands` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `pictures`
--

CREATE TABLE `pictures` (
  `id_pictures` int(11) NOT NULL,
  `url` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `id_cars` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

-- --------------------------------------------------------

--
-- Struktura tabele `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `first_name` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Odloži podatke za tabelo `users`
--

INSERT INTO `users` (`id_users`, `first_name`, `last_name`, `email`, `pass`) VALUES
(1, 'neki1', 'neki1', 'neki1@neki.com', '$2y$10$iX2gW3bBwL/BCs3CdVyvr.ZcHBZ3MJDyVviuE.xoH9CiT8AaMILRG'),
(2, 'neki', 'neki', 'neki@neki.com', '$2y$10$wPfE4zyZg7T.xIqbqXBptO1tuNrTVr21dIzVY4rwKF5oBU0UpsZlO'),
(7, 'neki2', 'neki2', 'neki2@neki.com', '$2y$10$qbHINkymiNr8QVjPI2eP0uvqevcOPyXskiGNWaa/Sl2jiF3YEaFOC');

--
-- Indeksi zavrženih tabel
--

--
-- Indeksi tabele `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id_brands`);

--
-- Indeksi tabele `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id_cars`),
  ADD KEY `IX_Relationship13` (`id_users`),
  ADD KEY `IX_Relationship15` (`id_fuel`),
  ADD KEY `IX_Relationship16` (`id_models`);

--
-- Indeksi tabele `coments`
--
ALTER TABLE `coments`
  ADD PRIMARY KEY (`id_coments`),
  ADD KEY `IX_Relationship18` (`id_pictures`),
  ADD KEY `IX_Relationship19` (`id_users`);

--
-- Indeksi tabele `fuel`
--
ALTER TABLE `fuel`
  ADD PRIMARY KEY (`id_fuel`);

--
-- Indeksi tabele `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksi tabele `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id_models`),
  ADD KEY `IX_Relationship17` (`id_brands`);

--
-- Indeksi tabele `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id_pictures`),
  ADD KEY `IX_Relationship14` (`id_cars`);

--
-- Indeksi tabele `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `id_users` (`id_users`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT zavrženih tabel
--

--
-- AUTO_INCREMENT tabele `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Omejitve tabel za povzetek stanja
--

--
-- Omejitve za tabelo `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `Relationship13` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`),
  ADD CONSTRAINT `Relationship15` FOREIGN KEY (`id_fuel`) REFERENCES `fuel` (`id_fuel`),
  ADD CONSTRAINT `Relationship16` FOREIGN KEY (`id_models`) REFERENCES `models` (`id_models`);

--
-- Omejitve za tabelo `coments`
--
ALTER TABLE `coments`
  ADD CONSTRAINT `Relationship18` FOREIGN KEY (`id_pictures`) REFERENCES `pictures` (`id_pictures`),
  ADD CONSTRAINT `Relationship19` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`);

--
-- Omejitve za tabelo `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `Relationship17` FOREIGN KEY (`id_brands`) REFERENCES `brands` (`id_brands`);

--
-- Omejitve za tabelo `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `Relationship14` FOREIGN KEY (`id_cars`) REFERENCES `cars` (`id_cars`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
