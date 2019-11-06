/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `purchaseOrder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) DEFAULT NULL,
  `createdBy_employee_id` int(11) DEFAULT NULL,
  `submittedDate` datetime DEFAULT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_id` int(11) DEFAULT '0',
  `expectedDate` datetime DEFAULT NULL,
  `shippingFee` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `taxes` decimal(19,4) NOT NULL DEFAULT '0.0000',
  `paymentDate` datetime DEFAULT NULL,
  `paymentAmount` decimal(19,4) DEFAULT '0.0000',
  `paymentMethod` varchar(50) DEFAULT NULL,
  `notes` longtext,
  `approvedBy_employee_id` int(11) DEFAULT NULL,
  `approvedDate` datetime DEFAULT NULL,
  `submittedBy_employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `createdBy` (`createdBy_employee_id`),
  KEY `status_id` (`status_id`),
  KEY `supplier_id` (`supplier_id`),
  CONSTRAINT `fkPurchaseOrderEmployees1` FOREIGN KEY (`createdBy_employee_id`) REFERENCES `northwind_model`.`employee` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkPurchaseOrderPurchaseOrderStatus1` FOREIGN KEY (`status_id`) REFERENCES `northwind_model`.`purchaseOrderStatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fkPurchaseOrderSuppliers1` FOREIGN KEY (`supplier_id`) REFERENCES `northwind_model`.`supplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
