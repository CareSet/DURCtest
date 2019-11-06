/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `funnything` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thisint` int(11) DEFAULT NULL,
  `thisfloat` float DEFAULT NULL,
  `thisdecimal` decimal(5,5) DEFAULT NULL,
  `thisvarchar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thisdate` date DEFAULT NULL,
  `thisdatetime` datetime DEFAULT NULL,
  `thistimestamp` timestamp NULL DEFAULT NULL,
  `thischar` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thistext` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thisblob` blob,
  `thistinyint` tinyint(11) NOT NULL,
  `thistinytext` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
