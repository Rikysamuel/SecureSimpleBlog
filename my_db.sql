-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2016 at 05:12 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `komentar` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `nama`, `komentar`, `tanggal`) VALUES
(12, 'anonymous', 'segitunya rit?', '2016-02-23');

-- --------------------------------------------------------

--
-- Table structure for table `posting`
--

CREATE TABLE IF NOT EXISTS `posting` (
  `ID` int(11) NOT NULL,
  `JUDUL` varchar(100) DEFAULT NULL,
  `TANGGAL` date DEFAULT NULL,
  `KONTEN` varchar(8000) DEFAULT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `CREATED_BY` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posting`
--

INSERT INTO `posting` (`ID`, `JUDUL`, `TANGGAL`, `KONTEN`, `USERNAME`, `CREATED_BY`) VALUES
(11, 'Cara Menambah Post', '2016-02-22', '1. login (username, password)\r\n2. klik (+ Tambah Post) di sebelah kanan atas\r\n3. isi judul, tanggal, (gambar,) konten yang ingin diisi\r\n4, klik simpan', 'test', 'testname'),
(12, 'Lorem Ipsum', '2016-02-22', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'test', 'testname'),
(13, 'ini lagu', '2016-02-23', 'tes lagurnrn--mantap', 'ssssa', 'Rikysamuel_T'),
(14, 'aabb', '2016-02-23', 'asdawdasdawdasdawdrnrn--edited', 'test', 'testname'),
(17, 'era3rwer', '2016-02-23', 'awerasdfa awracrarn\r\nrnaesrcerarnrnva\r\n\r\nwrvawvrnrnrna3w\r\n\r\nte5usdtfyli', 'ssssa', 'Rikysamuel_T');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Name` varchar(255) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `n` int(4) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `Username`, `email`, `password`, `n`, `last_login`) VALUES
('Rikysamuel', '12qwsxcv', 'rikz.samuel@gmail.com', 'e1b074c1e34eacf08b1d06ae4c93cf071f10c4022bf736cdaf6f3c230d72f1ca', 10000, '0000-00-00 00:00:00'),
('Rikysamuel', 'ssss', 'rikz.samuel@gmail.com', '9bb5f1b957a00dbd477c7ef5d325c0f7d28c037b266d97f2d521dd48bdad8287', 10000, '0000-00-00 00:00:00'),
('Rikysamuel_T', 'ssssa', 'rikz.samuel@gmail.com', '368ab0350ef3d746e8f43871edaf7932b63618cfb253f05837c451a1a80e5d9c', 9995, '2016-02-23 03:44:55'),
('testname', 'test', 'testemail@testemail.com', 'd626950e85f21ae9a61b3c33fa1ab220db1b7c9df7ede920caa5b0c3aea4b71d', 9937, '2016-02-23 05:04:09'),
('testregister', 'testregister', 'test@test.com', '6a101ec71918995a5212d0fa4a3be423ca671fa2ce6ba12ba253dbc5e1689e52', 9999, '2016-02-22 14:27:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD KEY `id` (`id`);

--
-- Indexes for table `posting`
--
ALTER TABLE `posting`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `username` (`USERNAME`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`),
  ADD KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posting`
--
ALTER TABLE `posting`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id`) REFERENCES `posting` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posting`
--
ALTER TABLE `posting`
  ADD CONSTRAINT `posting_ibfk_1` FOREIGN KEY (`USERNAME`) REFERENCES `users` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
