/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchaseOrderDetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchaseOrder_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` decimal(18,4) NOT NULL,
  `unitCost` decimal(19,4) NOT NULL,
  `dateReceived` datetime DEFAULT NULL,
  `postedToInventory` tinyint(1) NOT NULL DEFAULT '0',
  `inventory_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `inventory_id` (`inventory_id`),
  KEY `purchaseOrder_id` (`purchaseOrder_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fkPurchaseOrderDetailInventoryTransaction1` FOREIGN KEY (`inventory_id`) REFERENCES `inventorytransaction` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkPurchaseOrderDetailProducts1` FOREIGN KEY (`product_id`) REFERENCES `northwind_model`.`product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkPurchaseOrderDetailPurchaseOrder1` FOREIGN KEY (`purchaseOrder_id`) REFERENCES `purchaseorder` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
