-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 14, 2019 at 10:54 PM
-- Server version: 5.5.57-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `midterm`
--

-- --------------------------------------------------------

--
-- Table structure for table `mp_codes`
--

CREATE TABLE `mp_codes` (
  `codeId` tinyint(4) NOT NULL,
  `promoCode` varchar(10) NOT NULL,
  `discount` tinyint(4) NOT NULL,
  `expirationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mp_codes`
--

INSERT INTO `mp_codes` (`codeId`, `promoCode`, `discount`, `expirationDate`) VALUES
(1, 'halfPrice', 50, '2019-05-31'),
(2, 'sunny', 25, '2019-05-30'),
(3, 'take50', 50, '2019-05-31'),
(4, 'sand', 25, '2019-04-30'),
(5, 'summer30', 30, '2019-05-24'),
(6, 'sandals', 30, '2019-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `mp_product`
--

CREATE TABLE `mp_product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productDescription` varchar(500) NOT NULL,
  `productImage` varchar(500) DEFAULT NULL,
  `productPrice` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mp_product`
--

INSERT INTO `mp_product` (`productId`, `productName`, `productDescription`, `productImage`, `productPrice`) VALUES
(1, 'Lenovo ideapad', 'Lenovo ideapad 330 15.6\" Laptop, Windows 10, Intel Celeron N4000 Dual-Core Processor, 4GB RAM, 1TB Hard Drive - Plum Purple', 'https://i5.walmartimages.com/asr/1ff89e48-f337-4db0-8e79-0cb9241e53fc_1.adadeddcebd391cd77674b51115f0c94.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '229.00'),
(2, 'Apple iPad Pro', 'Apple 10.5-inch iPad Pro Wi-Fi 64GB Gold', 'https://i5.walmartimages.com/asr/bd785e91-c2f1-4bbd-bf48-33338317cf81_1.d797bbe458786d2a8ea385dbaa0a3081.jpeg?odnHeight=450&odnWidth=450&odnBg=FFFFFF', '570.99'),
(3, 'Tickle Me Elmo', 'Playskool Friends Sesame Street Tickle Me Elmo', 'https://i5.walmartimages.com/asr/178554d0-a564-4413-85dd-0472e0d08b8e_1.c681da5fb244ec3b6fb9963a22b87612.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '19.45'),
(4, 'iPhone X', 'Straight Talk Apple iPhone X 64GB, Prepaid Smartphone, Space Gray', 'https://i5.walmartimages.com/asr/1c7e3080-da80-4ce8-a0fa-073d9c3a0580_1.41b0c0f35e248393a3984baa605b524b.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '899.00'),
(5, 'Acer CB3', 'Chrome OS, Intel Celeron N3060 Dual-Core Processor, 2GB RAM, 16GB Internal Storage', 'https://i5.walmartimages.com/asr/f3077845-8786-4bfa-ba98-482f06af91a2_1.2bdade6ddc986cbd875304164a98aa06.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '199.00'),
(6, 'My Pal Scout', 'LeapFrog My Pal Scout', 'https://i5.walmartimages.com/asr/ebb8604a-328e-41db-8d9d-fa52b23eb3db_1.256773940176c93c62a5eee959759578.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '14.29'),
(7, 'HP Stream', 'HP Stream 14\" Laptop, Windows 10 Home, Office 365 Personal 1-year included, Intel Celeron N3060 Processor, 4GB RAM, 32GB eMMC Storage', 'https://i5.walmartimages.com/asr/e269955d-0406-497c-ba3c-1e5f75866789_1.5c9fe380b4ed308e7ab058570235f711.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '254.46'),
(8, 'Apple Pencil', 'Multi-touch subsystem', 'https://i5.walmartimages.com/asr/43e89bcf-0109-4dca-be4c-327e4360397f_1.654c9f461e84feee0b7a6c0b955802f5.jpeg?odnHeight=450&odnWidth=450&odnBg=FFFFFF', '95.00'),
(9, 'Grand Theft Auto V', 'Rockstar Games, PlayStation 4', 'https://i5.walmartimages.com/asr/ae8894e1-e85f-4260-892c-934bc9a780ca_1.5c2be588c5fe33763f6581f831b5b3f1.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '27.98'),
(10, 'HP Desktop PC ', ' \r\nHP Desktop PC Tower System Windows 10 Intel Core 2 Duo 2.13GHz Processor 4GB Ram 80GB Hard Drive DVD-RW Wifi with a 17\" LCD and Keyboard and Mouse-Refurbished Computer', 'https://i5.walmartimages.com/asr/7bd6cf84-93a7-4885-aaaa-f63423528424_1.d0268b64b5fbf3d8315dce8a515ba18a.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '107.00'),
(11, 'Minnie Mouse', 'Disney Baby Musical Crawling Pals Plush - Minnie Mouse', 'https://i5.walmartimages.com/asr/f4a7000d-2e07-4ab0-b6c5-3a40dde11dd9_1.d3813d67a85ae9d220633dde336ce6cf.jpeg?odnHeight=100&odnWidth=100&odnBg=ffffff', '19.97'),
(12, 'Plush Mickey', 'Disney Clubhouse Fun Talking 11\" Plush Mickey', 'https://i5.walmartimages.com/asr/83837e48-5716-4819-95e8-4d30466f3c0c_1.35d223d4f53ee90a83c09135559ff41d.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '15.38'),
(13, 'Super Smash Bros', 'Nintendo, Nintendo Wii U, 045496903404', 'https://i5.walmartimages.com/asr/4c3fc777-e296-4af1-8870-c2b7a510256f_1.70430a06cc169ee1f0d22100eb94b41e.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '53.50'),
(14, 'HP Slim 270-p043w', 'HP Slim 270-p043w DesktopTower, Intel Core i3-7100 Processor, 8GB Memory, 1TB Hard Drive, Wireless Keyboard and Mouse, Windows 10', 'https://i5.walmartimages.com/asr/9119a973-1311-4efe-a722-14f287930d36_2.886242f7be537421ee6aa577a0f08562.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '349.00'),
(15, 'SAMSUNG Chromebook', 'SAMSUNG Chromebook 3 11.6\" Intel Celeron, 16GB eMMC Storage 4GB Memory - XE500C13-K04US', 'https://i5.walmartimages.com/asr/6026cac4-e047-4280-b469-b4d8dc95a5ac_1.4bee899459cddd7997ba905430b3d179.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '700.00'),
(16, 'The Peanuts Movie ', 'VUDU Instawatch Included', 'https://i5.walmartimages.com/asr/b992e5eb-8ae5-4519-90cd-ad657f42f8fb_1.0e76aa490314dc53d2cf6753e7a1898e.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '9.96'),
(17, 'Wonder', 'good book!', 'https://i5.walmartimages.com/asr/a43107ad-c189-4501-b9a6-771e888c8562_1.70f055397731f39dea5a4e91cea0c0ef.jpeg?odnHeight=100&odnWidth=100&odnBg=FFFFFF', '10.19'),
(18, 'PS4 Pro', 'Good ps4', 'https://i5.walmartimages.com/asr/33de3a32-863c-4457-9cce-1fb65036d73c_1.93c6433ebb65dc7ef7d0a3d30dee21fc.jpeg?odnHeight=450&odnWidth=450&odnBg=FFFFFF', '479.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mp_codes`
--
ALTER TABLE `mp_codes`
  ADD PRIMARY KEY (`codeId`);

--
-- Indexes for table `mp_product`
--
ALTER TABLE `mp_product`
  ADD PRIMARY KEY (`productId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mp_codes`
--
ALTER TABLE `mp_codes`
  MODIFY `codeId` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mp_product`
--
ALTER TABLE `mp_product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
