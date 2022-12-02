-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 02 déc. 2022 à 02:42
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
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `inscription_date`, `has_rights`, `rights`, `actions`, `comments`) VALUES
(1, 'One Shot', '5ea02a019e424ecba1f7ce679571208228b5fdc7', '2022-11-20', 1, 'arwx', '', ''),
(2, 'admin', '57b2ad99044d337197c0c39fd3823568ff81e48a', '2022-11-20', 1, '-r--', '', ''),
(3, 'admin2', '9e823816a6a507e61b90e00f5be3b695f6896a7d', '2022-11-20', 1, '-r--', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

CREATE TABLE `car` (
  `id` int(12) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `numberplate` int(12) NOT NULL,
  `inscription_date` date NOT NULL DEFAULT current_timestamp(),
  `age` int(12) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `horsepower` int(12) DEFAULT NULL,
  `price` int(12) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `brand`, `model`, `numberplate`, `inscription_date`, `age`, `color`, `horsepower`, `price`, `description`) VALUES
(1, 'Citroen', 'C4', 6218, '2022-11-20', 6, 'grey', 0, 23000, 'Une belle voiture'),
(2, 'Peugeot', '108', 2130, '2022-11-20', 3, '', 108, 12000, ''),
(3, 'Peugeot', '208', 6069, '2022-11-20', 2, 'lightgrey', 0, 16400, ''),
(4, 'Renault', 'Captur', 1234, '2022-11-20', 5, 'white', 0, 23400, 'Ne jetez pas de boule rouge et blanche dessus.'),
(5, 'Renault', 'Megane', 5764, '2022-11-20', 1, '', 0, 32000, 'Renard non inclus'),
(6, 'Renault', 'Twingo', 1528, '2022-11-20', 3, 'lightblue', 180, 15500, ''),
(7, 'Suzuki', 'Across', 3493, '2022-11-20', 5, 'lightgrey', 0, 49999, ''),
(8, 'Suzuki', 'Swift', 1989, '2022-11-20', 4, 'red', 0, 16000, 'Cette voiture ne chante pas !');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `age` int(12) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `inscription_date` datetime NOT NULL DEFAULT current_timestamp(),
  `favoris` varchar(2000) DEFAULT '0',
  `panier` varchar(2000) DEFAULT '0',
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `nickname`, `age`, `phone`, `mail`, `username`, `password`, `inscription_date`, `favoris`, `panier`, `comments`) VALUES
(1, 'John', 'Smith', 42, '123456', 'johnsmith@mail.com', 'John Smith', '0035462a111c24bb831e8b888205dd34f20cfdca', '2022-11-21 00:00:00', '2 4 7', '0 4', NULL),
(2, 'Nathan', 'Mir', 21, '921112', 'mir.nathan42@gmail.com', 'One Shot', '5ea02a019e424ecba1f7ce679571208228b5fdc7', '2022-11-21 00:00:00', '1 6 8', '0', NULL),
(11, 'Momo', 'Amed', 72, '023340', 'momo@amed.nc', 'Julien', 'e6f13a9ef9e4943b41a543069a91cc43c6eb6275', '2022-11-23 00:00:00', '0', '0', NULL);

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
