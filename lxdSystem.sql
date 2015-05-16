/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50621
 Source Host           : localhost
 Source Database       : lxdSystem

 Target Server Type    : MySQL
 Target Server Version : 50621
 File Encoding         : utf-8

 Date: 05/16/2015 17:23:08 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `t_department`
-- ----------------------------
DROP TABLE IF EXISTS `t_department`;
CREATE TABLE `t_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_no` varchar(255) DEFAULT NULL COMMENT '部门编号',
  `dept_name` varchar(255) DEFAULT NULL COMMENT '部门名称',
  `pid` int(11) DEFAULT NULL COMMENT '父部门编号',
  `dept_desc` varchar(255) DEFAULT NULL COMMENT '部门描述',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_order`
-- ----------------------------
DROP TABLE IF EXISTS `t_order`;
CREATE TABLE `t_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(32) NOT NULL COMMENT '订单编号',
  `order_name` varchar(255) NOT NULL COMMENT '订单名称',
  `order_desc` varchar(255) DEFAULT NULL COMMENT '订单描述',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `order_num` int(11) NOT NULL DEFAULT '1' COMMENT '订单预估数量',
  `order_jiafang` varchar(255) NOT NULL COMMENT '订单生产委托商',
  `order_start_date` date NOT NULL COMMENT '订单生产预估开始时间',
  `order_ent_date` date DEFAULT NULL COMMENT '订单预估结束时间',
  `order_amount` float(12,2) NOT NULL COMMENT '订单总金额',
  `order_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '订单状太 1为进行中，0为完成结束，',
  `order_isdel` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除 0为未删除 1为删除',
  `order_curr_amount` float(12,2) DEFAULT '0.00' COMMENT '该订单当前花费成本',
  `order_mate_amount` float(12,2) NOT NULL DEFAULT '0.00' COMMENT '当前订单预估成本金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_order_process`
-- ----------------------------
DROP TABLE IF EXISTS `t_order_process`;
CREATE TABLE `t_order_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单id ',
  `process_id` int(11) NOT NULL COMMENT '工序id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_process`
-- ----------------------------
DROP TABLE IF EXISTS `t_process`;
CREATE TABLE `t_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_name` varchar(255) NOT NULL COMMENT '工序名称',
  `process_price` float(10,2) NOT NULL COMMENT '工序价格',
  `process_desc` varchar(255) DEFAULT NULL COMMENT '订单编号',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `sign` varchar(32) NOT NULL,
  `process_isdel` tinyint(4) DEFAULT NULL COMMENT '1为删除 0为删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index1` (`sign`) USING HASH
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_role`
-- ----------------------------
DROP TABLE IF EXISTS `t_role`;
CREATE TABLE `t_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) DEFAULT NULL COMMENT '角色名称',
  `role_desc` varchar(255) DEFAULT NULL COMMENT '角色描述',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `role_privileges` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `t_role`
