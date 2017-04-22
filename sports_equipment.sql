-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2017 at 10:45 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

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
-- Table structure for table `sport_inventory`
--

CREATE TABLE `sport_inventory` (
  `item_id` varchar(20) NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_img` varchar(50) NOT NULL,
  `item_all` int(10) NOT NULL,
  `item_total` int(10) NOT NULL,
  `item_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sport_inventory`
--

INSERT INTO `sport_inventory` (`item_id`, `item_name`, `item_img`, `item_all`, `item_total`, `item_type`) VALUES
('76', 'ee', '1.jpg', -1, -1, 2),
('ew', 'ee', '1.jpg', -1, -1, 2),
('I001', 'วอลเลย์บอลล', 'ball1.jpg', 30, 0, 1),
('I002', 'บาสเกสบอล', 'ball.jpg', 40, 40, 1),
('I003', 'แชร์บอลบอล', 'chairball.jpg', 10, 10, 1),
('I004', 'แบดมินตัน', 'bat.jpg', 20, 20, 1),
('I005', 'ไม้เทนนิส', 'tennid.jpg', 20, 20, 1),
('I006', 'ตระกร้า', 'takor.jpg', 30, 30, 1),
('I007', 'ปิงปองง', '1.jpg', 28, 25, 1),
('O001', 'ฟุตบอล', 'football.jpg', 35, 35, 2),
('O002', 'ไม้กรีฑา', 'geeta.jpg', 15, 15, 2),
('O003', 'เชือกชักกะเย่อ', 'chack.jpg', 5, 5, 2),
('U001', 'ลูกขนไก่', 'lukkonkei.jpg', 80, 80, 3),
('U002', 'ลูกปิงปอง', 'lukpingpong.jpg', 60, 60, 3),
('U003', 'ลูกเทนนิส', 'luktennis.jpg', 60, 60, 3),
('U004', 'ตระกร้า', 'taka.jpg', 10, 10, 3);

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
(0, '', '', '', 1, 1, '', '', '', '', 1),
(1234567883, 'สามารถ', 'ใจดี', 'sa@gmail.com', 2, 3, 'M', 'sa', 'sa', '0965333810', 1),
(1234567891, 'นาวิน', 'ภักดี', 'na@ge.com', 1, 1, 'M', 'na', 'na', '0897685431', 1),
(1234567892, 'เรไร', 'น้อยคำแพง', 'ra@gmail.com', 2, 3, 'F', 'ra', 'ra', '0967512334', 1),
(1234567893, 'วรวุฒ', 'อินทร์ดี', 'wo@hotmail.com', 0, 0, 'M', 'wo', 'wo', '0832768990', 2),
(1234567894, 'กรกนก', 'พรพรรณ', 'ka@gmail.com', 3, 1, 'F', 'ka', 'ka', '0875641190', 1),
(1234567895, 'ลัดดาวัลย์', 'การาม', 'rad@hotmail.com', 1, 1, 'F', 'rad', 'rad', '0897631542', 1),
(1234567896, 'กาญจณี', 'สังขาล', 'kan@gmail.com', 3, 3, 'F', 'kan', 'kan', '0887961200', 1),
(1234567897, 'ปทุม', 'เด่นคุณ', 'pa@gmail.com', 5, 1, 'F', 'pa', 'pa', '0865437611', 1),
(1234567898, 'เด่นชัย', 'มาตนอก', 'din@hotmail.com', 2, 2, 'M', 'din', 'din', '0985643895', 1),
(2147483647, 'ดาราวดี', 'อินทร์ดี', 'dara@hotmail.com', 1, 1, 'F', 'admin', 'admin', '0955432178', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sport_inventory`
--
ALTER TABLE `sport_inventory`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `user_acount`
--
ALTER TABLE `user_acount`
  ADD PRIMARY KEY (`sudent_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
