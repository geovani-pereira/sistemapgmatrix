CREATE DATABASE  IF NOT EXISTS `pgmatrix` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pgmatrix`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pgmatrix
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
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `nascimento` varchar(10) NOT NULL,
  `rg` char(14) NOT NULL,
  `cpfcnpj` varchar(18) NOT NULL,
  `telefone` char(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cep` int(11) NOT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (0,'Outro','20000208','123467891','01234567890','(00)000000000','email@email.com','Teste',1234,'Outro','Outra','PR',0,'2018-03-29 03:16:48'),(1,'Juvenal Alvez','1984-02-14','104488963','009.946.682-23','(44)997105576','juvenal@mai.com','Fernão Dias',5936,'Centro','Umuarama','PR',87502150,'2018-03-22 05:40:14'),(2,'Amanda da Silva Ferreira','1995-04-11','22.222.222-2','073.944.839-08','(44)444444444','amanda@email.com','Av Duque de Caxias',1123,'Zona 3','Umuarama','PR',87502150,'2018-03-22 05:40:14');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conta`
--

DROP TABLE IF EXISTS `conta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `valor` float NOT NULL,
  `data` date NOT NULL,
  `conta` enum('Pago','Pendente') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conta`
--

LOCK TABLES `conta` WRITE;
/*!40000 ALTER TABLE `conta` DISABLE KEYS */;
INSERT INTO `conta` VALUES (1,'fsdafas',2131.33,'2018-05-31',''),(2,'fsdafas',2131.33,'2018-05-31',''),(3,'Compra de Mercadorias',1233.11,'2018-05-30',''),(4,'fsadfdasfsdafas',12.33,'2018-05-31','Pago'),(5,'sdfsdafsad',2.13,'2018-05-30','Pendente'),(6,'fsdfdsafads',12.33,'2018-01-01','Pendente');
/*!40000 ALTER TABLE `conta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `alteracao` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (82,1,'2018-03-24 17:14:49','::1','Status:Em Andamento/Pagamento:Pago/OS:21'),(83,1,'2018-03-26 02:31:16','::1',' Status: Aberto Rebido: Pago OS: '),(84,1,'2018-03-26 02:34:32','::1','Status:Aberto/Pagamento:Receber/OS:17'),(85,1,'2018-03-29 01:30:08','::1','Status:Aberto/Pagamento:Pago/OS:22'),(86,1,'2018-03-29 01:55:07','::1','Status:Cancelado/Pagamento:Receber/OS:19'),(87,1,'2018-03-29 04:27:42','::1',' Status: Aberto Rebido: Receber OS: '),(88,1,'2018-03-30 20:32:26','::1','Status:Aberto/Pagamento:Pago/OS:17'),(89,1,'2018-03-30 20:33:04','::1',' Status: Aberto Rebido: Receber OS: '),(90,1,'2018-03-30 20:38:40','::1','Status:Em Andamento/Pagamento:Pago/OS:24'),(91,1,'2018-04-20 23:51:37','::1',' Status: Aberto Rebido: dinheiro OS: '),(92,1,'2018-04-20 23:53:20','::1',' Status: Aberto Rebido: 2x OS: '),(93,1,'2018-04-20 23:57:42','::1',' Status: Aberto Rebido: dinheiro OS: '),(94,1,'2018-04-21 00:01:21','::1',' Status: Aberto Rebido: dinheiro OS: '),(95,1,'2018-04-21 00:01:28','::1',' Status: Aberto Rebido: 2x OS: '),(96,1,'2018-04-21 00:01:33','::1',' Status: Aberto Rebido: 2x OS: '),(97,1,'2018-04-21 00:01:38','::1',' Status: Aberto Rebido: 4x OS: '),(98,1,'2018-04-21 00:01:41','::1','Status:Aberto/Pagamento:3x/OS:29'),(99,1,'2018-04-21 00:01:46','::1','Status:Aberto/Pagamento:3x/OS:29'),(100,1,'2018-04-21 00:01:49','::1','Status:Aberto/Pagamento:3x/OS:29'),(101,1,'2018-04-21 00:02:25','::1','Status:Aberto/Pagamento:4x/OS:29'),(102,1,'2018-04-21 00:02:32','::1','Status:Aberto/Pagamento:4x/OS:29'),(103,1,'2018-04-21 00:02:38','::1','Status:Aberto/Pagamento:3x/OS:29'),(104,1,'2018-04-21 00:02:42','::1','Status:Aberto/Pagamento:2x/OS:29'),(105,1,'2018-04-21 00:03:31','::1','Status:Aberto/Pagamento:2x/OS:29'),(106,1,'2018-04-21 00:06:35','::1','Status:Aberto/Pagamento:cartao/OS:23'),(107,1,'2018-04-21 00:08:23','::1','Status:Aberto/Pagamento:cartao/OS:23'),(108,1,'2018-04-21 00:21:18','::1','Status:Aberto/Pagamento:cartao/OS:23'),(109,1,'2018-04-21 00:21:34','::1','Status:Aberto/Pagamento:cartao/OS:23'),(110,1,'2018-04-21 00:23:38','::1',' Status: Aberto Rebido: dinheiro OS: '),(111,1,'2018-04-21 00:53:47','::1',' Status: Aberto Rebido: dinheiro OS: '),(112,1,'2018-04-21 00:54:11','::1',' Status: Aberto Rebido: dinheiro OS: '),(113,1,'2018-04-21 00:54:31','::1',' Status: Aberto Rebido: dinheiro OS: '),(114,1,'2018-04-21 00:55:12','::1',' Status: Aberto Rebido: dinheiro OS: '),(115,1,'2018-04-21 00:55:16','::1',' Status: Aberto Rebido: dinheiro OS: '),(116,1,'2018-04-21 00:55:45','::1',' Status: Aberto Rebido: dinheiro OS: '),(117,1,'2018-04-21 00:56:13','::1',' Status: Aberto Rebido: dinheiro OS: '),(118,1,'2018-04-21 00:56:19','::1',' Status: Aberto Rebido: dinheiro OS: '),(119,1,'2018-04-21 00:56:36','::1',' Status: Aberto Rebido: dinheiro OS: '),(120,1,'2018-04-21 00:56:49','::1',' Status: Aberto Rebido: dinheiro OS: '),(121,1,'2018-04-21 00:57:18','::1',' Status: Aberto Rebido: dinheiro OS: '),(122,1,'2018-04-21 00:58:12','::1',' Status: Aberto Rebido: dinheiro OS: '),(123,1,'2018-04-21 00:58:30','::1',' Status: Aberto Rebido: dinheiro OS: '),(124,1,'2018-04-21 01:00:11','::1',' Status: Aberto Rebido: dinheiro OS: '),(125,1,'2018-04-21 01:00:38','::1',' Status: Aberto Rebido: dinheiro OS: '),(126,1,'2018-04-21 01:01:56','::1','Status:Aberto/Pagamento:dinheiro/OS:45'),(127,1,'2018-04-21 01:03:43','::1','Status:Em Andamento/Pagamento:dinheiro/OS:21'),(128,1,'2018-04-21 01:03:59','::1',' Status: Aberto Rebido: dinheiro OS: '),(129,1,'2018-04-21 01:05:09','::1','Status:Aberto/Pagamento:2x/OS:46'),(130,1,'2018-04-21 01:08:05','::1','Status:Aberto/Pagamento:2x/OS:46'),(131,1,'2018-04-21 01:11:25','::1','Status:Aberto/Pagamento:dinheiro/OS:36'),(132,1,'2018-04-21 01:12:16','::1',' Status: Aberto Rebido: dinheiro OS: '),(133,1,'2018-04-21 01:12:31','::1','Status:Aberto/Pagamento:3x/OS:47'),(134,1,'2018-04-21 01:15:48','::1','Status:Aberto/Pagamento:3x/OS:47'),(135,1,'2018-04-21 01:16:49','::1','Status:Aberto/Pagamento:2x/OS:47'),(136,1,'2018-04-21 01:17:02','::1','Status:Aberto/Pagamento:3x/OS:47'),(137,1,'2018-04-21 01:17:46','::1','Status:Aberto/Pagamento:2x/OS:47'),(138,1,'2018-04-21 01:20:38','::1','Status:Aberto/Pagamento:2x/OS:47'),(139,1,'2018-04-21 01:20:40','::1','Status:Aberto/Pagamento:2x/OS:47'),(140,1,'2018-04-21 01:20:46','::1','Status:Aberto/Pagamento:3x/OS:47'),(141,1,'2018-04-21 01:21:27','::1',' Status: Aberto Rebido: 3x OS: '),(142,1,'2018-04-21 01:21:36','::1','Status:Aberto/Pagamento:2x/OS:48'),(143,1,'2018-04-21 01:22:25','::1','Status:Aberto/Pagamento:2x/OS:48'),(144,1,'2018-04-21 01:23:13','::1','Status:Aberto/Pagamento:2x/OS:48'),(145,1,'2018-04-21 01:23:55','::1','Status:Aberto/Pagamento:2x/OS:48'),(146,1,'2018-04-21 01:24:45','::1','Status:Aberto/Pagamento:2x/OS:48'),(147,1,'2018-04-21 01:25:11','::1','Status:Aberto/Pagamento:2x/OS:48'),(148,1,'2018-04-21 01:25:42','::1','Status:Aberto/Pagamento:4x/OS:48'),(149,1,'2018-04-21 01:25:54','::1','Status:Aberto/Pagamento:4x/OS:47'),(150,1,'2018-04-21 01:26:06','::1','Status:Aberto/Pagamento:cartao/OS:47'),(151,1,'2018-04-21 01:26:50','::1','Status:Em Andamento/Pagamento:2x/OS:7'),(152,1,'2018-04-21 01:27:09','::1','Status:Aberto/Pagamento:4x/OS:47'),(153,1,'2018-04-21 01:27:23','::1','Status:Aberto/Pagamento:dinheiro/OS:48'),(154,1,'2018-04-21 01:28:09','::1',' Status: Aberto Rebido: dinheiro OS: '),(155,1,'2018-04-21 02:28:54','::1',' Status: Aberto Rebido: dinheiro OS: '),(156,1,'2018-04-24 02:42:38','::1','Status:Aberto/Pagamento:2x/OS:50'),(157,1,'2018-04-24 02:56:52','::1','Status:Aberto/Pagamento:3x/OS:50'),(158,1,'2018-04-24 02:59:34','::1',' Status: Aberto Rebido: cartao OS: '),(159,1,'2018-04-24 02:59:42','::1','Status:Aberto/Pagamento:cartao/OS:50'),(160,1,'2018-04-24 03:02:08','::1','Status:Aberto/Pagamento:2x/OS:50'),(161,1,'2018-04-24 03:02:34','::1','Status:Aberto/Pagamento:2x/OS:51'),(162,1,'2018-04-24 03:36:46','::1','Status:Aberto/Pagamento:3x/OS:51'),(163,1,'2018-04-24 03:37:02','::1','Status:Aberto/Pagamento:dinheiro/OS:51'),(164,1,'2018-04-24 03:37:30','::1','Status:Aberto/Pagamento:4x/OS:51'),(165,1,'2018-05-15 02:02:23','::1',' Status: Aberto Rebido: 3 OS: '),(166,1,'2018-05-19 00:52:41','::1',' Status: Aberto Rebido:  OS: '),(167,1,'2018-05-19 00:54:33','::1',' Status: Orçamento Rebido:  OS: '),(168,1,'2018-05-19 08:15:22','::1',' Status: Aberto OS: 0'),(169,1,'2018-05-19 08:16:19','::1',' Status: Aberto OS: 0'),(170,1,'2018-05-19 08:16:25','::1',' Status: Aberto OS: 0'),(171,1,'2018-05-19 08:16:44','::1',' Status: Aberto OS: '),(172,1,'2018-05-19 08:16:59','::1',' Status: Aberto OS: '),(173,1,'2018-05-19 08:17:19','::1',' Status: Aberto OS: '),(174,1,'2018-05-19 08:20:51','::1',' Status: Aberto OS: '),(175,1,'2018-05-19 08:22:05','::1',' Status: Aberto OS: '),(176,1,'2018-05-19 08:24:40','::1',' Status: Aberto OS: '),(177,1,'2018-05-19 08:25:32','::1',' Status: Aberto OS: '),(178,1,'2018-05-19 08:28:32','::1',' Status: Aberto OS: '),(179,1,'2018-05-20 01:17:44','::1','Status:Aberto/OS:48'),(180,1,'2018-05-21 23:08:51','::1','Status:Aberto/OS:22'),(181,1,'2018-05-21 23:30:52','::1',' Status: Aberto OS: '),(182,1,'2018-05-21 23:35:45','::1',' Status: Aberto OS: '),(183,1,'2018-05-21 23:36:38','::1',' Status: Aberto OS: '),(184,1,'2018-05-21 23:37:51','::1','Status:Aberto/OS:70'),(185,1,'2018-05-21 23:38:15','::1',' Status: Aberto OS: '),(186,1,'2018-05-21 23:39:12','::1',' Status: Aberto OS: 72'),(187,1,'2018-05-21 23:39:28','::1','Status:Em Andamento/OS:72'),(188,1,'2018-05-23 23:55:57','192.168.17.7',' Status: Aberto OS: 73'),(189,1,'2018-05-30 01:45:56','::1','Status:Cancelado/OS:5'),(190,1,'2018-05-30 01:46:02','::1','Status:Orçamento/OS:5');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (1,'Az América'),(3,'AZ BOX'),(4,'PPA'),(5,'UNISYSTEM'),(6,'CS'),(7,'SULTON'),(8,'CONFIASTES'),(9,'INTELBRAS'),(10,'OUTRO'),(11,'MULTITOC'),(12,'WESTERN'),(13,'SEAGATE'),(14,'CONDUTTI'),(15,'TESTE');
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordem`
--

DROP TABLE IF EXISTS `ordem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ordem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datainicial` date NOT NULL,
  `datafinal` date NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `observacao` varchar(100) NOT NULL,
  `status` enum('Aberto','Em Andamento','Finalizado','Cancelado','Orçamento') NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkcliente_idx` (`id_cliente`),
  KEY `fkusuario_idx` (`id_usuario`),
  CONSTRAINT `fkcliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkusuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordem`
