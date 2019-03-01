/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:28:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bp_goods_img
-- ----------------------------
DROP TABLE IF EXISTS `bp_goods_img`;
CREATE TABLE `bp_goods_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_id` int(10) unsigned DEFAULT NULL COMMENT '商品id',
  `image_url` varchar(60) DEFAULT '' COMMENT '图片地址',
  `source_image_url` varchar(60) DEFAULT '' COMMENT '原图片地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bp_goods_img
-- ----------------------------
