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
-- ฐานข้อมูล: `db_radio`
-- 

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `member`
-- 

CREATE TABLE `member` (
  `id` int(5) unsigned zerofill NOT NULL auto_increment,
  `username` varchar(15) collate utf8_unicode_ci NOT NULL,
  `password` varchar(15) collate utf8_unicode_ci NOT NULL,
  `name` varchar(30) collate utf8_unicode_ci NOT NULL,
  `level` enum('ADMIN','USER') collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- 
-- dump ตาราง `member`
-- 

INSERT INTO `member` VALUES (00001, 'admin', '1', 'มทส.', 'ADMIN');
INSERT INTO `member` VALUES (00002, 'ronsc', '1', 'รณกร', 'USER');
INSERT INTO `member` VALUES (00003, 'test1', '1', 'เอิร์ธ', 'USER');
INSERT INTO `member` VALUES (00004, 'monx', '345', 'เอิร์ธ', 'ADMIN');
INSERT INTO `member` VALUES (00006, 'test2', '1', 'รณกร จันทร์นาลาว', 'USER');

-- --------------------------------------------------------

-- 
-- โครงสร้างตาราง `user_upload`
-- 

CREATE TABLE `user_upload` (
  `FilesID` int(5) unsigned zerofill NOT NULL auto_increment,
  `Name` varchar(100) NOT NULL,
  `FilesName` varchar(100) NOT NULL,
  `Size` double NOT NULL,
  `ContentType` varchar(100) NOT NULL,
  `DayWeek` varchar(100) NOT NULL,
  `DayTime` varchar(100) NOT NULL,
  `List` varchar(100) NOT NULL,
  `FilesPath` varchar(100) NOT NULL,
  PRIMARY KEY  (`FilesID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `user_upload`
-- 

INSERT INTO `user_upload` VALUES (00001, 'ronsc', 'KasetTalk-21929.MP3', 6187620, 'audio/mp3', 'Monday', '12.00', 'KasetTalk', 'files/');
INSERT INTO `user_upload` VALUES (00002, 'admin', 'Janmo-233818.mp3', 3808570, 'audio/mp3', 'Monday', '15.00', '30mSUT', '/files/');
INSERT INTO `user_upload` VALUES (00003, 'admin', 'Janmo-234727.mp3', 6187620, 'audio/mp3', 'Tuesday', '19.00', '30mSUT', '/files/');
