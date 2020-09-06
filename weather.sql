-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:8889
-- 產生時間： 2020 年 09 月 05 日 11:04
-- 伺服器版本： 5.7.26
-- PHP 版本： 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 資料庫： `weather`
--
create database weather default character set utf8;

use weather;

-- --------------------------------------------------------

--
-- 資料表結構 `aweek`
--

CREATE TABLE `aweek` (
  `localID` int(11) UNSIGNED NOT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `locationName`
--

CREATE TABLE `locationName` (
  `localID` int(11) UNSIGNED NOT NULL,
  `localName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `rain`
--

CREATE TABLE `rain` (
  `city` varchar(20) DEFAULT NULL,
  `local` varchar(20) DEFAULT NULL,
  `1hour` varchar(50) DEFAULT NULL,
  `24hour` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `aweek`
--
ALTER TABLE `aweek`
  ADD KEY `fk_locationName_aweek` (`localID`);

--
-- 資料表索引 `locationName`
--
ALTER TABLE `locationName`
  ADD PRIMARY KEY (`localID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `locationName`
--
ALTER TABLE `locationName`
  MODIFY `localID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `aweek`
--
ALTER TABLE `aweek`
  ADD CONSTRAINT `fk_locationName_aweek` FOREIGN KEY (`localID`) REFERENCES `locationName` (`localID`) ON DELETE CASCADE ON UPDATE CASCADE;
