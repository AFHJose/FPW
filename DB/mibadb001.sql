-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2021 a las 15:04:14
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mibadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id_prop` mediumint(8) UNSIGNED NOT NULL,
  `id_usuario` mediumint(8) UNSIGNED NOT NULL,
  `img_path` varchar(255) NOT NULL,
  `dir` varchar(100) NOT NULL,
  `barrio` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `ambientes` tinyint(3) UNSIGNED DEFAULT NULL,
  `baños` tinyint(3) UNSIGNED DEFAULT NULL,
  `venta` mediumint(8) UNSIGNED DEFAULT NULL,
  `alquiler` mediumint(8) UNSIGNED DEFAULT NULL,
  `dolar` tinyint(1) DEFAULT 0,
  `aire` tinyint(1) DEFAULT 0,
  `balcon` tinyint(1) DEFAULT 0,
  `pileta` tinyint(1) DEFAULT 0,
  `jardin` tinyint(1) DEFAULT 0,
  `gym` tinyint(1) DEFAULT 0,
  `estacionamiento` tinyint(1) DEFAULT 0,
  `activa` tinyint(1) DEFAULT 1,
  `superficie` smallint(5) UNSIGNED DEFAULT NULL,
  `superficie_cubierta` smallint(5) UNSIGNED DEFAULT NULL,
  `certificada` tinyint(1) DEFAULT 0,
  `antiguedad` tinyint(3) UNSIGNED DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id_prop`, `id_usuario`, `img_path`, `dir`, `barrio`, `tipo`, `ambientes`, `baños`, `venta`, `alquiler`, `dolar`, `aire`, `balcon`, `pileta`, `jardin`, `gym`, `estacionamiento`, `activa`, `superficie`, `superficie_cubierta`, `certificada`, `antiguedad`, `autor`) VALUES