--

LOCK TABLES `ordem` WRITE;
/*!40000 ALTER TABLE `ordem` DISABLE KEYS */;
INSERT INTO `ordem` VALUES (5,'2018-03-22 05:38:02','2018-03-21','2018-03-21','teste','Testiculofsdfsafsadfsa','Orçamento',2,1),(6,'2018-03-22 05:38:02','2018-03-21','2018-03-21','teste','teste teste teste','Orçamento',1,1),(7,'2018-03-22 05:38:02','2018-03-21','2018-03-21','testetewrwerwqe','testedfdsafsda','Em Andamento',2,1),(17,'2018-03-24 11:22:48','2018-03-21','2018-03-21','teste','Pago','Aberto',2,1),(19,'2018-03-24 11:35:15','2018-03-24','2018-03-24','fdasfs','fasdfsa','Cancelado',2,1),(21,'2018-03-24 11:43:09','2018-03-24','2018-03-24','fsdafas','fsdafsa','Em Andamento',2,1),(22,'2018-03-26 05:31:16','2018-03-26','2018-05-31','fsdafdasfdsa','','Aberto',2,1),(23,'2018-03-29 07:27:42','2018-03-29','2018-03-31','Instalação Sistema de Monitoramento','Instalação Comercial , Sistema de Monitoramento com Camêras AHD','Aberto',2,1),(24,'2018-03-30 23:33:04','2018-03-30','2018-03-30','Teste','Teste','Em Andamento',2,1),(25,'2018-04-21 02:51:37','2018-04-20','2018-04-20','fsda','fsda','Aberto',1,1),(26,'2018-04-21 03:01:21','2018-04-21','2018-04-21','adsa','das','Aberto',1,1),(27,'2018-04-21 03:01:28','2018-04-21','2018-04-21','adsa','das','Aberto',1,1),(28,'2018-04-21 03:01:33','2018-04-21','2018-04-21','adsa','das','Aberto',1,1),(29,'2018-04-21 03:01:38','2018-04-21','2018-04-21','adsa','das','Aberto',1,1),(30,'2018-04-21 03:23:38','2018-04-21','2018-04-21','sdas','dasd','Aberto',2,1),(31,'2018-04-21 03:53:47','2018-04-21','2018-04-21','sdas','dasd','Aberto',2,1),(32,'2018-04-21 03:54:11','2018-04-21','2018-04-21','sdas','dasd','Aberto',1,1),(33,'2018-04-21 03:54:31','2018-04-21','2018-04-21','sdas','dasd','Aberto',2,1),(34,'2018-04-21 03:55:12','2018-04-21','2018-04-21','sdas','dasd','Aberto',2,1),(35,'2018-04-21 03:55:16','2018-04-21','2018-04-21','sdas','dasd','Aberto',2,1),(36,'2018-04-21 03:55:45','2018-04-21','2018-04-21','sdas','dasd','Aberto',2,1),(37,'2018-04-21 03:56:13','2018-04-21','2018-04-21','sdas','dasd','Aberto',2,1),(38,'2018-04-21 03:56:19','2018-04-21','2018-04-21','sdas','dasd','Aberto',1,1),(39,'2018-04-21 03:56:36','2018-04-21','2018-04-21','sdas','dasd','Aberto',2,1),(40,'2018-04-21 03:56:49','2018-04-21','2018-04-21','sdas','dasd','Aberto',2,1),(41,'2018-04-21 03:57:18','2018-04-21','2018-04-21','sdas','dasd','Aberto',2,1),(42,'2018-04-21 03:58:12','2018-04-21','2018-04-21','das','das','Aberto',2,1),(43,'2018-04-21 03:58:30','2018-04-21','2018-04-21','dasdas','dsada','Aberto',2,1),(44,'2018-04-21 04:00:11','2018-04-21','2018-04-21','dasdas','dsada','Aberto',2,1),(45,'2018-04-21 04:00:38','2018-04-21','2018-04-21','fsdafa','fsda','Aberto',2,1),(46,'2018-04-21 04:03:59','2018-04-21','2018-04-21','fsda','fsdafas','Aberto',1,1),(47,'2018-04-21 04:12:16','2018-04-21','2018-04-21','das','','Aberto',2,1),(48,'2018-04-21 04:21:27','2018-04-21','2018-04-21','csa','dsa','Aberto',1,1),(49,'2018-04-21 04:28:09','2018-04-21','2018-04-21','fsa','fsda','Aberto',2,1),(50,'2018-04-21 05:28:54','2018-04-21','2018-04-21','dasdas','dsadas','Aberto',2,1),(51,'2018-04-24 05:59:34','2018-04-24','2018-04-24','dasd','das','Aberto',2,1),(52,'2018-05-19 03:54:33','2018-05-19','2018-05-19','tste','teste','Orçamento',2,1),(53,'2018-05-19 03:57:15','2018-05-19','2018-05-19','teste','teste','Aberto',2,1),(54,'2018-05-19 03:59:13','2018-05-19','2018-05-19','gjghjgj','','Aberto',2,1),(55,'2018-05-19 11:13:09','2018-05-19','2018-05-19','gjghjgj','fdsafads','Aberto',2,1),(56,'2018-05-19 11:13:59','2018-05-19','2018-05-19','gjghjgj','fdsafads','Aberto',2,1),(57,'2018-05-19 11:15:22','2018-05-19','2018-05-19','gjghjgj','fdsafads','Aberto',2,1),(58,'2018-05-19 11:16:19','2018-05-19','2018-05-19','gjghjgj','fdsafads','Aberto',2,1),(59,'2018-05-19 11:16:25','2018-05-19','2018-05-19','gjghjgj','fdsafads','Aberto',2,1),(60,'2018-05-19 11:16:45','2018-05-19','2018-05-19','gjghjgj','fdsafads','Aberto',2,1),(61,'2018-05-19 11:16:59','2018-05-19','2018-05-19','gjghjgj','fdsafads','Aberto',2,1),(62,'2018-05-19 11:17:19','2018-05-19','2018-05-19','afdsfda','fdsafsa','Aberto',2,1),(63,'2018-05-19 11:20:51','2018-05-19','2018-05-19','afdsfda','fdsafsa','Aberto',2,1),(64,'2018-05-19 11:22:05','2018-05-19','2018-05-19','afdsfda','fdsafsa','Aberto',2,1),(65,'2018-05-19 11:24:40','2018-05-19','2018-05-19','fdsaf','a','Aberto',2,1),(66,'2018-05-19 11:25:32','2018-05-19','2018-05-19','fdsaf','ada','Aberto',2,1),(67,'2018-05-19 11:28:32','2018-05-19','2018-05-19','fdsaf','ada','Aberto',0,1),(68,'2018-05-22 02:30:52','2018-05-21','2018-05-21','Teste','Teste','Aberto',2,1),(69,'2018-05-22 02:35:45','2018-05-21','2018-05-21','sdfdsa','fdsa','Aberto',2,1),(70,'2018-05-22 02:36:38','2018-05-21','2018-05-21','sdfdsa','fdsa','Aberto',2,1),(71,'2018-05-22 02:38:15','2018-05-21','2018-05-21','rewqrq','reqwrwqe','Aberto',1,1),(72,'2018-05-22 02:39:12','2018-05-21','2018-05-21','fdsafsa','fdas','Em Andamento',2,1),(73,'2018-05-24 02:55:57','2018-05-23','2018-05-23','Yes','','Aberto',2,1);
/*!40000 ALTER TABLE `ordem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parcela`
--

DROP TABLE IF EXISTS `parcela`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parcela` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordem` int(11) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `datavcto` date DEFAULT NULL,
  `datapgto` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkparcela1_idx` (`id_ordem`)
) ENGINE=InnoDB AUTO_INCREMENT=465 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parcela`
--

LOCK TABLES `parcela` WRITE;
/*!40000 ALTER TABLE `parcela` DISABLE KEYS */;
INSERT INTO `parcela` VALUES (348,42,0,'2018-05-11','2018-05-11'),(349,42,0,'2018-06-11','2018-05-25'),(350,42,0,'2018-07-11','2018-05-30'),(351,42,0,'2018-08-11','2018-05-18'),(359,45,0,'2018-05-11',NULL),(366,37,156.25,'2018-05-12','2018-05-12'),(367,37,156.25,'2018-06-12','2018-05-15'),(368,37,156.25,'2018-07-12',NULL),(369,37,156.25,'2018-08-12',NULL),(370,17,614.73,'2018-05-15','0000-00-00'),(371,17,614.73,'2018-06-15','0000-00-00'),(372,17,614.73,'2018-05-23','2018-05-15'),(373,17,614.73,'2018-05-31','2018-05-15'),(380,40,14396.3,'2018-05-15','2018-05-21'),(381,40,14396.3,'2018-05-22','2018-05-21'),(382,40,14396.3,'2018-05-30','1969-12-31'),(383,40,14396.3,'2018-05-16','2018-05-21'),(394,49,1056.52,'2015-07-08','2014-06-10'),(395,49,1056.52,'2018-06-15','1969-11-27'),(396,49,1056.52,'2018-07-15','2019-07-18'),(397,22,61.02,'2018-05-15','2018-07-11'),(398,22,61.02,'2018-02-13','2018-05-15'),(399,22,61.02,'2018-07-15','2018-05-15'),(400,22,61.02,'2018-08-15','2018-05-15'),(401,31,3125.03,'2018-05-17','2018-06-12'),(402,31,3125.03,'2018-06-15','2018-05-15'),(403,31,3125.03,'2018-07-15','2018-05-15'),(404,31,3125.03,'2018-08-15','2018-05-20'),(405,50,56.11,'2018-05-16','2018-05-18'),(406,50,56.11,'2018-06-16','2018-05-18'),(407,50,56.11,'2018-07-16','2018-05-18'),(408,50,56.11,'2018-08-16','2018-05-18'),(411,7,66.75,'2018-05-18','2018-05-18'),(412,7,66.75,'2018-06-18',NULL),(415,36,750,'2018-05-18',NULL),(416,36,750,'2018-06-18',NULL),(419,19,1500,'2018-05-18','2018-05-18'),(421,48,29.74,'2018-05-20',NULL),(422,48,29.74,'2018-06-20',NULL),(423,48,29.74,'2018-07-20',NULL),(424,48,29.74,'2018-08-20',NULL),(425,72,0,'2018-05-22','2018-05-22'),(426,72,0,'2018-06-22',NULL),(427,71,0,'2018-05-22',NULL),(428,71,0,'2018-06-22',NULL),(429,71,0,'2018-07-22',NULL),(430,70,0,'2018-05-22',NULL),(431,66,0,'2018-05-22','2018-05-22'),(432,66,0,'0000-00-00',NULL),(434,5,678.47,'2018-05-22','2018-05-22'),(435,5,678.47,'2018-06-22','2018-05-28'),(436,5,678.47,'2018-07-22','2018-05-17'),(437,6,374.3,'2018-05-23','2018-05-24'),(438,6,374.3,'2018-06-23','2018-05-29'),(439,6,374.3,'2018-07-23','2018-05-28'),(440,21,1000,'2018-05-23','2018-05-23'),(441,23,8201.5,'2018-05-23','2018-05-23'),(442,24,148.95,'2018-05-23','2018-05-23'),(443,24,148.95,'2018-06-23',NULL),(444,24,148.95,'2018-07-23',NULL),(445,24,148.95,'2018-08-23',NULL),(446,30,0,'2018-05-23',NULL),(447,30,0,'2018-06-23',NULL),(451,25,0,'2018-05-23','2018-05-23'),(452,25,0,'2018-06-23',NULL),(453,25,0,'2018-07-23',NULL),(454,73,79.7,'2018-05-25','2018-05-25'),(455,73,79.7,'2018-06-23',NULL),(456,73,79.7,'2018-07-23',NULL),(457,26,0,'2018-05-30','2018-05-30'),(458,26,0,'2018-06-30',NULL),(459,26,0,'2018-07-30',NULL),(460,29,0,'2018-05-30','2018-05-30'),(461,27,0,'2018-05-30',NULL),(462,27,0,'2018-06-30',NULL),(463,27,0,'2018-07-30',NULL),(464,27,0,'2018-08-30',NULL);
/*!40000 ALTER TABLE `parcela` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `estoque` int(11) NOT NULL,
  `valor` float NOT NULL,
  `id_marca` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fkmarca_idx` (`id_marca`),
  CONSTRAINT `fkmarca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
INSERT INTO `produto` VALUES (4,'CAMERA BULLET 1080 HDCVI 20M','HDCVI VHD 1220B FULL HD 1080P 3,6MM G3 20 METROS',7,1500,9),(5,'CAMERA DOME HDCVI 1080 20M 1/3','VHD 1220D G3 3.6MM 1080P MULTI HD 20 METROS',2,249.9,9),(6,'DVR 8 CANAIS MHDX 3008 HIBRIDO','MHDX 3008 G3 MULTI HD FULL HD 1080P HDCVI / AHD / HDTVI / ANALÒGICO / IP',5,830.2,9),(8,'CAMERA 1000 LINHAS OU AHD 1/3 10M','VMD 1010 IR G3 CAMERA HIBRIDA 1000 LINHAS E AHD',5,117.6,9),(9,'CAMERA BULLET HDCVI 720P  10M 1/3','VHD 1010 B G3 IR 10 METROS HDCVI / AHD / HDTVI / ANALÒGICO',10,128,9),(10,'CONECTOR BNC COM MOLA E PARAFUSO PLUG CFTV','CONECTOR BNC FEMEA COM MOLA E PARAFUSO',200,2.5,10),(11,'CAIXA SOBREPOR CFTV BALUN QUADRADA BRANCA 8 X','MEDIDA: 8CMX8CMX4CM MATERIAL: ABS TRATADO COR: BRANCO',0,8.5,11),(12,'HD 1TB PURPLE ADEQUADO PARA DVR','HD 1TB PURPLE ESPECIFICO PARA  CFTV DVR WD10PURZ',1,359.9,12),(14,'CABO 4MM CFTV CAMERA METRO','ALIMENTAçãO BIPOLAR 90% 95% MALHA 1 METRO',585,0.9,14),(15,'CABO REDE CAT5E','CABO CFTV REDE CAT5E UTP 4 PARES',9847,1.35,10),(16,'TESTE','TESTE',12,123.33,15),(17,'CAMERA DE TESTE','FDSAFDSA',123,123.33,14);
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_os`
--

DROP TABLE IF EXISTS `produto_os`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto_os` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade` int(11) NOT NULL,
  `id_ordem` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkproduto_idx` (`id_produto`),
  KEY `fkordem_idx` (`id_ordem`),
  CONSTRAINT `fkordem` FOREIGN KEY (`id_ordem`) REFERENCES `ordem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkproduto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=366 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_os`
--

LOCK TABLES `produto_os` WRITE;
/*!40000 ALTER TABLE `produto_os` DISABLE KEYS */;
INSERT INTO `produto_os` VALUES (314,7,5,11,68),(315,1,5,14,0.9),(316,1,5,4,1500),(317,1,7,11,8.5),(318,4,6,11,34),(319,5,6,8,588),(320,1234,17,14,1110.6),(321,49,22,14,45),(324,1,23,6,830.2),(325,100,23,14,90),(326,3,23,11,25.5),(327,4,23,4,6000),(328,2,23,9,256),(329,2,23,5,499.8),(330,12,24,14,10.8),(331,10,24,11,85),(332,6,46,14,5.4),(333,2,46,8,235.2),(334,9,49,14,11.7),(335,27,49,15,37.8),(337,1,48,8,352.8),(338,1,48,15,4.05),(339,5,47,15,6.75),(340,2,47,8,235.2),(351,4,50,14,3.6),(352,71,50,15,95.85),(353,4,51,15,5.4),(354,2,43,10,5),(355,1,6,14,0.9),(356,2,49,4,3000),(357,42,33,15,56.7),(358,1,33,4,1500),(359,2,40,8,235.2),(360,1000,40,15,1350),(364,1,19,4,1500),(365,66,73,15,89.1);
/*!40000 ALTER TABLE `produto_os` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servico`
--

DROP TABLE IF EXISTS `servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `valor` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico`
--

LOCK TABLES `servico` WRITE;
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
INSERT INTO `servico` VALUES (3,'Instalação Câmera CFTV','Instalação Simples, Passagem dos fios, fixação montagem dos conectores',65),(5,'Instalação Motor Deslizante','Instalação Motor de Portão Deslizante Residencial',150),(6,'Instalação Antena Banda KU','Instalação Completa Antena Banda KU, Apontamento, Fios, Configuração',125),(7,'Teste','Teste',123.33);
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servico_os`
--

DROP TABLE IF EXISTS `servico_os`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servico_os` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordem` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `valor` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fkservico_idx` (`id_servico`),
  KEY `fkordem2_idx` (`id_ordem`),
  CONSTRAINT `fkordem2` FOREIGN KEY (`id_ordem`) REFERENCES `ordem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkservico` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servico_os`
--

LOCK TABLES `servico_os` WRITE;
/*!40000 ALTER TABLE `servico_os` DISABLE KEYS */;
INSERT INTO `servico_os` VALUES (143,5,3,350),(144,5,6,125),(146,7,6,125),(147,6,6,125),(148,6,6,125),(149,6,6,125),(150,6,6,125),(151,17,6,125),(152,17,6,1223.33),(154,22,6,200),(155,23,3,500),(156,24,6,500),(157,46,6,125),(158,46,6,125),(159,46,6,250),(160,49,6,125),(161,47,6,125),(164,50,6,125),(165,51,6,125),(166,33,3,1800),(167,37,6,125),(168,37,6,125),(169,37,6,125),(170,37,6,125),(171,37,6,125),(173,31,6,12500.1),(174,36,5,1500),(175,35,5,15000),(176,40,3,56000),(178,21,6,1000),(179,38,6,1250),(180,73,5,150);
/*!40000 ALTER TABLE `servico_os` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `cpfcnpj` varchar(14) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL,
  `permissao` varchar(15) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Geovani Pereira','geovani@mail.com','094.372.329-97','(44)99887766','admin','Sim','geovani','202cb962ac59075b964b07152d234b70'),(2,'Antonio Aparecido Pereira','antonio@mail.com','266.896.656-65','(44)999993366','admin','Não','antonio','202cb962ac59075b964b07152d234b70'),(4,'Joao Vitor','joao@mail.com','888.999.999-98','(11)11111111','funcionario','Sim','joao','202cb962ac59075b964b07152d234b70'),(5,'Patrick Henrique Santana Ferrareze','patrick@email.com','48.548.548-55','(44)33333333','admin','Sim','patrick','202cb962ac59075b964b07152d234b70');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-30 22:59:13