-- ----------------------------
BEGIN;
INSERT INTO `t_role` VALUES ('1', '管理员', '最高权限', '42314324', 'a:30:{i:0;s:4:\"user\";i:1;s:10:\"user/index\";i:2;s:8:\"user/add\";i:3;s:5:\"order\";i:4;s:11:\"order/index\";i:5;s:10:\"order/info\";i:6;s:10:\"order/edit\";i:7;s:9:\"order/add\";i:8;s:9:\"order/del\";i:9;s:7:\"process\";i:10;s:13:\"process/index\";i:11;s:12:\"process/edit\";i:12;s:11:\"process/add\";i:13;s:11:\"process/del\";i:14;s:10:\"department\";i:15;s:16:\"department/index\";i:16;s:15:\"department/info\";i:17;s:15:\"department/edit\";i:18;s:14:\"department/add\";i:19;s:14:\"department/del\";i:20;s:4:\"role\";i:21;s:10:\"role/index\";i:22;s:8:\"role/del\";i:23;s:9:\"role/edit\";i:24;s:8:\"role/add\";i:25;s:12:\"user_process\";i:26;s:18:\"user_process/index\";i:27;s:16:\"user_process/del\";i:28;s:17:\"user_process/edit\";i:29;s:16:\"user_process/add\";}', '0'), ('2', '厂长', '高级权限', '234232343', 'a:10:{i:0;s:4:\"user\";i:1;s:10:\"user/index\";i:2;s:9:\"user/info\";i:3;s:9:\"user/edit\";i:4;s:8:\"user/add\";i:5;s:4:\"role\";i:6;s:10:\"role/index\";i:7;s:8:\"role/del\";i:8;s:9:\"role/edit\";i:9;s:8:\"role/add\";}', '0'), ('3', '给娃饿噶广告噶饿', '噶饿噶', null, 'a:10:{i:0;s:4:\"user\";i:1;s:10:\"user/index\";i:2;s:9:\"user/info\";i:3;s:9:\"user/edit\";i:4;s:8:\"user/add\";i:5;s:4:\"role\";i:6;s:10:\"role/index\";i:7;s:8:\"role/del\";i:8;s:9:\"role/edit\";i:9;s:8:\"role/add\";}', '1'), ('4', '给娃饿噶广告噶饿', '噶饿噶', null, 'a:10:{i:0;s:4:\"user\";i:1;s:10:\"user/index\";i:2;s:9:\"user/info\";i:3;s:9:\"user/edit\";i:4;s:8:\"user/add\";i:5;s:4:\"role\";i:6;s:10:\"role/index\";i:7;s:8:\"role/del\";i:8;s:9:\"role/edit\";i:9;s:8:\"role/add\";}', '1'), ('5', 'Vbzd', 'bdfbzdfbz', null, 'a:5:{i:0;s:4:\"user\";i:1;s:10:\"user/index\";i:2;s:9:\"user/info\";i:3;s:9:\"user/edit\";i:4;s:8:\"user/add\";}', '1'), ('6', 'wega', 'gaew', null, 'a:1:{i:0;s:10:\"role/index\";}', '1');
COMMIT;

-- ----------------------------
--  Table structure for `t_user`
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(12) NOT NULL,
  `username` varchar(32) NOT NULL COMMENT '用户名',
  `pwd` varchar(32) NOT NULL,
  `truename` varchar(32) NOT NULL,
  `sex` tinyint(4) NOT NULL DEFAULT '1' COMMENT '性别 1男 0女',
  `age` tinyint(11) DEFAULT NULL COMMENT '年龄',
  `dept_id` int(11) NOT NULL COMMENT '部门编号',
  `begin_work_time` int(11) NOT NULL COMMENT '入职时间',
  `end_work_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `idcard` varchar(18) DEFAULT '0' COMMENT '身份证号',
  `mobile` varchar(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `qq` varchar(16) DEFAULT NULL,
  `weixin` varchar(32) DEFAULT NULL,
  `isdel` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1为离职，0为在值',
  `bothday` varchar(10) DEFAULT NULL,
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `t_user`
-- ----------------------------
BEGIN;
INSERT INTO `t_user` VALUES ('1', 'GD0001', 'changzhang', '96e79218965eb72c92a549dd5a330112', '厂长', '1', '32', '1', '1234546', null, null, '0', null, null, null, null, '0', null, '0');
COMMIT;

-- ----------------------------
--  Table structure for `t_user_process`
-- ----------------------------
DROP TABLE IF EXISTS `t_user_process`;
CREATE TABLE `t_user_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户编号',
  `order_id` int(11) NOT NULL COMMENT '订单编号',
  `process_id` int(11) NOT NULL COMMENT '工序编号',
  `process_num` int(11) NOT NULL COMMENT '工序 做的 件数',
  `desc` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `ispay` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否结算 1为结算 0为未结算',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_user_salary`
-- ----------------------------
DROP TABLE IF EXISTS `t_user_salary`;
CREATE TABLE `t_user_salary` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL COMMENT '用户编号',
  `user_name` varchar(255) DEFAULT NULL COMMENT '用户名称',
  `order_id` int(11) DEFAULT NULL COMMENT '订单编号',
  `work_month` varchar(255) DEFAULT NULL COMMENT '工作的月份 如：2月份 存储   2015-02',
  `salary` float(10,2) DEFAULT NULL COMMENT '本月的薪水',
  `status` int(11) DEFAULT NULL COMMENT '状态 0 已生产薪资单， 1 已发放薪资',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
