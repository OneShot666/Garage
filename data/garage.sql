-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 20 nov. 2022 à 04:18
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `garage`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--
-- Création : dim. 20 nov. 2022 à 01:48
-- Dernière modification : dim. 20 nov. 2022 à 02:59
--

CREATE TABLE `admin` (
  `id` int(12) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `inscription_date` date NOT NULL DEFAULT current_timestamp(),
  `has_rights` tinyint(1) NOT NULL,
  `rights` varchar(100) NOT NULL,
  `actions` text NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONS POUR LA TABLE `admin`:
--

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `inscription_date`, `has_rights`, `rights`, `actions`, `comments`) VALUES
(0, 'One Shot', 'G4r4ge666', '2022-11-20', 1, 'all rights', '', ''),
(1, 'admin', 'p@ssw0rd', '2022-11-20', 1, 'all rights', '', ''),
(2, 'admin2', 'P@ssw0rd2', '2022-11-20', 1, 'all rights', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `car`
--
-- Création : dim. 20 nov. 2022 à 01:56
-- Dernière modification : dim. 20 nov. 2022 à 03:11
--

CREATE TABLE `car` (
  `id` int(12) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `numberplate` int(12) NOT NULL,
  `inscription_date` date NOT NULL DEFAULT current_timestamp(),
  `age` int(12) NOT NULL,
  `color` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONS POUR LA TABLE `car`:
--

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `brand`, `model`, `numberplate`, `inscription_date`, `age`, `color`, `description`) VALUES
(0, 'Citroën ', 'C4', 6218, '2022-11-20', 6, 'grey', ''),
(1, 'Peugeot', '108', 2130, '2022-11-20', 3, 'lightgrey', ''),
(2, 'Peugeot', '208', 6069, '2022-11-20', 2, 'lightgrey', ''),
(3, 'Renault', 'Captur', 1234, '2022-11-20', 5, 'white', ''),
(4, 'Renault', 'Megane', 5764, '2022-11-20', 1, 'lightgrey', ''),
(5, 'Renault', 'Twingo', 1528, '2022-11-20', 3, 'lightblue', ''),
(6, 'Suzuki', 'Across', 3493, '2022-11-20', 5, 'lightgrey', ''),
(7, 'Suzuki', 'Swift', 1989, '2022-11-20', 4, 'red', '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--
-- Création : dim. 20 nov. 2022 à 01:56
-- Dernière modification : dim. 20 nov. 2022 à 03:00
--

CREATE TABLE `user` (
  `id` int(12) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_inscription` date NOT NULL DEFAULT current_timestamp(),
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONS POUR LA TABLE `user`:
--

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `date_inscription`, `comments`) VALUES
(0, 'John Smith', 'johnsmith42', '2022-11-20', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numberplate` (`numberplate`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);


--
-- Métadonnées
--
USE `phpmyadmin`;

--
-- Métadonnées pour la table admin
--

--
-- Métadonnées pour la table car
--

--
-- Métadonnées pour la table user
--

--
-- Métadonnées pour la base de données garage
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
