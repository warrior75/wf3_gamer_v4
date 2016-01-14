-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 13 Janvier 2016 à 16:35
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `wf3_gamer`
--

-- --------------------------------------------------------

--
-- Structure de la table `gamers`
--

CREATE TABLE `gamers` (
  `id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expire_token` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `zipcode` varchar(5) NOT NULL,
  `town` varchar(45) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `gamers`
--

INSERT INTO `gamers` (`id`, `email`, `password`, `token`, `expire_token`, `created_at`, `role`, `firstname`, `lastname`, `adresse`, `zipcode`, `town`, `phone`, `lat`, `lng`) VALUES
(2, 'coucou@gmail.com', '$2y$10$RQdOJpsyI7pj175/05tKMeHQQaEH11h17euUSCVSHYDIdya/9dUJW', NULL, NULL, '2016-01-12 10:56:48', 'admin', 'zouzou', 'coucou', '5, place Vendome', '75001', 'paris', '0100000000', NULL, NULL),
(3, 'waryor75@gmail.com', '$2y$10$2RgqInRo6Th5h8ARIPmbHORZeSq1Dw4Wgt3XlEJ.0hXT7H5rglCvG', NULL, NULL, '2016-01-13 14:40:24', 'member', 'man', 'waryor', '10, place de la r&eacute;publique', '75010', 'paris', '0145454545', '48.86723430', '2.36548570');

-- --------------------------------------------------------

--
-- Structure de la table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `url_img` varchar(255) NOT NULL,
  `title` varchar(55) NOT NULL,
  `description` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `platform_id` int(11) DEFAULT NULL,
  `published_at` varchar(55) NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `game_time` int(55) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `games`
--

INSERT INTO `games` (`id`, `url_img`, `title`, `description`, `user_id`, `platform_id`, `published_at`, `is_available`, `game_time`, `created_at`) VALUES
(1, 'http://image.jeuxvideo.com/medias-sm/142054/1420536609-7283-jaquette-avant.jpg', 'Uncharted 4 : A Thief''s End', ' Quatrième opus de la série de jeu d''action/aventure à succès de Naughty Dog, Uncharted 4 A Thief''s End vous permettra d''incarner Nathan Drake pour la première fois sur PS4.', 0, 3, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(2, 'http://image.jeuxvideo.com/images-sm/pc/t/w/twitpc0f.jpg', 'The Witcher', 'The Witcher est un jeu de rôle sur PC, permettant de parcourir l''univers fantastique et féerique à travers le royaume de Temeria.', 0, 1, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(3, 'http://image.jeuxvideo.com/images-sm/jaquettes/00049847/jaquette-the-king-of-fighters-xiii-pc-cover-avant-g-1381247001.jpg', 'The King of Fighters', 'The King of Fighters XIII est un jeu de combat en 2D sur Xbox 360. Le titre propose des affrontements qui voient s''opposer des équipes de 3 combattants', 0, 1, '0000-00-00 00:00:00', 1, 0, '0000-00-00 00:00:00'),
(4, 'http://image.jeuxvideo.com/medias-sm/143533/1435331352-4036-jaquette-avant.jpg', ' Fallout 4', 'Fallout 4 est un RPG à la première personne se déroulant dans un univers post-apocalyptique. Dans un monde dévasté par les bombes', 0, 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(5, 'http://image.jeuxvideo.com/images-sm/jaquettes/00034710/jaquette-grand-theft-auto-v-pc-cover-avant-g-1415122060.jpg', 'Grand Theft Auto V', 'Jeu d''action-aventure en monde ouvert, Grand Theft Auto (GTA) V vous place dans la peau de trois personnages inédits', 0, 2, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(6, 'http://image.jeuxvideo.com/images-sm/jaquettes/00048287/jaquette-assassin-s-creed-unity-pc-cover-avant-g-1407851395.jpg', 'Assassin''s Creed Unity', 'Jeu d''action-aventure en monde ouvert, Assassin''s Creed Unity vous place dans la peau d''Arno Victor Dorian à l''époque de la Révolution française', 0, 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(7, 'http://image.jeuxvideo.com/images-sm/jaquettes/00053818/jaquette-football-manager-2015-pc-cover-avant-g-1407433694.jpg', 'Football Manager 2015', 'Jeu de gestion de football, Football Manager 2015 est dans la droite lignée de ses prédécesseurs mais apporte son lot de nouveautés', 0, 1, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(8, 'http://image.jeuxvideo.com/images-sm/jaquettes/00047879/jaquette-destiny-playstation-4-ps4-cover-avant-g-1410169099.jpg', ' Destiny ', ' Réalisé par les créateurs de la série Halo, Destiny est un FPS dans lequel le joueur se bat dans un contexte futuriste', 0, 3, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(9, 'http://image.jeuxvideo.com/medias-sm/142348/1423477230-4706-jaquette-avant.jpg', 'Xenoblade Chronicles X', 'Xenoblade Chronicles X est un jeu de rôle sur Wii U. Dans ce gigantesque monde ouvert et fantastique, les joueurs peuvent se déplacer et se battre à bord de robots volants baptisés Skells.', 0, 4, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00'),
(10, 'http://image.jeuxvideo.com/medias-sm/141943/1419434381-9404-jaquette-avant.jpg', 'Super mario world', 'super mario youpiiiiiiii', 2, 4, '29/11/2013', 1, 50, '2016-01-13 13:08:02'),
(11, 'http://image.jeuxvideo.com/images-sm/pc/g/o/gowapc0f.jpg', 'gears of war', 'font la guerre', 2, 2, '17/11/2006', 1, 10, '2016-01-13 14:18:58');

-- --------------------------------------------------------

--
-- Structure de la table `plateforme`
--

CREATE TABLE `plateforme` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `plateforme`
--

INSERT INTO `plateforme` (`id`, `name`) VALUES
(1, 'PC'),
(2, 'XBOX ONE'),
(3, 'PS4'),
(4, 'WiiU');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `gamers`
--
ALTER TABLE `gamers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `plateforme`
--
ALTER TABLE `plateforme`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `gamers`
--
ALTER TABLE `gamers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `plateforme`
--
ALTER TABLE `plateforme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
