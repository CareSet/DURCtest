/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `foreignkeytestthingy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thingyname` varchar(100) NOT NULL,
  `gizmopickupaskey` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gizmopickupaskey` (`gizmopickupaskey`),
  CONSTRAINT `forgizmo` FOREIGN KEY (`gizmopickupaskey`) REFERENCES `foreignkeytestgizmo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
