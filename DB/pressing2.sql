-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 21 jan. 2025 à 14:45
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pressing2`
--

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

CREATE TABLE `agence` (
  `id_agence` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `telephone` int(11) NOT NULL,
  `localisation` varchar(255) DEFAULT NULL,
  `statut` enum('activer','desactiver') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`id_agence`, `nom`, `telephone`, `localisation`, `statut`) VALUES
(1, 'PRESSING TEST', 699388115, 'tamdja place des fetes', 'activer');

-- --------------------------------------------------------

--
-- Structure de la table `backvetement`
--

CREATE TABLE `backvetement` (
  `ligne` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_typevet` int(11) NOT NULL,
  `id_sort` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `motif` varchar(200) NOT NULL,
  `utilisateur` varchar(100) NOT NULL,
  `date_enreg` date NOT NULL,
  `facture` int(11) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `backvetement`
--

INSERT INTO `backvetement` (`ligne`, `id_client`, `id_typevet`, `id_sort`, `quantite`, `motif`, `utilisateur`, `date_enreg`, `facture`, `agence`) VALUES
(1, 3, 2, 1, 1, 'DESCRIPT', 'achille', '2025-01-19', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `cartefidelite`
--

CREATE TABLE `cartefidelite` (
  `id_carte` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `pourcentage` int(11) NOT NULL,
  `date_enreg` date NOT NULL,
  `montantReduit` int(11) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom_cl` varchar(500) NOT NULL,
  `telephone_cl` int(11) NOT NULL,
  `date_inscription` date NOT NULL,
  `utilisateur` varchar(100) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom_cl`, `telephone_cl`, `date_inscription`, `utilisateur`, `agence`) VALUES
(3, 'domguia flore', 654345465, '2025-01-19', 'achille', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cloturecaisse`
--

CREATE TABLE `cloturecaisse` (
  `id_clot` int(11) NOT NULL,
  `somentre` int(11) NOT NULL,
  `somdep` int(11) NOT NULL,
  `monnet` int(11) NOT NULL,
  `monreel` int(11) NOT NULL,
  `manque` int(11) NOT NULL,
  `observation` varchar(100) NOT NULL,
  `utilisateur` varchar(100) NOT NULL,
  `date_clot` date NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `cloturecaisse`
--

INSERT INTO `cloturecaisse` (`id_clot`, `somentre`, `somdep`, `monnet`, `monreel`, `manque`, `observation`, `utilisateur`, `date_clot`, `agence`) VALUES
(1, 1700, 1000, -1300, 500, -1800, 'Surplus', 'achille', '2025-01-19', 1);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_cmd` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_typevet` int(11) NOT NULL,
  `quantite_cmd` int(11) NOT NULL,
  `description_cmd` varchar(200) NOT NULL,
  `montaverse` int(11) NOT NULL,
  `monttotal` int(11) NOT NULL,
  `date_depot` date NOT NULL,
  `date_retrait` date NOT NULL,
  `utilisateur` varchar(100) NOT NULL,
  `date_enreg_cmd` date NOT NULL,
  `code` int(11) NOT NULL,
  `agence` int(11) NOT NULL,
  `heure` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_cmd`, `id_client`, `id_typevet`, `quantite_cmd`, `description_cmd`, `montaverse`, `monttotal`, `date_depot`, `date_retrait`, `utilisateur`, `date_enreg_cmd`, `code`, `agence`, `heure`) VALUES
(2, 3, 2, 2, 'noir avec les taches blanches', 700, 1400, '2025-01-17', '2025-01-19', 'achille', '2025-01-19', 1, 1, '15:14:08'),
(3, 3, 2, 1, 'autre chaussure', 700, 700, '2025-01-17', '2025-01-19', 'achille', '2025-01-19', 2, 1, '15:20:50');

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `id_compte` int(11) NOT NULL,
  `nom_user` varchar(500) NOT NULL,
  `telephone_user` int(11) NOT NULL,
  `login_user` varchar(500) NOT NULL,
  `mdp_user` varchar(400) NOT NULL,
  `typecompte` varchar(100) NOT NULL,
  `statut` varchar(20) NOT NULL,
  `datecreer` date NOT NULL,
  `agence` int(11) NOT NULL,
  `datenaiss` date DEFAULT NULL,
  `CNI` varchar(255) NOT NULL,
  `pere` varchar(255) NOT NULL,
  `mere` varchar(255) NOT NULL,
  `diplome` varchar(255) NOT NULL,
  `nationalite` varchar(100) NOT NULL,
  `typecontrat` enum('CDD','CDI') NOT NULL,
  `daterecrute` date DEFAULT NULL,
  `obligation` text DEFAULT NULL,
  `poste` varchar(255) NOT NULL,
  `salaire` int(11) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id_compte`, `nom_user`, `telephone_user`, `login_user`, `mdp_user`, `typecompte`, `statut`, `datecreer`, `agence`, `datenaiss`, `CNI`, `pere`, `mere`, `diplome`, `nationalite`, `typecontrat`, `daterecrute`, `obligation`, `poste`, `salaire`, `photo`) VALUES
(9, 'achille tawokam', 696170179, 'achille', '06c1867da481a11ec204e3d3c28a0026', 'admin', 'activer', '0000-00-00', 1, '2025-01-08', '', '', '', 'BTS', '', 'CDD', NULL, NULL, 'Receptionniste', NULL, 'connected_data_big.jpg'),
(19, 'TAWOKAM%20ACHILLE%20SYLVAIN', 672222260, 'moi', '8f8ad28dd6debff410e630ae13436709', 'simple', 'activer', '2025-01-19', 1, '2001-03-16', 'AZIDFEDHCHEZSHEYUUSO', 'KENMOGNE%20EMMANUEL', 'YIMDJO%20ALBERTINE', 'BTS%20', 'CAMEROUNAIS', 'CDI', '2025-01-19', 'Assurer%20la%20reception%20et%20l&#039;enregistrement%20des%20vetements', 'Receptionniste', 600000, '');

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

CREATE TABLE `depense` (
  `id_depense` int(11) NOT NULL,
  `id_dep` int(11) NOT NULL,
  `motif` varchar(1000) NOT NULL,
  `montant` int(11) NOT NULL,
  `date_enreg` date NOT NULL,
  `utilisateur` varchar(500) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `depense`
--

INSERT INTO `depense` (`id_depense`, `id_dep`, `motif`, `montant`, `date_enreg`, `utilisateur`, `agence`) VALUES
(2, 2, 'DERRIE', 1000, '2025-01-19', 'achille', 1);

-- --------------------------------------------------------

--
-- Structure de la table `depotvetement`
--

CREATE TABLE `depotvetement` (
  `id_depot` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_typevet` int(11) NOT NULL,
  `quantite_dep` int(11) NOT NULL,
  `description_dep` varchar(1000) NOT NULL,
  `montaverse` int(11) NOT NULL,
  `monttotal` int(11) NOT NULL,
  `date_depot` date NOT NULL,
  `date_retrait` date NOT NULL,
  `utilisateur` varchar(100) NOT NULL,
  `date_entreg` date NOT NULL,
  `code` int(11) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `dispovetement`
--

CREATE TABLE `dispovetement` (
  `id_depot` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_typevet` int(11) NOT NULL,
  `quantite_dep` int(11) NOT NULL,
  `description_dep` varchar(1000) NOT NULL,
  `montaverse` int(11) NOT NULL,
  `monttotal` int(11) NOT NULL,
  `date_depot` date NOT NULL,
  `date_retrait` date NOT NULL,
  `utilisateur` varchar(100) NOT NULL,
  `date_entreg` date NOT NULL,
  `code` int(11) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `dispovetement`
--

INSERT INTO `dispovetement` (`id_depot`, `id_client`, `id_typevet`, `quantite_dep`, `description_dep`, `montaverse`, `monttotal`, `date_depot`, `date_retrait`, `utilisateur`, `date_entreg`, `code`, `agence`) VALUES
(1, 3, 2, 2, 'noir avec les taches blanches', 700, 1400, '2025-01-17', '2025-01-19', 'achille', '2025-01-19', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `id_facture` int(11) NOT NULL,
  `monttotal` int(11) NOT NULL,
  `avance` int(11) NOT NULL,
  `reste` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `date_depot` date NOT NULL,
  `date_retrait` date NOT NULL,
  `id_client` int(11) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id_facture`, `monttotal`, `avance`, `reste`, `code`, `date_depot`, `date_retrait`, `id_client`, `agence`) VALUES
(1, 1400, 1400, 0, 1, '2025-01-17', '2025-01-19', 3, 1),
(2, 700, 700, 0, 2, '2025-01-17', '2025-01-19', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `facturesupprimer`
--

CREATE TABLE `facturesupprimer` (
  `id_factsupp` int(11) NOT NULL,
  `monttotal` int(11) NOT NULL,
  `avance` int(11) NOT NULL,
  `reste` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `date_depot` date NOT NULL,
  `date_supprimer` date NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `gestse`
--

CREATE TABLE `gestse` (
  `id_ligne` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `ligne` int(11) NOT NULL,
  `message` text NOT NULL,
  `phone` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `agence` int(11) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `operationseffectuees`
--

CREATE TABLE `operationseffectuees` (
  `ligne` int(11) NOT NULL,
  `dateheure` datetime NOT NULL,
  `users` varchar(100) NOT NULL,
  `formulaire` varchar(255) NOT NULL,
  `action` varchar(200) NOT NULL,
  `valeurSaissie` text NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `operationseffectuees`
--

INSERT INTO `operationseffectuees` (`ligne`, `dateheure`, `users`, `formulaire`, `action`, `valeurSaissie`, `agence`) VALUES
(1, '2025-01-19 01:45:18', 'achille tawokam', 'Client', 'Insertion', 'nom:domguia flore, téléphone:656765645', 1),
(2, '2025-01-19 01:45:40', 'achille tawokam', 'Client', 'Modification', 'nom:domguia flore FELICITE, téléphone:656765645', 1),
(3, '2025-01-19 01:46:03', 'achille tawokam', 'Client', 'Suppression', 'nom:domguia flore FELICITE, téléphone:656765645', 1),
(4, '2025-01-19 01:46:26', 'achille tawokam', 'Client', 'Insertion', 'nom:domguia flore, téléphone:644554455', 1),
(5, '2025-01-19 01:47:21', 'achille tawokam', 'Client', 'Modification', 'nom:domguia flore FELICITE, téléphone:644554455', 1),
(6, '2025-01-19 01:47:38', 'achille tawokam', 'Client', 'Suppression', 'nom:domguia flore FELICITE, téléphone:644554455', 1),
(7, '2025-01-19 01:48:02', 'achille tawokam', 'Client', 'Insertion', 'nom:domguia flore, téléphone:654345465', 1),
(8, '2025-01-19 03:11:30', 'achille tawokam', 'Type de vetement', 'Insertion', 'nom:CHAUSSURES, prix:1000', 1),
(9, '2025-01-19 03:12:04', 'achille tawokam', 'Type de vetement', 'Modification', 'nom:CHAUSSURE, prix:1000', 1),
(10, '2025-01-19 03:12:32', 'achille tawokam', 'Type de vetement', 'Suppression', 'nom:CHAUSSURE, prix:1000', 1),
(11, '2025-01-19 03:12:59', 'achille tawokam', 'Type de vetement', 'Insertion', 'nom:CHAUSSURE, prix:700', 1),
(12, '2025-01-19 03:13:59', 'achille tawokam', 'depot vetement', 'Modification', 'prix unitaire:700, quantité:1, description:noir avec les taches blanches, date depot:2025-01-17, date retrait:2025-01-19, montant total:700', 1),
(13, '2025-01-19 03:14:05', 'achille tawokam', 'depot vetement', 'Suppression', 'prix unitaire:700, quantité:1, description:noir avec les taches blanches, date depot:2025-01-17, date retrait:2025-01-19, montant total:700', 1),
(14, '2025-01-19 03:17:08', 'achille tawokam', 'facture', 'Reglement facture', 'code facture :1, Montant versé:1000', 1),
(15, '2025-01-19 03:17:28', 'achille tawokam', ' code facture:1, Sortie vetement', 'Insertion', 'quantité:2, description:noir avec les taches blanches, montant a versé:700, montant total:1400, date depot:2025-01-17, date retrait:2025-01-19', 1),
(16, '2025-01-19 03:18:28', 'achille tawokam', ' code facture:1, Sortie vetement', 'Insertion', 'quantité:1, description:noir avec les taches blanches, montant a versé:0, montant total:0, date depot:2025-01-19, date retrait:2025-01-19', 1),
(17, '2025-01-19 03:18:51', 'achille tawokam', 'Type depense', 'Insertion', 'nom :Orange Money', 1),
(18, '2025-01-19 03:19:11', 'achille tawokam', 'Type depense', 'Modification', 'nom :DETERGENT', 1),
(19, '2025-01-19 03:19:15', 'achille tawokam', 'Type depense', 'Suppression', 'nom :DETERGENT', 1),
(20, '2025-01-19 03:19:23', 'achille tawokam', 'Type depense', 'Insertion', 'nom :DETERGENT', 1),
(21, '2025-01-19 03:19:37', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :DETERGENT, Motif:DER, Montant:1000, date:2025-01-19', 1),
(22, '2025-01-19 03:19:45', 'achille tawokam', 'Depense', 'Modification', 'motif :DERIRE, Montant:1000', 1),
(23, '2025-01-19 03:19:49', 'achille tawokam', 'Depense', 'Suppression', 'Motif :DERIRE, Montant:1000, enregistrer le:2025-01-19', 1),
(24, '2025-01-19 03:20:02', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :DETERGENT, Motif:DERRIE, Montant:1000, date:2025-01-19', 1),
(25, '2025-01-19 03:21:09', 'achille tawokam', ' code facture:2, Sortie vetement', 'Insertion', 'quantité:1, description:autre chaussure, montant a versé:700, montant total:700, date depot:2025-01-17, date retrait:2025-01-19', 1),
(26, '2025-01-19 03:22:31', 'achille tawokam', 'Dette', 'Remboursement', 'code de la facture:2, montant versé:500, Reste:200', 1),
(27, '2025-01-19 03:22:43', 'achille tawokam', 'Dette', 'Remboursement', 'code de la facture:2, montant versé:200, Reste:0', 1),
(28, '2025-01-19 03:22:56', 'achille tawokam', 'Type de versement', 'Insertion', 'nom:Orange Money', 1),
(29, '2025-01-19 03:23:03', 'achille tawokam', 'Type versement', 'Modification', 'nom:Orange Mone', 1),
(30, '2025-01-19 03:23:07', 'achille tawokam', 'Type versement', 'Suppression', 'nom:Orange Mone', 1),
(31, '2025-01-19 03:23:11', 'achille tawokam', 'Type de versement', 'Insertion', 'nom:Orange Money', 1),
(32, '2025-01-19 03:23:27', 'achille tawokam', 'Versement', 'Insertion', 'type de versement::Orange Money, montant versé:2000, Numéro du reçu:123345, date de versement:2025-01-19', 1),
(33, '2025-01-19 03:23:35', 'achille tawokam', 'Versement', 'Modification', 'type de versement:Orange Money, Montant:20000', 1),
(34, '2025-01-19 03:23:42', 'achille tawokam', 'Versement', 'Suppression', 'type de versement:Orange Money, montant:20000, Numéro du reçu:123345, date de versement:2025-01-19', 1),
(35, '2025-01-19 03:23:53', 'achille tawokam', 'Versement', 'Insertion', 'type de versement::Orange Money, montant versé:2000, Numéro du reçu:12345, date de versement:2025-01-19', 1),
(36, '2025-01-19 03:24:48', 'achille tawokam', 'Cloture de caisse', 'Insertion', 'Somme des entrées:1700, somme des depense:1000, montant net:-1300, montant en caisse:500', 1),
(37, '2025-01-19 03:24:49', 'achille tawokam', 'Cloture caisse', 'Report de caisse', 'Montant en caisse:500, reporter pour le:2025/01/20', 1);

-- --------------------------------------------------------

--
-- Structure de la table `rechargecf`
--

CREATE TABLE `rechargecf` (
  `id_rech` int(11) NOT NULL,
  `montantPourcent` int(11) NOT NULL,
  `montantFcfa` int(11) NOT NULL,
  `id_carte` int(11) NOT NULL,
  `date_recharge` date NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reglement`
--

CREATE TABLE `reglement` (
  `id_reg` int(11) NOT NULL,
  `restAverse` int(11) NOT NULL,
  `regle` varchar(5) NOT NULL,
  `dette` varchar(5) NOT NULL,
  `date_regle` date NOT NULL,
  `code` int(11) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `reglement`
--

INSERT INTO `reglement` (`id_reg`, `restAverse`, `regle`, `dette`, `date_regle`, `code`, `agence`) VALUES
(1, 1000, 'OUI', 'NON', '2025-01-19', 1, 1),
(2, 0, 'OUI', 'OUI', '2025-01-19', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `salaire`
--

CREATE TABLE `salaire` (
  `ligne` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `montverse` int(11) NOT NULL,
  `agence` int(11) NOT NULL,
  `date_save` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sortivetement`
--

CREATE TABLE `sortivetement` (
  `id_sort` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_typevet` int(11) NOT NULL,
  `quantite_sort` int(11) NOT NULL,
  `description_sort` varchar(1000) NOT NULL,
  `montaverse` int(11) NOT NULL,
  `monttotal` int(11) NOT NULL,
  `date_depot` date NOT NULL,
  `date_retrait` date NOT NULL,
  `utilisateur_sort` varchar(300) NOT NULL,
  `date_sorti` date NOT NULL,
  `code` int(11) NOT NULL,
  `id_cmd` int(11) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `sortivetement`
--

INSERT INTO `sortivetement` (`id_sort`, `id_client`, `id_typevet`, `quantite_sort`, `description_sort`, `montaverse`, `monttotal`, `date_depot`, `date_retrait`, `utilisateur_sort`, `date_sorti`, `code`, `id_cmd`, `agence`) VALUES
(1, 3, 2, 2, 'noir avec les taches blanches', 700, 1400, '2025-01-17', '2025-01-19', 'achille', '2025-01-19', 1, 1, 1),
(2, 3, 2, 1, 'noir avec les taches blanches', 0, 0, '2025-01-19', '2025-01-19', 'achille', '2025-01-19', 1, 2, 1),
(3, 3, 2, 1, 'autre chaussure', 700, 700, '2025-01-17', '2025-01-19', 'achille', '2025-01-19', 2, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `typedepense`
--

CREATE TABLE `typedepense` (
  `id_dep` int(11) NOT NULL,
  `nom_dep` varchar(500) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `typedepense`
--

INSERT INTO `typedepense` (`id_dep`, `nom_dep`, `agence`) VALUES
(2, 'DETERGENT', 1);

-- --------------------------------------------------------

--
-- Structure de la table `typelavage`
--

CREATE TABLE `typelavage` (
  `ligne` int(11) NOT NULL,
  `codefact` int(11) NOT NULL,
  `typelavage` varchar(100) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `typelavage`
--

INSERT INTO `typelavage` (`ligne`, `codefact`, `typelavage`, `agence`) VALUES
(1, 1, 'simple lavage', 1),
(2, 2, 'simple lavage', 1);

-- --------------------------------------------------------

--
-- Structure de la table `typeverseargent`
--

CREATE TABLE `typeverseargent` (
  `id_typevera` int(11) NOT NULL,
  `nom_versa` varchar(500) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `typeverseargent`
--

INSERT INTO `typeverseargent` (`id_typevera`, `nom_versa`, `agence`) VALUES
(2, 'Orange Money', 1);

-- --------------------------------------------------------

--
-- Structure de la table `typevetement`
--

CREATE TABLE `typevetement` (
  `id_typevet` int(11) NOT NULL,
  `nom_vet` varchar(200) NOT NULL,
  `prix_vet` int(11) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `typevetement`
--

INSERT INTO `typevetement` (`id_typevet`, `nom_vet`, `prix_vet`, `agence`) VALUES
(2, 'CHAUSSURE', 700, 1);

-- --------------------------------------------------------

--
-- Structure de la table `verseargent`
--

CREATE TABLE `verseargent` (
  `id_vera` int(11) NOT NULL,
  `id_typevera` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `date_vera` date NOT NULL,
  `utilisateur` varchar(400) NOT NULL,
  `numRecu` varchar(500) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `verseargent`
--

INSERT INTO `verseargent` (`id_vera`, `id_typevera`, `montant`, `date_vera`, `utilisateur`, `numRecu`, `agence`) VALUES
(2, 2, 2000, '2025-01-19', 'achille', '12345', 1);

-- --------------------------------------------------------

--
-- Structure de la table `versement`
--

CREATE TABLE `versement` (
  `id_verse` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `montantv` int(11) NOT NULL,
  `date_verse` date NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `versement`
--

INSERT INTO `versement` (`id_verse`, `code`, `montantv`, `date_verse`, `agence`) VALUES
(1, 1, 400, '2025-01-17', 1),
(2, 1, 1000, '2025-01-19', 1),
(3, 2, 0, '2025-01-17', 1),
(4, 2, 500, '2025-01-19', 1),
(5, 2, 200, '2025-01-19', 1),
(6, 0, 500, '2025-01-20', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agence`
--
ALTER TABLE `agence`
  ADD PRIMARY KEY (`id_agence`);

--
-- Index pour la table `backvetement`
--
ALTER TABLE `backvetement`
  ADD PRIMARY KEY (`ligne`);

--
-- Index pour la table `cartefidelite`
--
ALTER TABLE `cartefidelite`
  ADD PRIMARY KEY (`id_carte`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `cloturecaisse`
--
ALTER TABLE `cloturecaisse`
  ADD PRIMARY KEY (`id_clot`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_cmd`);

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id_compte`);

--
-- Index pour la table `depense`
--
ALTER TABLE `depense`
  ADD PRIMARY KEY (`id_depense`);

--
-- Index pour la table `depotvetement`
--
ALTER TABLE `depotvetement`
  ADD PRIMARY KEY (`id_depot`);

--
-- Index pour la table `dispovetement`
--
ALTER TABLE `dispovetement`
  ADD PRIMARY KEY (`id_depot`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`id_facture`);

--
-- Index pour la table `facturesupprimer`
--
ALTER TABLE `facturesupprimer`
  ADD PRIMARY KEY (`id_factsupp`);

--
-- Index pour la table `gestse`
--
ALTER TABLE `gestse`
  ADD PRIMARY KEY (`id_ligne`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`ligne`);

--
-- Index pour la table `operationseffectuees`
--
ALTER TABLE `operationseffectuees`
  ADD PRIMARY KEY (`ligne`);

--
-- Index pour la table `rechargecf`
--
ALTER TABLE `rechargecf`
  ADD PRIMARY KEY (`id_rech`);

--
-- Index pour la table `reglement`
--
ALTER TABLE `reglement`
  ADD PRIMARY KEY (`id_reg`);

--
-- Index pour la table `salaire`
--
ALTER TABLE `salaire`
  ADD PRIMARY KEY (`ligne`);

--
-- Index pour la table `sortivetement`
--
ALTER TABLE `sortivetement`
  ADD PRIMARY KEY (`id_sort`);

--
-- Index pour la table `typedepense`
--
ALTER TABLE `typedepense`
  ADD PRIMARY KEY (`id_dep`);

--
-- Index pour la table `typelavage`
--
ALTER TABLE `typelavage`
  ADD PRIMARY KEY (`ligne`);

--
-- Index pour la table `typeverseargent`
--
ALTER TABLE `typeverseargent`
  ADD PRIMARY KEY (`id_typevera`);

--
-- Index pour la table `typevetement`
--
ALTER TABLE `typevetement`
  ADD PRIMARY KEY (`id_typevet`);

--
-- Index pour la table `verseargent`
--
ALTER TABLE `verseargent`
  ADD PRIMARY KEY (`id_vera`);

--
-- Index pour la table `versement`
--
ALTER TABLE `versement`
  ADD PRIMARY KEY (`id_verse`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `backvetement`
--
ALTER TABLE `backvetement`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `cloturecaisse`
--
ALTER TABLE `cloturecaisse`
  MODIFY `id_clot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_cmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `depense`
--
ALTER TABLE `depense`
  MODIFY `id_depense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `depotvetement`
--
ALTER TABLE `depotvetement`
  MODIFY `id_depot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `dispovetement`
--
ALTER TABLE `dispovetement`
  MODIFY `id_depot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_facture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `facturesupprimer`
--
ALTER TABLE `facturesupprimer`
  MODIFY `id_factsupp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gestse`
--
ALTER TABLE `gestse`
  MODIFY `id_ligne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `operationseffectuees`
--
ALTER TABLE `operationseffectuees`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `reglement`
--
ALTER TABLE `reglement`
  MODIFY `id_reg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `salaire`
--
ALTER TABLE `salaire`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sortivetement`
--
ALTER TABLE `sortivetement`
  MODIFY `id_sort` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `typedepense`
--
ALTER TABLE `typedepense`
  MODIFY `id_dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typelavage`
--
ALTER TABLE `typelavage`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typeverseargent`
--
ALTER TABLE `typeverseargent`
  MODIFY `id_typevera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `typevetement`
--
ALTER TABLE `typevetement`
  MODIFY `id_typevet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `verseargent`
--
ALTER TABLE `verseargent`
  MODIFY `id_vera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `versement`
--
ALTER TABLE `versement`
  MODIFY `id_verse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
