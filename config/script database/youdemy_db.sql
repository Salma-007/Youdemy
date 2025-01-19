-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 19 jan. 2025 à 23:44
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `youdemy_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom_categorie` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom_categorie`) VALUES
(1, 'php laravel'),
(2, 'Java'),
(5, 'css'),
(6, 'data');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `id_enseignant` int(11) DEFAULT NULL,
  `id_categorie` int(11) DEFAULT NULL,
  `status` enum('pending','accepted','refused') DEFAULT NULL,
  `contenuVideo` longtext DEFAULT NULL,
  `contenuDocument` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `titre`, `description`, `picture`, `id_enseignant`, `id_categorie`, `status`, `contenuVideo`, `contenuDocument`) VALUES
(8, 'courssa', 'asasas', 'mysql basics certificate.jpg', NULL, 1, 'accepted', '', 'sasasa'),
(9, 'cour javaa', 'sasasa', 'mysql basics certificate.jpg', NULL, 2, 'accepted', '', 'adxadx'),
(10, 'HTML5 course', 'azd', 'mysql basics certificate.jpg', NULL, 1, 'accepted', NULL, 'azdxq'),
(11, 'cour lekher tani', 'ecdsx', 'b1.jpg', NULL, 2, 'accepted', 'https://www.youtube.com/watch?v=7_2mVjfBINQ', NULL),
(14, 'JS Course', 'ezgfe', 'b1.jpg', NULL, 2, 'accepted', NULL, 'gzge'),
(23, 'fefez', 'efsdfg', 'b2.jpg', NULL, 2, 'pending', NULL, 'htgrfedsz'),
(24, 'cour avec tags', 'aazsxcccccccccc', 'b2.jpg', NULL, 1, 'accepted', 'https://www.youtube.com/watch?v=fyaI4-5849w', NULL),
(25, 'cour avec tagsss', 'aazsxcccccccccc', 'b2.jpg', NULL, 5, 'pending', 'https://www.youtube.com/watch?v=fyaI4-5849w', ''),
(26, 'cour de Salma', 'this is a very special course, subscribe to learn more', 'b1.jpg', NULL, 1, 'refused', NULL, 'Respect des principes OOP (encapsulation, héritage, polymorphisme).\r\nBase de données relationnelle avec gestion des relations (one-to-many, many-to-many).\r\nUtilisation des sessions PHP pour la gestion des utilisateurs connectés.\r\nSystème de validation des données utilisateur pour garantir la sécurité.'),
(27, 'wah wah', 'fsqdgthyubilo', 'b3.jpg', NULL, 2, 'accepted', '', 'sdfrgtyuiopmùôlikujh'),
(29, 'free course song', 'qsdfgngfbredzdefgbfefgb', 'b1.jpg', 10, 2, 'accepted', 'https://www.youtube.com/watch?v=GeftGVaSxC0', NULL),
(30, 'deuxieme cour ', 'mffffgbvdx', 'b3.jpg', 10, 2, 'pending', '', 'zzzzertyu'),
(32, 'Java JEE course', 'Qu\'est-ce que JAVA / JEE ? Java, couplé avec son framework JEE, permet de développer facilement des applications WEB modernes et de qualité. Largement éprouvés, le langage JAVA et les technologies JEE permettent une stabilité des applications et des gains de performance élevés.', 'java-jee.31273.jpg', 10, 2, 'accepted', 'https://www.youtube.com/watch?v=0IiWomc3W1o', NULL),
(33, 'Java 22', 'Conception d\'applications en Java/JEE\r\n\r\nDunod\r\nhttps://www.dunod.com › sciences-techniques › concepti...\r\nCet ouvrage s\'adresse principalement aux étudiants des cycles informatiques (IUT, LP, licence deuxième et troisième années) ainsi qu\'aux élèves-ingénieurs ...\r\n\r\nJEE (Java Entreprise Edition)\r\n\r\nesbai-redouane.com\r\nhttps://www.esbai-redouane.com › jee-java-entreprise-e...\r\nCe cours a pour objectif de guider vos premiers pas dans l\'univers Java EE : après quelques explications sur les concepts généraux et les bonnes pratiques ...', 'java-jee.31273.jpg', 10, 2, 'pending', NULL, 'Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).'),
(34, 'non inscrit', 'cour non inscriiiiiit', 'Flag-France.webp', 10, 6, 'accepted', NULL, 'Utilisation de la validation côté client avec HTML5 et JavaScript (Natif) pour minimiser les erreurs avant même la soumission du formulaire.\r\nValidation côté serveur doit inclure des mesures pour éviter les attaques de type Cross-Site Scripting (XSS) et Cross-Site Request Forgery (CSRF)\r\nUtilisez des requêtes préparées pour interagir avec la base de données, afin de prévenir les attaques SQL injection.\r\nEffectuez une validation et une échappement des données d\'entrée pour éviter toute injection malveillante.'),
(35, 'Power BI Course', 'Power BI fournit des services d\'informatique décisionnelle (business intelligence, BI en anglais) hébergés sur le cloud, appelés « services Power BI », ainsi qu\'une application de bureau, intitulée « Power BI Desktop ». Il offre des capacités d\' entrepôt de données, notamment la visualisation de données, l\'analyse avec des tableaux de bord interactifs2', 'cover-scrum-board.png', 15, 6, 'pending', NULL, 'Microsoft Power BI est une solution d\'analyse de données de Microsoft. Il permet de créer des visualisations de données personnalisées et interactives avec une interface suffisamment simple pour que les utilisateurs finaux créent leurs propres rapports et tableaux de bord.\r\n\r\nPower BI est un ensemble de services logiciels, d\'applications et de connecteurs qui fonctionnent ensemble pour transformer différentes sources de données en');

-- --------------------------------------------------------

--
-- Structure de la table `cour_tags`
--

CREATE TABLE `cour_tags` (
  `id_cour` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cour_tags`
