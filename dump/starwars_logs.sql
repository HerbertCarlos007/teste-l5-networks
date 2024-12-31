-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: starwars
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `request` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,'2024-12-30 21:22:32','GET https://swapi.py4e.com/api/films'),(2,'2024-12-30 21:23:20','GET /backend/index.php/movies/1/favorite'),(3,'2024-12-30 21:23:25','GET /backend/index.php/movies/1/favorite'),(4,'2024-12-30 21:23:30','GET /backend/index.php/movies/1'),(5,'2024-12-30 21:23:38','GET /backend/index.php/movies?=a new hope'),(6,'2024-12-30 21:23:48','GET /backend/index.php/movies/favorites'),(7,'2024-12-30 21:23:52','GET /backend/index.php/movies/1/favorite'),(8,'2024-12-30 21:23:53','GET /backend/index.php/movies/favorites'),(9,'2024-12-31 08:25:52','GET https://swapi.py4e.com/api/films'),(10,'2024-12-31 08:27:22','GET https://swapi.py4e.com/api/films'),(11,'2024-12-31 08:28:25','GET https://swapi.py4e.com/api/films'),(12,'2024-12-31 08:28:40','GET /backend/index.php/movies/1'),(13,'2024-12-31 08:28:42','GET /backend/index.php/movies/4/favorite'),(14,'2024-12-31 08:28:45','GET /backend/index.php/movies/4'),(15,'2024-12-31 08:28:46','GET /backend/index.php/movies/favorites'),(16,'2024-12-31 08:29:20','GET /backend/index.php/movies/favorites'),(17,'2024-12-31 08:29:24','GET /backend/index.php/movies/1'),(18,'2024-12-31 08:29:26','GET /backend/index.php/movies/favorites'),(19,'2024-12-31 08:29:33','GET /backend/index.php/movies/favorites'),(20,'2024-12-31 08:29:34','GET /backend/index.php/movies/favorites'),(21,'2024-12-31 08:29:38','GET /backend/index.php/movies/4/favorite'),(22,'2024-12-31 08:29:44','GET /backend/index.php/movies?=a new hope'),(23,'2024-12-31 08:30:20','GET /backend/index.php/movies/1'),(24,'2024-12-31 08:30:30','GET /backend/index.php/movies/3'),(25,'2024-12-31 08:30:36','GET /backend/index.php/movies/1/favorite'),(26,'2024-12-31 08:30:44','GET /backend/index.php/movies?=a new hope'),(27,'2024-12-31 08:30:57','GET /backend/index.php/movies/favorites'),(28,'2024-12-31 08:31:30','GET https://swapi.py4e.com/api/films');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-31  8:42:36
