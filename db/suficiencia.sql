/*
Navicat MySQL Data Transfer

Source Server         : localhost @ root
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : suficiencia

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-03-23 02:15:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `activities`
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `location` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `activities_group_id` (`group_id`),
  CONSTRAINT `activities_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of activities
-- ----------------------------
INSERT INTO `activities` VALUES ('1', '1', 'activity 1', '2017-03-23 02:13:23', 'san jose', 0x61736466617366617366617366617366617366);
INSERT INTO `activities` VALUES ('2', '2', 'activity 2', '2017-03-23 02:13:36', 'cartago', 0x61646661736661736664);
INSERT INTO `activities` VALUES ('3', '3', 'activity 3', '2017-03-23 02:13:45', 'heredia', 0x61736466617366);

-- ----------------------------
-- Table structure for `content`
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `content` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of content
-- ----------------------------
INSERT INTO `content` VALUES ('1', 'name', 0x4F7267616E697A6163696F6E2073696E2066696E6573206465204C7563726F202D2050616C7069746F73);
INSERT INTO `content` VALUES ('2', 'organization', 0x6E756573747261206F7267616E697A6163696F6E20636F6E73746120646520656D706C6561646F7320646564696361646F732061206E756573747261206D6973696F6E);
INSERT INTO `content` VALUES ('3', 'mission', 0x616466616661);
INSERT INTO `content` VALUES ('4', 'vision', 0x6164666173666461666461666166);
INSERT INTO `content` VALUES ('5', 'values', 0x61646661736664617366617366);

-- ----------------------------
-- Table structure for `groups`
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `summary` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'grupo 1', 0x726573756D656E2064656C20677275706F2031);
INSERT INTO `groups` VALUES ('2', 'grupo 2', 0x726573756D656E2064656C20677275706F2032);
INSERT INTO `groups` VALUES ('3', 'grupo 3', 0x726573756D656E2064656C20677275706F2033);

-- ----------------------------
-- Table structure for `objectives`
-- ----------------------------
DROP TABLE IF EXISTS `objectives`;
CREATE TABLE `objectives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL,
  `content` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `objectives_group_id` (`group_id`),
  CONSTRAINT `objectives_group_id` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of objectives
-- ----------------------------
INSERT INTO `objectives` VALUES ('1', '1', 0x616C7364666A616C7364666C616C666B616A6C66616A6C73666C3B6173666C6B61666C61666C);
INSERT INTO `objectives` VALUES ('2', '1', 0x616C736466616C6A6661206A646C3B6A616C736A646673646C666A61736C64);
INSERT INTO `objectives` VALUES ('3', '2', 0x61646661666173666161666173);
INSERT INTO `objectives` VALUES ('4', '2', 0x616661736466616661736664617366);
INSERT INTO `objectives` VALUES ('5', '3', 0x61736466617366617364666173666461);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Procedure structure for `activitiesById`
-- ----------------------------
DROP PROCEDURE IF EXISTS `activitiesById`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `activitiesById`(IN `groupId` int)
BEGIN

	select * from activities a
	where a.group_id = `groupId`;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `content`
-- ----------------------------
DROP PROCEDURE IF EXISTS `content`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `content`(IN `key` varchar(32))
BEGIN

	select * from content c where c.`key` = `key` limit 1;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `groupById`
-- ----------------------------
DROP PROCEDURE IF EXISTS `groupById`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `groupById`(IN `groupId` int)
BEGIN

	select * from groups g
	where g.id = `groupId`;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `groups`
-- ----------------------------
DROP PROCEDURE IF EXISTS `groups`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `groups`()
BEGIN

	select * from groups g;

END
;;
DELIMITER ;

-- ----------------------------
-- Procedure structure for `objectivesById`
-- ----------------------------
DROP PROCEDURE IF EXISTS `objectivesById`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `objectivesById`(IN `groupId` int)
BEGIN

	select * from objectives o
	where o.group_id = `groupId`;

END
;;
DELIMITER ;
