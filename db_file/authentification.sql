-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 14 mai 2024 à 17:56
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
-- Base de données : `authentification`
--

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `droit` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `libelle`, `droit`) VALUES
(1, 'user', 'a:4:{s:7:\"consult\";i:1;s:6:\"editer\";i:1;s:3:\"add\";i:1;s:6:\"delete\";i:0;}'),
(2, 'user', 'a:4:{s:7:\"consult\";i:1;s:6:\"editer\";i:1;s:3:\"add\";i:0;s:6:\"delete\";i:0;}'),
(3, 'user', 'a:4:{s:7:\"consult\";i:1;s:6:\"editer\";i:1;s:3:\"add\";i:0;s:6:\"delete\";i:0;}'),
(4, 'user', 'a:4:{s:7:\"consult\";i:1;s:6:\"editer\";i:0;s:3:\"add\";i:0;s:6:\"delete\";i:0;}'),
(5, 'user', 'a:4:{s:7:\"consult\";i:1;s:6:\"editer\";i:0;s:3:\"add\";i:0;s:6:\"delete\";i:0;}'),
(6, 'user', 'a:4:{s:7:\"consult\";i:1;s:6:\"editer\";i:1;s:3:\"add\";i:1;s:6:\"delete\";i:1;}'),
(7, 'user', 'a:4:{s:7:\"consult\";i:1;s:6:\"editer\";i:1;s:3:\"add\";i:0;s:6:\"delete\";i:0;}'),
(8, 'user', 'a:4:{s:7:\"consult\";i:1;s:6:\"editer\";i:1;s:3:\"add\";i:1;s:6:\"delete\";i:1;}'),
(9, 'user', 'a:4:{s:7:\"consult\";i:0;s:6:\"editer\";i:0;s:3:\"add\";i:0;s:6:\"delete\";i:0;}'),
(10, 'user', 'a:4:{s:7:\"consult\";i:1;s:6:\"editer\";i:1;s:3:\"add\";i:1;s:6:\"delete\";i:1;}'),
(11, 'user', 'a:4:{s:7:\"consult\";i:1;s:6:\"editer\";i:1;s:3:\"add\";i:1;s:6:\"delete\";i:1;}'),
(12, 'user', 'a:4:{s:7:\"consult\";i:0;s:6:\"editer\";i:0;s:3:\"add\";i:0;s:6:\"delete\";i:0;}');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` longtext NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `photo`, `role_id`) VALUES
(4, 'Mouhcine Attif', 'mouhcineattif@gmail.com', 'as', '$2y$10$ck4WWP0WYkSzT0kzDcnhXuATUW8DMUcCjuUeJU89IbYUndA3tM66O', 'Logo.png', 7),
(5, 'morad adidi', 'morad@gmail.com', 'morad', '$2y$10$3PZrxqfqcxsZhzeoznYy..MBVs1xxrlo8FollNEns17TMEBtxg0LK', 'Logo.png', 8),
(6, 'abderrezzak diany', 'diany@gmail.com', 'diany', '$2y$10$UK2sSJ2TypufRTDLJgChAeA03pEldO5Uu0Yi.odVgGIdFhHn8A0/6', 'Logo.png', 9),
(7, 'super', 'super@gmail.com', 'super', '$2y$10$wvMbxLucvAW8uZHcRVpfyeEsd4zyyM4BSzvSh6I/6a7SzScQBm6cu', 'moradadidiCertificat.png', 10),
(8, 'youusef', 'ys@gmail.com', 'user', '$2y$10$UPMLY3tL2iovG75y6C1jLeTwuEMfoyQlw.Or.ptrJncaTyp7.sEAC', 'moradadidiCertificat.png', 11),
(9, 'Mouhcine Attif', 'mouhcineattif@gmail.com', 'lavodix', '$2y$10$yuhrlQPasc2kwm1tYlr77.BZwKDjYrDSkv.FBHKTw1ZecE37pfUq.', 'Logo.png', 12);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
