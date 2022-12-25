-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 15-12-2022 a las 18:38:38
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `SocialNetwork`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia`
--

CREATE TABLE `historia` (
  `idHistoria` int(5) NOT NULL,
  `titol` varchar(30) DEFAULT NULL,
  `estat` enum('public','privat') DEFAULT NULL,
  `idUsuariHist` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historia`
--

INSERT INTO `historia` (`idHistoria`, `titol`, `estat`, `idUsuariHist`) VALUES
(32, 'uib', 'public', 'marcoski'),
(33, 'Diego', 'public', 'maria'),
(34, 'jaume', 'public', 'maria'),
(35, 'Maria<3', 'public', 'jaaumeadrover'),
(36, 'Mundial', 'public', 'joan13'),
(37, 'marroc', 'public', 'joan13'),
(39, 'historia1', 'public', 'diegofes'),
(40, 'Base de dades', 'public', 'jaume4'),
(41, 'boness', 'public', 'joan13');

--
-- Disparadores `historia`
--
DELIMITER $$
CREATE TRIGGER `message` AFTER INSERT ON `historia` FOR EACH ROW BEGIN
    DECLARE done BOOLEAN DEFAULT FALSE;
    DECLARE idUsuari VARCHAR(20);
	DECLARE varcursor CURSOR FOR SELECT DISTINCT idUsuariSeguidor FROM Seguidor WHERE idUsuariSeguit=(NEW.idUsuariHist);
    DECLARE CONTINUE HANDLER FOR NOT FOUND
    		SET done = TRUE;   
		OPEN varcursor;
        FETCH varcursor INTO idUsuari;
        WHILE (done = False) DO
		SET @text=CONCAT("Hola ",idUsuari,"! En ",NEW.idUsuariHist," ha penjat una història nova: ",NEW.titol,".Accedeix amb aquest link:",'<a href="http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=',NEW.idHistoria,"&id=",NEW.idUsuariHist,'">link</a>');
        IF NEW.estat = 'public' THEN
		INSERT INTO missatge SET descripcio=@text,dataEnviat=NOW(),idUsuariEmissor=NEW.idUsuariHist,idUsuariReceptor=idUsuari;
        FETCH varcursor INTO idUsuari;
        END IF;
        END WHILE;

	CLOSE varcursor;
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historiacopia`
--

CREATE TABLE `historiacopia` (
  `idHistoria` int(5) NOT NULL,
  `titol` varchar(30) DEFAULT NULL,
  `estat` enum('public','privat') DEFAULT NULL,
  `idUsuarHistoria` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `missatge`
--

CREATE TABLE `missatge` (
  `idMissatge` int(8) NOT NULL,
  `descripcio` varchar(250) DEFAULT NULL,
  `dataEnviat` datetime DEFAULT NULL,
  `idUsuariEmissor` varchar(20) DEFAULT NULL,
  `idUsuariReceptor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `missatge`
--

