-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: atelier_a_deux
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `atelier_ingredient`
--

DROP TABLE IF EXISTS `atelier_ingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `atelier_ingredient` (
  `atelier_id` bigint unsigned NOT NULL,
  `ingredient_id` bigint unsigned NOT NULL,
  `quantite_necessaire` decimal(10,2) NOT NULL,
  PRIMARY KEY (`atelier_id`,`ingredient_id`),
  KEY `atelier_ingredient_ingredient_id_foreign` (`ingredient_id`),
  CONSTRAINT `atelier_ingredient_atelier_id_foreign` FOREIGN KEY (`atelier_id`) REFERENCES `ateliers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `atelier_ingredient_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atelier_ingredient`
--

LOCK TABLES `atelier_ingredient` WRITE;
/*!40000 ALTER TABLE `atelier_ingredient` DISABLE KEYS */;
/*!40000 ALTER TABLE `atelier_ingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ateliers`
--

DROP TABLE IF EXISTS `ateliers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ateliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `plat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `origine_pays` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  `duree_minutes` int NOT NULL,
  `max_participants` int NOT NULL DEFAULT '6',
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` enum('actif','inactif','complet') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'actif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ateliers_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ateliers`
--

LOCK TABLES `ateliers` WRITE;
/*!40000 ALTER TABLE `ateliers` DISABLE KEYS */;
INSERT INTO `ateliers` VALUES (1,'Jollof Rice Sénégalais','jollof-rice-senegalais','Apprenez à préparer le célèbre Jollof Rice, un plat emblématique de l\'Afrique de l\'Ouest. Riz parfumé aux tomates, oignons et épices, accompagné de poulet grillé.','Jollof Rice','Sénégal',15000.00,120,6,'photos/ateliers/pIFElqCkBeMSXuANu1cU9vIOqgygWQtyfmRfl2tl.jpg','actif','2026-03-23 20:59:11','2026-04-02 12:50:08'),(2,'Poulet DG Camerounais','poulet-dg-camerounais','Le Poulet DG (Directeur Général) est un plat festif camerounais à base de poulet frit, plantains mûrs et légumes sautés. Un incontournable des grandes occasions.','Poulet DG','Cameroun',18000.00,150,6,NULL,'actif','2026-03-23 20:59:11','2026-03-23 20:59:11'),(3,'Pâte Noir et Sauce Gboma','pate-noir-et-sauce-gboma','Découvrez la cuisine béninoise authentique avec la pâte rouge accompagnée de la sauce Gboma aux épinards, crabe et crevettes. Un voyage culinaire unique.','Telibô - Pâte noire','Bénin',12000.00,90,6,'photos/ateliers/zkuuDdHf3TK0u8hz1YCrkI24PvoQ5rCNndk7ewSD.webp','actif','2026-03-23 20:59:11','2026-04-03 09:27:17'),(4,'Thieboudienne Royal','thieboudienne-royal','Le plat national du Sénégal : du riz brisé cuit dans une sauce tomate riche avec du poisson frais, des légumes variés et du tamarin. Une explosion de saveurs.','Thieboudienne','Sénégal',16000.00,130,6,'photos/ateliers/MTpXbq03UWeWYS3QZ7P7SEFuqssulolOO2tjtutP.jpg','actif','2026-03-23 20:59:12','2026-04-02 13:05:17'),(5,'Alloco et Poisson Braisé','alloco-poisson-braise','Un classique ivoirien : des bananes plantains frites dorées accompagnées de poisson braisé aux épices et sa sauce pimentée maison. Simple et délicieux.','Alloco & Poisson','Côte d\'Ivoire',13000.00,100,6,'photos/ateliers/6ZJmwFym7BBByCieyxAhigkAc8zKO12MvA97oFVc.jpg','actif','2026-03-23 20:59:12','2026-04-02 13:24:14'),(6,'Fufu et Sauce Arachide','fufu-sauce-arachide','Maîtrisez l\'art du fufu ghanéen accompagné d\'une onctueuse sauce à l\'arachide avec du poulet tendre et des épices traditionnelles.','Fufu & Arachide','Ghana',14000.00,110,6,'photos/ateliers/HAr1tctTsUFQdfvY2f2Gy6vNtQKKY6HNBcU5nURI.jpg','actif','2026-03-23 20:59:13','2026-04-03 09:31:25'),(7,'Ndolé aux Crevettes','ndole-aux-crevettes','Le plat emblématique du Cameroun : des feuilles amères cuites avec des crevettes fumées, de la pâte d\'arachide et des épices. Un goût unique et authentique.','Ndolé','Cameroun',17000.00,120,6,'photos/ateliers/KZDS1XfZWb2KOdE7CRrZVqIhzppX8c9iooeV8DhU.jpg','actif','2026-03-23 20:59:13','2026-04-02 13:20:19'),(8,'Amiwo Béninois au Poulet','amiwo-beninois-au-poulet','La pâte de maïs rouge à la tomate, spécialité béninoise servie avec du poulet frit croustillant et une sauce tomate épicée. Un plat de fête.','Amiwo','Bénin',11000.00,90,6,'photos/ateliers/xbyeg8tSZ6ufwwOWu45NdpQ3N67ru7Wnit73B0J8.jpg','actif','2026-03-23 20:59:14','2026-04-03 09:12:24'),(9,'Yassa Poulet','yassa-poulet','Le Yassa est un plat sénégalais de poulet mariné au citron et aux oignons caramélisés, servi avec du riz blanc. Frais, acidulé et parfumé.','Yassa','Sénégal',14500.00,110,6,'photos/ateliers/KljTXOG89R8GjgueDENy3gVDjbZ0yBmRdWf8WjS0.jpg','actif','2026-03-23 20:59:14','2026-04-02 13:13:05'),(10,'Dèkounkoun Togolais','dekounkoun-togolais','Un gâteau de haricots cuit à la vapeur dans des feuilles de bananier, spécialité togolaise riche en protéines et en saveurs traditionnelles.','Dèkounkoun','Togo',10000.00,90,6,'photos/ateliers/iyY5iIUkQ4xHEkqHPUfAZIDXtzRD94NsZ2QUe53z.jpg','actif','2026-03-23 20:59:15','2026-04-03 09:05:04'),(11,'Suya Nigérian','suya-nigerian','Les brochettes Suya sont un street food nigérian légendaire : viande de bœuf épicée au Yaji, grillée au charbon et servie avec des oignons et tomates fraîches.','Suya','Nigeria',13500.00,100,6,'photos/ateliers/sZb3F9hQzSsiWSGikRDxo82DOfmpQzR99jxZJqO7.jpg','actif','2026-03-23 20:59:15','2026-04-02 13:02:35'),(12,'Kedjenou de Pintade','kedjenou-de-pintade','Un ragoût ivoirien mijoté lentement dans un canari en terre cuite avec de la pintade, des légumes et des épices. La cuisson douce révèle des saveurs profondes.','Kedjenou','Côte d\'Ivoire',19000.00,140,6,NULL,'actif','2026-03-23 20:59:16','2026-03-23 20:59:16');
/*!40000 ALTER TABLE `ateliers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avis`
--

DROP TABLE IF EXISTS `avis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `atelier_id` bigint unsigned NOT NULL,
  `note` int NOT NULL,
  `commentaire` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `est_visible` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `avis_user_id_foreign` (`user_id`),
  KEY `avis_atelier_id_foreign` (`atelier_id`),
  CONSTRAINT `avis_atelier_id_foreign` FOREIGN KEY (`atelier_id`) REFERENCES `ateliers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avis`
--

LOCK TABLES `avis` WRITE;
/*!40000 ALTER TABLE `avis` DISABLE KEYS */;
INSERT INTO `avis` VALUES (1,4,8,4,'C\'etait un bon atelier et un bon moment de partage',1,'2026-03-24 10:38:01','2026-03-24 11:05:09');
/*!40000 ALTER TABLE `avis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `code_promos`
--

DROP TABLE IF EXISTS `code_promos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `code_promos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_reduction` enum('pourcentage','montant_fixe') COLLATE utf8mb4_unicode_ci NOT NULL,
  `valeur` decimal(10,2) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `usage_max` int NOT NULL DEFAULT '100',
  `usage_actuel` int NOT NULL DEFAULT '0',
  `statut` enum('actif','inactif','expire') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'actif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code_promos_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `code_promos`
--

LOCK TABLES `code_promos` WRITE;
/*!40000 ALTER TABLE `code_promos` DISABLE KEYS */;
/*!40000 ALTER TABLE `code_promos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creneaux`
--

DROP TABLE IF EXISTS `creneaux`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `creneaux` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `atelier_id` bigint unsigned NOT NULL,
  `chef_id` bigint unsigned DEFAULT NULL,
  `date` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `places_restantes` int NOT NULL,
  `statut` enum('disponible','complet','annule') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disponible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `creneaux_uuid_unique` (`uuid`),
  KEY `creneaux_atelier_id_foreign` (`atelier_id`),
  KEY `creneaux_chef_id_foreign` (`chef_id`),
  CONSTRAINT `creneaux_atelier_id_foreign` FOREIGN KEY (`atelier_id`) REFERENCES `ateliers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `creneaux_chef_id_foreign` FOREIGN KEY (`chef_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creneaux`
--

LOCK TABLES `creneaux` WRITE;
/*!40000 ALTER TABLE `creneaux` DISABLE KEYS */;
INSERT INTO `creneaux` VALUES (1,'aca255e5-c40f-4479-9151-bebc62eff1b0',1,2,'2026-03-26','10:00:00','12:00:00',3,'disponible','2026-03-23 20:59:11','2026-03-23 20:59:11'),(4,'a633bbb5-f39d-45aa-81f3-bc1240ca6768',2,2,'2026-04-16','10:00:00','12:00:00',5,'disponible','2026-03-23 20:59:11','2026-04-03 15:48:08'),(5,'788eabfa-83a7-41b5-9c75-cd39a7910f43',2,2,'2026-04-03','15:00:00','17:00:00',2,'disponible','2026-03-23 20:59:11','2026-04-01 11:32:10'),(6,'42b2707d-c6c9-4289-9603-29d8a2d0488e',2,2,'2026-04-29','14:00:00','16:00:00',0,'complet','2026-03-23 20:59:11','2026-04-05 18:18:22'),(7,'0a0c767b-a257-4b13-b862-7049a942e213',3,2,'2026-03-28','10:00:00','12:00:00',0,'complet','2026-03-23 20:59:12','2026-03-25 07:46:10'),(9,'21c29497-57a8-4ac2-b25d-0377641ffbb2',3,2,'2026-04-11','14:00:00','16:00:00',2,'disponible','2026-03-23 20:59:12','2026-03-29 08:15:54'),(10,'6b715d43-ff11-451c-a40e-d784bd0f9d33',4,2,'2026-03-29','10:00:00','12:00:00',0,'complet','2026-03-23 20:59:12','2026-03-29 10:17:34'),(11,'9eb02b7c-ae1e-4539-805e-ea715631f59e',4,2,'2026-04-05','15:00:00','17:00:00',4,'disponible','2026-03-23 20:59:12','2026-04-01 06:22:09'),(12,'840ad98f-f2a6-4b4f-b62c-6557da6f7c60',4,2,'2026-04-12','14:00:00','16:00:00',6,'disponible','2026-03-23 20:59:12','2026-03-23 20:59:12'),(13,'9a61055a-96ae-45d8-bb16-349bdd5d3662',5,2,'2026-03-30','10:00:00','12:00:00',2,'disponible','2026-03-23 20:59:13','2026-03-23 20:59:13'),(14,'a6325f90-7ac0-4a39-9fa3-4009c4e9f9f8',5,2,'2026-04-06','15:00:00','17:00:00',0,'complet','2026-03-23 20:59:13','2026-04-02 09:01:58'),(15,'9e787176-9dee-4679-a155-1c90e1560311',5,2,'2026-04-13','14:00:00','16:00:00',0,'complet','2026-03-23 20:59:13','2026-03-29 13:28:44'),(16,'1cc32721-6560-4132-bd69-f571490d7468',6,2,'2026-03-31','10:00:00','12:00:00',2,'disponible','2026-03-23 20:59:13','2026-03-23 20:59:13'),(17,'bf9c6b47-d88f-4d00-99b3-94db10d7b889',6,2,'2026-04-07','15:00:00','17:00:00',0,'complet','2026-03-23 20:59:13','2026-04-01 12:44:36'),(18,'43ea9db9-08a6-46ed-978d-a9a66d2ce809',6,2,'2026-04-14','14:00:00','16:00:00',2,'disponible','2026-03-23 20:59:13','2026-04-05 18:15:05'),(19,'e6334361-dd4e-4592-8a50-edf4c1cb2596',7,2,'2026-04-01','10:00:00','12:00:00',3,'disponible','2026-03-23 20:59:13','2026-03-23 20:59:13'),(21,'4cf84185-8e36-4147-bd05-aa4099cfb2c3',7,2,'2026-04-15','14:00:00','16:00:00',6,'disponible','2026-03-23 20:59:14','2026-03-23 20:59:14'),(22,'4e363c86-60f8-403c-ad80-1c97a9cefee4',8,2,'2026-04-02','10:00:00','12:00:00',5,'disponible','2026-03-23 20:59:14','2026-04-03 08:16:33'),(24,'800897f6-165e-4137-9217-8491ff6154e2',8,2,'2026-04-22','14:00:00','16:00:00',6,'disponible','2026-03-23 20:59:14','2026-04-03 08:16:44'),(25,'e06a91a8-b1cb-4144-85f1-56410736d22f',9,2,'2026-04-03','10:00:00','12:00:00',3,'disponible','2026-03-23 20:59:14','2026-04-03 10:04:01'),(26,'ec0c4797-aa9e-4b7a-a386-02df53678f55',9,2,'2026-04-10','15:00:00','17:00:00',0,'complet','2026-03-23 20:59:15','2026-04-03 08:20:20'),(27,'7f541e5f-94bd-462b-9c25-2c7deb20c201',9,2,'2026-04-17','14:00:00','16:00:00',4,'disponible','2026-03-23 20:59:15','2026-04-02 13:40:10'),(28,'628c6c8e-80d5-411d-bb2f-57ff3a73a1d7',10,2,'2026-04-04','10:00:00','12:00:00',0,'disponible','2026-03-23 20:59:15','2026-04-03 08:37:27'),(30,'6734f9e1-f794-42f3-90ae-578ff53c8166',10,2,'2026-04-18','14:00:00','16:00:00',6,'disponible','2026-03-23 20:59:15','2026-04-03 08:33:10'),(31,'645f153a-9e5d-48a5-8ebe-7d4deb1a7beb',11,2,'2026-04-05','10:00:00','12:00:00',0,'complet','2026-03-23 20:59:15','2026-03-29 13:16:29'),(32,'44760abb-7aa6-458a-b66c-6061bb4a6bff',11,2,'2026-04-12','15:00:00','17:00:00',1,'disponible','2026-03-23 20:59:15','2026-03-29 11:07:00'),(33,'ae4bfd84-cf6f-443e-9602-1b65a2ab7cbf',11,2,'2026-04-19','14:00:00','16:00:00',2,'disponible','2026-03-23 20:59:15','2026-04-07 12:45:07'),(34,'1a1abac8-a137-4af1-94f9-a6edbd54045f',12,2,'2026-04-06','10:00:00','12:00:00',6,'disponible','2026-03-23 20:59:16','2026-04-03 09:43:42'),(35,'7f7ad79d-84e9-4255-bb6b-375f0e78671c',12,2,'2026-04-13','15:00:00','17:00:00',2,'disponible','2026-03-23 20:59:16','2026-03-23 20:59:16'),(36,'a90045cc-d4a1-46b9-b3ee-53bd9c7047ac',12,2,'2026-04-20','14:00:00','16:00:00',4,'disponible','2026-03-23 20:59:16','2026-04-02 13:47:23'),(37,'71554b7e-d939-4f1c-bc6c-7c9d487b7eed',10,2,'2026-04-10','15:00:00','20:00:00',0,'complet','2026-04-03 09:00:10','2026-04-05 17:39:02'),(38,'932dc1a1-085d-4362-996a-0fab416ce139',1,2,'2026-04-29','16:00:00','19:00:00',6,'disponible','2026-04-03 09:46:42','2026-04-03 09:46:42'),(39,'8227d57b-cb75-4dcf-962b-fa98df0f543d',1,NULL,'2026-04-23','11:00:00','15:00:00',6,'disponible','2026-04-03 09:47:55','2026-04-03 09:47:55'),(40,'d818b815-bb1d-4e12-b670-946d6386a806',10,2,'2026-04-29','12:00:00','16:00:00',2,'complet','2026-04-03 09:49:04','2026-04-05 18:19:52'),(41,'c0443fe8-a4d8-4cb6-b956-3b80b1b84e1f',3,NULL,'2026-04-20','20:00:00','23:00:00',6,'disponible','2026-04-03 09:59:16','2026-04-03 09:59:16'),(42,'371bea56-6a4e-4bd9-8dc2-ea8c80b2a837',11,2,'2026-04-23','09:00:00','12:00:00',6,'disponible','2026-04-03 10:01:09','2026-04-03 10:01:09'),(43,'3db16f45-e147-40ba-8015-5428bdc933c4',8,2,'2026-04-09','17:00:00','20:00:00',4,'disponible','2026-04-03 10:02:47','2026-04-05 21:33:11');
/*!40000 ALTER TABLE `creneaux` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factures`
--

DROP TABLE IF EXISTS `factures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `factures` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reservation_id` bigint unsigned NOT NULL,
  `numero_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant_ht` decimal(10,2) NOT NULL,
  `montant_ttc` decimal(10,2) NOT NULL,
  `fichier_pdf` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `factures_numero_facture_unique` (`numero_facture`),
  UNIQUE KEY `factures_uuid_unique` (`uuid`),
  KEY `factures_reservation_id_foreign` (`reservation_id`),
  CONSTRAINT `factures_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factures`
--

LOCK TABLES `factures` WRITE;
/*!40000 ALTER TABLE `factures` DISABLE KEYS */;
INSERT INTO `factures` VALUES (1,'f691b10b-bcb0-480a-8523-250bab967443',14,'FAC-2026-00001',40677.97,48000.00,NULL,'2026-03-29 08:41:25','2026-03-29 08:41:25'),(2,'e162b7ba-372f-43e0-8eeb-b545f02fbe60',13,'FAC-2026-00002',61016.95,72000.00,NULL,'2026-03-29 08:45:58','2026-03-29 08:45:58'),(4,'8da823ab-11e0-4e4a-8e75-2e40e632505c',15,'FAC-2026-00004',54237.29,64000.00,NULL,'2026-03-29 10:26:05','2026-03-29 10:26:05'),(5,'a109001f-ba12-4b76-9661-2356331637ef',16,'FAC-2026-00005',22881.36,27000.00,NULL,'2026-03-29 11:07:37','2026-03-29 11:07:37'),(8,'920e0e25-d8a3-45fc-92d1-9aebdfa71dcd',23,'FAC-2026-00008',22033.90,26000.00,NULL,'2026-03-29 13:29:36','2026-03-29 13:29:36'),(9,'6ee4eecd-38b1-4952-b0aa-f326e78ecc98',26,'FAC-2026-00009',36864.41,43500.00,NULL,'2026-04-01 06:12:58','2026-04-01 06:12:58'),(10,'9188c3e6-4cf7-434a-a390-7f057ca61877',28,'FAC-2026-00010',22881.36,27000.00,NULL,'2026-04-01 11:40:21','2026-04-01 11:40:21');
/*!40000 ALTER TABLE `factures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unite` enum('kg','g','litre','piece') COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite_stock` decimal(10,2) NOT NULL DEFAULT '0.00',
  `seuil_alerte` decimal(10,2) NOT NULL DEFAULT '5.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'Tomates en Boites','piece',4.00,6.00,'2026-03-25 08:03:03','2026-03-25 08:03:03'),(2,'Cubes Magie','piece',25.00,15.00,'2026-03-25 08:03:29','2026-03-25 08:06:12'),(3,'Farines de mais','kg',28.00,40.00,'2026-03-25 08:04:08','2026-03-25 08:04:08'),(4,'Pomme de terre','kg',63.00,60.00,'2026-03-25 08:04:48','2026-03-25 08:04:48');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages_contact`
--

DROP TABLE IF EXISTS `messages_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages_contact` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages_contact`
--

LOCK TABLES `messages_contact` WRITE;
/*!40000 ALTER TABLE `messages_contact` DISABLE KEYS */;
INSERT INTO `messages_contact` VALUES (1,'Winner ton','tonwinner@gmail.com','J\'ai fais une reservation et je n\'ai pas encore recu la facture',1,'2026-03-26 08:13:03','2026-03-26 08:27:42'),(2,'JIFI','tontoy@gmail.com','Je vous remercie enormement pour vos services j\'ai beaucoup apprecier et je souhaite faire une reservation pour notre entreprise pour 4 semaine complet si possible',0,'2026-03-26 08:26:19','2026-03-26 08:27:25');
/*!40000 ALTER TABLE `messages_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_03_03_165544_add_fields_to_users_table',1),(5,'2026_03_03_170406_create_ateliers_table',1),(6,'2026_03_03_170652_create_creneaux_table',1),(7,'2026_03_03_170913_create_code_promos_table',1),(8,'2026_03_03_171020_create_reservations_table',1),(9,'2026_03_03_171152_create_paiements_table',1),(10,'2026_03_03_171442_create_factures_table',1),(11,'2026_03_03_171914_create_avis_table',1),(12,'2026_03_03_172037_create_ingredients_table',1),(13,'2026_03_03_172328_create_atelier_ingredient_table',1),(14,'2026_03_03_172435_create_newsletters_table',1),(15,'2026_03_25_150109_create_messages_contact_table',2),(16,'2026_03_29_093722_add_kkiapay_to_paiements_methode',3),(17,'2026_03_29_110457_rename_fedapay_column_in_paiements',4),(18,'2026_03_29_113852_add_uuid_to_tables',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `newsletters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `est_actif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `newsletters_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters`
--

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paiements`
--

DROP TABLE IF EXISTS `paiements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paiements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reservation_id` bigint unsigned NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `methode` enum('fedapay','kkiapay','carte','mobile_money') COLLATE utf8mb4_unicode_ci DEFAULT 'kkiapay',
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statut` enum('en_attente','reussi','echoue','rembourse') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `date_paiement` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `paiements_reservation_id_foreign` (`reservation_id`),
  CONSTRAINT `paiements_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paiements`
--

LOCK TABLES `paiements` WRITE;
/*!40000 ALTER TABLE `paiements` DISABLE KEYS */;
INSERT INTO `paiements` VALUES (1,14,48000.00,'kkiapay','_HVnWhGwr','reussi','2026-03-29 08:41:25','2026-03-29 08:41:25','2026-03-29 08:41:25'),(2,13,72000.00,'kkiapay','0N28jQfw1','reussi','2026-03-29 08:45:57','2026-03-29 08:45:57','2026-03-29 08:45:57'),(4,15,64000.00,'kkiapay','dQ0WMEM9S','reussi','2026-03-29 10:26:04','2026-03-29 10:26:04','2026-03-29 10:26:04'),(5,16,27000.00,'kkiapay','oC9q_gAVf','reussi','2026-03-29 11:07:37','2026-03-29 11:07:37','2026-03-29 11:07:37'),(8,23,26000.00,'kkiapay','3b7U76C87','reussi','2026-03-29 13:29:36','2026-03-29 13:29:36','2026-03-29 13:29:36'),(9,26,43500.00,'kkiapay','FE8wA6aNp','reussi','2026-04-01 06:12:57','2026-04-01 06:12:57','2026-04-01 06:12:57'),(10,28,27000.00,'kkiapay','bpidzDbge','reussi','2026-04-01 11:40:21','2026-04-01 11:40:21','2026-04-01 11:40:21');
/*!40000 ALTER TABLE `paiements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('chef@atelieradeux.com','$2y$12$rO2fCUyv3R1Hr8vuXVbpn.Je/OXjmrj/apwOplOu57szHfRKwOhza','2026-04-02 15:53:38');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `creneau_id` bigint unsigned NOT NULL,
  `code_promo_id` bigint unsigned DEFAULT NULL,
  `nombre_personnes` int NOT NULL DEFAULT '2',
  `montant_total` decimal(10,2) NOT NULL,
  `statut` enum('en_attente','confirmee','annulee','terminee') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reservations_uuid_unique` (`uuid`),
  KEY `reservations_user_id_foreign` (`user_id`),
  KEY `reservations_creneau_id_foreign` (`creneau_id`),
  KEY `reservations_code_promo_id_foreign` (`code_promo_id`),
  CONSTRAINT `reservations_code_promo_id_foreign` FOREIGN KEY (`code_promo_id`) REFERENCES `code_promos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `reservations_creneau_id_foreign` FOREIGN KEY (`creneau_id`) REFERENCES `creneaux` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (3,'4b2d2bbb-7728-4c9c-b270-2a2e75ce5855',4,22,NULL,4,44000.00,'annulee',NULL,'2026-03-24 10:25:27','2026-04-03 08:16:33'),(13,'36725dc4-8c0e-42eb-9900-dcee28cda3b7',4,6,NULL,4,72000.00,'confirmee','Cacahouette et haricot','2026-03-28 19:07:58','2026-03-29 08:45:58'),(14,'35568a16-90d3-4642-98e1-aef1ed15d6ba',4,9,NULL,4,48000.00,'confirmee',NULL,'2026-03-29 08:15:54','2026-03-29 08:41:25'),(15,'8736a885-be00-4820-b27d-3c3d2a48079a',4,10,NULL,4,64000.00,'confirmee',NULL,'2026-03-29 10:17:34','2026-03-29 10:26:04'),(16,'4f07f71b-bb02-4176-aa36-7f60f3fcfb56',4,32,NULL,2,27000.00,'terminee',NULL,'2026-03-29 11:07:00','2026-04-01 06:22:18'),(23,'f34a1c9e-076e-45e9-97e2-8e7d3ebf54be',4,15,NULL,2,26000.00,'confirmee',NULL,'2026-03-29 13:28:44','2026-03-29 13:29:36'),(26,'f3cc7d55-48a5-4e89-ab82-12ae1060e26c',4,25,NULL,3,43500.00,'confirmee',NULL,'2026-04-01 06:11:54','2026-04-05 18:11:03'),(28,'61c0874a-253d-4913-bd8a-3614cdcfe60d',4,33,NULL,2,27000.00,'confirmee',NULL,'2026-04-01 11:37:38','2026-04-01 11:40:21'),(44,'0769afae-9df2-4b00-9fcc-3c6c064b18e9',5,18,NULL,2,28000.00,'en_attente',NULL,'2026-04-05 18:15:05','2026-04-05 18:15:05');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('lT0Uz9Y6usZhHWIT629ZEVpjnYyOrmc9mJq8K1gv',4,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoidWMwVGVNdzNKVVZPeUxTNFNPaGREUE9iWEdhRTJVQ1VkR1phc0IxRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tZXMtcmVzZXJ2YXRpb25zIjtzOjU6InJvdXRlIjtzOjE5OiJjb21wdGUucmVzZXJ2YXRpb25zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9',1775570788);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','chef','logistique','client') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `telephone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrateur','admin@atelieradeux.com','admin','+229 97 00 00 00',NULL,NULL,NULL,'$2y$12$lKHD9l3uvC/Lh7zxYyWG.u7MOWZ2gFMFoMVXhkagWZoXL/XXbV4BG',NULL,'2026-03-23 20:59:09','2026-03-23 20:59:09'),(2,'Chef Amina','chef@atelieradeux.com','chef','+229 96 00 00 00',NULL,NULL,NULL,'$2y$12$QQ9SIMN8N2/KByrSid.tKulVH1P.B/zCw./Qfj9ru6PGmOlSsZEAi',NULL,'2026-03-23 20:59:09','2026-03-23 20:59:09'),(3,'Responsable Stock','logistique@atelieradeux.com','logistique','+229 95 00 00 00',NULL,NULL,NULL,'$2y$12$xgsDbJS/wc/OX9rU5fIOS.p09x9FjJkcryWcsRAAPRdlmh.ZO6GX6',NULL,'2026-03-23 20:59:10','2026-03-23 20:59:10'),(4,'Client Test','client@atelieradeux.com','client','+229 94 00 00 00',NULL,'photos/users/rRllV8g7QkTvUrTSCXq2rvwu7Y6sgIPNcPbUlCuZ.png',NULL,'$2y$12$NqjV.E5Kl5u6Qik7hhaveO4kMBmZju5P5yMJM.JB63h.oSYY/AzC2',NULL,'2026-03-23 20:59:10','2026-03-24 10:21:16'),(5,'Anna AGBOZO','annaagbozo@gmail.co','client','+229 67362331',NULL,NULL,NULL,'$2y$12$9LS/3J1xw6J1A.KPOhnOoeMduxXp17o1rw1HqMxJkaxypVDz5IeN2',NULL,'2026-03-25 07:45:09','2026-04-05 17:24:21');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-04-07 18:24:14
