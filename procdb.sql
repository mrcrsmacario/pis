-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for procdb
CREATE DATABASE IF NOT EXISTS `procdb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `procdb`;

-- Dumping structure for table procdb.lib_fund_source
CREATE TABLE IF NOT EXISTS `lib_fund_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `fund_source` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table procdb.lib_uacs_code
CREATE TABLE IF NOT EXISTS `lib_uacs_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `uacs_code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=512 DEFAULT CHARSET=utf8mb4;

-- Data exporting was unselected.

-- Dumping structure for table procdb.tbl_activity
CREATE TABLE IF NOT EXISTS `tbl_activity` (
  `act_id` int(11) NOT NULL AUTO_INCREMENT,
  `act_name` text,
  `act_fund_src_id` int(11) DEFAULT '0',
  `act_type` varchar(50) DEFAULT NULL,
  `act_ppmp_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`act_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table procdb.tbl_item
CREATE TABLE IF NOT EXISTS `tbl_item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_desc` text,
  `item_qty` float DEFAULT NULL,
  `item_unit_cost` float DEFAULT NULL,
  `item_uacs_code` varchar(50) DEFAULT NULL,
  `item_act_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table procdb.tbl_ppmp
CREATE TABLE IF NOT EXISTS `tbl_ppmp` (
  `ppmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `ppmp_title` varchar(50) DEFAULT NULL,
  `ppmp_year` varchar(4) DEFAULT NULL,
  `ppmp_date_created` date DEFAULT NULL,
  `ppmp_created_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ppmp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
