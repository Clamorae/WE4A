-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 04 Avril 2022 à 16:38
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `raiso ceauci al`
--

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `ID` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_bin NOT NULL,
  `content` varchar(255) COLLATE utf8_bin NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`ID`, `title`, `content`, `Date`, `owner`) VALUES
(17, 'hey', 'look at me i got a new profile pic', '2022-04-02 11:32:05', 9),
(30, 'titre', 'texte', '2022-04-03 15:33:08', 2),
(32, 'Root', 'Je possÃ¨de les droit root je peux donc modifier et supprimÃ© tout les posts', '2022-04-03 15:33:48', 2),
(33, 'hello', 'regardez j\'ai mis des bonnet de noel Ã  tout le monde', '2022-04-03 15:34:22', 3),
(34, 'prÃ©nom', 'Je m\'apelle b et je suis un membre actif', '2022-04-03 15:34:58', 3),
(35, 'inspiration', 'je ne sais plus quoi Ã©crire pour crÃ©er des postes', '2022-04-03 15:36:07', 4),
(36, 'poseidon[edited]', 'je suis le dieu de la mer', '2022-04-03 15:37:09', 5),
(37, 'je', 'suis', '2022-04-03 15:39:05', 6),
(38, 'un', 'Ornithorynque', '2022-04-03 15:39:28', 6),
(39, 'petit chat', 'je suis tout mignon', '2022-04-03 15:40:34', 7),
(40, 'wow', 'so much new people here is anyone speaking english?', '2022-04-03 15:45:32', 9),
(41, 'animal', 'crossing', '2022-04-03 15:58:18', 8),
(42, 'Je suis un artiste', 'tout mes dessins sont magnifique', '2022-04-03 16:01:44', 14),
(43, 'un bon titre', 'un bon post', '2022-04-03 16:02:28', 13),
(44, 'Aidez moi', 'comment ajoutez une image de profile', '2022-04-03 16:03:22', 15),
(45, 'je suis un caillou', 'je me nomme pierre', '2022-04-03 16:04:09', 16),
(46, 'ricochet', 'une fois mon papa m\'a lancÃ© sur un lac pour que je fasse des ricochets', '2022-04-03 16:04:32', 16),
(47, 'a[edited]', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2022-04-03 16:28:29', 2);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Pseudo` varchar(32) COLLATE utf8_bin NOT NULL,
  `Mail` varchar(64) COLLATE utf8_bin NOT NULL,
  `password` varchar(64) COLLATE utf8_bin NOT NULL,
  `root` int(1) NOT NULL DEFAULT '0',
  `image` longblob,
  `image_name` varchar(64) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(2, 'a', 'a@a.a', '0cc175b9c0f1b6a831c399e269772661', 1, NULL, NULL)
INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(3, 'b', 'b@b.b', '92eb5ffee6ae2fec3ad71c777531578f', 0, NULL, NULL)
INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(4, 'b', 'c@c.c', '4a8a08f09d37b73795649038408b5f33', 0, NULL, NULL)
INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(5, 'd', 'd@d.d', '8277e0910d750195b448797616e091ad', 0, NULL, NULL)
INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(6, 'e', 'e@e.e', 'e1671797c52e15f763380b45e841ec32', 0, NULL, NULL )
INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(7, 'f', 'f@f.f', '8fa14cdd754f91cc6554c9e71929cce7', 0, NULL, NULL)
INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(8, 'a', 'z@z.z', 'fbade9e36a3f36d3d676c1b808451dd7', 0, NULL, NULL)
INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(9, 'a', 's@s.s', '03c7c0ace395d80182db07ae2c30f034', 0, NULL, NULL)
INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(13, 'un bon pseudo', 'un.bon@pseudo.com', '0cc175b9c0f1b6a831c399e269772661', 0, NULL, NULL)
INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(14, 'test', 'test@test.test', '098f6bcd4621d373cade4e832627b4f6', 0, NULL, NULL) 
INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(15, 'r', 'r@r.r', '4b43b0aee35624cd95b910189b3dc231', 0, NULL, NULL);
INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(16, 'y', 'y@y.', '415290769594460e2e485922904f345d', 0, NULL, NULL)
INSERT INTO `users` (`ID`, `Pseudo`, `Mail`, `password`, `root`, `image`, `image_name`) VALUES
(17, 'OzEn 7', 'agathe.schoumaker1@gmail.com', '259a00399102078f3f5ae19c1d131f2f', 0, NULL, NULL) 

--
-- Index pour les tables exportées
--

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `owner` (`owner`) USING BTREE;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;