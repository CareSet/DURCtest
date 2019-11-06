/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `supplier_ids` longtext,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productCode` varchar(25) DEFAULT NULL,
  `productName` varchar(50) DEFAULT NULL,
  `description` longtext,
  `standardCost` decimal(19,4) DEFAULT '0.0000',
  `listPrice` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `reorderLevel` int(11) DEFAULT NULL,
  `targetLevel` int(11) DEFAULT NULL,
  `quantityPerUnit` varchar(50) DEFAULT NULL,
  `discontinued` tinyint(1) NOT NULL DEFAULT '0',
  `minimumReorderQuantity` int(11) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `attachments` longblob,
  PRIMARY KEY (`id`),
  KEY `productCode` (`productCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
