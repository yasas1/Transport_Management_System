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
  CONSTRAINT `fk_documents_vehical1` FOREIGN KEY (`vehical_id`) REFERENCES `vehical` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (1,'documents\\1b5544438c7534b8f0a5d1560084519e.xlsx',8,'Key Management System Data Format.xlsx'),(2,'documents\\d4aa7e0dddc471aa6da1eb0421e61fa4.png',8,'New Mockup 1.png'),(3,'documents\\93e4fe8a161574242acb729a8c2c4d66.png',8,'sri-lanka-calendar-2018-12.png'),(5,'documents\\8c6f46e3ade3e92d61cbf9e89da96bd4.xlsx',9,'Key Management System Data Format.xlsx'),(6,'documents\\baa090a885644f499ce8c2ba4d8698c7.png',9,'New Mockup 1.png'),(7,'documents\\bff741ac137e8707990f0998d694da6d.png',9,'sri-lanka-calendar-2018-12.png'),(8,'documents\\33845c33d00f66509f703646ebba2b2e.png',9,'vehical ER.png'),(9,'documents\\4ac3f52b3ba4edc0661850cf9774063e.xlsx',10,'Key Management System Data Format.xlsx'),(10,'documents\\0224224110d4f5e4bbe96d6df7b7c08d.png',10,'New Mockup 1.png'),(11,'documents\\ee813a76d3342d60e8789cd954ba938c.png',10,'sri-lanka-calendar-2018-12.png'),(12,'documents\\4fe3e1a02f7d084d339162efde35a6dd.png',10,'vehical ER.png'),(13,'documents\\2941068a68238c1448c5f6435bd6e9db.xlsx',11,'Key Management System Data Format.xlsx'),(14,'documents\\983d0e2b4f1125aee5a1aa0798d2ed77.png',11,'New Mockup 1.png'),(15,'documents\\321f3e792ee67fe6746f1ea0e46c7daa.png',11,'sri-lanka-calendar-2018-12.png'),(16,'documents\\23be65cc0b0d9b14ce230f3b1c3c22ec.png',11,'vehical ER.png');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
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
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivers`
--

LOCK TABLES `drivers` WRITE;
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funds_allocated_from`
--

LOCK TABLES `funds_allocated_from` WRITE;
/*!40000 ALTER TABLE `funds_allocated_from` DISABLE KEYS */;
/*!40000 ALTER TABLE `funds_allocated_from` ENABLE KEYS */;
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
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES (1,'images/van\\3f3dfcad8bca68d54a20f037ffb7cf3a.jpg'),(2,'images/van\\538df07dd81f3c05e45d9094690bf4e1.png'),(3,'images/van\\29faa20dce9d3a40017fd08e361b73cc.jpg'),(4,'images/van\\813e48dbbd9a431b587e6afa1c20aaa6.jpg'),(5,'images/van\\7b0ada25b147a24db6b7bf7b2e083c80.jpg'),(6,'images/van\\2636dcc7a069bb0465fa7ce4506d5463.jpg'),(7,'images/van\\f3c1d91719db6c0585820a7e2ad85769.jpg'),(8,'images/van\\cc2a075c72c7b6ffe6c3039a2597e52a.jpg'),(9,'images/van\\e6f2144ea1ff27cb44f584a5771c4ddb.jpg'),(10,'images/van\\66ddb6a5867b693404730d8b8e35b450.jpg'),(11,'images/van\\267655b5ad428f241e8fa9cb6b1ff4e0.jpg'),(12,'images/van\\d3ba138828ff4d7d9a105d7b27ff2f90.jpg'),(13,'images/van\\887916870aa0eefa5166c7d5cae4bbc3.jpg'),(14,'images/van\\d18f417b98ac058a284d411a57658879.jpg');
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
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
  `drivers_id` int(11) NOT NULL,
  `applicant_email` varchar(45) DEFAULT NULL,
  `reserve_date_time` datetime DEFAULT NULL,
  `expected_time_of_arrival` datetime DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `number_of_persons` int(11) DEFAULT NULL,
  `places_to_be_visited` varchar(200) DEFAULT NULL,
  `funds_allocated_from_id` int(11) NOT NULL,
  `is_long_distance` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_reservation_vehical1_idx` (`vehical_id`),
  KEY `fk_reservation_drivers1_idx` (`drivers_id`),
  KEY `fk_reservation_funds_allocated_from1_idx` (`funds_allocated_from_id`),
  CONSTRAINT `fk_reservation_drivers1` FOREIGN KEY (`drivers_id`) REFERENCES `drivers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
  PRIMARY KEY (`id`),
  KEY `fk_vehical_photo1_idx` (`photo_id`),
  CONSTRAINT `fk_vehical_photo1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehical`
--

LOCK TABLES `vehical` WRITE;
/*!40000 ALTER TABLE `vehical` DISABLE KEYS */;
INSERT INTO `vehical` VALUES (2,NULL,4,'2343',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-27 02:47:12','2018-03-27 02:47:12',NULL,NULL,NULL,NULL),(3,NULL,5,'2343','234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-27 03:44:41','2018-03-27 03:44:41',NULL,NULL,NULL,NULL),(4,NULL,6,'2343','234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-27 03:50:33','2018-03-27 03:50:33',NULL,NULL,NULL,NULL),(5,NULL,7,'2343','234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-27 03:51:10','2018-03-27 03:51:10',NULL,NULL,NULL,NULL),(6,NULL,8,'2343','234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-27 03:52:06','2018-03-27 03:52:06',NULL,NULL,NULL,NULL),(7,NULL,9,'2343','234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-27 03:54:10','2018-03-27 03:54:10',NULL,NULL,NULL,NULL),(8,NULL,10,'2343','234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-27 03:55:07','2018-03-27 03:55:07',NULL,NULL,NULL,NULL),(9,NULL,11,'2343','234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-27 03:57:18','2018-03-27 03:57:18',NULL,NULL,NULL,NULL),(10,NULL,12,'2343','234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-27 04:00:04','2018-03-27 04:00:04',NULL,NULL,NULL,NULL),(11,NULL,14,'2343','234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2018-03-27 04:04:18','2018-03-27 04:04:18',NULL,NULL,NULL,NULL);
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

-- Dump completed on 2018-03-27 15:47:38
