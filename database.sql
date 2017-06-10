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
  `ukey` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO account_data VALUES
("1","ammarfaizi2","==wCMyqyIqCNRrM9QQX8QZTbMeAA","jzVFse99kbD6G_DieG3plSQdGE8Ybh3ptM3A7WLn6h_XgD7Ds03qCEIxGH6IQ9_hi16gEMoI");




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


INSERT INTO login_history VALUES
("81","ammarfaizi2","==wCMRjNLnCjJvMNxK+4McuTWJAA","F808R_EyN2vcw9y_Fu2OC9ivFRYXds_7l9R27JiyKMV_i8_2g_PT8_8C0Dmv4m_v5EnQtwj3","127.0.0.1","{\"useragent\":\"Mozilla\\/5.0 (X11; Ubuntu; Linux i686; rv:46.0) Gecko\\/20100101 Firefox\\/46.0\"}","true","2017-06-10 20:40:26"),
("82","ammarfaizi2","==wcKfzDN5CMR0M9UCxEWAHjXcAA","F808R_EyN2vcw9y_Fu2OC9ivFRYXds_7l9R27JiyKMV_i8_2g_PT8_8C0Dmv4m_v5EnQtwj3","127.0.0.1","{\"useragent\":\"Mozilla\\/5.0 (X11; Ubuntu; Linux i686; rv:46.0) Gecko\\/20100101 Firefox\\/46.0\"}","true","2017-06-10 20:40:34"),
("83","ammarfaizi2","==wyPvwiIqCDydhNVD+8zsErJWAA","F808R_EyN2vcw9y_Fu2OC9ivFRYXds_7l9R27JiyKMV_i8_2g_PT8_8C0Dmv4m_v5EnQtwj3","127.0.0.1","{\"useragent\":\"Mozilla\\/5.0 (X11; Ubuntu; Linux i686; rv:46.0) Gecko\\/20100101 Firefox\\/46.0\"}","true","2017-06-10 20:40:35"),
("84","ammarfaizi2","==wsIQvM1jUdyic8wKnVTTTqkLAA","F808R_EyN2vcw9y_Fu2OC9ivFRYXds_7l9R27JiyKMV_i8_2g_PT8_8C0Dmv4m_v5EnQtwj3","127.0.0.1","{\"useragent\":\"Mozilla\\/5.0 (X11; Ubuntu; Linux i686; rv:46.0) Gecko\\/20100101 Firefox\\/46.0\"}","true","2017-06-10 20:40:53");




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