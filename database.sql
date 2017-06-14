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
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `ukey` varchar(72) NOT NULL,
  `authority` enum('user','admin','root') NOT NULL DEFAULT 'user',
  `status` enum('active','block') NOT NULL DEFAULT 'active',
  `verified` enum('true','false') NOT NULL DEFAULT 'false',
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `account_data` VALUES
("1","ammarfaizi2","==wCMyqyIqCNRrM9QQX8QZTbMeAA","jzVFse99kbD6G_DieG3plSQdGE8Ybh3ptM3A7WLn6h_XgD7Ds03qCEIxGH6IQ9_hi16gEMoI","user","active","false","","");




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
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;






CREATE TABLE `login_session` (
  `userid` varchar(16) NOT NULL,
  `session` varchar(72) NOT NULL,
  `remote_addr` varchar(25) NOT NULL,
  `device_info` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `expired_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;






/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;