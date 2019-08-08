-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2019 at 01:28 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `question` varchar(100) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `firstname`, `lastname`, `question`, `answer`, `photo`, `created_on`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', '', '', '', '', '0000-00-00'),
(2, 'admin1', '21232f297a57a5a743894a0e4a801fc3', '', '', '', '', '', '0000-00-00'),
(4, 'employee', 'fa5473530e4d1a5a1e1eb53d2fedb10c', '', '', '', '', '', '0000-00-00'),
(5, 'assd', '40b114b04ce020d26ccdc8fe28add240', '', '', '', '', '', '0000-00-00'),
(6, 'bobo', 'ca2cd2bcc63c4d7c8725577442073dde', '', '', '', '', '', '0000-00-00'),
(7, 'asjsi', '827ccb0eea8a706c4c34a16891f84e7b', '', '', 'What is your favorite food?', 'adobo', '', '0000-00-00'),
(8, 'zsff', '32e17e3b85e2f5db814d583e201c6f4f', '', '', 'What is your favorite food?', 'chi', '', '0000-00-00'),
(9, 'tenten', '1e48c4420b7073bc11916c6c1de226bb', '', '', 'What is your favorite food?', 'adobo', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` time NOT NULL,
  `status` int(1) NOT NULL,
  `break1_in` time DEFAULT NULL,
  `break1_out` time DEFAULT NULL,
  `break2_in` time DEFAULT NULL,
  `break2_out` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `status_out` int(1) DEFAULT NULL,
  `num_hr` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `date`, `time_in`, `status`, `break1_in`, `break1_out`, `break2_in`, `break2_out`, `time_out`, `status_out`, `num_hr`) VALUES
(1, 2, '2019-05-01', '09:00:00', 1, '12:00:00', '13:00:00', '14:00:00', '14:25:00', '19:00:00', 1, 3.1),
(2, 2, '2019-05-02', '10:00:00', 0, '12:00:00', '13:00:00', '01:00:00', '01:00:00', '19:00:00', 1, 4.0833333333333),
(3, 2, '2019-05-03', '09:00:00', 1, '12:00:00', '13:00:00', '01:00:00', '01:00:00', '21:00:00', 0, 9),
(41, 1, '2019-06-07', '10:13:00', 0, '10:13:19', NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `id` int(10) NOT NULL,
  `batch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`id`, `batch`) VALUES
(1, 'March 2019- April 2019'),
(2, 'January 2019 - February 2019'),
(3, 'November 2018- December 2018'),
(4, 'September 2018- October 2018'),
(5, 'October 2018- November 2018'),
(6, 'August 2018- September 2018'),
(7, 'June 2018- July 2018');

-- --------------------------------------------------------

--
-- Table structure for table `campaign`
--

CREATE TABLE `campaign` (
  `id` int(10) NOT NULL,
  `campaign_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaign`
--

INSERT INTO `campaign` (`id`, `campaign_name`) VALUES
(1, 'Jollibee'),
(2, 'Bon Chon'),
(3, 'Amber'),
(4, 'Chowking'),
(5, 'Toyota'),
(6, 'PLDT'),
(7, 'Smart');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `campaign_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `sq` varchar(100) DEFAULT NULL,
  `ans` text NOT NULL,
  `created_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `firstname`, `lastname`, `password`, `campaign_id`, `batch_id`, `position_id`, `schedule_id`, `photo`, `sq`, `ans`, `created_on`) VALUES
