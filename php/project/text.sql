-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql8
-- Generation Time: Oct 19, 2021 at 01:18 PM
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

CREATE DEFINER=`devuser`@`%` PROCEDURE `spCheckAdmin` (IN `group_id` INT, IN `admin_id` INT)  BEGIN
SELECT * FROM grpadmin WHERE group_id=group_id AND admin_id=admin_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spCheckMember` (IN `group_id` INT, IN `usr_add` INT)  BEGIN
SELECT * FROM grpmember
WHERE group_id=group_id AND member_id=usr_add;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spGroupAdmins` (IN `user_id` INT)  BEGIN
SELECT * FROM grpadmin WHERE group_id = user_id;
END$$

CREATE DEFINER=`devuser`@`%` PROCEDURE `spUpdateStatus` (IN `u_id` INT)  BEGIN
UPDATE users SET status = 'Active now' WHERE unique_id = u_id;
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
(5, 'egfs', 1465468544, 561478034, '1634559815abc.jpeg'),
(7, 'new', 720593791, 561478034, '1634618650abc.jpeg'),
(8, 'rishigroup', 934429471, 561478034, '1634635323abc.jpeg'),
(9, 'aggroup', 270430902, 561478034, '1634649035index.jpeg');

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
(1, 1465468544, 415331816),
(2, 1465468544, 561478034),
(4, 720593791, 561478034),
(5, 720593791, 415331816),
(7, 934429471, 561478034),
(8, 934429471, 415331816),
(9, 270430902, 561478034),
(10, 270430902, 415331816);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int NOT NULL,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(1000) NOT NULL,
  `read_state` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `read_state`) VALUES
(1, 415331816, 561478034, 'gfgf', 0),
(2, 561478034, 415331816, 'gfgfhg', 0),
(3, 561478034, 415331816, 'Hi', 0),
(5, 415331816, 561478034, 'hello', 0),
(6, 561478034, 415331816, 'ok', 0),
(7, 415331816, 561478034, 'hi', 0),
(8, 561478034, 415331816, 'ok', 0),
(9, 561478034, 415331816, 'ok', 0),
(10, 415331816, 561478034, 'hi', 0),
(11, 561478034, 415331816, 'hello', 0),
(12, 415331816, 561478034, 'hi', 1);

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
(1, 561478034, 415331816, 0),
(2, 415331816, 561478034, 0),
(3, 415331816, 934429471, 0),
(4, 415331816, 1465468544, 0),
(5, 415331816, 720593791, 0),
(6, 561478034, 1465468544, 0);

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
(1, 561478034, 'Rishi', 'patel', 'rishi.p.addweb@gmail.com', '9e58d6ab9e42c22ebd5c63e97c36004d', '1634538669index.jpeg', 'Active now', '18:05:13', '2021-10-19'),
(2, 415331816, 'Bharat', 'Chaudhary', 'bharat.c.addweb@gmail.com', '73fcee19c245fade5d57f35e0dd27c31', '1634532033abc.jpeg', 'Active now', '11:01:33', '2021-10-19');

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
  MODIFY `g_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `grpmember`
--
ALTER TABLE `grpmember`
  MODIFY `grp_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `typeStatus`
--
ALTER TABLE `typeStatus`
  MODIFY `ids` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;