-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2022 at 02:38 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_viajes`
--

-- --------------------------------------------------------

--
-- Table structure for table `automoviles`
--

CREATE TABLE `automoviles` (
  `id_automovil` int(100) NOT NULL,
  `marca` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `modelo` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `anio` int(5) NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `patente` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `licencia` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `automoviles`
--

INSERT INTO `automoviles` (`id_automovil`, `marca`, `modelo`, `anio`, `color`, `patente`, `licencia`) VALUES
(6, 'AUDI', 'A4', 2000, 'Negro', 'JPO258', '32569842'),
(9, 'Chevrolet', 'Corsa', 2015, 'blanco', 'LMP979', '14295838'),
(11, 'Fiat', '128', 1985, 'Azul', 'AIJ987', '28493575'),
(13, 'Chevrolet', 'Cruze', 1995, 'blanco', 'aig126', '27348298'),
(14, 'Citroen', 'Berlingo', 1995, 'blanco', 'OPK', '2348998'),
(16, 'Ford', 'Focus', 2013, 'Negro', 'AF123PJ', '28526552'),
(18, 'Fiat', 'Uno', 1988, 'Blanco', 'AHP563', '24563214'),
(20, 'Fiat', 'Uno', 2000, 'Rojo', 'HPO238', '25569842'),
(23, 'Chevrolet', 'Safira', 2002, 'Gris', 'DJO987', '12393575'),
(25, 'Volksvagen', 'Vento', 2002, 'Negro', 'DGP135', '128756321');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(100) NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'admin1@gmail.com', '$2a$12$xbGFoxZYr.3BhVgBqIvLqOBpVwouDiCDwIvrfwiQGJtnqNJmrNkpG'),
(2, 'admin2@gmail.com', '$2a$12$KVnwtgUykwBRg2xADwXQS.qIcialBJcaVHmHO55.so/ASWGgOZTLW');

-- --------------------------------------------------------

--
-- Table structure for table `viajes`
--

CREATE TABLE `viajes` (
  `id_viaje` int(100) NOT NULL,
  `salida` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `destino` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
  `dia` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `horario` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `lugares` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `mascota` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `precio` varchar(8) COLLATE utf8mb4_spanish_ci NOT NULL,
  `datos` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `id_automovil` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Dumping data for table `viajes`
--

INSERT INTO `viajes` (`id_viaje`, `salida`, `destino`, `dia`, `horario`, `lugares`, `mascota`, `precio`, `datos`, `id_automovil`) VALUES
(10, 'San Alberto', 'Tandil', '2022-12-23', '09:00', '2', 'ninguna', '1800', 'traer mate', 6),
(17, 'Carlos Tejedor', 'Tandil', '2022-12-23', '09:00', '2', 'ninguna', '1800', 'ninguno', 6),
(18, 'Tandil', 'Pehuajo', '2022-12-20', '07:00', '2', 'ninguna', '3500', 'Puntualidad', 6),
(19, 'Pehuajo', 'Tandil', '2022-12-03', '07:00', '1', 'gato', '2500', 'gato en canil sin excepcion', 14),
(21, 'Azul', 'Mar del Plata', '2022-12-14', '06:00', '2', 'ninguna', '2200', 'paso a buscar por puerta', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `automoviles`
--
ALTER TABLE `automoviles`
  ADD PRIMARY KEY (`id_automovil`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id_viaje`),
  ADD KEY `id_automovil` (`id_automovil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `automoviles`
--
ALTER TABLE `automoviles`
  MODIFY `id_automovil` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id_viaje` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `viajes`
--
ALTER TABLE `viajes`
  ADD CONSTRAINT `viajes_ibfk_1` FOREIGN KEY (`id_automovil`) REFERENCES `automoviles` (`id_automovil`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
