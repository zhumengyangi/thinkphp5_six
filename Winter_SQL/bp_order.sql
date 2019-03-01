/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:29:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bp_order
-- ----------------------------
DROP TABLE IF EXISTS `bp_order`;
CREATE TABLE `bp_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` char(32) DEFAULT NULL COMMENT '订单号32位',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT '用户id',
  `link_user` char(20) DEFAULT NULL COMMENT '联系人姓名',
  `link_phone` char(12) DEFAULT NULL COMMENT '联系人手机号',
  `address` varchar(150) DEFAULT NULL COMMENT '收货人地址',
  `esm_code` int(10) DEFAULT NULL COMMENT '邮编',
  `shipping_type` enum('1','2') DEFAULT '1' COMMENT '货运方式',
  `pay_type` enum('1','2') DEFAULT '1' COMMENT '支付方式',
  `goods_amount` decimal(10,2) DEFAULT '0.00' COMMENT '商品总额',
  `order_fee` decimal(10,2) DEFAULT '0.00' COMMENT '订单费用',
  `order_amount` decimal(10,2) DEFAULT '0.00' COMMENT '订单总额',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_no` (`order_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bp_order
-- ----------------------------
