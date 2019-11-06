/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) DEFAULT NULL,
  `emailAddress` varchar(50) DEFAULT NULL,
  `jobTitle` varchar(50) DEFAULT NULL,
  `businessPhone` varchar(25) DEFAULT NULL,
  `homePhone` varchar(25) DEFAULT NULL,
  `mobilePhone` varchar(25) DEFAULT NULL,
  `faxNumber` varchar(25) DEFAULT NULL,
  `address` longtext,
  `city` varchar(50) DEFAULT NULL,
  `stateProvince` varchar(50) DEFAULT NULL,
  `zipPostalCode` varchar(15) DEFAULT NULL,
  `countryRegion` varchar(50) DEFAULT NULL,
  `webPage` longtext,
  `notes` longtext,
  `attachments` longblob,
  `random_date` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city` (`city`),
  KEY `company` (`companyName`),
  KEY `firstName` (`firstName`),
  KEY `lastName` (`lastName`),
  KEY `zipPostalCode` (`zipPostalCode`),
  KEY `stateProvince` (`stateProvince`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
