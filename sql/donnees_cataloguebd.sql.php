USE cataloguebd;
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

--
-- Contenu de la table `auteurs`
--

INSERT INTO `auteurs` (`aut_id`, `aut_nom`) VALUES
(1, 'Uderzo'),
(2, 'Hergé'),
(3, 'Ptiluc'),
(4, 'Bilal'),
(5, 'Manu Larcenet'),
(6, 'Riad Satouf'),
(7, 'Gilbert Delahaye et Marcel Marlier'),
(8, 'Letendre'),
(9, 'Gotlib'),
(11, 'Ptiluc'),
(12, 'Gang/Labourot/Lerolle'),
(13, 'Turf'),
(14, 'Allan Moore'),
(15, 'Ayrolles et Massou'),
(16, 'Winshluss');



--
-- Contenu de la table `bandesdessinees`
--

INSERT INTO `bandesdessinees` (`bd_id`, `bd_titre`, `bd_resume`, `bd_image`, `bd_auteur_id`) VALUES
(3, 'Astérix légionnaire', 'Astérix et Obélix s''engage dans la légion', '9782012101425.jpg', 1),
(4, 'Tintin et le trésor de Rackham le rouge', 'A la recherche de l''héritage du capitaine Hadoock.', '9782203001114.jpg', 2),
(45, 'Animal''Z', 'Histoires croisées aprés une apocalypse nucléaire', '9782203019669.jpg', 4),
(47, 'Martine petit Rat de l''opera', 'Tout est dans le titre', '9782203101227.jpg', 7),
(48, 'La quete de l''oiseau du temps', '', '9782205047981.jpg', 8),
(50, 'Rubrique à Brac', 'Trucs en Vrac', '9782205055726.jpg', 9),
(51, 'Le retour à la terre', 'De la banlieue à la campagne', '9782205057331.jpg', 5),
(55, 'La foire aux cochons', '', '9782226109323.jpg', 3),
(56, 'Les Geeks', '', '9782302003781.jpg', 12),
(57, 'The Watchmen', '', '9782809406412.jpg', 14),
(58, 'Pinocchio', '', '9782849610671.jpg', 16);



--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`com_id`, `com_bd_id`, `com_mod`, `com_date`, `com_auteur`, `com_texte`) VALUES
(1, 45, 0, '2009-10-26 20:29:02', 'Dédé', 'Quelqu''un a vu ma clé à molette'),
(2, 51, 1, '2009-10-26 20:30:20', 'Roror', 'un trés bon choix'),
(3, 4, 1, '2009-10-26 20:50:57', 'Plouf', 'Un grand Classique');



--
-- Contenu de la table `themes`
--

INSERT INTO `themes` (`th_id`, `th_intitule`) VALUES
(1, 'humour'),
(2, 'heroic fantasy'),
(3, 'adulte'),
(4, 'enfant'),
(5, 'sketchs'),
(6, 'série'),
(7, 'science fiction'),
(8, 'médiéval'),
(9, 'Péplum'),
(10, 'Policier');



--
-- Contenu de la table `liens_bd_themes`
--

INSERT INTO `liens_bd_themes` (`lien_bd_id`, `lien_themes_id`) VALUES
(3, 1),
(50, 1),
(51, 1),
(55, 1),
(56, 1),
(58, 1),
(48, 2),
(45, 3),
(55, 3),
(58, 3),
(47, 4),
(50, 5),
(56, 5),
(48, 6),
(57, 6),
(45, 7),
(57, 7),
(3, 9);

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`membre_pseudo`, `membre_mdp`) VALUES
('admin', 'afpa');
