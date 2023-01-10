-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Généré le :  26 Decembre 2022

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `MapCollab`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `user` VARCHAR(200) COLLATE utf8_bin NOT NULL PRIMARY KEY ,
  `prenom` VARCHAR(200) COLLATE utf8_bin NOT NULL,
  `nom` VARCHAR(200) COLLATE utf8_bin NOT NULL,
  `mail` VARCHAR(200) COLLATE utf8_bin NOT NULL,
  `age` int(11) COLLATE utf8_bin NOT NULL,
  `pays` VARCHAR(200) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=73 ;

--
-- Jeu de tests de la table `utilisateur`
--

INSERT INTO `utilisateur` (`user`, `prenom`, `nom`, `mail`, `age`, `pays`) VALUES
('JB78', 'Julien','Berger', 'julien.berger@free.fr', 25, 'Belgique'),
('K4rlC', 'Karl', 'Carl', 'karl2@gmail.com', 46, 'Royaume-Uni'),
('PontHelene', 'Hélene', 'Pont', 'helene.pont@gmail.com', 32, 'France'),
('Sunchine', 'Anna Lisa', 'Dupont', 'annalisa@yahoo.fr', 16,'France');


--
-- Structure de la table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `user` VARCHAR(200) COLLATE utf8_bin NOT NULL,
  `mdp` VARCHAR(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user`,`mdp`),
  FOREIGN KEY (`user`) REFERENCES utilisateur(`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `login`
--

INSERT INTO `login` (`user`, `mdp`) VALUES
('JB78', 'mdp123'),
('K4rlC', 'KarlKarl'),
('PontHelene', 'Helene!32'),
('Sunchine','soleil321');


--
-- Structure de la table `visite`
--

CREATE TABLE IF NOT EXISTS `visite` (
   `user` VARCHAR(200) COLLATE utf8_bin NOT NULL,
   `id_etab` VARCHAR(200) COLLATE utf8_bin NOT NULL,
   PRIMARY KEY (`user`,`id_etab`),
   FOREIGN KEY (`user`) REFERENCES utilisateur(`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `visite`
--

INSERT INTO `visite` (`user`, `id_etab`) VALUES
('JB78','0782101K'),
('JB78', '0782568T'),
('JB78', '0790169E'),
('JB78','0911708M'),
('K4rlC','0720773Z'),
('K4rlC','0782101K');


--
-- Structure de la table `amis`
--

CREATE TABLE IF NOT EXISTS `amis` (
   `ami1` VARCHAR(200) COLLATE utf8_bin NOT NULL,
   `ami2` VARCHAR(200) COLLATE utf8_bin NOT NULL,
   PRIMARY KEY (`ami1`,`ami2`),
   FOREIGN KEY (`ami1`) REFERENCES utilisateur(`user`),
   FOREIGN KEY (`ami2`) REFERENCES utilisateur(`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `amis`
--

INSERT INTO `amis` (`ami1`, `ami2`) VALUES
('JB78', 'K4rlC'),
('K4rlC', 'JB78'),
('PontHelene', 'K4rlC'),
('K4rlC','PontHelene');

-- --------------------------------------------------------
