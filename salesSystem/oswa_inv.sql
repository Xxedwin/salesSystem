-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-05-2018 a las 07:44:32
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `oswa_inv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'Abarrotes'),
(3, 'gaseosas'),
(7, 'Materias Directos'),
(5, 'paneton'),
(8, 'Pasteles'),
(4, 'QUEQUE'),
(1, 'Repuestos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distributors`
--

CREATE TABLE `distributors` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `distributors`
--

INSERT INTO `distributors` (`id`, `name`) VALUES
(2, 'Ssa'),
(3, 'Roset Distribuciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `measures`
--

CREATE TABLE `measures` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `measures`
--

INSERT INTO `measures` (`id`, `name`) VALUES
(1, 'kl'),
(3, 'lt'),
(4, 'gr'),
(5, 'paquete'),
(6, 'ml'),
(7, 'Unit');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(1, 'filter.jpg', 'image/jpeg'),
(2, 'bolsa.png', 'image/png'),
(3, 'pay_manzana.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `processed_products`
--

CREATE TABLE `processed_products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `quantity` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL,
  `mark` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `unit` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `presentation` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `distributor_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `processed_products`
--

INSERT INTO `processed_products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`, `mark`, `unit`, `presentation`, `distributor_id`) VALUES
(1, 'waa', '27', '10.00', '100.00', 1, 0, '2018-05-19 12:13:52', 'w', 'w', 'w', 2),
(3, 'w', '1', '1.00', '1.00', 3, 0, '2018-05-19 17:11:24', NULL, 'w', 'w', 0),
(4, 'q', '1', '1.00', '1.00', 2, 0, '2018-05-19 17:12:38', NULL, 'q', 'q', 0),
(6, 'redondo', '1', '6.00', '12.00', 4, 0, '2018-05-19 17:20:42', NULL, 'molde', 'grande', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `production_expenses`
--

CREATE TABLE `production_expenses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `quantity` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL,
  `mark` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `unit` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `presentation` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `distributor_id` int(11) UNSIGNED NOT NULL,
  `measure_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `production_expenses`
--

INSERT INTO `production_expenses` (`id`, `name`, `quantity`, `buy_price`, `categorie_id`, `media_id`, `date`, `mark`, `unit`, `presentation`, `distributor_id`, `measure_id`) VALUES
(5, 'azucar', '1', '142.00', 7, 0, '2018-05-26 17:36:33', '', '50', 'saco', 3, 1),
(6, 'sal', '1', '1.00', 7, 0, '2018-05-26 17:36:59', '', '1', 'paquete', 3, 1),
(7, 'Harina', '5', '87.00', 7, 0, '2018-05-26 18:32:36', '', '50', 'saco', 3, 1),
(8, 'Levadura', '1', '7.00', 7, 0, '2018-05-26 18:39:59', '', '0.48', 'paquete', 3, 5),
(9, 'Manteca', '1', '55.00', 7, 0, '2018-05-26 18:57:25', '', '10', 'Caja', 3, 1),
(10, 'Mejorador', '1', '35.00', 7, 0, '2018-05-26 18:57:59', '', '5', 'bolsa', 3, 1),
(11, 'Antimoho', '1', '15.00', 7, 0, '2018-05-26 18:59:37', '', '1', 'bolsa', 3, 1),
(12, 'Colorante', '1', '8.00', 7, 0, '2018-05-26 19:00:29', '', '0.37', 'Frasco', 3, 4),
(13, 'Es. De paneton', '1', '15.00', 7, 0, '2018-05-26 19:01:06', '', '0.25', 'Frasco', 3, 6),
(14, 'Fruta Confitada', '1', '70.00', 7, 0, '2018-05-26 19:01:34', '', '10', 'Caja ', 3, 1),
(15, 'Leche ', '10', '4.50', 7, 0, '2018-05-26 19:03:11', '', '1000', 'Caja ', 3, 3),
(16, 'Manzana', '1', '4.00', 7, 0, '2018-05-30 00:20:06', '', '1', '', 3, 1),
(17, 'Crema pastelera', '1', '30.00', 7, 0, '2018-05-30 00:22:21', '', '4', '', 3, 1),
(18, 'Aconcagua', '1', '5.50', 7, 0, '2018-05-30 00:24:26', '', '1', '', 3, 7),
(19, 'Azucar impalpable', '1', '6.00', 7, 0, '2018-05-30 00:26:47', '', '1', '', 3, 1),
(20, 'Huevos', '1', '12.00', 7, 0, '2018-05-30 00:29:39', '', '30', '', 3, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL,
  `mark` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `presentation` varchar(255) DEFAULT NULL,
  `distributor_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`, `mark`, `unit`, `presentation`, `distributor_id`) VALUES
(21, 'qq', '32', '100.00', '12.00', 2, 0, '2018-05-23 17:00:19', 'q', 'q', 'qq', 2),
(22, 'gaseosa oro', '10', '60.00', '10.00', 3, 0, '2018-05-23 17:04:11', 'oro', '1 L', 'grande', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Admin Users', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'pzg9wa7o1.jpg', 1, '2018-05-29 21:42:00'),
(2, 'Special User', 'special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'no_image.jpg', 1, '2017-06-16 07:11:26'),
(3, 'Default User', 'user', '12dea96fec20593566ab75692c9949596833adc9', 3, 'no_image.jpg', 1, '2017-06-16 07:11:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'Special', 2, 0),
(3, 'User', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `measures`
--
ALTER TABLE `measures`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `processed_products`
--
ALTER TABLE `processed_products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `production_expenses`
--
ALTER TABLE `production_expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`),
  ADD KEY `distributor_id` (`distributor_id`) USING BTREE;

--
-- Indices de la tabla `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_level` (`user_level`);

--
-- Indices de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `measures`
--
ALTER TABLE `measures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `processed_products`
--
ALTER TABLE `processed_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `production_expenses`
--
ALTER TABLE `production_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
