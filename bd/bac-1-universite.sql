-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 05 août 2024 à 22:55
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
-- Base de données : `bac-1-universite`
--

-- --------------------------------------------------------

--
-- Structure de la table `attendance_history`
--

CREATE TABLE `attendance_history` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `presence` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `attendance_history`
--

INSERT INTO `attendance_history` (`id`, `student_id`, `date`, `presence`) VALUES
(5, 6, '2024-08-05', 1),
(6, 7, '2024-08-05', 1);

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Prix` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payments_list`
--

CREATE TABLE `payments_list` (
  `id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `PaymentSchedule` varchar(255) NOT NULL,
  `BillNumber` varchar(255) NOT NULL,
  `AmountPaid` varchar(255) NOT NULL,
  `BalanceAmount` varchar(255) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `students_list`
--

CREATE TABLE `students_list` (
  `Id` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Promotion` varchar(255) NOT NULL,
  `NumeroMatricule` varchar(255) NOT NULL,
  `DateUpDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `students_list`
--

INSERT INTO `students_list` (`Id`, `img`, `Name`, `Email`, `Promotion`, `NumeroMatricule`, `DateUpDate`) VALUES
(6, 'MKDEV002.png', '2MJULES', 'julesmukadi.dev@gmail.com', '+243837449954', '2023021006', '2024-08-04'),
(7, '3JTECH.png', 'MUKADI Jules', 'julesmukadi.dev@gmail.com', '+243837449954', '2023021006', '2024-08-04'),
(11, '07a2066d3688b8436b7dc0f9670d7157.jpg', 'MUKADI Julien', 'julesmukadi.dev@gmail.com', 'Bac 1 Polytechnique', '2023021010', '2024-08-05'),
(12, 'JULES_P_PASSEPORT.png', 'MUKADI Rulio', 'julesmukadi.dev@gmail.com', 'Bac 1 Géo mine', '2023021011', '2024-08-05');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `Email`, `Password`) VALUES
(1, 'Jules', 'jules@gmail.com', 'Jules123'),
(2, 'MUKADI', 'julien@gmail.com', '123456789');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attendance_history`
--
ALTER TABLE `attendance_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Index pour la table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payments_list`
--
ALTER TABLE `payments_list`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `students_list`
--
ALTER TABLE `students_list`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attendance_history`
--
ALTER TABLE `attendance_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `payments_list`
--
ALTER TABLE `payments_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `students_list`
--
ALTER TABLE `students_list`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attendance_history`
--
ALTER TABLE `attendance_history`
  ADD CONSTRAINT `attendance_history_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students_list` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
