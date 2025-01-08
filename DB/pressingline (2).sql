-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 03 jan. 2025 à 11:59
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
-- Base de données : `pressingline`
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
(2, 'Groupe star madelon', 672222260, 'maire', 'desactiver');

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
(7, 57, 0, '2024-12-12', 14, 1),
(8, 59, 3, '2025-01-03', 0, 1);

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
(0, 'cvcvxb', 688774411, '2025-01-03', 'achille', 1),
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
(10, 2000, 0, 2000, 2000, 0, 'Exact', 'achille', '2024-12-17', 1);

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
(0, 59, 29, 5, 'red and blue', 200, 1000, '2025-01-01', '2025-01-05', 'achille', '2025-01-03', 8, 1),
(379, 58, 27, 2, 'red and blue', 1000, 2000, '2024-12-14', '2024-12-18', '123', '2024-12-14', 1, 2),
(380, 57, 27, 3, 'red and blue', 1000, 3000, '2024-12-14', '2024-12-18', '123', '2024-12-14', 2, 2),
(381, 58, 27, 2, '2', 1000, 2000, '2024-12-11', '2024-12-14', '123', '2024-12-14', 1, 1),
(382, 58, 27, 2, 'red and blue', 1000, 2000, '2024-12-17', '2024-12-20', 'achille', '2024-12-20', 2, 1),
(383, 58, 27, 1, 'red and blue', 1000, 1000, '2024-12-17', '2024-12-20', 'achille', '2024-12-20', 2, 1),
(385, 59, 27, 2, 'red and blue', 1000, 2000, '2024-12-17', '2024-12-20', 'achille', '2024-12-20', 2, 1),
(386, 59, 27, 2, 'red and blue', 1000, 2000, '2024-12-31', '2025-01-03', 'achille', '2024-12-31', 3, 1),
(389, 59, 29, 2, 'red and blue', 200, 400, '2024-12-31', '2025-01-02', 'achille', '2024-12-31', 5, 1),
(390, 59, 29, 2, 'red and blue', 200, 400, '2024-12-18', '2024-12-13', 'achille', '2024-12-31', 6, 1),
(391, 59, 29, 1, 'red and blue', 200, 200, '2024-12-17', '2024-12-19', 'achille', '2024-12-31', 7, 1);

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
(17, 'azert', 677885544, '741', '2e65f2f2fdaf6c699b223c61b1b5ab89', 'simple', 'Activer', '2024-12-26', 2, '2024-12-26', 'sd545454', 'Achille', 'Tawokam', 'BACC', 'camerounais', 'CDI', '2024-12-26', 'ras', 'Receptionniste', 250000),
(18, 'cvb', 688774441, 'fghfg', '73c18c59a39b18382081ec00bb456d43', 'simple', 'Activer', '2025-01-03', 1, '2025-01-03', '4524', 'fgbfxg', 'cvbxcf', 'BACC', 'fcg', 'CDD', '2025-01-03', 'fghxf', 'fg', 100000);

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
(72, 7, '213', 231, '2024-12-31', 'achille', 1);

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
(0, 59, 29, 5, 'red and blue', 200, 1000, '2025-01-01', '2025-01-05', 'achille', '2025-01-03', 8, 1),
(223, 58, 27, 2, 'red and blue', 1000, 2000, '2024-12-17', '2024-12-20', 'achille', '2024-12-20', 2, 1),
(224, 58, 27, 1, 'red and blue', 1000, 1000, '2024-12-17', '2024-12-20', 'achille', '2024-12-20', 2, 1),
(226, 59, 27, 2, 'red and blue', 1000, 2000, '2024-12-31', '2025-01-03', 'achille', '2024-12-31', 3, 1),
(228, 59, 29, 2, 'red and blue', 200, 400, '2024-12-31', '2025-01-02', 'achille', '2024-12-31', 5, 1),
(229, 59, 29, 2, 'red and blue', 200, 400, '2024-12-18', '2024-12-13', 'achille', '2024-12-31', 6, 1),
(230, 59, 29, 1, 'red and blue', 200, 200, '2024-12-17', '2024-12-19', 'achille', '2024-12-31', 7, 1);

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
(150, 5000, 4600, 400, 2, '2024-12-17', '2024-12-20', 58, 1),
(151, 2000, 1000, 1000, 3, '2024-12-31', '2025-01-03', 59, 1),
(153, 400, 100, 300, 5, '2024-12-31', '2025-01-02', 59, 1),
(154, 400, 400, 0, 6, '2024-12-18', '2024-12-13', 59, 1),
(155, 200, 200, 0, 7, '2024-12-17', '2024-12-19', 59, 1);

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

--
-- Déchargement des données de la table `facturesupprimer`
--

