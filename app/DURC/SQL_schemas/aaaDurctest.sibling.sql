/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sibling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siblingname` varchar(255) NOT NULL,
  `step_sibling_id` int(11) DEFAULT NULL,
  `sibling_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
