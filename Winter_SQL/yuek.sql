/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:30:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for yuek
-- ----------------------------
DROP TABLE IF EXISTS `yuek`;
CREATE TABLE `yuek` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `username` char(30) DEFAULT NULL COMMENT '用户名',
  `password` char(32) DEFAULT NULL COMMENT '密码',
  `token` char(32) DEFAULT NULL COMMENT 'token值',
  `token_gq` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'token过期时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yuek
-- ----------------------------
INSERT INTO `yuek` VALUES ('1', '15737580246', '46f94c8de14fb36680850768ff1b7f2a', '02d6d2bd3a3111e9b44d80fa5b50a590', '2019-02-27 10:42:58');
INSERT INTO `yuek` VALUES ('2', '17600925166', '46f94c8de14fb36680850768ff1b7f2a', null, null);
