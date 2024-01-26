-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2023 at 01:26 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `5yndrome`
--

-- --------------------------------------------------------

--
-- Table structure for table `invdetails`
--

CREATE TABLE `invdetails` (
  `InvNo` int(20) NOT NULL,
  `ItemID` int(50) NOT NULL,
  `Qty` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invdetails`
--

INSERT INTO `invdetails` (`InvNo`, `ItemID`, `Qty`) VALUES
(1, 20, 1),
(1, 31, 1),
(2, 31, 2),
(3, 28, 2),
(3, 31, 1),
(4, 22, 1),
(4, 31, 2),
(5, 29, 1),
(6, 26, 1),
(6, 30, 1),
(7, 21, 1),
(7, 26, 1),
(7, 30, 1),
(8, 28, 2);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `InvNo` int(11) NOT NULL,
  `SalesDate` date NOT NULL,
  `UserID` int(50) NOT NULL,
  `ServiceID` int(11) NOT NULL,
  `PaymentID` int(11) NOT NULL,
  `PickUpDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`InvNo`, `SalesDate`, `UserID`, `ServiceID`, `PaymentID`, `PickUpDate`) VALUES
(1, '2023-04-01', 7, 2, 1, '2023-04-01'),
(2, '2023-05-08', 8, 3, 2, '2023-05-09'),
(3, '2023-05-24', 9, 1, 2, '2023-05-24'),
(4, '2023-06-01', 10, 2, 1, '2023-06-03'),
(5, '2023-06-12', 9, 2, 2, '2023-06-12'),
(6, '2023-06-20', 8, 1, 2, '2023-06-21'),
(7, '2023-06-20', 7, 2, 1, '2023-06-21'),
(8, '2023-06-22', 9, 2, 3, '2023-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ItemID` int(50) NOT NULL,
  `ItemName` varchar(300) NOT NULL,
  `ItemDes` text NOT NULL,
  `ItemPrice` int(50) NOT NULL,
  `ItemPhoto` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ItemID`, `ItemName`, `ItemDes`, `ItemPrice`, `ItemPhoto`) VALUES
(20, 'Wash & Dry (S)', 'The most basic laundry with washing and drying your clothes! It is suitable for people who have small load of laundry.', 16, 'dry.jpg'),
(21, 'Wash & Dry (M)', 'The most basic laundry with washing and drying your clothes! It is suitable for people who have medium load of laundry.', 20, 'dry.jpg'),
(22, 'Wash & Dry (L)', 'The most basic laundry with washing and drying your clothes! It is suitable for people who have huge load of laundry.', 30, 'dry.jpg'),
(23, 'Wash, Dry & Fold (S)', 'Folding clothes at your service! We offer a handy help for you to complete your task. Folding small load of clothes ONLY.', 19, 'fold.jpg'),
(26, 'Wash, Dry & Fold (M)', 'Folding clothes at your service! We offer a handy help for you to complete your task. Folding MEDIUM load of clothes ONLY.', 28, 'fold.jpg'),
(28, 'Wash, Dry & Fold (L)', 'Folding clothes at your service! We offer a handy help for you to complete your task. Folding BIG load of clothes ONLY.', 46, 'fold.jpg'),
(29, 'Wash, Dry, Fold & Iron (S)', 'A full complete set of laundry from cleaning to ironing; prevent wrinkles appearance on your clothes! It only for SMALL load', 27, 'iron.jpg'),
(30, 'Wash, Dry, Fold & Iron (M)', 'A full complete set of laundry from cleaning to ironing; prevent wrinkles appearance on your clothes! It only for MEDIUM load', 36, 'iron.jpg'),
(31, 'Wash, Dry, Fold & Iron (L)', 'A full complete set of laundry from cleaning to ironing; prevent wrinkles appearance on your clothes! It only for LARGE load', 54, 'iron.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `paymethod`
--

CREATE TABLE `paymethod` (
  `PaymentID` int(11) NOT NULL,
  `PaymentName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymethod`
--

INSERT INTO `paymethod` (`PaymentID`, `PaymentName`) VALUES
(1, 'Online Banking'),
(2, 'Cash On Delivery'),
(3, 'Credit Card');

-- --------------------------------------------------------

--
-- Table structure for table `servicemethod`
--

CREATE TABLE `servicemethod` (
  `ServiceID` int(11) NOT NULL,
  `ServiceName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servicemethod`
--

INSERT INTO `servicemethod` (`ServiceID`, `ServiceName`) VALUES
(1, 'Pick Up'),
(2, 'Delivery'),
(3, 'Pick Up + Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserType` int(1) NOT NULL,
  `Email` varchar(300) NOT NULL,
  `Name` varchar(300) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Address` varchar(300) NOT NULL,
  `PhoneNum` varchar(20) NOT NULL,
  `Password` varchar(300) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserType`, `Email`, `Name`, `DateOfBirth`, `Address`, `PhoneNum`, `Password`) VALUES
(7, 0, 'scoups@svt.com', 'Choi Seung Cheol', '2023-05-01', '7, addresss, you state, korea, 41200, earth', '+60123123123', 'saythename'),
(8, 0, 'rkive@rm.com', 'Kim Nam Joon', '2016-02-02', 'asdfghjklasdasdasd', '0123456789', 'bangtan777'),
(9, 0, 'badboybloo@gmail.com', 'Kim Hyeon-ung', '1994-10-12', 'bla bla bla', '0122225478', 'badboyy'),
(10, 0, 'charlesleclerc@gmail.com', 'Charles Leclerc', '1997-10-16', 'Monaco, Monaco', '123456987', 'forzaff'),
(11, 1, '5yndrome@email.com', '5yndrome', '0000-00-00', '', '', '5yndrome'),
(14, 0, 'hayley@gmail.com', 'Hayley', '0000-00-00', '', '', 'e98f147e4871236bafba57853c55f622'),
(15, 0, 'jack@gmail.com', 'Jack', '0000-00-00', '', '', 'b73bbf4a7605fb419f1be11b51d8e557');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invdetails`
--
ALTER TABLE `invdetails`
  ADD PRIMARY KEY (`InvNo`,`ItemID`),
  ADD KEY `ItemID` (`ItemID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`InvNo`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `ServiceMethod` (`ServiceID`),
  ADD KEY `PayMethod` (`PaymentID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `paymethod`
--
ALTER TABLE `paymethod`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `servicemethod`
--
ALTER TABLE `servicemethod`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `InvNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ItemID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invdetails`
--
ALTER TABLE `invdetails`
  ADD CONSTRAINT `invdetails_ibfk_1` FOREIGN KEY (`InvNo`) REFERENCES `invoices` (`InvNo`),
  ADD CONSTRAINT `invdetails_ibfk_2` FOREIGN KEY (`ItemID`) REFERENCES `items` (`ItemID`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`ServiceID`) REFERENCES `servicemethod` (`ServiceID`),
  ADD CONSTRAINT `invoices_ibfk_3` FOREIGN KEY (`PaymentID`) REFERENCES `paymethod` (`PaymentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
