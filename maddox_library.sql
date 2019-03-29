-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2019 at 07:27 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maddox_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `isbn` char(15) NOT NULL,
  `title` varchar(100) NOT NULL,
  `author` varchar(100) NOT NULL,
  `total_copies` int(4) NOT NULL,
  `avail_copies` int(4) NOT NULL,
  `genre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`isbn`, `title`, `author`, `total_copies`, `avail_copies`, `genre`) VALUES
('0061348112', 'The Indifferent Stars Above', 'Daniel James Brown', 4, 4, 'nonfiction'),
('0143108867', 'After You', 'Jojo Moyes', 4, 4, 'fiction'),
('0439064872', 'Harry Potter and the Chamber of Secrets', 'J.K. Rowling', 5, 5, 'fantasy'),
('0439136369', 'Harry Potter and the Prisoner of Azkaban', 'J.K. Rowling', 4, 4, 'fantasy'),
('0439139600', 'Harry Potter and the Goblet of Fire', 'J.K. Rowling', 6, 6, 'fantasy'),
('0439358078', 'Harry Potter and the Order of the Phoenix', 'J.K. Rowling', 5, 5, 'fantasy'),
('0439765960', 'Harry Potter and the Half-Blood Prince', 'J.K. Rowling', 4, 4, 'fantasy'),
('0545139708', 'Harry Potter and the Deathly Hallows', 'J.K. Rowling', 4, 4, 'fantasy'),
('054792819X', 'The Return of the King', 'J.R.R. Tolkien', 3, 3, 'fantasy'),
('0547928203', 'The Two Towers', 'J.R.R. Tolkien', 3, 3, 'fantasy'),
('0547928211', 'The Fellowship of the Ring', 'J.R.R. Tolkien', 3, 3, 'fantasy'),
('054792822X', 'The Hobbit', 'J.R.R. Tolkien', 4, 4, 'fantasy'),
('067002581X', 'The Boys in the Boat', 'Daniel James Brown', 4, 4, 'nonfiction'),
('0670026603', 'Me Before You', 'Jojo Moyes', 3, 3, 'fiction'),
('0671244094', 'The Path Between the Seas', 'David McCullough', 2, 2, 'nonfiction'),
('0671869205', 'Truman', 'David McCullough', 2, 2, 'biography'),
('0743223133', 'John Adams', 'David McCullough', 3, 3, 'biography'),
('0812994520', 'Just Mercy', 'Bryan Stevenson', 5, 5, 'nonfiction'),
('1468587382', 'Five Kids and One Gun', 'Bryan Stevenson', 2, 2, 'nonfiction'),
('1476728742', 'The Wright Brothers', 'David McCullough', 2, 2, 'biography'),
('1493022008', 'Under a Flaming Sky', 'Daniel James Brown', 3, 3, 'nonfiction'),
('1594489505', 'A Thousand Splendid Suns', 'Khaled Hosseini', 3, 3, 'fiction'),
('159463193X', 'Kite Runner', 'Khaled Hosseini', 3, 3, 'fiction'),
('1594632383', 'And the Mountains Echoed', 'Khaled Hosseini', 5, 5, 'fiction');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `isbn` varchar(100) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `date_checked_out` datetime NOT NULL,
  `checkout_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patrons`
--

CREATE TABLE `patrons` (
  `card_number` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patrons`
--

INSERT INTO `patrons` (`card_number`, `first_name`, `last_name`, `email`) VALUES
('cn11223', 'Malcolm', 'Wagner', 'wagner@email.com'),
('cn12345', 'Julia', 'Desai', 'desai@email.com'),
('cn13935', 'Mark', 'Smith', 'smith@email.com'),
('cn23456', 'Howard', 'Gordon', 'gordon@email.com'),
('cn35738', 'Gretchen', 'Hill', 'hill3@email.com'),
('cn44775', 'Jerome', 'Wallace', 'wallace@email.com'),
('cn78324', 'Jean', 'Griffin', 'griffin@email.com'),
('cn79621', 'Beth', 'Woodard', 'woodard@email.com'),
('cn83987', 'Charles', 'Little', 'little@email.com'),
('cn95938', 'Karen', 'Puckett', 'puckett@email.com'),
('cn98325', 'Patrick', 'Hill', 'hill2@email.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`isbn`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`checkout_id`),
  ADD KEY `isbn` (`isbn`),
  ADD KEY `card_number` (`card_number`);

--
-- Indexes for table `patrons`
--
ALTER TABLE `patrons`
  ADD PRIMARY KEY (`card_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`isbn`) REFERENCES `books` (`isbn`),
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`card_number`) REFERENCES `patrons` (`card_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