INSERT INTO `missatge` (`idMissatge`, `descripcio`, `dataEnviat`, `idUsuariEmissor`, `idUsuariReceptor`) VALUES
(198, 'hola\r\n', '2022-12-08 11:07:32', 'marcoski', 'jaaumeadrover'),
(199, 'Hola diegofes! En marcoski ha penjat una història nova: uib.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=32&id=marcoski\">link</a>', '2022-12-08 11:08:05', 'marcoski', 'diegofes'),
(200, 'Hola jaaumeadrover! En marcoski ha penjat una història nova: uib.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=32&id=marcoski\">link</a>', '2022-12-08 11:08:05', 'marcoski', 'jaaumeadrover'),
(201, 'Hola luisitopatron! En marcoski ha penjat una història nova: uib.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=32&id=marcoski\">link</a>', '2022-12-08 11:08:05', 'marcoski', 'luisitopatron'),
(202, 'Hola joan13! En marcoski ha penjat una història nova: uib.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=32&id=marcoski\">link</a>', '2022-12-08 11:08:05', 'marcoski', 'joan13'),
(203, 'holaaa', '2022-12-08 11:17:49', 'joan13', 'diegofes'),
(204, 'hola guapu', '2022-12-08 11:50:08', 'maria', 'jaaumeadrover'),
(205, 'holaaa', '2022-12-08 11:51:31', 'maria', 'marcoski'),
(206, 'guapuu', '2022-12-08 11:51:58', 'maria', 'marcoski'),
(207, 'Hola jaaumeadrover! En maria ha penjat una història nova: jaume.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=34&id=maria\">link</a>', '2022-12-08 11:58:03', 'maria', 'jaaumeadrover'),
(208, 'Hola diegofes! En jaaumeadrover ha penjat una història nova: Maria<3.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=35&id=jaaumeadrover\">link</a>', '2022-12-08 12:00:12', 'jaaumeadrover', 'diegofes'),
(209, 'Hola luisitopatron! En jaaumeadrover ha penjat una història nova: Maria<3.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=35&id=jaaumeadrover\">link</a>', '2022-12-08 12:00:12', 'jaaumeadrover', 'luisitopatron'),
(210, 'Hola edubonnin! En jaaumeadrover ha penjat una història nova: Maria<3.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=35&id=jaaumeadrover\">link</a>', '2022-12-08 12:00:12', 'jaaumeadrover', 'edubonnin'),
(211, 'Hola joan13! En jaaumeadrover ha penjat una història nova: Maria<3.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=35&id=jaaumeadrover\">link</a>', '2022-12-08 12:00:12', 'jaaumeadrover', 'joan13'),
(212, 'Hola marcoski! En jaaumeadrover ha penjat una història nova: Maria<3.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=35&id=jaaumeadrover\">link</a>', '2022-12-08 12:00:12', 'jaaumeadrover', 'marcoski'),
(213, 'Hola maria! En jaaumeadrover ha penjat una història nova: Maria<3.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=35&id=jaaumeadrover\">link</a>', '2022-12-08 12:00:12', 'jaaumeadrover', 'maria'),
(214, 'broo', '2022-12-08 12:04:25', 'maria', 'joan13'),
(215, 'hollaa bombon\r\n', '2022-12-08 12:21:58', 'jaaumeadrover', 'maria'),
(216, 'bones sister', '2022-12-12 16:13:46', 'joan13', 'maria'),
(217, 'kbron\r\n', '2022-12-12 16:14:24', 'joan13', 'diegofes'),
(218, 'Hola edubonnin! En joan13 ha penjat una història nova: Mundial.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=36&id=joan13\">link</a>', '2022-12-12 16:14:54', 'joan13', 'edubonnin'),
(219, 'Hola jaaumeadrover! En joan13 ha penjat una història nova: Mundial.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=36&id=joan13\">link</a>', '2022-12-12 16:14:54', 'joan13', 'jaaumeadrover'),
(220, 'Hola luisitopatron! En joan13 ha penjat una història nova: Mundial.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=36&id=joan13\">link</a>', '2022-12-12 16:14:54', 'joan13', 'luisitopatron'),
(221, 'Hola maria! En joan13 ha penjat una història nova: Mundial.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=36&id=joan13\">link</a>', '2022-12-12 16:14:54', 'joan13', 'maria'),
(222, 'Hola edubonnin! En joan13 ha penjat una història nova: marroc.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=37&id=joan13\">link</a>', '2022-12-12 17:47:52', 'joan13', 'edubonnin'),
(223, 'Hola jaaumeadrover! En joan13 ha penjat una història nova: marroc.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=37&id=joan13\">link</a>', '2022-12-12 17:47:52', 'joan13', 'jaaumeadrover'),
(224, 'Hola luisitopatron! En joan13 ha penjat una història nova: marroc.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=37&id=joan13\">link</a>', '2022-12-12 17:47:52', 'joan13', 'luisitopatron'),
(225, 'Hola maria! En joan13 ha penjat una història nova: marroc.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=37&id=joan13\">link</a>', '2022-12-12 17:47:52', 'joan13', 'maria'),
(226, 'holaa', '2022-12-12 17:50:32', 'joan13', 'jaaumeadrover'),
(227, 'Hola jaaumeadrover! En diegofes ha penjat una història nova: Bon dia .Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=38&id=diegofes\">link</a>', '2022-12-15 09:19:41', 'diegofes', 'jaaumeadrover'),
(228, 'Hola luisitopatron! En diegofes ha penjat una història nova: Bon dia .Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=38&id=diegofes\">link</a>', '2022-12-15 09:19:41', 'diegofes', 'luisitopatron'),
(229, 'Hola joan13! En diegofes ha penjat una història nova: Bon dia .Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=38&id=diegofes\">link</a>', '2022-12-15 09:19:41', 'diegofes', 'joan13'),
(230, 'Hola jaaumeadrover! En diegofes ha penjat una història nova: historia1.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=39&id=diegofes\">link</a>', '2022-12-15 09:20:06', 'diegofes', 'jaaumeadrover'),
(231, 'Hola luisitopatron! En diegofes ha penjat una història nova: historia1.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=39&id=diegofes\">link</a>', '2022-12-15 09:20:06', 'diegofes', 'luisitopatron'),
(232, 'Hola joan13! En diegofes ha penjat una història nova: historia1.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=39&id=diegofes\">link</a>', '2022-12-15 09:20:06', 'diegofes', 'joan13'),
(233, 'Bon dia diego, avui ens podriem veure?', '2022-12-15 12:43:58', 'joan13', 'diegofes'),
(234, 'bones que tal estas jaumee', '2022-12-15 15:33:51', 'joan13', 'jaume4'),
(235, 'molt beee', '2022-12-15 15:34:20', 'jaume4', 'joan13'),
(236, 'Hola joan13! En jaume4 ha penjat una història nova: Base de dades.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=40&id=jaume4\">link</a>', '2022-12-15 15:35:41', 'jaume4', 'joan13'),
(237, 'Hola edubonnin! En joan13 ha penjat una història nova: boness.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=41&id=joan13\">link</a>', '2022-12-15 18:36:27', 'joan13', 'edubonnin'),
(238, 'Hola jaaumeadrover! En joan13 ha penjat una història nova: boness.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=41&id=joan13\">link</a>', '2022-12-15 18:36:27', 'joan13', 'jaaumeadrover'),
(239, 'Hola luisitopatron! En joan13 ha penjat una història nova: boness.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=41&id=joan13\">link</a>', '2022-12-15 18:36:27', 'joan13', 'luisitopatron'),
(240, 'Hola maria! En joan13 ha penjat una història nova: boness.Accedeix amb aquest link:<a href=\"http://localhost/joan13/SocialNetwork/html/perfilExtern.php?idPublicacio=41&id=joan13\">link</a>', '2022-12-15 18:36:27', 'joan13', 'maria'),
(241, 'que tal broo', '2022-12-15 18:36:49', 'joan13', 'edubonnin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `missatgecopia`
--

CREATE TABLE `missatgecopia` (
  `idMissatge` int(8) NOT NULL,
  `descripcio` varchar(250) DEFAULT NULL,
  `dataEnviat` datetime DEFAULT NULL,
  `idUsuariEmissor` varchar(20) DEFAULT NULL,
  `idUsuariReceptor` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacio`
--

CREATE TABLE `publicacio` (
  `idPublicacio` int(5) NOT NULL,
  `text` varchar(250) DEFAULT NULL,
  `dataPublicacio` datetime DEFAULT NULL,
  `idUsuari` varchar(20) DEFAULT NULL,
  `idHistoria` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `publicacio`
--

INSERT INTO `publicacio` (`idPublicacio`, `text`, `dataPublicacio`, `idUsuari`, `idHistoria`) VALUES
(86, 'acabat', '2022-12-08 11:08:05', 'marcoski', 32),
(87, 'hola', '2022-12-08 11:08:08', 'marcoski', NULL),
(88, 'Publicació de marcoski--> acabat', '2022-12-08 11:08:29', 'joan13', NULL),
(89, 'holaaa', '2022-12-08 11:54:07', 'maria', NULL),
(90, 'en diego li falta una gresca', '2022-12-08 11:54:30', 'maria', 33),
(91, 'bonesssss jaumet guapuu', '2022-12-08 11:57:51', 'maria', 33),
(92, 'bonesssss jaumet guapuu', '2022-12-08 11:58:03', 'maria', 34),
(93, 'Maria tho faria tot lo dia', '2022-12-08 12:00:12', 'jaaumeadrover', 35),
(94, 'Publicació de marcoski--> acabat', '2022-12-08 12:01:50', 'maria', NULL),
(95, 'Publicació de maria--> bonesssss jaumet guapuu', '2022-12-08 12:01:51', 'jaaumeadrover', NULL),
(96, 'marruecxos campeona del mundo', '2022-12-12 16:14:54', 'joan13', 36),
(97, 'Publicació de marcoski--> acabat', '2022-12-12 16:17:02', 'maria', NULL),
(98, 'el marreoc guanya el mundial', '2022-12-12 17:47:52', 'joan13', 37),
(99, 'Publicació de maria--> Publicació de marcoski--> acabat', '2022-12-12 17:51:27', 'joan13', NULL),
(100, 'bones tardes a tots', '2022-12-15 09:19:17', 'diegofes', NULL),
(101, 'bon dia, avui m\'he aixecat molt bé', '2022-12-15 09:19:41', 'diegofes', NULL),
(102, 'holaaa', '2022-12-15 09:20:06', 'diegofes', 39),
(103, '', '2022-12-15 10:36:58', 'joan13', NULL),
(104, 'Publicació de diegofes--> holaaa', '2022-12-15 13:13:38', 'joan13', NULL),
(105, 'Publicació de joan13--> Publicació de diegofes--> holaaa', '2022-12-15 15:05:53', 'jaaumeadrover', NULL),
(106, 'Publicació de diegofes--> holaaa', '2022-12-15 15:17:52', 'jaume1', NULL),
(107, 'Base de dades II és la millor assignatura', '2022-12-15 15:35:15', 'jaume4', NULL),
(108, 'holaaa', '2022-12-15 15:35:41', 'jaume4', 40),
(109, 'Bonesss', '2022-12-15 18:35:53', 'joan13', NULL),
(110, 'que tal estau', '2022-12-15 18:35:59', 'joan13', 36),
(111, 'eiii', '2022-12-15 18:36:17', 'joan13', 36),
(112, 'ggggg', '2022-12-15 18:36:27', 'joan13', 41),
(113, 'Publicació de jaume4--> holaaa', '2022-12-15 18:36:37', 'joan13', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciocopia`
--

CREATE TABLE `publicaciocopia` (
  `idPublicacio` int(5) NOT NULL,
  `text` varchar(250) DEFAULT NULL,
  `dataPublicacio` datetime DEFAULT NULL,
  `idUsuari` varchar(20) DEFAULT NULL,
  `idHistoria` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resposta`
--

CREATE TABLE `resposta` (
  `idResposta` int(6) NOT NULL,
  `textResposta` varchar(250) DEFAULT NULL,
  `dataResposta` datetime DEFAULT NULL,
  `idUsuari` varchar(20) DEFAULT NULL,
  `idPublicacioRenviada` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `resposta`
--

INSERT INTO `resposta` (`idResposta`, `textResposta`, `dataResposta`, `idUsuari`, `idPublicacioRenviada`) VALUES
(53, 'okey', '2022-12-08 11:08:40', 'joan13', 86),
(54, 'vale', '2022-12-08 11:08:44', 'joan13', 86),
(55, 'calamar', '2022-12-08 12:02:19', 'maria', 93),
(56, 'es teus collons', '2022-12-12 16:19:05', 'maria', 96),
(57, 'aquests no poden guanyar ni a ses canicas...', '2022-12-12 16:20:06', 'maria', 96),
(58, 'Visca el Girona', '2022-12-12 16:20:18', 'maria', 96),
(59, 'ido si', '2022-12-12 17:48:47', 'joan13', 97),
(60, 'holaaa guapuuu', '2022-12-15 13:10:52', 'joan13', 102),
(61, 'bones tardes calamar', '2022-12-15 13:12:28', 'jaaumeadrover', 102),
(62, 'hol que tal', '2022-12-15 15:24:32', 'jaume2', 102),
(63, 'bones que tal', '2022-12-15 15:32:09', 'jaume4', 102),
(64, 'creack', '2022-12-15 18:36:35', 'joan13', 108);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respostacopia`
--

CREATE TABLE `respostacopia` (
  `idResposta` int(6) NOT NULL,
  `fotoResposta` varchar(100) DEFAULT NULL,
  `dataResposta` datetime DEFAULT NULL,
  `idUsuari` varchar(20) DEFAULT NULL,
  `idPublicacioRenviada` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidor`
--

CREATE TABLE `seguidor` (
  `idUsuariSeguidor` varchar(20) DEFAULT NULL,
  `idUsuariSeguit` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `seguidor`
--

INSERT INTO `seguidor` (`idUsuariSeguidor`, `idUsuariSeguit`) VALUES
('diegofes', 'marcoski'),
('diegofes', 'jaaumeadrover'),
('jaaumeadrover', 'diegofes'),
('jaaumeadrover', 'marcoski'),
('luisitopatron', 'diegofes'),
('luisitopatron', 'marcoski'),
('luisitopatron', 'jaaumeadrover'),
('edubonnin', 'jaaumeadrover'),
('edubonnin', 'joan13'),
('joan13', 'marcoski'),
('joan13', 'diegofes'),
('jaaumeadrover', 'joan13'),
('luisitopatron', 'joan13'),
('jaaumeadrover', 'luisitopatron'),
('marcoski', 'jaaumeadrover'),
('joan13', 'luisitopatron'),
('joan13', 'edubonnin'),
('maria', 'jaaumeadrover'),
('maria', 'joan13'),
('maria', 'marcoski'),
('jaaumeadrover', 'maria'),
('joan13', 'maria'),
('joan13', 'jaaumeadrover'),
('jaume1', 'diegofes'),
('diegofes', 'jaume1'),
('jaume2', 'diegofes'),
('diegofes', 'jaume2'),
('jaume4', 'diegofes'),
('joan13', 'jaume4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguidorcopia`
--

CREATE TABLE `seguidorcopia` (
  `idUsuariSeguidor` varchar(20) DEFAULT NULL,
  `idUsuariSeguit` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuari`
--

CREATE TABLE `usuari` (
  `idUsuari` varchar(20) NOT NULL,
  `nom` varchar(15) DEFAULT NULL,
  `cognom` varchar(15) DEFAULT NULL,
  `dataNaixament` date DEFAULT NULL,
  `telefon` varchar(9) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contrasenya` varchar(25) DEFAULT NULL,
  `sexe` enum('home','dona','altres') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuari`
--

INSERT INTO `usuari` (`idUsuari`, `nom`, `cognom`, `dataNaixament`, `telefon`, `email`, `contrasenya`, `sexe`) VALUES
('albi', 'Alba', 'Gili', '2002-09-16', '657456345', 'albi@gmail.com', 'hola', 'dona'),
('diegofes', 'Diego', 'Bermejo', '2002-07-13', '12345679', 'diegofes@gmail.com', 'hola', 'home'),
('edubonnin', 'Eduardo', 'Bonnin', '2002-09-03', '12345679', 'edua@gmail.com', 'hola', 'home'),
('jaaumeadrover', 'Jaume', 'Adrover', '2002-02-22', '657894023', 'jaume4180@gmail.com', 'hola', 'home'),
('jaume1', 'Jaume', 'Jaume', '2022-12-17', '634333222', 'jaume@gmail.com', 'hola', 'home'),
('jaume2', 'jaume', 'jaume', '2022-12-08', '222333444', 'jaume@gmail.com', 'hola', 'home'),
('jaume4', 'jaume', 'jaume', '2022-12-01', '222333444', 'jaume@gmail.com', 'hola', 'home'),
('jaumejaume', 'Jaume', 'Jaume', '1998-11-06', '333222111', 'jaume@gmail.com', 'hola', 'home'),
('joan13', 'Joan', 'Balaguer', '2002-01-11', '630231603', 'joan@gmail.com', 'hola', 'home'),
('luisitopatron', 'Lluis', 'Barca', '2000-03-27', '652724890', 'luisbarcapons@gmail.com', 'hola', 'altres'),
('marcoski', 'Marc', 'Cañellas', '2002-04-25', '12345679', 'marccg8@gmail.com', 'hola', 'home'),
('maria', 'Maria', 'guapa', '2022-12-09', '444333222', 'maria@gmail.com', 'hola', 'dona'),
('nuria', 'Nuria', 'Bibiloni', '2003-12-31', '999888777', 'nuria@gmail.com', 'hola', 'dona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaricopia`
--

CREATE TABLE `usuaricopia` (
  `idUsuari` varchar(20) NOT NULL,
  `nom` varchar(15) DEFAULT NULL,
  `cognom` varchar(15) DEFAULT NULL,
  `dataNaixament` date DEFAULT NULL,
  `telefon` varchar(9) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `contrasenya` varchar(25) DEFAULT NULL,
  `sexe` enum('home','dona','altres') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `historia`
--
ALTER TABLE `historia`
  ADD PRIMARY KEY (`idHistoria`),
  ADD KEY `idUsuariHist` (`idUsuariHist`);

--
-- Indices de la tabla `historiacopia`
--
ALTER TABLE `historiacopia`
  ADD PRIMARY KEY (`idHistoria`),
  ADD KEY `idUsuarHistoria` (`idUsuarHistoria`);

--
-- Indices de la tabla `missatge`
--
ALTER TABLE `missatge`
  ADD PRIMARY KEY (`idMissatge`),
  ADD KEY `idUsuariEmissor` (`idUsuariEmissor`),
  ADD KEY `idUsuariReceptor` (`idUsuariReceptor`);

--
-- Indices de la tabla `missatgecopia`
--
ALTER TABLE `missatgecopia`
  ADD PRIMARY KEY (`idMissatge`),
  ADD KEY `idUsuariEmissor` (`idUsuariEmissor`),
  ADD KEY `idUsuariReceptor` (`idUsuariReceptor`);

--
-- Indices de la tabla `publicacio`
--
ALTER TABLE `publicacio`
  ADD PRIMARY KEY (`idPublicacio`),
  ADD KEY `idUsuari` (`idUsuari`),
  ADD KEY `idHistoria` (`idHistoria`);

--
-- Indices de la tabla `publicaciocopia`
--
ALTER TABLE `publicaciocopia`
  ADD PRIMARY KEY (`idPublicacio`),
  ADD KEY `idUsuari` (`idUsuari`),
  ADD KEY `idHistoria` (`idHistoria`);

--
-- Indices de la tabla `resposta`
--
ALTER TABLE `resposta`
  ADD PRIMARY KEY (`idResposta`),
  ADD KEY `idUsuari` (`idUsuari`),
  ADD KEY `idPublicacioRenviada` (`idPublicacioRenviada`);

--
-- Indices de la tabla `respostacopia`
--
ALTER TABLE `respostacopia`
  ADD PRIMARY KEY (`idResposta`),
  ADD KEY `idUsuari` (`idUsuari`),
  ADD KEY `idPublicacioRenviada` (`idPublicacioRenviada`);

--
-- Indices de la tabla `seguidor`
--
ALTER TABLE `seguidor`
  ADD KEY `idUsuariSeguidor` (`idUsuariSeguidor`),
  ADD KEY `idUsuariSeguit` (`idUsuariSeguit`);

--
-- Indices de la tabla `seguidorcopia`
--
ALTER TABLE `seguidorcopia`
  ADD KEY `idUsuariSeguidor` (`idUsuariSeguidor`),
  ADD KEY `idUsuariSeguit` (`idUsuariSeguit`);

--
-- Indices de la tabla `usuari`
--
ALTER TABLE `usuari`
  ADD PRIMARY KEY (`idUsuari`);

--
-- Indices de la tabla `usuaricopia`
--
ALTER TABLE `usuaricopia`
  ADD PRIMARY KEY (`idUsuari`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `historia`
--
ALTER TABLE `historia`
  MODIFY `idHistoria` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `historiacopia`
--
ALTER TABLE `historiacopia`
  MODIFY `idHistoria` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `missatge`
--
ALTER TABLE `missatge`
  MODIFY `idMissatge` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT de la tabla `missatgecopia`
--
ALTER TABLE `missatgecopia`
  MODIFY `idMissatge` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicacio`
--
ALTER TABLE `publicacio`
  MODIFY `idPublicacio` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de la tabla `publicaciocopia`
--
ALTER TABLE `publicaciocopia`
  MODIFY `idPublicacio` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resposta`
--
ALTER TABLE `resposta`
  MODIFY `idResposta` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `historia`
--
ALTER TABLE `historia`
  ADD CONSTRAINT `historia_ibfk_1` FOREIGN KEY (`idUsuariHist`) REFERENCES `usuari` (`idUsuari`);

--
-- Filtros para la tabla `historiacopia`
--
ALTER TABLE `historiacopia`
  ADD CONSTRAINT `historiacopia_ibfk_1` FOREIGN KEY (`idUsuarHistoria`) REFERENCES `usuaricopia` (`idUsuari`);

--
-- Filtros para la tabla `missatge`
--
ALTER TABLE `missatge`
  ADD CONSTRAINT `missatge_ibfk_1` FOREIGN KEY (`idUsuariEmissor`) REFERENCES `usuari` (`idUsuari`),
  ADD CONSTRAINT `missatge_ibfk_2` FOREIGN KEY (`idUsuariReceptor`) REFERENCES `usuari` (`idUsuari`);

--
-- Filtros para la tabla `missatgecopia`
--
ALTER TABLE `missatgecopia`
  ADD CONSTRAINT `missatgecopia_ibfk_1` FOREIGN KEY (`idUsuariEmissor`) REFERENCES `usuaricopia` (`idUsuari`),
  ADD CONSTRAINT `missatgecopia_ibfk_2` FOREIGN KEY (`idUsuariReceptor`) REFERENCES `usuaricopia` (`idUsuari`);

--
-- Filtros para la tabla `publicacio`
--
ALTER TABLE `publicacio`
  ADD CONSTRAINT `publicacio_ibfk_1` FOREIGN KEY (`idUsuari`) REFERENCES `usuari` (`idUsuari`),
  ADD CONSTRAINT `publicacio_ibfk_2` FOREIGN KEY (`idHistoria`) REFERENCES `historia` (`idHistoria`);

--
-- Filtros para la tabla `publicaciocopia`
--
ALTER TABLE `publicaciocopia`
  ADD CONSTRAINT `publicaciocopia_ibfk_1` FOREIGN KEY (`idUsuari`) REFERENCES `usuaricopia` (`idUsuari`),
  ADD CONSTRAINT `publicaciocopia_ibfk_2` FOREIGN KEY (`idHistoria`) REFERENCES `historiacopia` (`idHistoria`);

--
-- Filtros para la tabla `resposta`
--
ALTER TABLE `resposta`
  ADD CONSTRAINT `resposta_ibfk_1` FOREIGN KEY (`idUsuari`) REFERENCES `usuari` (`idUsuari`),
  ADD CONSTRAINT `resposta_ibfk_2` FOREIGN KEY (`idPublicacioRenviada`) REFERENCES `publicacio` (`idPublicacio`);

--
-- Filtros para la tabla `respostacopia`
--
ALTER TABLE `respostacopia`
  ADD CONSTRAINT `respostacopia_ibfk_1` FOREIGN KEY (`idUsuari`) REFERENCES `usuaricopia` (`idUsuari`),
  ADD CONSTRAINT `respostacopia_ibfk_2` FOREIGN KEY (`idPublicacioRenviada`) REFERENCES `publicaciocopia` (`idPublicacio`);

--
-- Filtros para la tabla `seguidor`
--
ALTER TABLE `seguidor`
  ADD CONSTRAINT `seguidor_ibfk_1` FOREIGN KEY (`idUsuariSeguidor`) REFERENCES `usuari` (`idUsuari`),
  ADD CONSTRAINT `seguidor_ibfk_2` FOREIGN KEY (`idUsuariSeguit`) REFERENCES `usuari` (`idUsuari`);

--
-- Filtros para la tabla `seguidorcopia`
--
ALTER TABLE `seguidorcopia`
  ADD CONSTRAINT `seguidorcopia_ibfk_1` FOREIGN KEY (`idUsuariSeguidor`) REFERENCES `usuaricopia` (`idUsuari`),
  ADD CONSTRAINT `seguidorcopia_ibfk_2` FOREIGN KEY (`idUsuariSeguit`) REFERENCES `usuaricopia` (`idUsuari`);

DELIMITER $$
--
-- Eventos
--
CREATE DEFINER=`root`@`localhost` EVENT `copiaSeguretat` ON SCHEDULE EVERY 1 DAY STARTS '2022-12-08 12:30:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    
    CALL resetCopia();
    CALL backup();
    CALL backupHist();
    CALL backupPubli();
    CALL backupsegui();
    CALL backupMissatge();
    CALL backupResposta();
    END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
