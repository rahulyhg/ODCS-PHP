-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2016 at 07:52 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `odcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `allusers`
--

CREATE TABLE IF NOT EXISTS `allusers` (
  `fname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `pass` varchar(200) NOT NULL,
  `actp` varchar(200) NOT NULL,
  `uid` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allusers`
--

INSERT INTO `allusers` (`fname`, `email`, `username`, `pass`, `actp`, `uid`) VALUES
('Gokul G', 'igokul95@gmail.com', 'gokul', '009', 'Doctor', '3a7587dba3700d51d0d2ec8b2b1e383d'),
('Don Berchmans', 'dberchmans@gmail.', 'sasi', '1000', 'Patient', '53461116aff0ae0bdb695a4549e4cbe7'),
('Mathew PC', 'mathew@gmail.com', 'mathew', '009', 'Doctor', '57bf6acfcd8d6795f569f5abafe42ddd'),
('Don Berchman', 'don@doninator.om', 'don', '009', 'Doctor', '6f9c2d4b9f0ee3727a0be3a82e8bce28'),
('Ajay Tom', 'ajay@mqi.m', 'ajay', '009', 'Patient', '75d9b36bd770ecec38dbaa2e71e36d8b'),
('lee', 'LET', 'me', '009009009', 'Patient', 'a3ef305111539b655d86b116c4deeb84'),
('Amesh S', 'ameshs@gmail.com', 'amesh', '009', 'Patient', 'ebda36bbf1c66c3d2905a5254d56ea79'),
('Sebin P Johnson', '0o.sebin.o0@gmail.com', 'sebinpj', '009', 'Doctor', 'ec574824f3f6e631cd2ed110381508df');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE IF NOT EXISTS `bill` (
  `tid` varchar(767) NOT NULL,
  `gid` varchar(767) NOT NULL,
  `balance` int(200) NOT NULL,
  `pid` varchar(767) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `cid` varchar(200) NOT NULL,
  `mid` varchar(200) NOT NULL,
  `msg` longtext NOT NULL,
  `no` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE IF NOT EXISTS `conversations` (
  `message` longtext NOT NULL,
  `subject` text NOT NULL,
  `cid` varchar(200) NOT NULL,
  `pid` text NOT NULL,
  `did` text NOT NULL,
  `status` text NOT NULL,
  `adoc` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `uid` varchar(767) NOT NULL,
  `address` varchar(767) NOT NULL,
  `gender` varchar(767) NOT NULL,
  `experiance` varchar(767) NOT NULL,
  `contact` varchar(767) NOT NULL,
  `hospital` varchar(767) NOT NULL,
  `Qualification` varchar(767) NOT NULL,
  `speciality` varchar(767) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`uid`, `address`, `gender`, `experiance`, `contact`, `hospital`, `Qualification`, `speciality`) VALUES
('57bf6acfcd8d6795f569f5abafe42ddd', 'Tharavad Hs', 'Male', '1', '9898758565', 'Mammen Chengannur', 'MBBS', 'Homeopath'),
('57bf6acfcd8d6795f569f5abafe42ddd', 'Tharavad Hs', 'Male', '1', '9898758565', 'Mammen Chengannur', 'MBBS', 'sexologist'),
('6f9c2d4b9f0ee3727a0be3a82e8bce28', 'Tharavad', 'Male', '0', '8281777853', 'Century', 'MBBS', 'Homeopath'),
('6f9c2d4b9f0ee3727a0be3a82e8bce28', 'Tharavad', 'Male', '0', '8281777853', 'Century', 'MBBS', 'ayurveda'),
('3a7587dba3700d51d0d2ec8b2b1e383d', 'testttts', 'Male', '2', '2', '3', '55', 'asdf'),
('3a7587dba3700d51d0d2ec8b2b1e383d', 'testttts', 'Male', '2', '2', '3', '55', 'asd'),
('ec574824f3f6e631cd2ed110381508df', 'derpante', 'Male', '12', '845565545', 'df', 'dzf', 'state'),
('ec574824f3f6e631cd2ed110381508df', 'derpante', 'Male', '12', '845565545', 'df', 'dzf', 'india');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `fid` text NOT NULL,
  `cid` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `address` text NOT NULL,
  `gender` varchar(200) NOT NULL,
  `height` int(200) NOT NULL,
  `weight` int(200) NOT NULL,
  `dob` varchar(200) NOT NULL,
  `uid` varchar(767) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`address`, `gender`, `height`, `weight`, `dob`, `uid`) VALUES
('asfsfadf', 'Male', 180, 80, '21/01/2009', '53461116aff0ae0bdb695a4549e4cbe7'),
('Tharavad ,\r\naalthara jn,\r\nchengannuur\r\nkerala,689121', 'Male', 180, 80, '09/02/1995', '75d9b36bd770ecec38dbaa2e71e36d8b'),
('vghgh', 'Male', 150, 22, '19/03/2015', 'a3ef305111539b655d86b116c4deeb84'),
('redtatat', 'Male', 152, 152, '19/07/1995', 'ebda36bbf1c66c3d2905a5254d56ea79');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE IF NOT EXISTS `prescription` (
  `prid` varchar(767) NOT NULL,
  `did` varchar(767) NOT NULL,
  `pid` varchar(767) NOT NULL,
  `pre` text NOT NULL,
  `pno` varchar(767) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cid` varchar(767) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `did` varchar(767) NOT NULL,
  `pid` varchar(767) NOT NULL,
  `rate` int(200) NOT NULL,
  `msg` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allusers`
--
ALTER TABLE `allusers`
  ADD PRIMARY KEY (`uid`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`time`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`uid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
