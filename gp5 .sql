-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2020 at 08:09 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gp5`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(10) NOT NULL,
  `Passport_Number` varchar(254) NOT NULL,
  `isbn` int(50) NOT NULL,
  `status` varchar(256) NOT NULL,
  `Date_borrowed` date DEFAULT NULL,
  `Due_Date` date DEFAULT NULL,
  `Date_returned` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `Passport_Number`, `isbn`, `status`, `Date_borrowed`, `Due_Date`, `Date_returned`) VALUES
(233, 'A123098765', 124077269, 'checkout', '2020-04-28', '2020-04-29', NULL),
(234, 'A123098765', 1423901622, 'checkout', '2020-04-28', '2020-05-01', NULL),
(236, 'A123098765', 1423901622, 'reserve', '2020-04-28', '2020-05-01', NULL),
(238, 'A123098765', 1423901622, 'reserve', '2020-04-28', '2020-05-01', NULL),
(239, 'A123098765', 1482231611, 'checkout', '2020-04-28', '2020-05-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE `librarian` (
  `librarian_id` varchar(254) NOT NULL,
  `librarian_name` varchar(254) DEFAULT NULL,
  `password` char(60) NOT NULL,
  `Librarian_type` varchar(254) NOT NULL,
  `email` varchar(254) DEFAULT NULL,
  `phone_number` varchar(12) DEFAULT NULL,
  `gender` varchar(254) NOT NULL,
  `address` varchar(254) NOT NULL,
  `DOB` date NOT NULL,
  `city` varchar(254) NOT NULL,
  `state` varchar(254) NOT NULL,
  `image` varchar(254) NOT NULL,
  `name` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`librarian_id`, `librarian_name`, `password`, `Librarian_type`, `email`, `phone_number`, `gender`, `address`, `DOB`, `city`, `state`, `image`, `name`) VALUES
('ENUG0933', 'tobechekwu Agu', 'Sonship123', 'main ', 'agutobechuku@gmail.com', '09012121212', 'male', 'no 5 sam pam street', '2020-04-24', '', 'Abia', 'data:image/jpg;base64,', 'buhari.jpg'),
('ENUG1234', 'adeka adames', 'bnodj98zr0ay', 'other', 'anigbojohnsona@gmail.com', '09012312312', 'male', 'no 18 sam street  street', '2020-04-11', '', 'Abia', 'data:image/jpg;base64,', 'Brigety_3-1-16-1-270x300.jpg'),
('ENUG1255', 'ejikeme kelechukwu', 'Sonship123', 'other', 'ejikemeK@gmail.com', '09012121212', 'male', 'no 45 age street', '0000-00-00', 'zurmi', 'Abia', 'data:image/jpg;base64,', 'hassan harris.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `patron`
--

CREATE TABLE `patron` (
  `Patron_Name` varchar(254) NOT NULL,
  `Passport_Number` varchar(254) NOT NULL,
  `PASSWORD` varchar(254) NOT NULL,
  `gender` varchar(254) NOT NULL,
  `phone_number` varchar(254) NOT NULL,
  `address` varchar(254) NOT NULL,
  `email` varchar(254) NOT NULL,
  `city` varchar(254) NOT NULL,
  `state` varchar(254) NOT NULL,
  `dob` date NOT NULL,
  `image` varchar(254) NOT NULL,
  `name` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patron`
--

