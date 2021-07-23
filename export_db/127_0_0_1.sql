-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jul 23, 2021 at 02:13 PM
-- Server version: 5.6.51
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products-4works`
--
CREATE DATABASE IF NOT EXISTS `products-4works` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `products-4works`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Hračky'),
(2, 'Hobby a zahrada'),
(3, 'Knihy a časopisy'),
(4, 'Sport a outdoor');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(250) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `category_id`, `price`, `quantity`, `description`) VALUES
(1, 'LEGO Harry Potter 75955 ', 'ImgW.jpg', 1, 1800, 20, '                    LEGO stavebnice pro děti, vhodné od 8 let, téma: Auta a Vozidla, rok uvedení 2018, počet dílků 801 ks                    '),
(2, 'LEGO Creator 10281 Bonsaj ', 'ImgW (1).jpg', 1, 1300, 50, '                    LEGO stavebnice pro dospělé, vhodné od 18 let , téma: Zahrada, rok uvedení 2021, počet dílků 878 ks                    '),
(3, 'Belatrix Luxury 125 Rattan  ', 'ImgW (2).jpg', 2, 11800, 10, '                                        Vířivka nafukovací, čtvercový půdorys, rozměry 1,55 × 1,55 m, kartušová filtrace, objem 600 l, 130 trysek                                        '),
(4, 'Zahradní židle PARIS antracit ', 'ImgW (3).jpg', 2, 890, 24, '                    Zahradní židle výrobním materiálem je ocel a umělý ratan, nosnost 150 kg, rozměry 65×55×95 cm                    '),
(5, 'Adidas Uniforia League bílý, vel. 5 ', 'ImgW (5).jpg', 4, 750, 45, '                    Fotbalový míč velikost 5, šitý, materiál: syntetika, certifikace: FIFA Quality                    '),
(6, 'Mikasa VLS 300 ', 'ImgW (4).jpg', 4, 1600, 22, '                    Beachvolejbalový míč velikost 5, soutěžní, šitý, materiál: syntetická kůže, homologovaný FIVB, hmotnost 260 - 280 g                    '),
(7, 'DESIGN Profi - 2020 ', 'ImgW (6).jpg', 3, 90, 111, '                    Elektronický časopis 16. 10. 2020 (1× ročně), Čeština, 100 stran                    '),
(8, 'HASIČÁRNA - 1/2021 ', 'ImgW (7).jpg', 3, 50, 100, '                    Elektronický časopis 15. 7. 2021 (dvouměsíčník), Čeština, 101 stran                    ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
