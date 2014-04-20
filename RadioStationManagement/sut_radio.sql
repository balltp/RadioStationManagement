-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- โฮสต์: localhost
-- เวลาในการสร้าง: 
-- รุ่นของเซิร์ฟเวอร์: 5.5.34
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
  PRIMARY KEY (`an_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `_announce`
-- 

INSERT INTO `_announce` VALUES (000, 'ทดสอบระบบ ครั้งที่ 3');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `_files`
-- 

CREATE TABLE `_files` (
  `F_id` int(11) NOT NULL AUTO_INCREMENT,
  `F_name` varchar(255) NOT NULL,
  `M_user` varchar(15) NOT NULL,
  `L_id` int(11) NOT NULL,
  `S_id` int(11) NOT NULL,
  `F_date` date NOT NULL,
  `F_type` varchar(50) NOT NULL,
  `F_size` varchar(50) NOT NULL,
  `F_path` text NOT NULL,
  PRIMARY KEY (`F_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `_files`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `_list`
-- 

CREATE TABLE `_list` (
  `L_id` int(11) NOT NULL AUTO_INCREMENT,
  `L_th` varchar(255) NOT NULL,
  `L_en` varchar(255) NOT NULL,
  PRIMARY KEY (`L_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

-- 
-- dump ตาราง `_list`
-- 


-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `_member`
-- 

CREATE TABLE `_member` (
  `M_id` int(11) NOT NULL AUTO_INCREMENT,
  `M_name` varchar(255) NOT NULL,
  `M_lastname` varchar(255) NOT NULL,
  `M_user` varchar(15) NOT NULL,
  `M_pass` varchar(15) NOT NULL,
  `M_level` enum('ADMIN','USER') NOT NULL,
  PRIMARY KEY (`M_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- dump ตาราง `_member`
-- 

INSERT INTO `_member` VALUES (1, 'รณกร', 'จันทร์นาลาว', 'admin', '1', 'ADMIN');
INSERT INTO `_member` VALUES (2, 'วิศรุต', 'ตรีพรหม', 'first', '1', 'USER');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `_sublist`
-- 

CREATE TABLE `_sublist` (
  `S_id` int(11) NOT NULL AUTO_INCREMENT,
  `L_id` int(11) NOT NULL,
  `S_day` varchar(50) NOT NULL,
  `S_time` varchar(50) NOT NULL,
  `S_order` int(2) unsigned zerofill NOT NULL,
  `S_status` enum('Y','N') NOT NULL,
  PRIMARY KEY (`S_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

-- 
-- dump ตาราง `_sublist`
-- 