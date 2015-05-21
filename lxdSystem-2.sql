-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-05-20 19:57:25
-- 服务器版本： 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lxdSystem`
--
CREATE DATABASE IF NOT EXISTS `lxdSystem` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `lxdSystem`;

-- --------------------------------------------------------

--
-- 表的结构 `t_category`
--

DROP TABLE IF EXISTS `t_category`;
CREATE TABLE IF NOT EXISTS `t_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '类别名称',
  `code` varchar(255) DEFAULT NULL COMMENT '类别编码',
  `remark` varchar(255) DEFAULT NULL COMMENT '类别描述',
  `create_date` int(11) DEFAULT NULL COMMENT '创建日期',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `t_department`
--

DROP TABLE IF EXISTS `t_department`;
CREATE TABLE IF NOT EXISTS `t_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_no` varchar(255) DEFAULT NULL COMMENT '部门编号',
  `dept_name` varchar(255) DEFAULT NULL COMMENT '部门名称',
  `pid` int(11) DEFAULT NULL COMMENT '父部门编号',
  `dept_desc` varchar(255) DEFAULT NULL COMMENT '部门描述',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `t_department`
--

INSERT INTO `t_department` (`id`, `dept_no`, `dept_name`, `pid`, `dept_desc`, `create_time`) VALUES
(1, 'Sewing department', '针车部', 0, '针车gdsfsafsdaf', 1431942115),
(2, 'Product development department', '产品研发部', 0, '产品研发部', 1431929288),
(3, 'Technical department', '技术部', 2, '技术部', 1431939410),
(4, 'Product department', '产品部', 2, '产品部', 1431939680),
(5, 'Split case department', '分尸案部', 1, '八方', 1431939709),
(6, 'Tutor', '辅导教师', 1, '故事发生', 1431941486);

-- --------------------------------------------------------

--
-- 表的结构 `t_order`
--

DROP TABLE IF EXISTS `t_order`;
CREATE TABLE IF NOT EXISTS `t_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_no` varchar(32) NOT NULL COMMENT '订单编号',
  `order_name` varchar(255) NOT NULL COMMENT '订单名称',
  `order_desc` varchar(255) DEFAULT NULL COMMENT '订单描述',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `order_num` int(11) NOT NULL DEFAULT '1' COMMENT '订单预估数量',
  `order_jiafang` varchar(255) NOT NULL COMMENT '订单生产委托商',
  `order_start_date` date NOT NULL COMMENT '订单生产预估开始时间',
  `order_end_date` date DEFAULT NULL COMMENT '订单预估结束时间',
  `order_amount` float(12,2) NOT NULL COMMENT '订单总金额',
  `order_status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '订单状太 1为进行中，0为完成结束，',
  `order_isdel` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否删除 0为未删除 1为删除',
  `order_curr_amount` float(12,2) DEFAULT '0.00' COMMENT '该订单当前花费成本',
  `order_mate_amount` float(12,2) NOT NULL DEFAULT '0.00' COMMENT '当前订单预估成本金额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `t_order`
--

INSERT INTO `t_order` (`id`, `order_no`, `order_name`, `order_desc`, `create_time`, `order_num`, `order_jiafang`, `order_start_date`, `order_end_date`, `order_amount`, `order_status`, `order_isdel`, `order_curr_amount`, `order_mate_amount`) VALUES
(1, '2015051911330728', '订单1', '发了', 1432006387, 10000, '耐克', '2015-05-19', '2015-07-31', 200000.00, 1, 0, 366.90, 139000.00);

-- --------------------------------------------------------

--
-- 表的结构 `t_order_process`
--

DROP TABLE IF EXISTS `t_order_process`;
CREATE TABLE IF NOT EXISTS `t_order_process` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL COMMENT '订单id ',
  `process_id` int(11) NOT NULL COMMENT '工序id',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `t_order_process`
--

INSERT INTO `t_order_process` (`id`, `order_id`, `process_id`, `create_time`) VALUES
(1, 1, 3, 1432006387),
(2, 1, 4, 1432006387),
(3, 1, 5, 1432006387),
(4, 1, 6, 1432006387),
(5, 1, 7, 1432006387),
(6, 1, 8, 1432006387);

-- --------------------------------------------------------

--
-- 表的结构 `t_process`
--

DROP TABLE IF EXISTS `t_process`;
CREATE TABLE IF NOT EXISTS `t_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_name` varchar(255) NOT NULL COMMENT '工序名称',
  `process_price` float(10,2) NOT NULL COMMENT '工序价格',
  `process_desc` varchar(255) DEFAULT NULL COMMENT '订单编号',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `sign` varchar(32) NOT NULL,
  `process_isdel` tinyint(4) DEFAULT NULL COMMENT '1为删除 0为删除',
  PRIMARY KEY (`id`),
  UNIQUE KEY `index1` (`sign`) USING HASH
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `t_process`
--

INSERT INTO `t_process` (`id`, `process_name`, `process_price`, `process_desc`, `create_time`, `sign`, `process_isdel`) VALUES
(1, '铲皮', 2.10, 'fsgsal', 1432006141, '566c6f72ad0edd829116412c1c941354', 0),
(2, '手工全套', 1.80, 'gsfskfsafsafsa', 1432006141, 'b637cff2f3d60657081debfda55e2006', 0),
(3, '打孔', 0.90, 'gfdsksfska''fs', 1432006141, '216316c4cc8909b4016e915afe8db217', 0),
(4, '手工全套', 2.10, '', 1432006387, '2095a6128b34982cbbf48b4e48a5b3b9', 0),
(5, '工序1', 2.50, '', 1432006387, '3a9357fe475aff37ec9c97494300ea5f', 0),
(6, '工序2', 0.60, '', 1432006387, '23b0fd4f61e724202a2b1b4d95cb33d6', 0),
(7, '工序3', 2.50, '', 1432006387, '0ce0cf6e96c4c041f0b6a938756eeb87', 0),
(8, '工序4', 5.30, '', 1432006387, '0c9ffe8f47f9c6e37897eeb449c72f79', 0);

-- --------------------------------------------------------

--
-- 表的结构 `t_role`
--

DROP TABLE IF EXISTS `t_role`;
CREATE TABLE IF NOT EXISTS `t_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) DEFAULT NULL COMMENT '角色名称',
  `role_desc` varchar(255) DEFAULT NULL COMMENT '角色描述',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `role_privileges` text NOT NULL,
  `enabled` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `t_role`
