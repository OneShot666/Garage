-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 18 sep. 2023 à 01:36
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

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
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `inscription_date` date DEFAULT current_timestamp(),
  `has_rights` tinyint(1) NOT NULL DEFAULT 1,
  `rights` varchar(11) NOT NULL DEFAULT '-r--',
  `actions` varchar(500) NOT NULL,
  `comments` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `inscription_date`, `has_rights`, `rights`, `actions`, `comments`) VALUES
(1, 'One Shot', '65df999ac96531a8ae8fa518df88f3c8f253c89d', '2023-03-07', 1, 'arwx', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `length` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `ajout_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `brand`
--

INSERT INTO `brand` (`id`, `brand`, `model`, `length`, `active`, `ajout_date`) VALUES
(1, 'Citroen', 'Berlingo C3 C4 C5', 4, 1, '2023-03-07'),
(2, 'Alfa Romeo', 'Stelvio Tonale', 2, 1, '2023-03-07'),
(3, 'Audi', 'A4 A5 A8 Q3 Q5 Q7', 6, 1, '2023-03-07'),
(4, 'BMW', 'X1 X2 X3 X4 X5 X6 X7', 7, 1, '2023-03-07'),
(5, 'Dacia', 'Duster Sandero Spring Jogger', 4, 1, '2023-03-07'),
(6, 'Fiat', '500C 500X 500L Tipo Panda', 5, 1, '2023-03-07'),
(7, 'Ford', 'Focus Fiesta Mustang Explorer Kuga Mondeo Puma Eco', 8, 1, '2023-03-07'),
(8, 'Mercedes-Benz', 'GLC GLA GLE AMG SL', 5, 1, '2023-03-07'),
(9, 'Nissan', 'X-Trail Micra Qashqai Leaf Juke Ariya Combi', 7, 1, '2023-03-07'),
(10, 'Opel', 'Astra Corsa Mokka Crossland Grandland Insignia Zaf', 7, 1, '2023-03-07'),
(11, 'Peugeot', '108 208 308 408 508', 5, 1, '2023-03-07'),
(12, 'Renault', 'Captur Clio Espace Kangoo Megane Twingo', 6, 1, '2023-03-07'),
(13, 'Seat', 'Leon Ibiza Arona Ateca Tarraco', 5, 1, '2023-03-07'),
(14, 'Suzuki', 'Across Ignis Swift Vitara', 4, 1, '2023-03-07'),
(15, 'Tesla', 'Model3 ModelY ModelX ModelS', 4, 1, '2023-03-07'),
(16, 'Toyota', 'Landcruiser Yaris Corolla Prius Camry CHR SUPRA', 7, 1, '2023-03-07'),
(17, 'Volkswagen', 'Golf Polo Tiguan Touran T-Roc T-Cross Caddy', 7, 1, '2023-03-07');

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

CREATE TABLE `car` (
  `id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `numberplate` varchar(11) NOT NULL DEFAULT '0000',
  `inscription_date` date NOT NULL DEFAULT current_timestamp(),
  `age` int(3) NOT NULL,
  `color` varchar(50) NOT NULL,
  `horsepower` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `car`
--

INSERT INTO `car` (`id`, `brand`, `model`, `numberplate`, `inscription_date`, `age`, `color`, `horsepower`, `price`, `description`) VALUES
(1, 'Citroen', 'C4', '6218', '2021-07-17', 5, 'grise foncée', 70, 22000, 'Une bonne voiture'),
(2, 'Peugeot', '108', '2130', '2018-03-11', 7, 'grise', 60, 12000, 'Maniable mais pas à l&#039;amiable'),
(3, 'Peugeot', '208', '6069', '2023-01-24', 2, 'grise claire', 90, 18500, 'Pratique pour faire des ricochets'),
(4, 'Renault', 'Captur', '1234', '2020-10-29', 4, 'blanche', 120, 24000, 'Ne pas jeter de boules rouges et blanches dessus'),
(5, 'Renault', 'Megane', '5764', '2023-01-06', 3, 'grise claire', 140, 29999, 'Cette voiture n&#039;est pas un renard'),
(6, 'Renault', 'Twingo', '1528', '2020-08-08', 6, 'bleue ciel', 100, 16500, 'Regardez commme elle est mignonne !'),
(7, 'Suzuki', 'Across', '3493', '2022-05-05', 3, 'grise', 160, 55000, 'Dépassez le mur du son ! (et finissez dans un mur)'),
(8, 'Suzuki', 'Swift', '1989', '2022-12-13', 4, 'rouge', 80, 16200, 'Cette voiture ne chante pas !');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `content` varchar(100) NOT NULL,
  `writing_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `phone` int(11) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `inscription_date` date NOT NULL DEFAULT current_timestamp(),
  `favoris` varchar(500) NOT NULL DEFAULT '0',
  `panier` varchar(500) NOT NULL DEFAULT '0',
  `comments` varchar(500) NOT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `nickname`, `username`, `password`, `age`, `phone`, `mail`, `inscription_date`, `favoris`, `panier`, `comments`, `banned`) VALUES
(1, 'John', 'Smith', 'John Smith', '3b842bcd6faab4047ab49f9a99fa0704b9c9d2d7', 42, 0, '', '2023-03-06', '0', '0', '', 0),
(2, 'Nathan', 'Mir', 'OneShot', '78fb8fc1e353093adf70af5c9ccca0bfbb0e4c1c', 21, 921112, '', '2023-03-07', '0 1 4 6 8', '0 7', '', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brand` (`brand`);

--
-- Index pour la table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numberplate` (`numberplate`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
