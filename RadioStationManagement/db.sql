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
-- โครงสร้างตาราง `fileupload`
-- 

CREATE TABLE `fileupload` (
  `id` int(5) unsigned zerofill NOT NULL auto_increment,
  `upload_by` text collate utf8_unicode_ci NOT NULL,
  `upload_name` text collate utf8_unicode_ci NOT NULL,
  `upload_file` text collate utf8_unicode_ci NOT NULL,
  `upload_date` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') collate utf8_unicode_ci NOT NULL,
  `upload_time` varchar(5) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- dump ตาราง `fileupload`
-- 

INSERT INTO `fileupload` VALUES (00001, 'ronsc', 'Balada', 'files/balada.mp3', 'Monday', '09.00');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- 
-- dump ตาราง `member`
-- 

INSERT INTO `member` VALUES (00001, 'admin', '1', 'มทส.', 'ADMIN');
INSERT INTO `member` VALUES (00002, 'ronsc', '1', 'รณกร', 'USER');
INSERT INTO `member` VALUES (00003, 'test1', '1', 'เอิร์ธ', 'USER');
