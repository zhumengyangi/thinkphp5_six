/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:28:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bp_ad
-- ----------------------------
DROP TABLE IF EXISTS `bp_ad`;
CREATE TABLE `bp_ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '' COMMENT '广告名称',
  `cate_id` enum('1','2','3','4') DEFAULT NULL COMMENT '广告位置 1 首页banner 2 首页其他',
  `image_url` varchar(60) DEFAULT '' COMMENT '图片地址',
  `url` varchar(60) DEFAULT '#' COMMENT 'url地址',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bp_ad
-- ----------------------------
