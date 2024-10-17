-- MySQL dump 10.19  Distrib 10.3.39-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: gsbextranet
-- ------------------------------------------------------
-- Server version	10.3.39-MariaDB-0+deb10u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `historiqueconnexion`
--

LOCK TABLES `historiqueconnexion` WRITE;
/*!40000 ALTER TABLE `historiqueconnexion` DISABLE KEYS */;
INSERT INTO `historiqueconnexion` VALUES (1,'2023-09-01 08:00:00','2023-09-01 12:00:00'),(1,'2023-09-02 09:30:00','2023-09-02 11:00:00'),(2,'2023-09-01 08:15:00','2023-09-01 13:00:00'),(5,'2024-09-06 14:53:12','2024-09-06 14:53:12');
/*!40000 ALTER TABLE `historiqueconnexion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `medecin`
--

LOCK TABLES `medecin` WRITE;
/*!40000 ALTER TABLE `medecin` DISABLE KEYS */;
INSERT INTO `medecin` VALUES (1,'Dupont','Jean','0601020304','jean.dupont@example.com','1980-05-14','password123','2023-01-10 14:22:35','1234567890','token123','2005-06-15',1,'2023-01-11'),(2,'Martin','Claire','0611121314','claire.martin@example.com','1975-08-24','securepass456','2023-01-12 09:18:12','0987654321','token456','2000-09-12',0,'2023-01-13'),(3,'Dupont','Jean','0601020304','jean.dupont@example.com','1980-05-14','password123','2023-01-10 14:22:35','1234567890','token123','2005-06-15',1,'2023-01-11'),(4,'Martin','Claire','0611121314','claire.martin@example.com','1975-08-24','securepass456','2023-01-12 09:18:12','0987654321','token456','2000-09-12',0,'2023-01-13'),(5,NULL,NULL,NULL,'thomas.dupont@gmail.com',NULL,'P@$$w0rd4&','2024-09-06 14:53:12',NULL,NULL,NULL,NULL,'2024-09-06');
/*!40000 ALTER TABLE `medecin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `medecinproduit`
--

LOCK TABLES `medecinproduit` WRITE;
/*!40000 ALTER TABLE `medecinproduit` DISABLE KEYS */;
/*!40000 ALTER TABLE `medecinproduit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `medecinvisio`
--

LOCK TABLES `medecinvisio` WRITE;
/*!40000 ALTER TABLE `medecinvisio` DISABLE KEYS */;
/*!40000 ALTER TABLE `medecinvisio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `produit`
--

LOCK TABLES `produit` WRITE;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `visioconference`
--

LOCK TABLES `visioconference` WRITE;
/*!40000 ALTER TABLE `visioconference` DISABLE KEYS */;
/*!40000 ALTER TABLE `visioconference` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-06 15:08:55
