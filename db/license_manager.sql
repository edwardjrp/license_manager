/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 50515
 Source Host           : localhost
 Source Database       : license_manager

 Target Server Type    : MySQL
 Target Server Version : 50515
 File Encoding         : utf-8

 Date: 03/03/2017 13:40:25 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `alm_business_partners`
-- ----------------------------
DROP TABLE IF EXISTS `alm_business_partners`;
CREATE TABLE `alm_business_partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `partner` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxpartner` (`partner`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_businesspartner_createdon` BEFORE INSERT ON `alm_business_partners` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_city`
-- ----------------------------
DROP TABLE IF EXISTS `alm_city`;
CREATE TABLE `alm_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxcity` (`city`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_city_createdon` BEFORE INSERT ON `alm_city` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_competitor_products`
-- ----------------------------
DROP TABLE IF EXISTS `alm_competitor_products`;
CREATE TABLE `alm_competitor_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxproduct_name` (`product_name`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `trgalm_competitor_products_createdat` BEFORE INSERT ON `alm_competitor_products` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_customers`
-- ----------------------------
DROP TABLE IF EXISTS `alm_customers`;
CREATE TABLE `alm_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `name` varchar(300) NOT NULL,
  `shortname` varchar(200) DEFAULT NULL,
  `customertype_id` int(11) DEFAULT '0',
  `customerstatus_id` int(11) DEFAULT '0',
  `taxid` varchar(20) DEFAULT NULL,
  `budgetdate` date DEFAULT NULL,
  `businesspartner` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `city` int(11) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `website` varchar(500) DEFAULT NULL,
  `notes` text,
  `os_workstations` varchar(100) DEFAULT NULL,
  `os_workstations_hw` varchar(100) DEFAULT NULL,
  `os_servers` varchar(100) DEFAULT NULL,
  `os_servers_hw` varchar(100) DEFAULT NULL,
  `os_servers_qty` int(11) DEFAULT '0',
  `os_workstations_qty` int(11) DEFAULT '0',
  `servers_type` varchar(100) DEFAULT NULL,
  `mailservers` varchar(100) DEFAULT NULL,
  `proxyserver` varchar(100) DEFAULT NULL,
  `virtualization` varchar(100) DEFAULT NULL,
  `branches_qty` int(11) DEFAULT '0',
  `branches_bandwith` varchar(100) DEFAULT NULL,
  `branches_connectivity` varchar(100) DEFAULT NULL,
  `antivirus` varchar(100) DEFAULT NULL,
  `backupsystem` varchar(100) DEFAULT NULL,
  `firewalls` varchar(100) DEFAULT NULL,
  `isp` varchar(100) DEFAULT NULL,
  `isp_bandwidth` varchar(100) DEFAULT NULL,
  `email_protection` varchar(100) DEFAULT NULL,
  `content_filter` varchar(100) DEFAULT NULL,
  `mobility` varchar(100) DEFAULT NULL,
  `vurnerability` varchar(100) DEFAULT NULL,
  `database_security` varchar(100) DEFAULT NULL,
  `security_events` varchar(100) DEFAULT NULL,
  `network_monitor` varchar(100) DEFAULT NULL,
  `changecontrol` varchar(100) DEFAULT NULL,
  `encryption` varchar(100) DEFAULT NULL,
  `app_control` varchar(100) DEFAULT NULL,
  `datalostprevention` varchar(100) DEFAULT NULL,
  `networkips` varchar(100) DEFAULT NULL,
  `networkac` varchar(100) DEFAULT NULL,
  `wireless_security` varchar(100) DEFAULT NULL,
  `socialmedia_security` varchar(100) DEFAULT NULL,
  `networking` varchar(100) DEFAULT NULL,
  `databases` varchar(100) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  `assigned_to` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxname` (`name`),
  UNIQUE KEY `idxguid` (`guid`),
  UNIQUE KEY `idxtaxid` (`taxid`),
  KEY `idxemail` (`email`),
  KEY `phone` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=1926 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_customers_createdon` BEFORE INSERT ON `alm_customers` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_customers_contacts`
-- ----------------------------
DROP TABLE IF EXISTS `alm_customers_contacts`;
CREATE TABLE `alm_customers_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `contact` varchar(300) NOT NULL,
  `contact_dob` date DEFAULT NULL,
  `jobposition` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `extension` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `workemail` varchar(300) DEFAULT NULL,
  `personalemail` varchar(300) DEFAULT NULL,
  `maincontact` tinyint(4) NOT NULL DEFAULT '0',
  `preferred_color` varchar(100) DEFAULT NULL COMMENT 'Refers to table alm_customer_contacts_colors',
  `hobbies` varchar(100) DEFAULT NULL COMMENT 'Refers to table alm_customer_contacts_hobbies',
  `notify_holidays` varchar(100) DEFAULT NULL COMMENT 'Refers to table alm_customer_holidays',
  `twitter` varchar(100) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '0 = female, 1 = male',
  `allow_notifications` tinyint(4) DEFAULT '1' COMMENT '0 = off, 1 = on',
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxguid` (`guid`),
  KEY `idxcontact` (`contact`)
) ENGINE=MyISAM AUTO_INCREMENT=3795 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_cust_contacts_createdon` BEFORE INSERT ON `alm_customers_contacts` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_customers_contacts_colors`
-- ----------------------------
DROP TABLE IF EXISTS `alm_customers_contacts_colors`;
CREATE TABLE `alm_customers_contacts_colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `color` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxcolor` (`color`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_cust_contacts_color_createdat` BEFORE INSERT ON `alm_customers_contacts_colors` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_customers_contacts_hobbies`
-- ----------------------------
DROP TABLE IF EXISTS `alm_customers_contacts_hobbies`;
CREATE TABLE `alm_customers_contacts_hobbies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `hobbies` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxhobbies` (`hobbies`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_cust_contacts_hobbies_createdat` BEFORE INSERT ON `alm_customers_contacts_hobbies` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_customers_contacts_holidays`
-- ----------------------------
DROP TABLE IF EXISTS `alm_customers_contacts_holidays`;
CREATE TABLE `alm_customers_contacts_holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `holidays` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `message` text,
  `day_month` varchar(10) DEFAULT NULL COMMENT 'Represent day and month or weekday and month of holiday if apply',
  `day_position` tinyint(10) DEFAULT '0' COMMENT 'Position of weekday, 1st, 2nd, 3rd, 4th if apply',
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxholidays` (`holidays`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_cust_contacts_holidays_createdat` BEFORE INSERT ON `alm_customers_contacts_holidays` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_customers_contacts_subhobbies`
-- ----------------------------
DROP TABLE IF EXISTS `alm_customers_contacts_subhobbies`;
CREATE TABLE `alm_customers_contacts_subhobbies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `hobbie_id` int(11) NOT NULL,
  `subhobbi` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxsubhobbi` (`subhobbi`),
  UNIQUE KEY `idxguid` (`guid`),
  KEY `idxhubbie_id` (`hobbie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_customers_contacts_subhobbies_createdat` BEFORE INSERT ON `alm_customers_contacts_subhobbies` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_customers_contacts_subhobbies_details`
-- ----------------------------
DROP TABLE IF EXISTS `alm_customers_contacts_subhobbies_details`;
CREATE TABLE `alm_customers_contacts_subhobbies_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `contact_id` int(11) NOT NULL,
  `hobbie_id` int(11) NOT NULL,
  `subhobbies` varchar(100) DEFAULT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxguid` (`guid`),
  KEY `idxcontact_id` (`contact_id`),
  KEY `idxsubhobbie_id` (`hobbie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
--  Table structure for `alm_customers_status`
-- ----------------------------
DROP TABLE IF EXISTS `alm_customers_status`;
CREATE TABLE `alm_customers_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `customer_status` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxcustomer_status` (`customer_status`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_customers_status` BEFORE INSERT ON `alm_customers_status` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_customers_type`
-- ----------------------------
DROP TABLE IF EXISTS `alm_customers_type`;
CREATE TABLE `alm_customers_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `customer_type` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxcustomer_type` (`customer_type`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_customers_type_createdon` BEFORE INSERT ON `alm_customers_type` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_evaluation_options`
-- ----------------------------
DROP TABLE IF EXISTS `alm_evaluation_options`;
CREATE TABLE `alm_evaluation_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `type_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`type_id`),
  UNIQUE KEY `idxguid` (`guid`),
  KEY `idxevaluation_name` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_eval_options_createdon` BEFORE INSERT ON `alm_evaluation_options` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_evaluation_type`
-- ----------------------------
DROP TABLE IF EXISTS `alm_evaluation_type`;
CREATE TABLE `alm_evaluation_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxtype` (`type`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_eval_type_createdon` BEFORE INSERT ON `alm_evaluation_type` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_jobpositions`
-- ----------------------------
DROP TABLE IF EXISTS `alm_jobpositions`;
CREATE TABLE `alm_jobpositions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `jobposition` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxjobposicion` (`jobposition`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=1949 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_jobpositions_createdon` BEFORE INSERT ON `alm_jobpositions` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_license_files`
-- ----------------------------
DROP TABLE IF EXISTS `alm_license_files`;
CREATE TABLE `alm_license_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `id_license` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxfilename` (`filename`),
  UNIQUE KEY `idxguid` (`guid`),
  KEY `idxidlicense` (`id_license`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_license_files_createdon` BEFORE INSERT ON `alm_license_files` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_license_granttypes`
-- ----------------------------
DROP TABLE IF EXISTS `alm_license_granttypes`;
CREATE TABLE `alm_license_granttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `granttype_name` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxgranttype_name` (`granttype_name`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_license_granttypes_createdon` BEFORE INSERT ON `alm_license_granttypes` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_license_sector`
-- ----------------------------
DROP TABLE IF EXISTS `alm_license_sector`;
CREATE TABLE `alm_license_sector` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `sector_name` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxsector_name` (`sector_name`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_license_sector_createdon` BEFORE INSERT ON `alm_license_sector` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_license_status`
-- ----------------------------
DROP TABLE IF EXISTS `alm_license_status`;
CREATE TABLE `alm_license_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `status_name` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxstatus_name` (`status_name`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_license_status_createdon` BEFORE INSERT ON `alm_license_status` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_license_types`
-- ----------------------------
DROP TABLE IF EXISTS `alm_license_types`;
CREATE TABLE `alm_license_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `license_name` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxlicense_name` (`license_name`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_license_types_createdon` BEFORE INSERT ON `alm_license_types` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_licensed_by`
-- ----------------------------
DROP TABLE IF EXISTS `alm_licensed_by`;
CREATE TABLE `alm_licensed_by` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `licensedby_name` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxlicensedby_name` (`licensedby_name`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_licensed_by_createdon` BEFORE INSERT ON `alm_licensed_by` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_licensing`
-- ----------------------------
DROP TABLE IF EXISTS `alm_licensing`;
CREATE TABLE `alm_licensing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_suite` int(11) DEFAULT '0',
  `id_product_type` int(11) DEFAULT '0',
  `id_license_type` int(11) DEFAULT '0',
  `id_product_tag` int(11) DEFAULT '0',
  `id_licensed_by` int(11) DEFAULT '0',
  `id_license_sector` int(11) DEFAULT '0',
  `id_reseller` int(11) DEFAULT '0',
  `id_customer` int(11) NOT NULL,
  `id_license_status` int(11) DEFAULT '1',
  `id_product` int(11) DEFAULT '0',
  `id_license_granttype` int(11) DEFAULT '1',
  `guid` varchar(100) DEFAULT NULL,
  `nodes` int(11) DEFAULT '0',
  `licensed_amount` int(11) DEFAULT '0',
  `channel_sku` varchar(100) NOT NULL,
  `msrp_price` decimal(15,4) DEFAULT '0.0000',
  `grant_number` varchar(100) DEFAULT NULL,
  `expedition_date` date DEFAULT NULL,
  `expiration_date` date DEFAULT NULL,
  `registered_date` date DEFAULT NULL COMMENT 'Registered on merchant website',
  `serial_number` varchar(100) DEFAULT NULL,
  `currency` varchar(10) DEFAULT 'USD',
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  `isarchived` tinyint(4) DEFAULT '0',
  `expired_license_guid` varchar(100) DEFAULT NULL COMMENT 'Expire license guid when a renewal took place, keeps track of which license was renewed',
  `parent_license_guid` varchar(100) DEFAULT NULL COMMENT 'Parent perpetual license guid for support licenses',
  `renew_businesspartner_id` int(11) DEFAULT '0' COMMENT 'Business partner competitor client renewed license with.',
  `renew_businesspartner_date` date DEFAULT NULL COMMENT 'Estimated date of renew with partner',
  `competitor_product_id` int(11) DEFAULT '0',
  `competitor_date` date DEFAULT NULL COMMENT 'Notify before expire date',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxguid` (`guid`),
  KEY `idxid_customer` (`id_customer`),
  KEY `idxserial_number` (`serial_number`),
  KEY `idxgrant_number` (`grant_number`),
  KEY `idxchannel_sku` (`channel_sku`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_licensing_createdon` BEFORE INSERT ON `alm_licensing` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_product_groups`
-- ----------------------------
DROP TABLE IF EXISTS `alm_product_groups`;
CREATE TABLE `alm_product_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `group_name` varchar(200) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxgroup_name` (`group_name`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_product_groups_createdon` BEFORE INSERT ON `alm_product_groups` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_product_manufaturer_status`
-- ----------------------------
DROP TABLE IF EXISTS `alm_product_manufaturer_status`;
CREATE TABLE `alm_product_manufaturer_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `manufacturer_status` varchar(200) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxmanufacturer_status` (`manufacturer_status`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_product_manufaturer_status_createdon` BEFORE INSERT ON `alm_product_manufaturer_status` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_product_manufaturers`
-- ----------------------------
DROP TABLE IF EXISTS `alm_product_manufaturers`;
CREATE TABLE `alm_product_manufaturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(200) NOT NULL,
  `id_status` int(11) DEFAULT '1',
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxmanufacturer` (`manufacturer`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_product_manufacturers_createdon` BEFORE INSERT ON `alm_product_manufaturers` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_product_offerings`
-- ----------------------------
DROP TABLE IF EXISTS `alm_product_offerings`;
CREATE TABLE `alm_product_offerings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `offer_name` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxoffer_name` (`offer_name`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_product_offerings_createdon` BEFORE INSERT ON `alm_product_offerings` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_product_pricing_tier`
-- ----------------------------
DROP TABLE IF EXISTS `alm_product_pricing_tier`;
CREATE TABLE `alm_product_pricing_tier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `pricingtier_name` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxpricingtier_name` (`pricingtier_name`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_product_pricing_tier_createdon` BEFORE INSERT ON `alm_product_pricing_tier` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_product_suites`
-- ----------------------------
DROP TABLE IF EXISTS `alm_product_suites`;
CREATE TABLE `alm_product_suites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `id_manufacturer` int(11) NOT NULL DEFAULT '0',
  `id_group` int(11) DEFAULT '0',
  `id_suite_status` int(11) DEFAULT '1',
  `suite_name` varchar(200) DEFAULT NULL,
  `suite_code` varchar(100) DEFAULT NULL,
  `suite_description` varchar(500) DEFAULT NULL,
  `suite_long_description` text,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  `legacy_expire_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxguid` (`guid`),
  UNIQUE KEY `idxsuite` (`id_manufacturer`,`suite_code`),
  KEY `idxsuite_name` (`suite_name`),
  KEY `idxsuite_code` (`suite_code`),
  KEY `idxid_group` (`id_group`)
) ENGINE=MyISAM AUTO_INCREMENT=554 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_product_suites_createdon` BEFORE INSERT ON `alm_product_suites` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_product_suites_status`
-- ----------------------------
DROP TABLE IF EXISTS `alm_product_suites_status`;
CREATE TABLE `alm_product_suites_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `status_name` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxstatus_name` (`status_name`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_product_suites_status_createdon` BEFORE INSERT ON `alm_product_suites_status` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_product_tags`
-- ----------------------------
DROP TABLE IF EXISTS `alm_product_tags`;
CREATE TABLE `alm_product_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `tag_name` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxtag_name` (`tag_name`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_product_tags_createdon` BEFORE INSERT ON `alm_product_tags` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_product_types`
-- ----------------------------
DROP TABLE IF EXISTS `alm_product_types`;
CREATE TABLE `alm_product_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `type_name` varchar(100) NOT NULL,
  `icon_name` varchar(100) DEFAULT 'software32.png',
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxtype_name` (`type_name`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_product_types_createdon` BEFORE INSERT ON `alm_product_types` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_products`
-- ----------------------------
DROP TABLE IF EXISTS `alm_products`;
CREATE TABLE `alm_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_suite` int(11) DEFAULT '0',
  `id_offering` int(11) DEFAULT '1',
  `id_pricing_tier` varchar(20) DEFAULT '1',
  `id_product_type` int(11) DEFAULT '0',
  `id_license_type` int(11) DEFAULT '0',
  `id_product_tag` int(11) DEFAULT '0',
  `id_licensed_by` int(11) DEFAULT '0',
  `id_license_sector` int(11) DEFAULT '0' COMMENT 'Use customer type table as auxiliary',
  `id_license_granttype` int(11) DEFAULT '1',
  `guid` varchar(100) DEFAULT NULL,
  `description` varchar(500) NOT NULL,
  `short_description` varchar(200) DEFAULT NULL,
  `product_content` text,
  `band` varchar(10) DEFAULT 'A',
  `range_min` int(11) DEFAULT '1',
  `range_max` int(11) DEFAULT '0',
  `licensed_amount` int(11) DEFAULT '0',
  `manufacturer_partno` varchar(50) DEFAULT NULL,
  `channel_sku` varchar(100) NOT NULL,
  `msrp_price` decimal(15,4) DEFAULT '0.0000',
  `assurance` tinyint(1) DEFAULT '1',
  `packaged_weight` varchar(100) DEFAULT NULL,
  `packaged_size` varchar(100) DEFAULT NULL,
  `tiered_pric` tinyint(1) DEFAULT '1',
  `reseller_authorization` tinyint(1) DEFAULT '0',
  `tier1_authorization` tinyint(1) DEFAULT '0',
  `reorder` tinyint(1) DEFAULT '1',
  `export_restriction` tinyint(1) DEFAULT '0',
  `fcs_date` date DEFAULT NULL,
  `eos_date` date DEFAULT NULL,
  `commission_group_description` varchar(100) DEFAULT NULL,
  `barcode_ean_upc` varchar(100) DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `currency` varchar(10) DEFAULT 'USD',
  `price_list_description` varchar(500) DEFAULT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime DEFAULT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxchannel_sku` (`channel_sku`),
  UNIQUE KEY `idxguid` (`guid`),
  KEY `idxid_pricing_tier` (`id_pricing_tier`),
  KEY `idxid_suite` (`id_suite`),
  KEY `idxbarcode_ean_upc` (`barcode_ean_upc`),
  KEY `idxid_offering` (`id_offering`)
) ENGINE=MyISAM AUTO_INCREMENT=10511 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_products_createdon` BEFORE INSERT ON `alm_products` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_resellers`
-- ----------------------------
DROP TABLE IF EXISTS `alm_resellers`;
CREATE TABLE `alm_resellers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `reseller_name` varchar(100) NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `contact_mobile` varchar(20) DEFAULT NULL,
  `contact_email` varchar(200) DEFAULT NULL,
  `icon_name` varchar(100) DEFAULT NULL,
  `css_color` varchar(100) DEFAULT NULL,
  `deleted` int(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxreseller_name` (`reseller_name`),
  UNIQUE KEY `idxguid` (`guid`),
  KEY `idxcontact` (`contact`),
  KEY `idxcontactphone` (`contact_phone`),
  KEY `idxcontactmobile` (`contact_mobile`),
  KEY `idxcontactemail` (`contact_email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_resellers_createdon` BEFORE INSERT ON `alm_resellers` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_users`
-- ----------------------------
DROP TABLE IF EXISTS `alm_users`;
CREATE TABLE `alm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `group_id` smallint(11) NOT NULL DEFAULT '0',
  `fullname` varchar(100) DEFAULT NULL,
  `jobposition` varchar(100) DEFAULT NULL,
  `personal_id` varchar(100) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `photo` varchar(300) DEFAULT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_userid` int(11) DEFAULT NULL,
  `created_userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxusername` (`username`),
  UNIQUE KEY `idxguid` (`guid`),
  KEY `idxemail` (`email`),
  KEY `idxfullname` (`fullname`),
  KEY `idxpersonalid` (`personal_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_users_createdon` BEFORE INSERT ON `alm_users` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `alm_users_groups`
-- ----------------------------
DROP TABLE IF EXISTS `alm_users_groups`;
CREATE TABLE `alm_users_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `group_name` varchar(100) NOT NULL,
  `group_id` smallint(11) DEFAULT '0',
  `icon_name` varchar(100) DEFAULT NULL,
  `deleted` smallint(11) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxguid` (`guid`),
  KEY `idxgroupid` (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bialm_users_groups` BEFORE INSERT ON `alm_users_groups` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `mcafee_pricelist`
-- ----------------------------
DROP TABLE IF EXISTS `mcafee_pricelist`;
CREATE TABLE `mcafee_pricelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `layer1` varchar(500) NOT NULL,
  `layer2` varchar(500) NOT NULL,
  `layer3_stub` varchar(500) NOT NULL,
  `layer3_stub_description` varchar(500) NOT NULL,
  `layer4` varchar(500) NOT NULL,
  `layer5` varchar(500) NOT NULL,
  `band` varchar(255) NOT NULL,
  `min` varchar(255) NOT NULL,
  `max` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `mcafee_partno` varchar(255) NOT NULL,
  `channel_sku` varchar(255) NOT NULL,
  `msrp_list_price` double NOT NULL,
  `assurance` varchar(255) NOT NULL,
  `packaged_weight` varchar(255) NOT NULL,
  `packaged_size` varchar(255) NOT NULL,
  `tiered_pric` varchar(255) NOT NULL,
  `pricing_tier` varchar(255) NOT NULL,
  `reseller_authorization` varchar(255) NOT NULL,
  `tier1_authorization` varchar(255) NOT NULL,
  `reorder` varchar(255) NOT NULL,
  `export_restriction` varchar(255) NOT NULL,
  `fcs_date` date NOT NULL,
  `eos_date` date NOT NULL,
  `commission_group_description` varchar(500) NOT NULL,
  `ean_upc` varchar(255) NOT NULL,
  `effective_date` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `price_list_description` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10495 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `options`
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` varchar(100) DEFAULT NULL,
  `variable` varchar(100) NOT NULL,
  `value` varchar(2000) DEFAULT NULL,
  `style` varchar(100) DEFAULT 'icon-gear blue',
  `deleted` smallint(6) DEFAULT '0',
  `datecreated` datetime NOT NULL,
  `dateupdated` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `modified_iduser` int(11) DEFAULT NULL,
  `created_iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idxvariable` (`variable`),
  UNIQUE KEY `idxguid` (`guid`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
delimiter ;;
CREATE TRIGGER `bioptions` BEFORE INSERT ON `options` FOR EACH ROW begin
	set new.datecreated = CURRENT_TIMESTAMP();
end;
 ;;
delimiter ;

-- ----------------------------
--  Table structure for `tmp_contacts`
-- ----------------------------
DROP TABLE IF EXISTS `tmp_contacts`;
CREATE TABLE `tmp_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `business_street` varchar(255) NOT NULL,
  `business_city` varchar(255) NOT NULL,
  `business_state` varchar(255) NOT NULL,
  `business_postal_code` varchar(255) NOT NULL,
  `assistants_phone` varchar(255) NOT NULL,
  `business_fax` varchar(255) NOT NULL,
  `business_phone` varchar(255) NOT NULL,
  `business_phone_2` varchar(255) NOT NULL,
  `home_phone` varchar(255) NOT NULL,
  `home_phone_2` varchar(255) NOT NULL,
  `mobile_phone` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `email_2_address` varchar(255) NOT NULL,
  `email_3_address` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `web_page` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1194 DEFAULT CHARSET=utf8;

-- ----------------------------
--  View structure for `v_alm_licenses`
-- ----------------------------
DROP VIEW IF EXISTS `v_alm_licenses`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_alm_licenses` AS select `alm_licensing`.`id` AS `id`,`alm_licensing`.`id_suite` AS `id_suite`,`alm_product_suites`.`id_manufacturer` AS `id_manufacturer`,`alm_product_suites`.`suite_code` AS `suite_code`,`alm_product_suites`.`suite_description` AS `suite_description`,`alm_licensing`.`id_product_type` AS `id_product_type`,`alm_product_types`.`type_name` AS `type_name`,`alm_product_types`.`icon_name` AS `type_icon_name`,`alm_licensing`.`id_license_type` AS `id_license_type`,`alm_license_types`.`license_name` AS `license_name`,`alm_licensing`.`id_product_tag` AS `id_product_tag`,`alm_licensing`.`id_licensed_by` AS `id_licensed_by`,`alm_licensed_by`.`licensedby_name` AS `licensedby_name`,`alm_licensing`.`id_license_sector` AS `id_license_sector`,`alm_license_sector`.`sector_name` AS `sector_name`,`alm_licensing`.`id_reseller` AS `id_reseller`,`alm_resellers`.`reseller_name` AS `reseller_name`,`alm_licensing`.`id_customer` AS `id_customer`,`alm_licensing`.`id_product` AS `id_product`,`alm_licensing`.`id_license_granttype` AS `id_license_granttype`,`alm_license_granttypes`.`granttype_name` AS `granttype_name`,`alm_products`.`description` AS `description`,`alm_products`.`short_description` AS `short_description`,`alm_licensing`.`guid` AS `guid`,`alm_licensing`.`nodes` AS `nodes`,`alm_licensing`.`licensed_amount` AS `licensed_amount`,`alm_licensing`.`channel_sku` AS `channel_sku`,`alm_licensing`.`msrp_price` AS `msrp_price`,`alm_licensing`.`grant_number` AS `grant_number`,`alm_licensing`.`expedition_date` AS `expedition_date`,`alm_licensing`.`expiration_date` AS `expiration_date`,`alm_licensing`.`registered_date` AS `registered_date`,`alm_licensing`.`serial_number` AS `serial_number`,`alm_licensing`.`icon_name` AS `icon_name`,`alm_licensing`.`css_color` AS `css_color`,`alm_licensing`.`dateupdated` AS `dateupdated`,`alm_licensing`.`id_license_status` AS `id_license_status`,`alm_license_status`.`status_name` AS `license_status_name`,`alm_license_status`.`css_color` AS `alm_license_status_css_color`,`alm_licensing`.`isarchived` AS `isarchived`,`alm_licensing`.`expired_license_guid` AS `expired_license_guid`,`alm_licensing`.`parent_license_guid` AS `parent_license_guid`,`alm_licensing`.`renew_businesspartner_id` AS `renew_businesspartner_id`,`alm_business_partners`.`partner` AS `renew_businesspartner`,`alm_licensing`.`renew_businesspartner_date` AS `renew_businesspartner_date`,`alm_licensing`.`competitor_product_id` AS `competitor_product_id`,`alm_competitor_products`.`product_name` AS `competitor_product_name`,`alm_licensing`.`competitor_date` AS `competitor_date` from (((((((((((`alm_licensing` left join `alm_product_suites` on((`alm_licensing`.`id_suite` = `alm_product_suites`.`id`))) left join `alm_license_types` on((`alm_licensing`.`id_license_type` = `alm_license_types`.`id`))) left join `alm_licensed_by` on((`alm_licensing`.`id_licensed_by` = `alm_licensed_by`.`id`))) left join `alm_license_sector` on((`alm_licensing`.`id_license_sector` = `alm_license_sector`.`id`))) left join `alm_resellers` on((`alm_licensing`.`id_reseller` = `alm_resellers`.`id`))) left join `alm_products` on((`alm_licensing`.`id_product` = `alm_products`.`id`))) left join `alm_product_types` on((`alm_licensing`.`id_product_type` = `alm_product_types`.`id`))) left join `alm_license_granttypes` on((`alm_licensing`.`id_license_granttype` = `alm_license_granttypes`.`id`))) left join `alm_license_status` on((`alm_licensing`.`id_license_status` = `alm_license_status`.`id`))) left join `alm_business_partners` on((`alm_licensing`.`renew_businesspartner_id` = `alm_business_partners`.`id`))) left join `alm_competitor_products` on((`alm_licensing`.`competitor_product_id` = `alm_competitor_products`.`id`)));

-- ----------------------------
--  View structure for `v_alm_product_suites`
-- ----------------------------
DROP VIEW IF EXISTS `v_alm_product_suites`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_alm_product_suites` AS select `alm_product_suites`.`id` AS `id`,`alm_product_suites`.`guid` AS `guid`,`alm_product_suites`.`id_manufacturer` AS `id_manufacturer`,`alm_product_manufaturers`.`manufacturer` AS `manufacturer`,`alm_product_suites`.`suite_name` AS `suite_name`,`alm_product_suites`.`suite_code` AS `suite_code`,`alm_product_suites`.`suite_description` AS `suite_description`,`alm_product_suites`.`suite_long_description` AS `suite_long_description`,`alm_product_suites`.`dateupdated` AS `dateupdated`,`alm_product_suites`.`datecreated` AS `datecreated`,`alm_product_suites`.`modified_iduser` AS `modified_iduser`,`alm_product_suites`.`created_iduser` AS `created_iduser`,`alm_product_suites`.`id_suite_status` AS `id_suite_status`,`alm_product_suites_status`.`status_name` AS `suite_status_name`,`alm_product_suites_status`.`css_color` AS `suites_status_css_color`,`alm_product_suites`.`legacy_expire_date` AS `legacy_expire_date` from ((`alm_product_suites` left join `alm_product_manufaturers` on((`alm_product_suites`.`id_manufacturer` = `alm_product_manufaturers`.`id`))) left join `alm_product_suites_status` on((`alm_product_suites`.`id_suite_status` = `alm_product_suites_status`.`id`)));

-- ----------------------------
--  View structure for `v_alm_products`
-- ----------------------------
DROP VIEW IF EXISTS `v_alm_products`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`127.0.0.1` SQL SECURITY DEFINER VIEW `v_alm_products` AS select `alm_products`.`id` AS `id`,`alm_products`.`id_suite` AS `id_suite`,`alm_product_suites`.`id_suite_status` AS `id_suite_status`,`alm_product_suites`.`id_manufacturer` AS `id_manufacturer`,`alm_product_manufaturers`.`manufacturer` AS `manufacturer`,`alm_product_suites`.`suite_name` AS `suite_name`,`alm_product_suites`.`suite_code` AS `suite_code`,`alm_product_suites`.`suite_description` AS `suite_description`,`alm_products`.`id_product_type` AS `id_product_type`,`alm_product_types`.`type_name` AS `type_name`,`alm_product_types`.`icon_name` AS `product_type_icon_name`,`alm_products`.`id_license_type` AS `id_license_type`,`alm_license_types`.`license_name` AS `license_name`,`alm_products`.`id_product_tag` AS `id_product_tag`,`alm_product_tags`.`tag_name` AS `tag_name`,`alm_product_tags`.`icon_name` AS `icon_name`,`alm_products`.`id_licensed_by` AS `id_licensed_by`,`alm_licensed_by`.`licensedby_name` AS `licensedby_name`,`alm_licensed_by`.`icon_name` AS `licensedby_icon_name`,`alm_products`.`id_license_sector` AS `id_license_sector`,`alm_license_sector`.`sector_name` AS `sector_name`,`alm_license_sector`.`icon_name` AS `alm_license_sector_icon_name`,`alm_products`.`id_license_granttype` AS `id_license_granttype`,`alm_license_granttypes`.`granttype_name` AS `granttype_name`,`alm_products`.`guid` AS `guid`,`alm_products`.`description` AS `description`,`alm_products`.`short_description` AS `short_description`,`alm_products`.`product_content` AS `product_content`,`alm_products`.`band` AS `band`,`alm_products`.`range_min` AS `range_min`,`alm_products`.`range_max` AS `range_max`,`alm_products`.`licensed_amount` AS `licensed_amount`,`alm_products`.`manufacturer_partno` AS `manufacturer_partno`,`alm_products`.`channel_sku` AS `channel_sku`,`alm_products`.`msrp_price` AS `msrp_price`,`alm_products`.`assurance` AS `assurance`,`alm_products`.`packaged_weight` AS `packaged_weight`,`alm_products`.`packaged_size` AS `packaged_size`,`alm_products`.`tiered_pric` AS `tiered_pric`,`alm_products`.`reseller_authorization` AS `reseller_authorization`,`alm_products`.`tier1_authorization` AS `tier1_authorization`,`alm_products`.`reorder` AS `reorder`,`alm_products`.`export_restriction` AS `export_restriction`,`alm_products`.`fcs_date` AS `fcs_date`,`alm_products`.`eos_date` AS `eos_date`,`alm_products`.`commission_group_description` AS `commission_group_description`,`alm_products`.`barcode_ean_upc` AS `barcode_ean_upc`,`alm_products`.`effective_date` AS `effective_date`,`alm_products`.`currency` AS `currency`,`alm_product_suites_status`.`status_name` AS `suite_status_name`,`alm_product_suites_status`.`css_color` AS `suite_status_css_color` from (((((((((`alm_products` left join `alm_product_suites` on((`alm_products`.`id_suite` = `alm_product_suites`.`id`))) left join `alm_product_suites_status` on((`alm_product_suites`.`id_suite_status` = `alm_product_suites_status`.`id`))) left join `alm_product_manufaturers` on((`alm_product_suites`.`id_manufacturer` = `alm_product_manufaturers`.`id`))) left join `alm_product_types` on((`alm_products`.`id_product_type` = `alm_product_types`.`id`))) left join `alm_license_types` on((`alm_products`.`id_license_type` = `alm_license_types`.`id`))) left join `alm_product_tags` on((`alm_products`.`id_product_tag` = `alm_product_tags`.`id`))) left join `alm_licensed_by` on((`alm_products`.`id_licensed_by` = `alm_licensed_by`.`id`))) left join `alm_license_sector` on((`alm_products`.`id_license_sector` = `alm_license_sector`.`id`))) left join `alm_license_granttypes` on((`alm_products`.`id_license_granttype` = `alm_license_granttypes`.`id`)));

