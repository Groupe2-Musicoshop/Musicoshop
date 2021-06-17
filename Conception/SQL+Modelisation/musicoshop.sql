-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 17 juin 2021 à 11:42
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `musicoshop`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `Id_Article` int(11) NOT NULL,
  `qtestock` int(11) DEFAULT NULL,
  `prix` decimal(15,2) DEFAULT NULL,
  `note` decimal(15,2) DEFAULT NULL,
  `Id_Instrument` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`Id_Article`, `qtestock`, `prix`, `note`, `Id_Instrument`) VALUES
(1, 4, '1161.00', '4.00', 1),
(2, 14, '461.00', '2.00', 2),
(3, 3, '790.00', '5.00', 3),
(4, 6, '1118.00', '5.00', 4),
(5, 9, '580.00', '5.00', 5),
(6, 97, '978.00', '4.00', 6),
(7, 4, '1451.00', '1.00', 7),
(8, 0, '1110.00', '2.00', 8),
(9, 15, '1007.00', '4.00', 9),
(10, 12, '1063.00', '2.00', 10),
(11, 12, '1433.00', '1.00', 11),
(12, 12, '377.00', '5.00', 12),
(13, 14, '572.00', '1.00', 13),
(14, 14, '658.00', '3.00', 14),
(15, 0, '920.00', '5.00', 15),
(16, 4, '595.00', '1.00', 16),
(17, 4, '693.00', '3.00', 17),
(18, 2, '219.00', '2.00', 18),
(19, 9, '693.00', '1.00', 19),
(20, 5, '786.00', '4.00', 20),
(21, 13, '162.00', '1.00', 21),
(22, 14, '1047.00', '2.00', 22),
(23, 13, '238.00', '5.00', 23),
(24, 11, '422.00', '2.00', 24),
(25, 0, '527.00', '5.00', 25),
(26, 3, '662.00', '4.00', 26),
(27, 6, '1337.00', '2.00', 27),
(28, 5, '1331.00', '5.00', 28),
(29, 2, '1216.00', '2.00', 29),
(30, 4, '1278.00', '3.00', 30),
(31, 5, '520.00', '1.00', 31),
(32, 5, '355.00', '1.00', 32),
(33, 6, '1354.00', '2.00', 33),
(34, 3, '962.00', '3.00', 34),
(35, 6, '960.00', '2.00', 35),
(36, 5, '1059.00', '3.00', 36),
(37, 8, '745.00', '2.00', 37),
(38, 8, '1239.00', '4.00', 38),
(39, 9, '219.00', '4.00', 39),
(40, 5, '331.00', '5.00', 40),
(41, 12, '876.00', '4.00', 41),
(42, 2, '238.00', '1.00', 42),
(43, 4, '211.00', '5.00', 43),
(44, 0, '685.00', '4.00', 44),
(45, 0, '874.00', '1.00', 45),
(46, 3, '1175.00', '2.00', 46),
(47, 3, '275.00', '5.00', 47),
(48, 5, '507.00', '4.00', 48),
(49, 15, '596.00', '5.00', 49),
(50, 7, '406.00', '1.00', 50),
(51, 11, '367.00', '4.00', 51);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `libele` varchar(50) DEFAULT NULL,
  `page` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `libele`, `page`) VALUES