INSERT INTO `patron` (`Patron_Name`, `Passport_Number`, `PASSWORD`, `gender`, `phone_number`, `address`, `email`, `city`, `state`, `dob`, `image`, `name`) VALUES
('jonas james', 'A123098765', '12345', 'male', '09012311234', 'no 5 janas   steet', 'anigbojohnsona@gmail.com', 'otukpo', 'Kano', '2020-04-24', 'data:image/jpg;base64,', 'Brigety_3-1-16-1-270x300.jpg'),
('johnson Anigbo', 'A123412345', '12345', 'male', '09012345678', 'no 5 jerich road', 'johnson@yahoo.com', '', 'Zamfara', '2020-04-17', 'data:image/jpg;base64,', 'kenn.jpg'),
('ken eric', 'A123412387', '12345', 'male', '09012341289', 'no 10 karrim street', 'hassanHarris@gmail.com', '', 'Abia', '2020-04-02', 'data:image/webp;base64,UklGRjIkAABXRUJQVlA4ICYkAACQjACdASqtABgBPkEaiUQloaEej7zkWAQEsoNAwotmjWk9AkaPPvm1IAvM+jsyu0F/xfWZ5gvPa8z3ne+mb/K+kZ6Vfqrf3H1TfO29W//D9IB///bm33PuJ/x348ea/nl+ee53szZC/Vv73zI+1z7j1s/3/gX60vUI9u/6X80OMMAV9df9b9y3q8f6X5Ve//iC/z7+w/7n8s/', 'uchechukwu john.webp'),
('anieza kamachikwe', 'A123451234', '12345', 'male', '09012123456', 'no 4 jasper street', 'aniezej@gmail.com', '', 'Abia', '2020-04-25', 'data:image/webp;base64,UklGRrgNAABXRUJQVlA4IKwNAABwUACdASqxABgBPpEykkgnoqIltH9JiPASCWVu+EjsAFVdC9uh0TqO3EPmA84/Tlt6b/6Fc/r/+GtyHe3/t/yEacLQG/lX9w/4Hqzf8vmw+sv+97g/8y/rXW49KUsfEjzMBGW2p/4X5TO0MOHC/N/FT32tRE6CAgc0B7X855W1AK6d/tCahVCiw6jqlfZ/C3WpKfhMrfPo2Qk', 'hassan d.webp'),
('Anigbo  ekene', 'A123456778', '7wkrdv1hqyxt', 'male', '09098767678', 'no 5 smith street', 'anigbojohnsona@gmail.com', 'ojiRiver', 'Enugu', '2020-04-15', 'data:image/jpg;base64,/9j/4AAQSkZJRgABAQEAAAAAAAD/4TDKRXhpZgAATU0AKgAAAAgABAExAAIAAAALAAAQSodpAAQAAAABAAAQVoglAAQAAAABAAAgouocAAcAABAMAAAAPgAAAAAc6gAAABAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 'WIN_20190702_22_12_20_Pro.jpg'),
('jane adames', 'A145679067', 'Sonship123', 'female', '09076888653', 'no 12 joseph street', 'ikennafour@gmail.com', '2020-04-29', 'Nasarawa', '2020-04-29', 'data:image/jpg;base64,/9j/4AAQSkZJRgABAQHhAOEAAAD/2wBDAAoHBwgHBgoICAgLCgoLDhgQDg0NDh0VFhEYIx8lJCIfIiEmKzcvJik0KSEiMEExNDk7Pj4+JS5ESUM8SDc9Pjv/2wBDAQoLCw4NDhwQEBw7KCIoOzs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7Ozv/wAARCAVuA5sDASIAAhEB', 'tofa.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `isbn` int(254) NOT NULL,
  `issn` int(50) NOT NULL,
  `title` varchar(254) NOT NULL,
  `publication_Date` date NOT NULL,
  `author` varchar(254) NOT NULL,
  `call_number` varchar(254) NOT NULL,
  `language` varchar(254) NOT NULL,
  `quntity` int(50) NOT NULL,
  `replacement_cost` int(50) NOT NULL,
  `borrowing_duration` int(50) NOT NULL,
  `barcode` int(50) NOT NULL,
  `image` varchar(254) NOT NULL,
  `name` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`isbn`, `issn`, `title`, `publication_Date`, `author`, `call_number`, `language`, `quntity`, `replacement_cost`, `borrowing_duration`, `barcode`, `image`, `name`) VALUES
(124077269, 33344422, 'Computer Organization and Design MIPS Edition : The Hardware/Software Interface', '2020-04-25', 'John L. Hennessy', 'CA1239', 'English', 8, 12000, 3, 2147483647, 'data:image/jpg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAAMCAgICAgMCAgIDAwMDBAYEBAQEBAgGBgUGCQgKCgkICQkKDA8MCgsOCwkJDRENDg8QEBEQCgwSExIQEw8QEBD/2wBDAQMDAwQDBAgEBAgQCwkLEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBD/wAARCAGQAVIDASIAAhEB', 'Computer architecture.jpg'),
(1423901622, 12345678, 'java introduction', '2020-04-18', 'd.s malik', '12345677', 'enlish', 18, 1200, 3, 2147483647, 'data:image/jpg;base64,/9j/4AAQSkZJRgABAQEATwBPAAD/2wBDAAMCAgMCAgMDAwMEAwMEBQgFBQQEBQoHBwYIDAoMDAsKCwsNDhIQDQ4RDgsLEBYQERMUFRUVDA8XGBYUGBIUFRT/2wBDAQMEBAUEBQkFBQkUDQsNFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBT/wAARCACeAIADAREAAhEB', 'java.jpg'),
(1482231611, 22335544, 'Ethical Hacking and Penetration Testing Guide', '2017-04-10', 'Rafay Baloch', 'EH123456', 'English', 3, 12000, 3, 2147483647, 'data:image/jpg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/2wBDAAMCAgICAgMCAgIDAwMDBAYEBAQEBAgGBgUGCQgKCgkICQkKDA8MCgsOCwkJDRENDg8QEBEQCgwSExIQEw8QEBD/2wBDAQMDAwQDBAgEBAgQCwkLEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBD/wAARCAGQARgDASIAAhEB', 'network security.jpg'),
(2147483647, 123888212, 'Database Systems: A Practical Approach to Design, Implementation, and Management Database Systems: A Practical Approach to Design, Implementation, and Management', '2020-04-23', 'Carolyn E', 'D12312', 'english', 6, 1200, 3, 2147483647, 'data:image/jpg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxITEhUTEhMVFhUXFhcVFxUXGBUWFRceFxgYFxgXGhYaHSggGBolHRUXITEhJSkrLi4uGR8zODMtNygtLisBCgoKDg0OGxAQGzAmICYuLS0tNS0tLy0vLy0tLy0tLS0tLS0vLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIALsAlQMBIgACEQEDEQH/', 'database system.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `isbn` (`isbn`),
  ADD KEY `Checkout_patron` (`Passport_Number`);

--
-- Indexes for table `librarian`
--
ALTER TABLE `librarian`
  ADD PRIMARY KEY (`librarian_id`);

--
-- Indexes for table `patron`
--
ALTER TABLE `patron`
  ADD PRIMARY KEY (`Passport_Number`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `isbn` (`isbn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `Checkout_patron` FOREIGN KEY (`Passport_Number`) REFERENCES `patron` (`Passport_Number`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
