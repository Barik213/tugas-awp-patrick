-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2019 at 12:44 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_tugas`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_tugas`
--

CREATE TABLE `table_tugas` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` int(1) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `table_tugas`
--

INSERT INTO `table_tugas` (`id`, `username`, `email`, `password`, `active`, `code`) VALUES
(55, 'ngeotot', 'anjing@gmail.com', '$2y$10$b57ug9wkkXY4O31Dm8z4E.Mbqz201LLgQLKX7I869tIQQBuQ0hF/C', 1, 'LQr3OwtjBs'),
(57, 'anjing', 'iqbal@gmail.com', '$2y$10$Lth5yA1lQibYQU4BjnHxPeQUN9D//K34PyJcQ4DzxkPVDL/NNYIZK', 1, 'pqZPdTur6i'),
(60, 'lol', 'lol@gmail.com', '$2y$10$3fljKqi2DDIX2b3QAj9HXux1Ti/3jUNlWBHNFOYvqJ5R6zJewTw.u', 0, 'OXcCDlrsG3'),
(62, 'anjinkwc', 'anjink@gmail.c.om', '$2y$10$qH9iQVC2tBFUJB6AKIUIBuoB4xAy2TKlm/GHS5JDlvSBqEWgtw.Dm', 1, 'hNysclFJSG'),
(64, 'gilangsky', 'gilangsky@gmail.com', '$2y$10$R71M71BiLgauz4HiowP2euQHz.dsVd4eioRdEktqO8IKEu9T6LyE.', 0, 'vS2gHFsKmy'),
(65, 'gilangsky12', 'gilang12@gmail.com', '$2y$10$Cut0E3l7xOk4bLobXs88iOKh2bxu0NZ.yovZ07RGLu5GfAM5HUDT6', 1, 'hCq4GtlV7M'),
(69, 'admin', 'iqbalkorompiz@gmail.com', '$2y$10$IrItFz7tJqfYkvCEpmYBIOtxgG7OmYbrvtWqOuTIUNVxhCOTFIxsW', 1, 'EjXsxkJU6l');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_tugas`
--
ALTER TABLE `table_tugas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_tugas`
--
ALTER TABLE `table_tugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
