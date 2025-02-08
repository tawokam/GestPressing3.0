-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 08 fév. 2025 à 08:33
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
(20, 'Technicien', 699388115, 'Technosoft', '1e2340e7f1d4ec2c23448854649f1ded', 'admin', 'activer', '2025-02-08', 1, '2025-02-08', 'RAS', '', '', '', '', 'CDI', '0000-00-00', 'RAS', 'Technicien%20logiciel', 0, '');

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
(1, '2025-02-08 08:27:16', 'achille tawokam', 'Utilisateur', 'Insertion', 'nom:Technicien, date_naissance:2025-02-08, téléphone:699388115, CNI:RAS, nom du pere:, nom de la mere :, diplome:, nationalite:, type contrat:CDI, date recruté:, login:Technosoft, mot de passe :*******, type de compte:admin, poste:Technicien%20logiciel, salaire:0, obligation:RAS', 1);

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

-- --------------------------------------------------------

--
-- Structure de la table `typedepense`
--

CREATE TABLE `typedepense` (
  `id_dep` int(11) NOT NULL,
  `nom_dep` varchar(500) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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

-- --------------------------------------------------------

--
-- Structure de la table `typeverseargent`
--

CREATE TABLE `typeverseargent` (
  `id_typevera` int(11) NOT NULL,
  `nom_versa` varchar(500) NOT NULL,
  `agence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cartefidelite`
--
ALTER TABLE `cartefidelite`
  MODIFY `id_carte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `operationseffectuees`
--
ALTER TABLE `operationseffectuees`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `rechargecf`
--
ALTER TABLE `rechargecf`
  MODIFY `id_rech` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salaire`
--
ALTER TABLE `salaire`
  MODIFY `ligne` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