--

INSERT INTO `t_role` (`id`, `role_name`, `role_desc`, `create_time`, `role_privileges`, `enabled`) VALUES
(1, '管理员', '最高权限', 1432107758, 'a:39:{i:0;s:4:"user";i:1;s:10:"user/index";i:2;s:9:"user/info";i:3;s:8:"user/add";i:4;s:8:"user/del";i:5;s:9:"user/edit";i:6;s:10:"department";i:7;s:16:"department/index";i:8;s:15:"department/info";i:9;s:15:"department/edit";i:10;s:14:"department/add";i:11;s:14:"department/del";i:12;s:5:"order";i:13;s:11:"order/index";i:14;s:10:"order/info";i:15;s:10:"order/edit";i:16;s:9:"order/add";i:17;s:9:"order/del";i:18;s:7:"process";i:19;s:13:"process/index";i:20;s:12:"process/info";i:21;s:12:"process/edit";i:22;s:11:"process/add";i:23;s:11:"process/del";i:24;s:4:"role";i:25;s:10:"role/index";i:26;s:9:"role/info";i:27;s:8:"role/del";i:28;s:9:"role/edit";i:29;s:8:"role/add";i:30;s:12:"user_process";i:31;s:18:"user_process/index";i:32;s:16:"user_process/add";i:33;s:16:"user_process/pay";i:34;s:17:"user_process/edit";i:35;s:11:"user_salary";i:36;s:17:"user_salary/index";i:37;s:16:"user_salary/info";i:38;s:16:"user_salary/edit";}', 0),
(2, '厂长', '高级权限', 234232343, 'a:10:{i:0;s:4:"user";i:1;s:10:"user/index";i:2;s:9:"user/info";i:3;s:9:"user/edit";i:4;s:8:"user/add";i:5;s:4:"role";i:6;s:10:"role/index";i:7;s:8:"role/del";i:8;s:9:"role/edit";i:9;s:8:"role/add";}', 0),
(3, '给娃饿噶广告噶饿', '噶饿噶', NULL, 'a:10:{i:0;s:4:"user";i:1;s:10:"user/index";i:2;s:9:"user/info";i:3;s:9:"user/edit";i:4;s:8:"user/add";i:5;s:4:"role";i:6;s:10:"role/index";i:7;s:8:"role/del";i:8;s:9:"role/edit";i:9;s:8:"role/add";}', 1),
(4, '给娃饿噶广告噶饿', '噶饿噶', NULL, 'a:10:{i:0;s:4:"user";i:1;s:10:"user/index";i:2;s:9:"user/info";i:3;s:9:"user/edit";i:4;s:8:"user/add";i:5;s:4:"role";i:6;s:10:"role/index";i:7;s:8:"role/del";i:8;s:9:"role/edit";i:9;s:8:"role/add";}', 1),
(5, 'Vbzd', 'bdfbzdfbz', NULL, 'a:5:{i:0;s:4:"user";i:1;s:10:"user/index";i:2;s:9:"user/info";i:3;s:9:"user/edit";i:4;s:8:"user/add";}', 1),
(6, 'wega', 'gaew', NULL, 'a:1:{i:0;s:10:"role/index";}', 1);

-- --------------------------------------------------------

--
-- 表的结构 `t_spending`
--

DROP TABLE IF EXISTS `t_spending`;
CREATE TABLE IF NOT EXISTS `t_spending` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '开支项目名称',
  `remark` varchar(255) DEFAULT NULL COMMENT '开支项目描述',
  `create_date` int(11) DEFAULT NULL COMMENT '创建日期',
  `code` varchar(255) DEFAULT NULL COMMENT '开支项目编码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `t_spending_record`
