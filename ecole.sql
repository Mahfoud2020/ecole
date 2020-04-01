-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 02 avr. 2020 à 01:19
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `auth`
--

-- --------------------------------------------------------

--
-- Structure de la table `ecole`
--

CREATE TABLE `ecole` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apropos` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20191128061131', '2019-11-28 06:11:48');

-- --------------------------------------------------------

--
-- Structure de la table `programme`
--

CREATE TABLE `programme` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `nom`, `designation`) VALUES
(1, 'Admin', 'administateur'),
(2, 'Etudiant', 'Etudiant'),
(3, 'Parent', 'Parent ou responsable de l etudiant'),
(4, 'Professeur', 'Professeur');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `role_id`, `username`, `email`, `password`, `roles`) VALUES
(3, 2, 'abdou1', 'abdou1@gmail.com', '$2y$13$TQ1xmSGKbKnIBAxai9t7J.vaciNgLRizM8wbDu.jqlLJ2XyUNvPDW', '[\"ROLE_Etudiant\"]'),
(4, 4, 'abdou2', 'abdou2@gmail.com', '$2y$13$m/RwogOu.kZU.bly70m.JeZemloCu1TNeiPmc0GeCIS.yFUGoadVG', '[\"ROLE_Professeur\"]'),
(7, 4, 'abdou4', 'abdou4@gmail.com', '$2y$13$O3ulxGJ5sPqMQMpzb3OSL.grk3c2XxhHw5FU7yURUveVRk.SmYxEy', '[\"ROLE_Professeur\"]'),
(9, NULL, 'mahfoud1', 'mahfoud1@gmail.com', '$2y$13$EG8VuPAZzCX5YU0P7A7R7.f6K1BpHkLKW9kYeEnbNr4WmZrmjrfuC', '[\"ROLE_USER\"]'),
(10, NULL, 'abdou111', 'abdou111@gmail.com', '$2y$13$Q0WRXd2GfJ6gPXbc7JpP5OsEdk5bMrgm/Wl3ZIF/tNsQTMfrorMoq', '[\"ROLE_USER\"]'),
(11, NULL, 'abdou1111', 'abdou1111@gmail.com', '$2y$13$Eiy/yBEhs9f3/JITN1DC9e8FBd63ueQVJbG79YLDxT4DjREBkLrvO', '[\"ROLE_USER\"]'),
(12, NULL, 'abdou777', 'abdou777@gmail.com', '$2y$13$v1keEsXz2NF0UEtueDlSdOToNc25cAwyGPUSeYGr5Z.mqxukPWGui', '[\"ROLE_USER\"]'),
(13, 4, 'abdou200', 'abdou200@gmail.com', '$2y$13$nvyO0.bgdFcOa.kYOM1xs.vB65w/49CsLAOo3wqa8H.qpLEFVATM6', '[\"ROLE_Professeur\"]'),
(14, NULL, 'abdou9', 'abdou9@gmail.com', '$2y$13$0f3.oxwwM4n3ucx7GKuc5.gOvWka5brLvlOlr5LjQ41dHBfjHXvd6', '[\"ROLE_USER\"]');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ecole`
--
ALTER TABLE `ecole`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ecole`
--
ALTER TABLE `ecole`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `programme`
--
ALTER TABLE `programme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
