-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.0.51
-- รุ่นของ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ฐานข้อมูล: `sut_radio`
-- 
CREATE DATABASE `sut_radio` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sut_radio`;

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `_announce`
-- 

CREATE TABLE `_announce` (
  `an_id` int(3) unsigned zerofill NOT NULL,
  `an_text` varchar(255) NOT NULL,
  PRIMARY KEY  (`an_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `_announce`
-- 

INSERT INTO `_announce` VALUES (000, 'ทดสอบภาษาไทยๆ');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `_files`
-- 

CREATE TABLE `_files` (
  `F_id` int(11) NOT NULL auto_increment,
  `F_name` varchar(255) NOT NULL,
  `M_user` varchar(15) NOT NULL,
  `L_id` int(11) NOT NULL,
  `S_id` int(11) NOT NULL,
  `F_date` date NOT NULL,
  `F_type` varchar(50) NOT NULL,
  `F_size` varchar(50) NOT NULL,
  `F_path` text NOT NULL,
  PRIMARY KEY  (`F_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- 
-- dump ตาราง `_files`
-- 

INSERT INTO `_files` VALUES (29, '02_test1-5125.mp3', 'user', 22, 7, '2014-04-20', 'audio/mp3', '4200897', 'files/2014-04/20/Sunday/06.00/');
INSERT INTO `_files` VALUES (28, '01_SUT-Papern-9084.mp3', 'admin', 15, 17, '2014-04-19', 'audio/mp3', '2023164', 'files/2014-04/19/Saturday/06.00/');
INSERT INTO `_files` VALUES (26, '01_SUT-Papern-11028.mp3', 'admin', 15, 6, '2014-04-22', 'audio/mp3', '4200897', 'files/2014-04/22/Tuesday/06.00/');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `_list`
-- 

CREATE TABLE `_list` (
  `L_id` int(11) NOT NULL auto_increment,
  `L_th` varchar(255) NOT NULL,
  `L_en` varchar(255) NOT NULL,
  PRIMARY KEY  (`L_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- 
-- dump ตาราง `_list`
-- 

INSERT INTO `_list` VALUES (22, 'ทดสอบ1', 'test1');
INSERT INTO `_list` VALUES (15, 'มทส. พาเพลิน', 'SUT-Papern');
INSERT INTO `_list` VALUES (10, 'ธรรมะ', 'Dhamma');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `_member`
-- 

CREATE TABLE `_member` (
  `M_id` int(11) NOT NULL auto_increment,
  `M_name` varchar(255) NOT NULL,
  `M_lastname` varchar(255) NOT NULL,
  `M_user` varchar(15) NOT NULL,
  `M_pass` varchar(15) NOT NULL,
  `M_level` enum('ADMIN','USER') NOT NULL,
  PRIMARY KEY  (`M_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `_member`
-- 

INSERT INTO `_member` VALUES (1, 'รณกร', 'จันทร์นาลาว', 'admin', '1', 'ADMIN');
INSERT INTO `_member` VALUES (3, 'รณกร', 'จันทร์นาลาว', 'user', '1', 'USER');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `_sublist`
-- 

CREATE TABLE `_sublist` (
  `S_id` int(11) NOT NULL auto_increment,
  `L_id` int(11) NOT NULL,
  `S_day` varchar(50) NOT NULL,
  `S_time` varchar(50) NOT NULL,
  `S_order` int(2) unsigned zerofill NOT NULL,
  `S_status` enum('Y','N') NOT NULL,
  PRIMARY KEY  (`S_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- dump ตาราง `_sublist`
-- 

INSERT INTO `_sublist` VALUES (1, 10, 'Sunday', '06.00', 01, 'N');
INSERT INTO `_sublist` VALUES (2, 10, 'Monday', '06.00', 01, 'N');
INSERT INTO `_sublist` VALUES (3, 10, 'Tuesday', '06.00', 03, 'N');
INSERT INTO `_sublist` VALUES (4, 15, 'Sunday', '06.00', 03, 'N');
INSERT INTO `_sublist` VALUES (5, 15, 'Monday', '06.00', 02, 'N');
INSERT INTO `_sublist` VALUES (6, 15, 'Tuesday', '06.00', 01, 'Y');
INSERT INTO `_sublist` VALUES (7, 22, 'Sunday', '06.00', 02, 'Y');
INSERT INTO `_sublist` VALUES (8, 22, 'Monday', '06.00', 03, 'N');
INSERT INTO `_sublist` VALUES (9, 22, 'Tuesday', '06.00', 02, 'N');
INSERT INTO `_sublist` VALUES (17, 15, 'Saturday', '06.00', 01, 'Y');
