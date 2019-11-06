/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `invoiceDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dueDate` datetime DEFAULT NULL,
  `tax` decimal(19,4) DEFAULT '0.0000',
  `shipping` decimal(19,4) DEFAULT '0.0000',
  `amountDue` decimal(19,4) DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `fkInvoicesOrder1_idx` (`order_id`),
  CONSTRAINT `fkInvoicesOrder1` FOREIGN KEY (`order_id`) REFERENCES `northwind_model`.`order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
