/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50718
Source Host           : localhost:3306
Source Database       : ipaddrlist

Target Server Type    : MYSQL
Target Server Version : 50718
File Encoding         : 65001

Date: 2017-07-25 13:38:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ipinfo`
-- ----------------------------
DROP TABLE IF EXISTS `ipinfo`;
CREATE TABLE `ipinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `urlname` varchar(50) NOT NULL,
  `jmpurl` varchar(300) DEFAULT '',
  `randid` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `png` varchar(250) NOT NULL,
  `content` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ipinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `iplist`
-- ----------------------------
DROP TABLE IF EXISTS `iplist`;
CREATE TABLE `iplist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `ipinfo_id` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `pos` varchar(50) DEFAULT NULL,
  `addr` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of iplist
-- ----------------------------

-- ----------------------------
-- Table structure for `ipuser`
-- ----------------------------
DROP TABLE IF EXISTS `ipuser`;
CREATE TABLE `ipuser` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ipuser
-- ----------------------------
INSERT INTO `ipuser` VALUES ('1', 'daolang', '0c5c6be6038c3d7b9d43b102920e5985');