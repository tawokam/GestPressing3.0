-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 03 jan. 2025 à 12:00
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
(1, 'GROUPE STAR.SARL', 699388115, 'baleng a cote de express union baleng', 'activer'),
(2, 'Groupe star madelo', 672222260, 'madelon carrefour le maire', 'desactiver');

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

--
-- Déchargement des données de la table `cartefidelite`
--

INSERT INTO `cartefidelite` (`id_carte`, `id_client`, `pourcentage`, `date_enreg`, `montantReduit`, `agence`) VALUES
(7, 57, 0, '2024-12-12', 14, 1);

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
(57, 'Achille Tawokam', 622554411, '2024-12-12', 'achille', 1),
(58, 'Achille Tawo', 676584454, '2024-12-12', 'achille', 1),
(59, 'fe', 622332211, '2024-12-20', 'achille', 1);

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
(7, 4100, 0, 4100, 500, 3600, 'Manquant', 'achille', '2024-12-20', 1),
(8, 0, 0, 0, 1, -1, 'Surplus', 'achille', '2024-12-19', 1),
(9, 0, 0, 0, 1, -1, 'Surplus', 'achille', '2024-12-18', 1),
(10, 2000, 0, 2000, 2000, 0, 'Exact', 'achille', '2024-12-17', 1),
(11, 11600, 2000, 7600, 7000, 600, 'Manquant', 'achille', '2025-01-03', 1);

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
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_cmd`, `id_client`, `id_typevet`, `quantite_cmd`, `description_cmd`, `montaverse`, `monttotal`, `date_depot`, `date_retrait`, `utilisateur`, `date_enreg_cmd`, `code`, `agence`) VALUES
(379, 58, 27, 2, 'red and blue', 1000, 2000, '2024-12-14', '2024-12-18', '123', '2024-12-14', 1, 2),
(380, 57, 27, 3, 'red and blue', 1000, 3000, '2024-12-14', '2024-12-18', '123', '2024-12-14', 2, 2),
(381, 58, 27, 2, '2', 1000, 2000, '2024-12-11', '2024-12-14', '123', '2024-12-14', 1, 1),
(382, 58, 27, 2, 'red and blue', 1000, 2000, '2024-12-17', '2024-12-20', 'achille', '2024-12-20', 2, 1),
(383, 58, 27, 1, 'red and blue', 1000, 1000, '2024-12-17', '2024-12-20', 'achille', '2024-12-20', 2, 1),
(385, 59, 27, 2, 'red and blue', 1000, 2000, '2024-12-17', '2024-12-20', 'achille', '2024-12-20', 2, 1),
(386, 59, 27, 2, 'red and blue', 1000, 2000, '2024-12-31', '2025-01-03', 'achille', '2024-12-31', 3, 1),
(388, 58, 29, 1, 'red and blue', 200, 200, '2024-12-31', '2025-01-03', 'achille', '2024-12-31', 4, 1),
(389, 59, 29, 2, 'red and blue', 200, 400, '2024-12-31', '2025-01-02', 'achille', '2024-12-31', 5, 1),
(390, 59, 29, 2, 'red and blue', 200, 400, '2024-12-18', '2024-12-13', 'achille', '2024-12-31', 6, 1),
(391, 59, 29, 1, 'red and blue', 200, 200, '2024-12-17', '2024-12-19', 'achille', '2024-12-31', 7, 1),
(392, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(393, 58, 27, 2, '4', 1000, 2000, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(394, 58, 28, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(395, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(396, 58, 28, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(397, 58, 27, 2, '4', 1000, 2000, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(398, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(399, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(400, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(401, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(402, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(403, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(404, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(405, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(406, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(407, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(408, 59, 27, 2, '4', 1000, 2000, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 9, 1),
(409, 58, 29, 1, 'red and blue', 200, 200, '2025-01-03', '2025-01-07', 'achille', '2025-01-03', 10, 1),
(410, 58, 27, 1, 'red and blue', 1000, 1000, '2025-01-02', '2025-01-05', 'achille', '2025-01-03', 11, 1),
(411, 59, 27, 5, 'red and blue', 1000, 5000, '2025-01-01', '2025-01-17', 'achille', '2025-01-03', 12, 1);

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
  `salaire` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id_compte`, `nom_user`, `telephone_user`, `login_user`, `mdp_user`, `typecompte`, `statut`, `datecreer`, `agence`, `datenaiss`, `CNI`, `pere`, `mere`, `diplome`, `nationalite`, `typecontrat`, `daterecrute`, `obligation`, `poste`, `salaire`) VALUES
