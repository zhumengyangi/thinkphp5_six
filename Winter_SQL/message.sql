/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:29:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id',
  `title` varchar(0) DEFAULT NULL COMMENT '文章标题',
  `content` text COMMENT '文章内容',
  `category_id` int(11) DEFAULT NULL COMMENT '文章分类id',
  `hits` int(11) DEFAULT NULL COMMENT '点击量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of message
-- ----------------------------
