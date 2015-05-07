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

 Date: 05/07/2015 20:02:34 PM
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
  `order_no` varchar(255) DEFAULT NULL COMMENT '订单编号',
  `order_name` varchar(255) DEFAULT NULL COMMENT '订单名称',
  `order_desc` varchar(255) DEFAULT NULL COMMENT '订单描述',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_process`
-- ----------------------------
DROP TABLE IF EXISTS `t_process`;
CREATE TABLE `t_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_name` varchar(255) DEFAULT NULL COMMENT '工序名称',
  `process_price` decimal(10,2) DEFAULT NULL COMMENT '工序价格',
  `order_id` int(11) DEFAULT NULL COMMENT '订单编号',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_user_process`
-- ----------------------------
DROP TABLE IF EXISTS `t_user_process`;
CREATE TABLE `t_user_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户编号',
  `order_id` int(11) DEFAULT NULL COMMENT '订单编号',
  `process_id` int(11) DEFAULT NULL COMMENT '工序编号',
  `process_num` int(11) DEFAULT NULL COMMENT '工序 做的 件数',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `t_user_role`
-- ----------------------------
DROP TABLE IF EXISTS `t_user_role`;
CREATE TABLE `t_user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户编号',
  `role_id` int(11) DEFAULT NULL COMMENT '角色编号',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
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
  `salary` decimal(10,2) DEFAULT NULL COMMENT '本月的薪水',
  `status` int(11) DEFAULT NULL COMMENT '状态 0 已生产薪资单， 1 已发放薪资',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
