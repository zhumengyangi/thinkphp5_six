/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:28:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bp_nav
-- ----------------------------
DROP TABLE IF EXISTS `bp_nav`;
CREATE TABLE `bp_nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '' COMMENT '导航名称',
  `pid` int(10) unsigned DEFAULT '0' COMMENT '父类id',
  `url` varchar(60) DEFAULT '#' COMMENT 'url地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bp_nav
-- ----------------------------
INSERT INTO `bp_nav` VALUES ('1', '眼镜', '0', '#');
INSERT INTO `bp_nav` VALUES ('2', '镜框', '0', '#');
