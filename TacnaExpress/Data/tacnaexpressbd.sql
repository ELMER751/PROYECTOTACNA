-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-02-2024 a las 22:19:34
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tacnaexpressbd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camiones`
--

CREATE TABLE `camiones` (
  `CODIGO` varchar(4) NOT NULL,
  `PLACA` varchar(15) NOT NULL,
  `MARCA` varchar(50) DEFAULT NULL,
  `CERTIFICADO` varchar(15) DEFAULT NULL,
  `CONFIGURACION_VEHICULAR` varchar(10) DEFAULT NULL,
  `CARGA_MAXIMA` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `camiones`
--

INSERT INTO `camiones` (`CODIGO`, `PLACA`, `MARCA`, `CERTIFICADO`, `CONFIGURACION_VEHICULAR`, `CARGA_MAXIMA`) VALUES
('1', 'AAAAA', 'AAAA', 'AAAA', 'AAA', 123);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `RUC_DNI` char(13) NOT NULL,
  `NOMBRE_RAZON` bit(1) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDO_PATERNO` varchar(50) NOT NULL,
  `APELLIDO_MATERNO` varchar(50) NOT NULL,
  `RAZON_SOCIAL` varchar(50) NOT NULL,
  `DIRECCION` varchar(50) NOT NULL,
  `TELEFONO` varchar(50) NOT NULL,
  `CREDITO` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condiciones`
--

CREATE TABLE `condiciones` (
  `TIPDOC` varchar(1) NOT NULL,
  `CODI` varchar(3) NOT NULL,
  `NOMB` varchar(30) DEFAULT NULL,
  `NDIAS` varchar(3) DEFAULT NULL,
  `ACTI` varchar(1) DEFAULT NULL,
  `USER` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_fijos`
--

