/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:29:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '回复id',
  `id` int(10) unsigned NOT NULL COMMENT '文章id',
  `comment_content` varchar(0) DEFAULT NULL COMMENT '回复内容',
  PRIMARY KEY (`comment_id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