(1, 'AG201901', 'Test ', 'Agent', '5a105e8b9d40e1329780d62ea2265d8a', 1, 1, 4, 2, '', 'What is your favorite food?', 'adobo', '2019-05-31'),
(2, 'AG201902', 'Celine ', 'Cendona', '11cb8bae9fb1e6f805746093e0b474d9', 2, 2, 4, 2, '', NULL, '', '2019-05-31'),
(3, 'AG201903', 'Sam ', 'De Guzman', '55439127904e06cf80c3e171978df24b', 2, 2, 4, 2, '', NULL, '', '2019-05-31'),
(4, 'AG201904', 'May', 'Tantiongco', '9a4b6f884971dcb4a5172876b335baab', 1, 1, 2, 2, '', NULL, '', '2019-05-31'),
(5, 'AG201905', 'Amabelle', 'Dela Cruz', 'e292b1d68c8b480c49074ff1b6e266b8', 1, 1, 2, 2, '', NULL, '', '2019-05-31'),
(6, 'AG201906', 'Allan', 'Castillo', 'b993e4526238d62f6b1b90e605532ff8', 4, 1, 4, 3, '', NULL, '', '2019-05-31'),
(7, 'AG201907', 'Benjie', 'Lazaro', '0251b39964ec5ab1c849e016f43b4243', 5, 7, 1, 2, '', NULL, '', '2019-05-31'),
(8, 'AG201908', 'Reniel', 'Biton', 'dad3c38314f73aa7084f094f3fc2d580', 5, 6, 4, 2, '', NULL, '', '2019-05-31'),
(9, 'AG201909', 'Patrick ', 'Plantado', '7852341745c93238222a65a910d1dcc5', 1, 2, 4, 4, '', NULL, '', '2019-05-31'),
(10, 'AG201910', 'Jerald ', 'Reyes', '958a74a4695ec722416c949165fd7c50', 4, 2, 3, 2, '', NULL, '', '2019-05-31'),
(11, 'AG201911', 'Jayson', 'Meneses', '826b5dfb7301552b44e555677318a0cd', 4, 2, 4, 4, '', NULL, '', '2019-05-31'),
(12, 'AG201912', 'Alex', 'Ramirez', '534b44a19bf18d20b71ecc4eb77c572f', 4, 2, 4, 4, '', NULL, '', '2019-05-31'),
(13, 'AG201913', 'Princess', 'Pascua', '84e576a38922e4459d15cdc16b83f337', 4, 2, 4, 4, '', NULL, '', '2019-05-31'),
(14, 'AG201914', 'Sheryl', 'Ogalesco', '9eb0d040ef57f4a06759cf307b657918', 4, 2, 4, 2, '', NULL, '', '2019-05-31'),
(15, 'AG201915', 'Jayvee', 'Manalo', 'baba327d241746ee0829e7e88117d4d5', 4, 2, 4, 2, '', NULL, '', '2019-05-31'),
(16, 'AG201916', 'Jeniffer', 'Reyes', '958a74a4695ec722416c949165fd7c50', 4, 2, 4, 2, '', NULL, '', '2019-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `late`
--

CREATE TABLE `late` (
  `late_id` int(11) NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `mins_late` double NOT NULL,
  `date_late` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `late`
--

INSERT INTO `late` (`late_id`, `emp_id`, `mins_late`, `date_late`) VALUES
(1, '1', 18, '2019-05-01'),
(2, '1', 30, '2019-05-03'),
(4, '3', 5, '2019-05-01'),
(5, '1', 19, '2019-05-05'),
(6, '4', 36, '2019-05-08'),
(7, '6', 1073, '2019-05-18'),
(8, '6', 476, '2019-05-20'),
(9, '6', 975, '2019-05-23'),
(10, '3', 679, '2019-05-23'),
(11, '1', 740, '2019-05-23'),
(12, '6', 1096, '2019-05-27'),
(13, '2', 60, '2019-05-02'),
(14, '1', 419, '2019-06-06'),
(15, '1', 421, '2019-06-06'),
(16, '1', 423, '2019-06-06'),
(17, '1', 432, '2019-06-06'),
(18, '1', 703, '2019-06-06'),
(19, '1', 708, '2019-06-06'),
(20, '1', 710, '2019-06-06'),
(21, '1', 733, '2019-06-06'),
(22, '1', 735, '2019-06-06'),
(23, '1', 737, '2019-06-06'),
(24, '1', 744, '2019-06-06'),
(25, '1', 746, '2019-06-06'),
(26, '1', 748, '2019-06-06'),
(27, '1', 749, '2019-06-06'),
(28, '1', 752, '2019-06-06'),
(29, '1', 753, '2019-06-06'),
(30, '1', 755, '2019-06-06'),
(31, '1', 775, '2019-06-06'),
(32, '1', 776, '2019-06-06'),
(33, '1', 778, '2019-06-06'),
(34, '1', 822, '2019-06-06'),
(35, '1', 824, '2019-06-06'),
(36, '1', 827, '2019-06-06'),
(37, '1', 831, '2019-06-06'),
(38, '1', 73, '2019-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `hours` double NOT NULL,
  `allow_ot` tinyint(1) NOT NULL,
  `rate` double NOT NULL,
  `date_overtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`id`, `employee_id`, `hours`, `allow_ot`, `rate`, `date_overtime`) VALUES
(1, '1', 90, 0, 0, '2019-05-02'),
(2, '1', 40, 0, 0, '2019-05-03'),
(4, '3', 90, 0, 0, '2019-05-01'),
(5, '1', 135, 0, 0, '2019-05-04'),
(6, '2', 120, 0, 0, '2019-05-03');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `description`, `rate`) VALUES
(1, 'Contractual', 0),
(2, 'Trainee', 0),
(3, 'Seasonal', 0),
(4, 'Regular', 0),
(5, 'Project Based', 0);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `time_in`, `time_out`) VALUES
(1, '05:00:00', '15:00:00'),
(2, '09:00:00', '19:00:00'),
(3, '10:00:00', '20:00:00'),
(4, '07:00:00', '17:00:00'),
(5, '08:00:00', '18:00:00'),
(6, '12:30:00', '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `undertime`
--

CREATE TABLE `undertime` (
  `ut_id` int(11) NOT NULL,
  `emp_id` varchar(15) NOT NULL,
  `mins_ut` double NOT NULL,
  `date_ut` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `undertime`
--

INSERT INTO `undertime` (`ut_id`, `emp_id`, `mins_ut`, `date_ut`) VALUES
(1, '1', 45, '2019-05-01'),
(2, '1', 90, '2019-05-05'),
(3, '6', 892, '2019-05-28'),
(4, '2', 0, '2019-05-01'),
(5, '2', 0, '2019-05-02'),
(6, '1', 180, '2019-06-06'),
(7, '1', 616, '2019-06-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign`
--
ALTER TABLE `campaign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `late`
--
ALTER TABLE `late`
  ADD PRIMARY KEY (`late_id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `undertime`
--
ALTER TABLE `undertime`
  ADD PRIMARY KEY (`ut_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `campaign`
--
ALTER TABLE `campaign`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `late`
--
ALTER TABLE `late`
  MODIFY `late_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `undertime`
--
ALTER TABLE `undertime`
  MODIFY `ut_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
