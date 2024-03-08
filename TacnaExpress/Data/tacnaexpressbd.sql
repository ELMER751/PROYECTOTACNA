-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-03-2024 a las 20:11:18
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
(3, '0000-00-00', '08032024CUS', 'AAAA - AAAAA', 'RAU', 'RAU', '', '2024-03-08', '09:36:18', 'CO', '', '', '', NULL, NULL, NULL, NULL, 'A1', '07');

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
  `MESP` varchar(4) DEFAULT NULL,
  `IDEM` varchar(3) NOT NULL,
  `IDEM2` varchar(4) DEFAULT NULL,
  `CODI` varchar(11) DEFAULT NULL,
  `SERV` varchar(5) DEFAULT NULL,
  `USER` varchar(2) DEFAULT NULL,
  `DOC1` varchar(10) NOT NULL,
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
  `ESTA` varchar(1) DEFAULT NULL,
  `FEC1` datetime DEFAULT NULL,
  `COND` varchar(3) DEFAULT NULL,
  `FEC2` datetime DEFAULT NULL,
  `FEC3` datetime DEFAULT NULL,
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
  `FECREG` datetime DEFAULT NULL,
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
  `FECCUOTA` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fcabecer`
--

INSERT INTO `fcabecer` (`MESP`, `IDEM`, `IDEM2`, `CODI`, `SERV`, `USER`, `DOC1`, `DOC2`, `GUIA`, `DSCG`, `DSCGA`, `DSCGI`, `MONB`, `MONBC`, `DSCT`, `EXON`, `EXON1`, `TOTV`, `TOTV_IGVE`, `IGV`, `IGVE`, `TOTL`, `FLET`, `OTRG`, `IGV1`, `CODV`, `NFAC`, `TIPO`, `LTRA`, `GUTR`, `EMIT`, `ESTA`, `FEC1`, `COND`, `FEC2`, `FEC3`, `FLC`, `DOCIDENT`, `NOMBCLIE`, `NOMEMPRE`, `RUCEMPRE`, `DIREMPRE`, `RUCDNIRE`, `NOMBRE`, `DIRERE`, `RUCDNICO`, `NOMBCO`, `DIRECO`, `RUTADES`, `ODESORI`, `PLACA`, `LIC`, `CHOFCOND`, `DEDUCIBLE`, `COASEGUR`, `COASEGURO`, `CODASEGU`, `TIP_CAMB`, `MONEDA`, `EMISION`, `MONT_DEDU`, `MONT_COAS`, `MONT_PADE`, `MONT_PACO`, `MONT_PALA`, `MONT_PAME`, `MONT_PAMF`, `MONT_PACL`, `MONT_PAOD`, `MONT_PAFA`, `MONT_PACA`, `MONT_PAIM`, `MONT_PATO`, `MONT_COASI`, `MONT_DSCTF`, `MONT_DSCTFI`, `MONT_PACOI`, `MONT_PAFAI`, `MONT_PAFNC`, `MOTIVO`, `FEC_DEV`, `FEC_ANU`, `DEPENDENCIA`, `RESPONSABLE`, `DSCT_FAR`, `IDPASEG`, `IDFADIR`, `LOTE`, `ORDLOTE`, `FCH_ENVIO`, `MODO_PAGO`, `Nro_soli`, `NCONSUL`, `COD_COBER`, `TIPENTIDAD`, `NATENCIONES`, `FECENVIO`, `HORAENVIO`, `TIPOLOTE`, `DOCREFE`, `CODPACI`, `TIPOAFILI`, `NDOCATEN`, `SNDOCATEN`, `NIVELATEN`, `TIPCOBER`, `RESPONSA`, `DOCAUTORI`, `NAUTORIZA`, `FACTGLOBAL`, `NRO_NOTAC`, `VAL_NOTC`, `USUARIO`, `HORAREG`, `FECREG`, `IDSEPARADOIGV`, `INCRE2`, `CMP`, `IDGUIAFACT`, `DOCGUIAS`, `GUIAFACTURADA`, `IDJUNTADO`, `FENVICONTEXP`, `LOTECONTEXP`, `NDIAS`, `IDCTE`, `MASIGV`, `OBSERV`, `NROCUOTAS`, `MONTOCUOTA`, `FECCUOTA`) VALUES
(NULL, '10', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL);

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
(6, 'CHANCAYAURI CHICHUAYA ELMER JUSTINO', '', '2024-03-04', '', '40808990', 'Arequipa', '', '2024-03-04 17:01:11', 'jorgeluis.gd20@gmail.com');

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
(1, '', '123', NULL, NULL, 'jose', NULL, NULL, NULL, NULL),
(2, '', '123', NULL, NULL, 'elm', NULL, NULL, NULL, NULL),
(4, 'JOSE QEW', '321', '1', '1', 'RAU', 'CHOFER', 72663800, 'A1', '07'),
(5, 'ADMINISTRADOR', 'admin09', '1', '1', 'A', 'Administrador', 40809000, 'A1', '01'),
(6, 'GAMERO MIRANDA', '123', '1', '1', 'JOR', 'Administrador', 40809000, 'A1', '01');

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
-- Estructura de tabla para la tabla `usuario_documento`
--

CREATE TABLE `usuario_documento` (
  `CODUSUARIO` varchar(3) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CODI` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vbuscadoc`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vbuscadoc` (
`NUMDOC` varchar(10)
,`NOMEMPRE` varchar(60)
,`FEC_EMICION` datetime
,`ESTADO` varchar(1)
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
-- Indices de la tabla `fmclinic`
--
ALTER TABLE `fmclinic`
  ADD PRIMARY KEY (`CODC`),
  ADD UNIQUE KEY `NRUC` (`NRUC`,`DNI`);

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
  MODIFY `IDDATFI` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fmclinic`
--
ALTER TABLE `fmclinic`
  MODIFY `CODC` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `fuser`
--
ALTER TABLE `fuser`
  MODIFY `CODUSUARIO` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
