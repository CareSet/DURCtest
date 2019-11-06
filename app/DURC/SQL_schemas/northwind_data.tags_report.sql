/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tags_report` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `field_to_bold_in_report_display` varchar(255) NOT NULL,
  `field_to_hide_by_default` varchar(255) NOT NULL,
  `field_to_italic_in_report_display` varchar(255) NOT NULL,
  `field_to_right_align_in_report` varchar(255) NOT NULL,
  `field_to_bolditalic_in_report_display` varchar(255) NOT NULL,
  `numeric_field` int(11) NOT NULL,
  `decimal_field` decimal(10,4) NOT NULL,
  `currency_field` varchar(255) NOT NULL,
  `percent_field` int(11) NOT NULL,
  `url_field` varchar(255) NOT NULL,
  `time_field` time NOT NULL,
  `date_field` date NOT NULL,
  `datetime_field` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;
