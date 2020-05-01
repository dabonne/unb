-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le :  mer. 17 oct. 2018 à 16:53
-- Version du serveur :  10.3.9-MariaDB
-- Version de PHP :  5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `revs`
--

-- --------------------------------------------------------

--
-- Structure de la table `activite`
--

DROP TABLE IF EXISTS `activite`;
CREATE TABLE IF NOT EXISTS `activite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `axe_id` int(11) DEFAULT NULL,
  `programme_id` int(11) DEFAULT NULL,
  `natureactivite_id` int(11) DEFAULT NULL,
  `rapport_id` int(11) DEFAULT NULL,
  `montant` int(11) DEFAULT NULL,
  `etat` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statusRapport` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `objectif` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `debut` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_B87555151DFBCC46` (`rapport_id`),
  KEY `IDX_B87555152E30CD41` (`axe_id`),
  KEY `IDX_B875551562BB7AEE` (`programme_id`),
  KEY `IDX_B8755515143ACB5E` (`natureactivite_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`id`, `axe_id`, `programme_id`, `natureactivite_id`, `rapport_id`, `montant`, `etat`, `statusRapport`, `objectif`, `debut`, `fin`) VALUES
(1, 2, NULL, 1, NULL, 12345, 'Attente', 'Pas de rapport', NULL, '2018-06-21 00:00:00', '2018-09-03 00:00:00'),
(2, 2, NULL, 4, NULL, 123578, 'Attente', 'Pas de rapport', NULL, '2018-10-26 00:00:00', '2018-10-20 00:00:00'),
(3, 3, NULL, 3, NULL, 1234567890, 'Attente', 'Pas de rapport', NULL, '2018-10-02 00:00:00', '2018-10-15 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `activite_bailleur`
--

DROP TABLE IF EXISTS `activite_bailleur`;
CREATE TABLE IF NOT EXISTS `activite_bailleur` (
  `activite_id` int(11) NOT NULL,
  `bailleur_id` int(11) NOT NULL,
  PRIMARY KEY (`activite_id`,`bailleur_id`),
  KEY `IDX_E723F69B9B0F88B1` (`activite_id`),
  KEY `IDX_E723F69B57B5D0A2` (`bailleur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `activite_bailleur`
--

INSERT INTO `activite_bailleur` (`activite_id`, `bailleur_id`) VALUES
(1, 2),
(2, 3),
(3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `activite_cible`
--

DROP TABLE IF EXISTS `activite_cible`;
CREATE TABLE IF NOT EXISTS `activite_cible` (
  `activite_id` int(11) NOT NULL,
  `cible_id` int(11) NOT NULL,
  PRIMARY KEY (`activite_id`,`cible_id`),
  KEY `IDX_5F212C329B0F88B1` (`activite_id`),
  KEY `IDX_5F212C32A96E5E09` (`cible_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `activite_cible`
--

INSERT INTO `activite_cible` (`activite_id`, `cible_id`) VALUES
(1, 3),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `activite_localite`
--

DROP TABLE IF EXISTS `activite_localite`;
CREATE TABLE IF NOT EXISTS `activite_localite` (
  `activite_id` int(11) NOT NULL,
  `localite_id` int(11) NOT NULL,
  PRIMARY KEY (`activite_id`,`localite_id`),
  KEY `IDX_684F35C19B0F88B1` (`activite_id`),
  KEY `IDX_684F35C1924DD2B5` (`localite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `activite_localite`
--

INSERT INTO `activite_localite` (`activite_id`, `localite_id`) VALUES
(1, 3),
(2, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `activite_membre_beneficiaire`
--

DROP TABLE IF EXISTS `activite_membre_beneficiaire`;
CREATE TABLE IF NOT EXISTS `activite_membre_beneficiaire` (
  `activite_id` int(11) NOT NULL,
  `membre_beneficiaire_id` int(11) NOT NULL,
  PRIMARY KEY (`activite_id`,`membre_beneficiaire_id`),
  KEY `IDX_87E3927F9B0F88B1` (`activite_id`),
  KEY `IDX_87E3927FF03AA3CD` (`membre_beneficiaire_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `activite_theme`
--

DROP TABLE IF EXISTS `activite_theme`;
CREATE TABLE IF NOT EXISTS `activite_theme` (
  `activite_id` int(11) NOT NULL,
  `theme_id` int(11) NOT NULL,
  PRIMARY KEY (`activite_id`,`theme_id`),
  KEY `IDX_290927019B0F88B1` (`activite_id`),
  KEY `IDX_2909270159027487` (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `activite_theme`
--

INSERT INTO `activite_theme` (`activite_id`, `theme_id`) VALUES
(1, 4),
(2, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `axe_strategique`
--

DROP TABLE IF EXISTS `axe_strategique`;
CREATE TABLE IF NOT EXISTS `axe_strategique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `axe_strategique`
--

INSERT INTO `axe_strategique` (`id`, `intitule`) VALUES
(1, 'Dépistage et Prise En Charge médicale'),
(2, 'Prévention et mobilisation communautaire'),
(3, 'Soutien psycho-sociale et communautaire'),
(4, 'Plaidoyer-Droits humains-Lobby');

-- --------------------------------------------------------

--
-- Structure de la table `bailleur`
--

DROP TABLE IF EXISTS `bailleur`;
CREATE TABLE IF NOT EXISTS `bailleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomBailleur` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `siege` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `bailleur`
--

INSERT INTO `bailleur` (`id`, `nomBailleur`, `siege`, `date`) VALUES
(1, 'AOI', 'BoBo Dioulasso', '2018-04-11 00:00:00'),
(2, 'YELEEN', 'Ouagadougou', '2018-05-20 00:00:00'),
(3, 'FHI360', 'koudougou', '2018-06-21 00:00:00'),
(4, 'FEVE', 'Dori', '2018-07-05 00:00:00'),
(5, 'ESTHER', 'Banfora', '2018-10-04 00:00:00'),
(6, 'AIDES', 'Ziniare', '2018-09-10 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `cible`
--

DROP TABLE IF EXISTS `cible`;
CREATE TABLE IF NOT EXISTS `cible` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomCible` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `cible`
--

INSERT INTO `cible` (`id`, `nomCible`, `date`) VALUES
(1, 'POPULATION GENERALE', '2018-06-07 00:00:00'),
(2, 'POPULATION CLE', '2018-05-11 00:00:00'),
(3, 'TS', '2018-06-12 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `compte_utilisateur`
--

DROP TABLE IF EXISTS `compte_utilisateur`;
CREATE TABLE IF NOT EXISTS `compte_utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `mot_de_passe` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `statut_blocage` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_310DE9E7AA08CB10` (`login`),
  UNIQUE KEY `UNIQ_310DE9E7398F0C51` (`mot_de_passe`),
  UNIQUE KEY `UNIQ_310DE9E7FE42260E` (`statut_blocage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contrat`
--

DROP TABLE IF EXISTS `contrat`;
CREATE TABLE IF NOT EXISTS `contrat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeContrat` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `financement`
--

DROP TABLE IF EXISTS `financement`;
CREATE TABLE IF NOT EXISTS `financement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bailleur_id` int(11) DEFAULT NULL,
  `activite_id` int(11) DEFAULT NULL,
  `natureactivite_id` int(11) DEFAULT NULL,
  `font` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_59895F5657B5D0A2` (`bailleur_id`),
  KEY `IDX_59895F569B0F88B1` (`activite_id`),
  KEY `IDX_59895F56143ACB5E` (`natureactivite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'zongo', 'zongo', 'saoudatouzongo@gmail.com', 'saoudatouzongo@gmail.com', 1, NULL, '$2y$13$2i3v7m5TmhaxkTGYTJdn3u3OdDMqjomrGxT1lhyFrKnlXJO/9AmPm', '2018-10-17 16:38:59', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');

-- --------------------------------------------------------

--
-- Structure de la table `localite`
--

DROP TABLE IF EXISTS `localite`;
CREATE TABLE IF NOT EXISTS `localite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomLocalite` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `localite`
--

INSERT INTO `localite` (`id`, `nomLocalite`, `date`) VALUES
(1, 'Bobo Dioulasso', '2018-02-14 00:00:00'),
(2, 'Dano', '2018-02-07 00:00:00'),
(3, 'Diebougou', '2018-10-05 00:00:00'),
(4, 'Solenzo', '2018-05-11 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `medicament`
--

DROP TABLE IF EXISTS `medicament`;
CREATE TABLE IF NOT EXISTS `medicament` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membre_beneficiaire`
--

DROP TABLE IF EXISTS `membre_beneficiaire`;
CREATE TABLE IF NOT EXISTS `membre_beneficiaire` (
  `id` int(11) NOT NULL,
  `code_d_identification` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type_membre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cible` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `statut_matrimoniale` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `porte_entree` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_d_enfant` int(11) NOT NULL,
  `nom_du_personne_a_prevenir` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom_du_personne_a_prevenir` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse_du_personne_a_prevenir` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `nature_activite`
--

DROP TABLE IF EXISTS `nature_activite`;
CREATE TABLE IF NOT EXISTS `nature_activite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_activite` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `nature_activite`
--

INSERT INTO `nature_activite` (`id`, `nom_activite`) VALUES
(1, 'Dépistage à VIH sites'),
(2, 'Distribution de préservatif'),
(3, 'Causerie éducative'),
(4, 'Distribution de gels');

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

DROP TABLE IF EXISTS `personne`;
CREATE TABLE IF NOT EXISTS `personne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_naissance` datetime NOT NULL,
  `sexe` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` int(11) NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statut` tinyint(1) DEFAULT NULL,
  `adresse` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date_de_depistage` datetime DEFAULT NULL,
  `adhesion` datetime DEFAULT NULL,
  `type_vih` int(11) DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `indicatif` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ethnie` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `religion` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ref_class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FCEC9EFA625945B` (`prenom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `id` int(11) NOT NULL,
  `activite_id` int(11) DEFAULT NULL,
  `compteutilisateur_id` int(11) DEFAULT NULL,
  `contrats_id` int(11) DEFAULT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numero_matricule` int(11) NOT NULL,
  `type_personnel` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `specialite` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `categorie_personnel` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `typeContrat` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateDebutContrat` date NOT NULL,
  `dateDeFinDeContrat` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A6BCF3DE5FA1AA03` (`numero_matricule`),
  UNIQUE KEY `UNIQ_A6BCF3DE87627F1E` (`compteutilisateur_id`),
  UNIQUE KEY `UNIQ_A6BCF3DE6A6193D6` (`contrats_id`),
  KEY `IDX_A6BCF3DE9B0F88B1` (`activite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `programme_activite`
--

DROP TABLE IF EXISTS `programme_activite`;
CREATE TABLE IF NOT EXISTS `programme_activite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rapport_id` int(11) DEFAULT NULL,
  `Nom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Debut` datetime DEFAULT NULL,
  `Fin` datetime DEFAULT NULL,
  `decision` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `statusRapport` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C2C4ACF01DFBCC46` (`rapport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

DROP TABLE IF EXISTS `rapport`;
CREATE TABLE IF NOT EXISTS `rapport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_rapport` datetime NOT NULL,
  `description_de_rapport` longtext COLLATE utf8_unicode_ci NOT NULL,
  `CommentaireRapport` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_BE34A09C87D3A761` (`date_rapport`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomRole` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role_personnel`
--

DROP TABLE IF EXISTS `role_personnel`;
CREATE TABLE IF NOT EXISTS `role_personnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `personnel_id` int(11) DEFAULT NULL,
  `activite_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F74820021C109075` (`personnel_id`),
  KEY `IDX_F74820029B0F88B1` (`activite_id`),
  KEY `IDX_F7482002D60322AC` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomService` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `nomService`, `date`) VALUES
(1, 'Direction', '2018-10-25 00:00:00'),
(2, 'Comptabilite', '2018-04-19 00:00:00'),
(3, 'Systeme Informatique', '2018-03-16 00:00:00'),
(4, 'Ressources Humaines', '2018-01-18 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `compteutilisateur_id` int(11) DEFAULT NULL,
  `date_de_connection` datetime NOT NULL,
  `date_de_deconnection` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D044D5D42BCAAEE9` (`date_de_connection`),
  UNIQUE KEY `UNIQ_D044D5D4FF0698A2` (`date_de_deconnection`),
  KEY `IDX_D044D5D487627F1E` (`compteutilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `intitule`) VALUES
(1, 'DBC'),
(2, 'IST'),
(3, 'VIH/SIDA'),
(4, 'Paludisme');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activite`
--
ALTER TABLE `activite`
  ADD CONSTRAINT `FK_B8755515143ACB5E` FOREIGN KEY (`natureactivite_id`) REFERENCES `nature_activite` (`id`),
  ADD CONSTRAINT `FK_B87555151DFBCC46` FOREIGN KEY (`rapport_id`) REFERENCES `rapport` (`id`),
  ADD CONSTRAINT `FK_B87555152E30CD41` FOREIGN KEY (`axe_id`) REFERENCES `axe_strategique` (`id`),
  ADD CONSTRAINT `FK_B875551562BB7AEE` FOREIGN KEY (`programme_id`) REFERENCES `programme_activite` (`id`);

--
-- Contraintes pour la table `activite_bailleur`
--
ALTER TABLE `activite_bailleur`
  ADD CONSTRAINT `FK_E723F69B57B5D0A2` FOREIGN KEY (`bailleur_id`) REFERENCES `bailleur` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E723F69B9B0F88B1` FOREIGN KEY (`activite_id`) REFERENCES `activite` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `activite_cible`
--
ALTER TABLE `activite_cible`
  ADD CONSTRAINT `FK_5F212C329B0F88B1` FOREIGN KEY (`activite_id`) REFERENCES `activite` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5F212C32A96E5E09` FOREIGN KEY (`cible_id`) REFERENCES `cible` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `activite_localite`
--
ALTER TABLE `activite_localite`
  ADD CONSTRAINT `FK_684F35C1924DD2B5` FOREIGN KEY (`localite_id`) REFERENCES `localite` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_684F35C19B0F88B1` FOREIGN KEY (`activite_id`) REFERENCES `activite` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `activite_membre_beneficiaire`
--
ALTER TABLE `activite_membre_beneficiaire`
  ADD CONSTRAINT `FK_87E3927F9B0F88B1` FOREIGN KEY (`activite_id`) REFERENCES `activite` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_87E3927FF03AA3CD` FOREIGN KEY (`membre_beneficiaire_id`) REFERENCES `membre_beneficiaire` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `activite_theme`
--
ALTER TABLE `activite_theme`
  ADD CONSTRAINT `FK_2909270159027487` FOREIGN KEY (`theme_id`) REFERENCES `theme` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_290927019B0F88B1` FOREIGN KEY (`activite_id`) REFERENCES `activite` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `financement`
--
ALTER TABLE `financement`
  ADD CONSTRAINT `FK_59895F56143ACB5E` FOREIGN KEY (`natureactivite_id`) REFERENCES `nature_activite` (`id`),
  ADD CONSTRAINT `FK_59895F5657B5D0A2` FOREIGN KEY (`bailleur_id`) REFERENCES `bailleur` (`id`),
  ADD CONSTRAINT `FK_59895F569B0F88B1` FOREIGN KEY (`activite_id`) REFERENCES `activite` (`id`);

--
-- Contraintes pour la table `membre_beneficiaire`
--
ALTER TABLE `membre_beneficiaire`
  ADD CONSTRAINT `FK_18EF4073BF396750` FOREIGN KEY (`id`) REFERENCES `personne` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `FK_A6BCF3DE6A6193D6` FOREIGN KEY (`contrats_id`) REFERENCES `contrat` (`id`),
  ADD CONSTRAINT `FK_A6BCF3DE87627F1E` FOREIGN KEY (`compteutilisateur_id`) REFERENCES `compte_utilisateur` (`id`),
  ADD CONSTRAINT `FK_A6BCF3DE9B0F88B1` FOREIGN KEY (`activite_id`) REFERENCES `activite` (`id`),
  ADD CONSTRAINT `FK_A6BCF3DEBF396750` FOREIGN KEY (`id`) REFERENCES `personne` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `programme_activite`
--
ALTER TABLE `programme_activite`
  ADD CONSTRAINT `FK_C2C4ACF01DFBCC46` FOREIGN KEY (`rapport_id`) REFERENCES `rapport` (`id`);

--
-- Contraintes pour la table `role_personnel`
--
ALTER TABLE `role_personnel`
  ADD CONSTRAINT `FK_F74820021C109075` FOREIGN KEY (`personnel_id`) REFERENCES `personnel` (`id`),
  ADD CONSTRAINT `FK_F74820029B0F88B1` FOREIGN KEY (`activite_id`) REFERENCES `activite` (`id`),
  ADD CONSTRAINT `FK_F7482002D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Contraintes pour la table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `FK_D044D5D487627F1E` FOREIGN KEY (`compteutilisateur_id`) REFERENCES `compte_utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