(1, 'Guitares & Basses', 'cat-guitares_basses'),
(2, 'Batteries & Percussions', 'cat-batteries_percussions'),
(3, 'Pianos & Claviers', 'cat-pianos_claviers'),
(4, 'Instruments à Vent', 'cat-instruments_a_vent'),
(5, 'Instruments à Cordes Frottées', 'cat-instruments_a_cordes_frottees'),
(6, 'Instruments à Cordes', 'cat-instruments_a_cordes');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idCmd` int(11) NOT NULL,
  `numCmd` varchar(50) DEFAULT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `dateCmd` varchar(50) DEFAULT NULL,
  `description` tinytext DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`idCmd`, `numCmd`, `idUtilisateur`, `dateCmd`, `description`, `total`) VALUES
(1, '202104201', 2, 'mardi 20 avril 2021', 'Comprenant: <br> - 6 harpe à 527.00 € Pour un total de 3162.00 €', '3162.00'),
(2, '202104202', 2, 'mardi 20 avril 2021', 'Comprenant: <br> - 1 lyre à 520.00 € Pour un total de 520.00 €', '520.00'),
(3, '202104203', 2, 'mardi 20 avril 2021', 'Comprenant: <br> - 1 banjo à 580.00 € Pour un total de 580.00 €', '580.00'),
(4, '202104204', 2, 'mardi 20 avril 2021', 'Comprenant: <br> - 1 banjo à 580.00 € Pour un total de 580.00 €', '580.00'),
(5, '202104205', 2, 'mardi 20 avril 2021', 'Comprenant: <br> - 1 ukulélé à 507.00 € Pour un total de 507.00 €', '507.00'),
(6, '202104206', 2, 'mardi 20 avril 2021', 'Comprenant: <br> - 1 guitare à 238.00 € Pour un total de 238.00 €', '238.00'),
(7, '202104207', 2, 'mardi 20 avril 2021', 'Comprenant: <br> - 1 Xylophone à 1047.00 € Pour un total de 1047.00 €', '1047.00'),
(8, '202104208', 2, 'mardi 20 avril 2021', 'Comprenant: <br> - 1 lyre à 520.00 € Pour un total de 520.00 €', '520.00'),
(9, '202104209', 2, 'mardi 20 avril 2021', 'Comprenant: <br> - 1 banjo à 580.00 € Pour un total de 580.00 €', '580.00'),
(10, '2021042010', 2, 'mardi 20 avril 2021', 'Comprenant: <br> - 1 guitare basse à 978.00 € Pour un total de 978.00 €', '978.00'),
(11, '2021042011', 2, 'mardi 20 avril 2021', 'Comprenant: ', '0.00'),
(12, '2021042012', 2, 'mardi 20 avril 2021', 'Comprenant: ', '0.00'),
(13, '2021042013', 2, 'mardi 20 avril 2021', 'Comprenant: ', '0.00'),
(14, '2021042014', 2, 'mardi 20 avril 2021', 'Comprenant: ', '0.00'),
(15, '2021042015', 2, 'mardi 20 avril 2021', 'Comprenant: ', '0.00'),
(16, '2021042016', 2, 'mardi 20 avril 2021', 'Comprenant: ', '0.00'),
(17, '2021042017', 2, 'mardi 20 avril 2021', 'Comprenant: ', '0.00'),
(18, '2021042018', 2, 'mardi 20 avril 2021', 'Comprenant: ', '0.00'),
(19, '2021042019', 2, 'mardi 20 avril 2021', 'Comprenant: ', '0.00'),
(20, '2021042220', 2, 'jeudi 22 avril 2021', 'Comprenant: <br> - 1 lyre à 520.00 € Pour un total de 520.00 €<br> - 1 tuba-contrebasse à 211.00 € Pour un total de 211.00 €', '731.00'),
(21, '2021042221', 2, 'jeudi 22 avril 2021', 'Comprenant: <br> - 2 flûte à 786.00 € Pour un total de 1572.00 €<br> - 1 guitare basse à 978.00 € Pour un total de 978.00 €', '2550.00'),
(22, '2021042222', 3, 'jeudi 22 avril 2021', 'Comprenant: <br> - 1 guitare basse à 978.00 € Pour un total de 978.00 €', '978.00');

-- --------------------------------------------------------

--
-- Structure de la table `hibernate_sequence`
--

CREATE TABLE `hibernate_sequence` (
  `next_val` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `hibernate_sequence`
--

INSERT INTO `hibernate_sequence` (`next_val`) VALUES
(1);

-- --------------------------------------------------------

--
-- Structure de la table `instruments`
--

CREATE TABLE `instruments` (
  `Id_Instrument` int(11) NOT NULL,
  `designation` varchar(50) DEFAULT NULL,
  `img` text DEFAULT NULL,
  `idCategorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `instruments`
--

