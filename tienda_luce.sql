-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 05:45 AM
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
-- Database: `tienda_luce`
--

CREATE Database tienda_luce;
use tienda_luce;
-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
  `Num_Cedula` varchar(20) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Primer_Apellido` varchar(50) DEFAULT NULL,
  `Segundo_Apellido` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Contrasena` varchar(50) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Canton` varchar(50) DEFAULT NULL,
  `Distrito` varchar(50) DEFAULT NULL,
  `Username_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `empleados`
--

CREATE TABLE `empleados` (
  `ID_Empleado` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Primer_Apellido` varchar(50) DEFAULT NULL,
  `Segundo_Apellido` varchar(50) DEFAULT NULL,
  `Num_Cedula_Empleado` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `envios`
--

CREATE TABLE `envios` (
  `Num_Seguimiento` int(11) NOT NULL,
  `Num_Cedula` varchar(20) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Canton` varchar(50) DEFAULT NULL,
  `Distrito` varchar(50) DEFAULT NULL,
  `Tipo_Envio` varchar(50) DEFAULT NULL,
  `Costo_Envio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

CREATE TABLE `facturas` (
  `Num_Factura` int(11) NOT NULL,
  `Num_Cedula` varchar(20) DEFAULT NULL,
  `ID_Producto` int(11) DEFAULT NULL,
  `ID_Empleado` int(11) DEFAULT NULL,
  `Costo_Envio` decimal(10,2) DEFAULT NULL,
  `Total_factura` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
  `ID_Producto` int(11) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL,
  `Cant_Disponible` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usernames`
--

CREATE TABLE `usernames` (
  `Username_Id` int(11) NOT NULL,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `ID_Venta` int(11) NOT NULL,
  `ID_Empleado` int(11) DEFAULT NULL,
  `ID_Producto` int(11) DEFAULT NULL,
  `Num_Cedula` varchar(20) DEFAULT NULL,
  `Monto_Venta` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Num_Cedula`),
  ADD KEY `Username_Id` (`Username_Id`);

--
-- Indexes for table `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`ID_Empleado`),
  ADD KEY `Num_Cedula_Empleado` (`Num_Cedula_Empleado`);

--
-- Indexes for table `envios`
--
ALTER TABLE `envios`
  ADD PRIMARY KEY (`Num_Seguimiento`),
  ADD KEY `Num_Cedula` (`Num_Cedula`);

--
-- Indexes for table `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`Num_Factura`),
  ADD KEY `Num_Cedula` (`Num_Cedula`),
  ADD KEY `ID_Producto` (`ID_Producto`),
  ADD KEY `ID_Empleado` (`ID_Empleado`);

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`ID_Producto`);

--
-- Indexes for table `usernames`
--
ALTER TABLE `usernames`
  ADD PRIMARY KEY (`Username_Id`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`ID_Venta`),
  ADD KEY `ID_Empleado` (`ID_Empleado`),
  ADD KEY `ID_Producto` (`ID_Producto`),
  ADD KEY `Num_Cedula` (`Num_Cedula`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`Username_Id`) REFERENCES `usernames` (`Username_Id`);

--
-- Constraints for table `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`Num_Cedula_Empleado`) REFERENCES `cliente` (`Num_Cedula`);

--
-- Constraints for table `envios`
--
ALTER TABLE `envios`
  ADD CONSTRAINT `envios_ibfk_1` FOREIGN KEY (`Num_Cedula`) REFERENCES `cliente` (`Num_Cedula`);

--
-- Constraints for table `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`Num_Cedula`) REFERENCES `cliente` (`Num_Cedula`),
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `inventario` (`ID_Producto`),
  ADD CONSTRAINT `facturas_ibfk_3` FOREIGN KEY (`ID_Empleado`) REFERENCES `empleados` (`ID_Empleado`);

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`ID_Empleado`) REFERENCES `empleados` (`ID_Empleado`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`ID_Producto`) REFERENCES `inventario` (`ID_Producto`),
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`Num_Cedula`) REFERENCES `cliente` (`Num_Cedula`);
COMMIT;


--
--Insert products to table 'Inventario'

INSERT INTO Inventario (ID_Producto, Descripcion, Precio, Estado, Cant_Disponible)
VALUES 
(1, '', 7500, 'Usado', 1),
(2, '', 6900, 'Usado', 1),
(3, '', 349.99, 'Usado', 2),
(4, '', 12000, 'Nuevo', 2),
(5, '', 9500, 'Nuevo', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
