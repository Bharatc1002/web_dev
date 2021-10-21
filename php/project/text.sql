-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql8
-- Generation Time: Oct 21, 2021 at 01:29 PM
-- Server version: 8.0.26
-- PHP Version: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`devuser`@`%` PROCEDURE `spAddMember` (IN `user_id` INT, IN `usr_add` INT)  BEGIN
INSERT INTO grpmember(group_id, member_id)
VALUES(user_id, usr_add);
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spChat` (IN `o_id` INT, IN `i_id` INT)  BEGIN
SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id WHERE (outgoing_msg_id=o_id AND incoming_msg_id=i_id) OR (outgoing_msg_id=i_id AND incoming_msg_id=o_id) ORDER BY msg_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spCheckAdmin` (IN `gr_id` INT, IN `ad_id` INT)  BEGIN
SELECT * FROM grpadmin WHERE group_id=gr_id AND admin_id=ad_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spCheckMail` (IN `e_mail` VARCHAR(255))  BEGIN
SELECT * FROM users WHERE email=e_mail;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spCheckMember` (IN `g_id` INT, IN `usr_add` INT)  BEGIN
SELECT * FROM grpmember
WHERE group_id=g_id AND member_id=usr_add;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spCheckReadStatus` (IN `sunique_id` INT, IN `runique_id` INT)  BEGIN
SELECT * FROM messages WHERE incoming_msg_id=sunique_id AND 
                outgoing_msg_id=runique_id AND read_state = 1;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spCheckTypeStatus` (IN `u_id` INT, IN `r_id` INT)  BEGIN
SELECT * FROM typeStatus WHERE sender_id=u_id AND receiver_id=r_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spCreateGroup` (IN `g_name` VARCHAR(255), IN `g_id` INT, IN `u_id` INT, IN `imgs_name` VARCHAR(255))  BEGIN
INSERT INTO grpadmin(group_name, group_id, admin_id, img_name) VALUES (g_name,g_id,u_id,imgs_name);
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spDisplayUser` (IN `unique_id` INT, IN `outgoing_id` INT)  BEGIN
SELECT * FROM messages WHERE (incoming_msg_id=unique_id
                OR outgoing_msg_id=unique_id) AND (outgoing_msg_id=outgoing_id                OR incoming_msg_id=outgoing_id) ORDER BY msg_id DESC LIMIT 1;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spGroupAdmins` (IN `user_id` INT)  BEGIN
SELECT * FROM grpadmin WHERE group_id = user_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spGroupChat` (IN `i_id` INT)  BEGIN
SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id WHERE incoming_msg_id=i_id ORDER BY msg_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spGroupData` (IN `g_id` INT)  BEGIN
SELECT * FROM grpadmin WHERE group_id=g_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spInsertChat` (IN `i_id` INT, IN `o_id` INT, IN `message` VARCHAR(255), IN `r_count` INT)  BEGIN
INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, read_state)VALUES (i_id, o_id,message,r_count);
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spInsertFileChat` (IN `i_id` INT, IN `o_id` INT, IN `message` VARCHAR(255), IN `f_iles` VARCHAR(255), IN `r_count` INT)  BEGIN
INSERT INTO messages(incoming_msg_id,outgoing_msg_id,msg,f_ile,read_state) VALUES(i_id,o_id,message,f_iles,r_count);
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spInsertUser` (IN `ran_id` INT, IN `first_name` VARCHAR(255), IN `last_name` VARCHAR(255), IN `e_mail` VARCHAR(255), IN `pass` VARCHAR(255), IN `imgs` VARCHAR(255), IN `sts` VARCHAR(255))  BEGIN
INSERT INTO users (unique_id, fname, lname, email, password, img, status) VALUES (ran_id, first_name,last_name,e_mail,pass,imgs,sts);
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spLastSeen` (IN `c_time` VARCHAR(255), IN `l_date` VARCHAR(255), IN `u_id` INT)  BEGIN
UPDATE users SET last_seenTime=c_time, last_seenDate=l_date WHERE unique_id=u_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spReadStatus` (IN `u_id` INT, IN `us_id` INT)  BEGIN
UPDATE messages SET read_state=0 WHERE incoming_msg_id=u_id AND outgoing_msg_id=us_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spSetStatus` (IN `c_time` VARCHAR(255), IN `l_id` INT)  BEGIN
UPDATE users SET status=c_time WHERE unique_id=l_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spSetTypeStatus` (IN `u_id` INT, IN `us_id` INT, IN `num` INT)  BEGIN
INSERT INTO typeStatus (sender_id, receiver_id, type_status)VALUES(u_id,us_id,num);
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spShowGroup` (IN `unique_id` INT)  BEGIN
SELECT * FROM grpmember WHERE member_id=unique_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spShowUser` (IN `outgoing_id` INT)  BEGIN
SELECT * FROM users WHERE NOT unique_id = outgoing_id ORDER BY user_id DESC;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spTypeStatus` (IN `runique_id` INT, IN `sunique_id` INT)  BEGIN
SELECT * FROM typeStatus
WHERE sender_id=runique_id AND receiver_id=sunique_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spUpdateStatus` (IN `u_id` INT)  BEGIN
UPDATE users SET status = 'Active now' WHERE unique_id = u_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spUpdateTypeStatus` (IN `num` INT, IN `u_id` INT, IN `us_id` INT)  BEGIN
UPDATE typeStatus SET type_status=num WHERE
sender_id=u_id AND
receiver_id=us_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spUpdateUser` (IN `fsname` VARCHAR(255), IN `lsname` VARCHAR(255), IN `new_img_name` VARCHAR(255), IN `u_id` INT)  BEGIN
UPDATE users SET fname=fsname, lname=lsname, img=new_img_name WHERE unique_id=u_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spUsersDetails` (IN `u_id` INT)  BEGIN
SELECT * FROM users WHERE unique_id = u_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `grpadmin`
--

CREATE TABLE `grpadmin` (
  `g_id` int NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `group_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `img_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grpadmin`
