CREATE DATABASE IF NOT EXISTS cataloguebd DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
use cataloguebd;

-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mar 27 Octobre 2009 à 12:19
-- Version du serveur: 5.1.37
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `cataloguebd`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteurs`
--

CREATE TABLE IF NOT EXISTS `auteurs` (
  `aut_id` int(11) NOT NULL AUTO_INCREMENT,
  `aut_nom` varchar(255) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`aut_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Structure de la table `bandesdessinees`
--

CREATE TABLE IF NOT EXISTS `bandesdessinees` (
  `bd_id` int(11) NOT NULL AUTO_INCREMENT,
  `bd_titre` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `bd_resume` text COLLATE utf8_general_ci NOT NULL,
  `bd_image` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `bd_auteur_id` int(11) NOT NULL,
  PRIMARY KEY (`bd_id`),
  KEY `fk_aut_bd` (`bd_auteur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=59 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `com_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_bd_id` int(11) NOT NULL,
  `com_mod` tinyint(1) NOT NULL,
  `com_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `com_auteur` varchar(255) COLLATE utf8_general_ci NOT NULL,
  `com_texte` text COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`com_id`),
  KEY `fk_bd_comment` (`com_bd_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Structure de la table `liens_bd_themes`
--

CREATE TABLE IF NOT EXISTS `liens_bd_themes` (
  `lien_bd_id` int(11) NOT NULL,
  `lien_themes_id` int(11) NOT NULL,
  PRIMARY KEY (`lien_bd_id`,`lien_themes_id`),
  KEY `fk_themes_lien` (`lien_themes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
  `th_id` int(11) NOT NULL AUTO_INCREMENT,
  `th_intitule` varchar(255) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`th_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `membre_id` int(11) NOT NULL AUTO_INCREMENT,
  `membre_pseudo` varchar(30) COLLATE utf8_general_ci NOT NULL,
  `membre_mdp` varchar(30) COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`membre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=11 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `bandesdessinees`
--
ALTER TABLE `bandesdessinees`
  ADD CONSTRAINT `fk_aut_bd` FOREIGN KEY (`bd_auteur_id`) REFERENCES `auteurs` (`aut_id`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `fk_bd_comment` FOREIGN KEY (`com_bd_id`) REFERENCES `bandesdessinees` (`bd_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `liens_bd_themes`
--
ALTER TABLE `liens_bd_themes`
  ADD CONSTRAINT `fk_bd_lien` FOREIGN KEY (`lien_bd_id`) REFERENCES `bandesdessinees` (`bd_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_themes_lien` FOREIGN KEY (`lien_themes_id`) REFERENCES `themes` (`th_id`);
