-- MariaDB dump 10.19  Distrib 10.4.20-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: mesoutils
-- ------------------------------------------------------
-- Server version	10.4.20-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE = @@TIME_ZONE */;
/*!40103 SET TIME_ZONE = '+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0 */;
/*!40101 SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES = @@SQL_NOTES, SQL_NOTES = 0 */;

--
-- Table structure for table `elements`
--

DROP TABLE IF EXISTS `elements`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `elements`
(
    `IDENTIFIANT`  int(11) NOT NULL AUTO_INCREMENT,
    `LIBELLE`      varchar(300) NOT NULL,
    `DENOMINATION` varchar(50)  NOT NULL,
    `RESERVE_PAR`  int(11) DEFAULT NULL,
    PRIMARY KEY (`IDENTIFIANT`),
    UNIQUE KEY `ELEMENTS_DENOMINATION_uindex` (`DENOMINATION`),
    UNIQUE KEY `ELEMENTS_LIBELLE_uindex` (`LIBELLE`),
    UNIQUE KEY `elements_RESERVE_PAR_uindex` (`RESERVE_PAR`),
    CONSTRAINT `RESERVATION_FK` FOREIGN KEY (`RESERVE_PAR`) REFERENCES `professeurs` (`ID`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 13
  DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elements`
--

LOCK
TABLES `elements` WRITE;
/*!40000 ALTER TABLE `elements`
    DISABLE KEYS */;
INSERT INTO `elements`
VALUES (7, 'salle informatique', 'informatik', NULL),
       (8, 'salle de réunion', 'reunion', 1),
       (9, 'temps de calcul sur un super calculateur', 'calculator', 2),
       (10, 'salle de conférence', 'amphi', NULL),
       (11, 'salle de vidéo projection', 'kino', NULL),
       (12, 'cable hdmi de 3mètres', 'hdmi 3', 3);
/*!40000 ALTER TABLE `elements`
    ENABLE KEYS */;
UNLOCK
TABLES;

--
-- Table structure for table `professeurs`
--

DROP TABLE IF EXISTS `professeurs`;
/*!40101 SET @saved_cs_client = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professeurs`
(
    `ID`        int(11) NOT NULL AUTO_INCREMENT,
    `USERNAME`  varchar(50)  NOT NULL,
    `PASSWORD`  varchar(300) NOT NULL,
    `EST_ADMIN` tinyint(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (`ID`),
    UNIQUE KEY `PROFESSEURS_LOGIN_uindex` (`USERNAME`)
) ENGINE = InnoDB
  AUTO_INCREMENT = 7
  DEFAULT CHARSET = utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professeurs`
--

LOCK
TABLES `professeurs` WRITE;
/*!40000 ALTER TABLE `professeurs`
    DISABLE KEYS */;
INSERT INTO `professeurs`
VALUES (1, 'prof1', '$2y$10$J9BYL3HXoNmBlCwbMec5Se3U4Vv0rN2v6SXvLqqxDoQ84yJNq/VuC', 0),
       (2, 'prof2', '$2y$10$37EVCuVrCoKgyhKNJSLSK.CriQdXFlwW9aZxe6vrvOx3E/5.n8mJe', 0),
       (3, 'prof3', '$2y$10$CnwdvLZ9HqGsYIRkYXPNz.aWK..Oa/uwyv4kIdp2TOngrzbvEpjdi', 0),
       (4, 'prof4', '$2y$10$guvMFWhPvBw9lVs7N9/0/uwuBxiW146CkLgapRyCJzQNMtS284wHC', 0),
       (5, 'prof5', '$2y$10$rrF4tD6yicXEK7Xa4679e.PpniJ8dUYAuSmp6m6HewbJjMurbtYeK', 0),
       (6, 'admin', '$2y$10$erK7eYuN1VgYdilCOn3Uz.uWjp6ql3wvsjjLQoH5luoRqTYypnwHC', 1);
/*!40000 ALTER TABLE `professeurs`
    ENABLE KEYS */;
UNLOCK
TABLES;
/*!40103 SET TIME_ZONE = @OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE = @OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES = @OLD_SQL_NOTES */;

-- Dump completed on 2022-01-27 15:08:12
