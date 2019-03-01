/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:28:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bp_cart
-- ----------------------------
DROP TABLE IF EXISTS `bp_cart`;
CREATE TABLE `bp_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '用户id',
  `goods_id` int(10) unsigned DEFAULT NULL COMMENT '商品id',
  `goods_num` int(10) unsigned DEFAULT NULL COMMENT '商品数量',
  `unit_price` decimal(10,2) DEFAULT NULL COMMENT '商品单价',
  `total_price` decimal(10,2) DEFAULT NULL COMMENT '商品总价',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bp_cart
-- ----------------------------
