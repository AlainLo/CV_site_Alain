-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : alainlormwbd2018.mysql.db
-- Généré le :  mer. 03 jan. 2018 à 14:43
-- Version du serveur :  5.6.34-log
-- Version de PHP :  7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `alainlormwbd2018`
--
CREATE DATABASE IF NOT EXISTS `alainlormwbd2018` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `alainlormwbd2018`;

-- --------------------------------------------------------

--
-- Structure de la table `t_competences`
--

CREATE TABLE `t_competences` (
  `id_competence` int(3) NOT NULL,
  `competence` varchar(30) CHARACTER SET utf8 NOT NULL,
  `c_niveau` int(3) NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_competences`
--

INSERT INTO `t_competences` (`id_competence`, `competence`, `c_niveau`, `utilisateur_id`) VALUES
(1, 'Photoshop', 51, 1),
(2, 'Illustrator', 35, 2),
(3, 'HTML5', 40, 3),
(5, 'CSS3', 35, 1),
(7, 'SQL', 35, 1),
(8, 'PHP', 15, 1),
(9, 'WordPress', 32, 1),
(10, 'Ajax', 8, 1),
(11, 'InDesign', 40, 1),
(12, 'Xpress', 30, 1),
(13, 'Javascript', 15, 1),
(14, 'Illustrator', 40, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_contacts`
--

CREATE TABLE `t_contacts` (
  `id_commentaire` int(3) NOT NULL,
  `co_nom` varchar(100) NOT NULL,
  `co_email` varchar(100) NOT NULL,
  `co_sujet` varchar(100) NOT NULL,
  `co_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_contacts`
--

INSERT INTO `t_contacts` (`id_commentaire`, `co_nom`, `co_email`, `co_sujet`, `co_message`) VALUES
(0, 'Alain LORTAL', 'alain@lepoles.com', 'je m\'emmerde', 'et zut !');

-- --------------------------------------------------------

--
-- Structure de la table `t_experiences`
--

CREATE TABLE `t_experiences` (
  `id_experience` int(3) NOT NULL,
  `e_titre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `e_soustitre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `e_dates` varchar(50) CHARACTER SET utf8 NOT NULL,
  `e_description` text CHARACTER SET utf8 NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_experiences`
--

INSERT INTO `t_experiences` (`id_experience`, `e_titre`, `e_soustitre`, `e_dates`, `e_description`, `utilisateur_id`) VALUES
(4, 'Développeur/Integrateur web junior', 'LePoleS -WebForce 3', '2017-2018', '<p>Cr&eacute;ation de sites<strong> dynamiques :</strong></p>\r\n\r\n<ul>\r\n	<li>en HTML/CSS</li>\r\n	<li>en PHP/MySQL</li>\r\n	<li>avec du Javascript et de l&#39;Ajax</li>\r\n</ul>\r\n', 1),
(5, 'Chargé de Communication', 'Ares', '2015-2016', '<p><strong>D&eacute;ploiement</strong> de la nouvelle <strong>charte graphique</strong> de l&#39;entreprise.</p>\r\n\r\n<p><strong>Community Manager (Linkedin - Twitter - Facebook)</strong> - Webmaster</p>\r\n', 1),
(6, 'Infographiste', 'Extramuros', '2014-2015', '<p>Cr&eacute;ation de catalogues - <strong>Community Manager</strong> - <strong>Webmaster</strong></p>\r\n', 1),
(7, 'Chargé de Communication', 'CER SNCF Paris-Saint-Lazare', '2001-2010', '<ul>\r\n	<li><strong>Cr&eacute;ation-r&eacute;alisation supports de com</strong> -</li>\r\n	<li><strong>r&eacute;alisation / mise en page / gestion Journal interne</strong></li>\r\n	<li><strong>Webmastering sites internet et Intranet</strong></li>\r\n</ul>\r\n', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_formations`
--

CREATE TABLE `t_formations` (
  `id_formation` int(3) NOT NULL,
  `f_titre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `f_soustitre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `f_dates` varchar(50) CHARACTER SET utf8 NOT NULL,
  `f_description` text CHARACTER SET utf8 NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_formations`
--

INSERT INTO `t_formations` (`id_formation`, `f_titre`, `f_soustitre`, `f_dates`, `f_description`, `utilisateur_id`) VALUES
(2, 'Certification Intégrateur/Développeur Web', 'HTML, CSS, MySQL, PHP, Javascript, WordPress, Boot', '2017', 'Asssociation LePoles - WebForce3', 1),
(6, 'Diplôme d\'Études Approfondies (DEA)', 'Communication, Technologies et Pouvoir', '1995', 'Université Panthéon-Sorbonne Paris I', 1),
(7, 'BAFA', 'Brevet d\'Aptitude aux Fonctions d\'Animateur', 'depuis 1985', '', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_loisirs`
--

CREATE TABLE `t_loisirs` (
  `id_loisir` int(3) NOT NULL,
  `loisir` varchar(30) CHARACTER SET utf8 NOT NULL,
  `utilisateur_id` int(3) NOT NULL,
  `l_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_loisirs`
--

INSERT INTO `t_loisirs` (`id_loisir`, `loisir`, `utilisateur_id`, `l_description`) VALUES
(1, 'cinéma, séries', 1, ''),
(2, 'musique', 1, ''),
(3, 'Son', 1, ''),
(4, 'Photographie', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `t_plus`
--

CREATE TABLE `t_plus` (
  `p_titre` varchar(50) NOT NULL,
  `p_soustitre` varchar(50) NOT NULL,
  `p_description` text NOT NULL,
  `id_plus` int(3) NOT NULL,
  `p_dates` varchar(25) NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_realisations`
--

CREATE TABLE `t_realisations` (
  `id_realisation` int(3) NOT NULL,
  `r_titre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `r_soustitre` varchar(50) CHARACTER SET utf8 NOT NULL,
  `r_dates` varchar(50) CHARACTER SET utf8 NOT NULL,
  `r_description` text CHARACTER SET utf8 NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_realisations`
--

INSERT INTO `t_realisations` (`id_realisation`, `r_titre`, `r_soustitre`, `r_dates`, `r_description`, `utilisateur_id`) VALUES
(1, 'Société Générale', 'UX du site', '20 octobre 2017 - 2 mars 2018', 'interview des utilisateurs côté front et côté back. Élaboration des préconisations de modification de l\'ergonomie générale du site', 1),
(6, 'Annonceo', 'site de petites annonces', 'Octobre 2017', 'réalisation d\'une base dynamique d\'annonces entre particuliers', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_reseaux`
--

CREATE TABLE `t_reseaux` (
  `reseau_id` int(11) NOT NULL,
  `rs_logo` varchar(150) NOT NULL,
  `rs_lien` varchar(150) NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_reseaux`
--

INSERT INTO `t_reseaux` (`reseau_id`, `rs_logo`, `rs_lien`, `utilisateur_id`) VALUES
(2, 'img/linkedin.png', 'linkedin.com/alain-lortal-aa536957', 1),
(4, 'img/github.png', 'https://github.com/AlainLo', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_titre_cv`
--

CREATE TABLE `t_titre_cv` (
  `id_titre_cv` int(3) NOT NULL,
  `titre_cv` text NOT NULL,
  `accroche` text NOT NULL,
  `logo` varchar(20) NOT NULL,
  `utilisateur_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateurs`
--

CREATE TABLE `t_utilisateurs` (
  `id_utilisateur` int(3) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` int(10) UNSIGNED ZEROFILL NOT NULL,
  `mdp` varchar(12) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `avatar` varchar(20) NOT NULL,
  `age` int(3) NOT NULL,
  `date_naissance` date NOT NULL,
  `sexe` enum('H','F','','') NOT NULL,
  `etat_civil` enum('M','Mme','','') NOT NULL,
  `commentaires` text NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `code_postal` int(5) UNSIGNED ZEROFILL NOT NULL,
  `ville` varchar(30) NOT NULL,
  `pays` varchar(20) NOT NULL,
  `site_web` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_utilisateurs`
--

INSERT INTO `t_utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `email`, `telephone`, `mdp`, `pseudo`, `avatar`, `age`, `date_naissance`, `sexe`, `etat_civil`, `commentaires`, `adresse`, `code_postal`, `ville`, `pays`, `site_web`) VALUES
(1, 'Alain', 'LORTAL', 'alain.gm.lortal@free.fr', 0674605319, 'T!6al18H', 'alainlo', '', 51, '1965-11-14', 'H', 'M', '', '62 rue  Louis Castel', 92230, 'GENNEVILLIERS', 'FRANCE', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_competences`
--
ALTER TABLE `t_competences`
  ADD PRIMARY KEY (`id_competence`);

--
-- Index pour la table `t_experiences`
--
ALTER TABLE `t_experiences`
  ADD PRIMARY KEY (`id_experience`);

--
-- Index pour la table `t_formations`
--
ALTER TABLE `t_formations`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `t_loisirs`
--
ALTER TABLE `t_loisirs`
  ADD PRIMARY KEY (`id_loisir`);

--
-- Index pour la table `t_plus`
--
ALTER TABLE `t_plus`
  ADD PRIMARY KEY (`id_plus`);

--
-- Index pour la table `t_realisations`
--
ALTER TABLE `t_realisations`
  ADD PRIMARY KEY (`id_realisation`);

--
-- Index pour la table `t_reseaux`
--
ALTER TABLE `t_reseaux`
  ADD PRIMARY KEY (`reseau_id`);

--
-- Index pour la table `t_titre_cv`
--
ALTER TABLE `t_titre_cv`
  ADD PRIMARY KEY (`id_titre_cv`);

--
-- Index pour la table `t_utilisateurs`
--
ALTER TABLE `t_utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_competences`
--
ALTER TABLE `t_competences`
  MODIFY `id_competence` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT pour la table `t_experiences`
--
ALTER TABLE `t_experiences`
  MODIFY `id_experience` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `t_formations`
--
ALTER TABLE `t_formations`
  MODIFY `id_formation` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `t_loisirs`
--
ALTER TABLE `t_loisirs`
  MODIFY `id_loisir` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `t_plus`
--
ALTER TABLE `t_plus`
  MODIFY `id_plus` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_realisations`
--
ALTER TABLE `t_realisations`
  MODIFY `id_realisation` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `t_reseaux`
--
ALTER TABLE `t_reseaux`
  MODIFY `reseau_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `t_titre_cv`
--
ALTER TABLE `t_titre_cv`
  MODIFY `id_titre_cv` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_utilisateurs`
--
ALTER TABLE `t_utilisateurs`
  MODIFY `id_utilisateur` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