(1, 98, '..\\assets\\usuarios\\98\\1\\1.jpg', ' Peatonal Miguel Angel Camino 1100', 'Recoleta', 'Oficina', 1, 1, 273487, 0, 0, 0, 0, 0, 1, 1, 0, 1, 6099, 4251, 0, 193, 'miba'),
(2, 43, '..\\assets\\usuarios\\43\\2\\1.jpg', ' Roentgen 578', 'Villa Luro', 'Cochera', NULL, NULL, 0, 91251, 1, 0, 0, 0, 0, 0, 0, 1, 7870, 3982, 0, 199, 'inmobiliaria'),
(3, 53, '..\\assets\\usuarios\\53\\3\\1.jpg', ' Tte Gral Donato Alvarez 1657', 'La Boca', 'Oficina', 4, 3, 0, 76995, 0, 0, 0, 0, 1, 0, 1, 1, 4402, 2486, 0, 80, 'miba'),
(4, 16, '..\\assets\\usuarios\\16\\4\\1.jpg', ' Gral Fructuoso Rivera 1301', 'Floresta', 'Departamento', 3, 2, 451919, 0, 0, 1, 0, 1, 1, 0, 1, 1, 3424, 1617, 0, 87, 'inmobiliaria'),
(5, 66, '..\\assets\\usuarios\\66\\5\\1.jpg', ' Santa Maria del Buen Aire 717', 'Villa Urquiza', 'Departamento', 2, 1, 171025, 0, 1, 0, 0, 0, 1, 1, 0, 1, 8309, 3830, 0, 47, 'miba'),
(6, 44, '..\\assets\\usuarios\\44\\6\\1.jpg', ' Carlos Maria Ramirez 54', 'Monte Castro', 'Cochera', NULL, NULL, 0, 96581, 1, 0, 0, 0, 0, 0, 0, 1, 9500, 6653, 0, 168, 'miba'),
(7, 88, '..\\assets\\usuarios\\88\\7\\1.jpg', ' Crisostomo Alvarez 353', 'Almagro', 'Casa', 1, 3, 0, 46951, 1, 1, 1, 0, 1, 1, 0, 1, 8002, 7057, 0, 102, 'inmobiliaria'),
(8, 26, '..\\assets\\usuarios\\26\\8\\1.jpg', ' Juana de Ibarbourou 1375', 'Boedo', 'Oficina', 3, 2, 742666, 0, 0, 0, 0, 1, 1, 1, 0, 1, 9823, 7623, 0, 115, 'miba'),
(9, 1, '..\\assets\\usuarios\\86\\9\\1.jpg', ' Diego Paroissien 785', 'Belgrano', 'Oficina', 2, 2, 578437, 0, 1, 0, 0, 1, 1, 1, 1, 1, 8368, 5369, 0, 144, 'miba'),
(10, 17, '..\\assets\\usuarios\\17\\10\\1.jpg', ' Jose A Salmun Feijoo 871', 'Balvanera', 'Departamento', 4, 3, 197828, 0, 1, 0, 1, 0, 0, 1, 0, 1, 5251, 3501, 1, 60, 'inmobiliaria'),
(11, 9, '..\\assets\\usuarios\\9\\11\\1.jpg', ' Peatonal Mons Franceschi 814', 'Villa Devoto', 'Oficina', 4, 2, 796509, 0, 1, 1, 1, 0, 0, 0, 1, 1, 6431, 5322, 0, 42, 'miba'),
(12, 82, '..\\assets\\usuarios\\82\\12\\1.jpg', ' Pueblo Miraflores 1236', 'Villa Ortúzar', 'Departamento', 1, 2, 0, 65865, 1, 0, 1, 1, 0, 1, 0, 1, 9818, 6200, 1, 182, 'inmobiliaria'),
(13, 22, '..\\assets\\usuarios\\22\\13\\1.jpg', ' Andres Arguibel 1216', 'San Cristóbal', 'Oficina', 1, 1, 533734, 0, 0, 1, 0, 1, 0, 1, 1, 1, 9721, 3476, 1, 24, 'miba'),
(14, 37, '..\\assets\\usuarios\\37\\14\\1.jpg', ' Elsa O Connor 1999', 'Parque Avellaneda', 'Casa', 4, 1, 0, 59303, 0, 0, 0, 0, 1, 1, 0, 1, 1819, 1727, 0, 156, 'miba'),
(15, 32, '..\\assets\\usuarios\\32\\15\\1.jpg', ' Jose A Salmun Feijoo 1552', 'Villa Pueyrredón', 'Departamento', 2, 3, 936108, 0, 0, 1, 0, 0, 0, 0, 1, 1, 4782, 436, 0, 42, 'inmobiliaria'),
(16, 70, '..\\assets\\usuarios\\70\\16\\1.jpg', ' Pedro Franco 1600', 'Villa General Mitre', 'Casa', 3, 2, 328472, 0, 0, 0, 1, 1, 0, 0, 1, 1, 1282, 1255, 1, 103, 'miba'),
(17, 92, '..\\assets\\usuarios\\92\\17\\1.jpg', ' Pirovano 324', 'San Nicolás', 'Terreno', NULL, NULL, 0, 25818, 1, 0, 0, 0, 0, 0, 0, 1, 4671, 0, 1, 0, 'propietario'),
(18, 94, '..\\assets\\usuarios\\94\\18\\1.jpg', ' Parral 1738', 'San Telmo', 'Terreno', NULL, NULL, 602883, 0, 0, 0, 0, 0, 0, 0, 0, 1, 6116, 0, 0, 0, 'propietario'),
(19, 99, '..\\assets\\usuarios\\99\\19\\1.jpg', ' Junin 827', 'Villa Ortúzar', 'Departamento', 2, 3, 902323, 0, 1, 0, 0, 1, 1, 1, 1, 1, 1913, 921, 1, 103, 'inmobiliaria'),
(20, 41, '..\\assets\\usuarios\\41\\20\\1.jpg', ' Colpayo 1624', 'Vélez Sarsfield', 'Cochera', NULL, NULL, 125798, 0, 0, 0, 0, 0, 0, 0, 0, 1, 9404, 7560, 0, 109, 'propietario'),
(21, 2, '..\\assets\\usuarios\\2\\21\\1.jpg', ' Fgta la Argentina 939', 'Palermo', 'Terreno', NULL, NULL, 0, 78190, 1, 0, 0, 0, 0, 0, 0, 1, 660, 0, 1, 0, 'propietario'),
(22, 56, '..\\assets\\usuarios\\56\\22\\1.jpg', ' Juan P Calou 259', 'Retiro', 'Casa', 3, 2, 0, 32211, 0, 1, 0, 0, 1, 1, 0, 1, 7521, 6773, 1, 148, 'inmobiliaria'),
(23, 20, '..\\assets\\usuarios\\20\\23\\1.jpg', ' Francisco Beiro 1599', 'Montserrat', 'Casa', 1, 1, 413868, 0, 0, 1, 0, 1, 0, 1, 0, 1, 2894, 1425, 0, 126, 'propietario'),
(24, 19, '..\\assets\\usuarios\\19\\24\\1.jpg', ' Emilio Pettoruti 542', 'Villa Real', 'Terreno', NULL, NULL, 0, 34810, 0, 0, 0, 0, 0, 0, 0, 1, 6763, 0, 0, 0, 'propietario'),
(25, 71, '..\\assets\\usuarios\\71\\25\\1.jpg', ' Victor Hugo 557', 'La Paternal', 'Terreno', NULL, NULL, 0, 87541, 1, 0, 0, 0, 0, 0, 0, 1, 6684, 0, 1, 0, 'inmobiliaria'),
(26, 80, '..\\assets\\usuarios\\80\\26\\1.jpg', ' 20 de Febrero 1203', 'Villa Riachuelo', 'Casa', 1, 2, 509865, 0, 1, 1, 0, 0, 1, 0, 0, 1, 6310, 3084, 1, 58, 'inmobiliaria'),
(27, 20, '..\\assets\\usuarios\\20\\27\\1.jpg', ' Dr Arturo Jauretche 874', 'Villa Real', 'Casa', 3, 1, 117933, 0, 1, 0, 1, 0, 1, 1, 1, 1, 9257, 4832, 1, 137, 'inmobiliaria'),
(28, 58, '..\\assets\\usuarios\\58\\28\\1.jpg', ' Fray Jose W Achaval 1118', 'Villa Crespo', 'Departamento', 4, 2, 309958, 0, 1, 1, 1, 0, 1, 1, 0, 1, 7286, 929, 1, 0, 'propietario'),
(29, 96, '..\\assets\\usuarios\\96\\29\\1.jpg', ' Rosario 1692', 'Vélez Sarsfield', 'Casa', 3, 3, 0, 66776, 0, 0, 1, 1, 0, 0, 1, 1, 8994, 6551, 0, 94, 'propietario'),
(30, 84, '..\\assets\\usuarios\\84\\30\\1.jpg', ' Charcas 916', 'Barracas', 'Departamento', 2, 3, 0, 46429, 1, 1, 1, 1, 0, 1, 1, 1, 4535, 4136, 1, 3, 'miba'),
(31, 37, '..\\assets\\usuarios\\37\\31\\1.jpg', ' Gral Cornelio Saavedra 1391', 'Parque Avellaneda', 'Terreno', NULL, NULL, 216299, 0, 0, 0, 0, 0, 0, 0, 0, 1, 7846, 0, 0, 0, 'inmobiliaria'),
(32, 15, '..\\assets\\usuarios\\15\\32\\1.jpg', ' Guzman 421', 'Palermo', 'Casa', 2, 3, 523048, 0, 0, 0, 1, 1, 1, 1, 1, 1, 5676, 3844, 1, 110, 'miba'),
(33, 27, '..\\assets\\usuarios\\27\\33\\1.jpg', ' Juan Vucetich 88', 'Puerto Madero', 'Oficina', 3, 1, 0, 34610, 0, 1, 0, 1, 0, 1, 0, 1, 3209, 1621, 1, 9, 'miba'),
(34, 33, '..\\assets\\usuarios\\33\\34\\1.jpg', ' Gervasio Espinosa 588', 'Villa Santa Rita', 'Casa', 3, 3, 831794, 0, 0, 1, 0, 0, 1, 0, 1, 1, 6756, 3802, 1, 26, 'inmobiliaria'),
(35, 13, '..\\assets\\usuarios\\13\\35\\1.jpg', ' Diego E Zavaleta 819', 'Parque Chacabuco', 'Cochera', NULL, NULL, 0, 51637, 1, 0, 0, 0, 0, 0, 0, 1, 5538, 102, 1, 35, 'propietario'),
(36, 83, '..\\assets\\usuarios\\83\\36\\1.jpg', ' Tomas Valencia 1607', 'Liniers', 'Departamento', 4, 3, 300640, 0, 1, 0, 1, 1, 0, 0, 1, 1, 8741, 7690, 0, 176, 'propietario'),
(37, 61, '..\\assets\\usuarios\\61\\37\\1.jpg', ' Nicolas Vila 784', 'Vélez Sarsfield', 'Terreno', NULL, NULL, 67903, 0, 1, 0, 0, 0, 0, 0, 0, 1, 9311, 0, 0, 0, 'propietario'),
(38, 14, '..\\assets\\usuarios\\14\\38\\1.jpg', ' Treinta y Tres Orientales 585', 'Almagro', 'Terreno', NULL, NULL, 0, 82871, 1, 0, 0, 0, 0, 0, 0, 1, 8615, 0, 1, 0, 'propietario'),
(39, 60, '..\\assets\\usuarios\\60\\39\\1.jpg', ' Policarpo Mom 1674', 'San Nicolás', 'Cochera', NULL, NULL, 0, 65218, 0, 0, 0, 0, 0, 0, 0, 1, 7053, 6656, 1, 187, 'inmobiliaria'),
(40, 77, '..\\assets\\usuarios\\77\\40\\1.jpg', ' El Recado 1981', 'Villa Devoto', 'Casa', 1, 1, 354503, 0, 0, 0, 1, 1, 1, 1, 0, 1, 7263, 5371, 0, 179, 'propietario'),
(41, 46, '..\\assets\\usuarios\\46\\41\\1.jpg', ' Sanabria 1095', 'Villa Devoto', 'Cochera', NULL, NULL, 860551, 0, 1, 0, 0, 0, 0, 0, 0, 1, 5326, 1303, 0, 0, 'propietario'),
(42, 28, '..\\assets\\usuarios\\28\\42\\1.jpg', ' Muñecas 665', 'La Paternal', 'Casa', 1, 2, 0, 50316, 0, 1, 1, 0, 1, 0, 0, 1, 9484, 1529, 1, 135, 'propietario'),
(43, 62, '..\\assets\\usuarios\\62\\43\\1.jpg', ' Patagones 702', 'Floresta', 'Departamento', 2, 2, 0, 35988, 1, 0, 1, 1, 0, 0, 0, 1, 5924, 1922, 1, 169, 'inmobiliaria'),
(44, 25, '..\\assets\\usuarios\\25\\44\\1.jpg', ' Colombia 332', 'Parque Avellaneda', 'Terreno', NULL, NULL, 0, 91867, 0, 0, 0, 0, 0, 0, 0, 1, 6734, 0, 1, 0, 'inmobiliaria'),
(45, 58, '..\\assets\\usuarios\\58\\45\\1.jpg', ' Punta Arenas 92', 'Villa Lugano', 'Cochera', NULL, NULL, 389390, 0, 0, 0, 0, 0, 0, 0, 0, 1, 6163, 4959, 1, 47, 'propietario'),
(46, 73, '..\\assets\\usuarios\\73\\46\\1.jpg', ' Gral B Victorica 691', 'Caballito', 'Departamento', 1, 2, 618088, 0, 0, 0, 1, 1, 1, 1, 0, 1, 4475, 2066, 1, 189, 'propietario'),
(47, 43, '..\\assets\\usuarios\\43\\47\\1.jpg', ' Chimborazo 208', 'San Cristóbal', 'Departamento', 3, 1, 0, 34230, 1, 1, 1, 0, 1, 0, 0, 1, 5959, 5913, 1, 163, 'propietario'),
(48, 75, '..\\assets\\usuarios\\75\\48\\1.jpg', ' Mandisovi 1312', 'Balvanera', 'Casa', 4, 1, 0, 88861, 0, 0, 1, 0, 1, 1, 1, 1, 4446, 1051, 0, 61, 'inmobiliaria'),
(49, 31, '..\\assets\\usuarios\\31\\49\\1.jpg', ' El Ñandu 391', 'Liniers', 'Terreno', NULL, NULL, 715085, 0, 0, 0, 0, 0, 0, 0, 0, 1, 6597, 0, 1, 0, 'miba'),
(50, 34, '..\\assets\\usuarios\\34\\50\\1.jpg', ' Jose Borches 1338', 'Villa Riachuelo', 'Departamento', 4, 1, 256568, 0, 0, 1, 1, 0, 1, 1, 0, 1, 8749, 4110, 1, 183, 'miba'),
(51, 86, '..\\assets\\usuarios\\86\\51\\1.jpg', ' Santa Teresa 1800', 'Saavedra', 'Departamento', 1, 1, 129483, 0, 0, 0, 0, 1, 1, 1, 0, 1, 7453, 3934, 0, 164, 'miba'),
(52, 15, '..\\assets\\usuarios\\15\\52\\1.jpg', ' Posta 620', 'Constitución', 'Departamento', 3, 3, 896517, 0, 1, 0, 1, 1, 1, 1, 0, 1, 8997, 1364, 0, 169, 'propietario'),
(53, 43, '..\\assets\\usuarios\\43\\53\\1.jpg', ' Cafayate 1188', 'Colegiales', 'Oficina', 3, 2, 592662, 0, 0, 1, 1, 1, 1, 1, 0, 1, 9957, 7698, 0, 105, 'miba'),
(54, 43, '..\\assets\\usuarios\\43\\54\\1.jpg', ' Santa Cruz 1286', 'Puerto Madero', 'Departamento', 1, 3, 0, 84995, 0, 0, 1, 0, 0, 1, 0, 1, 5343, 767, 1, 38, 'miba'),
(55, 73, '..\\assets\\usuarios\\73\\55\\1.jpg', ' Oslo 716', 'Flores', 'Oficina', 4, 2, 0, 60640, 0, 0, 0, 0, 1, 0, 0, 1, 4534, 197, 0, 171, 'propietario'),
(56, 84, '..\\assets\\usuarios\\84\\56\\1.jpg', ' Centenario 1132', 'San Nicolás', 'Cochera', NULL, NULL, 157876, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2993, 1616, 1, 111, 'propietario'),
(57, 63, '..\\assets\\usuarios\\63\\57\\1.jpg', ' Jose Antonio Miralla 714', 'Retiro', 'Cochera', NULL, NULL, 313672, 0, 0, 0, 0, 0, 0, 0, 0, 1, 9059, 352, 1, 19, 'miba'),
(58, 69, '..\\assets\\usuarios\\69\\58\\1.jpg', ' Formosa 1723', 'Monte Castro', 'Cochera', NULL, NULL, 0, 85564, 0, 0, 0, 0, 0, 0, 0, 1, 9918, 6165, 1, 16, 'propietario'),
(59, 40, '..\\assets\\usuarios\\40\\59\\1.jpg', ' Agaces 1550', 'Villa Soldati', 'Oficina', 4, 3, 499375, 0, 0, 0, 0, 1, 1, 0, 1, 1, 6766, 6469, 1, 4, 'miba'),
(60, 71, '..\\assets\\usuarios\\71\\60\\1.jpg', ' Placido Martinez 1676', 'Parque Patricios', 'Departamento', 1, 2, 95726, 0, 0, 1, 1, 0, 1, 1, 1, 1, 8964, 6859, 1, 189, 'miba'),
(61, 82, '..\\assets\\usuarios\\82\\61\\1.jpg', ' Jose Pedro Varela 94', 'Saavedra', 'Oficina', 3, 1, 0, 74768, 1, 1, 1, 1, 1, 0, 1, 1, 9096, 6107, 1, 122, 'miba'),
(62, 49, '..\\assets\\usuarios\\49\\62\\1.jpg', ' Tuyuti 207', 'Palermo', 'Departamento', 3, 3, 795904, 0, 1, 0, 0, 0, 1, 1, 1, 1, 8001, 7131, 0, 55, 'propietario'),
(63, 97, '..\\assets\\usuarios\\97\\63\\1.jpg', ' Miguel Couto 1372', 'Nuñez', 'Terreno', NULL, NULL, 734349, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2810, 0, 1, 0, 'propietario'),
(64, 90, '..\\assets\\usuarios\\90\\64\\1.jpg', ' Ambrosio Olmos 1189', 'Nueva Pompeya', 'Terreno', NULL, NULL, 0, 46959, 0, 0, 0, 0, 0, 0, 0, 1, 8819, 0, 0, 0, 'inmobiliaria'),
(65, 100, '..\\assets\\usuarios\\100\\65\\1.jpg', ' Hilario de Almeira 589', 'Parque Patricios', 'Cochera', NULL, NULL, 0, 71690, 0, 0, 0, 0, 0, 0, 0, 1, 8098, 6979, 0, 55, 'inmobiliaria'),
(66, 90, '..\\assets\\usuarios\\90\\66\\1.jpg', ' Tte Gral Luis J Dellepiane 187', 'San Telmo', 'Cochera', NULL, NULL, 0, 65522, 1, 0, 0, 0, 0, 0, 0, 1, 9530, 5549, 1, 40, 'propietario'),
(67, 23, '..\\assets\\usuarios\\23\\67\\1.jpg', ' Julian Navarro 1597', 'Palermo', 'Terreno', NULL, NULL, 237613, 0, 1, 0, 0, 0, 0, 0, 0, 1, 9981, 0, 0, 0, 'inmobiliaria'),
(68, 80, '..\\assets\\usuarios\\80\\68\\1.jpg', ' Del Temple 103', 'Barracas', 'Oficina', 1, 3, 781308, 0, 1, 1, 1, 1, 1, 0, 1, 1, 4921, 1103, 0, 78, 'inmobiliaria'),
(69, 11, '..\\assets\\usuarios\\11\\69\\1.jpg', ' Luis Braille 1379', 'Villa Lugano', 'Casa', 4, 1, 0, 96766, 1, 1, 1, 1, 1, 1, 0, 1, 4167, 3197, 1, 36, 'propietario'),
(70, 16, '..\\assets\\usuarios\\16\\70\\1.jpg', ' Virrey Liniers 493', 'Balvanera', 'Cochera', NULL, NULL, 0, 64638, 1, 0, 0, 0, 0, 0, 0, 1, 6761, 3791, 1, 125, 'propietario'),
(71, 3, '..\\assets\\usuarios\\3\\71\\1.jpg', ' Guardia Nacional 1669', 'Versalles', 'Oficina', 4, 1, 0, 37470, 0, 0, 0, 1, 0, 0, 0, 1, 7884, 5900, 1, 116, 'inmobiliaria'),
(72, 38, '..\\assets\\usuarios\\38\\72\\1.jpg', ' Tte Cnel Manuel Besares 1108', 'Villa General Mitre', 'Departamento', 1, 3, 841326, 0, 0, 1, 0, 0, 1, 0, 1, 1, 8318, 6720, 0, 150, 'inmobiliaria'),
(73, 78, '..\\assets\\usuarios\\78\\73\\1.jpg', ' Dr David Peña 1141', 'Villa Luro', 'Terreno', NULL, NULL, 0, 76419, 1, 0, 0, 0, 0, 0, 0, 1, 9840, 0, 1, 0, 'miba'),
(74, 100, '..\\assets\\usuarios\\100\\74\\1.jpg', ' Cbo Teodoro P Fels 570', 'Balvanera', 'Casa', 4, 2, 275765, 0, 1, 1, 0, 1, 0, 0, 0, 1, 1771, 964, 0, 6, 'inmobiliaria'),
(75, 42, '..\\assets\\usuarios\\42\\75\\1.jpg', ' Costanera Dr Achaval Rodriguez 278', 'Parque Avellaneda', 'Departamento', 2, 3, 555325, 0, 0, 0, 0, 0, 1, 1, 1, 1, 4638, 1252, 0, 71, 'inmobiliaria'),
(76, 82, '..\\assets\\usuarios\\82\\76\\1.jpg', ' Fortin Melincue 1740', 'La Paternal', 'Cochera', NULL, NULL, 177949, 0, 0, 0, 0, 0, 0, 0, 0, 1, 7256, 2259, 0, 155, 'inmobiliaria'),
(77, 47, '..\\assets\\usuarios\\47\\77\\1.jpg', ' Chilecito 898', 'Parque Avellaneda', 'Terreno', NULL, NULL, 266751, 0, 1, 0, 0, 0, 0, 0, 0, 1, 8746, 0, 1, 0, 'propietario'),
(78, 44, '..\\assets\\usuarios\\44\\78\\1.jpg', ' Wagner 281', 'San Telmo', 'Oficina', 4, 1, 192666, 0, 0, 0, 1, 0, 0, 1, 0, 1, 5874, 3684, 1, 50, 'propietario'),
(79, 23, '..\\assets\\usuarios\\23\\79\\1.jpg', ' Gral Juan M de Pueyrredon 1864', 'Villa Pueyrredón', 'Departamento', 3, 3, 166916, 0, 0, 0, 1, 1, 0, 0, 1, 1, 7972, 1662, 1, 58, 'miba'),
(80, 39, '..\\assets\\usuarios\\39\\80\\1.jpg', ' Regina Pacini de Alvear 1345', 'Colegiales', 'Terreno', NULL, NULL, 0, 74124, 0, 0, 0, 0, 0, 0, 0, 1, 9104, 0, 1, 0, 'miba'),
(81, 70, '..\\assets\\usuarios\\70\\81\\1.jpg', ' Gregorio Jaramillo 1027', 'Villa Riachuelo', 'Cochera', NULL, NULL, 332187, 0, 0, 0, 0, 0, 0, 0, 0, 1, 3785, 565, 0, 140, 'miba'),
(82, 11, '..\\assets\\usuarios\\11\\82\\1.jpg', ' Francisco Bucarelli 1390', 'Constitución', 'Cochera', NULL, NULL, 779197, 0, 0, 0, 0, 0, 0, 0, 0, 1, 3751, 3427, 0, 73, 'miba'),
(83, 77, '..\\assets\\usuarios\\77\\83\\1.jpg', ' Francisco Pizarro 1019', 'Floresta', 'Departamento', 3, 3, 0, 38984, 1, 0, 1, 1, 0, 0, 0, 1, 9743, 6495, 1, 139, 'propietario'),
(84, 67, '..\\assets\\usuarios\\67\\84\\1.jpg', ' Santiago Costamagna 1234', 'La Paternal', 'Terreno', NULL, NULL, 462608, 0, 1, 0, 0, 0, 0, 0, 0, 1, 7652, 0, 0, 0, 'miba'),
(85, 78, '..\\assets\\usuarios\\78\\85\\1.jpg', ' Alberto Williams 85', 'La Paternal', 'Terreno', NULL, NULL, 134406, 0, 1, 0, 0, 0, 0, 0, 0, 1, 8142, 0, 0, 0, 'inmobiliaria'),
(86, 89, '..\\assets\\usuarios\\89\\86\\1.jpg', ' Virrey Joaquin del Pino 1956', 'Colegiales', 'Departamento', 1, 3, 686757, 0, 1, 0, 1, 1, 1, 1, 0, 1, 8938, 4386, 0, 101, 'inmobiliaria'),
(87, 63, '..\\assets\\usuarios\\63\\87\\1.jpg', ' Juana Manso 1417', 'Villa Lugano', 'Oficina', 3, 1, 844479, 0, 0, 0, 1, 1, 1, 0, 0, 1, 9623, 7456, 0, 164, 'propietario'),
(88, 98, '..\\assets\\usuarios\\98\\88\\1.jpg', ' Matanza 29', 'Boedo', 'Departamento', 3, 1, 574630, 0, 0, 1, 1, 0, 0, 1, 1, 1, 8928, 3467, 1, 24, 'miba'),
(89, 40, '..\\assets\\usuarios\\40\\89\\1.jpg', ' Gelly Obes 1322', 'Villa General Mitre', 'Oficina', 4, 2, 0, 60650, 1, 1, 1, 0, 0, 0, 1, 1, 5535, 2517, 0, 191, 'propietario'),
(90, 19, '..\\assets\\usuarios\\19\\90\\1.jpg', ' Stephenson 1733', 'Floresta', 'Oficina', 3, 1, 127800, 0, 0, 0, 1, 0, 1, 1, 0, 1, 4832, 1504, 0, 143, 'propietario'),
(91, 56, '..\\assets\\usuarios\\56\\91\\1.jpg', ' Madero 820', 'Puerto Madero', 'Casa', 1, 1, 0, 23755, 0, 1, 1, 1, 1, 0, 0, 1, 646, 173, 1, 160, 'propietario'),
(92, 33, '..\\assets\\usuarios\\33\\92\\1.jpg', ' 11 de Septiembre de 1888 215', 'Parque Chas', 'Oficina', 1, 1, 133875, 0, 1, 0, 1, 0, 0, 0, 1, 1, 7537, 1818, 0, 16, 'propietario'),
(93, 24, '..\\assets\\usuarios\\24\\93\\1.jpg', ' Cnel Carlos Sourigues 1780', 'Villa Real', 'Terreno', NULL, NULL, 895570, 0, 1, 0, 0, 0, 0, 0, 0, 1, 9169, 0, 0, 0, 'miba'),
(94, 19, '..\\assets\\usuarios\\19\\94\\1.jpg', ' Dante 133', 'Mataderos', 'Departamento', 4, 3, 0, 29253, 1, 1, 1, 1, 1, 1, 1, 1, 2478, 1732, 0, 132, 'inmobiliaria'),
(95, 6, '..\\assets\\usuarios\\6\\95\\1.jpg', ' Tinogasta 280', 'Villa Riachuelo', 'Casa', 1, 1, 0, 90182, 1, 0, 1, 0, 0, 1, 1, 1, 8104, 7352, 1, 23, 'miba'),
(96, 7, '..\\assets\\usuarios\\7\\96\\1.jpg', ' Yrupe 347', 'Mataderos', 'Casa', 3, 2, 497809, 0, 0, 0, 1, 1, 0, 0, 0, 1, 9776, 1416, 0, 93, 'propietario'),
(97, 90, '..\\assets\\usuarios\\90\\97\\1.jpg', ' Cnel Pedro Garcia 1826', 'Villa Ortúzar', 'Cochera', NULL, NULL, 0, 27435, 0, 0, 0, 0, 0, 0, 0, 1, 9114, 7823, 0, 36, 'inmobiliaria'),
(98, 23, '..\\assets\\usuarios\\23\\98\\1.jpg', ' Fortunato Devoto 572', 'Boedo', 'Casa', 2, 1, 0, 28753, 0, 0, 0, 1, 0, 0, 1, 1, 7657, 1431, 1, 130, 'miba'),
(99, 58, '..\\assets\\usuarios\\58\\99\\1.jpg', ' Ariel 384', 'Parque Chas', 'Oficina', 3, 3, 886835, 0, 1, 0, 1, 1, 1, 1, 1, 1, 7831, 5771, 1, 128, 'propietario'),
(100, 56, '..\\assets\\usuarios\\56\\100\\1.jpg', ' Santa Catalina 1701', 'Mataderos', 'Cochera', NULL, NULL, 774661, 0, 0, 0, 0, 0, 0, 0, 0, 1, 9510, 6658, 1, 146, 'inmobiliaria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` mediumint(8) UNSIGNED NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `activa` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contraseña`, `correo`, `activa`) VALUES
(1, 'admin1', 'admin123', 'admin@miba.org', 1),
(2, 'aachen', 'ackerman', '1127.kimberly@gmail.com', 1),
(3, 'aalborg', 'alexander', '1539601486@qq.com', 1),
(4, 'aalesund', 'anderson', '1990G8REngineer@gmail.com', 1),
(5, 'aardvark', 'annunzio', '1constmgr@gmail.com', 1),
(6, 'aardwolf', 'applegate', '1jlanger@comcast.net', 1),
(7, 'aargau', 'ballenger', '1kr.davis@gmail.com', 1),
(8, 'aarhus', 'bartlett', '1marini@bellsouth.net', 1),
(9, 'aarika', 'beilenson', '1rajiv@gmail.com', 1),
(10, 'aaronaaronic', 'benjamin', '1seh@earthlink.net', 1),
(11, 'aaronson', 'bereuter', '2001g8tor@gmail.com', 1),
(12, 'abacist', 'bilirakis', '2001soni@gmail.com', 1),
(13, 'abacus', 'bingaman', '2001ufgator@comcast.net', 1),
(14, 'abadan', 'boehlert', '2011AZChris@Gmail.com', 1),
(15, 'abaddon', 'brewster', '2014@visionengineering.us', 1),
(16, 'abagael', 'broomfield', '22iriswalden@gmail.com', 1),
(17, 'abagail', 'bustamante', '24mlove24@gmail.com', 1),
(18, 'abalone', 'callahan', '281livengood@comcast.net', 1),
(19, 'abampere', 'campbell', '2brian.broussard@gmail.com', 1),
(20, 'abandon', 'chalmers', '2chris.clark@gmail.com', 1),
(21, 'abandoned', 'chandler', '2dennykort@gmail.com', 1),
(22, 'abarca', 'christopher', '2divefor@embarqmail.com', 1),
(23, 'abatement', 'claiborne', '2dsherrill@gmail.com', 1),
(24, 'abatis', 'clarence', '2jssogge@q.com', 1),
(25, 'abattoir', 'clifford', '3.0x10e8@gmail.com', 1),
(26, 'abaxial', 'constance', '3000mendez@gmail.com', 1),
(27, 'abbacy', 'costello', '3720@cfl.rr.com', 1),
(28, 'abbasid', 'coughlin', '3dnielsen@gmail.com', 1),
(29, 'abbate', 'cranston', '3krids3653@gmail.com', 1),
(30, 'abbatial', 'cunningham', '3ncfishers@gmail.com', 1),
(31, 'abbess', 'danforth', '3pinestreefarm@tampabay.rr.com', 1),
(32, 'abbevillian', 'dannemeyer', '3rdtry137@comcast.net', 1),
(33, 'abbeyabbi', 'deconcini', '450KNOBBY@ATT.NET', 1),
(34, 'abbieabbot', 'dickinson', '4av@bellsouth.net', 1),
(35, 'abbotsen', 'domenici', '4millers@tampabay.rr.com', 1),
(36, 'abbotson', 'donnelly', '4panders4@gmail.com', 1),
(37, 'abbotsun', 'doolittle', '5brown@fit.edu', 1),
(38, 'abbott', 'durenberger', '5gators@gmail.com', 1),
(39, 'abbottson', 'edolphus', '5Houstons@tampabay.rr.com', 1),
(40, 'abbreviate', 'elizabeth', '5remichs@cox.net', 1),
(41, 'abbreviated', 'erdreich', '5trimbles@suddenlink.net', 1),
(42, 'abbreviation', 'foglietta', '64panhead@comcast.net', 1),
(43, 'abbyabbye', 'frederick', '689@comcast.net', 1),
(44, 'abcoulomb', 'gallegly', '69runner@charter.net', 1),
(45, 'abdella', 'gejdenson', '6Romas@GMail.com', 1),
(46, 'abdias', 'gephardt', '71herom@gmail.com', 1),
(47, 'abdicate', 'gilchrest', '789spark@att.net', 1),
(48, 'abdication', 'gingrich', '7he@7he.us', 1),
(49, 'abdomen', 'glickman', '7radar7@verizon.net', 1),
(50, 'abdominal', 'gonzalez', '86944T@BELLSOUTH.NET', 1),
(51, 'abdominous', 'goodling', '9327@pbsj.com', 1),
(52, 'abduce', 'gradison', '940smith@gmail.com', 1),
(53, 'abducent', 'grassley', '97gator1@gmail.com', 1),
(54, 'abduct', 'gunderson', '9ESW9@BELLSOUTH.NET', 1),
(55, 'abduction', 'hamilton', 'a.alavi@gmail.com', 1),
(56, 'abductor', 'hammerschmidt', 'a.anaya@esrpcorp.com', 1),
(57, 'abdulabdulla', 'hatfield', 'a.baker.ab@gmail.com', 1),
(58, 'abdullah', 'hoagland', 'a.booth@coastal-plain.com', 1),
(59, 'abeabeam', 'hochbrueckner', 'a.call@gaiconsultants.com', 1),
(60, 'abecedarian', 'hollings', 'a.cherko@umiami.edu', 1),
(61, 'abecedarium', 'holloway', 'a.d.caicedo@gmail.com', 1),
(62, 'abecedary', 'houghton', 'a.e.restrepo@gmail.com', 1),
(63, 'abednego', 'jefferson', 'a.esposito330@gmail.com', 1),
(64, 'abelabelard', 'jeffords', 'a.f.shepard@gmail.com', 1),
(65, 'abelmosk', 'johnston', 'a.ferree@knights.ucf.edu', 1),
(66, 'abeokuta', 'kanjorski', 'a.greig.garland@gmail.com', 1),
(67, 'abercrombie', 'kassebaum', 'a.j.yatsko@gmail.com', 1),
(68, 'abercromby', 'kennelly', 'a.jordan.thomas@gmail.com', 1),
(69, 'aberdare', 'kopetski', 'a.koo@robertco.com', 1),
(70, 'aberdeen', 'kostmayer', 'A.KPA@VERIZON.NET', 1),
(71, 'abernathy', 'lagomarsino', 'a.l.barredo@fpl.com', 1),
(72, 'abernethy', 'lancaster', 'a.may2973@gmail.com', 1),
(73, 'abernon', 'laughlin', 'a.millward@millwardeng.com', 1),
(74, 'aberrant', 'lautenberg', 'a.neemeh@hotmail.com', 1),
(75, 'aberration', 'lawrence', 'A.NOOROLLAHI@YAHOO.COM', 1),
(76, 'abessive', 'lehtinen', 'a.nordlinger@ieee.org', 1),
(77, 'abettor', 'lieberman', 'a.nurse@umiami.edu', 1),
(78, 'abeyance', 'lightfoot', 'a.oliver@outlook.com', 1),
(79, 'abeyant', 'lipinski', 'a.porges@umiami.edu', 1),
(80, 'abeyta', 'livingston', 'a.redono22@gmail.com', 1),
(81, 'abfarad', 'machtley', 'a.roland.holt@att.net', 1),
(82, 'abhenry', 'marlenee', 'a.s.harris1@gmail.com', 1),
(83, 'abhorrence', 'martinez', 'a.senyushkina@yahoo.com', 1),
(84, 'abhorrent', 'mavroules', 'a.shoraka@unf.edu', 1),
(85, 'abiding', 'mccandless', 'a.siegel@unf.edu', 1),
(86, 'abidjan', 'mccloskey', 'a.zaher@umiami.edu', 1),
(87, 'abigael', 'mccollum', 'a_bandela@hotmail.com', 1),
(88, 'abigail', 'mcconnell', 'a_elagroudy@yahoo.com', 1),
(89, 'abigailabigale', 'mcdermott', 'a_falletta@fallettaengineering.com', 1),
(90, 'abijah', 'mcmillan', 'a_j_perez@hotmail.com', 1),
(91, 'abilene', 'mcmillen', 'a_malats71@hotmail.com', 1),
(92, 'ability', 'metzenbaum', 'A_menjohnson@hotmail.com', 1),
(93, 'abingdon', 'mikulski', 'a_michuda@yahoo.com', 1),
(94, 'abiogenesis', 'mitchell', 'a_r_bravo@hotmail.com', 1),
(95, 'abiogenetic', 'molinari', 'a_shasti@yahoo.com', 1),
(96, 'abiosis', 'mollohan', 'a_travist2004@yahoo.com', 1),
(97, 'abiotic', 'montgomery', 'a-10@comcast.net', 1),
(98, 'abirritant', 'moorhead', 'a1m33_t4y@hotmail.com', 1),
(99, 'abirritate', 'morrison', 'a237532@gmail.com', 1),
(100, 'abisha', 'moynihan', 'a3lsalg@comcast.net', 1),
(101, 'Juanito', 'Fernandez', 'sancarlos@edu.org', 1),
(102, 'aaberg', 'abercrombie', '053sph@gmail.com', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id_prop`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id_prop` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `propiedades_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
