-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 04, 2018 at 09:40 PM
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
-- Database: `vacationMaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `activity_name` varchar(50) NOT NULL,
  `activity_description` varchar(5000) NOT NULL,
  `activity_location` varchar(50) NOT NULL,
  `activity_image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `category_id`, `activity_name`, `activity_description`, `activity_location`, `activity_image`) VALUES
(1, 1, 'Bungee Jumping the Grand Canyon', 'Bungee jump into the vast beauty of the grand canyon.', 'Grand Canyon National Park, Arizona', 'https://i.ytimg.com/vi/rj05FFE4ll0/maxresdefault.jpg'),
(2, 2, 'Scuba Diving Chernobyl', 'Go scuba diving in the waters of Chernobyl. See some three eyed fish and maybe get some super powers!!!', 'Chernobyl, Ukraine', 'https://static.independent.co.uk/s3fs-public/styles/article_small/public/thumbnails/image/2017/01/23/14/gettyimages-72450926.jpg'),
(3, 3, 'Climbing Mount Rushmore', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'bungee jumping'),
(2, 'scuba diving'),
(3, 'rock climbing');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `event_subname` varchar(50) NOT NULL,
  `event_start_date` date NOT NULL,
  `event_end_date` date NOT NULL,
  `price_per_person` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `package_id`, `event_subname`, `event_start_date`, `event_end_date`, `price_per_person`) VALUES
(1, 1, '1 day 1 night', '2018-04-18', '2018-04-19', 500),
(2, 1, 'A week\'s worth of falls.', '2018-04-18', '2018-04-25', 2500),
(3, 3, 'A week\'s worth of falls.', '2018-04-18', '2018-04-25', 2000),
(4, 4, 'The tourist', '2018-04-29', '2018-04-30', 750);

-- --------------------------------------------------------

--
-- Table structure for table `lodge`
--

CREATE TABLE `lodge` (
  `lodge_id` int(11) NOT NULL,
  `lodge_name` varchar(50) NOT NULL,
  `lodge_description` varchar(5000) NOT NULL,
  `lodge_address` varchar(150) NOT NULL,
  `lodge_image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lodge`
--

INSERT INTO `lodge` (`lodge_id`, `lodge_name`, `lodge_description`, `lodge_address`, `lodge_image`) VALUES
(1, 'no lodging', '', '', 'http://www.ubookstore.com/c.4487126/ubs-vinson/img/no_image_available.jpeg?resizeid=2&resizeh=1200&resizew=1200'),
(2, 'The Golden Donkey', 'A ranch style hotel decorated with memorabilia from the Grand Canyon.', 'Tusayan, Arizona', 'https://i0.wp.com/takemytrip.com/images/550x_co_DSC03007_adj.jpg?resize=550%2C367'),
(3, 'Radiation Shack', 'Made from a renovated bus you\'ll feel as at home here as spiderman\'s spiders do.', 'Chernobyl, Ukraine', 'https://chernobyl-city.com/images/mod_news/427/3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `lodge_id` int(11) NOT NULL,
  `package_name` varchar(50) NOT NULL,
  `package_description` varchar(500) NOT NULL,
  `package_minimum` int(3) NOT NULL,
  `package_maximum` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `activity_id`, `lodge_id`, `package_name`, `package_description`, `package_minimum`, `package_maximum`) VALUES
(1, 1, 2, 'The Lone Man\'s Plummet', 'A solo bungee jumping experience down the majestic Grand Canyon. Includes lodging.', 1, 1),
(2, 1, 1, 'The Lone Man\'s Plummet', 'A solo bungee jumping experience down the majestic Grand Canyon. Does not include lodging.', 1, 1),
(3, 1, 2, 'The Suicide Pact', 'This package is great for groups that want to fall to their deaths without actually dying! Includes lodging.', 2, 8),
(4, 2, 3, 'The Aquaman', 'A lone trip to scuba dive the waters of Chernobyl.', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `lodge`
--
ALTER TABLE `lodge`
  ADD PRIMARY KEY (`lodge_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lodge`
--
ALTER TABLE `lodge`
  MODIFY `lodge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
