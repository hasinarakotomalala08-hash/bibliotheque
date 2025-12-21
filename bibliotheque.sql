-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.4.3 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour bibliotheque
DROP DATABASE IF EXISTS `bibliotheque`;
CREATE DATABASE IF NOT EXISTS `bibliotheque` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `bibliotheque`;

-- Listage de la structure de table bibliotheque. adherents
DROP TABLE IF EXISTS `adherents`;
CREATE TABLE IF NOT EXISTS `adherents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `date_inscription` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bibliotheque.adherents : ~5 rows (environ)
DELETE FROM `adherents`;
INSERT INTO `adherents` (`id`, `nom`, `prenom`, `email`, `date_inscription`) VALUES
	(1, 'Dupont', 'Jean', 'jean.dupont@email.com', '2025-12-19 13:36:43'),
	(2, 'Martin', 'Marie', 'marie.martin@email.com', '2025-12-19 13:36:43'),
	(3, 'Bernard', 'Pierre', 'pierre.bernard@email.com', '2025-12-19 13:36:43'),
	(4, 'Dubois', 'Sophie', 'sophie.dubois@email.com', '2025-12-19 13:36:43'),
	(5, 'Roux', 'Lucas', 'lucas.roux@email.com', '2025-12-19 13:36:43');

-- Listage de la structure de table bibliotheque. emprunts
DROP TABLE IF EXISTS `emprunts`;
CREATE TABLE IF NOT EXISTS `emprunts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `livre_id` int NOT NULL,
  `adherent_id` int NOT NULL,
  `date_emprunt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `date_retour_prevue` date NOT NULL,
  `date_retour_effective` date DEFAULT NULL,
  `statut` enum('en_cours','retourne') DEFAULT 'en_cours',
  PRIMARY KEY (`id`),
  KEY `livre_id` (`livre_id`),
  KEY `adherent_id` (`adherent_id`),
  KEY `idx_emprunt_statut` (`statut`),
  KEY `idx_emprunt_dates` (`date_emprunt`,`date_retour_prevue`),
  CONSTRAINT `emprunts_ibfk_1` FOREIGN KEY (`livre_id`) REFERENCES `livres` (`id`) ON DELETE CASCADE,
  CONSTRAINT `emprunts_ibfk_2` FOREIGN KEY (`adherent_id`) REFERENCES `adherents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bibliotheque.emprunts : ~1 rows (environ)
DELETE FROM `emprunts`;
INSERT INTO `emprunts` (`id`, `livre_id`, `adherent_id`, `date_emprunt`, `date_retour_prevue`, `date_retour_effective`, `statut`) VALUES
	(1, 8, 1, '2025-12-20 06:33:32', '2025-12-25', NULL, 'en_cours');

-- Listage de la structure de table bibliotheque. livres
DROP TABLE IF EXISTS `livres`;
CREATE TABLE IF NOT EXISTS `livres` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `nb_exemplaires` int NOT NULL DEFAULT '0',
  `nb_disponibles` int NOT NULL DEFAULT '0',
  `date_ajout` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_livre_titre` (`titre`),
  KEY `idx_livre_auteur` (`auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table bibliotheque.livres : ~7 rows (environ)
DELETE FROM `livres`;
INSERT INTO `livres` (`id`, `titre`, `auteur`, `nb_exemplaires`, `nb_disponibles`, `date_ajout`) VALUES
	(1, 'Les Misérables', 'Victor Hugo', 3, 3, '2025-12-19 13:36:42'),
	(2, 'Le Petit Prince', 'Antoine de Saint-Exupéry', 5, 5, '2025-12-19 13:36:42'),
	(3, '1984', 'George Orwell', 2, 2, '2025-12-19 13:36:42'),
	(4, 'L\'Étranger', 'Albert Camus', 4, 4, '2025-12-19 13:36:42'),
	(5, 'Le Seigneur des Anneaux', 'J.R.R. Tolkien', 3, 3, '2025-12-19 13:36:42'),
	(6, 'Harry Potter à l\'école des sorciers', 'J.K. Rowling', 6, 6, '2025-12-19 13:36:42'),
	(8, 'Alice in wonderland', 'Harry', 4, 3, '2025-12-20 06:18:10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
