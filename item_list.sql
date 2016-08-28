-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 20, 2016 at 05:29 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `transaction`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_list`
--

CREATE TABLE IF NOT EXISTS `item_list` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `ITEM` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `item_list`
--

INSERT INTO `item_list` (`id`, `ITEM`) VALUES
(1, 'apple'),
(2, 'avocado'),
(3, 'banana'),
(4, 'beer'),
(5, 'bbq sauce'),
(6, 'bread'),
(7, 'beacon'),
(8, 'baby shampoo'),
(9, 'black label'),
(10, 'buff'),
(11, 'brocolli'),
(12, 'cookies'),
(13, 'coca cola'),
(14, 'club soda'),
(15, 'chip dip'),
(16, 'cinnamon'),
(17, 'chicken'),
(18, 'carrot'),
(19, 'cigarette'),
(20, 'coriander'),
(21, 'canddle'),
(22, 'cabbage'),
(23, 'capsicum'),
(24, 'cucumber'),
(25, 'chocolate'),
(26, 'coffee'),
(27, 'cauli flower'),
(28, 'diaper'),
(29, 'dog food'),
(30, 'dairy milk'),
(31, 'egg'),
(32, 'fanta'),
(33, 'frozen momo'),
(34, 'fish'),
(35, 'grapes'),
(36, 'granola bars'),
(37, 'garlic'),
(38, 'ginger'),
(39, 'green garlic'),
(40, 'green chilly'),
(41, 'green peas'),
(42, 'hot dogs'),
(43, 'honey'),
(44, 'ice cream'),
(45, 'real juice'),
(46, 'khukuri rum'),
(47, 'kiwi'),
(48, 'lettuce'),
(49, 'lemon'),
(50, 'lady finger'),
(51, 'milk'),
(52, 'mutton'),
(53, 'mushroom'),
(54, 'napkin'),
(55, 'nuts'),
(56, 'onion'),
(57, 'potato chips'),
(58, 'popcorn'),
(59, 'prawn'),
(60, 'potato'),
(61, 'pumpkin green'),
(62, 'pudina'),
(63, 'papaya'),
(64, 'pineapple'),
(65, 'royal stag'),
(66, 'red wine'),
(67, 'ruslan vodka'),
(68, 'radish'),
(69, 'sake'),
(70, 'shampoo'),
(71, 'shaving cream'),
(72, 'sausage'),
(73, 'steak'),
(74, 'shrimp'),
(75, 'sugar'),
(76, 'spinach'),
(77, 'sprite'),
(78, 'soda'),
(79, 'tuna'),
(80, 'tofu'),
(81, 'tomatoes'),
(82, 'tea'),
(83, 'tooth pick'),
(84, 'tooth paste'),
(85, 'tooth brush'),
(86, 'vegetable oil'),
(87, 'vinegar'),
(88, 'vim baar'),
(89, 'wai wai'),
(90, 'whipped cream'),
(91, 'white wine'),
(92, 'water melon');
