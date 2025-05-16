-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2023 at 12:15 PM
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
-- Database: `farmersmarketdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`) VALUES
(1, 'Admin ', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `area-id` int(11) NOT NULL,
  `area-name` varchar(150) NOT NULL,
  `area-address` text NOT NULL,
  `city-id` int(11) NOT NULL,
  `state-id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`area-id`, `area-name`, `area-address`, `city-id`, `state-id`) VALUES
(1, 'R K', '', 1, 1),
(2, 'CBS', '', 3, 2),
(3, 'C R', '', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT 1,
  `Price` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cartlist`
--

CREATE TABLE `cartlist` (
  `CartList` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `CartCreatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `create-at` datetime NOT NULL DEFAULT current_timestamp(),
  `update-at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`, `Description`, `create-at`, `update-at`) VALUES
(1, 'Khad', '', '2023-12-25 15:36:33', '2023-12-25 15:36:33'),
(2, 'Seeds', '', '2023-12-25 15:36:51', '2023-12-25 15:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `CheckoutID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL,
  `CheckoutDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `PaymentMethod` varchar(255) DEFAULT NULL,
  `TransactionID` varchar(255) DEFAULT NULL,
  `Status` enum('Pending','Completed','Failed') DEFAULT 'Pending',
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city-id` int(11) NOT NULL,
  `city-name` varchar(75) NOT NULL,
  `state-id` int(11) NOT NULL,
  `city-created-date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city-id`, `city-name`, `state-id`, `city-created-date`) VALUES
(1, 'Nashik', 1, '2023-12-25 15:34:59'),
(2, 'Pune', 1, '2023-12-25 15:35:10'),
(3, 'Surat', 2, '2023-12-25 15:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OrderDetailID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `ProductPAT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`OrderDetailID`, `OrderID`, `ProductID`, `Quantity`, `ProductPAT`) VALUES
(1, 1, 2, 2, 600),
(2, 2, 3, 3, 500),
(3, 2, 4, 2, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `ordertable`
--

CREATE TABLE `ordertable` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `ShopID` int(11) DEFAULT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordertable`
--

INSERT INTO `ordertable` (`OrderID`, `UserID`, `ShopID`, `OrderDate`) VALUES
(1, 1, 2, '2023-12-25 10:45:39'),
(2, 1, 1, '2023-12-25 10:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Price` int(10) NOT NULL,
  `StockQuantity` int(11) NOT NULL,
  `ImageURL` varchar(255) DEFAULT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ShopID` int(11) NOT NULL,
  `Productstateus` enum('novarify','varify','blocked','') NOT NULL DEFAULT 'novarify'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `Description`, `Price`, `StockQuantity`, `ImageURL`, `CategoryID`, `CreatedAt`, `UpdatedAt`, `ShopID`, `Productstateus`) VALUES
(1, 'Uria', 'Urea, the diamide of carbonic acid. Its formula is H2NCONH2. Urea has important uses as a fertilizer and feed supplement, as well as a starting material for the manufacture of plastics and drugs. It is a colourless, crystalline substance that melts at 132.7° C (271° F) and decomposes before boiling.\r\n\r\nUrea is the chief nitrogenous end product of the metabolic breakdown of proteins in all mammals and some fishes. The material occurs not only in the urine of all mammals but also in their blood, bile, milk, and perspiration. In the course of the breakdown of proteins, amino groups (NH2) are removed from the amino acids that partly comprise proteins. These amino groups are converted to ammonia (NH3), which is toxic to the body and thus must be converted to urea by the liver. The urea then passes to the kidneys and is eventually excreted in the urine.', 300, 5000, '65895653f3bf36.45991044.jpg', 1, '2023-12-25 10:15:47', '2023-12-25 10:36:05', 2, 'varify'),
(2, 'soil charger', 'In the realm of agriculture, a groundbreaking initiative is underway to fortify soil fertility and provide balanced nutrition for plants. This innovative technology aims to bolster the resilience of plants against diseases by imparting active and organic mineral support. A key focus lies in the development of robust root networks and lush leaf canopies. The project operates on a 24-hour communication platform, leveraging mediums such as WhatsApp, YouTube, and Facebook to facilitate constant guidance from experts and successful farmers. Education is at the forefront, with scientific explanations accompanying each treatment, disseminated through farmer meets and seminars based on their demand.', 600, 49998, '658959adabddf8.46728008.png', 1, '2023-12-25 10:30:05', '2023-12-25 10:45:39', 2, 'varify'),
(3, 'Root charger', 'In the realm of agriculture, a groundbreaking initiative is underway to fortify soil fertility and provide balanced nutrition for plants. This innovative technology aims to bolster the resilience of plants against diseases by imparting active and organic mineral support. A key focus lies in the development of robust root networks and lush leaf canopies. The project operates on a 24-hour communication platform, leveraging mediums such as WhatsApp, YouTube, and Facebook to facilitate constant guidance from experts and successful farmers. Education is at the forefront, with scientific explanations accompanying each treatment, disseminated through farmer meets and seminars based on their demand.', 500, 59997, '65895a04be0918.30909797.png', 1, '2023-12-25 10:31:32', '2023-12-25 10:46:08', 1, 'varify'),
(4, 'Basmati Rice Seeds', 'Green World Pusa Basmati 1509 seeds for farming | Basmati seeds for cultivation -1509 Variety (1 Kg, Seeds)', 6000, 79998, '65895a86d5a1e2.24605363.jpg', 2, '2023-12-25 10:33:42', '2023-12-25 10:46:08', 1, 'varify'),
(5, 'soybean seeds bag', 'Established as a Proprietor firm in the year 2002 at Surat (Gujarat, India), we are a leading Wholesale Trader of a wide range of Fresh Vegetables ,Organic Species, Fresh Fruit, etc. We procure these products from the most trusted and renowned vendors after stringent market analysis. Further, we offer these products at reasonable rates and deliver these within the promised time-frame. Under the headship of (Proprietor), we have gained a huge clientele across the nation.', 7000, 10200, '65895b033b70b0.09392080.jpg', 2, '2023-12-25 10:35:47', '2023-12-25 10:36:15', 3, 'varify');

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `ShopID` int(11) NOT NULL,
  `ShopName` varchar(255) DEFAULT NULL,
  `ShopEmail` varchar(255) DEFAULT NULL,
  `ShopPhone` varchar(20) DEFAULT NULL,
  `ShopAddress` int(255) DEFAULT NULL,
  `AadhaarCardNumber` varchar(20) DEFAULT NULL,
  `UpdateAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DateJoined` date DEFAULT current_timestamp(),
  `Shoppassword` varchar(50) NOT NULL,
  `ShopGSTNumber` varchar(15) DEFAULT NULL,
  `ShopOwnerName` varchar(150) NOT NULL,
  `Shopstatus` enum('novarify','varify','blocked') NOT NULL DEFAULT 'novarify'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`ShopID`, `ShopName`, `ShopEmail`, `ShopPhone`, `ShopAddress`, `AadhaarCardNumber`, `UpdateAt`, `DateJoined`, `Shoppassword`, `ShopGSTNumber`, `ShopOwnerName`, `Shopstatus`) VALUES
(1, 'Mayur Farm Product', 'mayur@gmail.com', '8888144573', 1, NULL, '2023-12-25 10:11:32', '2023-12-25', 'mayur', NULL, 'Mayur', 'varify'),
(2, 'Omker Farm Product', 'omker@gmail.com', '8888144682', 3, NULL, '2023-12-25 10:11:36', '2023-12-25', 'omker', NULL, 'Omker', 'varify'),
(3, 'Jon Farm Product', 'jon@gmail.com', '8888144352', 2, NULL, '2023-12-25 10:11:39', '2023-12-25', 'jon', NULL, 'Jon', 'varify');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state-id` int(11) NOT NULL,
  `state-name` varchar(75) NOT NULL,
  `state-created-date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state-id`, `state-name`, `state-created-date`) VALUES
(1, 'Maharashtra', '2023-12-25 15:34:47'),
(2, 'Gujarat', '2023-12-25 15:34:52');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `UserID` int(11) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `EmailID` varchar(255) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`UserID`, `FullName`, `EmailID`, `PhoneNumber`, `Address`, `Password`, `CreatedAt`) VALUES
(1, 'adi', 'adi@gmail.com', '9921188421', 'Nashik , Maharashtra', '1234', '2023-12-25 10:40:26'),
(2, 'Nayan', 'nayan@gmail.com', '9921188420', 'Nashik , Maharashtra', '1234', '2023-12-25 10:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `ContactNumber` varchar(20) DEFAULT NULL,
  `RegistrationDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area-id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`);

--
-- Indexes for table `cartlist`
--
ALTER TABLE `cartlist`
  ADD PRIMARY KEY (`CartList`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`CheckoutID`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city-id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`OrderDetailID`);

--
-- Indexes for table `ordertable`
--
ALTER TABLE `ordertable`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`ShopID`),
  ADD UNIQUE KEY `ShopGSTNumber` (`ShopGSTNumber`),
  ADD UNIQUE KEY `uc_SellerEmail` (`ShopEmail`),
  ADD UNIQUE KEY `uc_AadhaarCardNumber` (`AadhaarCardNumber`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state-id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `EmailID` (`EmailID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `area-id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cartlist`
--
ALTER TABLE `cartlist`
  MODIFY `CartList` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `CheckoutID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city-id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `OrderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ordertable`
--
ALTER TABLE `ordertable`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `ShopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state-id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
