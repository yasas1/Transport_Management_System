-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: vms
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.30-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accidents`
--

DROP TABLE IF EXISTS `accidents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accidents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehical_id` int(11) NOT NULL,
  `description_of_damage` varchar(200) DEFAULT NULL,
  `cost_of_repaire` decimal(10,2) DEFAULT NULL,
  `date_of_recovery` date DEFAULT NULL,
  `action_taken_against_driver` varchar(200) DEFAULT NULL,
  `file_no` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_accidents_vehical1_idx` (`vehical_id`),
  CONSTRAINT `fk_accidents_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accidents`
--

LOCK TABLES `accidents` WRITE;
/*!40000 ALTER TABLE `accidents` DISABLE KEYS */;
/*!40000 ALTER TABLE `accidents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `annual_licences`
--

DROP TABLE IF EXISTS `annual_licences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `annual_licences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehical_id` int(11) NOT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `licence_date` date DEFAULT NULL,
  `licence_no` varchar(45) DEFAULT NULL,
  `ammount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_annual_licences_vehical1_idx` (`vehical_id`),
  CONSTRAINT `fk_annual_licences_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `annual_licences`
--

LOCK TABLES `annual_licences` WRITE;
/*!40000 ALTER TABLE `annual_licences` DISABLE KEYS */;
/*!40000 ALTER TABLE `annual_licences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `custody_changes`
--

DROP TABLE IF EXISTS `custody_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custody_changes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehical_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `in_custody` varchar(45) DEFAULT NULL,
  `to_custody` varchar(45) DEFAULT NULL,
  `is_approved` int(11) DEFAULT '0',
  `approved_by` varchar(45) DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `is_accepted` int(11) DEFAULT '0',
  `accepted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_custody_changes_vehical1_idx` (`vehical_id`),
  CONSTRAINT `fk_custody_changes_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custody_changes`
--

LOCK TABLES `custody_changes` WRITE;
/*!40000 ALTER TABLE `custody_changes` DISABLE KEYS */;
/*!40000 ALTER TABLE `custody_changes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deficiencies`
--

DROP TABLE IF EXISTS `deficiencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deficiencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ownership_transfers_id` int(11) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `action_taken` varchar(100) DEFAULT NULL,
  `reference_to_correspondence` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_deficiencies_ownership_transfers1_idx` (`ownership_transfers_id`),
  CONSTRAINT `fk_deficiencies_ownership_transfers1` FOREIGN KEY (`ownership_transfers_id`) REFERENCES `ownership_transfers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deficiencies`
--

LOCK TABLES `deficiencies` WRITE;
/*!40000 ALTER TABLE `deficiencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `deficiencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `vehical_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_documents_vehical1_idx` (`vehical_id`),
  CONSTRAINT `fk_documents_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver`
--

DROP TABLE IF EXISTS `driver`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title_id` int(11) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `initials` varchar(45) DEFAULT NULL,
  `nic` varchar(45) DEFAULT NULL,
  `licence_no` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `licence_expire_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_driver_title1_idx` (`title_id`),
  CONSTRAINT `fk_driver_title1` FOREIGN KEY (`title_id`) REFERENCES `title` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver`
--

LOCK TABLES `driver` WRITE;
/*!40000 ALTER TABLE `driver` DISABLE KEYS */;
INSERT INTO `driver` VALUES (1,1,'Sanjaya','Senadheera','L.S.M.','931984545V','1234567890','0714541245','2021-06-16');
/*!40000 ALTER TABLE `driver` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `driver_changes`
--

DROP TABLE IF EXISTS `driver_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `driver_changes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehical_id` int(11) NOT NULL,
  `name_of_driver` varchar(100) DEFAULT NULL,
  `from` date DEFAULT NULL,
  `to` date DEFAULT NULL,
  `changed_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_driver_changes_vehical1_idx` (`vehical_id`),
  CONSTRAINT `fk_driver_changes_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `driver_changes`
--

LOCK TABLES `driver_changes` WRITE;
/*!40000 ALTER TABLE `driver_changes` DISABLE KEYS */;
/*!40000 ALTER TABLE `driver_changes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_consumption`
--

DROP TABLE IF EXISTS `fuel_consumption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_consumption` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehical_id` int(11) NOT NULL,
  `authorised_mpg_with_load` decimal(10,2) DEFAULT NULL,
  `authorised_mpg_without_load` decimal(10,2) DEFAULT NULL,
  `tested_on` date DEFAULT NULL,
  `mpg_with_load` decimal(10,2) DEFAULT NULL,
  `mpg_without_load` decimal(10,2) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  `tested_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_fuel_consumption_vehical_idx` (`vehical_id`),
  CONSTRAINT `fk_fuel_consumption_vehical` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_consumption`
--

LOCK TABLES `fuel_consumption` WRITE;
/*!40000 ALTER TABLE `fuel_consumption` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_consumption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funds_allocated_from`
--

DROP TABLE IF EXISTS `funds_allocated_from`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funds_allocated_from` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funds_allocated_from`
--

LOCK TABLES `funds_allocated_from` WRITE;
/*!40000 ALTER TABLE `funds_allocated_from` DISABLE KEYS */;
INSERT INTO `funds_allocated_from` VALUES (1,'UCSC'),(2,'EDC'),(3,'ELC'),(4,'MSC'),(5,'CSC'),(6,'PROJECT');
/*!40000 ALTER TABLE `funds_allocated_from` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `id_card`
--

DROP TABLE IF EXISTS `id_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `id_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `id_card`
--

LOCK TABLES `id_card` WRITE;
/*!40000 ALTER TABLE `id_card` DISABLE KEYS */;
INSERT INTO `id_card` VALUES (1,NULL,'documents/idc\\AB123422cf39f94cafc2e27b9e5d35ee7d6919.txt'),(2,NULL,'documents/idc\\ABC123434f54eec8b769671da16c063dcb02cd0.txt');
/*!40000 ALTER TABLE `id_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journey`
--

DROP TABLE IF EXISTS `journey`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `journey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_id` varchar(220) NOT NULL,
  `vehical_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `funds_allocated_from_id` int(11) NOT NULL,
  `expected_start_date_time` datetime DEFAULT NULL,
  `expected_end_date_time` datetime DEFAULT NULL,
  `real_start_date_time` datetime DEFAULT NULL,
  `real_end_date_time` datetime DEFAULT NULL,
  `expected_distance` decimal(10,2) DEFAULT NULL,
  `real_distance` decimal(10,2) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `number_of_persons` int(11) DEFAULT NULL,
  `places_to_be_visited` varchar(200) DEFAULT NULL,
  `is_long_distance` int(11) DEFAULT '0',
  `divisional_head_id` varchar(220) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` varchar(220) DEFAULT NULL,
  `confirmed_by` varchar(220) DEFAULT NULL,
  `confirmed_start_date_time` timestamp NULL DEFAULT NULL,
  `confirmed_end_date_time` timestamp NULL DEFAULT NULL,
  `journey_status_id` int(11) NOT NULL DEFAULT '1',
  `approval_remarks` varchar(200) DEFAULT NULL,
  `confirmation_remarks` varchar(200) DEFAULT NULL,
  `confirmed_at` timestamp NULL DEFAULT NULL,
  `driver_remarks` varchar(200) DEFAULT NULL,
  `driver_completed_at` timestamp NULL DEFAULT NULL,
  `driver_filled_by` varchar(220) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_journey_vehical1_idx` (`vehical_id`),
  KEY `fk_journey_driver1_idx` (`driver_id`),
  KEY `fk_journey_funds_allocated_from1_idx` (`funds_allocated_from_id`),
  KEY `fk_journey_journey_status1_idx` (`journey_status_id`),
  CONSTRAINT `fk_journey_driver1` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_journey_funds_allocated_from1` FOREIGN KEY (`funds_allocated_from_id`) REFERENCES `funds_allocated_from` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_journey_journey_status1` FOREIGN KEY (`journey_status_id`) REFERENCES `journey_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_journey_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journey`
--

LOCK TABLES `journey` WRITE;
/*!40000 ALTER TABLE `journey` DISABLE KEYS */;
INSERT INTO `journey` VALUES (1,'000004',2,1,1,'2018-05-11 13:05:00','2018-05-11 13:05:00',NULL,NULL,100.00,NULL,'asddfd sfsdgdsg sgsdgsdg sdgsdgsd ',2,'ythtyh sdfsdfs sdfsdgsd sdg sd',0,'000538','2018-05-03 04:35:00','2018-05-14 01:33:11','2018-05-07 10:14:32','000046','000004','2018-05-14 06:35:00','2018-05-14 06:35:00',4,'fdsfdsfdsfsdfsdf','rdgdfgf','2018-05-14 01:33:11',NULL,NULL,NULL),(2,'000004',2,1,1,'2018-05-14 06:59:47','2018-05-14 06:59:47',NULL,NULL,150.00,NULL,'Sample Purpose',2,'Sample Place, Sample Place, Sample Place,',0,'000582','2018-05-07 10:49:51','2018-05-14 01:29:47','2018-05-07 10:51:13','000046','000004',NULL,NULL,2,NULL,NULL,'2018-05-14 01:29:47',NULL,NULL,NULL),(3,'000004',2,1,1,'2018-05-11 14:05:00','2018-05-11 08:45:27','2018-05-14 11:05:00','2018-05-14 11:05:00',100.00,250.00,'gergergerger',2,'grregerger',0,'000147','2018-05-07 23:51:44','2018-05-14 00:55:17','2018-05-08 04:02:58','000046','000004','2018-05-11 03:15:27','2018-05-11 03:15:27',6,NULL,'confirmed','2018-05-11 03:20:07','driver remarks','2018-05-14 00:55:17',NULL);
/*!40000 ALTER TABLE `journey` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journey_status`
--

DROP TABLE IF EXISTS `journey_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `journey_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journey_status`
--

LOCK TABLES `journey_status` WRITE;
/*!40000 ALTER TABLE `journey_status` DISABLE KEYS */;
INSERT INTO `journey_status` VALUES (1,'Not Approved'),(2,'Approved'),(3,'Denied'),(4,'Confirmed'),(5,'Not Confirmed'),(6,'Completed'),(7,'Canceled');
/*!40000 ALTER TABLE `journey_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (1,'User'),(2,'Driver'),(3,'Vehicle'),(4,'Journey');
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module_has_permissions`
--

DROP TABLE IF EXISTS `module_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module_has_permissions` (
  `module_id` int(11) NOT NULL,
  `permissions_id` int(11) NOT NULL,
  PRIMARY KEY (`module_id`,`permissions_id`),
  KEY `fk_module_has_permissions_permissions1_idx` (`permissions_id`),
  KEY `fk_module_has_permissions_module1_idx` (`module_id`),
  CONSTRAINT `fk_module_has_permissions_module1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_module_has_permissions_permissions1` FOREIGN KEY (`permissions_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module_has_permissions`
--

LOCK TABLES `module_has_permissions` WRITE;
/*!40000 ALTER TABLE `module_has_permissions` DISABLE KEYS */;
INSERT INTO `module_has_permissions` VALUES (1,1),(1,2),(1,3),(1,4),(2,1),(2,2),(2,3),(2,4),(3,1),(3,2),(3,3),(3,4),(4,5),(4,6),(4,7),(4,8),(4,9),(4,10);
/*!40000 ALTER TABLE `module_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ownership_transfers`
--

DROP TABLE IF EXISTS `ownership_transfers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ownership_transfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehical_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `transferor` varchar(45) DEFAULT NULL,
  `transferee` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transfer_of_ownership_vehical1_idx` (`vehical_id`),
  CONSTRAINT `fk_transfer_of_ownership_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ownership_transfers`
--

LOCK TABLES `ownership_transfers` WRITE;
/*!40000 ALTER TABLE `ownership_transfers` DISABLE KEYS */;
/*!40000 ALTER TABLE `ownership_transfers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parts_replacement_or_repaires`
--

DROP TABLE IF EXISTS `parts_replacement_or_repaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parts_replacement_or_repaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehical_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `makers_no` varchar(45) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `oic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_parts_replacement_or_repaires_vehical1_idx` (`vehical_id`),
  KEY `fk_parts_replacement_or_repaires_item1_idx` (`item_id`),
  CONSTRAINT `fk_parts_replacement_or_repaires_item1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_parts_replacement_or_repaires_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parts_replacement_or_repaires`
--

LOCK TABLES `parts_replacement_or_repaires` WRITE;
/*!40000 ALTER TABLE `parts_replacement_or_repaires` DISABLE KEYS */;
/*!40000 ALTER TABLE `parts_replacement_or_repaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'Create'),(2,'Read'),(3,'Update'),(4,'Delete'),(5,'Request'),(6,'Approve'),(7,'Confirm'),(8,'Complete'),(9,'View Ongoing Journeys'),(10,'View Completed Journeys');
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Create'),(2,'Read'),(3,'Update'),(4,'Delete'),(5,'Request'),(6,'Approve'),(7,'Confirm'),(8,'Complete'),(9,'View Ongoing Journeys'),(10,'View Completed Journeys');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES (1,'images/van\\3f3dfcad8bca68d54a20f037ffb7cf3a.jpg'),(2,'images/van\\538df07dd81f3c05e45d9094690bf4e1.png'),(3,'images/van\\29faa20dce9d3a40017fd08e361b73cc.jpg'),(4,'images/van\\813e48dbbd9a431b587e6afa1c20aaa6.jpg'),(5,'images/van\\7b0ada25b147a24db6b7bf7b2e083c80.jpg'),(6,'images/van\\2636dcc7a069bb0465fa7ce4506d5463.jpg'),(7,'images/van\\f3c1d91719db6c0585820a7e2ad85769.jpg'),(8,'images/van\\cc2a075c72c7b6ffe6c3039a2597e52a.jpg'),(9,'images/van\\e6f2144ea1ff27cb44f584a5771c4ddb.jpg'),(10,'images/van\\66ddb6a5867b693404730d8b8e35b450.jpg'),(11,'images/van\\267655b5ad428f241e8fa9cb6b1ff4e0.jpg'),(12,'images/van\\d3ba138828ff4d7d9a105d7b27ff2f90.jpg'),(13,'images/van\\887916870aa0eefa5166c7d5cae4bbc3.jpg'),(14,'images/van\\d18f417b98ac058a284d411a57658879.jpg'),(15,'images/van\\1660796e2ad9aee6d559878b7ac527de.jpeg'),(16,'images/van\\4f435a4395868ba9ece5b9a231903809.jpg'),(17,'images/van\\d1e03ffe90a31af13549f49e165263a3.png'),(18,'images/van\\b0975e3df858486cb81d04dc18db5dc1.jpeg');
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privileges`
--

DROP TABLE IF EXISTS `privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_privileges_module1_idx` (`module_id`),
  KEY `fk_privileges_role1_idx` (`role_id`),
  CONSTRAINT `fk_privileges_module1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_privileges_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privileges`
--

LOCK TABLES `privileges` WRITE;
/*!40000 ALTER TABLE `privileges` DISABLE KEYS */;
INSERT INTO `privileges` VALUES (2,2,1),(3,2,3),(7,3,1),(8,4,1);
/*!40000 ALTER TABLE `privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privileges_has_permissions`
--

DROP TABLE IF EXISTS `privileges_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privileges_has_permissions` (
  `privileges_id` int(11) NOT NULL,
  `permissions_id` int(11) NOT NULL,
  PRIMARY KEY (`privileges_id`,`permissions_id`),
  KEY `fk_privileges_has_permissions_permissions1_idx` (`permissions_id`),
  KEY `fk_privileges_has_permissions_privileges1_idx` (`privileges_id`),
  CONSTRAINT `fk_privileges_has_permissions_permissions1` FOREIGN KEY (`permissions_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_privileges_has_permissions_privileges1` FOREIGN KEY (`privileges_id`) REFERENCES `privileges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privileges_has_permissions`
--

LOCK TABLES `privileges_has_permissions` WRITE;
/*!40000 ALTER TABLE `privileges_has_permissions` DISABLE KEYS */;
INSERT INTO `privileges_has_permissions` VALUES (2,1),(2,2),(2,3),(2,4),(3,1),(3,2),(3,3),(3,4),(7,1),(7,2),(7,3),(7,4),(8,5),(8,6),(8,9),(8,10);
/*!40000 ALTER TABLE `privileges_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reg_book`
--

DROP TABLE IF EXISTS `reg_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reg_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reg_book`
--

LOCK TABLES `reg_book` WRITE;
/*!40000 ALTER TABLE `reg_book` DISABLE KEYS */;
INSERT INTO `reg_book` VALUES (1,NULL,'documents/regbook\\ABC123434f54eec8b769671da16c063dcb02cd0.txt');
/*!40000 ALTER TABLE `reg_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repaires`
--

DROP TABLE IF EXISTS `repaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehical_id` int(11) NOT NULL,
  `job_no` varchar(45) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `authorized_by` varchar(45) DEFAULT NULL,
  `executed_at` varchar(45) DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_repaires_vehical1_idx` (`vehical_id`),
  CONSTRAINT `fk_repaires_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repaires`
--

LOCK TABLES `repaires` WRITE;
/*!40000 ALTER TABLE `repaires` DISABLE KEYS */;
/*!40000 ALTER TABLE `repaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehical_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `applicant_email` varchar(45) DEFAULT NULL,
  `reserve_date_time` datetime DEFAULT NULL,
  `expected_time_of_arrival` datetime DEFAULT NULL,
  `expected_distance` decimal(10,2) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `number_of_persons` int(11) DEFAULT NULL,
  `places_to_be_visited` varchar(200) DEFAULT NULL,
  `funds_allocated_from_id` int(11) NOT NULL,
  `is_long_distance` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_reservation_vehical1_idx` (`vehical_id`),
  KEY `fk_reservation_funds_allocated_from1_idx` (`funds_allocated_from_id`),
  KEY `fk_reservation_driver1_idx` (`driver_id`),
  CONSTRAINT `fk_reservation_driver1` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservation_funds_allocated_from1` FOREIGN KEY (`funds_allocated_from_id`) REFERENCES `funds_allocated_from` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reservation_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Director'),(2,'Divisional Head'),(3,'Admin'),(4,'Driver'),(5,'User');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_privileges`
--

DROP TABLE IF EXISTS `role_has_privileges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_privileges` (
  `role_id` int(11) NOT NULL,
  `privileges_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`privileges_id`),
  KEY `fk_role_has_privileges_privileges1_idx` (`privileges_id`),
  KEY `fk_role_has_privileges_role1_idx` (`role_id`),
  CONSTRAINT `fk_role_has_privileges_privileges1` FOREIGN KEY (`privileges_id`) REFERENCES `privileges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_has_privileges_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_privileges`
--

LOCK TABLES `role_has_privileges` WRITE;
/*!40000 ALTER TABLE `role_has_privileges` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_privileges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehical_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `meter_reading` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_services_vehical1_idx` (`vehical_id`),
  CONSTRAINT `fk_services_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `title`
--

DROP TABLE IF EXISTS `title`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `title` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `title`
--

LOCK TABLES `title` WRITE;
/*!40000 ALTER TABLE `title` DISABLE KEYS */;
INSERT INTO `title` VALUES (1,'Mr.'),(2,'Mrs.'),(3,'Ms.'),(4,'Miss.');
/*!40000 ALTER TABLE `title` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tyre_position_changes`
--

DROP TABLE IF EXISTS `tyre_position_changes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tyre_position_changes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehical_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `milometer_reading` decimal(10,2) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tyre_position_changes_vehical1_idx` (`vehical_id`),
  CONSTRAINT `fk_tyre_position_changes_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tyre_position_changes`
--

LOCK TABLES `tyre_position_changes` WRITE;
/*!40000 ALTER TABLE `tyre_position_changes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tyre_position_changes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tyre_replaces`
--

DROP TABLE IF EXISTS `tyre_replaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tyre_replaces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehical_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `position` varchar(45) DEFAULT NULL,
  `milometer_reading` decimal(10,2) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tyre_position_changes_vehical1_idx` (`vehical_id`),
  CONSTRAINT `fk_tyre_position_changes_vehical10` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tyre_replaces`
--

LOCK TABLES `tyre_replaces` WRITE;
/*!40000 ALTER TABLE `tyre_replaces` DISABLE KEYS */;
/*!40000 ALTER TABLE `tyre_replaces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) DEFAULT '0',
  `token` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_id` varchar(220) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `fk_users_role1_idx` (`role_id`),
  CONSTRAINT `fk_users_role1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Sanjaya Senadeera','sms','','dHBWGRInavwlMlByEC1AyzdmQdeXubmoAUbnjmZcnnjCyJpQzw12tFgtySAD',NULL,'2018-05-15 00:36:38',1,1,'ya29.Glu8BQkVJyj5VPxCFUqlvd0DKV3yL7YVEmIT34B_hBAqVL1LJsoITONNvOlzbRX-wUm0Uxsk2K0Pa1Suq0mvgPRIVjnLvvBpSGVFJwsfsQYF9meF1iOSPoAovjnK','https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50','000147'),(4,'Director Name','director','','QRZsLpLfsEmJJErKZaZNbPLM2VfF2GyFNnD7MXeudqPGTHU9IrdBrJ4ybzBg',NULL,NULL,1,1,NULL,'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50','000147'),(5,'Divisional Head Name','dhead','','RAddbfbgTyYKR5uB6VqnJXgHEQ14AT9KMX6El7usDwBn2B9HPNdzqjlEQmqC',NULL,NULL,2,1,NULL,'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50','000004'),(6,'Admin Name','admin','','HRcPpObyvbgWgelHCebkZ2NdQp8Kbc9vgcJiIB2t4Hfze6TM5OD3OEnvv5gm',NULL,NULL,3,1,NULL,'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50','000006'),(7,'Driver Name','driver','','hgg1fF2KBHh8NtQh3k1sDl5A0w78hbYoqoU0EAgWoj8Txju70yloMM6Vp85x',NULL,NULL,4,1,NULL,'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50','000042'),(8,'User Name','user','','IN6ei6dHV7hFAjHE2glkVbHNDnKTj8zGNPspkJSf1cN46aooQFxDC9ARVSJH',NULL,NULL,5,1,NULL,'https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg?sz=50','000046'),(9,NULL,'kph','GqAMLytD8v',NULL,'2018-05-20 10:41:02','2018-05-20 10:41:02',1,2,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehical`
--

DROP TABLE IF EXISTS `vehical`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehical` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `registration_no` varchar(45) NOT NULL,
  `dept_no` varchar(45) DEFAULT NULL,
  `date_of_registration` date DEFAULT NULL,
  `make_and_type` varchar(45) DEFAULT NULL,
  `chassis_no` varchar(45) DEFAULT NULL,
  `engine_no` varchar(45) DEFAULT NULL,
  `type_of_body` varchar(45) DEFAULT NULL,
  `no_of_cylinders` int(11) DEFAULT NULL,
  `horse_power` decimal(10,2) DEFAULT NULL,
  `pay_load` decimal(10,2) DEFAULT NULL,
  `bore` varchar(45) DEFAULT NULL,
  `stroke` varchar(45) DEFAULT NULL,
  `carburettor_make_and_type` varchar(45) DEFAULT NULL,
  `sizes_of_jets_main` varchar(45) DEFAULT NULL,
  `sizes_of_jets_compensation` varchar(45) DEFAULT NULL,
  `sizes_of_jets_choke` varchar(45) DEFAULT NULL,
  `fuel_injection_pump_make_and_make` varchar(45) DEFAULT NULL,
  `fuel_injection_pump_makers_no` varchar(45) DEFAULT NULL,
  `atomisers_make` varchar(45) DEFAULT NULL,
  `coil_or_magneto_make` varchar(45) DEFAULT NULL,
  `coil_or_magneto_makers_no` varchar(45) DEFAULT NULL,
  `coil_or_magneto_type` varchar(45) DEFAULT NULL,
  `coil_or_magneto_rotation` varchar(45) DEFAULT NULL,
  `lighting_set_make` varchar(45) DEFAULT NULL,
  `lighting_set_type` varchar(45) DEFAULT NULL,
  `lighting_set_voltage` decimal(10,2) DEFAULT NULL,
  `tyres_size_front` varchar(45) DEFAULT NULL,
  `tyres_size_rear` varchar(45) DEFAULT NULL,
  `tyres_pressure_front` varchar(45) DEFAULT NULL,
  `tyres_pressure_rear` varchar(45) DEFAULT NULL,
  `battery_dimensions` varchar(45) DEFAULT NULL,
  `bettery_voltage` decimal(10,2) DEFAULT NULL,
  `battery_amperage` decimal(10,2) DEFAULT NULL,
  `capacity_of_fuel_tank` decimal(10,2) DEFAULT NULL,
  `capacity_of_reserve_tank` decimal(10,2) DEFAULT NULL,
  `engine_crank_case` varchar(45) DEFAULT NULL,
  `gear_box` varchar(45) DEFAULT NULL,
  `rear_axel` varchar(45) DEFAULT NULL,
  `oil_specifications_engine` varchar(45) DEFAULT NULL,
  `oil_specifications_gear_oil` varchar(45) DEFAULT NULL,
  `oil_specifications_shock_absorber_fluid` varchar(45) DEFAULT NULL,
  `oil_specifications_differential_oil` varchar(45) DEFAULT NULL,
  `perchase_price` decimal(10,2) DEFAULT NULL,
  `date_of_perchase` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `create_approved_by` varchar(45) DEFAULT NULL,
  `update_approved_by` varchar(45) DEFAULT NULL,
  `id_card_id` int(11) DEFAULT NULL,
  `reg_book_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vehical_photo1_idx` (`photo_id`),
  KEY `fk_vehical_id_card1_idx` (`id_card_id`),
  KEY `fk_vehical_reg_book1_idx` (`reg_book_id`),
  KEY `fk_vehical_driver1_idx` (`driver_id`),
  CONSTRAINT `fk_vehical_driver1` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_vehical_id_card1` FOREIGN KEY (`id_card_id`) REFERENCES `id_card` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_vehical_photo1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_vehical_reg_book1` FOREIGN KEY (`reg_book_id`) REFERENCES `reg_book` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehical`
--

LOCK TABLES `vehical` WRITE;
/*!40000 ALTER TABLE `vehical` DISABLE KEYS */;
INSERT INTO `vehical` VALUES (2,'Mazda 3',18,'WP ABC 1234','1234','2008-03-29','Mazda Car','12345678','12345678','Sample Data',10,155.00,1588.00,'83.5 x 91.2','Sample Data','Sample Data','11.02-inch vented disc','11.02-inch vented disc',NULL,NULL,'12345678','Sample Data','Sample Data','12345678','Front-wheel drive (FWD)','Front-wheel drive (FWD)','SKYACTIV','SKYACTIV',12.00,'16 x 6.5 inch','16 x 6.5 inch','25','25','1234',12.00,6.00,50.00,10.00,'2','2','1','Engine Oil','Gear Box Oil','Shock Absorber Fluid','Differential Oil',3500000.00,'2016-03-06','2018-03-27 02:47:12','2018-03-29 00:05:55',NULL,NULL,NULL,NULL,0,0,1);
/*!40000 ALTER TABLE `vehical` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-25  9:31:26
