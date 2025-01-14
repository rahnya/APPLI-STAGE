-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 14 jan. 2025 à 14:43
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

DROP TABLE IF EXISTS `conversations`;
CREATE TABLE IF NOT EXISTS `conversations` (
  `conversation_id` int NOT NULL AUTO_INCREMENT,
  `participant_1_id` int NOT NULL,
  `participant_2_id` int NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`conversation_id`),
  KEY `participant_1_id` (`participant_1_id`),
  KEY `participant_2_id` (`participant_2_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int NOT NULL AUTO_INCREMENT,
  `conversation_id` int NOT NULL,
  `expediteur_id` int NOT NULL,
  `contenu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_envoi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`),
  KEY `conversation_id` (`conversation_id`),
  KEY `expediteur_id` (`expediteur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `noyau_droit`
--

DROP TABLE IF EXISTS `noyau_droit`;
CREATE TABLE IF NOT EXISTS `noyau_droit` (
  `noyau_droit__id` int NOT NULL AUTO_INCREMENT,
  `noyau_droit__sigle` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noyau_droit__intitule` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noyau_droit__verrou` int NOT NULL,
  PRIMARY KEY (`noyau_droit__id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `noyau_droit`
--

INSERT INTO `noyau_droit` (`noyau_droit__id`, `noyau_droit__sigle`, `noyau_droit__intitule`, `noyau_droit__verrou`) VALUES
(1, 'CREER_CONVENTION', 'Créer une convention', 0),
(2, 'SIGNER_CONVENTION', 'Signer une convention validée', 0),
(3, 'MODIFIER_CONVENTION', 'Modifier une convention refusée', 0),
(4, 'VALIDER_CONVENTION', 'Valider une convention', 0),
(5, 'REFUSER_CONVENTION', 'Refuser une convention', 0),
(6, 'ASSIGNER_TUTEUR', 'Assigner un tuteur', 0);

-- --------------------------------------------------------

--
-- Structure de la table `noyau_groupe`
--

DROP TABLE IF EXISTS `noyau_groupe`;
CREATE TABLE IF NOT EXISTS `noyau_groupe` (
  `noyau_groupe__id` int NOT NULL AUTO_INCREMENT,
  `noyau_groupe__sigle` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noyau_groupe__groupeid` int NOT NULL,
  `noyau_groupe__rang` int NOT NULL,
  `noyau_groupe__verrou` int DEFAULT '0',
  PRIMARY KEY (`noyau_groupe__id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `noyau_groupe`
--

INSERT INTO `noyau_groupe` (`noyau_groupe__id`, `noyau_groupe__sigle`, `noyau_groupe__groupeid`, `noyau_groupe__rang`, `noyau_groupe__verrou`) VALUES
(1, 'etudiant', 1, 1, 0),
(2, 'tuteur_de_stage', 2, 2, 0),
(3, 'responsable_de_stage', 3, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `noyau_jointuregroupedroit`
--

DROP TABLE IF EXISTS `noyau_jointuregroupedroit`;
CREATE TABLE IF NOT EXISTS `noyau_jointuregroupedroit` (
  `noyau_jointuregroupedroit__id` int NOT NULL AUTO_INCREMENT,
  `noyau_droit__id` int NOT NULL,
  `noyau_groupe__id` int NOT NULL,
  `noyau_jointuregroupedroit__verrou` int DEFAULT '0',
  PRIMARY KEY (`noyau_jointuregroupedroit__id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `noyau_jointuregroupedroit`
--

INSERT INTO `noyau_jointuregroupedroit` (`noyau_jointuregroupedroit__id`, `noyau_droit__id`, `noyau_groupe__id`, `noyau_jointuregroupedroit__verrou`) VALUES
(2, 1, 1, 0),
(3, 1, 2, 0),
(4, 1, 3, 1),
(5, 2, 2, 0),
(6, 3, 4, 0),
(7, 3, 5, 0),
(8, 3, 6, 0),
(9, 3, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `noyau_jointuregroupeutilisateur`
--

DROP TABLE IF EXISTS `noyau_jointuregroupeutilisateur`;
CREATE TABLE IF NOT EXISTS `noyau_jointuregroupeutilisateur` (
  `noyau_jointuregroupeutilisateur__id` int NOT NULL AUTO_INCREMENT,
  `noyau_groupe__id` int DEFAULT NULL,
  `noyau_utilisateur__id` int DEFAULT NULL,
  `noyau_jointuregroupeutilisateur__verrou` int DEFAULT NULL,
  PRIMARY KEY (`noyau_jointuregroupeutilisateur__id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `noyau_jointureutilisateurdroit`
--

DROP TABLE IF EXISTS `noyau_jointureutilisateurdroit`;
CREATE TABLE IF NOT EXISTS `noyau_jointureutilisateurdroit` (
  `noyau_jointureutilisateurdroit__id` int NOT NULL AUTO_INCREMENT,
  `noyau_utilisateur__id` int DEFAULT NULL,
  `noyau_droit__id` int DEFAULT NULL,
  `noyau_jointureutilisateurdroit__verrou` int DEFAULT NULL,
  PRIMARY KEY (`noyau_jointureutilisateurdroit__id`),
  KEY `utilisateur` (`noyau_utilisateur__id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `noyau_utilisateur`
--

DROP TABLE IF EXISTS `noyau_utilisateur`;
CREATE TABLE IF NOT EXISTS `noyau_utilisateur` (
  `noyau_utilisateur__id` int NOT NULL AUTO_INCREMENT,
  `noyau_utilisateur__nom` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noyau_utilisateur__prenom` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noyau_utilisateur__sigle` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noyau_utilisateur__mdp` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noyau_utilisateur__email` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `noyau_utilisateur__verrou` int DEFAULT NULL,
  PRIMARY KEY (`noyau_utilisateur__id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`participant_1_id`) REFERENCES `noyau_utilisateur` (`noyau_utilisateur__id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`participant_2_id`) REFERENCES `noyau_utilisateur` (`noyau_utilisateur__id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`conversation_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`expediteur_id`) REFERENCES `noyau_utilisateur` (`noyau_utilisateur__id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