INSERT INTO `facturesupprimer` (`id_factsupp`, `monttotal`, `avance`, `reste`, `code`, `date_depot`, `date_supprimer`, `agence`) VALUES
(0, 200, 500, -300, 4, '2024-12-31', '2025-01-03', 1);

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
(1, '2024-12-19 05:15:42', 'achille tawokam', 'Utilisateur', 'Désactivation', 'utilisateur desactivé : Achille%20Tawokam', 1),
(2, '2024-12-19 05:16:19', 'achille tawokam', 'Utilisateur', 'Activation', 'utilisateur activé : Achille%20Tawokam', 1),
(3, '2024-12-19 05:29:10', 'achille tawokam', 'Paiement', 'Insertion', 'user:9 date_debut:2024-12-01 date_fin:2024-12-14 montant_verse:35000 enregistrer le:2024/12/19', 1),
(4, '2024-12-19 05:39:56', 'achille tawokam', 'Paiement', 'Suppression', 'user:achille tawokam, date_debut:2024-12-01, date_fin:2024-12-14, montant_verse:35000, enregistrer le:2024-12-19', 1),
(5, '2024-12-19 05:59:04', 'achille tawokam', 'Utilisateur', 'Insertion', 'nom:kammogne, date_naissance:2014-06-13, téléphone:644552255, CNI:drg54d534, nom du pere:kenmogne, nom de la mere :yimdjo, diplome:BACC, nationalite:camerounais, type contrat:CDD, date recruté:2024-12-19, login:moi, mot de passe :*******, type de compte:simple, poste:Receptionniste, salaire:40000, obligation:RAS', 1),
(6, '2024-12-19 06:03:08', 'achille tawokam', 'Client', 'Insertion', 'nom:autre, téléphone:688553387', 1),
(7, '2024-12-19 06:08:22', 'achille tawokam', 'Client', 'Modification', 'nom:Achille Tawo, téléphone:676584454', 1),
(8, '2024-12-19 06:09:10', 'achille tawokam', 'Client', 'Insertion', 'nom:clientx, téléphone:644552211', 1),
(9, '2024-12-19 06:12:33', 'achille tawokam', 'Client', 'Insertion', 'nom:fgds, téléphone:653356545', 1),
(10, '2024-12-19 06:12:40', '', 'Client', 'Suppression', 'nom:fgds, téléphone:653356545', 1),
(11, '2024-12-20 10:05:49', 'achille tawokam', 'Utilisateur', 'Désactivation', 'utilisateur desactivé : kammogne', 1),
(12, '2024-12-20 02:43:50', 'achille tawokam', 'Message', 'Envoi de message', 'Envoi d\'un sms a :Achille Tawo, message:asas', 1),
(13, '2024-12-20 04:35:18', '', 'Carte fidelité', 'Générer une carte', 'nom du client:Achille Tawo, reduction:2 %', 1),
(14, '2024-12-20 04:43:20', '', 'Carte fidelité', 'Générer une carte', 'nom du client:Achille Tawo, reduction:1 %', 1),
(15, '2024-12-20 05:07:42', 'achille tawokam', 'Carte fidelité', 'Générer une carte', 'nom du client:Achille Tawo, reduction:2 %', 1),
(16, '2024-12-20 05:13:42', 'achille tawokam', 'Carte fidelité', 'Modification', 'nom du client:, reduction:1 %', 1),
(17, '2024-12-20 05:14:14', 'achille tawokam', 'Carte fidelité', 'Modification', 'nom du client:, reduction:1 %', 1),
(18, '2024-12-20 05:15:32', 'achille tawokam', 'Carte fidelité', 'Modification', 'nom du client:Achille Tawo, reduction:2 %', 1),
(19, '2024-12-26 12:56:14', 'achille tawokam', 'Carte fidelité', 'Générer une carte', 'nom du client:Achille Tawo, reduction:2 %', 1),
(20, '2024-12-26 01:25:47', 'achille tawokam', 'Utilisateur', 'Insertion', 'nom:azert, date_naissance:2024-12-26, téléphone:611447755, CNI:cvbxdfbxf, nom du pere:zeer, nom de la mere :cvvvc, diplome:BACC, nationalite:camerounais, type contrat:CDD, date recruté:2024-12-26, login:1234, mot de passe :*******, type de compte:simple, poste:Receptionniste, salaire:20000, obligation:ras', 2),
(21, '2024-12-26 01:29:31', 'achille tawokam', 'Utilisateur', 'Insertion', 'nom:Achille%20Tawokam, date_naissance:2024-12-26, téléphone:622114455, CNI:sd545454, nom du pere:Achille, nom de la mere :Tawokam, diplome:BACC, nationalite:camerounais, type contrat:CDI, date recruté:2024-12-26, login:741, mot de passe :*******, type de compte:simple, poste:Receptionniste, salaire:15000, obligation:ras', 2),
(22, '2024-12-26 01:30:46', 'achille tawokam', 'Utilisateur', 'Insertion', 'nom:azert, date_naissance:2024-12-26, téléphone:677885544, CNI:sd545454, nom du pere:Achille, nom de la mere :Tawokam, diplome:BACC, nationalite:camerounais, type contrat:CDI, date recruté:2024-12-26, login:741, mot de passe :*******, type de compte:simple, poste:Receptionniste, salaire:250000, obligation:ras', 2),
(23, '2024-12-26 01:35:39', 'achille tawokam', 'Utilisateur', 'Désactivation', 'utilisateur desactivé : azert', 1),
(24, '2024-12-26 01:35:41', 'achille tawokam', 'Utilisateur', 'Activation', 'utilisateur activé : azert', 1),
(25, '2024-12-31 12:18:37', 'achille tawokam', 'Depense', 'Insertion', 'type de depense :Lumiere, Motif:2, Montant:200, date:2024-12-31', 1),
(26, '2024-12-31 01:22:51', 'achille tawokam', 'Utilisateur', 'Désactivation', 'utilisateur desactivé : Achille%20Tawokam', 1),
(27, '2024-12-31 01:22:52', 'achille tawokam', 'Utilisateur', 'Activation', 'utilisateur activé : Achille%20Tawokam', 1),
(28, '2024-12-31 05:09:27', 'achille tawokam', 'Carte fidelité', 'Modification', 'nom du client:Achille Tawokam, reduction:2 %', 1),
(29, '2025-01-03 09:37:13', 'achille tawokam', 'Paiement', 'Insertion', 'user:17, date_debut:2025-01-02, date_fin:2025-01-05, montant_verse:5000, enregistrer le:2025/01/03', 1),
(30, '2025-01-03 10:25:06', 'achille tawokam', 'Carte fidelité', 'Modification', 'nom du client:Achille Tawokam, reduction:2 %', 1),
(31, '2025-01-03 10:32:58', 'achille tawokam', 'Utilisateur', 'Insertion', 'nom:cvb, date_naissance:2025-01-03, téléphone:688774441, CNI:4524, nom du pere:fgbfxg, nom de la mere :cvbxcf, diplome:BACC, nationalite:fcg, type contrat:CDD, date recruté:2025-01-03, login:fghfg, mot de passe :*******, type de compte:simple, poste:fg, salaire:100000, obligation:fghxf', 1),
(32, '2025-01-03 10:33:15', 'achille tawokam', 'Paiement', 'Insertion', 'user:18, date_debut:2025-01-01, date_fin:2025-01-31, montant_verse:100000, enregistrer le:2025/01/03', 1),
(33, '2025-01-03 10:35:56', 'achille tawokam', 'Client', 'Insertion', 'nom:cvcvxb, téléphone:688774411', 1),
(34, '2025-01-03 10:45:20', 'achille tawokam', 'depot vetement', 'Modification', 'prix unitaire:200, quantité:4, description:red and blue, date depot:2025-01-01, date retrait:2025-01-05, montant total:800', 1),
(35, '2025-01-03 10:45:27', 'achille tawokam', 'depot vetement', 'Suppression', 'prix unitaire:200, quantité:4, description:red and blue, date depot:2025-01-01, date retrait:2025-01-05, montant total:800', 1),
(36, '2025-01-03 10:45:34', 'achille tawokam', 'depot vetement', 'Modification', 'prix unitaire:200, quantité:5, description:red and blue, date depot:2025-01-01, date retrait:2025-01-05, montant total:1000', 1),
(37, '2025-01-03 10:48:30', 'achille tawokam', 'Carte fidelité', 'Générer une carte', 'nom du client:fe, reduction:3 %', 1);

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

