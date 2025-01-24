-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 24 jan. 2025 à 20:33
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stagefinal`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `noyau_droit`
--

INSERT INTO `noyau_droit` (`noyau_droit__id`, `noyau_droit__sigle`, `noyau_droit__intitule`, `noyau_droit__verrou`) VALUES
(1, 'CREER_CONVENTION', 'Créer une convention', 0),
(4, 'VALIDER_CONVENTION', 'Valider une convention', 0),
(6, 'ASSIGNER_TUTEUR', 'Assigner un tuteur', 0),
(19, 'DISCUTER_PRIVEE', 'Discuter en privée', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `noyau_jointuregroupedroit`
--

INSERT INTO `noyau_jointuregroupedroit` (`noyau_jointuregroupedroit__id`, `noyau_droit__id`, `noyau_groupe__id`, `noyau_jointuregroupedroit__verrou`) VALUES
(10, 1, 1, 0),
(11, 4, 3, 0),
(12, 6, 3, 0),
(13, 19, 2, 0),
(14, 19, 3, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `noyau_jointuregroupeutilisateur`
--

INSERT INTO `noyau_jointuregroupeutilisateur` (`noyau_jointuregroupeutilisateur__id`, `noyau_groupe__id`, `noyau_utilisateur__id`, `noyau_jointuregroupeutilisateur__verrou`) VALUES
(3, 1, 3, NULL),
(4, 1, 4, NULL),
(5, 1, 5, NULL),
(6, 1, 6, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `noyau_jointureutilisateurdroit`
--

INSERT INTO `noyau_jointureutilisateurdroit` (`noyau_jointureutilisateurdroit__id`, `noyau_utilisateur__id`, `noyau_droit__id`, `noyau_jointureutilisateurdroit__verrou`) VALUES
(1, 4, 1, NULL),
(2, 5, 1, NULL),
(3, 6, 1, NULL),
(4, 7, 19, NULL),
(5, 6, 1, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `noyau_utilisateur`
--

INSERT INTO `noyau_utilisateur` (`noyau_utilisateur__id`, `noyau_utilisateur__nom`, `noyau_utilisateur__prenom`, `noyau_utilisateur__sigle`, `noyau_utilisateur__mdp`, `noyau_utilisateur__email`, `noyau_utilisateur__verrou`) VALUES
(7, 'ABOUDOU', 'Miriame', 'etudiant', 'Miriame974', 'ab.miriame@gmail.com', NULL),
(8, 'Lanyeri', 'Rahnya', 'etudiant', 'blabla', 'rahnya@gmail.com', NULL),
(9, 'Pessel', 'Nathalie', 'tuteur_de_stage', 'pasdidee', 'nathalie.pessel@gmail.com', NULL),
(10, 'iscariot', 'Nicolas', 'tuteur_de_stage', 'Nicolaslegoat', 'nicolas.iscariot@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `stage_convention`
--

DROP TABLE IF EXISTS `stage_convention`;
CREATE TABLE IF NOT EXISTS `stage_convention` (
  `stage_convention_id_convention` int NOT NULL AUTO_INCREMENT,
  `stage_convention_siret` int DEFAULT NULL,
  `stage_convention_ape` varchar(255) DEFAULT NULL,
  `stage_convention_nom_entreprise` varchar(255) DEFAULT NULL,
  `stage_convention_tel_entreprise` int DEFAULT NULL,
  `stage_convention_email_entreprise` varchar(255) DEFAULT NULL,
  `stage_convention_nom_signataire_entreprise` varchar(255) DEFAULT NULL,
  `stage_convention_poste_signataire_entreprise` varchar(255) DEFAULT NULL,
  `stage_convention_service_entreprise` varchar(255) DEFAULT NULL,
  `stage_convention_lieu_entreprise` varchar(255) DEFAULT NULL,
  `stage_convention_numero_etudiant` varchar(255) DEFAULT NULL,
  `stage_convention_date_naissance_etudiant` date DEFAULT NULL,
  `stage_convention_tel_etudiant` varchar(255) DEFAULT NULL,
  `stage_convention_email_perso_etudiant` varchar(255) DEFAULT NULL,
  `stage_convention_email_etudiant` varchar(255) DEFAULT NULL,
  `stage_convention_cpam_etudiant` varchar(255) DEFAULT NULL,
  `stage_convention_sujet_stage` text,
  `stage_convention_date_debut` varchar(255) DEFAULT NULL,
  `stage_convention_date_fin` varchar(255) DEFAULT NULL,
  `stage_convention_semaines_stage` int DEFAULT NULL,
  `stage_convention_heures_par_jour_stage` int DEFAULT NULL,
  `stage_convention_repartition` tinyint(1) DEFAULT '0',
  `stage_convention_heures_par_semaine_stage` int DEFAULT NULL,
  `stage_convention_commentaire_stage` text,
  `stage_convention_activites_stage` text,
  `stage_convention_competences_stage` text,
  `stage_convention_nom_maitre_stage` varchar(255) DEFAULT NULL,
  `stage_convention_prenom_maitre_stage` varchar(255) DEFAULT NULL,
  `stage_convention_poste_maitre_stage` varchar(255) DEFAULT NULL,
  `stage_convention_tel_maitre_stage` varchar(255) DEFAULT NULL,
  `stage_convention_email_maitre_stage` varchar(255) DEFAULT NULL,
  `stage_convention_encadrement_stage` varchar(255) DEFAULT NULL,
  `stage_convention_nb_conges` varchar(255) DEFAULT NULL,
  `stage_convention_etat` enum('non soumise','soumise','en attente','validée') DEFAULT NULL,
  `stage_convention_sexe` varchar(255) DEFAULT NULL,
  `stage_convention_gratification` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stage_convention_avantages_5bis` varchar(255) DEFAULT NULL,
  `stage_convention_avantages_5ter` varchar(255) DEFAULT NULL,
  `stage_convention_signature_etudiant` tinyint(1) DEFAULT '0',
  `stage_convention_signature_entreprise` tinyint(1) DEFAULT '0',
  `stage_convention_nom_etudiant` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stage_convention_prenom_etudiant` int NOT NULL,
  `stage_convention_etudiant_id` int DEFAULT NULL,
  `stage_convention_tuteur_id` int DEFAULT NULL,
  `stage_convention_prenom_signataire_entreprise` varchar(255) NOT NULL,
  `stage_convention_nb_jours_stage` varchar(255) NOT NULL,
  PRIMARY KEY (`stage_convention_id_convention`),
  KEY `fk_stage_convention_etudiant` (`stage_convention_etudiant_id`),
  KEY `fk_stage_convention_tuteur` (`stage_convention_tuteur_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `stage_convention`
