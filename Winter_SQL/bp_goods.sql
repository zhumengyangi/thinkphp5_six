/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:28:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bp_goods
-- ----------------------------
DROP TABLE IF EXISTS `bp_goods`;
CREATE TABLE `bp_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(60) DEFAULT '' COMMENT '商品名称',
  `goods_image` varchar(150) DEFAULT NULL COMMENT '图片',
  `cate_id` int(10) DEFAULT '0' COMMENT '商品分类id',
  `type` char(20) DEFAULT '0' COMMENT '型号',
  `tags` tinyint(4) DEFAULT '0' COMMENT '商品标签',
  `store_num` int(10) DEFAULT '0' COMMENT '商品库存',
  `score` int(10) DEFAULT '0' COMMENT '奖励积分',
  `shop_price` decimal(10,2) DEFAULT '0.00' COMMENT '市场价格',
  `market_price` decimal(10,2) DEFAULT '0.00' COMMENT '本店价格',
  `level` tinyint(4) DEFAULT '1' COMMENT '商品热度星星',
  `goods_desc` text COMMENT '商品描述',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bp_goods
-- ----------------------------
INSERT INTO `bp_goods` VALUES ('1', '时尚大眼镜', '/static/images/media1.png', '0', '1', '0', '100', '3', '10000.00', '6000.00', '1', null, '2019-02-18 16:40:42', '2019-02-18 16:40:42');
INSERT INTO `bp_goods` VALUES ('2', '时尚大眼镜', '/static/images/media1.png', '0', '1', '0', '100', '3', '10000.00', '6000.00', '1', null, '2019-02-18 16:40:42', '2019-02-18 16:40:42');
INSERT INTO `bp_goods` VALUES ('3', '时尚大眼镜', '/static/images/media1.png', '0', '1', '0', '100', '3', '10000.00', '6000.00', '1', null, '2019-02-18 16:40:42', '2019-02-18 16:40:42');
INSERT INTO `bp_goods` VALUES ('4', '时尚大眼镜', '/static/images/media1.png', '0', '1', '0', '100', '3', '10000.00', '6000.00', '1', null, '2019-02-18 16:40:42', '2019-02-18 16:40:42');
INSERT INTO `bp_goods` VALUES ('5', '时尚大眼镜', '/static/images/media1.png', '0', '1', '0', '100', '3', '10000.00', '6000.00', '1', null, '2019-02-18 16:40:42', '2019-02-18 16:40:42');
INSERT INTO `bp_goods` VALUES ('6', '时尚大眼镜', '/static/images/media1.png', '0', '1', '0', '100', '3', '10000.00', '6000.00', '1', null, '2019-02-18 16:40:42', '2019-02-18 16:40:42');
