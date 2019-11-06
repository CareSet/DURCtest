/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventoryTransaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transactionType` tinyint(4) NOT NULL,
  `transactionCreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transactionModifiedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchaseOrder_id` int(11) DEFAULT NULL,
  `customerOrder_id` int(11) DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customerOrder_id` (`customerOrder_id`),
  KEY `product_id` (`product_id`),
  KEY `purchaseOrder_id` (`purchaseOrder_id`),
  KEY `transactionType` (`transactionType`),
  CONSTRAINT `fkInventoryTransactionInventoryTransactionType1` FOREIGN KEY (`transactionType`) REFERENCES `northwind_model`.`inventorytransactiontype` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkInventoryTransactionOrder1` FOREIGN KEY (`customerOrder_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkInventoryTransactionProducts1` FOREIGN KEY (`product_id`) REFERENCES `northwind_model`.`product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkInventoryTransactionPurchaseOrder1` FOREIGN KEY (`purchaseOrder_id`) REFERENCES `purchaseorder` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