--

INSERT INTO `stage_convention` (`stage_convention_id_convention`, `stage_convention_siret`, `stage_convention_ape`, `stage_convention_nom_entreprise`, `stage_convention_tel_entreprise`, `stage_convention_email_entreprise`, `stage_convention_nom_signataire_entreprise`, `stage_convention_poste_signataire_entreprise`, `stage_convention_service_entreprise`, `stage_convention_lieu_entreprise`, `stage_convention_numero_etudiant`, `stage_convention_date_naissance_etudiant`, `stage_convention_tel_etudiant`, `stage_convention_email_perso_etudiant`, `stage_convention_email_etudiant`, `stage_convention_cpam_etudiant`, `stage_convention_sujet_stage`, `stage_convention_date_debut`, `stage_convention_date_fin`, `stage_convention_semaines_stage`, `stage_convention_heures_par_jour_stage`, `stage_convention_repartition`, `stage_convention_heures_par_semaine_stage`, `stage_convention_commentaire_stage`, `stage_convention_activites_stage`, `stage_convention_competences_stage`, `stage_convention_nom_maitre_stage`, `stage_convention_prenom_maitre_stage`, `stage_convention_poste_maitre_stage`, `stage_convention_tel_maitre_stage`, `stage_convention_email_maitre_stage`, `stage_convention_encadrement_stage`, `stage_convention_nb_conges`, `stage_convention_etat`, `stage_convention_sexe`, `stage_convention_gratification`, `stage_convention_avantages_5bis`, `stage_convention_avantages_5ter`, `stage_convention_signature_etudiant`, `stage_convention_signature_entreprise`, `stage_convention_nom_etudiant`, `stage_convention_prenom_etudiant`, `stage_convention_etudiant_id`, `stage_convention_tuteur_id`, `stage_convention_prenom_signataire_entreprise`, `stage_convention_nb_jours_stage`) VALUES
(1, 8888, '5555', 'OHMYGLOW', NULL, 'spencetily@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'validée', NULL, '', NULL, NULL, 1, 0, '', 0, 7, 9, '', ''),
(2, 610, NULL, 'Swello', 741020110, 'swello@gmail.com', 'didz', 'rbkep', 'MMI', 'Tln', '12410', NULL, '047741047', 'rahnya@gmail.com', 'rahnya-lanyeri@univ-tln.fr', 'rfved ', 'stage 2e année ', '03/02/2025', '28/03/2025', 8, 6, 0, 30, 'Ce stage va être fantastique !', 'activités liés à MMI ', 'bcp de compétences différentes', 'Noble', 'Jonathan', 'Demi boss', '07410410', 'lej@swello.fr', 'vrzevef', 'aucun', 'validée', 'feminin', '0', 'aucun', 'aucun', 1, 1, 'Lanyeri', 1, 8, 10, 'jknv ', '40'),
(3, 610, NULL, 'Leclerc', 741020110, 'leclerc@gmail.com', 'didz', 'rbkep', 'MMI', 'Tln', '12410', NULL, '047741047', 'mimi@gmail.com', 'miriame-aboudou-lanyeri@univ-tln.fr', 'rfved ', 'stage 2e année ', '03/02/2026', '28/03/2026', 8, 6, 0, 30, 'Ce stage va être fantastique !', 'activités liés à MMI ', 'bcp de compétences différentes', 'panda', 'Mr Panda', 'Demi boss', '07410410', 'lej@leclerc.fr', 'vrzevef', 'aucun', 'validée', 'feminin', '0', 'aucun', 'aucun', 1, 1, 'Aboudou', 1, 7, 10, 'jknv ', '40');

-- --------------------------------------------------------

--
-- Structure de la table `stage_message`
--

DROP TABLE IF EXISTS `stage_message`;
CREATE TABLE IF NOT EXISTS `stage_message` (
  `stage_message_id_message` int NOT NULL AUTO_INCREMENT,
  `stage_message_id_auteur_message` int DEFAULT NULL,
  `stage_message_contenu_message` text,
  `stage_message_privée` tinyint(1) DEFAULT '0',
  `stage_message_stage_id` int NOT NULL,
  PRIMARY KEY (`stage_message_id_message`),
  KEY `fk_stage_message_id_auteur_message` (`stage_message_id_auteur_message`),
  KEY `fk_message_stage` (`stage_message_stage_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `stage_message`
--

INSERT INTO `stage_message` (`stage_message_id_message`, `stage_message_id_auteur_message`, `stage_message_contenu_message`, `stage_message_privée`, `stage_message_stage_id`) VALUES
(18, 7, 'Mon 1er message vers Leclerc', 0, 3),
(19, 7, 'Coucouuuu', 0, 1),
(16, 7, 'Bonjour, est-ce que mon message s\'envoie bien ?', 0, 1),
(17, 7, 'Bonjour, est-ce que mon message s\'envoie bien ?', 0, 1),
(20, 7, 'testetdfghvghugvjghkb', 0, 1),
(21, 10, 'Bonjour est-ce que je parle bien au M ??', 0, 3),
(22, 7, 'Ouiii, rahnya est tjs en train de work pour qu\'on voit qui envoie quel message', 0, 3),
(23, 10, 'bonjour !!', 0, 2),
(24, 10, 'Bonjour, est-ce que mon message s\'envoie bien ? Je suis le tuteur', 0, 2),
(25, 10, 'Je reçois bien le message MOUAHAHAHA', 0, 3),
(26, 8, 'tous les comptes fonctionnent c\'est fantastiiique', 0, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
