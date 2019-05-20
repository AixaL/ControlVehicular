-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2019 a las 01:26:08
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controlvehicular2019`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conductores`
--

CREATE TABLE `conductores` (
  `RFC` char(13) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Firma` blob NOT NULL,
  `Domicilio` varchar(100) NOT NULL,
  `Antiguedad` smallint(2) NOT NULL,
  `TelEmergencia` char(15) NOT NULL,
  `Sexo` char(1) NOT NULL,
  `TipoSangre` varchar(3) NOT NULL,
  `Restriccion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `conductores`
--

INSERT INTO `conductores` (`RFC`, `Nombre`, `FechaNacimiento`, `Firma`, `Domicilio`, `Antiguedad`, `TelEmergencia`, `Sexo`, `TipoSangre`, `Restriccion`) VALUES
('', '', '0000-00-00', '', '', 0, '', '', '', ''),
('1', '1', '1111-11-11', '', 'Av. Robles #358 - A', 0, 'hombre', '1', '1', '014423349266'),
('123', 'Nuevo', '2019-04-09', '', 'Av. Robles #358 - A', 80, '014423349266', 'h', '1', 'Ninguna'),
('1234', 'Antonio', '1999-12-26', '', '', 0, '', '', '', ''),
('12345', 'Antyeet', '2019-03-20', '', 'Av. Robles #358 - A', 0, 'hombre', '1', 'Nin', '014423349266'),
('2', '2', '0002-02-02', '', '2', 2, 'mujer', '2', '2', '2'),
('3', 'Tres', '2003-03-03', '', 'Tres', 3, '3333333', 'h', 'O', ''),
('32', 'Tres', '2003-03-03', '', 'Tres', 3, '3333333', 'h', 'O', ''),
('33', 'Tres', '2003-03-03', '', 'Tres', 3, '3333333', 'h', 'O', ''),
('34', 'Tres', '2003-03-03', '', 'Tres', 3, '3333333', 'h', 'O', ''),
('35', 'Tres', '2003-03-03', '', 'Tres', 3, '3333333', 'h', 'O', ''),
('36', 'Tres', '2003-03-03', '', 'Tres', 3, '3333333', 'h', 'O', ''),
('37', 'Tres', '2003-03-03', '', 'Tres', 3, '3333333', 'h', 'O', ''),
('38', 'Tres', '2003-03-03', '', 'Tres', 3, '3333333', 'h', 'O', ''),
('39', 'Tres', '2003-03-03', '', 'Tres', 3, '3333333', 'h', 'O', ''),
('40', 'Tres', '2003-03-03', '', 'Tres', 3, '3333333', 'h', 'O', ''),
('43', 'Tres', '2003-03-03', '', 'Tres', 3, '3333333', 'h', 'O', ''),
('4321', 'Paulin guapo', '2019-03-12', '', 'Escuela', 80, 'hombre', '2', 'Nin', '999999'),
('8', 'Dale Earnhardt', '0000-00-00', '', 'Av. Robles #358 - A', 0, '8803088030', 'h', 'O+', 'Ninguna'),
('88', 'Dale Earnhardt', '0000-00-00', '', 'Av. Robles #358 - A', 0, '8803088030', 'h', 'O+', 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `licencias`
--

CREATE TABLE `licencias` (
  `Folio` int(8) NOT NULL,
  `Conductor` char(13) NOT NULL,
  `TipoLicencia` char(1) NOT NULL,
  `FechaExpedicion` date NOT NULL,
  `FechaVencimiento` date NOT NULL,
  `Estado` varchar(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `licencias`
--

INSERT INTO `licencias` (`Folio`, `Conductor`, `TipoLicencia`, `FechaExpedicion`, `FechaVencimiento`, `Estado`) VALUES
(1, '1', '1', '1111-11-11', '1112-11-11', '1'),
(2, '1', '1', '0001-01-01', '0001-01-01', '1'),
(3, '1', '1', '0001-01-01', '0001-01-01', '1'),
(12, '12345', '5', '2019-03-07', '2020-06-04', '1'),
(15, '123', '1', '2019-04-16', '2019-08-14', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multas`
--

CREATE TABLE `multas` (
  `Folio` int(8) NOT NULL,
  `idVerificacion` int(8) NOT NULL,
  `idVehiculo` int(8) NOT NULL,
  `Licencia` int(10) NOT NULL,
  `Motivo` varchar(50) NOT NULL,
  `Emisor` varchar(6) NOT NULL,
  `Fecha` date NOT NULL,
  `Monto` mediumint(6) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `Garantia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `multas`
--

INSERT INTO `multas` (`Folio`, `idVerificacion`, `idVehiculo`, `Licencia`, `Motivo`, `Emisor`, `Fecha`, `Monto`, `Descripcion`, `Garantia`) VALUES
(1, 1, 1, 1, 'mala', 'yo', '1111-11-11', 100, 'yeet', 'nada'),
(2, 1, 1, 1, 'mala2', 'yo', '1111-11-11', 100, 'yeet', 'nada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propietarios`
--

CREATE TABLE `propietarios` (
  `RFC` char(13) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Telefono` char(15) NOT NULL,
  `Correo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `propietarios`
--

INSERT INTO `propietarios` (`RFC`, `Nombre`, `Direccion`, `Telefono`, `Correo`) VALUES
('1', '1', '1', '1', '1'),
('2', 'Antonio Vázquez Gutiérrez', 'Av. Robles #358 - A', '4444', 'antvagu.banano88@gmail.com'),
('3', '1', '1', '1', '1'),
('4', 'Antonio Vázquez Gutiérrez', 'Av. Robles #358 - A', '4444', 'antvagu.banano88@gmail.com'),
('5', '4', '3', '2', '1'),
('99', 'E', 'EE', '213512864', 'eo@gmail.com'),
('9996', 'Antonio Vázquez Gutiérrez', 'Av. Robles #358 - A', '4444', 'antvagu.banano88@gmail.com'),
('9997', 'Antonio Vázquez Gutiérrez', 'Av. Robles #358 - A', '4444', 'antvagu.banano88@gmail.com'),
('9998', 'Antonio Vázquez Gutiérrez', 'Av. Robles #358 - A', '4444', 'antvagu.banano88@gmail.com'),
('9999', 'Antonio Vázquez Gutiérrez', 'Av. Robles #358 - A', '4444', 'antvagu.banano88@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `robos`
--

CREATE TABLE `robos` (
  `idReporte` int(8) NOT NULL,
  `Vehiculo` int(8) NOT NULL,
  `Lugar` varchar(100) NOT NULL,
  `Fecha` date NOT NULL,
  `Estado` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `robos`
--

INSERT INTO `robos` (`idReporte`, `Vehiculo`, `Lugar`, `Fecha`, `Estado`) VALUES
(1, 1, '1', '0001-01-01', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tenencias`
--

CREATE TABLE `tenencias` (
  `Folio` int(8) NOT NULL,
  `Vehiculo` int(8) NOT NULL,
  `Periodo` char(6) NOT NULL,
  `FechaPago` date NOT NULL,
  `Monto` mediumint(6) NOT NULL,
  `Antiguedad` smallint(2) DEFAULT NULL,
  `Descuento` smallint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tenencias`
--

INSERT INTO `tenencias` (`Folio`, `Vehiculo`, `Periodo`, `FechaPago`, `Monto`, `Antiguedad`, `Descuento`) VALUES
(1, 1, '1', '0001-01-01', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `username` varchar(20) NOT NULL,
  `psswrd` varchar(20) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `intento` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`username`, `psswrd`, `tipo`, `estado`, `intento`) VALUES
('Andrea', '1234', 'USU', 0, 3),
('Anonimo', 'anonimo123', 'USU', 0, 0),
('Beto', '4321', 'ADM', 0, 0),
('Daniel', 'Daniel123', 'USU', 0, 0),
('Jovan', '1234', 'OTR', 1, 1),
('Marco', '12345678', 'ADM', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `idVehiculo` int(8) NOT NULL,
  `Propietario` char(13) NOT NULL,
  `NIV` char(17) NOT NULL,
  `Placa` varchar(10) NOT NULL,
  `Tipo` varchar(20) NOT NULL,
  `Color` varchar(20) NOT NULL,
  `Uso` varchar(10) NOT NULL,
  `numPuerta` smallint(2) DEFAULT NULL,
  `Marca` varchar(20) DEFAULT NULL,
  `numMotor` varchar(20) DEFAULT NULL,
  `numSerie` varchar(20) DEFAULT NULL,
  `Modelo` varchar(20) DEFAULT NULL,
  `Combustible` varchar(15) DEFAULT NULL,
  `Anio` smallint(2) DEFAULT NULL,
  `Cilindraje` smallint(2) DEFAULT NULL,
  `Transmision` varchar(10) DEFAULT NULL,
  `Linea` varchar(20) DEFAULT NULL,
  `Origen` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`idVehiculo`, `Propietario`, `NIV`, `Placa`, `Tipo`, `Color`, `Uso`, `numPuerta`, `Marca`, `numMotor`, `numSerie`, `Modelo`, `Combustible`, `Anio`, `Cilindraje`, `Transmision`, `Linea`, `Origen`) VALUES
(1, '1', '1', '1', '1', '1', '1', 1, '1', '1', '1', '1', '1', 111, 1, '1', '1', '1'),
(3, '99', 'fossse', '123333', 'b', 'azul', 'privado', 5, 'ford', '1234', '123', 'fiesta', 'gas', 2019, 4, 'auto', 'wth', 'Mexico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `verificaciones`
--

CREATE TABLE `verificaciones` (
  `idVerificacion` int(8) NOT NULL,
  `Vehiculo` int(8) NOT NULL,
  `Periodo` char(6) NOT NULL,
  `CentroVerificacion` varchar(100) NOT NULL,
  `Tipo` char(20) NOT NULL,
  `Dictamen` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `verificaciones`
--

INSERT INTO `verificaciones` (`idVerificacion`, `Vehiculo`, `Periodo`, `CentroVerificacion`, `Tipo`, `Dictamen`) VALUES
(1, 1, '1', '1', '1', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `conductores`
--
ALTER TABLE `conductores`
  ADD PRIMARY KEY (`RFC`);

--
-- Indices de la tabla `licencias`
--
ALTER TABLE `licencias`
  ADD PRIMARY KEY (`Folio`),
  ADD KEY `Conductor` (`Conductor`);

--
-- Indices de la tabla `multas`
--
ALTER TABLE `multas`
  ADD PRIMARY KEY (`Folio`),
  ADD KEY `idVehiculo` (`idVehiculo`),
  ADD KEY `idVerificacion` (`idVerificacion`),
  ADD KEY `Licencia` (`Licencia`);

--
-- Indices de la tabla `propietarios`
--
ALTER TABLE `propietarios`
  ADD PRIMARY KEY (`RFC`);

--
-- Indices de la tabla `robos`
--
ALTER TABLE `robos`
  ADD PRIMARY KEY (`idReporte`),
  ADD KEY `Vehiculo` (`Vehiculo`);

--
-- Indices de la tabla `tenencias`
--
ALTER TABLE `tenencias`
  ADD PRIMARY KEY (`Folio`),
  ADD KEY `Vehiculo` (`Vehiculo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`username`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`idVehiculo`),
  ADD UNIQUE KEY `NIV` (`NIV`),
  ADD UNIQUE KEY `Placa` (`Placa`),
  ADD KEY `Propietario` (`Propietario`);

--
-- Indices de la tabla `verificaciones`
--
ALTER TABLE `verificaciones`
  ADD PRIMARY KEY (`idVerificacion`),
  ADD KEY `Vehiculo` (`Vehiculo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `licencias`
--
ALTER TABLE `licencias`
  MODIFY `Folio` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `multas`
--
ALTER TABLE `multas`
  MODIFY `Folio` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `robos`
--
ALTER TABLE `robos`
  MODIFY `idReporte` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tenencias`
--
ALTER TABLE `tenencias`
  MODIFY `Folio` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `idVehiculo` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `verificaciones`
--
ALTER TABLE `verificaciones`
  MODIFY `idVerificacion` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `licencias`
--
ALTER TABLE `licencias`
  ADD CONSTRAINT `licencias_ibfk_1` FOREIGN KEY (`Conductor`) REFERENCES `conductores` (`RFC`);

--
-- Filtros para la tabla `multas`
--
ALTER TABLE `multas`
  ADD CONSTRAINT `multas_ibfk_1` FOREIGN KEY (`idVehiculo`) REFERENCES `vehiculos` (`idVehiculo`),
  ADD CONSTRAINT `multas_ibfk_2` FOREIGN KEY (`idVerificacion`) REFERENCES `verificaciones` (`idVerificacion`),
  ADD CONSTRAINT `multas_ibfk_3` FOREIGN KEY (`Licencia`) REFERENCES `licencias` (`Folio`);

--
-- Filtros para la tabla `robos`
--
ALTER TABLE `robos`
  ADD CONSTRAINT `robos_ibfk_1` FOREIGN KEY (`Vehiculo`) REFERENCES `vehiculos` (`idVehiculo`);

--
-- Filtros para la tabla `tenencias`
--
ALTER TABLE `tenencias`
  ADD CONSTRAINT `tenencias_ibfk_1` FOREIGN KEY (`Vehiculo`) REFERENCES `vehiculos` (`idVehiculo`);

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`Propietario`) REFERENCES `propietarios` (`RFC`);

--
-- Filtros para la tabla `verificaciones`
--
ALTER TABLE `verificaciones`
  ADD CONSTRAINT `verificaciones_ibfk_1` FOREIGN KEY (`Vehiculo`) REFERENCES `vehiculos` (`idVehiculo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