--

INSERT INTO `grpadmin` (`g_id`, `group_name`, `group_id`, `admin_id`, `img_name`) VALUES
(1, 'newg', 1024903806, 561478034, '1634723390images.jpeg'),
(2, 'second', 910921584, 561478034, '1634726201index.jpeg'),
(3, 'fsafsaf', 853494766, 561478034, '1634821465abc.jpeg'),
(4, 'egtreg', 1123862870, 561478034, '1634821513abc.jpeg'),
(5, 'caawdwd', 720263526, 561478034, '1634821641abc.jpeg'),
(6, 'sanmcscd', 793873854, 561478034, '1634821655abc.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `grpmember`
--

CREATE TABLE `grpmember` (
  `grp_id` int NOT NULL,
  `group_id` int NOT NULL,
  `member_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grpmember`
--

INSERT INTO `grpmember` (`grp_id`, `group_id`, `member_id`) VALUES
(1, 1024903806, 561478034),
(2, 1024903806, 415331816),
(3, 1024903806, 1570027521),
(4, 910921584, 561478034),
(5, 910921584, 415331816),
(6, 853494766, 561478034),
(7, 1123862870, 561478034),
(8, 720263526, 561478034),
(9, 793873854, 561478034);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int NOT NULL,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `f_ile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `read_state` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `f_ile`, `read_state`) VALUES
(1, 1024903806, 561478034, 'hi', NULL, 1),
(2, 1024903806, 415331816, 'hi', NULL, 1),
(3, 1024903806, 415331816, 'hws u', NULL, 1),
(4, 1024903806, 1570027521, 'haloooo', NULL, 1),
(32, 1024903806, 561478034, 'hi', NULL, 1),
(33, 1024903806, 561478034, 'ok', '1634817886abc.jpeg', 1),
(34, 1024903806, 561478034, 'LALALALA', '1634818860index.jpeg', 1),
(35, 1024903806, 561478034, 'file', '1634819293test_db.sql', 1),
(36, 1024903806, 561478034, 'afafhjsaasfsaasvav vnasvhbashvavhfabv', '1634819452images.jpeg', 1),
(37, 1024903806, 561478034, 'nice', NULL, 1),
(38, 1024903806, 561478034, 'if', '1634820030abc.jpeg', 1),
(39, 1024903806, 561478034, 'ok', '1634820039abc.jpeg', 1),
(40, 1024903806, 561478034, 'hi', NULL, 1),
(41, 1024903806, 561478034, 'by', '1634820197index.jpeg', 1),
(42, 1024903806, 561478034, 'bb', '1634820201index.jpeg', 1),
(43, 1024903806, 561478034, NULL, '', 1),
(44, 1024903806, 561478034, NULL, '', 1),
(45, 1024903806, 561478034, NULL, '', 1),
(46, 1024903806, 561478034, 'sgf', NULL, 1),
(47, 1024903806, 561478034, 'g', NULL, 1),
(48, 1024903806, 561478034, 'gfsgf', NULL, 1),
(49, 1024903806, 561478034, 'gs', NULL, 1),
(50, 1024903806, 561478034, 'gsgsgs', NULL, 1),
(51, 1024903806, 561478034, 'g', NULL, 1),
(52, 1024903806, 561478034, 'g', NULL, 1),
(53, 1024903806, 561478034, 'g', NULL, 1),
(54, 1024903806, 561478034, 'g', NULL, 1),
(55, 1024903806, 561478034, 'g', NULL, 1),
(56, 1024903806, 561478034, 'sgsgs', NULL, 1),
(57, 1024903806, 561478034, 'gsg', NULL, 1),
(58, 1024903806, 561478034, 'g', NULL, 1),
(59, 1024903806, 561478034, 'g', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `typeStatus`
--

CREATE TABLE `typeStatus` (
  `ids` int NOT NULL,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `type_status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `typeStatus`
--

INSERT INTO `typeStatus` (`ids`, `sender_id`, `receiver_id`, `type_status`) VALUES
(1, 561478034, 1024903806, 0),
(2, 415331816, 1024903806, 0),
(3, 1570027521, 1024903806, 0),
(4, 561478034, 1570027521, 0),
(5, 561478034, 910921584, 0),
(6, 561478034, 415331816, 0),
(7, 561478034, 1227660629, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `unique_id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `last_seenTime` time NOT NULL DEFAULT '00:00:00',
  `last_seenDate` date NOT NULL DEFAULT '2000-02-10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`, `last_seenTime`, `last_seenDate`) VALUES
(1, 561478034, 'Rishi', 'Patel', 'rishi.p.addweb@gmail.com', '9e58d6ab9e42c22ebd5c63e97c36004d', '1634718211index.jpeg', 'Active now', '18:40:51', '2021-10-21'),
(2, 415331816, 'Bharat', 'Chaudhary', 'bharat.c.addweb@gmail.com', '73fcee19c245fade5d57f35e0dd27c31', '1634718672abc.jpeg', 'Active now', '13:44:13', '2021-10-20'),
(6, 1570027521, 'Ketan', 'Dabhi', 'ketan.d.addweb@gmail.com', '7c050137046892135f2616268d3d89d6', '1634723545images.jpeg', 'Active now', '15:34:24', '2021-10-20'),
(7, 1227660629, 'newUser', 'User', 'bharat.addweb@gmail.com', '73fcee19c245fade5d57f35e0dd27c31', '1634813211abc.jpeg', '16:17:01', '16:17:01', '2021-10-21'),
(8, 318321785, 'dhsg', 'sfgg', 'rishi.p.ddweb@gmail.com', '9e58d6ab9e42c22ebd5c63e97c36004d', '1634821865abc.jpeg', '18:41:10', '18:41:10', '2021-10-21'),
(9, 431654110, 'sgfsgf', 'sgfgf', 'rishi.p.addweb@gail.com', '9e58d6ab9e42c22ebd5c63e97c36004d', '1634821884abc.jpeg', '18:41:30', '18:41:30', '2021-10-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grpadmin`
--
ALTER TABLE `grpadmin`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `grpmember`
--
ALTER TABLE `grpmember`
  ADD PRIMARY KEY (`grp_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `typeStatus`
--
ALTER TABLE `typeStatus`
  ADD PRIMARY KEY (`ids`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grpadmin`
--
ALTER TABLE `grpadmin`
  MODIFY `g_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `grpmember`
--
ALTER TABLE `grpmember`
  MODIFY `grp_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `typeStatus`
--
ALTER TABLE `typeStatus`
  MODIFY `ids` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;