INSERT INTO `instruments` (`Id_Instrument`, `designation`, `img`, `idCategorie`) VALUES
(1, 'accordéon', 'http://localhost:8080/Musicoshop/img/cart_img/1-accordéon.png', 3),
(2, 'corne de brume', 'http://localhost:8080/Musicoshop/img/cart_img/2-corne_de_brume.png', 4),
(3, 'piano à queue', 'http://localhost:8080/Musicoshop/img/cart_img/3-piano_a_queue.png', 3),
(4, 'cornemuse', 'http://localhost:8080/Musicoshop/img/cart_img/4-cornemuse.png', 4),
(5, 'banjo', 'http://localhost:8080/Musicoshop/img/cart_img/5-banjo.png', 1),
(6, 'guitare basse', 'http://localhost:8080/Musicoshop/img/cart_img/6-guitare_basse.png', 1),
(7, 'basson', 'http://localhost:8080/Musicoshop/img/cart_img/7-basson.png', 4),
(8, 'Trompette', 'http://localhost:8080/Musicoshop/img/cart_img/8-Trompette.png', 4),
(9, 'calliope', 'http://localhost:8080/Musicoshop/img/cart_img/9-callipe.png', 4),
(10, 'violoncelle', 'http://localhost:8080/Musicoshop/img/cart_img/10-violoncelle.png', 5),
(11, 'clarinette', 'http://localhost:8080/Musicoshop/img/cart_img/11-clarinette.png', 4),
(12, 'clavicorde', 'http://localhost:8080/Musicoshop/img/cart_img/12-clavicorde.png', 3),
(13, 'concertina', 'http://localhost:8080/Musicoshop/img/cart_img/13-concertina.png', 3),
(14, 'didgeridoo', 'http://localhost:8080/Musicoshop/img/cart_img/14-didgeridoo.png', 4),
(15, 'dobro', 'http://localhost:8080/Musicoshop/img/cart_img/15-dobro.png', 1),
(16, 'dulcimer', 'http://localhost:8080/Musicoshop/img/cart_img/16-dulcimer.png', 1),
(17, 'violon', 'http://localhost:8080/Musicoshop/img/cart_img/17-violon.png', 5),
(18, 'fifre', 'http://localhost:8080/Musicoshop/img/cart_img/18-fifre.png', 4),
(19, 'Trumpette Soprano', 'http://localhost:8080/Musicoshop/img/cart_img/19-Trumpette_Soprano.png', 4),
(20, 'flûte', 'http://localhost:8080/Musicoshop/img/cart_img/20-flute.png', 4),
(21, 'cor dharmonie', 'http://localhost:8080/Musicoshop/img/cart_img/21-cor_d_harmonie.png', 4),
(22, 'Xylophone', 'http://localhost:8080/Musicoshop/img/cart_img/22-Xylophone.png', 2),
(23, 'guitare', 'http://localhost:8080/Musicoshop/img/cart_img/23-guitare.png', 1),
(24, 'harmonica', 'http://localhost:8080/Musicoshop/img/cart_img/24-harmonica.png', 4),
(25, 'harpe', 'http://localhost:8080/Musicoshop/img/cart_img/25-harpe.png', 6),
(26, 'clavecin', 'http://localhost:8080/Musicoshop/img/cart_img/26-clavecin.png', 3),
(27, 'vielle à roue', 'http://localhost:8080/Musicoshop/img/cart_img/27-vielle_a_roue.png', 5),
(28, 'kazoo', 'http://localhost:8080/Musicoshop/img/cart_img/28-kazoo.png', 4),
(29, 'grosse caisse', 'http://localhost:8080/Musicoshop/img/cart_img/29-grosse_caisse.png', 2),
(30, 'luth', 'http://localhost:8080/Musicoshop/img/cart_img/30-luth.png', 1),
(31, 'lyre', 'http://localhost:8080/Musicoshop/img/cart_img/31-lyre.png', 6),
(32, 'mandoline', 'http://localhost:8080/Musicoshop/img/cart_img/32-mandoline.png', 1),
(33, 'marimba', 'http://localhost:8080/Musicoshop/img/cart_img/33-marimba.png', 2),
(34, 'mellotron', 'http://localhost:8080/Musicoshop/img/cart_img/34-mellotron.png', 3),
(35, 'mélodica', 'http://localhost:8080/Musicoshop/img/cart_img/35-mélodica.png', 4),
(36, 'hautbois', 'http://localhost:8080/Musicoshop/img/cart_img/36-hautbois.png', 4),
(37, 'flûte de pan', 'http://localhost:8080/Musicoshop/img/cart_img/37-flûte_de_pan.png', 4),
(38, 'piano', 'http://localhost:8080/Musicoshop/img/cart_img/38-piano.png', 3),
(39, 'piccolo', 'http://localhost:8080/Musicoshop/img/cart_img/39-piccolo.png', 4),
(40, 'orgue à tuyaux', 'http://localhost:8080/Musicoshop/img/cart_img/40-orgue_a_tuyaux.png', 3),
(41, 'saxophone', 'http://localhost:8080/Musicoshop/img/cart_img/41-saxophone.png', 4),
(42, 'sitar', 'http://localhost:8080/Musicoshop/img/cart_img/42-sitar.png', 1),
(43, 'tuba-contrebasse', 'http://localhost:8080/Musicoshop/img/cart_img/43-tuba_contrebasse.png', 4),
(44, 'tambourin', 'http://localhost:8080/Musicoshop/img/cart_img/44-tambourin.png', 2),
(45, 'thérémine', 'http://localhost:8080/Musicoshop/img/cart_img/45-thérémine.png', 3),
(46, 'trombone à coulisse', 'http://localhost:8080/Musicoshop/img/cart_img/46-trombone_a_coulisse.png', 4),
(47, 'tuba', 'http://localhost:8080/Musicoshop/img/cart_img/47-tuba.png', 4),
(48, 'ukulélé', 'http://localhost:8080/Musicoshop/img/cart_img/48-ukulélé.png', 1),
(49, 'alto', 'http://localhost:8080/Musicoshop/img/cart_img/49-violon_alto.png', 5),
(50, 'cithare', 'http://localhost:8080/Musicoshop/img/cart_img/50-cithare.png', 1),
(51, 'vuvuzela', 'http://localhost:8080/Musicoshop/img/cart_img/51-vuvuzela.png', 4);

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE `ligne_commande` (
  `idLigneCmd` int(11) NOT NULL,
  `idCmd` int(11) NOT NULL,
  `Id_Article` int(11) NOT NULL,
  `qtite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`idLigneCmd`, `idCmd`, `Id_Article`, `qtite`) VALUES
(1, 1, 25, 6),
(2, 2, 31, 1),
(3, 3, 5, 1),
(4, 4, 5, 1),
(5, 5, 48, 1),
(6, 6, 23, 1),
(7, 7, 22, 1),
(8, 8, 31, 1),
(9, 9, 5, 1),
(10, 10, 6, 1),
(11, 20, 31, 1),
(12, 20, 43, 1),
(13, 21, 20, 2),
(14, 21, 6, 1),
(15, 22, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `Id_Panier` int(11) NOT NULL,
  `sessId` varchar(50) DEFAULT NULL,
  `qtite_Art` int(11) DEFAULT NULL,
  `Id_Article` int(11) DEFAULT NULL,
  `prixT` decimal(15,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`Id_Panier`, `sessId`, `qtite_Art`, `Id_Article`, `prixT`) VALUES
(20, 'uqali09la65o42phihst0807pc', 1, 5, '580.00'),
(21, '4ns53evd2e44gosdum4u9pbnt4', 1, 6, '978.00');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` int(11) NOT NULL,
  `userName` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `valideuser` tinyint(1) DEFAULT NULL,
  `changepwd` tinyint(1) DEFAULT NULL,
  `sexe` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `codePostal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `userName`, `email`, `type`, `password`, `valideuser`, `changepwd`, `sexe`, `nom`, `prenom`, `tel`, `adresse`, `ville`, `codePostal`) VALUES
(1, 'Pierre', 'pierre.lange@free.fr', 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, 0, '', '', '', NULL, NULL, NULL, NULL),
(2, 'pierre.lange', 'pierre.lange@gmail.com', 'user', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 1, 0, 'M.', 'LANGE', 'Pierre', NULL, '10 Rue Pablo Neruda', 'Torcyé', 77200),
(3, 'gonebad', 'gone@free.fr', 'user', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, 0, 'M.', 'gone', 'bad', NULL, '12 rue de paris', 'nantes', 44100);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`Id_Article`),
  ADD KEY `Id_Instrument` (`Id_Instrument`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCmd`),
  ADD KEY `idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `instruments`
--
ALTER TABLE `instruments`
  ADD PRIMARY KEY (`Id_Instrument`),
  ADD KEY `idCategorie` (`idCategorie`);

--
-- Index pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD PRIMARY KEY (`idLigneCmd`),
  ADD KEY `Id_Article` (`Id_Article`),
  ADD KEY `idCmd` (`idCmd`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`Id_Panier`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`),
  ADD UNIQUE KEY `unique_email_utilisateur` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `Id_Article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `instruments`
--
ALTER TABLE `instruments`
  MODIFY `Id_Instrument` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  MODIFY `idLigneCmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `Id_Panier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`Id_Instrument`) REFERENCES `instruments` (`Id_Instrument`) ON DELETE CASCADE;

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `instruments`
--
ALTER TABLE `instruments`
  ADD CONSTRAINT `instruments_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`);

--
-- Contraintes pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD CONSTRAINT `ligne_commande_ibfk_1` FOREIGN KEY (`Id_Article`) REFERENCES `article` (`Id_Article`),
  ADD CONSTRAINT `ligne_commande_ibfk_2` FOREIGN KEY (`idCmd`) REFERENCES `commande` (`idCmd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
