-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 27 nov. 2017 à 15:39
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `catalogue`
--
CREATE DATABASE IF NOT EXISTS `catalogue` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `catalogue`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `Id_article` int(11) NOT NULL,
  `NameArticle` varchar(40) NOT NULL,
  `Price` decimal(4,0) NOT NULL,
  `Description` text NOT NULL,
  `Weight` varchar(10) NOT NULL,
  `Img1` varchar(30) NOT NULL,
  `Img2` varchar(30) NOT NULL,
  `Img3` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`Id_article`, `NameArticle`, `Price`, `Description`, `Weight`, `Img1`, `Img2`, `Img3`) VALUES
(2, 'test1', '12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus consectetur diam eu nulla elementum, id maximus tellus euismod. Nullam et ipsum eleifend, vulputate lorem id, suscipit erat.', '12', 'carrot_cake.jpg', 'carrot_cake.jpg', 'carrot_cake.jpg'),
(20, 'test2', '12', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus consectetur diam eu nulla elementum, id maximus tellus euismod. Nullam et ipsum eleifend, vulputate lorem id, suscipit erat.', '500g', 'carrot_cake.jpg', 'carrot_cake.jpg', 'carrot_cake.jpg'),
(21, 'test3', '10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus consectetur diam eu nulla elementum, id maximus tellus euismod. Nullam et ipsum eleifend, vulputate lorem id, suscipit erat.', '500g', 'red.jpg', 'green.jpg', 'red.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `IdCat` int(11) NOT NULL,
  `Name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`IdCat`, `Name`) VALUES
(2, 'tag2'),
(3, 'tag3'),
(7, 'tag7'),
(8, 'tag8'),
(11, 'tag1');

-- --------------------------------------------------------

--
-- Structure de la table `rel_art_cat`
--

CREATE TABLE `rel_art_cat` (
  `IdArt` int(11) NOT NULL,
  `IdCat` int(11) NOT NULL,
  `IdRel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `rel_art_cat`
--

INSERT INTO `rel_art_cat` (`IdArt`, `IdCat`, `IdRel`) VALUES
(2, 3, 40),
(2, 11, 41),
(20, 2, 42),
(21, 2, 44),
(21, 3, 45),
(21, 8, 46);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`Id_article`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`IdCat`);

--
-- Index pour la table `rel_art_cat`
--
ALTER TABLE `rel_art_cat`
  ADD PRIMARY KEY (`IdRel`),
  ADD UNIQUE KEY `rel_art_ca` (`IdArt`,`IdCat`),
  ADD KEY `reltag` (`IdCat`),
  ADD KEY `relart` (`IdArt`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `Id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `IdCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `rel_art_cat`
--
ALTER TABLE `rel_art_cat`
  MODIFY `IdRel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `rel_art_cat`
--
ALTER TABLE `rel_art_cat`
  ADD CONSTRAINT `rel_art` FOREIGN KEY (`IdArt`) REFERENCES `article` (`Id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_cat` FOREIGN KEY (`IdCat`) REFERENCES `category` (`IdCat`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