--
-- Déchargement des données de la table `rechargecf`
--

INSERT INTO `rechargecf` (`id_rech`, `montantPourcent`, `montantFcfa`, `id_carte`, `date_recharge`, `agence`) VALUES
(6, 2, 0, 0, '2025-01-03', 1);

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
(33, 400, 'NON', 'OUI', '2024-12-20', 2, 1);

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

--
-- Déchargement des données de la table `salaire`
--

INSERT INTO `salaire` (`ligne`, `user`, `date_debut`, `date_fin`, `montverse`, `agence`, `date_save`) VALUES
(1, 13, '2024-12-01', '2024-12-19', 20000, 1, '2024-12-19'),
(2, 9, '2024-12-01', '2024-12-19', 50000, 1, '2024-12-19'),
(4, 17, '2025-01-01', '2025-01-17', 15000, 2, '2025-01-03'),
(5, 17, '2025-01-02', '2025-01-11', 200000, 2, '2025-01-03'),
(6, 17, '2025-01-02', '2025-01-05', 5000, 2, '2025-01-03');

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
(34, 59, 27, 2, 'red and blue', 1000, 2000, '2024-12-17', '2024-12-20', 'achille', '2024-12-31', 2, 225, 1);

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
(0, 1, 'simple lavage', 1);

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
(11, 7, 1000, '2024-12-14', '123', '12', 2);

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
(120, 5, 100, '2024-12-31', 1),
(121, 6, 400, '2024-12-18', 1),
(122, 7, 200, '2024-12-17', 1);

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
-- AUTO_INCREMENT pour la table `cartefidelite`
--
ALTER TABLE `cartefidelite`
  MODIFY `id_carte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `operationseffectuees`
--
ALTER TABLE `operationseffectuees`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `rechargecf`
--
ALTER TABLE `rechargecf`
  MODIFY `id_rech` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `salaire`
--
ALTER TABLE `salaire`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
