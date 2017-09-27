-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2017 at 09:25 PM
-- Server version: 5.7.14
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoppingcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `birth_certificate`
--

CREATE TABLE `birth_certificate` (
  `username` varchar(50) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `path` text,
  `hash` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `birth_certificate`
--

INSERT INTO `birth_certificate` (`username`, `type`, `path`, `hash`) VALUES
('firststudent', 1, 'pdf-doc', '123'),
('MarcoVanderEecken', 1, 'C:/wamp64/www/ShoppingCart/Birth-Cert/2017-08-10', '$2y$10$4Wd6AzQQPjv7bAUZKVm3ROkR/DaKeL5anChOqwZrTfaer/JI3uGW2.pdf'),
('KeaganWiltshire', 1, 'C:/wamp64/www/ShoppingCart/Birth-Cert/2017-08-10', '$2y$10$Iw2QFaVc0PYeogk/eJL4fO5mlFmAxCCPh.JgFHVtPhSYNCUKliDxK.pdf'),
('StefanoMontanari', 1, 'C:/wamp64/www/ShoppingCart/Birth-Cert/2017-08-10', '$2y$10$JSCfjlqgjg0H0bwmqK0OEOPbx2UfFox9PLpNSyaUddUJZ9.DN0sWa.pdf'),
('StefanoMontanari1', 1, 'C:/wamp64/www/ShoppingCart/Birth-Cert/2017-08-10', '$2y$10$zyjZfK2NuD3xjMtfB4hU5.5OtiFUzVbWt4YFI8gNEPYUi8ZpSHq22.pdf'),
('StudentNumber7', 1, 'C:/wamp64/www/ShoppingCart/Birth-Cert/2017-08-13', '$2y$10$fl2rLIV7WxQVor8ncM7M7.VXXi8W4MwrOWDXUZRGsCUUV5i.kEiC6.pdf'),
('KeaganWiltshire2017', 1, 'C:/wamp64/www/ShoppingCart/Birth-Cert/2017-08-15', '$2y$10$e52OrB6zkwLPXAROj6UpAObrnPXeTbUJJv8eK2fx37dMEcTURUqzS.pdf'),
('KyleWalker1994', 1, 'C:/wamp64/www/ShoppingCart/Birth-Cert/2017-08-21', '$2y$10$BBjI0i69EJ5d7hWBPlEHLeQwMNgyu46l8rGR0Znqs7yX8wOvjB16i.pdf'),
('WilhelmRothman2017', 1, 'C:/wamp64/www/ShoppingCart/Birth-Cert/2017-08-23', '$2y$10$ih7psR8XoVRufZ1jwCVJdeh3GMh7hnm6CGAy.XCcNG2newPyF7Q82.pdf'),
('asdasd2017', 1, 'C:/wamp64/www/ShoppingCart/Birth-Cert/2017-09-27', '$2y$10$nuegFHlhGiLTBmDGdwRFne7lkEqTHcXXaJ5wKSgAoI.gsVjVGS0Ry.pdf'),
('asdasd20171', 1, 'C:/wamp64/www/ShoppingCart/Birth-Cert/2017-09-27', '$2y$10$.Is5MXGnr4wS1BcfADqHauQrznFrR1A88deuH2D2Mx.l6KJA2tvru.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `event_description` varchar(255) DEFAULT NULL,
  `event_start` timestamp NULL DEFAULT NULL,
  `event_end` timestamp NULL DEFAULT NULL,
  `event_host` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `event_description`, `event_start`, `event_end`, `event_host`) VALUES
(1, 'the first event', '2017-09-27 16:33:00', '2017-10-10 16:33:00', 'dsk');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `ismale` tinyint(1) NOT NULL,
  `gender_description` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`ismale`, `gender_description`) VALUES
(0, 'Female'),
(1, 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE `item_type` (
  `item_type` int(11) NOT NULL,
  `item_extension` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`item_type`, `item_extension`) VALUES
(1, 'application/pdf');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(50) NOT NULL,
  `password` char(60) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `regdate` timestamp NULL DEFAULT NULL,
  `level` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `email`, `regdate`, `level`) VALUES
