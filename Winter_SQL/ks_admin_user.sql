/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:29:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ks_admin_user
-- ----------------------------
DROP TABLE IF EXISTS `ks_admin_user`;
CREATE TABLE `ks_admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(30) DEFAULT '' COMMENT '用户名',
  `password` char(32) DEFAULT '' COMMENT '密码',
  `token` char(32) DEFAULT '' COMMENT 'token校验',
  `expired_at` timestamp NULL DEFAULT NULL COMMENT 'tokne过期时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ks_admin_user
-- ----------------------------
INSERT INTO `ks_admin_user` VALUES ('1', '15737580246', '46f94c8de14fb36680850768ff1b7f2a', '185402ad39a611e995b580fa5b50a590', '2019-02-26 18:08:34');
