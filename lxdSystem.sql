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

 Date: 05/07/2015 15:09:48 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `lxd_group`
-- ----------------------------
DROP TABLE IF EXISTS `lxd_group`;
CREATE TABLE `lxd_group` (
  `gid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(255) NOT NULL,
  `privileges` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `lxd_member`
-- ----------------------------
DROP TABLE IF EXISTS `lxd_member`;
CREATE TABLE `lxd_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gid` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(32) DEFAULT '',
  `mobile` varchar(11) DEFAULT '',
  `truename` varchar(32) DEFAULT '',
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  `lastip` varchar(15) NOT NULL,
  `lasttime` int(11) NOT NULL DEFAULT '0',
  `logintime` int(11) NOT NULL DEFAULT '0',
  `addtime` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
