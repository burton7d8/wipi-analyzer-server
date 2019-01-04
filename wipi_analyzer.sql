-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: wipi_analyzer
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.16.04.1

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
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `hostname` varchar(20) NOT NULL,
  `total` int(3) NOT NULL,
  `devices` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ssid_scan`
--

DROP TABLE IF EXISTS `ssid_scan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ssid_scan` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `hostname` varchar(20) NOT NULL,
  `ssid_scan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ssid_scan`
--

LOCK TABLES `ssid_scan` WRITE;
/*!40000 ALTER TABLE `ssid_scan` DISABLE KEYS */;
/*!40000 ALTER TABLE `ssid_scan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ssid_scan_all`
--

DROP TABLE IF EXISTS `ssid_scan_all`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ssid_scan_all` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `hostname` varchar(20) NOT NULL,
  `ssid_scan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ssid_scan_all`
--

LOCK TABLES `ssid_scan_all` WRITE;
/*!40000 ALTER TABLE `ssid_scan_all` DISABLE KEYS */;
/*!40000 ALTER TABLE `ssid_scan_all` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wifi_stats`
--

DROP TABLE IF EXISTS `wifi_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wifi_stats` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `hostname` varchar(20) NOT NULL,
  `ssid` varchar(32) NOT NULL,
  `ssid_mac` varchar(17) NOT NULL,
  `freq` int(4) NOT NULL,
  `link_quality` varchar(6) NOT NULL,
  `link_quality_percent` int(3) NOT NULL,
  `sig_level` int(3) NOT NULL,
  `bit_rate` int(3) NOT NULL,
  `txpwr` int(3) NOT NULL,
  `rx_invalid_nwid` int(5) NOT NULL,
  `rx_invalid_crypt` int(5) NOT NULL,
  `rx_invalid_frag` int(5) NOT NULL,
  `tx_excessive_retries` int(6) NOT NULL,
  `invalid_misc` int(5) NOT NULL,
  `missed_beacon` int(5) NOT NULL,
  `center_freq` int(5) NOT NULL,
  `width` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wifi_stats`
--

LOCK TABLES `wifi_stats` WRITE;
/*!40000 ALTER TABLE `wifi_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `wifi_stats` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-04 11:54:45
