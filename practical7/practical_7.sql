-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2026 at 03:59 AM
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
-- Database: `practical 7`
--

-- --------------------------------------------------------

--
-- Table structure for table `error_logs`
--

CREATE TABLE `error_logs` (
  `id` int(11) NOT NULL,
  `error_code` varchar(50) NOT NULL,
  `error_message` text NOT NULL,
  `error_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `error_logs`
--

INSERT INTO `error_logs` (`id`, `error_code`, `error_message`, `error_time`) VALUES
(1, 'E_DIV_ZERO', 'You attempted to divide by zero. Please check your calculation or\r\ninput values.', '2026-04-07 03:48:36'),
(2, 'E_UNDEFINED_VAR', 'Detected an undefined variable in the code.', '2026-04-07 03:48:36'),
(3, 'E_DIV_ZERO', 'You attempted to divide by zero. Please check your calculation or\r\ninput values.', '2026-04-07 03:48:52'),
(4, 'E_UNDEFINED_VAR', 'Detected an undefined variable in the code.', '2026-04-07 03:48:52'),
(5, 'E_2', '[2] Undefined variable $nonexistentVariable in C:\\xampp\\htdocs\\practical\\server_side_practical\\practical7\\simulate_errors.php on line 5', '2026-04-07 03:58:24'),
(6, 'EXCEPTION', 'Exception: Division by zero', '2026-04-07 03:58:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `error_logs`
--
ALTER TABLE `error_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `error_logs`
--
ALTER TABLE `error_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
