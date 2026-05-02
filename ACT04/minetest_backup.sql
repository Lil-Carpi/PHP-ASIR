/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.2.2-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: minetest
-- ------------------------------------------------------
-- Server version	12.2.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `comentaris`
--

DROP TABLE IF EXISTS `comentaris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `comentaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `gif_url` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comentaris_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentaris`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `comentaris` WRITE;
/*!40000 ALTER TABLE `comentaris` DISABLE KEYS */;
INSERT INTO `comentaris` VALUES
(5,3,'Bombo','2026-04-20 15:02:51',NULL),
(7,3,'me silencian','2026-04-20 15:07:33',NULL),
(8,3,'queremos subir fotos','2026-04-20 17:39:20',NULL),
(9,3,'@admin habilita subir fotos','2026-04-20 17:40:23',NULL),
(10,6,'@alhabula tiene razon','2026-04-20 17:45:13',NULL),
(30,1,'my mom is kinda homeless','2026-04-20 22:31:50','https://media.tenor.com/Dd2dQDlK2cAAAAAj/ishowspeed-speed.gif'),
(32,3,'Finalmente escuchan a la comunidad\r\npd: peak','2026-04-20 23:21:27','https://media1.tenor.com/m/e6gf3Da-UW4AAAAd/ishowspeed-speed.gif'),
(33,1,'Thank you volvo','2026-04-20 23:22:47',NULL),
(34,3,'Grande el admin @carpi','2026-04-20 23:23:11',NULL),
(35,8,'This [Comentario moderado]?','2026-04-20 23:30:44','https://i.pinimg.com/originals/cc/4d/4b/cc4d4b8fea199d6cafe1128cd37669e4.gif'),
(36,1,'Nota del admin:\r\n- Por favor, no poner malas palabras','2026-04-20 23:41:28',NULL),
(37,1,'Hola Mundo!\r\nLilCMS: https://github.com/Lil-Carpi/LilCMS.git','2026-04-20 23:54:43',NULL),
(38,9,'Un diamant és per sempre!','2026-04-21 12:33:27',NULL),
(39,1,'Es un grande @Ramon','2026-04-29 18:43:22',NULL);
/*!40000 ALTER TABLE `comentaris` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `dtItems`
--

DROP TABLE IF EXISTS `dtItems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dtItems` (
  `ItemId` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Descripcio` text DEFAULT NULL,
  `ImageFile` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ItemId`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dtItems`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `dtItems` WRITE;
/*!40000 ALTER TABLE `dtItems` DISABLE KEYS */;
INSERT INTO `dtItems` VALUES
(32,'Palita','Pala de cobre','Bronze_Shovel.png'),
(33,'Pan','Pan de xapata','Bread.png'),
(34,'Libro','Libro muy libroso','Book.png'),
(36,'Diamant','Un diamant és per sempre','Diamond.png');
/*!40000 ALTER TABLE `dtItems` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'carpi','$2y$12$K0Ino3i8NBE5R0inLi5tIup.7HFObSIAHCzH/yJoOnoPedq2Gn4ku','emoji'),
(2,'Jonh Doe','$2y$12$TNKKo5.G4yWLimQGnyGt/e/4Cjz5s11dCOg0powEjByJ/RA5tBP1e','Home2'),
(3,'alhabdula','$2y$12$Llxexdra943cypGy2JiJ9u6uAcmAAiBQhWsr9EUBIuUCho2q3m8tW','Home1'),
(6,'Eusebio','$2y$12$3gTjUjM.dBzAA1Ygc9.0ieWPKCF7HcPLiWBeJw.gDnQ47GEsKUm7W','Ninot'),
(7,'sysadmin','$2y$10$i34EXE2Pw/wraMPqXv3Gbe4H6nzqDFXQCndQqv5f0ibrxSbfkngF2','Home1'),
(8,'NEGRO_123','$2y$10$d5..2OPhJNhqJM2fLMHeKOQAwQ7qavUiQFZDTMq3zrtDT9M60KV6W','Ninot'),
(9,'Ramon','$2y$10$mydD7rAYJS/Gz/sRK6Ije.JwLRXQghggij7PLzmEtwCBwykLxd/RK','Ninot');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-05-02 21:06:25
