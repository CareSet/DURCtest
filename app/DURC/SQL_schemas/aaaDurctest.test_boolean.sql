/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test_boolean` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `is_something` varchar(255) NOT NULL,
  `has_something` varchar(255) NOT NULL,
  `is_something2` tinyint(4) DEFAULT NULL,
  `has_something2` tinyint(4) DEFAULT NULL,
  `has_something3` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
