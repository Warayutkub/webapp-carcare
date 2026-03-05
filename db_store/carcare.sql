-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2026 at 08:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carcare`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customerName` varchar(30) DEFAULT NULL,
  `customerSurname` varchar(30) DEFAULT NULL,
  `customerPhone` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customerName`, `customerSurname`, `customerPhone`) VALUES
(1, 'กุเอง', 'แหละ', '0949843969'),
(2, 'Panyapon', 'Sookparnee', '1122334451');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `bankAcc` varchar(16) DEFAULT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `idCard` varchar(13) DEFAULT NULL,
  `roleId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `bankAcc`, `tel`, `address`, `birth`, `idCard`, `roleId`) VALUES
(1, 'สมชาย ใจดี', 'somchai@gmail.com', '1234567890', '0891111111', 'ชลบุรี', '1995-05-10', '1103701234567', 1),
(2, 'วิชัย พรมทอง', 'wichai@gmail.com', '2345678901', '0892222222', 'ศรีราชา', '1998-08-21', '1103702345678', 2),
(3, 'อนันต์ ศรีสุข', 'anan@gmail.com', '3456789012', '0893333333', 'บางแสน', '1993-02-14', '1103703456789', 2),
(4, 'ธีรพล ดีมาก', 'teerapol@gmail.com', '4567890123', '0894444444', 'พัทยา', '1997-11-30', '1103704567890', 3),
(5, 'กิตติพงษ์ รุ่งเรือง', 'kitti@gmail.com', '5678901234', '0895555555', 'ระยอง', '1996-07-18', '1103705678901', 2),
(6, 'ณัฐพล แสงทอง', 'nattapon@gmail.com', '6789012345', '0896666666', 'ศรีราชา', '1994-03-22', '1103706789012', 2),
(7, 'ปกรณ์ ศรีชัย', 'pakorn@gmail.com', '7890123456', '0897777777', 'พัทยา', '1992-09-11', '1103707890123', 2),
(8, 'ธีรภัทร วงศ์ดี', 'teerapat@gmail.com', '8901234567', '0898888888', 'บางละมุง', '1999-01-05', '1103708901234', 3),
(9, 'ศุภชัย ใจเย็น', 'supachai@gmail.com', '9012345678', '0899999999', 'ชลบุรี', '1995-12-19', '1103709012345', 2),
(10, 'วรพล มั่นคง', 'worapon@gmail.com', '1122334455', '0881111111', 'ระยอง', '1996-04-27', '1103710123456', 2),
(11, 'ธนกร บุญมี', 'thanakorn@gmail.com', '2233445566', '0882222222', 'ศรีราชา', '1993-07-14', '1103711234567', 3),
(12, 'จิรายุ สายทอง', 'jirayu@gmail.com', '3344556677', '0883333333', 'พัทยา', '1998-10-02', '1103712345678', 2),
(13, 'กฤษณะ วัฒนะ', 'kritsana@gmail.com', '4455667788', '0884444444', 'บางแสน', '1991-06-09', '1103713456789', 2),
(14, 'ภานุพงศ์ แก้วดี', 'panu@gmail.com', '5566778899', '0885555555', 'ชลบุรี', '1997-08-25', '1103714567890', 3),
(15, 'ชาญชัย รุ่งโรจน์', 'chanchai@gmail.com', '6677889900', '0886666666', 'ระยอง', '1994-11-13', '1103715678901', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `carType` int(11) DEFAULT NULL,
  `modelCar` varchar(255) DEFAULT NULL,
  `orderDate` date DEFAULT NULL,
  `employeeId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customerId`, `carType`, `modelCar`, `orderDate`, `employeeId`) VALUES
(1, NULL, NULL, 'ซิ่ง 251', NULL, NULL),
(2, NULL, NULL, '4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `serviceDetail` varchar(255) DEFAULT NULL,
  `serviceTypeid` varchar(4) DEFAULT NULL,
  `orderId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payMethod` int(11) DEFAULT NULL,
  `payDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `salary`) VALUES
(1, 'ผู้จัดการ', NULL),
(2, 'พนักงานล้างรถ', NULL),
(3, 'แคชเชียร์', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `servicetype`
--

CREATE TABLE `servicetype` (
  `servicetypeId` varchar(4) NOT NULL,
  `servicetypeName` varchar(255) DEFAULT NULL,
  `servicetypePrice` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `servicetype`
--

INSERT INTO `servicetype` (`servicetypeId`, `servicetypeName`, `servicetypePrice`) VALUES
('0001', 'ล้างสีดูดฝุ่น', '฿250'),
('0002', 'เคลือบแก้ว', '฿3500'),
('0003', 'ดูดฝุ่นภายใน', '฿200'),
('0004', 'ขัดสีรถ', '฿1200'),
('0005', 'เคลือบสี', '฿800'),
('0006', 'ล้างห้องเครื่อง', '฿500'),
('0007', 'เคลือบเบาะหนัง', '฿700'),
('0008', 'อบโอโซนฆ่าเชื้อ', '฿300'),
('0009', 'ล้างรถด่วน', '฿100'),
('0010', 'ล้างรถ + ดูดฝุ่น', '฿250'),
('0011', 'เคลือบแก้วเต็มระบบ', '฿4500'),
('0012', 'เคลือบกระจกกันน้ำ', '฿400'),
('0013', 'เคลือบยางรถ', '฿150'),
('0014', 'เคลือบพลาสติกภายนอก', '฿350'),
('0015', 'ขัดลบรอยขีดข่วน', '฿900'),
('0016', 'ขัดเคลือบสีพรีเมียม', '฿1800'),
('0017', 'ซักพรมภายในรถ', '฿600'),
('0018', 'ซักเบาะผ้า', '฿700'),
('0019', 'ทำความสะอาดคอนโซล', '฿300'),
('0020', 'เคลือบไฟหน้า', '฿500');

-- --------------------------------------------------------

--
-- Table structure for table `type_car`
--

CREATE TABLE `type_car` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_car`
--

INSERT INTO `type_car` (`id`, `name`) VALUES
(1, 'รถเก๋ง'),
(2, 'รถกระบะ'),
(3, 'รถ SUV'),
(4, 'รถตู้'),
(5, 'รถสปอร์ต'),
(6, 'รถมอเตอร์ไซค์');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roleId` (`roleId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `carType` (`carType`),
  ADD KEY `employeeId` (`employeeId`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `serviceTypeid` (`serviceTypeid`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `payMethod` (`payMethod`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicetype`
--
ALTER TABLE `servicetype`
  ADD PRIMARY KEY (`servicetypeId`);

--
-- Indexes for table `type_car`
--
ALTER TABLE `type_car`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_car`
--
ALTER TABLE `type_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`carType`) REFERENCES `type_car` (`id`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`employeeId`) REFERENCES `employee` (`id`);

--
-- Constraints for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD CONSTRAINT `orders_detail_ibfk_1` FOREIGN KEY (`serviceTypeid`) REFERENCES `servicetype` (`servicetypeId`),
  ADD CONSTRAINT `orders_detail_ibfk_2` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`payMethod`) REFERENCES `payment_method` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
