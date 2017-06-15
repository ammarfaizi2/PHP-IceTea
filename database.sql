SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `icetea`
--




CREATE TABLE `account_data` (
  `userid` varchar(16) NOT NULL,
  `email` varchar(225) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `ukey` varchar(72) NOT NULL,
  `authority` enum('user','admin','root') NOT NULL DEFAULT 'user',
  `status` enum('active','block') NOT NULL DEFAULT 'active',
  `verified` enum('true','false') NOT NULL DEFAULT 'false',
  `tokenizer` varchar(144) NOT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `account_info` (
  `userid` varchar(16) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `tempat_lahir` varchar(225) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text,
  `phone` varchar(20) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `hid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `login_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `mkey` varchar(72) NOT NULL,
  `remote_addr` varchar(25) NOT NULL,
  `device_info` text NOT NULL,
  `login_status` enum('true','false') NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;






CREATE TABLE `login_session` (
  `userid` varchar(16) NOT NULL,
  `session` varchar(72) NOT NULL,
  `remote_addr` varchar(25) NOT NULL,
  `device_info` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `pending_account` (
  `userid` varchar(16) NOT NULL,
  `token` text NOT NULL,
  `tkey` varchar(72) NOT NULL,
  `expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






CREATE TABLE `register_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  `password` text,
  `ukey` varchar(72) DEFAULT NULL,
  `useragent` text,
  `ip_address` varchar(20) DEFAULT NULL,
  `country_id` varchar(2) DEFAULT NULL,
  `hash` varchar(72) NOT NULL,
  `status` enum('true','false') NOT NULL DEFAULT 'false',
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;






/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;