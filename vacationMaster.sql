-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2018 at 07:05 AM
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
(3, 3, 'Climbing Mount Rushmore', 'Come face to face with the great presidents. Literally!!!', 'Keystone, South Dakota', 'https://assets0.roadtrippers.com/uploads/poi_gallery_image/image/319729483/-quality_60_-interlace_Plane_-resize_1024x480_U__-gravity_center_-extent_1024x480/poi_gallery_image-image-18bd4313-d3b8-4e15-95d4-1fccce4a3b28.jpg'),
(4, 1, 'Bungee Jumping the Empire State Building', 'Bungee jump from one of the most iconic New York icons. Just don\'t drop any pennies!', 'New York, New York', 'http://i.dailymail.co.uk/i/pix/2014/06/27/article-2671644-1F2B935600000578-654_634x851.jpg'),
(5, 2, 'Scuba Diving the Ruins of Atlantic City', 'Explore the under water ruins of Atlantic City that was lost to the effects of global warming decades ago.', 'Atoll, New Jersey', 'https://www.telegraph.co.uk/content/dam/Travel/leadAssets/33/41/shipwreck-mediterr_3341568a-xlarge.jpg');

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
(4, 4, 'The Tour', '2018-04-29', '2018-04-30', 750),
(5, 5, 'The Lecture', '2018-05-16', '2018-04-20', 600),
(6, 6, 'The Overnight Overthrow', '2018-06-13', '2018-06-14', 1250),
(7, 7, 'The Run Off', '2018-07-04', '2018-07-08', 900),
(8, 8, 'The Mutated Fireflies', '2018-08-08', '2018-08-10', 400),
(9, 10, 'A Farewell to Summer', '2018-09-19', '2018-04-20', 450),
(10, 9, 'The Filibuster', '2018-06-13', '2018-06-21', 1100),
(11, 11, 'Halloween Blast', '2018-10-31', '2018-11-01', 600),
(12, 12, 'Thanks for the Falls', '2018-11-19', '2018-11-23', 375),
(13, 13, 'The Ace', '2073-09-12', '2073-09-19', 500),
(14, 14, 'Full House', '2073-04-27', '2073-04-30', 400);

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
(3, 'Radiation Shack', 'Made from a renovated bus you\'ll feel as at home here as spiderman\'s spiders do.', 'Chernobyl, Ukraine', 'https://chernobyl-city.com/images/mod_news/427/3.jpg'),
(4, 'The Stovepipe Hat', 'Known for our signature giant stovepipe hat. Come stay the night and try to get a look at the inside of someone\'s head.', 'Keystone, South Dakota', 'http://www.roadarch.com/13/8/pomhat.jpg'),
(5, 'The Empire State Building, Nap Floor', 'Many people know about the Empire State Building but what a lot of people don\'t know is that it has a whole floor just for napping! After obtaining special permission the building\'s owner has agreed to let people stay overnight on the napping floor with reservations.', 'New York, New York', 'https://untappedcities-wpengine.netdna-ssl.com/wp-content/uploads/2013/06/20041017_naps_lg.jpg');

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
(1, 1, 2, 'Lone Man\'s Plummet Package', 'A solo bungee jumping experience down the majestic Grand Canyon. Includes lodging.', 1, 1),
(2, 1, 1, 'Lone Man\'s Plummet Package (lodging not included)', 'A solo bungee jumping experience down the majestic Grand Canyon. Does not include lodging.', 1, 1),
(3, 1, 2, 'Suicide Pact Package', 'This package is great for groups that want to fall to their deaths without actually dying! Includes lodging.', 2, 8),
(4, 2, 3, 'Aquaman Package', 'A lone trip to scuba dive the waters of Chernobyl.', 1, 1),
(5, 2, 3, 'School Trip Package', 'This isn\'t your ordinary school. Come join host a special class in the schools of fish with all your friends.', 2, 7),
(6, 3, 4, 'Dictator Package', 'On this solo trip to Mount Rushmore you\'ll explore the beautiful views as you climb the faces of greatness.', 1, 1),
(7, 3, 4, 'Democracy Package', 'Have the time of your lives as you and your party climb to the top of political greatness.', 2, 5),
(8, 2, 1, 'Camper Package (lodging not included)', 'Although most prefer the comfort of home being provided we know others prefer to find their own way. Enjoy your scuba diving and then find your own way whether its to a hotel or just to the local woods to camp out.', 1, 4),
(9, 3, 1, 'Lost in Nature Package (lodging not included)', 'Enjoy the gorgeous scenery of Mount Rushmore as you climb its face. And when your done either pack up and go home, to a hotel you\'ve booked or just stay right out in nature.', 1, 5),
(10, 4, 5, 'Penny Package', 'A solo bungee jump down the face of the Empire State Building.', 1, 1),
(11, 4, 5, 'Nickel Package', 'Enjoy bungee jumping with all your friends in this package.', 2, 5),
(12, 4, 1, 'Dime Package (lodging not included)', 'Enjoy bungee jumping with a large number of people. However due to the large number of people lodging is not included.', 6, 10),
(13, 5, 1, 'High Card Package (lodging not included)', 'Explore the under water ruins with no one to hinder your expedition.', 1, 1),
(14, 5, 1, 'Pairs Package (lodging not included)', 'Whether with just that someone special or the whole family. This under water exploration is fun for everyone.', 2, 4);

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
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `lodge`
--
ALTER TABLE `lodge`
  MODIFY `lodge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
