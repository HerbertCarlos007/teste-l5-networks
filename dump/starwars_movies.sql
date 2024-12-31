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
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `opening_crawl` text DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `director` varchar(255) DEFAULT NULL,
  `producer` varchar(255) DEFAULT NULL,
  `characters` text DEFAULT NULL,
  `is_favorite` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movies`
--

LOCK TABLES `movies` WRITE;
/*!40000 ALTER TABLE `movies` DISABLE KEYS */;
INSERT INTO `movies` VALUES (1,'A New Hope',4,'It is a period of civil war.\r\nRebel spaceships, striking\r\nfrom a hidden base, have won\r\ntheir first victory against\r\nthe evil Galactic Empire.\r\n\r\nDuring the battle, Rebel\r\nspies managed to steal secret\r\nplans to the Empire\'s\r\nultimate weapon, the DEATH\r\nSTAR, an armored space\r\nstation with enough power\r\nto destroy an entire planet.\r\n\r\nPursued by the Empire\'s\r\nsinister agents, Princess\r\nLeia races home aboard her\r\nstarship, custodian of the\r\nstolen plans that can save her\r\npeople and restore\r\nfreedom to the galaxy....','1977-05-25','George Lucas','Gary Kurtz, Rick McCallum','Luke Skywalker, C-3PO, R2-D2, Darth Vader, Leia Organa, Owen Lars, Beru Whitesun lars, R5-D4, Biggs Darklighter, Obi-Wan Kenobi, Wilhuff Tarkin, Chewbacca, Han Solo, Greedo, Jabba Desilijic Tiure, Wedge Antilles, Jek Tono Porkins, Raymus Antilles',0),(2,'The Empire Strikes Back',5,'It is a dark time for the\r\nRebellion. Although the Death\r\nStar has been destroyed,\r\nImperial troops have driven the\r\nRebel forces from their hidden\r\nbase and pursued them across\r\nthe galaxy.\r\n\r\nEvading the dreaded Imperial\r\nStarfleet, a group of freedom\r\nfighters led by Luke Skywalker\r\nhas established a new secret\r\nbase on the remote ice world\r\nof Hoth.\r\n\r\nThe evil lord Darth Vader,\r\nobsessed with finding young\r\nSkywalker, has dispatched\r\nthousands of remote probes into\r\nthe far reaches of space....','1980-05-17','Irvin Kershner','Gary Kurtz, Rick McCallum','Luke Skywalker, C-3PO, R2-D2, Darth Vader, Leia Organa, Obi-Wan Kenobi, Chewbacca, Han Solo, Wedge Antilles, Yoda, Palpatine, Boba Fett, IG-88, Bossk, Lando Calrissian, Lobot',0),(3,'Return of the Jedi',6,'Luke Skywalker has returned to\r\nhis home planet of Tatooine in\r\nan attempt to rescue his\r\nfriend Han Solo from the\r\nclutches of the vile gangster\r\nJabba the Hutt.\r\n\r\nLittle does Luke know that the\r\nGALACTIC EMPIRE has secretly\r\nbegun construction on a new\r\narmored space station even\r\nmore powerful than the first\r\ndreaded Death Star.\r\n\r\nWhen completed, this ultimate\r\nweapon will spell certain doom\r\nfor the small band of rebels\r\nstruggling to restore freedom\r\nto the galaxy...','1983-05-25','Richard Marquand','Howard G. Kazanjian, George Lucas, Rick McCallum','Luke Skywalker, C-3PO, R2-D2, Darth Vader, Leia Organa, Obi-Wan Kenobi, Chewbacca, Han Solo, Jabba Desilijic Tiure, Wedge Antilles, Yoda, Palpatine, Boba Fett, Lando Calrissian, Ackbar, Mon Mothma, Arvel Crynyd, Wicket Systri Warrick, Nien Nunb, Bib Fortuna',0),(4,'The Phantom Menace',1,'Turmoil has engulfed the\r\nGalactic Republic. The taxation\r\nof trade routes to outlying star\r\nsystems is in dispute.\r\n\r\nHoping to resolve the matter\r\nwith a blockade of deadly\r\nbattleships, the greedy Trade\r\nFederation has stopped all\r\nshipping to the small planet\r\nof Naboo.\r\n\r\nWhile the Congress of the\r\nRepublic endlessly debates\r\nthis alarming chain of events,\r\nthe Supreme Chancellor has\r\nsecretly dispatched two Jedi\r\nKnights, the guardians of\r\npeace and justice in the\r\ngalaxy, to settle the conflict....','1999-05-19','George Lucas','Rick McCallum','C-3PO, R2-D2, Obi-Wan Kenobi, Anakin Skywalker, Jabba Desilijic Tiure, Yoda, Palpatine, Qui-Gon Jinn, Nute Gunray, Finis Valorum, Padmé Amidala, Jar Jar Binks, Roos Tarpals, Rugor Nass, Ric Olié, Watto, Sebulba, Quarsh Panaka, Shmi Skywalker, Darth Maul, Ayla Secura, Ratts Tyerel, Dud Bolt, Gasgano, Ben Quadinaros, Mace Windu, Ki-Adi-Mundi, Kit Fisto, Eeth Koth, Adi Gallia, Saesee Tiin, Yarael Poof, Plo Koon, Mas Amedda',0),(5,'Attack of the Clones',2,'There is unrest in the Galactic\r\nSenate. Several thousand solar\r\nsystems have declared their\r\nintentions to leave the Republic.\r\n\r\nThis separatist movement,\r\nunder the leadership of the\r\nmysterious Count Dooku, has\r\nmade it difficult for the limited\r\nnumber of Jedi Knights to maintain \r\npeace and order in the galaxy.\r\n\r\nSenator Amidala, the former\r\nQueen of Naboo, is returning\r\nto the Galactic Senate to vote\r\non the critical issue of creating\r\nan ARMY OF THE REPUBLIC\r\nto assist the overwhelmed\r\nJedi....','2002-05-16','George Lucas','Rick McCallum','C-3PO, R2-D2, Owen Lars, Beru Whitesun lars, Obi-Wan Kenobi, Anakin Skywalker, Yoda, Palpatine, Boba Fett, Nute Gunray, Padmé Amidala, Jar Jar Binks, Watto, Shmi Skywalker, Ayla Secura, Mace Windu, Ki-Adi-Mundi, Kit Fisto, Plo Koon, Mas Amedda, Gregar Typho, Cordé, Cliegg Lars, Poggle the Lesser, Luminara Unduli, Barriss Offee, Dormé, Dooku, Bail Prestor Organa, Jango Fett, Zam Wesell, Dexter Jettster, Lama Su, Taun We, Jocasta Nu, R4-P17, Wat Tambor, San Hill, Shaak Ti, Sly Moore',0),(6,'Revenge of the Sith',3,'War! The Republic is crumbling\r\nunder attacks by the ruthless\r\nSith Lord, Count Dooku.\r\nThere are heroes on both sides.\r\nEvil is everywhere.\r\n\r\nIn a stunning move, the\r\nfiendish droid leader, General\r\nGrievous, has swept into the\r\nRepublic capital and kidnapped\r\nChancellor Palpatine, leader of\r\nthe Galactic Senate.\r\n\r\nAs the Separatist Droid Army\r\nattempts to flee the besieged\r\ncapital with their valuable\r\nhostage, two Jedi Knights lead a\r\ndesperate mission to rescue the\r\ncaptive Chancellor....','2005-05-19','George Lucas','Rick McCallum','Luke Skywalker, C-3PO, R2-D2, Darth Vader, Leia Organa, Owen Lars, Beru Whitesun lars, Obi-Wan Kenobi, Anakin Skywalker, Wilhuff Tarkin, Chewbacca, Yoda, Palpatine, Nute Gunray, Padmé Amidala, Ayla Secura, Mace Windu, Ki-Adi-Mundi, Kit Fisto, Eeth Koth, Adi Gallia, Saesee Tiin, Plo Koon, Poggle the Lesser, Luminara Unduli, Dooku, Bail Prestor Organa, R4-P17, Shaak Ti, Grievous, Tarfful, Raymus Antilles, Sly Moore, Tion Medon',0),(7,'The Force Awakens',7,'Luke Skywalker has vanished.\r\nIn his absence, the sinister\r\nFIRST ORDER has risen from\r\nthe ashes of the Empire\r\nand will not rest until\r\nSkywalker, the last Jedi,\r\nhas been destroyed.\r\n \r\nWith the support of the\r\nREPUBLIC, General Leia Organa\r\nleads a brave RESISTANCE.\r\nShe is desperate to find her\r\nbrother Luke and gain his\r\nhelp in restoring peace and\r\njustice to the galaxy.\r\n \r\nLeia has sent her most daring\r\npilot on a secret mission\r\nto Jakku, where an old ally\r\nhas discovered a clue to\r\nLuke\'s whereabouts....','2015-12-11','J. J. Abrams','Kathleen Kennedy, J. J. Abrams, Bryan Burk','Luke Skywalker, R2-D2, Leia Organa, Chewbacca, Han Solo, Ackbar, Finn, Rey, Poe Dameron, BB8, Captain Phasma',0);
/*!40000 ALTER TABLE `movies` ENABLE KEYS */;
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
