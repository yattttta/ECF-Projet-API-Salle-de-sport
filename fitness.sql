-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 31 oct. 2022 à 23:07
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fitness`
--

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
('DoctrineMigrations\\Version20221027172122', '2022-10-27 19:21:43', 5732),
('DoctrineMigrations\\Version20221029183543', '2022-10-29 20:36:15', 2888),
('DoctrineMigrations\\Version20221029222008', '2022-10-30 00:20:25', 650);

-- --------------------------------------------------------

--
-- Structure de la table `franchise`
--

CREATE TABLE `franchise` (
  `id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `city` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `franchise`
--

INSERT INTO `franchise` (`id`, `login_id`, `city`) VALUES
(1, 2, 'Lyon'),
(2, 3, 'Bordeaux'),
(3, 4, 'Lille'),
(4, 5, 'Paris'),
(5, 6, 'Marseille'),
(6, 7, 'Marsanne');

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id`, `roles`, `password`, `email`, `active`) VALUES
(1, '[\"ROLE_ADMIN\"]', '$2y$13$QvNiJilXvUF9A7LqYCmYBeAVwUNDlSxNHQZCfG84uSvRmi2aHCCUG', 'admin@admin.fr', 1),
(2, '[\"ROLE_USER\"]', '$2y$13$MpcudiPeXNGZbA3UVzt29OQxSQ8JbRP7YHpexcMGzrIvtq5ppEG16', 'lyonFranchise@lyonFranchise.fr', 1),
(3, '[\"ROLE_USER\"]', '$2y$13$PpIgk29I2ZXSvAgaCEzeJuWdd5X./UTEAGin65jW73D94DSFLF.Yq', 'bordeauxFranchise@bordeauxFranchise.fr', 1),
(4, '[\"ROLE_USER\"]', '$2y$13$rMH/vH95tm9/G7XDPzt0TuavHqyW1Z4oM59iQy4PhZTQWDSg.SXqe', 'lilleFranchise@lilleFranchise.fr', 1),
(5, '[\"ROLE_USER\"]', '$2y$13$HzLIyds3gckoKTWTMczMwePHhkGpRh.Acc44Gft9QF0vCyFxS0BUi', 'parisFranchise@parisFranchise.fr', 1),
(6, '[\"ROLE_USER\"]', '$2y$13$J76EOXsWMIHhLguEJwRAFeiYO7e/LGdC5qEB5zh9HzcisMf4hjHym', 'marseilleFranchise@marseilleFranchise.fr', 1),
(7, '[\"ROLE_USER\"]', '$2y$13$J76EOXsWMIHhLguEJwRAFeiYO7e/LGdC5qEB5zh9HzcisMf4hjHym', 'marsanneFranchise@marsanneFranchise.fr', 1),
(78, '[\"ROLE_USER\"]', '$2y$13$m3eJMAQv0YTmjymsAVibzueSEXHhRM0mMyv.fx4sK.p1iZKGwj05y', 'directeurLyon@lyon.fr', 1),
(79, '[\"ROLE_USER\"]', '$2y$13$1wNmOX4YO0vVVRh51l3CkOeMBjpZVaxbO2Dwc8oPUTDEEDLIzJP8u', 'gerantParis@paris.fr', 1);

-- --------------------------------------------------------

--
-- Structure de la table `permissions_list`
--

CREATE TABLE `permissions_list` (
  `id` int(11) NOT NULL,
  `structures_id` int(11) NOT NULL,
  `drink_sales` tinyint(1) DEFAULT NULL,
  `food_sales` tinyint(1) DEFAULT NULL,
  `members_statistics` tinyint(1) DEFAULT NULL,
  `members_subscriptions` tinyint(1) DEFAULT NULL,
  `payment_schedules` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions_list`
--

INSERT INTO `permissions_list` (`id`, `structures_id`, `drink_sales`, `food_sales`, `members_statistics`, `members_subscriptions`, `payment_schedules`) VALUES
(7, 33, 0, 1, 1, 0, 1),
(8, 34, 0, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `structures`
--

CREATE TABLE `structures` (
  `id` int(11) NOT NULL,
  `franchise_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `structures`
--

INSERT INTO `structures` (`id`, `franchise_id`, `login_id`, `address`) VALUES
(33, 1, 78, '30 rue de Lyon'),
(34, 4, 79, '30 rue de paris');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `franchise`
--
ALTER TABLE `franchise`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_66F6CE2A5CB2E05D` (`login_id`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `permissions_list`
--
ALTER TABLE `permissions_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_BF04203D9D3ED38D` (`structures_id`);

--
-- Index pour la table `structures`
--
ALTER TABLE `structures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_5BBEC55A5CB2E05D` (`login_id`),
  ADD KEY `IDX_5BBEC55A523CAB89` (`franchise_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `franchise`
--
ALTER TABLE `franchise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT pour la table `permissions_list`
--
ALTER TABLE `permissions_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `structures`
--
ALTER TABLE `structures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `franchise`
--
ALTER TABLE `franchise`
  ADD CONSTRAINT `FK_66F6CE2A5CB2E05D` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`);

--
-- Contraintes pour la table `permissions_list`
--
ALTER TABLE `permissions_list`
  ADD CONSTRAINT `FK_BF04203D9D3ED38D` FOREIGN KEY (`structures_id`) REFERENCES `structures` (`id`);

--
-- Contraintes pour la table `structures`
--
ALTER TABLE `structures`
  ADD CONSTRAINT `FK_5BBEC55A523CAB89` FOREIGN KEY (`franchise_id`) REFERENCES `franchise` (`id`),
  ADD CONSTRAINT `FK_5BBEC55A5CB2E05D` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
