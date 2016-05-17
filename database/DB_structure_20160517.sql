DROP DATABASE IF EXISTS casarover;
CREATE DATABASE casarover;
USE casarover;


DROP TABLE IF EXISTS `activity_register`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_register` (
  `id` bigint(20) NOT NULL auto_increment,
  `username` varchar(64) NOT NULL,
  `activity_name` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `activity_youyuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_youyuan` (
  `id` int(11) NOT NULL auto_increment,
  `openid` varchar(64) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `orderid` varchar(128) default NULL,
  `status` tinyint(4) default '0',
  `groupid` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `openid` (`openid`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `orderid` (`orderid`)
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `password` varchar(60) collate utf8_unicode_ci NOT NULL,
  `status` tinyint(4) default NULL,
  `remember_token` varchar(100) collate utf8_unicode_ci default NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `area_casa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area_casa` (
  `id` int(11) NOT NULL auto_increment,
  `area_id` bigint(20) default NULL,
  `casa_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_reference_27` (`area_id`),
  KEY `fk_reference_28` (`casa_id`),
  CONSTRAINT `fk_reference_27` FOREIGN KEY (`area_id`) REFERENCES `area_dictionary` (`id`),
  CONSTRAINT `fk_reference_28` FOREIGN KEY (`casa_id`) REFERENCES `casa` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `area_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area_content` (
  `id` bigint(20) NOT NULL auto_increment,
  `area_id` bigint(20) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_reference_17` (`area_id`),
  KEY `fk_reference_18` (`content_id`),
  CONSTRAINT `fk_reference_17` FOREIGN KEY (`area_id`) REFERENCES `area_dictionary` (`id`),
  CONSTRAINT `fk_reference_18` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=687 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `area_dictionary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `area_dictionary` (
  `id` bigint(20) NOT NULL auto_increment,
  `value` varchar(64) default NULL,
  `parentid` bigint(20) default NULL,
  `level` int(11) default NULL,
  `islast` int(11) default NULL,
  `type` int(11) default NULL,
  `update_time` datetime default NULL,
  `status` int(11) default NULL,
  `tier` tinyint(4) default NULL,
  `position` varchar(40) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachment` (
  `id` bigint(20) NOT NULL auto_increment,
  `type` varchar(32) default NULL,
  `name` varchar(64) default NULL,
  `comment` text,
  `score` bigint(20) default NULL,
  `update_time` datetime default NULL,
  `filepath` varchar(1024) default NULL,
  `status` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4995 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL auto_increment,
  `dictionary_id` bigint(20) default NULL,
  `attachment_id` bigint(20) default NULL,
  `dicid` bigint(20) default NULL,
  `name` varchar(16) NOT NULL,
  `pwd` varchar(128) NOT NULL,
  `gender` smallint(6) default '0',
  `type` varchar(16) default 'Phone',
  `qq_openid` varchar(64) default NULL,
  `wechat_openid` varchar(64) default NULL,
  `resume` varchar(64) default NULL,
  `qq` varchar(64) default NULL,
  `phone` varchar(32) default NULL,
  `webchat` varchar(64) default NULL,
  `email` varchar(64) default NULL,
  `token` varchar(64) default NULL,
  `photofileid` bigint(20) default NULL,
  `birthday` datetime default NULL,
  `update_time` datetime default NULL,
  `logout_time` datetime default NULL,
  `status` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `qq_openid` (`qq_openid`),
  UNIQUE KEY `wechat_openid` (`wechat_openid`),
  KEY `fk_reference_5` (`dictionary_id`),
  KEY `fk_reference_6` (`attachment_id`),
  CONSTRAINT `fk_reference_5` FOREIGN KEY (`dictionary_id`) REFERENCES `area_dictionary` (`id`),
  CONSTRAINT `fk_reference_6` FOREIGN KEY (`attachment_id`) REFERENCES `attachment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `brief`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brief` (
  `id` bigint(20) NOT NULL auto_increment,
  `casa_id` bigint(20) default NULL,
  `name` varchar(64) default NULL,
  `body` text,
  `pic` bigint(20) default NULL,
  `update_time` datetime default NULL,
  `status` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_reference_4` (`casa_id`),
  CONSTRAINT `fk_reference_4` FOREIGN KEY (`casa_id`) REFERENCES `casa` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `casa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `casa` (
  `id` bigint(20) NOT NULL auto_increment,
  `dictionary_id` bigint(20) default NULL,
  `attachment_id` bigint(20) default NULL,
  `user_id` bigint(20) default NULL,
  `code` varchar(64) default NULL,
  `name` varchar(64) default NULL,
  `link` varchar(10240) default NULL,
  `resume` text,
  `praise_num` bigint(20) default '0',
  `favourite_num` bigint(20) default '0',
  `score` double default '0',
  `max_price` double default '0',
  `min_price` double default '0',
  `deleted` smallint(6) default '0',
  `updated_at` datetime default NULL,
  `updated_by` int(11) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `fk_reference_10` (`attachment_id`),
  KEY `fk_reference_11` (`user_id`),
  KEY `fk_reference_8` (`dictionary_id`),
  CONSTRAINT `fk_reference_10` FOREIGN KEY (`attachment_id`) REFERENCES `attachment` (`attachment_id`),
  CONSTRAINT `fk_reference_11` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `fk_reference_8` FOREIGN KEY (`dictionary_id`) REFERENCES `area_dictionary` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=274 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `casa_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `casa_tag` (
  `id` bigint(20) NOT NULL auto_increment,
  `casa_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_Reference_12` (`casa_id`),
  KEY `FK_Reference_13` (`tag_id`),
  CONSTRAINT `FK_Reference_12` FOREIGN KEY (`casa_id`) REFERENCES `casa` (`id`),
  CONSTRAINT `FK_Reference_13` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1058 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `parentid` bigint(20) default NULL,
  `value` varchar(64) default NULL,
  `update_time` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_reference_7` (`user_id`),
  CONSTRAINT `fk_reference_7` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content` (
  `id` bigint(20) NOT NULL auto_increment,
  `casa_id` bigint(20) default NULL,
  `name` varchar(64) default NULL,
  `text` text,
  `display_order` int(11) default NULL,
  `type` varchar(16) default NULL,
  `update_time` datetime default NULL,
  `house` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_Reference_14` (`casa_id`),
  CONSTRAINT `FK_Reference_14` FOREIGN KEY (`casa_id`) REFERENCES `casa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4575 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `content_attachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_attachment` (
  `id` bigint(20) NOT NULL auto_increment,
  `attachment_id` bigint(20) default NULL,
  `content_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`),
  KEY `FK_Reference_15` (`content_id`),
  KEY `FK_Reference_16` (`attachment_id`),
  CONSTRAINT `FK_Reference_15` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`),
  CONSTRAINT `FK_Reference_16` FOREIGN KEY (`attachment_id`) REFERENCES `attachment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4360 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `content_theme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `content_theme` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `theme_id` bigint(20) default NULL,
  `content_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=224 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `favourite`
--

DROP TABLE IF EXISTS `favourite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favourite` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `casa_id` bigint(20) default NULL,
  `favovrite_type` int(11) default NULL,
  `update_time` datetime default NULL,
  `status` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `fk_reference_2` (`user_id`),
  KEY `fk_reference_3` (`casa_id`),
  CONSTRAINT `fk_reference_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_reference_3` FOREIGN KEY (`casa_id`) REFERENCES `casa` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` bigint(20) NOT NULL auto_increment,
  `user_id` bigint(20) default NULL,
  `date` datetime NOT NULL,
  `class` varchar(64) default NULL,
  `method` varchar(64) default NULL,
  `text` text,
  PRIMARY KEY  (`id`),
  KEY `fk_reference_1` (`user_id`),
  CONSTRAINT `fk_reference_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lottery` (
  `id` bigint(20) NOT NULL auto_increment,
  `wechat_openid` varchar(64) NOT NULL,
  `count_total` smallint(6) default '0',
  `count_today` smallint(6) default '0',
  `update_time` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `wechat_openid` (`wechat_openid`)
) ENGINE=InnoDB AUTO_INCREMENT=206 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) collate utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `brief` varchar(255) collate utf8_unicode_ci default NULL,
  `attachment_id` int(11) NOT NULL,
  `casa_id` int(11) NOT NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `reward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reward` (
  `id` bigint(20) NOT NULL auto_increment,
  `wechat_openid` varchar(64) NOT NULL,
  `cellphone` varchar(64) NOT NULL,
  `reward_level` smallint(6) default NULL,
  `received` smallint(6) default '0',
  `update_time` datetime default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `wechat_openid` (`wechat_openid`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) collate utf8_unicode_ci NOT NULL,
  `user_id` int(11) default NULL,
  `ip_address` varchar(45) collate utf8_unicode_ci default NULL,
  `user_agent` text collate utf8_unicode_ci,
  `payload` text collate utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) default NULL,
  `name` varchar(64) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` bigint(20) NOT NULL auto_increment,
  `name` varchar(64) NOT NULL,
  `type` varchar(64) default NULL,
  `update_time` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `themes` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(16) NOT NULL,
  `brief` varchar(128) NOT NULL,
  `attachment_id` bigint(20) default NULL,
  `status` tinyint(4) default NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;



DROP TABLE IF EXISTS `wechat_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wechat_article` (
  `id` bigint(20) NOT NULL auto_increment,
  `attachment_id` bigint(20) default NULL,
  `title` varchar(64) default NULL,
  `brief` text,
  `address` varchar(10240) default NULL,
  `type` smallint(6) default '0',
  `series` smallint(6) default '0',
  `deleted` smallint(6) default '0',
  `update_at` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `fk_reference_19` (`attachment_id`),
  CONSTRAINT `fk_reference_19` FOREIGN KEY (`attachment_id`) REFERENCES `attachment` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `wechat_series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wechat_series` (
  `id` smallint(6) NOT NULL auto_increment,
  `type` smallint(6) default '0',
  `name` varchar(16) NOT NULL,
  `brief` varchar(255) default NULL,
  `attachment_id` bigint(20) default NULL,
  `status` tinyint(4) default NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  `thumb_id` bigint(20) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;


--
-- Table structure for table `wx_bind`
--

DROP TABLE IF EXISTS `wx_bind`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_bind` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `wx_user_id` bigint(20) unsigned NOT NULL,
  `wx_casa_id` bigint(20) unsigned NOT NULL,
  `status` smallint(6) NOT NULL,
  `casa_name` varchar(64) collate utf8_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL default NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `wx_casa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_casa` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(128) collate utf8_unicode_ci NOT NULL,
  `brief` varchar(128) collate utf8_unicode_ci NOT NULL,
  `phone` varchar(32) collate utf8_unicode_ci default NULL,
  `desc` text collate utf8_unicode_ci NOT NULL,
  `spec` text collate utf8_unicode_ci NOT NULL,
  `rule` text collate utf8_unicode_ci NOT NULL,
  `casa_id` bigint(20) default NULL,
  `area_id` bigint(20) default NULL,
  `attachment_id` bigint(20) default NULL,
  `score` double NOT NULL,
  `deleted_at` timestamp NULL default NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `wx_casa_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_casa_content` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `wx_casa_id` bigint(20) NOT NULL,
  `content_id` bigint(20) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=333 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `wx_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_order` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `order_id` varchar(64) collate utf8_unicode_ci NOT NULL,
  `wxpay_id` varchar(64) collate utf8_unicode_ci NOT NULL,
  `total` double NOT NULL,
  `status` smallint(6) NOT NULL default '0',
  `pay_status` smallint(6) NOT NULL default '0',
  `reserve_status` smallint(6) NOT NULL default '0',
  `consume_status` smallint(6) NOT NULL default '0',
  `deleted_at` timestamp NULL default NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  `wx_user_id` bigint(20) unsigned NOT NULL,
  `wx_casa_id` bigint(20) unsigned NOT NULL,
  `reserve_time` varchar(100) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `wx_order_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_order_item` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `price` double NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `wx_order_id` bigint(20) unsigned NOT NULL,
  `wx_room_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  KEY `wx_order_item_wx_order_id_foreign` (`wx_order_id`),
  KEY `wx_order_item_wx_room_id_foreign` (`wx_room_id`),
  CONSTRAINT `wx_order_item_wx_order_id_foreign` FOREIGN KEY (`wx_order_id`) REFERENCES `wx_order` (`id`),
  CONSTRAINT `wx_order_item_wx_room_id_foreign` FOREIGN KEY (`wx_room_id`) REFERENCES `wx_room` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `wx_room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_room` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `name` varchar(128) collate utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `wx_casa_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wx_room_content`
--

DROP TABLE IF EXISTS `wx_room_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_room_content` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `wx_room_id` bigint(20) unsigned NOT NULL,
  `content_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `wx_room_date`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_room_date` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `room_id` varchar(128) collate utf8_unicode_ci NOT NULL,
  `year` varchar(32) collate utf8_unicode_ci NOT NULL,
  `month` varchar(32) collate utf8_unicode_ci NOT NULL,
  `day` varchar(128) collate utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


DROP TABLE IF EXISTS `wx_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wx_user` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `openid` varchar(128) collate utf8_unicode_ci NOT NULL,
  `realname` varchar(64) collate utf8_unicode_ci NOT NULL,
  `nickname` varchar(64) collate utf8_unicode_ci NOT NULL,
  `cellphone` varchar(32) collate utf8_unicode_ci NOT NULL,
  `sex` smallint(6) NOT NULL default '0',
  `headimgurl` varchar(512) collate utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `wx_user_openid_unique` (`openid`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-17 11:19:13
