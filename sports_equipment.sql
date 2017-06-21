-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2017 at 08:49 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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

-- --------------------------------------------------------

--
-- Table structure for table `borrow_table`
--

CREATE TABLE `borrow_table` (
  `borrow_id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `ref_user_id` varchar(10) NOT NULL,
  `borrow_date` text NOT NULL,
  `return_date` varchar(20) NOT NULL DEFAULT '-',
  `br_status` int(11) NOT NULL DEFAULT '1',
  `br_type` set('inclass','outclass','','') NOT NULL DEFAULT 'outclass'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Table structure for table `request_item_table`
--

CREATE TABLE `request_item_table` (
  `request_id` int(10) NOT NULL,
  `item_type` int(2) NOT NULL,
  `request_content` text NOT NULL,
  `user_id_ref` int(10) NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `request_item_table`
--

INSERT INTO `request_item_table` (`request_id`, `item_type`, `request_content`, `user_id_ref`, `date`) VALUES
(2, 1, 'ต้องการลูกบอลเยอะๆครับ', 1234567883, '16-05-2017 17:07:50'),
(3, 1, 'เอาบาส\nเอาลูกบอล\nเอาห่วงยาง', 1234567883, '16-05-2017 17:28:23'),
(4, 1, 'อยากได้ลูกปิงปองเพิ่ม', 1234567883, '16-05-2017 12:40:45'),
(5, 2, 'อยากได้ลูกเปตองใหม่', 1234567883, '21-05-2017 07:40:17'),
(6, 2, 'ืเัะ่ะ่ะ่ัะั่ะั่', 1234567883, '27-05-2017 10:47:06'),
(7, 2, 'อยากได้ลูกฟุตบอลเพิ่ม 40 ลูก', 23, '30-05-2017 07:54:53');

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
('I001', 'วอลเลย์บอลล2', 'ball1.jpg', 40, 28, 0, 1),
('I002', 'บาสเกสบอล', 'ball.jpg', 40, 40, 3, 1),
('I003', 'แชร์บอลบอล', 'chairball.jpg', 10, 10, 3, 1),
('I004', 'แบดมินตัน', 'bat.jpg', 20, 20, 0, 1),
('I005', 'ไม้เทนนิส', 'tennid.jpg', 20, 20, 0, 1),
('I006', 'ตระกร้า', 'takor.jpg', 30, 30, 0, 1),
('I007', 'ปิงปองง', '1.jpg', 25, 25, 1, 1),
('I008', 'กระบี่', '059620033.jpg', 100, 100, 1, 1),
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
(1, '<span style=\'color:#ff9626;\'>  รอการตรวจสอบ  </span>'),
(2, '<span style=\'color:#33ea73;\'>  รอรับของ  </span>'),
(3, '<span style=\'color:red;\'>  ยืมของแล้ว  </span>'),
(4, '<span style=\'color:#ef9e1c;\'> คืนไม่ครบ </span>'),
(5, '<span style=\'color:#1bf969;\'>  คืนแล้ว  </span>');

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
  `sudent_id` varchar(10) NOT NULL,
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
-- Indexes for table `request_item_table`
--
ALTER TABLE `request_item_table`
  ADD PRIMARY KEY (`request_id`);

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
  MODIFY `detail_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `borrow_table`
--
ALTER TABLE `borrow_table`
  MODIFY `borrow_id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `master_name_table`
--
ALTER TABLE `master_name_table`
  MODIFY `Master_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `request_item_table`
--
ALTER TABLE `request_item_table`
  MODIFY `request_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `subjects_table`
--
ALTER TABLE `subjects_table`
  MODIFY `subjects` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
