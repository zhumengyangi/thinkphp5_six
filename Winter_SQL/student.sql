/*
Navicat MySQL Data Transfer

Source Server         : zmy
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : winter

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2019-03-01 11:29:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `stu_num` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('10001', '张三', '语文', '100');
INSERT INTO `student` VALUES ('10001', '张三', '数学', '70');
INSERT INTO `student` VALUES ('10001', '张三', '英语', '90');
INSERT INTO `student` VALUES ('10002', '李四', '语文', '95');
INSERT INTO `student` VALUES ('10002', '李四', '数学', '80');
INSERT INTO `student` VALUES ('10002', '李四', '英语', '90');
INSERT INTO `student` VALUES ('10003', '王五', '语文', '80');
INSERT INTO `student` VALUES ('10003', '王五', '数学', '65');
INSERT INTO `student` VALUES ('10003', '王五', '英语', '70');
