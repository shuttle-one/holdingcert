-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2021 at 06:11 AM
-- Server version: 8.0.22
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Trafigura`
--
CREATE DATABASE IF NOT EXISTS `Trafigura` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `Trafigura`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE IF NOT EXISTS `tbl_account` (
  `id` int NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` int NOT NULL,
  `active` int NOT NULL DEFAULT '0',
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_case`
--

CREATE TABLE IF NOT EXISTS `tbl_case` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `refno` varchar(200) DEFAULT NULL,
  `casetype` int NOT NULL,
  `buysell` varchar(40) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `tradeno` varchar(40) DEFAULT NULL,
  `transportunit` varchar(200) DEFAULT NULL,
  `clientname` varchar(200) DEFAULT NULL,
  `comment` text,
  `status` int NOT NULL DEFAULT '0',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_casetype`
--

CREATE TABLE IF NOT EXISTS `tbl_casetype` (
  `id` int NOT NULL,
  `title` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tank`
--

CREATE TABLE IF NOT EXISTS `tbl_tank` (
  `id` int NOT NULL,
  `caseid` int NOT NULL,
  `tankno` varchar(40) NOT NULL,
  `productname` varchar(200) NOT NULL,
  `mt` int NOT NULL,
  `bbl` int NOT NULL,
  `torder` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tank_list`
--

CREATE TABLE IF NOT EXISTS `tbl_tank_list` (
  `id` int NOT NULL,
  `title` varchar(40) NOT NULL,
  `mt` double NOT NULL DEFAULT '0',
  `bbl` double NOT NULL DEFAULT '0',
  `updatedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_upload`
--

CREATE TABLE IF NOT EXISTS `tbl_upload` (
  `id` int NOT NULL,
  `title` varchar(200) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_upload_temp`
--

CREATE TABLE IF NOT EXISTS `tbl_upload_temp` (
  `id` int NOT NULL,
  `caseid` varchar(40) NOT NULL,
  `title` varchar(200) NOT NULL,
  `uploadby` varchar(40) NOT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `createdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_case`
--
ALTER TABLE `tbl_case`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_casetype`
--
ALTER TABLE `tbl_casetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tank`
--
ALTER TABLE `tbl_tank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tank_list`
--
ALTER TABLE `tbl_tank_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_upload`
--
ALTER TABLE `tbl_upload`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_upload_temp`
--
ALTER TABLE `tbl_upload_temp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_case`
--
ALTER TABLE `tbl_case`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_casetype`
--
ALTER TABLE `tbl_casetype`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_tank`
--
ALTER TABLE `tbl_tank`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_tank_list`
--
ALTER TABLE `tbl_tank_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_upload`
--
ALTER TABLE `tbl_upload`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_upload_temp`
--
ALTER TABLE `tbl_upload_temp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
