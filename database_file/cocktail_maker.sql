-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 04 déc. 2024 à 20:47
-- Version du serveur : 8.0.40-0ubuntu0.24.04.1
-- Version de PHP : 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cocktail_maker`
--

-- --------------------------------------------------------

--
-- Structure de la table `cocktails`
--

CREATE TABLE `cocktails` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `process` varchar(255) DEFAULT NULL,
  `addons` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `elements`
--

CREATE TABLE `elements` (
  `name` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `elements`
--

INSERT INTO `elements` (`name`, `photo`) VALUES
('absolut_vodka', 'https://espace-entreprises.pernod-ricard-france.com/pub/media/catalog/product/7/2/728101_avb_70_cl.jpg'),
('grants whisky', 'https://media.carrefour.fr/medias/0405404d8b6d413baa7224a7a8aa86ce/p_1500x1500/05010327250007_C1N1_s04.jpeg'),
('Gin', 'https://boutique.cocktailsetcie.com/cdn/shop/products/Sanstitre_73.png?v=1669806737'),
('AngosturaBitters', 'https://caviste-lehavre.fr/wp-content/uploads/Angostura-Aromatic-Bitter-200ml-44.7%C2%B0-2.jpg'),
('sweet vermouth', 'https://www.liquor.com/thmb/Pi5doaMv0lHCpvhfPb_EllMob5c=/fit-in/1500x1227/filters:no_upscale():max_bytes(150000):strip_icc()/martini-rosso-04ed6200aaeb4dc7bdfd3743bd93cc14.jpg'),
('tequila', 'https://courses.monoprix.fr/images-v3/0c44253f-c4a3-4340-9d37-d41e42b9d14a/63cb2bad-8d85-4841-9f1b-10c3f0b6d690/500x500.jpg'),
('prosecco', 'https://cdn.mcommerce.franprix.fr/pim-product-images/2899348_0_M1_S1'),
('lemon juice', 'https://tropicalsunfoods.com/cdn/shop/products/TropicalSunLemonJuice200mlSqueezyBottle_1200x1200.jpg?v=1667581292');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cocktails`
--
ALTER TABLE `cocktails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cocktails`
--
ALTER TABLE `cocktails`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