--

INSERT INTO `cour_tags` (`id_cour`, `id_tag`) VALUES
(8, 5),
(9, 7),
(25, 1),
(25, 5),
(26, 7),
(26, 8),
(26, 9),
(27, 1),
(27, 3),
(27, 5),
(29, 3),
(29, 5),
(29, 6),
(30, 9),
(30, 12),
(30, 13),
(32, 6),
(32, 7),
(32, 8),
(33, 9),
(33, 10),
(33, 11),
(34, 3),
(34, 6),
(35, 3),
(35, 5),
(35, 6);

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `id_etudiant` int(11) NOT NULL,
  `id_cour` int(11) NOT NULL,
  `isFinished` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inscriptions`
--

INSERT INTO `inscriptions` (`id_etudiant`, `id_cour`, `isFinished`) VALUES
(9, 8, 1),
(9, 9, 1),
(9, 10, 0),
(9, 11, 0),
(9, 14, 0),
(9, 24, 0),
(9, 27, 0),
(9, 29, 0),
(9, 32, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `nom_tag` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tags`
--

INSERT INTO `tags` (`id`, `nom_tag`) VALUES
(1, 'successp'),
(3, 'briefff'),
(5, 'new tagg'),
(6, 'debutant'),
(7, 'tags22'),
(8, 'web'),
(9, 'web2.0'),
(10, 'taga'),
(11, 'tagb'),
(12, 'tagc'),
(13, 'versase');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password_hash` varchar(250) DEFAULT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `role` enum('etudiant','enseignant','admin') DEFAULT NULL,
  `isBanned` tinyint(1) DEFAULT 0,
  `enseignantConfirmed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `email`, `password_hash`, `picture`, `role`, `isBanned`, `enseignantConfirmed`) VALUES
(8, 'amir', 'amir@gmail.com', '$2y$12$6XT51riIR8qEDIwf2P.x3.xszAtxyVJkNEwRtOtsD7NjJtgiPtpwS', NULL, 'enseignant', 0, 0),
(9, 'mouad', 'mouad@gmail.com', '$2y$12$cRloblYg2gr77tWPXt87FuoDeq1.WOUQb5044lUDrwpgcft4OhOPC', NULL, 'etudiant', 0, 0),
(10, 'yassine', 'yassine@gmail.com', '$2y$12$Jjsk77WhWTnUoVBOzAXpU.tG1aWES6iMg0B4qHG7IeWe3YHJXyJzK', NULL, 'enseignant', 0, 1),
(14, 'admin', 'admin@gmail.com', '$2y$12$W6E08n5WM7QqpzytgHaefeNE6Msm7mV8kN3eVyW9xch/JziTzaP7.', NULL, 'admin', 0, 0),
(15, 'Chaimae', 'chaimae@gmail.com', '$2y$12$hEQBU5jR.yKLfQWy3ktnVe7ZwuC5qziZjF6TyTJ/IYmaRU0TOoam6', NULL, 'enseignant', 0, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_enseignant` (`id_enseignant`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `cour_tags`
--
ALTER TABLE `cour_tags`
  ADD PRIMARY KEY (`id_cour`,`id_tag`),
  ADD KEY `id_tag` (`id_tag`);

--
-- Index pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id_etudiant`,`id_cour`),
  ADD KEY `inscriptions_ibfk_2` (`id_cour`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`id_enseignant`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cours_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `cour_tags`
--
ALTER TABLE `cour_tags`
  ADD CONSTRAINT `cour_tags_ibfk_1` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id`),
  ADD CONSTRAINT `cour_tags_ibfk_2` FOREIGN KEY (`id_cour`) REFERENCES `cours` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `inscriptions_ibfk_1` FOREIGN KEY (`id_etudiant`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `inscriptions_ibfk_2` FOREIGN KEY (`id_cour`) REFERENCES `cours` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
