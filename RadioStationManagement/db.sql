-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- ��ʵ�: localhost
-- ����㹡�����ҧ: 
-- ��蹢ͧ���������: 5.0.51
-- ��蹢ͧ PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- �ҹ������: `db_radio`
-- 

-- --------------------------------------------------------

-- 
-- �ç���ҧ���ҧ `fileupload`
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
-- dump ���ҧ `fileupload`
-- 

INSERT INTO `fileupload` VALUES (00001, 'ronsc', 'Balada', 'files/balada.mp3', 'Monday', '09.00');

-- --------------------------------------------------------

-- 
-- �ç���ҧ���ҧ `member`
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
-- dump ���ҧ `member`
-- 

INSERT INTO `member` VALUES (00001, 'admin', '1', '���.', 'ADMIN');
INSERT INTO `member` VALUES (00002, 'ronsc', '1', 'ó��', 'USER');
INSERT INTO `member` VALUES (00003, 'test1', '1', '�����', 'USER');
