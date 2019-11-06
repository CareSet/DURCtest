/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bookextended` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(255) NOT NULL,
  `local_isle` varchar(255) NOT NULL,
  `local_shelf` int(255) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
