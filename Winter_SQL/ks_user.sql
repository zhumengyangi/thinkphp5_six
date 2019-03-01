/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:29:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ks_user
-- ----------------------------
DROP TABLE IF EXISTS `ks_user`;
CREATE TABLE `ks_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(30) DEFAULT '' COMMENT '用户名',
  `password` char(32) DEFAULT '' COMMENT '密码',
  `realname` char(40) DEFAULT '' COMMENT '用户真实名字',
  `sex` enum('男','女','未知') DEFAULT '男' COMMENT '用户性别',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ks_user
-- ----------------------------
INSERT INTO `ks_user` VALUES ('3', '123132', '', '', '男');
INSERT INTO `ks_user` VALUES ('4', '123123', '', '', '男');
INSERT INTO `ks_user` VALUES ('5', '恶趣味群翁群翁群企鹅', '', '', '男');
INSERT INTO `ks_user` VALUES ('6', '请问', '', '', '男');
INSERT INTO `ks_user` VALUES ('7', '请问', '', '', '男');
INSERT INTO `ks_user` VALUES ('8', '为', '', '', '男');
INSERT INTO `ks_user` VALUES ('9', '请问请问请问', '', '', '男');