(9, 'achille tawokam', 696170179, 'achille', 'b5f9c2073b93dc345fe375e504086b1c', 'admin', 'Activer', '0000-00-00', 1, NULL, '', '', '', '', '', 'CDD', NULL, NULL, '', NULL),
(10, 'Achille%20Tawokam', 677441144, '123', '202cb962ac59075b964b07152d234b70', 'simple', 'Activer', '2024-12-12', 1, '2024-12-12', 'g2544', 'h,', 'cfbc', 'tfjf', 'fghf', 'CDD', NULL, NULL, '', NULL),
(13, 'KENMOGNE%20SYLVAIN', 699388115, 'MOI', '5884ea7e3fc089aa50746b2a6629b1bc', 'simple', 'Activer', '2024-12-16', 1, '2001-03-16', 'sd545454', 'KENMOGNE%20EMMANUEL', 'YIMDJO%20ALBERTINE', 'BTS', 'CAMEROUNAIS', 'CDI', '2024-12-16', 'Veuillez%20au%20bon%20fonctionnement%20des%20differents%20pressing', 'CAMEROUNAIS', NULL);

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
(21, 7, 'ras', 1000, '2024-12-14', '123', 2),
(24, 7, '2', 546, '2024-12-31', 'achille', 1),
(25, 7, '2', 87, '2024-12-31', 'achille', 1),
(26, 7, '54', 897, '2024-12-31', 'achille', 1),
(27, 7, '54', 855, '2024-12-31', 'achille', 1),
(28, 7, '89', 879, '2024-12-31', 'achille', 1),
(29, 7, '54', 54, '2024-12-31', 'achille', 1),
(30, 7, '57', 87, '2024-12-31', 'achille', 1),
(31, 7, '54', 54, '2024-12-31', 'achille', 1),
(32, 7, '54', 8949, '2024-12-31', 'achille', 1),
(33, 7, '546', 574, '2024-12-31', 'achille', 1),
(34, 7, '546', 564, '2024-12-31', 'achille', 1),
(35, 7, '54', 564, '2024-12-31', 'achille', 1),
(36, 7, '56', 0, '2024-12-31', 'achille', 1),
(37, 7, '564', 894, '2024-12-31', 'achille', 1),
(38, 7, '56', 546, '2024-12-31', 'achille', 1),
(39, 7, '546', 54, '2024-12-31', 'achille', 1),
(40, 7, '54', 564, '2024-12-31', 'achille', 1),
(41, 7, '51', 541, '2024-12-31', 'achille', 1),
(42, 7, '21', 54, '2024-12-31', 'achille', 1),
(43, 7, '546', 59, '2024-12-31', 'achille', 1),
(44, 7, '54', 546, '2024-12-31', 'achille', 1),
(45, 7, '54', 58495, '2024-12-31', 'achille', 1),
(46, 7, '54', 95, '2024-12-31', 'achille', 1),
(47, 7, '556', 1000, '2024-12-31', 'achille', 1),
(48, 7, '2', 54, '2024-12-31', 'achille', 1),
(49, 7, '5466', 2454385, '2024-12-31', 'achille', 1),
(50, 7, '8589', 9859, '2024-12-31', 'achille', 1),
(51, 7, '574', 0, '2024-12-31', 'achille', 1),
(52, 7, '86', 500, '2024-12-31', 'achille', 1),
(53, 7, '566', 5465, '2024-12-31', 'achille', 1),
(54, 7, '546', 565, '2024-12-31', 'achille', 1),
(55, 7, '65', 546, '2024-12-31', 'achille', 1),
(56, 7, '65', 56556, '2024-12-31', 'achille', 1),
(57, 7, '56 ', 0, '2024-12-31', 'achille', 1),
(58, 7, '546', 8464, '2024-12-31', 'achille', 1),
(59, 7, '56', 562, '2024-12-31', 'achille', 1),
(60, 7, '213', 231, '2024-12-31', 'achille', 1),
(61, 7, '213', 63, '2024-12-31', 'achille', 1),
(62, 7, '21', 21321, '2024-12-31', 'achille', 1),
(63, 7, '231', 213, '2024-12-31', 'achille', 1),
(64, 7, '213', 231, '2024-12-31', 'achille', 1),
(65, 7, '21', 41523, '2024-12-31', 'achille', 1),
(66, 7, '21', 213, '2024-12-31', 'achille', 1),
(67, 7, '21', 23, '2024-12-31', 'achille', 1),
(68, 7, '213', 2311, '2024-12-31', 'achille', 1),
(69, 7, '213', 213, '2024-12-31', 'achille', 1),
(70, 7, '243', 231, '2024-12-31', 'achille', 1),
(71, 7, '2131', 213, '2024-12-31', 'achille', 1),
(72, 7, '213', 231, '2024-12-31', 'achille', 1),
(73, 7, 'rien', 2000, '2025-01-03', 'achille', 1);

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

