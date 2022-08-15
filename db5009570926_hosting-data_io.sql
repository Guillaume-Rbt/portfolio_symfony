-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Hôte : db5009570926.hosting-data.io
-- Généré le : lun. 15 août 2022 à 15:33
-- Version du serveur : 5.7.38-log
-- Version de PHP : 7.0.33-0+deb9u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbs8115007`
--
CREATE DATABASE IF NOT EXISTS `dbs8115007` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dbs8115007`;

-- --------------------------------------------------------

--
-- Structure de la table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `github_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `config`
--

INSERT INTO `config` (`id`, `name`, `firstname`, `birth_date`, `description`, `phone`, `linkedin_link`, `github_link`, `email`, `cv`, `photo`) VALUES
(1, 'Robert', 'Guillaume', '15/06/1995', '<p>Apr&egrave;s l&rsquo;obtention d&rsquo;une licence en Musicologie, j&rsquo;ai travaill&eacute; comme ing&eacute;nieur du son et professeur de musique freelance, en parall&egrave;le de mon activit&eacute; professionnelle principale.</p>\r\n\r\n<p>Attir&eacute; par les nouvelles technologies, j&rsquo;ai int&eacute;gr&eacute; la formation Acces Code School &ldquo;Concepteur/Designer UI&rdquo; en 2021, qui me permet de travailler comme Web Designer/D&eacute;veloppeur front-end.</p>', '0605021416', 'https://www.linkedin.com/in/guillaume-robert-258507158/', 'https://github.com/Guillaume-Rbt', 'contact@guillaume-webdev.fr', 'Guillaume-Robert-2-62f98fa00de8b.pdf', 'portfolio-62ec45ffcf601.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220527185422', '2022-05-27 18:54:41', 492),
('DoctrineMigrations\\Version20220529201549', '2022-05-29 20:16:35', 1926),
('DoctrineMigrations\\Version20220715185439', '2022-07-15 18:54:51', 631),
('DoctrineMigrations\\Version20220715221225', '2022-07-15 22:12:35', 816),
('DoctrineMigrations\\Version20220715222236', '2022-07-15 22:22:45', 653),
('DoctrineMigrations\\Version20220715222451', '2022-07-15 22:24:58', 565),
('DoctrineMigrations\\Version20220720183802', '2022-07-20 18:38:26', 325),
('DoctrineMigrations\\Version20220721222605', '2022-07-21 22:26:19', 548),
('DoctrineMigrations\\Version20220721223121', '2022-07-21 22:32:02', 432),
('DoctrineMigrations\\Version20220721223311', '2022-07-21 22:33:38', 470),
('DoctrineMigrations\\Version20220804134256', '2022-08-04 13:43:01', 422),
('DoctrineMigrations\\Version20220804134448', '2022-08-04 13:44:54', 374),
('DoctrineMigrations\\Version20220804183022', '2022-08-04 18:30:35', 508);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `technology` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `github` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `project`
--

INSERT INTO `project` (`id`, `name`, `image`, `description`, `technology`, `github`, `site`) VALUES
(9, 'Les ciseaux de Florine', 'lesciseauxdeflorine-62f174c542ad9.png', 'Développement d\'un thème enfant pour un site de coiffure à domicile.', 'Wordpress, HTML, PHP, FIGMA, SCSS', 'https://github.com/Guillaume-Rbt/lcf', 'https://lesciseauxdeflorine.fr/'),
(10, 'Sprint', 'contactUs-62fa57a92bbbf.png', 'Intégration d\'une maquette en assurant le responsive.', 'HTML, SCSS, JavaScript', 'https://github.com/Guillaume-Rbt/Sprint', NULL),
(11, 'Blog de la promotion', 'blog-promo-62fa57b9758c0.png', 'Maquettage et intégration sur Wordpress (thème enfant) du blog de la promotion de la formation ACS', 'HTML, SCSS, JavaScript, PHP, Wordpress, FIGMA, Photoshop, Illustrator', 'https://github.com/Guillaume-Rbt/blogpromo', NULL),
(12, 'Jeu Flappybird', 'flapybird-62fa57cc358dc.png', 'Programmation en Javascript du jeu Flappybird', 'Javascript, HTML, CSS', 'https://github.com/Guillaume-Rbt/flappybird', NULL),
(13, '3L aménagement', '3lamengement-62fa57f497c03.png', 'Création d\'un site pour une entreprise d\'aménagement, réalisé lors de mon stage au sein de Netizis.', 'PHP, HTML, SCSS, JavaScript, Bootstrap, FIGMA, Photoshop, Illustrator, SVGator', 'https://github.com/Guillaume-Rbt/3lamenagement-v2', 'https://3lamenagement.fr/'),
(14, 'Esthetique pro', 'esthetique-pro-62fa58180862a.png', 'Création d\'un site pour une entreprise de matériel de soin et d\'esthétique , réalisé lors de mon stage au sein de Netizis.', 'PHP, HTML, SCSS, JavaScript, Bootstrap, FIGMA, Photoshop, Illustrator', 'https://github.com/Guillaume-Rbt/materiel_esthetique', 'https://www.materiel-esthetique.fr/'),
(15, 'Laque Design', 'laque-design-62fa5e839e2b1.png', 'Intégration sur Joomla d\'un site pour un entreprise de peinture industrielle, réalisé lors de mon stage au sein de l\'agence Netizis.', 'Joomla, SP Page Builder, CSS, Illustrator, Photoshop, SVgator', NULL, 'https://www.laquedesign.com/');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
(1, 'Guillaume', 'robert.guillaume70@laposte.net', '$2y$13$ABbd2Jsms0vBOg6GKPtHE.ahfzycxMtq36buWUTsZB3cAcY0HO7v.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
