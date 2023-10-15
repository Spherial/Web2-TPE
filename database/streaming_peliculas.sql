-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2023 a las 22:26:00
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
(9, 'Better Call Saul', 'Ambientada en 2002, seis años antes de los acontecimientos relatadas en Breaking Bad, Better Call Saul es un spin-off centrado en el personaje de James \'Jimmy\' McGuill (Bob Odenkirk), antes de que asuma la identidad de Saul Goodman, un abogado corrupto con un humor políticamente incorrecto vinculado al mundo criminal que empieza a crear una importante red de contactos en los bajos mundos. La serie narra los acontecimientos que llevan a McGuill a convertirse en Saul antes de trabajar con Walter W', 'Vince Gilligan', '2015-02-08', 'Bob Odenkirk, Sea Reehorn, etc', 2),
(14, 'Fionna & Cake', ' Fionna y Cake, con la ayuda del antiguo Rey Helado, Simon Petrikov, se embarcan en una aventura de salto multiversal y en un viaje de autodescubrimiento. Mientras tanto, un nuevo y poderoso antagonista, decidido a seguirles la pista y borrarlos de la existencia, acecha en las sombras.', 'Adam Muto', '2023-08-31', 'Cast Fionna', 3),
(15, 'Breaking Bad', 'Breaking Bad sigue la transformación de Walter White, un profesor de química, en un narcotraficante mientras enfrenta su diagnóstico de cáncer terminal. La serie explora la decadencia moral y las consecuencias de sus decisiones.', 'Vince Gilligan', '2008-01-20', 'Cast BB', 2),
(16, 'Testeo 2', 'debug', 'Director Generico', '2023-10-10', 'Lorem Ipsum Dolor Sit Amet', 4),
(17, 'devtest', 'Lorem Ipsum dolor sit amet', 'John Lasseter', '2023-10-15', 'nmnmnmnmnmnmnmnmnmnmnm', 3),
(18, 'Cars 2', 'sinopsis de cars 2', 'John Lasseter 2 ', '2023-10-07', 'CAST CARS ', 5);

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
(2, 'Netflix', 'www.netflix.com', 'Series, Peliculas, Documentales', 1, 5000),
(3, 'HBO Max', 'https://www.hbomax.com/', 'Series, Peliculas, Documentales', 1, 4000),
(4, 'Amazon Prime Video', 'https://www.primevideo.com', 'Series, Peliculas, Documentales', 1, 4500),
(5, 'Disney +', 'https://www.disneyplus.com/es-ar', 'Familiar', 1, 4000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `password`) VALUES
(1, 'webadmin', '$2y$10$sIAxMnXh9.08IV3ZHfiMaODX//GYaxNiyFXrJxrz8PphHK.Mx1dyy');

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
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_pelicula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  MODIFY `id_plataforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
