/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `magicField` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `editsome_markdown` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typesome_sql_code` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typesome_php_code` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `typesome_python_code` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `typesome_javascript_code` varchar(3000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `this_datetime` datetime NOT NULL,
  `this_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
