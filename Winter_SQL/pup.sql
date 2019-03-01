/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:29:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pup
-- ----------------------------
DROP TABLE IF EXISTS `pup`;
CREATE TABLE `pup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '学号',
  `name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `age` int(255) DEFAULT NULL COMMENT '年龄',
  `sex` varchar(5) DEFAULT NULL COMMENT '性别',
  `address` varchar(255) DEFAULT NULL COMMENT '家庭住址',
  `phone` varchar(255) DEFAULT NULL COMMENT '联系电话信息',
  `education` varchar(255) DEFAULT NULL COMMENT '学历',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pup
-- ----------------------------
INSERT INTO `pup` VALUES ('1', '小明', '22', '男', '北京', '110', '大学');
INSERT INTO `pup` VALUES ('2', '小红', '25', '女', '河南', '120', '博士');
INSERT INTO `pup` VALUES ('3', '小王', '18', '男', '广州', '119', '高中');
