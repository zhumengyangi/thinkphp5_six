/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:29:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for train
-- ----------------------------
DROP TABLE IF EXISTS `train`;
CREATE TABLE `train` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `cheic` varchar(255) DEFAULT NULL COMMENT '车次',
  `zhanming` varchar(255) DEFAULT NULL COMMENT '站名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of train
-- ----------------------------
INSERT INTO `train` VALUES ('1', 'K106', '广州');
INSERT INTO `train` VALUES ('2', 'K107', '深圳');
INSERT INTO `train` VALUES ('3', 'K106', '厦门');
INSERT INTO `train` VALUES ('4', 'K107', '南京');
INSERT INTO `train` VALUES ('5', 'K108', '杭州');
INSERT INTO `train` VALUES ('6', 'K108', '南京');
INSERT INTO `train` VALUES ('7', 'K109', '济南');
INSERT INTO `train` VALUES ('8', 'K109', '郑州');
INSERT INTO `train` VALUES ('9', 'K1086', '北京');
INSERT INTO `train` VALUES ('10', 'K1068', '天津');
INSERT INTO `train` VALUES ('11', 'K1068', '北京');