('user1', '$2y$10$PfB61Fn3WaUulqQ3O/ejceDSSqB1.U452hn28GvghSVAj996Oc962', 'user1@shoppingcart.com', '2017-07-14 20:27:45', 0),
('user2', '$2y$10$txUnV4CgjyzzRkEj83RUAOusvQ5gpDsxMpvbwPhm4T9FYQqj7m8rO', 'user2@shoppingcart.com', '2017-07-14 20:27:45', 1),
('user3', '$2y$10$sDPz0U.7aMKu0gz/T1ARXu.cRsp3RW/.pbrE6Uh2OqKuZf0hFDgsS', 'user3@shoppingcart.com', '2017-07-14 20:28:25', 1),
('user4', '$2y$10$ehZXKDNSWRn0i7JD2zgV3Od05rfdfF8TcmW.Vru7p9RKt8Or0uZ/q', 'user4@shoppingcart.com', '2017-07-14 20:28:25', 0),
('admin', '$2y$10$NybgdsWeqqjTBWMwRDAHbuxBJGWjhXHJslyCAdMnaHSmr.ugGDdPi', 'admin@shoppingcart.com', '2017-07-14 20:28:25', 2),
('bestTeacher', '$2y$10$/7L3lS.M22Ut.FaD80G1ouqQUnHjyifm8LnqKYL/O0BLq06j73CcW', 'best@teacher.com', '2017-08-11 18:06:49', 0),
('bestTeachers', '$2y$10$gC6LwQtRiQpUPvPabSQ.j.Le.tNafPeVdHN2.RLl1/oWOzY/Ye4LO', 'best@teacher.com', '2017-08-11 18:08:36', 0),
('anotherMod', '$2y$10$KhGGRlh0N.2YYNMN9SfJxeLdgfEdO9wkMDaXM.nbBDrD87b.yVP/O', 'anotherMod@sportsday.com', '2017-08-19 11:31:47', 0),
('ATeacher', '$2y$10$ake/5kn6vouQbkcm7sMUDudbPcq4Q61/yR1kCq7OI16QrbL.46qoW', 'ateacher@sportsday.com', '2017-08-21 17:25:58', 0),
('aModerator', '$2y$10$Xl7a9VLLJs1EQChl5tWzHOU5K1FJw/xARD2s5HsjVKhPlKTzj30ya', 'aModerator@sportsday.com', '2017-08-21 17:26:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loginlevel`
--

CREATE TABLE `loginlevel` (
  `level` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginlevel`
--

INSERT INTO `loginlevel` (`level`, `description`) VALUES
(0, 'Normal user'),
(1, 'Moderator'),
(2, 'Admin'),
(0, 'Normal user'),
(1, 'Moderator'),
(2, 'Admin'),
(0, 'Normal user'),
(1, 'Moderator'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productDescription` text,
  `productStock` int(11) DEFAULT NULL,
  `productPrice` decimal(6,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productDescription`, `productStock`, `productPrice`) VALUES
(1, 'Product1', 'This is the first product ever.', 1, '5.00'),
(2, 'Product2', 'This is the second product ever.', 10, '3.88'),
(3, 'Product3', 'This is the third product ever.', 2, '1800.25'),
(37, 'test1000', 'again', 10, '10.00'),
(50, 'testAgain', 'America first image, should be a productId.type image', 111, '10.00'),
(57, 'Achim', 'Buy an achim', 1, '1.00'),
(58, 'OneMeg', 'Item with one meg limit', 12, '12.00'),
(59, 'OneSevenMeg', '123', 1, '12.00'),
(54, 'Product 51', 'Better back up', 10000, '1.00'),
(55, 'Product 55', 'test ', 12, '1.00'),
(56, 'Pathalen', 'Pathalen is a failure', 1, '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `productimage`
--

CREATE TABLE `productimage` (
  `productID` int(11) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `imagePath` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productimage`
--

INSERT INTO `productimage` (`productID`, `imageName`, `imagePath`) VALUES
(37, '37.png', 'images/products/'),
(57, '57.jpg', 'images/products/'),
(50, '50.jpg', 'images/products/'),
(54, '54.jpg', 'images/products/'),
(55, '55.jpg', 'images/products/'),
(3, '3.jpg', 'images/products/'),
(1, '1.jpg', 'images/products/'),
(2, '2.jpg', 'images/products/'),
(56, '56.jpg', 'images/products/');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `recordID` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `record` varchar(50) DEFAULT NULL,
  `approved` int(11) DEFAULT '0',
  `recordDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recordEvent` int(11) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`recordID`, `username`, `sport_id`, `record`, `approved`, `recordDate`, `recordEvent`) VALUES
(1, 'firststudent', 1, '10', 2, '2017-08-11 19:05:38', 1),
(2, 'secondstudent', 1, '8', 2, '2017-08-11 19:05:38', 1),
(3, 'firststudent', 2, '190', 2, '2017-08-11 19:05:38', 1),
(4, 'secondstudent', 2, '201', 2, '2017-08-11 19:05:38', 1),
(5, 'MarcoVanderEecken', 2, '330', 2, '2017-08-11 19:05:38', 1),
(6, 'MarcoVanderEecken', 1, '2000', 2, '2017-08-11 19:05:38', 1),
(7, 'MarcoVanderEecken', 1, '2', 2, '2017-08-11 19:05:38', 1),
(8, 'firststudent', 1, '12', 2, '2017-08-11 19:05:38', 1),
(9, 'firststudent', 1, '2', 2, '2017-08-11 00:00:00', 1),
(10, 'firststudent', 1, '10', 2, '2017-08-13 14:06:08', 1),
(11, 'KeaganWiltshire', 3, '200', 2, '2017-08-14 00:00:00', 1),
(12, 'StefanoMontanari', 3, '12', 2, '2017-08-14 00:00:00', 1),
(13, 'KeaganWiltshire2017', 1, '3200', 2, '2017-08-14 00:00:00', 1),
(14, 'firststudent', 3, '23123213', 2, '2017-08-15 00:00:00', 1),
(15, 'firststudent', 1, '10', 2, '2017-07-01 00:00:00', 1),
(16, 'WilhelmRothman2017', 1, '12', 2, '2017-08-23 00:00:00', 1),
(17, 'asdasd2017', 3, '123', 0, '2017-09-27 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `recordstatus`
--

CREATE TABLE `recordstatus` (
  `status` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recordstatus`
--

INSERT INTO `recordstatus` (`status`, `description`) VALUES
(1, 'Waiting for approval'),
(2, 'Approved'),
(-1, 'Declined');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `abr` varchar(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`abr`, `name`) VALUES
('DSK', 'Deutsche Schule Kapstadt'),
('MHS', 'Milnerton High School'),
('TVHS', 'Table View High School'),
('AISCT', 'American International School of Cape Town'),
('St. CS', 'St. Cyprian\'s School'),
('St. GGS', 'St. George\'s Grammar School'),
('CTHS', 'Cape Town High School'),
('HJvR', 'HoÃ«rskool Jan van Riebeeck'),
('ts', 'The School');

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

CREATE TABLE `sport` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `unit` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sport`
--

INSERT INTO `sport` (`id`, `type`, `unit`) VALUES
(1, '80m Sprint', 'second'),
(2, '1000m Long Distance', 'second'),
(3, 'Long Jump', 'meter'),
(4, 'High Jump', 'meter');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `username` varchar(50) NOT NULL,
  `school` varchar(10) DEFAULT NULL,
  `fname` text,
  `sname` text,
  `birth_year` timestamp NULL DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`username`, `school`, `fname`, `sname`, `birth_year`, `gender`) VALUES
('firststudent', 'dsk', 'First', 'Student', '2017-08-07 14:45:21', 1),
('secondstudent', 'mhs', 'Second', 'Student', '2008-08-07 15:24:50', 1),
('MarcoVanderEecken', 'dsk', 'Marco', 'Van der Eecken', '2017-08-09 22:00:00', 1),
('KeaganWiltshire', 'mhs', 'Keagan', 'Wiltshire', '2001-10-22 22:00:00', 1),
('StefanoMontanari', 'mhs', 'Stefano', 'Montanari', '2017-06-09 22:00:00', 1),
('StefanoMontanari1', 'mhs', 'Stefano', 'Montanari', '2017-06-09 22:00:00', 1),
('StudentNumber7', 'mhs', 'Student', 'Number 7', '2015-12-28 22:00:00', 1),
('KeaganWiltshire2017', 'MHS', 'Keagan', 'Wiltshire', '2017-08-13 22:00:00', 1),
('KyleWalker1994', 'HJvR', 'Kyle', 'Walker', '1994-03-15 22:00:00', 1),
('WilhelmRothman2017', 'HJvR', 'Wilhelm', 'Rothman', '2017-08-22 22:00:00', 1),
('asdasd2017', 'AISCT', 'asd', 'asd', '2017-09-26 22:00:00', 0),
('asdasd20171', 'AISCT', 'asd', 'asd', '2017-09-26 22:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `description`) VALUES
(1, 'application/pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `birth_certificate`
--
ALTER TABLE `birth_certificate`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`ismale`);

--
-- Indexes for table `item_type`
--
ALTER TABLE `item_type`
  ADD PRIMARY KEY (`item_type`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`),
  ADD KEY `level` (`level`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `productimage`
--
ALTER TABLE `productimage`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`recordID`),
  ADD KEY `username` (`username`),
  ADD KEY `sport_id` (`sport_id`),
  ADD KEY `approval_constraint` (`approved`),
  ADD KEY `record_event_event_id_fk` (`recordEvent`);

--
-- Indexes for table `recordstatus`
--
ALTER TABLE `recordstatus`
  ADD PRIMARY KEY (`status`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`abr`);

--
-- Indexes for table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`username`),
  ADD KEY `student_gender_ismale_fk` (`gender`),
  ADD KEY `student_school_abr_fk` (`school`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `description` (`description`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `item_type`
--
ALTER TABLE `item_type`
  MODIFY `item_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `recordID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `recordstatus`
--
ALTER TABLE `recordstatus`
  MODIFY `status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
