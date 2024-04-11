-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-04-2024 a las 01:29:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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
('1', 'AAAAA', 'AAAA', 'AAAA', 'AAA', 123),
('2', 'ggggg', 'gggg', 'tgg', 'gtgtg', 1234);

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
  `CODI` varchar(3) NOT NULL,
  `TIPDOC` varchar(1) DEFAULT NULL,
  `NOMB` varchar(30) DEFAULT NULL,
  `NDIAS` varchar(3) DEFAULT NULL,
  `ACTI` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `condiciones`
--

INSERT INTO `condiciones` (`CODI`, `TIPDOC`, `NOMB`, `NDIAS`, `ACTI`) VALUES
('1', '2', 'CREDITO', '10', '1'),
('2', '2', 'CONTADO', '10', '1'),
('3', '2', 'POR PAGAR', '0', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_fijos`
--

CREATE TABLE `datos_fijos` (
  `IDDATFI` int(10) NOT NULL,
  `FEC_TRANS` date DEFAULT NULL,
  `LIQUIDACION` varchar(50) DEFAULT NULL,
  `CODIGO_CAMION` varchar(50) DEFAULT NULL,
  `CODIGO_CHOFER` varchar(50) DEFAULT NULL,
  `CODIGO_COPILOTO` varchar(50) DEFAULT NULL,
  `CODIGO_LIQUIDADOR` varchar(50) DEFAULT NULL,
  `FECHA_PARTIDA` date DEFAULT NULL,
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

--
-- Volcado de datos para la tabla `datos_fijos`
--

INSERT INTO `datos_fijos` (`IDDATFI`, `FEC_TRANS`, `LIQUIDACION`, `CODIGO_CAMION`, `CODIGO_CHOFER`, `CODIGO_COPILOTO`, `CODIGO_LIQUIDADOR`, `FECHA_PARTIDA`, `HORA_PARTIDA`, `DIRECCION_PARTIDA`, `DIRECCION_LLEGADA_TACNA`, `DIRECCION_LLEGADA_ILO`, `DIRECCION_LLEGADA_MOQ`, `IGV`, `RUC`, `CIERRE`, `LIQUID`, `LIC`, `CEDE`) VALUES
(1, '2024-03-07', '07032024AQP', 'gggg - ggggg', 'RAU', 'RAU', '', '2024-03-07', '10:20:08', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(2, '0000-00-00', '08032024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', '', '2024-03-08', '09:35:19', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(3, '0000-00-00', '08032024CUS', 'AAAA - AAAAA', 'RAU', 'RAU', '', '2024-03-08', '09:36:18', 'CO', '', '', '', NULL, NULL, NULL, NULL, 'A1', '07'),
(4, '2024-03-11', '11032024CUS', 'AAAA - AAAAA', 'RAU', 'RAU', '', '2024-03-11', '09:25:40', 'CO', '', '', '', NULL, NULL, NULL, NULL, 'A1', '07'),
(5, '2024-03-12', '12032024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', '', '2024-03-12', '09:48:03', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(6, '2024-03-13', '13032024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', '', '2024-03-13', '09:05:07', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(7, '2024-03-15', '15032024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', '', '2024-03-15', '09:13:53', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(8, '2024-03-18', '18032024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-03-18', '09:24:37', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(9, '2024-03-19', '19032024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-03-19', '14:01:31', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(10, '2024-03-19', '19032024CUS', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-03-19', '14:38:39', 'CO', '', '', '', NULL, NULL, NULL, NULL, 'A1', '07'),
(11, '2024-03-20', '20032024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-03-20', '14:13:55', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(12, '2024-03-21', '21032024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-03-21', '15:41:27', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(13, '2024-03-22', '22032024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-03-22', '18:07:44', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(14, '2024-03-25', '25032024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-03-25', '14:24:34', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(15, '2024-03-26', '26032024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-03-26', '14:45:58', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(16, '2024-03-28', '28032024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-03-28', '14:13:08', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(17, '2024-04-02', '02042024AQP', 'gggg - ggggg', 'RAU', 'RAU', 'OPE', '2024-04-02', '15:03:14', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(18, '2024-04-04', '04042024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-04-04', '08:20:40', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(19, '2024-04-08', '08042024AQP', 'gggg - ggggg', 'RAU', 'RAU', 'OPE', '2024-04-08', '15:28:41', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(20, '2024-04-09', '09042024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-04-09', '14:03:13', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(21, '2024-04-10', '10042024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-04-10', '13:41:16', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01'),
(22, '2024-04-11', '11042024AQP', 'AAAA - AAAAA', 'RAU', 'RAU', 'OPE', '2024-04-11', '13:45:06', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', '', '', '', NULL, NULL, NULL, NULL, 'A1', '01');

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
-- Estructura de tabla para la tabla `fcabecer`
--

CREATE TABLE `fcabecer` (
  `ID` int(11) NOT NULL,
  `DOC1` varchar(20) NOT NULL,
  `MESP` varchar(4) DEFAULT NULL,
  `IDEM` varchar(3) NOT NULL,
  `IDEM2` varchar(4) DEFAULT NULL,
  `CODI` varchar(11) DEFAULT NULL,
  `SERV` varchar(5) DEFAULT NULL,
  `USER` varchar(2) DEFAULT NULL,
  `DOC2` varchar(255) DEFAULT NULL,
  `GUIA` varchar(12) DEFAULT NULL,
  `DSCG` float DEFAULT NULL,
  `DSCGA` float DEFAULT NULL,
  `DSCGI` float DEFAULT NULL,
  `MONB` float DEFAULT NULL,
  `MONBC` float DEFAULT NULL,
  `DSCT` float DEFAULT NULL,
  `EXON` float DEFAULT NULL,
  `EXON1` float DEFAULT NULL,
  `TOTV` float DEFAULT NULL,
  `TOTV_IGVE` float DEFAULT NULL,
  `IGV` float DEFAULT NULL,
  `IGVE` float DEFAULT NULL,
  `TOTL` float DEFAULT NULL,
  `FLET` float DEFAULT NULL,
  `OTRG` float DEFAULT NULL,
  `IGV1` float DEFAULT NULL,
  `CODV` varchar(5) DEFAULT NULL,
  `NFAC` varchar(11) DEFAULT NULL,
  `TIPO` varchar(2) DEFAULT NULL,
  `LTRA` varchar(11) DEFAULT NULL,
  `GUTR` varchar(6) DEFAULT NULL,
  `EMIT` varchar(1) DEFAULT NULL,
  `ESTA` varchar(20) DEFAULT NULL,
  `FEC1` date DEFAULT NULL,
  `COND` varchar(3) DEFAULT NULL,
  `FEC2` date DEFAULT NULL,
  `FEC3` date DEFAULT NULL,
  `FLC` varchar(1) DEFAULT NULL,
  `DOCIDENT` varchar(10) DEFAULT NULL,
  `NOMBCLIE` varchar(50) DEFAULT NULL,
  `NOMEMPRE` varchar(60) DEFAULT NULL,
  `RUCEMPRE` varchar(11) DEFAULT NULL,
  `DIREMPRE` varchar(80) DEFAULT NULL,
  `RUCDNIRE` varchar(11) DEFAULT NULL,
  `NOMBRE` varchar(60) DEFAULT NULL,
  `DIRERE` varchar(80) DEFAULT NULL,
  `RUCDNICO` varchar(11) DEFAULT NULL,
  `NOMBCO` varchar(60) DEFAULT NULL,
  `DIRECO` varchar(80) DEFAULT NULL,
  `RUTADES` varchar(3) DEFAULT NULL,
  `ODESORI` varchar(2) DEFAULT NULL,
  `PLACA` varchar(15) DEFAULT NULL,
  `LIC` varchar(15) DEFAULT NULL,
  `CHOFCOND` varchar(5) DEFAULT NULL,
  `DEDUCIBLE` float DEFAULT NULL,
  `COASEGUR` float DEFAULT NULL,
  `COASEGURO` float DEFAULT NULL,
  `CODASEGU` varchar(5) DEFAULT NULL,
  `TIP_CAMB` float DEFAULT NULL,
  `MONEDA` varchar(3) DEFAULT NULL,
  `EMISION` float DEFAULT NULL,
  `MONT_DEDU` float DEFAULT NULL,
  `MONT_COAS` float DEFAULT NULL,
  `MONT_PADE` float DEFAULT NULL,
  `MONT_PACO` float DEFAULT NULL,
  `MONT_PALA` float DEFAULT NULL,
  `MONT_PAME` float DEFAULT NULL,
  `MONT_PAMF` float DEFAULT NULL,
  `MONT_PACL` float DEFAULT NULL,
  `MONT_PAOD` float DEFAULT NULL,
  `MONT_PAFA` float DEFAULT NULL,
  `MONT_PACA` float DEFAULT NULL,
  `MONT_PAIM` float DEFAULT NULL,
  `MONT_PATO` float DEFAULT NULL,
  `MONT_COASI` float DEFAULT NULL,
  `MONT_DSCTF` float DEFAULT NULL,
  `MONT_DSCTFI` float DEFAULT NULL,
  `MONT_PACOI` float DEFAULT NULL,
  `MONT_PAFAI` float DEFAULT NULL,
  `MONT_PAFNC` float DEFAULT NULL,
  `MOTIVO` varchar(2) DEFAULT NULL,
  `FEC_DEV` datetime DEFAULT NULL,
  `FEC_ANU` datetime DEFAULT NULL,
  `DEPENDENCIA` varchar(2) DEFAULT NULL,
  `RESPONSABLE` varchar(60) DEFAULT NULL,
  `DSCT_FAR` float DEFAULT NULL,
  `IDPASEG` varchar(1) DEFAULT NULL,
  `IDFADIR` varchar(1) DEFAULT NULL,
  `LOTE` varchar(10) DEFAULT NULL,
  `ORDLOTE` float DEFAULT NULL,
  `FCH_ENVIO` datetime DEFAULT NULL,
  `MODO_PAGO` varchar(2) DEFAULT NULL,
  `Nro_soli` varchar(8) DEFAULT NULL,
  `NCONSUL` varchar(2) DEFAULT NULL,
  `COD_COBER` varchar(2) DEFAULT NULL,
  `TIPENTIDAD` varchar(6) DEFAULT NULL,
  `NATENCIONES` varchar(6) DEFAULT NULL,
  `FECENVIO` datetime DEFAULT NULL,
  `HORAENVIO` varchar(6) DEFAULT NULL,
  `TIPOLOTE` varchar(10) DEFAULT NULL,
  `DOCREFE` varchar(1) DEFAULT NULL,
  `CODPACI` varchar(50) DEFAULT NULL,
  `TIPOAFILI` varchar(10) DEFAULT NULL,
  `NDOCATEN` varchar(10) DEFAULT NULL,
  `SNDOCATEN` varchar(10) DEFAULT NULL,
  `NIVELATEN` varchar(10) DEFAULT NULL,
  `TIPCOBER` varchar(10) DEFAULT NULL,
  `RESPONSA` varchar(10) DEFAULT NULL,
  `DOCAUTORI` varchar(10) DEFAULT NULL,
  `NAUTORIZA` varchar(10) DEFAULT NULL,
  `FACTGLOBAL` varchar(1) DEFAULT NULL,
  `NRO_NOTAC` varchar(8) DEFAULT NULL,
  `VAL_NOTC` varchar(53) DEFAULT NULL,
  `USUARIO` varchar(3) DEFAULT NULL,
  `HORAREG` varchar(13) DEFAULT NULL,
  `FECREG` date DEFAULT NULL,
  `IDSEPARADOIGV` varchar(1) DEFAULT NULL,
  `INCRE2` float DEFAULT NULL,
  `CMP` varchar(10) DEFAULT NULL,
  `IDGUIAFACT` varchar(1) DEFAULT NULL,
  `DOCGUIAS` varchar(50) DEFAULT NULL,
  `GUIAFACTURADA` varchar(1) DEFAULT NULL,
  `IDJUNTADO` varchar(6) DEFAULT NULL,
  `FENVICONTEXP` datetime DEFAULT NULL,
  `LOTECONTEXP` varchar(6) DEFAULT NULL,
  `NDIAS` varchar(3) DEFAULT NULL,
  `IDCTE` varchar(1) DEFAULT NULL,
  `MASIGV` varchar(1) DEFAULT NULL,
  `OBSERV` varchar(100) DEFAULT NULL,
  `NROCUOTAS` varchar(2) DEFAULT NULL,
  `MONTOCUOTA` float DEFAULT NULL,
  `FECCUOTA` datetime DEFAULT NULL,
  `SEDE` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fcabecer`
--

INSERT INTO `fcabecer` (`ID`, `DOC1`, `MESP`, `IDEM`, `IDEM2`, `CODI`, `SERV`, `USER`, `DOC2`, `GUIA`, `DSCG`, `DSCGA`, `DSCGI`, `MONB`, `MONBC`, `DSCT`, `EXON`, `EXON1`, `TOTV`, `TOTV_IGVE`, `IGV`, `IGVE`, `TOTL`, `FLET`, `OTRG`, `IGV1`, `CODV`, `NFAC`, `TIPO`, `LTRA`, `GUTR`, `EMIT`, `ESTA`, `FEC1`, `COND`, `FEC2`, `FEC3`, `FLC`, `DOCIDENT`, `NOMBCLIE`, `NOMEMPRE`, `RUCEMPRE`, `DIREMPRE`, `RUCDNIRE`, `NOMBRE`, `DIRERE`, `RUCDNICO`, `NOMBCO`, `DIRECO`, `RUTADES`, `ODESORI`, `PLACA`, `LIC`, `CHOFCOND`, `DEDUCIBLE`, `COASEGUR`, `COASEGURO`, `CODASEGU`, `TIP_CAMB`, `MONEDA`, `EMISION`, `MONT_DEDU`, `MONT_COAS`, `MONT_PADE`, `MONT_PACO`, `MONT_PALA`, `MONT_PAME`, `MONT_PAMF`, `MONT_PACL`, `MONT_PAOD`, `MONT_PAFA`, `MONT_PACA`, `MONT_PAIM`, `MONT_PATO`, `MONT_COASI`, `MONT_DSCTF`, `MONT_DSCTFI`, `MONT_PACOI`, `MONT_PAFAI`, `MONT_PAFNC`, `MOTIVO`, `FEC_DEV`, `FEC_ANU`, `DEPENDENCIA`, `RESPONSABLE`, `DSCT_FAR`, `IDPASEG`, `IDFADIR`, `LOTE`, `ORDLOTE`, `FCH_ENVIO`, `MODO_PAGO`, `Nro_soli`, `NCONSUL`, `COD_COBER`, `TIPENTIDAD`, `NATENCIONES`, `FECENVIO`, `HORAENVIO`, `TIPOLOTE`, `DOCREFE`, `CODPACI`, `TIPOAFILI`, `NDOCATEN`, `SNDOCATEN`, `NIVELATEN`, `TIPCOBER`, `RESPONSA`, `DOCAUTORI`, `NAUTORIZA`, `FACTGLOBAL`, `NRO_NOTAC`, `VAL_NOTC`, `USUARIO`, `HORAREG`, `FECREG`, `IDSEPARADOIGV`, `INCRE2`, `CMP`, `IDGUIAFACT`, `DOCGUIAS`, `GUIAFACTURADA`, `IDJUNTADO`, `FENVICONTEXP`, `LOTECONTEXP`, `NDIAS`, `IDCTE`, `MASIGV`, `OBSERV`, `NROCUOTAS`, `MONTOCUOTA`, `FECCUOTA`, `SEDE`) VALUES
(1, '000001', '1104', '40', '002', '72663810', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1374.32, NULL, 0, NULL, NULL, 1374.32, NULL, 18, 301.68, 1676, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'EMITIDO', '2024-04-11', '2', '2024-04-11', NULL, NULL, NULL, NULL, 'CHANCAYAURI POCCORI ELMER LEONARDO', '72663810', 'Arequipa', '72663811', 'CHANCAYAURI POCCORI KIMBERLY CRISTINA', 'Arequipa', '72663816', 'MAMANI VILCA BEATRIZ', 'Arequipa', '1', 'O', 'AAAAA', 'A1', 'RAU', NULL, NULL, NULL, NULL, 1, 'S/.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, NULL, NULL, 'A', '16:09:15', '2024-04-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', '0', '0', 'Se entrega mañana', NULL, NULL, NULL, '01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fdoceliminados`
--

CREATE TABLE `fdoceliminados` (
  `ITMS` decimal(18,0) DEFAULT NULL,
  `NDOC` varchar(15) DEFAULT NULL,
  `IDEM` varchar(3) DEFAULT NULL,
  `USUARIO` varchar(50) DEFAULT NULL,
  `FECHA` date DEFAULT current_timestamp(),
  `HORA` time DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fmclinic`
--

CREATE TABLE `fmclinic` (
  `CODC` int(5) NOT NULL,
  `NOMB` varchar(200) DEFAULT NULL,
  `RAZON_SOCIAL` varchar(200) DEFAULT NULL,
  `FENA` date DEFAULT NULL,
  `NRUC` varchar(20) DEFAULT NULL,
  `DNI` varchar(8) DEFAULT NULL,
  `DIRE` varchar(200) DEFAULT NULL,
  `FONO` varchar(20) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `EMAIL` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fmclinic`
--

INSERT INTO `fmclinic` (`CODC`, `NOMB`, `RAZON_SOCIAL`, `FENA`, `NRUC`, `DNI`, `DIRE`, `FONO`, `fecha_actualizacion`, `EMAIL`) VALUES
(4, 'MAMANI VILCA BEATRIZ', '', '2024-03-04', '', '72663816', 'Arequipa', '', '2024-03-04 17:02:11', 'jorge_gd20@hotmail.com'),
(10, 'CHANCAYAURI POCCORI ELMER LEONARDO', 'SDFSDF', '2024-03-18', '01020304051', '72663810', 'Arequipa', '969037172', '2024-03-18 14:30:34', ',chancayaurie@gmail.com'),
(11, 'CHANCAYAURI POCCORI KIMBERLY CRISTINA', NULL, '2024-04-04', NULL, '72663811', 'Arequipa', '969037172', '2024-04-04 16:23:56', ',chancayaurie@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fmovimie`
--

CREATE TABLE `fmovimie` (
  `ID` int(11) NOT NULL,
  `NORD` int(11) NOT NULL,
  `MESP` varchar(4) DEFAULT NULL,
  `IDEM` varchar(6) NOT NULL,
  `IDEM2` varchar(4) DEFAULT NULL,
  `IDEM3` varchar(3) DEFAULT NULL,
  `IDELT` varchar(1) DEFAULT NULL,
  `ITEM` varchar(3) DEFAULT NULL,
  `DOC1` varchar(10) NOT NULL,
  `USER` varchar(2) DEFAULT NULL,
  `DOC2` varchar(20) DEFAULT NULL,
  `CODT` varchar(8) DEFAULT NULL,
  `CODT1` varchar(8) DEFAULT NULL,
  `CARAS` varchar(8) DEFAULT NULL,
  `PZA` varchar(2) DEFAULT NULL,
  `TPACI` varchar(15) DEFAULT NULL,
  `CMP` varchar(6) DEFAULT NULL,
  `GUIA_RECE` varchar(12) DEFAULT NULL,
  `FEC_EXP` date DEFAULT NULL,
  `AFECTMD` varchar(1) DEFAULT NULL,
  `COD_SERV` varchar(3) DEFAULT NULL,
  `TIPO_EXA` varchar(2) DEFAULT NULL,
  `TIPO_SER` varchar(1) DEFAULT NULL,
  `COD_DEST` varchar(1) DEFAULT NULL,
  `CANT` float DEFAULT NULL,
  `CANTNA` float DEFAULT NULL,
  `CANT1` float DEFAULT NULL,
  `CAJA` float DEFAULT NULL,
  `FRACCION` float DEFAULT NULL,
  `BONI` float DEFAULT NULL,
  `PREC` float DEFAULT NULL,
  `COST` float DEFAULT NULL,
  `PRE_UNI` float DEFAULT NULL,
  `SEG` varchar(50) DEFAULT NULL,
  `AFECTO` varchar(1) DEFAULT NULL,
  `COSP` float DEFAULT NULL,
  `DSCT` float DEFAULT NULL,
  `DSCT2` float DEFAULT NULL,
  `MONT_DSCT` float DEFAULT NULL,
  `MONDSCTIGV` float DEFAULT NULL,
  `IGVE` float DEFAULT NULL,
  `VVTA` float DEFAULT NULL,
  `VVTAIGV` float DEFAULT NULL,
  `MONT_CLIN` float DEFAULT NULL,
  `P_CLINICA` float DEFAULT NULL,
  `COND` varchar(2) DEFAULT NULL,
  `GLOS` varchar(40) DEFAULT NULL,
  `MESC` varchar(2) DEFAULT NULL,
  `COD_ASEG` varchar(10) DEFAULT NULL,
  `FECH` date DEFAULT NULL,
  `FLC` varchar(1) DEFAULT NULL,
  `COD_FACT` varchar(1) DEFAULT NULL,
  `DESC_PROD` varchar(80) DEFAULT NULL,
  `RECI_HONO` varchar(11) DEFAULT NULL,
  `FEC_RECIB` datetime DEFAULT NULL,
  `GRUPO` varchar(4) DEFAULT NULL,
  `NRO_DOCUM` varchar(10) DEFAULT NULL,
  `FORM_PAGO` varchar(1) DEFAULT NULL,
  `NOTA_CRED` varchar(1) DEFAULT NULL,
  `NRO_NOTAC` varchar(8) DEFAULT NULL,
  `VAL_NOTC` float DEFAULT NULL,
  `NRO_CHEQ` varchar(8) DEFAULT NULL,
  `NOM_BANC` varchar(11) DEFAULT NULL,
  `CTA_GIRA` varchar(10) DEFAULT NULL,
  `FEC_VENC` datetime DEFAULT NULL,
  `CANT_CAMB` float DEFAULT NULL,
  `NFEC_VENC` datetime DEFAULT NULL,
  `MONT_COAS` float DEFAULT NULL,
  `COM_CLI` float DEFAULT NULL,
  `COM_COB` float DEFAULT NULL,
  `COM_OTR` float DEFAULT NULL,
  `NPLANILLA` varchar(10) DEFAULT NULL,
  `UNDS` float DEFAULT NULL,
  `LOTE` varchar(10) DEFAULT NULL,
  `IDCQ` varchar(2) DEFAULT NULL,
  `NDIAS` float DEFAULT NULL,
  `NRO_DOCU` varchar(12) DEFAULT NULL,
  `NRO_DOCU1` varchar(12) DEFAULT NULL,
  `CHKDESC` varchar(1) DEFAULT NULL,
  `DESCFB` varchar(200) DEFAULT NULL,
  `NOPE` varchar(6) DEFAULT NULL,
  `MARCA` varchar(1) DEFAULT NULL,
  `NETO_M` float DEFAULT NULL,
  `IDCOAS` varchar(13) DEFAULT NULL,
  `IDAIGV` varchar(1) DEFAULT NULL,
  `INSUMO` varchar(1) DEFAULT NULL,
  `USUARIO` varchar(3) DEFAULT NULL,
  `COD_PERF` varchar(6) DEFAULT NULL,
  `VAL_FACT` float DEFAULT NULL,
  `FECHA_MOVIMIENTO` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fmovimie`
--

INSERT INTO `fmovimie` (`ID`, `NORD`, `MESP`, `IDEM`, `IDEM2`, `IDEM3`, `IDELT`, `ITEM`, `DOC1`, `USER`, `DOC2`, `CODT`, `CODT1`, `CARAS`, `PZA`, `TPACI`, `CMP`, `GUIA_RECE`, `FEC_EXP`, `AFECTMD`, `COD_SERV`, `TIPO_EXA`, `TIPO_SER`, `COD_DEST`, `CANT`, `CANTNA`, `CANT1`, `CAJA`, `FRACCION`, `BONI`, `PREC`, `COST`, `PRE_UNI`, `SEG`, `AFECTO`, `COSP`, `DSCT`, `DSCT2`, `MONT_DSCT`, `MONDSCTIGV`, `IGVE`, `VVTA`, `VVTAIGV`, `MONT_CLIN`, `P_CLINICA`, `COND`, `GLOS`, `MESC`, `COD_ASEG`, `FECH`, `FLC`, `COD_FACT`, `DESC_PROD`, `RECI_HONO`, `FEC_RECIB`, `GRUPO`, `NRO_DOCUM`, `FORM_PAGO`, `NOTA_CRED`, `NRO_NOTAC`, `VAL_NOTC`, `NRO_CHEQ`, `NOM_BANC`, `CTA_GIRA`, `FEC_VENC`, `CANT_CAMB`, `NFEC_VENC`, `MONT_COAS`, `COM_CLI`, `COM_COB`, `COM_OTR`, `NPLANILLA`, `UNDS`, `LOTE`, `IDCQ`, `NDIAS`, `NRO_DOCU`, `NRO_DOCU1`, `CHKDESC`, `DESCFB`, `NOPE`, `MARCA`, `NETO_M`, `IDCOAS`, `IDAIGV`, `INSUMO`, `USUARIO`, `COD_PERF`, `VAL_FACT`, `FECHA_MOVIMIENTO`) VALUES
(1, 1, '1104', '40', '002', NULL, '', NULL, '000001', NULL, NULL, '000000', NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-11', NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, 0, 13, 13, NULL, NULL, NULL, 0, 0, NULL, 0, 0, 18, 156, 156, NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-11', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'sqsq', NULL, NULL, NULL, NULL, '1', NULL, 'A', NULL, 0, '2024-04-11 21:09:16'),
(2, 2, '1104', '40', '002', NULL, '', NULL, '000001', NULL, NULL, '000000', NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-11', NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, NULL, 0, 13, 13, NULL, NULL, NULL, 0, 0, NULL, 0, 0, 18, 156, 156, NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-11', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'dsd', NULL, NULL, NULL, NULL, '1', NULL, 'A', NULL, 0, '2024-04-11 21:09:16'),
(3, 3, '1104', '40', '002', NULL, '', NULL, '000001', NULL, NULL, '000000', NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-11', NULL, NULL, NULL, NULL, NULL, 31, NULL, NULL, NULL, NULL, 0, 13, 13, NULL, NULL, NULL, 0, 0, NULL, 0, 0, 18, 403, 403, NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-11', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'ewe', NULL, NULL, NULL, NULL, '1', NULL, 'A', NULL, 0, '2024-04-11 21:09:16'),
(4, 4, '1104', '40', '002', NULL, '', NULL, '000001', NULL, NULL, '000000', NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-11', NULL, NULL, NULL, NULL, NULL, 31, NULL, NULL, NULL, NULL, 0, 31, 31, NULL, NULL, NULL, 0, 0, NULL, 0, 0, 18, 961, 961, NULL, NULL, NULL, NULL, NULL, NULL, '2024-04-11', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'erer', NULL, NULL, NULL, NULL, '1', NULL, 'A', NULL, 0, '2024-04-11 21:09:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fmovimpfd`
--

CREATE TABLE `fmovimpfd` (
  `IDBF` varchar(3) DEFAULT NULL,
  `IDEM` varchar(3) DEFAULT NULL,
  `IDEM2` varchar(4) DEFAULT NULL,
  `DOC1` varchar(10) DEFAULT NULL,
  `DOC2` varchar(6) DEFAULT NULL,
  `FEC_ADMI` date DEFAULT NULL,
  `NOMBEMP` varchar(100) DEFAULT NULL,
  `NOMCLI` varchar(100) DEFAULT NULL,
  `F_MATE` datetime DEFAULT NULL,
  `DIREEMP` varchar(100) DEFAULT NULL,
  `RUC` varchar(11) DEFAULT NULL,
  `NORD` float DEFAULT NULL,
  `CANT` varchar(50) DEFAULT NULL,
  `UNIDA` varchar(8) DEFAULT NULL,
  `DESCP` varchar(250) DEFAULT NULL,
  `DSCTO` float DEFAULT NULL,
  `VIGV` float DEFAULT NULL,
  `PUNIT` float DEFAULT NULL,
  `PTOTA` float DEFAULT NULL,
  `VALIGV` float DEFAULT NULL,
  `MLETRA` varchar(255) DEFAULT NULL,
  `DGRUP` varchar(80) DEFAULT NULL,
  `BENEFICIO` varchar(80) DEFAULT NULL,
  `MONTDEDU` float DEFAULT NULL,
  `MONTCOAS` float DEFAULT NULL,
  `FECEMI` date DEFAULT NULL,
  `FACDC` varchar(1) DEFAULT NULL,
  `PCOAS` float DEFAULT NULL,
  `TOTBRUTO` float DEFAULT NULL,
  `TOTALDSCTO` float DEFAULT NULL,
  `TOTALVENTA` float DEFAULT NULL,
  `MONTOIGV` float DEFAULT NULL,
  `PRECIOVETA` float DEFAULT NULL,
  `AFECTOIGV` varchar(1) DEFAULT NULL,
  `USUARIO` varchar(50) DEFAULT NULL,
  `HORAPRINT` time DEFAULT current_timestamp(),
  `FECPRINT` date DEFAULT current_timestamp(),
  `MONEDA` varchar(3) DEFAULT NULL,
  `NGUIA` varchar(10) DEFAULT NULL,
  `NFACBOL` varchar(10) DEFAULT NULL,
  `RUCDNIR` varchar(11) DEFAULT NULL,
  `NOMBRE` varchar(60) DEFAULT NULL,
  `DIRERE` varchar(80) DEFAULT NULL,
  `RUCDNIC` varchar(11) DEFAULT NULL,
  `NOMBC` varchar(60) DEFAULT NULL,
  `DIREC` varchar(80) DEFAULT NULL,
  `DESTINO` varchar(20) DEFAULT NULL,
  `ODEOF` varchar(5) DEFAULT NULL,
  `PLACA` varchar(15) DEFAULT NULL,
  `MARCA` varchar(50) DEFAULT NULL,
  `CERTIFICADO` varchar(50) DEFAULT NULL,
  `LIC` varchar(50) DEFAULT NULL,
  `CONFVHEICU` varchar(50) DEFAULT NULL,
  `PESO` varchar(50) DEFAULT NULL,
  `CHOFCONDU` varchar(60) DEFAULT NULL,
  `DIRPARTIDA` varchar(60) DEFAULT NULL,
  `DIRLLEGADA` varchar(60) DEFAULT NULL,
  `CEDE` varchar(2) DEFAULT NULL,
  `CONDI` varchar(15) DEFAULT NULL,
  `OBSERV` varchar(100) DEFAULT NULL,
  `NROCUOTAS` varchar(2) DEFAULT NULL,
  `MONTOCUOTA` float DEFAULT NULL,
  `FECCUOTA` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fmovimpfd`
--

INSERT INTO `fmovimpfd` (`IDBF`, `IDEM`, `IDEM2`, `DOC1`, `DOC2`, `FEC_ADMI`, `NOMBEMP`, `NOMCLI`, `F_MATE`, `DIREEMP`, `RUC`, `NORD`, `CANT`, `UNIDA`, `DESCP`, `DSCTO`, `VIGV`, `PUNIT`, `PTOTA`, `VALIGV`, `MLETRA`, `DGRUP`, `BENEFICIO`, `MONTDEDU`, `MONTCOAS`, `FECEMI`, `FACDC`, `PCOAS`, `TOTBRUTO`, `TOTALDSCTO`, `TOTALVENTA`, `MONTOIGV`, `PRECIOVETA`, `AFECTOIGV`, `USUARIO`, `HORAPRINT`, `FECPRINT`, `MONEDA`, `NGUIA`, `NFACBOL`, `RUCDNIR`, `NOMBRE`, `DIRERE`, `RUCDNIC`, `NOMBC`, `DIREC`, `DESTINO`, `ODEOF`, `PLACA`, `MARCA`, `CERTIFICADO`, `LIC`, `CONFVHEICU`, `PESO`, `CHOFCONDU`, `DIRPARTIDA`, `DIRLLEGADA`, `CEDE`, `CONDI`, `OBSERV`, `NROCUOTAS`, `MONTOCUOTA`, `FECCUOTA`) VALUES
('14', '40', '002', '1', NULL, '2024-04-11', 'CHANCAYAURI POCCORI ELMER LEONARDO', NULL, NULL, 'Arequipa', '72663810', 1, '12', 'UND', 'sqsq', 0, 18, 13, 156, NULL, 'MIL SEIS CIENTOS SETENTA Y  SEIS CON 0/100 NUEVOS SOLES', NULL, NULL, NULL, NULL, '2024-04-11', NULL, NULL, 127.92, 0, 1374.32, 301.68, 1676, '0', 'ADMINISTRADOR', '16:09:16', '2024-04-11', 'S/.', '', '', '72663811', 'CHANCAYAURI POCCORI KIMBERLY CRISTINA', 'Arequipa', '72663816', 'MAMANI VILCA BEATRIZ', 'Arequipa', '1', 'O', 'AAAAA', 'AAAA', 'AAAA', 'A1', 'AAA', '123', 'RAU', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', 'Arequipa', '01', '2', 'Se entrega mañana', NULL, NULL, NULL),
('14', '40', '002', '1', NULL, '2024-04-11', 'CHANCAYAURI POCCORI ELMER LEONARDO', NULL, NULL, 'Arequipa', '72663810', 2, '12', 'UND', 'dsd', 0, 18, 13, 156, NULL, 'MIL SEIS CIENTOS SETENTA Y  SEIS CON 0/100 NUEVOS SOLES', NULL, NULL, NULL, NULL, '2024-04-11', NULL, NULL, 127.92, 0, 1374.32, 301.68, 1676, '0', 'ADMINISTRADOR', '16:09:16', '2024-04-11', 'S/.', '', '', '72663811', 'CHANCAYAURI POCCORI KIMBERLY CRISTINA', 'Arequipa', '72663816', 'MAMANI VILCA BEATRIZ', 'Arequipa', '1', 'O', 'AAAAA', 'AAAA', 'AAAA', 'A1', 'AAA', '123', 'RAU', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', 'Arequipa', '01', '2', 'Se entrega mañana', NULL, NULL, NULL),
('14', '40', '002', '1', NULL, '2024-04-11', 'CHANCAYAURI POCCORI ELMER LEONARDO', NULL, NULL, 'Arequipa', '72663810', 3, '31', 'UND', 'ewe', 0, 18, 13, 403, NULL, 'MIL SEIS CIENTOS SETENTA Y  SEIS CON 0/100 NUEVOS SOLES', NULL, NULL, NULL, NULL, '2024-04-11', NULL, NULL, 330.46, 0, 1374.32, 301.68, 1676, '0', 'ADMINISTRADOR', '16:09:16', '2024-04-11', 'S/.', '', '', '72663811', 'CHANCAYAURI POCCORI KIMBERLY CRISTINA', 'Arequipa', '72663816', 'MAMANI VILCA BEATRIZ', 'Arequipa', '1', 'O', 'AAAAA', 'AAAA', 'AAAA', 'A1', 'AAA', '123', 'RAU', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', 'Arequipa', '01', '2', 'Se entrega mañana', NULL, NULL, NULL),
('14', '40', '002', '1', NULL, '2024-04-11', 'CHANCAYAURI POCCORI ELMER LEONARDO', NULL, NULL, 'Arequipa', '72663810', 4, '31', 'UND', 'erer', 0, 18, 31, 961, NULL, 'MIL SEIS CIENTOS SETENTA Y  SEIS CON 0/100 NUEVOS SOLES', NULL, NULL, NULL, NULL, '2024-04-11', NULL, NULL, 788.02, 0, 1374.32, 301.68, 1676, '0', 'ADMINISTRADOR', '16:09:16', '2024-04-11', 'S/.', '', '', '72663811', 'CHANCAYAURI POCCORI KIMBERLY CRISTINA', 'Arequipa', '72663816', 'MAMANI VILCA BEATRIZ', 'Arequipa', '1', 'O', 'AAAAA', 'AAAA', 'AAAA', 'A1', 'AAA', '123', 'RAU', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', 'Arequipa', '01', '2', 'Se entrega mañana', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fmovimpfde`
--

CREATE TABLE `fmovimpfde` (
  `CODT` int(11) NOT NULL,
  `IDBF` varchar(3) DEFAULT NULL,
  `IDEM` varchar(3) DEFAULT NULL,
  `IDEM2` varchar(4) DEFAULT NULL,
  `DOC1` varchar(10) DEFAULT NULL,
  `DOC2` varchar(6) DEFAULT NULL,
  `FEC_ADMI` date DEFAULT NULL,
  `NOMBEMP` varchar(100) DEFAULT NULL,
  `NOMCLI` varchar(100) DEFAULT NULL,
  `F_MATE` datetime DEFAULT NULL,
  `DIREEMP` varchar(100) DEFAULT NULL,
  `RUC` varchar(11) DEFAULT NULL,
  `NORD` float DEFAULT NULL,
  `CANT` varchar(50) DEFAULT NULL,
  `UNIDA` varchar(8) DEFAULT NULL,
  `DESCP` varchar(250) DEFAULT NULL,
  `DSCTO` float DEFAULT NULL,
  `VIGV` float DEFAULT NULL,
  `PUNIT` float DEFAULT NULL,
  `PTOTA` float DEFAULT NULL,
  `VALIGV` float DEFAULT NULL,
  `MLETRA` varchar(255) DEFAULT NULL,
  `DGRUP` varchar(80) DEFAULT NULL,
  `BENEFICIO` varchar(80) DEFAULT NULL,
  `MONTDEDU` float DEFAULT NULL,
  `MONTCOAS` float DEFAULT NULL,
  `FECEMI` date DEFAULT NULL,
  `FACDC` varchar(1) DEFAULT NULL,
  `PCOAS` float DEFAULT NULL,
  `TOTBRUTO` float DEFAULT NULL,
  `TOTALDSCTO` float DEFAULT NULL,
  `TOTALVENTA` float DEFAULT NULL,
  `MONTOIGV` float DEFAULT NULL,
  `PRECIOVETA` float DEFAULT NULL,
  `AFECTOIGV` varchar(1) DEFAULT NULL,
  `USUARIO` varchar(50) DEFAULT NULL,
  `HORAPRINT` time DEFAULT current_timestamp(),
  `FECPRINT` date DEFAULT current_timestamp(),
  `MONEDA` varchar(3) DEFAULT NULL,
  `NGUIA` varchar(10) DEFAULT NULL,
  `NFACBOL` varchar(10) DEFAULT NULL,
  `RUCDNIR` varchar(11) DEFAULT NULL,
  `NOMBRE` varchar(60) DEFAULT NULL,
  `DIRERE` varchar(80) DEFAULT NULL,
  `RUCDNIC` varchar(11) DEFAULT NULL,
  `NOMBC` varchar(60) DEFAULT NULL,
  `DIREC` varchar(80) DEFAULT NULL,
  `DESTINO` varchar(20) DEFAULT NULL,
  `ODEOF` varchar(5) DEFAULT NULL,
  `PLACA` varchar(15) DEFAULT NULL,
  `MARCA` varchar(50) DEFAULT NULL,
  `CERTIFICADO` varchar(50) DEFAULT NULL,
  `LIC` varchar(50) DEFAULT NULL,
  `CONFVHEICU` varchar(50) DEFAULT NULL,
  `PESO` varchar(50) DEFAULT NULL,
  `CHOFCONDU` varchar(60) DEFAULT NULL,
  `DIRPARTIDA` varchar(60) DEFAULT NULL,
  `DIRLLEGADA` varchar(60) DEFAULT NULL,
  `CEDE` varchar(2) DEFAULT NULL,
  `CONDI` varchar(15) DEFAULT NULL,
  `OBSERV` varchar(100) DEFAULT NULL,
  `NROCUOTAS` varchar(2) DEFAULT NULL,
  `MONTOCUOTA` float DEFAULT NULL,
  `FECCUOTA` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fmovimpfde`
--

INSERT INTO `fmovimpfde` (`CODT`, `IDBF`, `IDEM`, `IDEM2`, `DOC1`, `DOC2`, `FEC_ADMI`, `NOMBEMP`, `NOMCLI`, `F_MATE`, `DIREEMP`, `RUC`, `NORD`, `CANT`, `UNIDA`, `DESCP`, `DSCTO`, `VIGV`, `PUNIT`, `PTOTA`, `VALIGV`, `MLETRA`, `DGRUP`, `BENEFICIO`, `MONTDEDU`, `MONTCOAS`, `FECEMI`, `FACDC`, `PCOAS`, `TOTBRUTO`, `TOTALDSCTO`, `TOTALVENTA`, `MONTOIGV`, `PRECIOVETA`, `AFECTOIGV`, `USUARIO`, `HORAPRINT`, `FECPRINT`, `MONEDA`, `NGUIA`, `NFACBOL`, `RUCDNIR`, `NOMBRE`, `DIRERE`, `RUCDNIC`, `NOMBC`, `DIREC`, `DESTINO`, `ODEOF`, `PLACA`, `MARCA`, `CERTIFICADO`, `LIC`, `CONFVHEICU`, `PESO`, `CHOFCONDU`, `DIRPARTIDA`, `DIRLLEGADA`, `CEDE`, `CONDI`, `OBSERV`, `NROCUOTAS`, `MONTOCUOTA`, `FECCUOTA`) VALUES
(1, '14', '40', '002', '000001', NULL, '2024-04-11', 'CHANCAYAURI POCCORI ELMER LEONARDO', NULL, NULL, 'Arequipa', '72663810', 1, '12', 'UND', 'sqsq', 0, 18, 13, 156, NULL, 'MIL SEIS CIENTOS SETENTA Y  SEIS CON 0/100 NUEVOS SOLES', NULL, NULL, NULL, NULL, '2024-04-11', NULL, NULL, 127.92, 0, 1374.32, 301.68, 1676, '0', 'ADMINISTRADOR', '16:09:16', '2024-04-11', 'S/.', '', '', '72663811', 'CHANCAYAURI POCCORI KIMBERLY CRISTINA', 'Arequipa', '72663816', 'MAMANI VILCA BEATRIZ', 'Arequipa', '1', 'O', 'AAAAA', 'AAAA', 'AAAA', 'A1', 'AAA', '123', 'RAU', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', 'Arequipa', '01', '2', 'Se entrega mañana', NULL, NULL, NULL),
(2, '14', '40', '002', '000001', NULL, '2024-04-11', 'CHANCAYAURI POCCORI ELMER LEONARDO', NULL, NULL, 'Arequipa', '72663810', 2, '12', 'UND', 'dsd', 0, 18, 13, 156, NULL, 'MIL SEIS CIENTOS SETENTA Y  SEIS CON 0/100 NUEVOS SOLES', NULL, NULL, NULL, NULL, '2024-04-11', NULL, NULL, 127.92, 0, 1374.32, 301.68, 1676, '0', 'ADMINISTRADOR', '16:09:16', '2024-04-11', 'S/.', '', '', '72663811', 'CHANCAYAURI POCCORI KIMBERLY CRISTINA', 'Arequipa', '72663816', 'MAMANI VILCA BEATRIZ', 'Arequipa', '1', 'O', 'AAAAA', 'AAAA', 'AAAA', 'A1', 'AAA', '123', 'RAU', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', 'Arequipa', '01', '2', 'Se entrega mañana', NULL, NULL, NULL),
(3, '14', '40', '002', '000001', NULL, '2024-04-11', 'CHANCAYAURI POCCORI ELMER LEONARDO', NULL, NULL, 'Arequipa', '72663810', 3, '31', 'UND', 'ewe', 0, 18, 13, 403, NULL, 'MIL SEIS CIENTOS SETENTA Y  SEIS CON 0/100 NUEVOS SOLES', NULL, NULL, NULL, NULL, '2024-04-11', NULL, NULL, 330.46, 0, 1374.32, 301.68, 1676, '0', 'ADMINISTRADOR', '16:09:16', '2024-04-11', 'S/.', '', '', '72663811', 'CHANCAYAURI POCCORI KIMBERLY CRISTINA', 'Arequipa', '72663816', 'MAMANI VILCA BEATRIZ', 'Arequipa', '1', 'O', 'AAAAA', 'AAAA', 'AAAA', 'A1', 'AAA', '123', 'RAU', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', 'Arequipa', '01', '2', 'Se entrega mañana', NULL, NULL, NULL),
(4, '14', '40', '002', '000001', NULL, '2024-04-11', 'CHANCAYAURI POCCORI ELMER LEONARDO', NULL, NULL, 'Arequipa', '72663810', 4, '31', 'UND', 'erer', 0, 18, 31, 961, NULL, 'MIL SEIS CIENTOS SETENTA Y  SEIS CON 0/100 NUEVOS SOLES', NULL, NULL, NULL, NULL, '2024-04-11', NULL, NULL, 788.02, 0, 1374.32, 301.68, 1676, '0', 'ADMINISTRADOR', '16:09:16', '2024-04-11', 'S/.', '', '', '72663811', 'CHANCAYAURI POCCORI KIMBERLY CRISTINA', 'Arequipa', '72663816', 'MAMANI VILCA BEATRIZ', 'Arequipa', '1', 'O', 'AAAAA', 'AAAA', 'AAAA', 'A1', 'AAA', '123', 'RAU', 'Calle Socabaya N° 105 - Int. A-2 María Isabel', 'Arequipa', '01', '2', 'Se entrega mañana', NULL, NULL, NULL);

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
  `IDVENTA` varchar(1) DEFAULT NULL,
  `EMAIL` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ftge2007`
--

INSERT INTO `ftge2007` (`IDEM`, `CODI`, `TITU`, `NOMB`, `DIRE`, `FECH`, `FONO`, `ACTI`, `FLC`, `CITY`, `PAIS`, `COND`, `ZONA`, `TOLE`, `PLAZ`, `FINA`, `SERIE`, `COMC`, `COMC1`, `COMC2`, `MONC`, `PORC`, `PORV`, `MON2`, `MON3`, `TFAX`, `RUC`, `CODC`, `SIGLA`, `IDDOC`, `USER`, `ORDE`, `IDVENTA`, `EMAIL`) VALUES
('7', '1', NULL, 'PLANILLA', '', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 4937, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '10', NULL, 'TRABAJA CON COSP O PREUNI 1 = COSP ,  2 = PREUNI', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '100', NULL, 'C:\\Sys_TacnaExpress', 'PATH DE REPORTES', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', ''),
('7', '101', NULL, 'FACTURA-003', '', '0000-00-00 00:00:00', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, 3, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', ''),
('7', '102', NULL, 'BOLETA-003', '', '0000-00-00 00:00:00', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', ''),
('7', '103', NULL, 'NOTA CRED - TAC', '', '0000-00-00 00:00:00', NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C03', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '104', NULL, 'GUIA-RE-003', '', '0000-00-00 00:00:00', '1', '', NULL, NULL, NULL, NULL, NULL, NULL, 3, 34, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', ''),
('7', '11', NULL, 'TIPO FACTURACION  FE =1,  FN=0', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '14', NULL, 'TACNA EXPRESS COMITE 26 SRL', 'CALLE SOCABAYA 105 MARIA ISABEL- AREQUIPA', NULL, NULL, '0', NULL, 'Arequipa', 'Peru', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20611638419', NULL, NULL, NULL, NULL, NULL, NULL, 'tacnaespress@gmail.com'),
('7', '15', NULL, 'SEPARAR DOC AFIGV /IAIGV', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '18', NULL, 'CONTROL DE EXPEDIENTES', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '2', NULL, 'COMPRAS', 'COMPRAS PARA FARMACIA U OTROS', '0000-00-00 00:00:00', NULL, '', NULL, NULL, '12', NULL, NULL, NULL, 11508, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '200', NULL, 'C:\\Sys_TacnaExpress', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '3', NULL, 'ATENCIONES', 'CODIGO DE ATENCION GENERADO EN ADMISION', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 44173, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '30', NULL, 'COTIZACIÓN', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10007, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '300', NULL, 'COPIAS BF', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '31', NULL, 'ORDEN DE COMPRA', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10164, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '37', NULL, 'INVENTARIOS', NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 10041, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '39', NULL, 'PRESUPUESTO', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '4', NULL, 'HISTORIAS', 'HISTORIA CLINICA DEL PCIENTE', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 30483, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '40', NULL, 'FACTURA-002', 'FACTURAS SEPS', NULL, NULL, '', '1', '1', NULL, NULL, NULL, NULL, NULL, 836, '002', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', ''),
('7', '41', NULL, 'NOTA C. BOL - TAC', NULL, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C03', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, ''),
('7', '43', NULL, 'FACTURA-006', 'GUIAS FARMACIA BOLETAS COASEGURO', NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '006', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, 3, '1', ''),
('7', '44', NULL, 'NOTA C. FACT', NULL, NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C01', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '45', NULL, 'NOTA C. BOL', '', '0000-00-00 00:00:00', '1', '', '1', NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '50', NULL, 'BOLETA-002', 'TARJETAS PROMEDIC', NULL, NULL, '1', '1', NULL, NULL, NULL, NULL, NULL, NULL, 12, '002', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', ''),
('7', '51', NULL, 'HONORARIO MEDICOS', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '113', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '52', NULL, 'TRANSACCIONES ELECTRONICAS', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '6', NULL, 'CAMPOS FARMACIA', 'PARA DETERMINAR SI SE COBRARA COMO MONTECARMELO O PROMEDIC', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '60', NULL, 'GUIA-REMI-002', NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '002', 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', ''),
('7', '61', NULL, 'F-H-002', '', '0000-00-00 00:00:00', '1', '', '1', NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', ''),
('7', '62', NULL, 'F-H-006', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 6, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '63', NULL, 'B-H-002', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 2, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '7', NULL, 'GRUIA DE REMISION', 'GUIAS DE REMICION REGISTRADAS EN COMRAS', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '71', NULL, 'IMPUESTO A LA RENTA', '', '0000-00-00 00:00:00', '0', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '72', NULL, 'IMPUESTO EXTRAORDINARIO DE SOLIDARIDAD', 'IES', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '77', NULL, 'CERRAR EXPEDIENTES', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '8', NULL, 'REAJUSTE INGRESO', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '9', NULL, 'REAJUSTE SALIDA', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '90', NULL, 'HITORIAS CLINICAS', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1161', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '94', NULL, 'GUIAS FARMACIA (002)', 'SE AMARA CON BOLETA 006', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '002', 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', ''),
('7', '96', NULL, 'GUIAS INSUMOS (001)', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 8281, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', ''),
('7', '97', NULL, 'SEPARA COBRO DE COASFAR', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '98', NULL, 'MONTO TIPO DE CAMBIO', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 3.12, NULL, NULL, 3.12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
('7', '99', NULL, 'IGV', '', '0000-00-00 00:00:00', NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, NULL, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuser`
--

CREATE TABLE `fuser` (
  `CODUSUARIO` int(3) NOT NULL,
  `NOMBRES` varchar(30) NOT NULL,
  `PASSWORD` varchar(10) NOT NULL,
  `NIVEL` varchar(1) DEFAULT NULL,
  `ACTI` varchar(1) DEFAULT NULL,
  `USUARIO` varchar(10) DEFAULT NULL,
  `OCUPACION` varchar(50) DEFAULT NULL,
  `DNI` float DEFAULT NULL,
  `BREVETE` varchar(20) DEFAULT NULL,
  `CEDE` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fuser`
--

INSERT INTO `fuser` (`CODUSUARIO`, `NOMBRES`, `PASSWORD`, `NIVEL`, `ACTI`, `USUARIO`, `OCUPACION`, `DNI`, `BREVETE`, `CEDE`) VALUES
(4, 'JOSE QEW', '321', '1', '1', 'RAU', 'CHOFER', 72663800, 'A1', '07'),
(5, 'ADMINISTRADOR', 'admin09', '1', '1', 'A', 'Administrador', 40809000, 'A1', '01'),
(6, 'GAMERO MIRANDA', '123', '1', '1', 'JOR', 'Administrador', 40809000, 'A1', '01'),
(8, 'OPERADOR DE CAJA', '123', '1', '1', 'OPE', 'SECRETARIA', 42931900, '', '01'),
(9, 'NAYELY MERMA', '321', '0', '1', 'RUT', 'SECRETARIA', 78943200, '', '01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `CODIGO` int(3) NOT NULL,
  `DESTINO` varchar(50) DEFAULT NULL,
  `ABREVIATURA` varchar(5) DEFAULT NULL,
  `DIRECCION` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`CODIGO`, `DESTINO`, `ABREVIATURA`, `DIRECCION`) VALUES
(1, 'AREQUIPA', 'AQP', 'Calle Socabaya N° 105 - Int. A-2 María Isabel'),
(2, 'TACNA', 'TAC', 'CALLE HIPOLITO UNANUE 725 TACNA'),
(3, 'MOQUEGUA', 'MOQ', 'MOQUEGUA'),
(4, 'ILO', 'ILO', 'CALLE DANIEL A. CARRION MZ-13 - LTE 1'),
(5, 'JULIACA', 'JUL', 'ACA'),
(6, 'PUNO', 'PUN', 'NO'),
(7, 'CUSCO', 'CUS', 'CO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tempguiaremision`
--

CREATE TABLE `tempguiaremision` (
  `IdOperacion` char(15) DEFAULT NULL,
  `Empresa` varchar(200) DEFAULT NULL,
  `NroRuc` varchar(11) DEFAULT NULL,
  `NombreGuia` varchar(100) DEFAULT NULL,
  `Documento` varchar(50) DEFAULT NULL,
  `NroRegistroMTC` varchar(50) DEFAULT NULL,
  `FechaHoraEmision` datetime DEFAULT NULL,
  `FechaInicioTras` datetime DEFAULT NULL,
  `PuntoPartida` varchar(500) DEFAULT NULL,
  `PuntoLlegada` varchar(500) DEFAULT NULL,
  `DatosRemitente` varchar(500) DEFAULT NULL,
  `DatosDestinatario` varchar(500) DEFAULT NULL,
  `NroBien` varchar(5) DEFAULT NULL,
  `BienNorma` varchar(5) DEFAULT NULL,
  `CodigoBien` varchar(10) DEFAULT NULL,
  `CodigoProdSunat` varchar(10) DEFAULT NULL,
  `PartidaArance` varchar(10) DEFAULT NULL,
  `CodigoGtin` varchar(10) DEFAULT NULL,
  `DescripcionDet` varchar(200) DEFAULT NULL,
  `UnidadMedida` varchar(50) DEFAULT NULL,
  `Cantidad` float DEFAULT NULL,
  `IndicadorTras` varchar(5) DEFAULT NULL,
  `UnidadMedPesoB` varchar(5) DEFAULT NULL,
  `PesoBrutoTotCar` float DEFAULT NULL,
  `IndicadorTransPro` varchar(5) DEFAULT NULL,
  `IndicadorRetVehV` varchar(5) DEFAULT NULL,
  `IndicadorTransSub` varchar(5) DEFAULT NULL,
  `IndicadorRetEnvEmbV` varchar(5) DEFAULT NULL,
  `IndicadorPagaF` varchar(10) DEFAULT NULL,
  `VehiculoPrinPlaca` varchar(10) DEFAULT NULL,
  `VehiculoPrinTuce` varchar(20) DEFAULT NULL,
  `VehiculoSecPlaca` varchar(10) DEFAULT NULL,
  `VehiculoSecTuce` varchar(20) DEFAULT NULL,
  `ConductorPrinNom` varchar(500) DEFAULT NULL,
  `ConductorPrinLic` varchar(10) DEFAULT NULL,
  `ConductorSecNom` varchar(500) DEFAULT NULL,
  `ConductorSecLic` varchar(10) DEFAULT NULL,
  `DatosPagadorFlete` varchar(500) DEFAULT NULL,
  `Observacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_documento`
--

CREATE TABLE `usuario_documento` (
  `CODUSUARIO` varchar(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CODI` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_documento`
--

INSERT INTO `usuario_documento` (`CODUSUARIO`, `CODI`) VALUES
('JOR', '101'),
('RAU', '103'),
('OPE', '60'),
('OPE', '50'),
('OPE', '40'),
('A', '50'),
('A', '40'),
('A', '101'),
('RUT', '40'),
('RUT', '50');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vbuscadoc`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vbuscadoc` (
`NUMDOC` varchar(20)
,`NOMEMPRE` varchar(60)
,`FEC_EMICION` date
,`ESTADO` varchar(20)
,`IDEM` varchar(3)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `CODIGO` varchar(3) NOT NULL,
  `NOMBRE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vfarmamovifd`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vfarmamovifd` (
`NORD` int(11)
,`DOC1` varchar(10)
,`FECH` date
,`GUIA_RECE` varchar(12)
,`CODT` varchar(8)
,`DESCP` char(0)
,`UNID` char(0)
,`CODT1` varchar(8)
,`CMP` varchar(6)
,`CANT` float
,`COST` float
,`MONT_DSCT` float
,`VVTA` float
,`MONT_COAS` float
,`COD_FACT` varchar(1)
,`FEC_EXP` date
,`AFECTMD` varchar(1)
,`IDEM2` varchar(4)
,`IDEM3` varchar(3)
,`DOC2` varchar(20)
,`MESP` varchar(4)
,`IDAIGV` varchar(1)
,`NRO_DOCU` varchar(12)
,`IDEM` varchar(6)
,`BONI` float
,`PREC` float
,`MONDSCTIGV` float
,`VVTAIGV` float
,`DESCFB` varchar(200)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vftge2007`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vftge2007` (
`CODI` varchar(5)
,`DOCUMENTO` varchar(90)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vuserdocu`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vuserdocu` (
`CODUSUARIO` varchar(3)
,`CODI` varchar(5)
,`DOCUMENTO` varchar(90)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `vbuscadoc`
--
DROP TABLE IF EXISTS `vbuscadoc`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vbuscadoc`  AS SELECT `fcabecer`.`DOC1` AS `NUMDOC`, `fcabecer`.`NOMEMPRE` AS `NOMEMPRE`, `fcabecer`.`FEC1` AS `FEC_EMICION`, ifnull(`fcabecer`.`ESTA`,'') AS `ESTADO`, `fcabecer`.`IDEM` AS `IDEM` FROM `fcabecer` ORDER BY `fcabecer`.`IDEM` ASC, `fcabecer`.`DOC1` DESC LIMIT 0, 100 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vfarmamovifd`
--
DROP TABLE IF EXISTS `vfarmamovifd`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vfarmamovifd`  AS SELECT `fmovimie`.`NORD` AS `NORD`, `fmovimie`.`DOC1` AS `DOC1`, `fmovimie`.`FECH` AS `FECH`, `fmovimie`.`GUIA_RECE` AS `GUIA_RECE`, `fmovimie`.`CODT` AS `CODT`, '' AS `DESCP`, '' AS `UNID`, `fmovimie`.`CODT1` AS `CODT1`, `fmovimie`.`CMP` AS `CMP`, `fmovimie`.`CANT` AS `CANT`, `fmovimie`.`COST` AS `COST`, `fmovimie`.`MONT_DSCT` AS `MONT_DSCT`, `fmovimie`.`VVTA` AS `VVTA`, `fmovimie`.`MONT_COAS` AS `MONT_COAS`, `fmovimie`.`COD_FACT` AS `COD_FACT`, `fmovimie`.`FEC_EXP` AS `FEC_EXP`, `fmovimie`.`AFECTMD` AS `AFECTMD`, `fmovimie`.`IDEM2` AS `IDEM2`, `fmovimie`.`IDEM3` AS `IDEM3`, `fmovimie`.`DOC2` AS `DOC2`, `fmovimie`.`MESP` AS `MESP`, `fmovimie`.`IDAIGV` AS `IDAIGV`, `fmovimie`.`NRO_DOCU` AS `NRO_DOCU`, `fmovimie`.`IDEM` AS `IDEM`, `fmovimie`.`BONI` AS `BONI`, `fmovimie`.`PREC` AS `PREC`, `fmovimie`.`MONDSCTIGV` AS `MONDSCTIGV`, `fmovimie`.`VVTAIGV` AS `VVTAIGV`, `fmovimie`.`DESCFB` AS `DESCFB` FROM `fmovimie` LIMIT 0, 10 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vftge2007`
--
DROP TABLE IF EXISTS `vftge2007`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vftge2007`  AS SELECT `ftge2007`.`CODI` AS `CODI`, `ftge2007`.`NOMB` AS `DOCUMENTO` FROM `ftge2007` WHERE `ftge2007`.`CODI` in ('40','43','44','50','60','98','99','45','101','102','103','104','61','62','63') ORDER BY `ftge2007`.`CODI` ASC LIMIT 0, 100 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `vuserdocu`
--
DROP TABLE IF EXISTS `vuserdocu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vuserdocu`  AS SELECT `usuario_documento`.`CODUSUARIO` AS `CODUSUARIO`, `vftge2007`.`CODI` AS `CODI`, `vftge2007`.`DOCUMENTO` AS `DOCUMENTO` FROM (`usuario_documento` join `vftge2007` on(`usuario_documento`.`CODI` = `vftge2007`.`CODI`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camiones`
--
ALTER TABLE `camiones`
  ADD PRIMARY KEY (`CODIGO`),
  ADD UNIQUE KEY `PLACA` (`PLACA`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`RUC_DNI`);

--
-- Indices de la tabla `condiciones`
--
ALTER TABLE `condiciones`
  ADD PRIMARY KEY (`CODI`);

--
-- Indices de la tabla `datos_fijos`
--
ALTER TABLE `datos_fijos`
  ADD PRIMARY KEY (`IDDATFI`);

--
-- Indices de la tabla `fcabecer`
--
ALTER TABLE `fcabecer`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `fmclinic`
--
ALTER TABLE `fmclinic`
  ADD PRIMARY KEY (`CODC`),
  ADD UNIQUE KEY `NRUC` (`NRUC`,`DNI`);

--
-- Indices de la tabla `fmovimie`
--
ALTER TABLE `fmovimie`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `fmovimpfde`
--
ALTER TABLE `fmovimpfde`
  ADD PRIMARY KEY (`CODT`);

--
-- Indices de la tabla `ftge2007`
--
ALTER TABLE `ftge2007`
  ADD PRIMARY KEY (`CODI`);

--
-- Indices de la tabla `fuser`
--
ALTER TABLE `fuser`
  ADD PRIMARY KEY (`CODUSUARIO`),
  ADD UNIQUE KEY `USUARIO` (`USUARIO`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`CODIGO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_fijos`
--
ALTER TABLE `datos_fijos`
  MODIFY `IDDATFI` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `fcabecer`
--
ALTER TABLE `fcabecer`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `fmclinic`
--
ALTER TABLE `fmclinic`
  MODIFY `CODC` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `fmovimie`
--
ALTER TABLE `fmovimie`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `fmovimpfde`
--
ALTER TABLE `fmovimpfde`
  MODIFY `CODT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `fuser`
--
ALTER TABLE `fuser`
  MODIFY `CODUSUARIO` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
