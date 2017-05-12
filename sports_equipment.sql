-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2017 at 01:25 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sports_equipment`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow_detail`
--

CREATE TABLE `borrow_detail` (
  `detail_id` int(7) NOT NULL,
  `ref_borrow_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `item_id` varchar(20) NOT NULL,
  `item_amount` int(3) NOT NULL,
  `item_return_amount` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borrow_detail`
--

INSERT INTO `borrow_detail` (`detail_id`, `ref_borrow_id`, `item_id`, `item_amount`, `item_return_amount`) VALUES
(38, 000028, 'I002', 2, 2),
(39, 000028, 'I003', 2, 2),
(40, 000029, 'I001', 2, 2),
(41, 000030, 'I001', 2, 2),
(42, 000031, 'I001', 2, 2),
(43, 000032, 'I001', 2, 2),
(44, 000033, 'I001', 2, 2),
(45, 000034, 'I001', 2, 2),
(46, 000035, 'I001', 3, 3),
(47, 000036, 'I001', 2, 2),
(48, 000037, 'I001', 2, 2),
(49, 000038, 'I001', 2, 2),
(50, 000039, 'I002', 2, 2),
(51, 000040, 'I002', 3, 3),
(52, 000040, 'I003', 3, 3),
(53, 000041, 'I001', 2, 2),
(54, 000042, 'I001', 2, 2),
(55, 000043, 'I005', 3, 3),
(56, 000044, 'I008', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `borrow_table`
--

CREATE TABLE `borrow_table` (
  `borrow_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ref_user_id` int(10) NOT NULL,
  `borrow_date` text NOT NULL,
  `return_date` varchar(20) NOT NULL DEFAULT '-',
  `br_status` int(11) NOT NULL DEFAULT '1',
  `br_type` set('inclass','outclass','','') NOT NULL DEFAULT 'outclass'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borrow_table`
--

INSERT INTO `borrow_table` (`borrow_id`, `ref_user_id`, `borrow_date`, `return_date`, `br_status`, `br_type`) VALUES
(000028, 1234567883, '12-05-2017 15:41:24', '12-05-2017 15:46:20', 5, 'outclass'),
(000029, 1234567883, '12-05-2017 15:46:46', '12-05-2017 15:48:17', 5, 'outclass'),
(000030, 1234567883, '12-05-2017 15:49:37', '12-05-2017 15:50:48', 5, 'outclass'),
(000031, 1234567883, '12-05-2017 15:54:15', '12-05-2017 15:55:49', 5, 'outclass'),
(000032, 1234567883, '12-05-2017 15:56:53', '12-05-2017 15:59:15', 5, 'outclass'),
(000033, 1234567883, '12-05-2017 16:02:01', '12-05-2017 16:06:17', 5, 'outclass'),
(000034, 1234567883, '12-05-2017 16:10:08', '12-05-2017 16:11:03', 5, 'outclass'),
(000035, 1234567883, '12-05-2017 16:15:33', '12-05-2017 16:16:53', 5, 'outclass'),
(000036, 1234567883, '12-05-2017 16:30:21', '12-05-2017 16:32:44', 5, 'outclass'),
(000037, 1234567883, '12-05-2017 16:33:09', '12-05-2017 16:34:44', 5, 'outclass'),
(000038, 1234567883, '12-05-2017 17:10:58', '12-05-2017 17:17:31', 5, 'outclass'),
(000039, 1234567883, '12-05-2017 17:19:36', '12-05-2017 17:43:04', 5, 'outclass'),
(000040, 1234567883, '12-05-2017 17:44:28', '12-05-2017 17:45:14', 5, 'outclass'),
(000041, 1234567883, '12-05-2017 23:52:28', '01-04-2017 23:56:57', 5, 'outclass'),
(000042, 1234567883, '01-04-2017 23:55:06', '01-04-2017 23:57:04', 5, 'outclass'),
(000043, 1234567883, '13-05-2017 00:55:30', '13-05-2017 00:56:10', 5, 'outclass'),
(000044, 1234567883, '13-05-2017 01:23:56', '-', 1, 'outclass');

-- --------------------------------------------------------

--
-- Table structure for table `master_name_table`
--

CREATE TABLE `master_name_table` (
  `Master_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Master_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_name_table`
--

INSERT INTO `master_name_table` (`Master_id`, `Master_name`) VALUES
(00001, 'ครูนันทนา'),
(00002, 'ครูนัฐพงษ์'),
(00003, 'ครูชัยยุทธ'),
(00004, 'ครูธีระศักดิ์'),
(00005, 'ครูดำรง'),
(00006, 'ครูจิราพร');

-- --------------------------------------------------------

--
-- Table structure for table `sport_inventory`
--

CREATE TABLE `sport_inventory` (
  `item_id` varchar(20) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_img` varchar(50) NOT NULL,
  `item_all` int(10) NOT NULL,
  `item_total` int(10) NOT NULL,
  `item_bad` int(3) NOT NULL,
  `item_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sport_inventory`
--

INSERT INTO `sport_inventory` (`item_id`, `item_name`, `item_img`, `item_all`, `item_total`, `item_bad`, `item_type`) VALUES
('I001', 'วอลเลย์บอลล', 'ball1.jpg', 40, 40, 0, 1),
('I002', 'บาสเกสบอล', 'ball.jpg', 40, 37, 3, 1),
('I003', 'แชร์บอลบอล', 'chairball.jpg', 10, 8, 2, 1),
('I004', 'แบดมินตัน', 'bat.jpg', 20, 20, 0, 1),
('I005', 'ไม้เทนนิส', 'tennid.jpg', 20, 20, 0, 1),
('I006', 'ตระกร้า', 'takor.jpg', 30, 30, 0, 1),
('I007', 'ปิงปองง', '1.jpg', 25, 25, 0, 1),
('I008', 'กระบี่', '059620033.jpg', 100, 100, 0, 1),
('O001', 'ฟุตบอล', 'football.jpg', 35, 35, 0, 2),
('O002', 'ไม้กรีฑา', 'geeta.jpg', 15, 15, 0, 2),
('O003', 'เชือกชักกะเย่อ', 'chack.jpg', 5, 5, 0, 2),
('U001', 'ลูกขนไก่', 'lukkonkei.jpg', 80, 80, 0, 3),
('U002', 'ลูกปิงปอง', 'lukpingpong.jpg', 60, 60, 0, 3),
('U003', 'ลูกเทนนิส', 'luktennis.jpg', 60, 60, 0, 3),
('U004', 'ตระกร้า', 'taka.jpg', 10, 10, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sport_type`
--

CREATE TABLE `sport_type` (
  `sport_type_id` int(2) NOT NULL,
  `sport_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sport_type`
--

INSERT INTO `sport_type` (`sport_type_id`, `sport_type`) VALUES
(1, 'อุปกรณ์ในร่ม'),
(2, 'อุปกรณ์กลางแจ้ง'),
(3, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `status_type`
--

CREATE TABLE `status_type` (
  `status_id` int(2) NOT NULL,
  `status_msg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_type`
--

INSERT INTO `status_type` (`status_id`, `status_msg`) VALUES
(1, '<span style=''color:#ff9626;''>  รอการตรวจสอบ  </span>'),
(2, '<span style=''color:#33ea73;''>  รอรับของ  </span>'),
(3, '<span style=''color:red;''>  ยืมของแล้ว  </span>'),
(4, '<span style=''color:#ef9e1c;''> คืนไม่ครบ </span>'),
(5, '<span style=''color:#1bf969;''>  คืนแล้ว  </span>');

-- --------------------------------------------------------

--
-- Table structure for table `subjects_table`
--

CREATE TABLE `subjects_table` (
  `subjects` int(11) NOT NULL,
  `teach_day` int(1) NOT NULL,
  `ref_item_id` varchar(20) NOT NULL,
  `room` varchar(20) NOT NULL,
  `ref_master_id` int(5) NOT NULL,
  `class` int(2) NOT NULL,
  `sec` int(2) NOT NULL,
  `time_start` varchar(7) NOT NULL,
  `time_end` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects_table`
--

INSERT INTO `subjects_table` (`subjects`, `teach_day`, `ref_item_id`, `room`, `ref_master_id`, `class`, `sec`, `time_start`, `time_end`) VALUES
(1, 1, 'I008', '11051', 1, 6, 1, '08:00', '09:00'),
(2, 1, 'I004', '11021', 2, 1, 2, '10:00', '11:00'),
(3, 1, 'I006', '18011', 3, 4, 3, '13:00', '14:00'),
(4, 1, 'I006', '18011', 3, 4, 1, '15:00', '17:00'),
(5, 2, 'O001', 'สนามฟุตบอล', 3, 5, 3, '09:00', '10:00'),
(6, 2, 'I008', '11051', 1, 6, 2, '11:00', '12:00'),
(7, 2, 'I002', '30011', 5, 2, 3, '13:00', '14:00'),
(8, 2, 'I004', '11021', 2, 1, 3, '15:00', '17:00'),
(9, 3, 'I002', '30011', 5, 2, 1, '09:00', '10:00'),
(10, 3, 'O001', 'สนามฟุตบอล', 4, 5, 2, '10:00', '11:00'),
(11, 3, 'I001', '30012', 6, 3, 1, '15:00', '17:00'),
(12, 4, 'I004', '11021', 2, 1, 1, '08:00', '09:00'),
(13, 4, 'O001', 'สนามฟุตบอล', 4, 5, 1, '10:00', '11:00'),
(15, 4, 'I008', '11051', 1, 6, 3, '14:00', '15:00'),
(16, 4, 'I001', '30013', 6, 3, 3, '15:00', '17:00'),
(17, 5, 'I006', '18011', 3, 4, 2, '09:00', '10:00'),
(18, 5, 'I002', '30011', 5, 2, 2, '14:00', '15:00'),
(19, 5, 'I002', '30012', 6, 3, 2, '16:00', '17:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_acount`
--

CREATE TABLE `user_acount` (
  `sudent_id` int(10) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `class` int(2) NOT NULL,
  `sec` int(2) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `telephone` varchar(11) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_acount`
--

INSERT INTO `user_acount` (`sudent_id`, `fname`, `lname`, `email`, `class`, `sec`, `gender`, `username`, `password`, `telephone`, `user_type`) VALUES
(1234567883, 'สามารถ', 'ใจดี', 'sa@gmail.com', 2, 3, 'M', 'sa', 'sa', '0965333810', 1),
(1234567891, 'นาวิน', 'ภักดี', 'na@ge.com', 1, 1, 'M', 'www', 'www', '0897685431', 2),
(1234567893, 'วรวุฒ', 'อินทร์ดี', 'wo@hotmail.com', 1, 1, 'M', 'wo', 'wo', '0832768990', 1),
(2147483647, 'ดาราวดี', 'อินทร์ดี', 'dara@hotmail.com', 1, 1, 'F', 'admin', 'admin', '0955432178', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type` int(11) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type`, `type`) VALUES
(1, 'นักเรียน'),
(2, 'อาจารย์'),
(3, 'ผู้ดูแลระบบ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrow_detail`
--
ALTER TABLE `borrow_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `borrow_table`
--
ALTER TABLE `borrow_table`
  ADD PRIMARY KEY (`borrow_id`);

--
-- Indexes for table `master_name_table`
--
ALTER TABLE `master_name_table`
  ADD PRIMARY KEY (`Master_id`);

--
-- Indexes for table `sport_inventory`
--
ALTER TABLE `sport_inventory`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `status_type`
--
ALTER TABLE `status_type`
  ADD UNIQUE KEY `status_id` (`status_id`);

--
-- Indexes for table `subjects_table`
--
ALTER TABLE `subjects_table`
  ADD PRIMARY KEY (`subjects`);

--
-- Indexes for table `user_acount`
--
ALTER TABLE `user_acount`
  ADD PRIMARY KEY (`sudent_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow_detail`
--
ALTER TABLE `borrow_detail`
  MODIFY `detail_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `borrow_table`
--
ALTER TABLE `borrow_table`
  MODIFY `borrow_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `master_name_table`
--
ALTER TABLE `master_name_table`
  MODIFY `Master_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `subjects_table`
--
ALTER TABLE `subjects_table`
  MODIFY `subjects` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
