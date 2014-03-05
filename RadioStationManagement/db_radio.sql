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
-- ฐานข้อมูล: `db_radio`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `announce`
-- 

CREATE TABLE `announce` (
  `an_id` int(3) unsigned zerofill NOT NULL,
  `an_text` varchar(255) NOT NULL,
  PRIMARY KEY (`an_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 
-- dump ตาราง `announce`
-- 

INSERT INTO `announce` VALUES (000, 'ประกาศจากทีมงาน : ทดสอบระบบหอกระจายข่าว');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `member`
-- 

CREATE TABLE `member` (
  `id` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `level` enum('ADMIN','USER') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `member`
-- 

INSERT INTO `member` VALUES (00001, 'admin', '1', 'มทส.', 'ADMIN');
INSERT INTO `member` VALUES (00002, 'ronsc', '1', 'รณกร', 'USER');
INSERT INTO `member` VALUES (00003, 'test1', '1', 'เอิร์ธ', 'USER');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `user_upload`
-- 

CREATE TABLE `user_upload` (
  `FilesID` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `FilesName` varchar(100) NOT NULL,
  `Size` double NOT NULL,
  `ContentType` varchar(100) NOT NULL,
  `DayWeek` varchar(100) NOT NULL,
  `DayTime` varchar(100) NOT NULL,
  `List` varchar(100) NOT NULL,
  `FilesPath` varchar(100) NOT NULL,
  PRIMARY KEY (`FilesID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- dump ตาราง `user_upload`
-- 