--
-- Déchargement des données de la table `depotvetement`
--

INSERT INTO `depotvetement` (`id_depot`, `id_client`, `id_typevet`, `quantite_dep`, `description_dep`, `montaverse`, `monttotal`, `date_depot`, `date_retrait`, `utilisateur`, `date_entreg`, `code`, `agence`) VALUES
(223, 58, 27, 2, 'red and blue', 1000, 2000, '2024-12-17', '2024-12-20', 'achille', '2024-12-20', 2, 1),
(224, 58, 27, 1, 'red and blue', 1000, 1000, '2024-12-17', '2024-12-20', 'achille', '2024-12-20', 2, 1),
(226, 59, 27, 2, 'red and blue', 1000, 2000, '2024-12-31', '2025-01-03', 'achille', '2024-12-31', 3, 1),
(227, 58, 29, 1, 'red and blue', 200, 200, '2024-12-31', '2025-01-03', 'achille', '2024-12-31', 4, 1),
(228, 59, 29, 2, 'red and blue', 200, 400, '2024-12-31', '2025-01-02', 'achille', '2024-12-31', 5, 1),
(229, 59, 29, 2, 'red and blue', 200, 400, '2024-12-18', '2024-12-13', 'achille', '2024-12-31', 6, 1),
(230, 59, 29, 1, 'red and blue', 200, 200, '2024-12-17', '2024-12-19', 'achille', '2024-12-31', 7, 1),
(231, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(232, 58, 27, 2, '4', 1000, 2000, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(233, 58, 28, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(234, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(235, 58, 28, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(236, 58, 27, 2, '4', 1000, 2000, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(237, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(238, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(239, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(240, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(241, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(242, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(243, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(244, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(245, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(246, 58, 29, 2, '4', 200, 400, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 8, 1),
(247, 59, 27, 2, '4', 1000, 2000, '2025-01-03', '2025-01-06', 'achille', '2025-01-03', 9, 1),
(248, 58, 29, 1, 'red and blue', 200, 200, '2025-01-03', '2025-01-07', 'achille', '2025-01-03', 10, 1),
(249, 58, 27, 1, 'red and blue', 1000, 1000, '2025-01-02', '2025-01-05', 'achille', '2025-01-03', 11, 1);

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
(147, 2000, 2000, 0, 1, '2024-12-14', '2024-12-18', 58, 2),
(148, 3000, 2000, 1000, 2, '2024-12-14', '2024-12-18', 57, 2),
(149, 2000, 2000, 0, 1, '2024-12-11', '2024-12-14', 58, 1),
(150, 5000, 5000, 0, 2, '2024-12-17', '2024-12-20', 58, 1),
(151, 2000, 1000, 1000, 3, '2024-12-31', '2025-01-03', 59, 1),
(152, 200, 500, -300, 4, '2024-12-31', '2025-01-03', 58, 1),
(153, 400, 100, 300, 5, '2024-12-31', '2025-01-02', 59, 1),
(154, 400, 400, 0, 6, '2024-12-18', '2024-12-13', 59, 1),
(155, 200, 200, 0, 7, '2024-12-17', '2024-12-19', 59, 1),
(156, 9600, 8000, 1600, 8, '2025-01-03', '2025-01-06', 58, 1),
(157, 2000, 2000, 0, 9, '2025-01-03', '2025-01-06', 59, 1),
(158, 200, 200, 0, 10, '2025-01-03', '2025-01-07', 58, 1),
(159, 1000, 1000, 0, 11, '2025-01-02', '2025-01-05', 58, 1),
(160, 5000, 5000, 0, 12, '2025-01-01', '2025-01-17', 59, 1);

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

--
-- Déchargement des données de la table `gestse`
--

INSERT INTO `gestse` (`id_ligne`, `date_debut`, `date_fin`, `agence`) VALUES
(1, '2022-10-11', '2024-12-14', 0);

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

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`ligne`, `message`, `phone`, `id_client`, `agence`, `user`) VALUES
(1, 'yes', 676584454, 58, 0, ''),
(2, 'yes', 676584454, 58, 1, ''),
(3, 'yes', 676584454, 58, 1, ''),
(4, 'yes', 676584454, 58, 1, ''),
(5, '', 676584454, 58, 1, ''),
(6, 'retrait vetement', 676584454, 58, 1, ''),
(7, 'retrait vetement', 676584454, 58, 1, ''),
(8, '', 622554411, 57, 1, ''),
(9, 'my message', 622554411, 57, 1, ''),
(10, 'yesssss', 676584454, 58, 1, 'achille'),
(11, 'yesssss', 676584454, 58, 1, 'achille'),
(12, 'yesssss', 676584454, 58, 1, 'achille'),
(13, 'yesssss', 676584454, 58, 1, 'achille'),
(14, '', 622332211, 59, 1, 'achille'),
(15, '', 676584454, 58, 1, 'achille'),
(16, '', 676584454, 58, 1, 'achille'),
(17, 'get ours', 622332211, 59, 1, 'achille'),
(18, 'get ours', 676584454, 58, 1, 'achille'),
(19, 'get ours', 676584454, 58, 1, 'achille'),
(20, 'get ours', 622332211, 59, 1, 'achille'),
(21, 'get ours', 676584454, 58, 1, 'achille'),
(22, 'get ours', 676584454, 58, 1, 'achille'),
(23, 'get ours', 622332211, 59, 1, 'achille'),
(24, 'get ours', 676584454, 58, 1, 'achille'),
(25, 'get ours', 676584454, 58, 1, 'achille');

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
(1, '2024-12-19 06:06:24', '', 'Client', 'Modification', 'nom:Achille Tawo, téléphone:676584454', 0),
(2, '2024-12-19 06:06:34', 'achille tawokam', 'Client', 'Modification', 'nom:Achille Tawo, téléphone:676584454', 0),
(3, '2024-12-19 06:06:43', 'achille tawokam', 'Client', 'Modification', 'nom:Achille Tawo, téléphone:676584454', 0),
(4, '2024-12-20 08:58:53', '', 'depot vetement', 'Modification', 'prix unitaire:1000, quantité:2, description:red and blue, date depot:2024-12-17, date retrait:2024-12-20, montant total:2000', 0),
(5, '2024-12-20 08:58:56', '', 'depot vetement', 'Modification', 'prix unitaire:1000, quantité:2, description:red and blue, date depot:2024-12-17, date retrait:2024-12-20, montant total:2000', 0),
(6, '2024-12-20 08:59:24', '', 'depot vetement', 'Modification', 'prix unitaire:1000, quantité:1, description:red and blue, date depot:2024-12-17, date retrait:2024-12-20, montant total:1000', 0),
(7, '2024-12-20 08:59:57', '', 'depot vetement', 'Modification', 'prix unitaire:1000, quantité:1, description:red and blue, date depot:2024-12-17, date retrait:2024-12-20, montant total:1000', 0),
(8, '2024-12-20 09:00:00', '', 'depot vetement', 'Modification', 'prix unitaire:1000, quantité:1, description:red and blue, date depot:2024-12-17, date retrait:2024-12-20, montant total:1000', 0),
(9, '2024-12-20 09:00:03', '', 'depot vetement', 'Modification', 'prix unitaire:1000, quantité:1, description:red and blue, date depot:2024-12-17, date retrait:2024-12-20, montant total:1000', 0),
(10, '2024-12-20 09:00:05', '', 'depot vetement', 'Modification', 'prix unitaire:1000, quantité:1, description:red and blue, date depot:2024-12-17, date retrait:2024-12-20, montant total:1000', 0),
(11, '2024-12-20 09:51:51', 'achille tawokam', 'depot vetement', 'Modification', 'prix unitaire:1000, quantité:2, description:red and blue, date depot:2024-12-17, date retrait:2024-12-20, montant total:2000', 0),
(12, '2024-12-20 09:54:18', 'achille tawokam', 'depot vetement', 'Modification', 'prix unitaire:1000, quantité:2, description:red and blue, date depot:2024-12-17, date retrait:2024-12-20, montant total:2000', 1),
(13, '2024-12-20 10:03:24', 'achille tawokam', 'Client', 'Modification', 'nom:Achille Tawokam, téléphone:622554411', 1),
(14, '2024-12-20 10:04:16', 'achille tawokam', 'Client', 'Insertion', 'nom:fe, téléphone:633221144', 1),
(15, '2024-12-20 10:15:24', '', 'Type de vetement', 'Insertion', 'nom:sds, prix:200', 1),
(16, '2024-12-20 10:16:05', 'achille tawokam', 'Type de vetement', 'Insertion', 'nom:aa, prix:200', 1),
(17, '2024-12-20 10:16:55', 'achille tawokam', 'Type de vetement', 'Insertion', 'nom:xds, prix:500', 1),
(18, '2024-12-20 10:21:31', '', 'Type de vetement', 'Modification', 'nom:xds, prix:500', 1),
(19, '2024-12-20 10:21:42', 'achille tawokam', 'Type de vetement', 'Modification', 'nom:xds, prix:500', 1),
(20, '2024-12-20 10:35:45', 'achille tawokam', 'Sortie vetement', 'Insertion', 'quantité:2, description:2, montant a versé:1000, montant total:2000 date depot:2024-12-11, date retrait:2024-12-14', 1),
(21, '2024-12-20 10:47:37', 'achille tawokam', 'Type depense', 'Insertion', 'nom :achille tawokam', 1),
(22, '2024-12-20 10:48:12', 'achille tawokam', 'Type depense', 'Insertion', 'nom :OM', 1),
(23, '2024-12-20 10:54:02', '', 'Type depense', 'Modification', 'nom :Orange Money', 1),
(24, '2024-12-20 10:54:14', 'achille tawokam', 'Type depense', 'Modification', 'nom :Orange Money', 1),
(25, '2024-12-20 10:58:50', 'achille tawokam', 'Type depense', 'Suppression', 'nom :Orange Money', 1),
(26, '2024-12-20 11:20:29', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:eerrr, Montant:1000, date:2024-12-20', 1),
(27, '2024-12-20 11:24:43', '', 'Depense', 'Modification', 'motif :eerrr, Montant:1000', 1),
(28, '2024-12-20 11:25:41', 'achille tawokam', 'Depense', 'Modification', 'motif :200, Montant:200', 1),
(29, '2024-12-20 11:26:58', 'achille tawokam', 'Depense', 'Modification', 'motif :achat detergent, Montant:200', 1),
(30, '2024-12-20 11:34:22', 'achille tawokam', 'Depense', 'Suppression', 'Motif :ras, Montant:1000, enregistrer le:2024-12-14', 1),
(31, '2024-12-20 11:34:30', 'achille tawokam', 'Depense', 'Suppression', 'Motif :achat detergent, Montant:200, enregistrer le:2024-12-14', 1),
(32, '2024-12-20 12:43:31', 'achille tawokam', 'Dette', 'Remboursement', 'code de la facture:2, montant versé:100, Reste:400', 1),
(33, '2024-12-20 12:48:09', 'achille tawokam', 'Type de versement', 'Insertion', 'nom:MOMO', 1),
(34, '2024-12-20 01:03:13', 'achille tawokam', 'Type versement', 'Modification', 'nom:BANQUE', 1),
(35, '2024-12-20 01:06:59', '', 'Type versement', 'Suppression', 'nom:MOMO', 1),
(36, '2024-12-20 01:12:40', 'achille tawokam', 'Versement', 'Insertion', 'type de versement::BANQUE, montant versé:1500, Numéro du reçu:847522, date de versement:2024-12-20', 1),
(37, '2024-12-20 01:15:07', 'achille tawokam', 'Type versement', 'Modification', 'nom:7', 1),
(38, '2024-12-20 01:17:33', 'achille tawokam', 'Versement', 'Modification', 'type de versement:BANQUE, Montant:2200', 1),
(39, '2024-12-20 01:22:29', 'achille tawokam', 'Versement', 'Suppression', 'type de versement::, montant:, Numéro du reçu:, date de versement:', 1),
(40, '2024-12-20 01:24:07', 'achille tawokam', 'Versement', 'Suppression', 'type de versement::, montant:, Numéro du reçu:, date de versement:', 1),
(41, '2024-12-20 01:25:06', 'achille tawokam', 'Versement', 'Suppression', 'type de versement::BANQUE, montant:, Numéro du reçu:, date de versement:', 1),
(42, '2024-12-20 01:25:18', 'achille tawokam', 'Versement', 'Insertion', 'type de versement::BANQUE, montant versé:500, Numéro du reçu:54, date de versement:2024-12-20', 1),
(43, '2024-12-20 01:25:22', 'achille tawokam', 'Versement', 'Suppression', 'type de versement::BANQUE, montant:, Numéro du reçu:, date de versement:', 1),
(44, '2024-12-20 01:26:12', 'achille tawokam', 'Versement', 'Insertion', 'type de versement::BANQUE, montant versé:400, Numéro du reçu:7855, date de versement:2024-12-20', 1),
(45, '2024-12-20 01:26:16', 'achille tawokam', 'Versement', 'Suppression', 'type de versement::BANQUE, montant:400, Numéro du reçu:7855, date de versement:2024-12-20', 1),
(46, '2024-12-20 01:30:10', 'achille tawokam', 'Cloture de caisse', 'Insertion', 'Somme des entrées:4100, somme des depense:, montant net:4100, montant en caisse:500', 1),
(47, '2024-12-20 01:33:34', 'achille tawokam', 'Cloture de caisse', 'Insertion', 'Somme des entrées:, somme des depense:, montant net:0, montant en caisse:1', 1),
(48, '2024-12-20 01:34:44', 'achille tawokam', 'Cloture de caisse', 'Insertion', 'Somme des entrées:, somme des depense:, montant net:0, montant en caisse:1', 1),
(49, '2024-12-20 01:34:45', '', 'Cloture caisse', 'Report de caisse', 'Montant en caisse:1, reporter pour le:2024/12/19', 1),
(50, '2024-12-20 01:35:25', 'achille tawokam', 'Cloture de caisse', 'Insertion', 'Somme des entrées:2000, somme des depense:, montant net:2000, montant en caisse:2000', 1),
(51, '2024-12-20 01:35:27', 'achille tawokam', 'Cloture caisse', 'Report de caisse', 'Montant en caisse:2000, reporter pour le:2024/12/18', 1),
(52, '2024-12-20 02:53:28', 'achille tawokam', 'Message', 'Envoi de message de masse', 'Envoi aux clients pour rappelé le retrait, message:get ours', 1),
(53, '2024-12-20 02:54:30', 'achille tawokam', 'Message', 'Envoi de message de masse', 'Envoi aux clients pour rappelé le retrait, message:get ours', 1),
(54, '2024-12-20 03:12:54', 'achille tawokam', 'Message', 'Envoi de message en masse', 'Envoi aux clients pour rappelé le retrait, sms:get ours', 1),
(55, '2024-12-20 03:19:29', 'achille tawokam', 'Message', 'Envoi de message en masse', 'Envoi aux clients pour informé que la date de retrait est depassé, sms:Expired date', 1),
(56, '2024-12-31 09:17:29', 'achille tawokam', 'depot vetement', 'Modification', 'prix unitaire:1000, quantité:2, description:red and blue, date depot:2024-12-31, date retrait:2025-01-03, montant total:2000', 1),
(57, '2024-12-31 09:17:34', 'achille tawokam', 'depot vetement', 'Suppression', 'prix unitaire:1000, quantité:2, description:red and blue, date depot:2024-12-31, date retrait:2025-01-03, montant total:2000', 1),
(58, '2024-12-31 09:17:47', 'achille tawokam', ' code facture:2, Sortie vetement', 'Insertion', 'quantité:2, description:red and blue, montant a versé:1000, montant total:2000, date depot:2024-12-17, date retrait:2024-12-20', 1),
(59, '2024-12-31 12:19:11', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:2, Montant:546, date:2024-12-31', 1),
(60, '2024-12-31 12:19:17', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:2, Montant:87, date:2024-12-31', 1),
(61, '2024-12-31 12:19:22', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:54, Montant:897, date:2024-12-31', 1),
(62, '2024-12-31 12:19:29', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:54, Montant:855, date:2024-12-31', 1),
(63, '2024-12-31 12:19:35', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:89, Montant:879, date:2024-12-31', 1),
(64, '2024-12-31 12:19:41', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:54, Montant:54, date:2024-12-31', 1),
(65, '2024-12-31 12:19:46', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:57, Montant:87, date:2024-12-31', 1),
(66, '2024-12-31 12:19:51', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:54, Montant:54, date:2024-12-31', 1),
(67, '2024-12-31 12:19:57', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:54, Montant:8949, date:2024-12-31', 1),
(68, '2024-12-31 12:20:02', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:546, Montant:574, date:2024-12-31', 1),
(69, '2024-12-31 12:20:07', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:546, Montant:564, date:2024-12-31', 1),
(70, '2024-12-31 12:20:12', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:54, Montant:564, date:2024-12-31', 1),
(71, '2024-12-31 12:20:17', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:56, Montant:, date:2024-12-31', 1),
(72, '2024-12-31 12:20:22', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:564, Montant:894, date:2024-12-31', 1),
(73, '2024-12-31 12:20:27', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:56, Montant:546, date:2024-12-31', 1),
(74, '2024-12-31 12:20:32', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:546, Montant:54, date:2024-12-31', 1),
(75, '2024-12-31 12:20:39', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:54, Montant:564, date:2024-12-31', 1),
(76, '2024-12-31 12:20:44', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:51, Montant:541, date:2024-12-31', 1),
(77, '2024-12-31 12:20:51', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:21, Montant:54, date:2024-12-31', 1),
(78, '2024-12-31 12:20:55', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:546, Montant:59, date:2024-12-31', 1),
(79, '2024-12-31 12:21:00', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:54, Montant:546, date:2024-12-31', 1),
(80, '2024-12-31 12:21:05', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:54, Montant:58495, date:2024-12-31', 1),
(81, '2024-12-31 12:21:10', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:54, Montant:95, date:2024-12-31', 1),
(82, '2024-12-31 12:21:17', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:556, Montant:1000, date:2024-12-31', 1),
(83, '2024-12-31 12:32:51', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:2, Montant:54, date:2024-12-31', 1),
(84, '2024-12-31 12:32:56', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:5466, Montant:2454385, date:2024-12-31', 1),
(85, '2024-12-31 12:33:02', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:8589, Montant:9859, date:2024-12-31', 1),
(86, '2024-12-31 12:33:08', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:574, Montant:, date:2024-12-31', 1),
(87, '2024-12-31 12:33:14', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:86, Montant:500, date:2024-12-31', 1),
(88, '2024-12-31 12:33:19', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:566, Montant:5465, date:2024-12-31', 1),
(89, '2024-12-31 12:33:24', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:546, Montant:565, date:2024-12-31', 1),
(90, '2024-12-31 12:33:28', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:65, Montant:546, date:2024-12-31', 1),
(91, '2024-12-31 12:33:35', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:65, Montant:56556, date:2024-12-31', 1),
(92, '2024-12-31 12:33:43', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:56 , Montant:, date:2024-12-31', 1),
(93, '2024-12-31 12:33:48', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:546, Montant:8464, date:2024-12-31', 1),
(94, '2024-12-31 12:33:53', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:56, Montant:562, date:2024-12-31', 1),
(95, '2024-12-31 12:33:59', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:213, Montant:231, date:2024-12-31', 1),
(96, '2024-12-31 12:34:04', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:213, Montant:63, date:2024-12-31', 1),
(97, '2024-12-31 12:34:08', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:21, Montant:21321, date:2024-12-31', 1),
(98, '2024-12-31 12:34:14', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:231, Montant:213, date:2024-12-31', 1),
(99, '2024-12-31 12:34:18', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:213, Montant:231, date:2024-12-31', 1),
(100, '2024-12-31 12:34:26', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:21, Montant:41523, date:2024-12-31', 1),
(101, '2024-12-31 12:34:33', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:21, Montant:213, date:2024-12-31', 1),
(102, '2024-12-31 12:34:38', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:21, Montant:23, date:2024-12-31', 1),
(103, '2024-12-31 12:34:43', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:213, Montant:2311, date:2024-12-31', 1),
(104, '2024-12-31 12:34:47', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:213, Montant:213, date:2024-12-31', 1),
(105, '2024-12-31 12:34:53', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:243, Montant:231, date:2024-12-31', 1),
(106, '2024-12-31 12:34:57', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:2131, Montant:213, date:2024-12-31', 1),
(107, '2024-12-31 12:35:02', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:213, Montant:231, date:2024-12-31', 1),
(108, '2025-01-03 10:46:04', 'achille tawokam', 'depot vetement', 'Modification', 'prix unitaire:1000, quantité:5, description:red and blue, date depot:2025-01-01, date retrait:2025-01-17, montant total:5000', 1),
(109, '2025-01-03 10:46:37', 'achille tawokam', 'facture', 'Reglement facture', 'code facture :12, Montant versé:1000', 1),
(110, '2025-01-03 10:46:38', 'achille tawokam', ' code facture:12, Sortie vetement', 'Insertion', 'quantité:5, description:red and blue, montant a versé:1000, montant total:5000, date depot:2025-01-01, date retrait:2025-01-17', 1),
(111, '2025-01-03 10:46:55', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :SALAIRE, Motif:ras, Montant:2000, date:2025-01-03', 1),
(112, '2025-01-03 10:47:08', 'achille tawokam', 'Depense', 'Modification', 'motif :rien, Montant:2000', 1),
(113, '2025-01-03 10:47:28', 'achille tawokam', 'Dette', 'Remboursement', 'code de la facture:2, montant versé:400, Reste:0', 1),
(114, '2025-01-03 10:47:44', 'achille tawokam', 'Versement', 'Insertion', 'type de versement::BANQUE, montant versé:2000, Numéro du reçu:1, date de versement:2025-01-03', 1),
(115, '2025-01-03 10:47:57', 'achille tawokam', 'Cloture de caisse', 'Insertion', 'Somme des entrées:11600, somme des depense:2000, montant net:7600, montant en caisse:7000', 1),
(116, '2025-01-03 10:47:58', 'achille tawokam', 'Cloture caisse', 'Report de caisse', 'Montant en caisse:7000, reporter pour le:2025/01/04', 1);

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
(30, 1000, 'OUI', 'NON', '2024-12-14', 1, 2),
(31, 1000, 'NON', 'OUI', '2024-12-14', 2, 2),
(32, 1500, 'OUI', 'NON', '2024-12-20', 1, 1),
(33, 0, 'OUI', 'OUI', '2024-12-20', 2, 1),
(34, 1000, 'OUI', 'NON', '2025-01-03', 12, 1);

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
(31, 58, 27, 2, 'red and blue', 1000, 2000, '2024-12-14', '2024-12-18', '123', '2024-12-14', 1, 220, 2),
(32, 57, 27, 3, 'red and blue', 1000, 3000, '2024-12-14', '2024-12-18', '123', '2024-12-14', 2, 221, 2),
(33, 58, 27, 2, '2', 1000, 2000, '2024-12-11', '2024-12-14', 'achille', '2024-12-20', 1, 222, 1),
(34, 59, 27, 2, 'red and blue', 1000, 2000, '2024-12-17', '2024-12-20', 'achille', '2024-12-31', 2, 225, 1),
(35, 59, 27, 5, 'red and blue', 1000, 5000, '2025-01-01', '2025-01-17', 'achille', '2025-01-03', 12, 250, 1);

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
(7, 'SALAIRE', 2);

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
(19, 1, 'simple lavage', 2),
(20, 2, 'simple lavage', 2),
(21, 1, 'simple lavage', 1),
(22, 2, 'simple lavage', 1),
(23, 3, 'simple lavage', 1),
(24, 4, 'simple lavage', 1),
(25, 5, 'simple lavage', 1),
(26, 6, 'simple lavage', 1),
(27, 7, 'simple lavage', 1),
(28, 8, 'simple lavage', 1),
(29, 9, 'simple lavage', 1),
(30, 10, 'simple lavage', 1),
(31, 11, 'simple lavage', 1),
(32, 12, 'simple lavage', 1);

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
(7, 'BANQUE', 2);

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
(27, 'chaussures', 1000, 2),
(28, 'sds', 200, 1),
(29, 'aa', 200, 1);

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
(11, 7, 1000, '2024-12-14', '123', '12', 2),
(17, 7, 2000, '2025-01-03', 'achille', '1', 1);

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
(105, 1, 1000, '2024-12-14', 2),
(106, 1, 1000, '2024-12-14', 2),
(107, 2, 1000, '2024-12-14', 2),
(108, 2, 1000, '2024-12-14', 2),
(109, 1, 500, '2024-12-11', 1),
(110, 1, 1500, '2024-12-20', 1),
(111, 2, 2000, '2024-12-17', 1),
(112, 2, 2000, '2024-12-20', 1),
(113, 2, 500, '2024-12-20', 1),
(114, 2, 100, '2024-12-20', 1),
(115, 0, 500, '2024-12-21', 1),
(116, 0, 1, '2024-12-19', 1),
(117, 0, 2000, '2024-12-18', 1),
(118, 3, 1000, '2024-12-31', 1),
(119, 4, 500, '2024-12-31', 1),
(120, 5, 100, '2024-12-31', 1),
(121, 6, 400, '2024-12-18', 1),
(122, 7, 200, '2024-12-17', 1),
(123, 8, 8000, '2025-01-03', 1),
(124, 9, 2000, '2025-01-03', 1),
(125, 10, 200, '2025-01-03', 1),
(126, 11, 1000, '2025-01-02', 1),
(127, 12, 4000, '2025-01-01', 1),
(128, 12, 1000, '2025-01-03', 1),
(129, 2, 400, '2025-01-03', 1),
(130, 0, 7000, '2025-01-04', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `agence`
--
ALTER TABLE `agence`
  ADD PRIMARY KEY (`id_agence`);

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
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `cloturecaisse`
--
ALTER TABLE `cloturecaisse`
  MODIFY `id_clot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_cmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=412;

--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `depense`
--
ALTER TABLE `depense`
  MODIFY `id_depense` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT pour la table `depotvetement`
--
ALTER TABLE `depotvetement`
  MODIFY `id_depot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `id_facture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT pour la table `facturesupprimer`
--
ALTER TABLE `facturesupprimer`
  MODIFY `id_factsupp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gestse`
--
ALTER TABLE `gestse`
  MODIFY `id_ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `operationseffectuees`
--
ALTER TABLE `operationseffectuees`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT pour la table `reglement`
--
ALTER TABLE `reglement`
  MODIFY `id_reg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `salaire`
--
ALTER TABLE `salaire`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sortivetement`
--
ALTER TABLE `sortivetement`
  MODIFY `id_sort` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `typedepense`
--
ALTER TABLE `typedepense`
  MODIFY `id_dep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `typelavage`
--
ALTER TABLE `typelavage`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `typeverseargent`
--
ALTER TABLE `typeverseargent`
  MODIFY `id_typevera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `typevetement`
--
ALTER TABLE `typevetement`
  MODIFY `id_typevet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `verseargent`
--
ALTER TABLE `verseargent`
  MODIFY `id_vera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `versement`
--
ALTER TABLE `versement`
  MODIFY `id_verse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