--

DROP TABLE IF EXISTS `t_spending_record`;
CREATE TABLE IF NOT EXISTS `t_spending_record` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL COMMENT '类别编号',
  `spending_id` int(11) DEFAULT NULL COMMENT '开支项目编号',
  `spending_date` int(11) DEFAULT NULL COMMENT '开支日期',
  `spending_amount` decimal(10,2) DEFAULT NULL COMMENT '开支金额',
  `create_date` int(11) DEFAULT NULL COMMENT '创建日期',
  `remark` varchar(255) DEFAULT NULL COMMENT '开支描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `t_user`
--

DROP TABLE IF EXISTS `t_user`;
CREATE TABLE IF NOT EXISTS `t_user` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `t_user`
--

INSERT INTO `t_user` (`id`, `no`, `username`, `pwd`, `truename`, `sex`, `age`, `dept_id`, `begin_work_time`, `end_work_time`, `create_time`, `idcard`, `mobile`, `address`, `qq`, `weixin`, `isdel`, `bothday`, `role_id`) VALUES
(1, 'GD0001', 'changzhang', '96e79218965eb72c92a549dd5a330112', '厂长', 1, 32, 1, 1234546, NULL, NULL, '0', NULL, NULL, NULL, NULL, 0, NULL, 1),
(2, 'GD0003', 'zhangsan', 'd41d8cd98f00b204e9800998ecf8427e', '张三', 1, 25, 2, 1430236800, 0, 1431955284, '', '12398757820', '', '', '', 0, '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `t_user_process`
--

DROP TABLE IF EXISTS `t_user_process`;
CREATE TABLE IF NOT EXISTS `t_user_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '用户编号',
  `order_process_id` int(11) NOT NULL COMMENT '订单工序编号',
  `sign` varchar(200) NOT NULL COMMENT '用户与月份的md5值',
  `process_num` int(11) NOT NULL COMMENT '工序 做的 件数',
  `desc` varchar(255) DEFAULT NULL COMMENT '备注',
  `work_month` varchar(200) NOT NULL COMMENT '工作的月份',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `ispay` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否结算 1为结算 0为未结算',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `t_user_process`
--

INSERT INTO `t_user_process` (`id`, `user_id`, `order_process_id`, `sign`, `process_num`, `desc`, `work_month`, `create_time`, `ispay`) VALUES
(1, 1, 1, '8', 43, '5342', '', 1432029094, 0),
(2, 1, 1, '7', 46, '5342', '', 1432029094, 0),
(3, 1, 1, '6', 4231, '5342', '', 1432029094, 0),
(4, 1, 1, '5', 42, '5342', '', 1432029094, 0),
(5, 1, 1, '4', 112, '5342', '', 1432029094, 0),
(6, 1, 1, '3', 43, '5342', '', 1432029094, 0),
(7, 2, 6, '5df3691c7a284f8c5202bb27f880b251', 33, 'fsafs', '2015-05', 1432103884, 0),
(8, 2, 5, '5df3691c7a284f8c5202bb27f880b251', 4, 'fsafs', '2015-05', 1432103884, 0),
(9, 2, 4, '5df3691c7a284f8c5202bb27f880b251', 21, 'fsafs', '2015-05', 1432103884, 0),
(10, 2, 3, '5df3691c7a284f8c5202bb27f880b251', 43, 'fsafs', '2015-05', 1432103884, 0),
(11, 2, 2, '5df3691c7a284f8c5202bb27f880b251', 5, 'fsafs', '2015-05', 1432103884, 0),
(12, 2, 1, '5df3691c7a284f8c5202bb27f880b251', 43, 'fsafs', '2015-05', 1432103884, 0),
(28, 2, 6, '5df3691c7a284f8c5202bb27f880b251', 54, 'fsa', '2015-05', 1432107267, 0),
(29, 2, 4, '5df3691c7a284f8c5202bb27f880b251', 54, 'fsa', '2015-05', 1432107267, 0),
(30, 2, 2, '5df3691c7a284f8c5202bb27f880b251', 23, 'fsa', '2015-05', 1432107267, 0);

-- --------------------------------------------------------

--
-- 表的结构 `t_user_salary`
--

DROP TABLE IF EXISTS `t_user_salary`;
CREATE TABLE IF NOT EXISTS `t_user_salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL COMMENT '用户真名',
  `sign` varchar(255) DEFAULT NULL COMMENT '用户名与工作月份的md5值',
  `work_month` varchar(255) DEFAULT NULL COMMENT '工作的月份 如：2月份 存储   2015-02',
  `salary` float(10,2) DEFAULT NULL COMMENT '本月的薪水',
  `status` int(11) DEFAULT '0' COMMENT '状态 0 已生产薪资单， 1 已发放薪资',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `t_user_salary`
--

INSERT INTO `t_user_salary` (`id`, `username`, `sign`, `work_month`, `salary`, `status`, `create_time`) VALUES
(1, '张三', '5df3691c7a284f8c5202bb27f880b251', '2015-05', 366.90, 0, 1432107267);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