CREATE TABLE `datos_fijos` (
  `IDDATFI` decimal(18,0) NOT NULL,
  `FEC_TRANS` datetime DEFAULT NULL,
  `LIQUIDACION` varchar(50) DEFAULT NULL,
  `CODIGO_CAMION` varchar(50) DEFAULT NULL,
  `CODIGO_CHOFER` varchar(50) DEFAULT NULL,
  `CODIGO_COPILOTO` varchar(50) DEFAULT NULL,
  `CODIGO_LIQUIDADOR` varchar(50) DEFAULT NULL,
  `FECHA_PARTIDA` datetime DEFAULT NULL,
  `HORA_PARTIDA` char(15) DEFAULT NULL,
  `DIRECCION_PARTIDA` varchar(50) DEFAULT NULL,
  `DIRECCION_LLEGADA_TACNA` varchar(60) DEFAULT NULL,
  `DIRECCION_LLEGADA_ILO` varchar(60) DEFAULT NULL,
  `DIRECCION_LLEGADA_MOQ` varchar(60) DEFAULT NULL,
  `IGV` double DEFAULT NULL,
  `RUC` varchar(50) DEFAULT NULL,
  `CIERRE` decimal(1,0) DEFAULT NULL,
  `LIQUID` char(20) DEFAULT NULL,
  `LIC` varchar(20) DEFAULT NULL,
  `CEDE` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `CODIGO` varchar(50) DEFAULT NULL,
  `PERMISO_ENTRADA` bit(1) NOT NULL,
  `CONTRASEÑA` varchar(50) DEFAULT NULL,
  `OCUPACION` varchar(50) DEFAULT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL,
  `APELLIDO_PATERNO` varchar(50) NOT NULL,
  `APELLIDO_MATERNO` varchar(50) DEFAULT NULL,
  `DNI` varchar(50) DEFAULT NULL,
  `BREVETE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fdoceliminados`
--

CREATE TABLE `fdoceliminados` (
  `ITMS` decimal(18,0) DEFAULT NULL,
  `NDOC` varchar(15) DEFAULT NULL,
  `IDEM` varchar(3) DEFAULT NULL,
  `USUARIO` varchar(50) DEFAULT NULL,
  `FECHA` datetime DEFAULT NULL,
  `HORA` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fmclinic`
--

CREATE TABLE `fmclinic` (
  `CODC` varchar(5) NOT NULL,
  `NOMB` varchar(100) NOT NULL,
  `RAZONSOCIAL` varchar(100) DEFAULT NULL,
  `TIPDOC` varchar(1) DEFAULT NULL,
  `NDOC` varchar(20) DEFAULT NULL,
  `CLINICA` varchar(1) DEFAULT NULL,
  `FENA` datetime DEFAULT NULL,
  `SEXO` varchar(255) DEFAULT NULL,
  `NFAX` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `NATE` float DEFAULT NULL,
  `TIPC` varchar(255) DEFAULT NULL,
  `NRUC` varchar(255) DEFAULT NULL,
  `DIRE` varchar(255) DEFAULT NULL,
  `FONO` varchar(50) DEFAULT NULL,
  `FEIN` datetime DEFAULT NULL,
  `DCTO` float DEFAULT NULL,
  `CARG` float DEFAULT NULL,
  `ABON` float DEFAULT NULL,
  `SALD` float DEFAULT NULL,
  `FLC` varchar(255) DEFAULT NULL,
  `TINA` varchar(255) DEFAULT NULL,
  `TIPN` varchar(255) DEFAULT NULL,
  `TIPFB` varchar(255) DEFAULT NULL,
  `GRUN` varchar(255) DEFAULT NULL,
  `BL01` varchar(255) DEFAULT NULL,
  `BL02` varchar(255) DEFAULT NULL,
  `ESTA` varchar(255) DEFAULT NULL,
  `CHKS` float DEFAULT NULL,
  `REFE` varchar(255) DEFAULT NULL,
  `NRO_HIST` varchar(255) DEFAULT NULL,
  `BCG` varchar(255) DEFAULT NULL,
  `FEC_BCG` varchar(255) DEFAULT NULL,
  `DPT` varchar(255) DEFAULT NULL,
  `FEC_DPT` varchar(255) DEFAULT NULL,
  `POLIO` varchar(255) DEFAULT NULL,
  `FEC_POLIO` varchar(255) DEFAULT NULL,
  `SPP` varchar(255) DEFAULT NULL,
  `FEC_SPP` varchar(255) DEFAULT NULL,
  `GEST` varchar(255) DEFAULT NULL,
  `FEC_ULTR` datetime DEFAULT NULL,
  `FEC_PPAR` datetime DEFAULT NULL,
  `FEC_PART` varchar(255) DEFAULT NULL,
  `CTRL_GEST` varchar(255) DEFAULT NULL,
  `NRO_PRESU` varchar(255) DEFAULT NULL,
  `MONT_PRES` float DEFAULT NULL,
  `COD_ATEN` varchar(255) DEFAULT NULL,
  `NACI_PESO` float DEFAULT NULL,
  `NACI_TALLA` float DEFAULT NULL,
  `NACI_APGAR` float DEFAULT NULL,
  `CONT_PESO` varchar(255) DEFAULT NULL,
  `CONT_TALLA` varchar(255) DEFAULT NULL,
  `PASAP` varchar(255) DEFAULT NULL,
  `PARENT` varchar(255) DEFAULT NULL,
  `USER` varchar(255) DEFAULT NULL,
  `ATENWEB` varchar(50) DEFAULT NULL,
  `USUARIO` varchar(3) DEFAULT NULL,
  `CodDepartamento` varchar(5) DEFAULT NULL,
  `CodProvincia` varchar(5) DEFAULT NULL,
  `EMPRESA` varchar(50) DEFAULT NULL,
  `ACTI` varchar(1) DEFAULT NULL,
  `EST_CIVIL` varchar(1) DEFAULT NULL,
  `CODV` varchar(3) DEFAULT NULL,
  `CODZ` varchar(3) DEFAULT NULL,
  `TOPC` varchar(3) DEFAULT NULL,
  `TITU` varchar(50) DEFAULT NULL,
  `POLIZA` varchar(50) DEFAULT NULL,
  `CERTIF` varchar(50) DEFAULT NULL,
  `RIMA` varchar(50) DEFAULT NULL,
  `COND` varchar(50) DEFAULT NULL,
  `CODE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ftge2007`
--

CREATE TABLE `ftge2007` (
  `IDEM` varchar(2) DEFAULT NULL,
  `CODI` varchar(5) NOT NULL,
  `TITU` varchar(55) DEFAULT NULL,
  `NOMB` varchar(90) DEFAULT NULL,
  `DIRE` varchar(60) DEFAULT NULL,
  `FECH` datetime DEFAULT NULL,
  `FONO` varchar(15) DEFAULT NULL,
  `ACTI` varchar(1) NOT NULL,
  `FLC` varchar(1) DEFAULT NULL,
  `CITY` varchar(8) DEFAULT NULL,
  `PAIS` varchar(20) DEFAULT NULL,
  `COND` varchar(1) DEFAULT NULL,
  `ZONA` varchar(2) DEFAULT NULL,
  `TOLE` float DEFAULT NULL,
  `PLAZ` float DEFAULT NULL,
  `FINA` float DEFAULT NULL,
  `SERIE` varchar(4) DEFAULT NULL,
  `COMC` float DEFAULT NULL,
  `COMC1` float DEFAULT NULL,
  `COMC2` float DEFAULT NULL,
  `MONC` float DEFAULT NULL,
  `PORC` float DEFAULT NULL,
  `PORV` float DEFAULT NULL,
  `MON2` float DEFAULT NULL,
  `MON3` float DEFAULT NULL,
  `TFAX` varchar(30) DEFAULT NULL,
  `RUC` varchar(11) DEFAULT NULL,
  `CODC` varchar(5) DEFAULT NULL,
  `SIGLA` varchar(10) DEFAULT NULL,
  `IDDOC` varchar(1) DEFAULT NULL,
  `USER` varchar(2) DEFAULT NULL,
  `ORDE` float DEFAULT NULL,
  `IDVENTA` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuser`
--

CREATE TABLE `fuser` (
  `CODUSUARIO` varchar(3) NOT NULL,
  `NOMBRES` varchar(30) NOT NULL,
  `PASSWORD` varchar(10) NOT NULL,
  `NIVEL` varchar(1) DEFAULT NULL,
  `ACTI` varchar(1) DEFAULT NULL,
  `USUARIO` varchar(10) DEFAULT NULL,
  `OCUPACION` varchar(50) DEFAULT NULL,
  `DNI` float DEFAULT NULL,
  `BREVETE` varchar(20) DEFAULT NULL,
  `CEDE` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fuser`
--

INSERT INTO `fuser` (`CODUSUARIO`, `NOMBRES`, `PASSWORD`, `NIVEL`, `ACTI`, `USUARIO`, `OCUPACION`, `DNI`, `BREVETE`, `CEDE`) VALUES
('', '', '123', NULL, NULL, 'jose', NULL, NULL, NULL, NULL),
('', '', '123', NULL, NULL, 'elm', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `CODIGO` varchar(2) DEFAULT NULL,
  `DESTINO` varchar(50) DEFAULT NULL,
  `ABREVIATURA` varchar(5) DEFAULT NULL,
  `DIRECCION` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `CODIGO` varchar(3) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camiones`
--
ALTER TABLE `camiones`
  ADD PRIMARY KEY (`CODIGO`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`RUC_DNI`);

--
-- Indices de la tabla `fmclinic`
--
ALTER TABLE `fmclinic`
  ADD PRIMARY KEY (`CODC`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
