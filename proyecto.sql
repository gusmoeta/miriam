-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2018 a las 21:10:11
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentos_pre`
--

CREATE TABLE `alimentos_pre` (
  `id` varchar(36) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `id_usuario` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alimentos_users`
--

CREATE TABLE `alimentos_users` (
  `id` varchar(36) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fecha_reg_alimento` date NOT NULL,
  `fecha_caducidad` date NOT NULL,
  `fecha_congelado` date DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `id_usuario` varchar(36) DEFAULT NULL,
  `id_tipo` varchar(36) DEFAULT NULL,
  `id_categoria` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alimentos_users`
--

INSERT INTO `alimentos_users` (`id`, `nombre`, `fecha_reg_alimento`, `fecha_caducidad`, `fecha_congelado`, `foto`, `id_usuario`, `id_tipo`, `id_categoria`) VALUES
('4b991a22-5f83-11e8-bb63-fcaa140c1e64', 'Huevos', '2018-05-24', '2018-05-21', NULL, 'fotos/huevos.jpg', 'fc1e81d6-5aa0-11e8-a54d-e0d55e08b86f', '4c919ada-5aa0-11e8-a54d-e0d55e08b86f', 'b3267fa0-5cff-11e8-8b69-fcaa140c1e64'),
('4e330044-5ded-11e8-9c45-fcaa140c1e64', 'Fresas', '2018-05-22', '2018-05-27', NULL, 'fotos/fresas-2.jpg', 'fc1e81d6-5aa0-11e8-a54d-e0d55e08b86f', '4c919ada-5aa0-11e8-a54d-e0d55e08b86f', 'b3284c64-5cff-11e8-8b69-fcaa140c1e64'),
('5884d514-5f7d-11e8-bb63-fcaa140c1e64', 'Chocolate', '2018-05-24', '2019-08-30', NULL, 'fotos/choco.jpg', 'fc1e81d6-5aa0-11e8-a54d-e0d55e08b86f', '4c919b77-5aa0-11e8-a54d-e0d55e08b86f', 'b3267fa0-5cff-11e8-8b69-fcaa140c1e64'),
('8d7aa21c-5ec2-11e8-a2a3-fcaa140c1e64', 'Magdalenas', '2018-05-23', '2018-05-31', NULL, 'fotos/magdalenas.jpg', 'fc1e81d6-5aa0-11e8-a54d-e0d55e08b86f', '4c919b77-5aa0-11e8-a54d-e0d55e08b86f', 'b3284c64-5cff-11e8-8b69-fcaa140c1e64'),
('c0471c14-5ec1-11e8-a2a3-fcaa140c1e64', 'Albóndigas', '2018-05-23', '2018-06-22', NULL, 'fotos/albondigas.jpg', 'fc1e81d6-5aa0-11e8-a54d-e0d55e08b86f', '4c901697-5aa0-11e8-a54d-e0d55e08b86f', 'b3284c64-5cff-11e8-8b69-fcaa140c1e64');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` varchar(36) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `icono` varchar(255) DEFAULT NULL,
  `id_usuario` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `icono`, `id_usuario`) VALUES
('b3267fa0-5cff-11e8-8b69-fcaa140c1e64', 'Verduras de hoja verde con flor naranja', NULL, 'fc1e81d6-5aa0-11e8-a54d-e0d55e08b86f'),
('b3284b2b-5cff-11e8-8b69-fcaa140c1e64', 'Comida china', NULL, 'fc1e81d6-5aa0-11e8-a54d-e0d55e08b86f'),
('b3284c00-5cff-11e8-8b69-fcaa140c1e64', 'Carne', NULL, 'fc1e81d6-5aa0-11e8-a54d-e0d55e08b86f'),
('b3284c64-5cff-11e8-8b69-fcaa140c1e64', 'Fruta', NULL, 'fc1e81d6-5aa0-11e8-a54d-e0d55e08b86f'),
('b3284cb5-5cff-11e8-8b69-fcaa140c1e64', 'Pescado', NULL, 'fc1e81d6-5aa0-11e8-a54d-e0d55e08b86f'),
('b3284d21-5cff-11e8-8b69-fcaa140c1e64', 'Pasta', NULL, 'fc1e81d6-5aa0-11e8-a54d-e0d55e08b86f');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_google`
--

CREATE TABLE `login_google` (
  `google_id` decimal(21,0) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id` varchar(36) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `icono` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `nombre`, `icono`) VALUES
('4c901697-5aa0-11e8-a54d-e0d55e08b86f', 'congelado', 'tipo_congelado.png'),
('4c919ada-5aa0-11e8-a54d-e0d55e08b86f', 'nevera', 'tipo_nevera.png'),
('4c919b77-5aa0-11e8-a54d-e0d55e08b86f', 'despensa', 'tipo_despensa.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` varchar(36) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombre_google` varchar(255) DEFAULT NULL,
  `correo` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha_alta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `nombre_google`, `correo`, `contraseña`, `fecha_alta`) VALUES
('314d827f-5d1b-11e8-8b69-fcaa140c1e64', 'admin', NULL, 'admin@correo.es', '1234', '2018-05-21'),
('fc1e81d6-5aa0-11e8-a54d-e0d55e08b86f', 'gus', NULL, 'gusiluz@gmail.com', '1234', '2018-05-18'),
('fc1ffa47-5aa0-11e8-a54d-e0d55e08b86f', 'miriam', NULL, 'mitxu@gmail.com', '1234', '2018-05-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_temporal`
--

CREATE TABLE `usuarios_temporal` (
  `id` varchar(36) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `fecha_reg_temp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alimentos_pre`
--
ALTER TABLE `alimentos_pre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_alipre_usuario` (`id_usuario`);

--
-- Indices de la tabla `alimentos_users`
--
ALTER TABLE `alimentos_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_alimento_usuario` (`id_usuario`),
  ADD KEY `FK_alimento_tipo` (`id_tipo`),
  ADD KEY `FK_alimento_cat` (`id_categoria`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CategoriaUsuario` (`id_usuario`);

--
-- Indices de la tabla `login_google`
--
ALTER TABLE `login_google`
  ADD PRIMARY KEY (`google_id`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `usuarios_temporal`
--
ALTER TABLE `usuarios_temporal`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alimentos_pre`
--
ALTER TABLE `alimentos_pre`
  ADD CONSTRAINT `FK_alipre_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `alimentos_users`
--
ALTER TABLE `alimentos_users`
  ADD CONSTRAINT `FK_alimento_cat` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `FK_alimento_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`id`),
  ADD CONSTRAINT `FK_alimento_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `FK_CategoriaUsuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
