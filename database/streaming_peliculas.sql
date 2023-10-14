-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2023 a las 04:26:00
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
-- Base de datos: `streaming_peliculas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id_pelicula` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `sinopsis` varchar(500) NOT NULL,
  `director` varchar(255) DEFAULT NULL,
  `año_lanzamiento` date DEFAULT NULL,
  `cast` varchar(500) NOT NULL,
  `plataforma_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_pelicula`, `titulo`, `sinopsis`, `director`, `año_lanzamiento`, `cast`, `plataforma_id`) VALUES
(4, 'Breaking Bad', 'JESSE WE NEED TO COOK', 'Vince Gilligan', '2008-01-20', 'INSERTAR CAST', 2),
(5, 'Star Wars', 'EN UNA GALAXIA MUY LEJANA...', 'Lucas Trotacielos', '1977-12-25', 'TODO EL CAST DE STARWARS', 3),
(6, 'El Señor de los Anillos: Los Anillos del Poder', 'MY PRECIOUS...', 'Peter Jackson', '2022-09-01', 'CAST DE LA SERIE', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataformas`
--

CREATE TABLE `plataformas` (
  `id_plataforma` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `enlace` varchar(255) NOT NULL,
  `tipo_contenido` varchar(255) DEFAULT NULL,
  `disponibilidad_ar` tinyint(1) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plataformas`
--

INSERT INTO `plataformas` (`id_plataforma`, `nombre`, `enlace`, `tipo_contenido`, `disponibilidad_ar`, `precio`) VALUES
(1, 'Netflix', 'https://www.netflix.com', 'Series, Peliculas, Documentales y Juegos', 1, 3990.24),
(2, 'HBO Max', 'https://www.hbomax.com/', 'Series y Peliculas', 1, 1216.0),
(3, 'Amazon Prime Video', 'https://www.primevideo.com', 'Series, Peliculas y Documentales', 1, 1390.0),
(4, 'Star+', 'https://www.starplus.com', 'Series, Peliculas, Documentales y Deporte', 1, 1749.0),
(5, 'Disney+', 'https://www.disneyplus.com', 'Series, Peliculas y Documentales', 1, 799.0),
(6, 'paramount+', 'https://www.paramountplus.com', 'Series, Peliculas y Documentales', 1, 318.0),
(7, 'MUBI', 'https://mubi.com', 'Peliculas y Documentales', 1, 599.0),
(8, 'AppleTV', 'https://appleTV.com', 'Series, Peliculas y Documentales', 1, 8750.0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_pelicula`),
  ADD KEY `plataforma_id` (`plataforma_id`);

--
-- Indices de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  ADD PRIMARY KEY (`id_plataforma`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  MODIFY `id_plataforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `peliculas_ibfk_1` FOREIGN KEY (`plataforma_id`) REFERENCES `plataformas` (`id_plataforma`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
