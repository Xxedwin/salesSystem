-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2018 a las 03:18:46
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
-- Estructura de tabla para la tabla `cost`
--

CREATE TABLE `cost` (
  `id` int(11) NOT NULL,
  `harina` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `manteca` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `azucar` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `sal` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `levadura` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `pollo` varchar(50) DEFAULT NULL,
  `hot dog` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `queso` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `carne molida` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `mayonesa` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `cebolla` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `arveja moron` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `rocoto perejil` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `aceite` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `leche fresca` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `bicarbonato` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `escencia de vainilla` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `esencia de paneton` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `expense_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cost_product`
--

CREATE TABLE `cost_product` (
  `id` int(11) UNSIGNED NOT NULL,
  `expense_id` int(11) NOT NULL,
  `cost_unit` varchar(50) NOT NULL,
  `quantity` varchar(50) CHARACTER SET utf8 NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cost_product`
--

INSERT INTO `cost_product` (`id`, `expense_id`, `cost_unit`, `quantity`, `categorie_id`, `media_id`) VALUES
(10, 14, '0.10', '40', 8, 4),
(11, 15, '0.43', '12', 8, 3);

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
(7, 'Unit'),
(8, 'sobre');

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
(2, 'bolsa.png', 'image/png'),
(3, 'pay_manzana.jpg', 'image/jpeg'),
(4, 'pastel_chocolate.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentations`
--

CREATE TABLE `presentations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `presentations`
--

INSERT INTO `presentations` (`id`, `name`) VALUES
(1, 'Caja'),
(2, 'saco'),
(3, 'bolsa'),
(4, 'balde'),
(5, 'paquete'),
(6, 'lata'),
(7, 'sobre'),
(8, 'botella'),
(9, 'tarro'),
(10, 'envase');

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
  `distributor_id` int(11) UNSIGNED NOT NULL,
  `presentation_id` int(11) UNSIGNED NOT NULL,
  `measure_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `processed_products`
--

INSERT INTO `processed_products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`, `mark`, `unit`, `distributor_id`, `presentation_id`, `measure_id`) VALUES
(1, 'waa', '27', '10.00', '100.00', 1, 0, '2018-05-19 12:13:52', '', 'w', 0, 1, 1),
(3, 'w', '1', '1.00', '1.00', 3, 0, '2018-05-19 17:11:24', NULL, 'w', 0, 0, 0),
(4, 'q', '1', '1.00', '1.00', 2, 0, '2018-05-19 17:12:38', NULL, 'q', 0, 0, 0),
(6, 'redondo', '1', '6.00', '12.00', 4, 0, '2018-05-19 17:20:42', NULL, 'molde', 0, 0, 0),
(7, 'TORTA CHOCOLATE', NULL, NULL, '0.00', 3, 3, '0000-00-00 00:00:00', NULL, NULL, 0, 0, 0),
(8, 'ss', NULL, NULL, '0.00', 3, 3, '0000-00-00 00:00:00', NULL, NULL, 0, 0, 0),
(9, 'ddd', NULL, NULL, '0.00', 2, 3, '0000-00-00 00:00:00', NULL, NULL, 0, 0, 0),
(10, 'AA', NULL, NULL, '0.00', 2, 2, '0000-00-00 00:00:00', NULL, NULL, 0, 0, 0),
(11, 'eee', NULL, NULL, '0.00', 2, 2, '0000-00-00 00:00:00', NULL, NULL, 0, 0, 0),
(12, 'qqq', NULL, NULL, '0.00', 2, 2, '0000-00-00 00:00:00', NULL, NULL, 0, 0, 0),
(13, 'PAY DE MANZANA', NULL, NULL, '0.00', 8, 3, '0000-00-00 00:00:00', NULL, NULL, 0, 0, 0),
(14, 'PASTEL DE CHOCOLATE', NULL, NULL, '0.00', 8, 4, '0000-00-00 00:00:00', NULL, NULL, 0, 0, 0),
(15, 'PAY DE MANZANA', NULL, NULL, '0.00', 8, 3, '0000-00-00 00:00:00', NULL, NULL, 0, 0, 0);

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
  `distributor_id` int(11) UNSIGNED NOT NULL,
  `measure_id` int(11) UNSIGNED NOT NULL,
  `presentation_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `production_expenses`
--

INSERT INTO `production_expenses` (`id`, `name`, `quantity`, `buy_price`, `categorie_id`, `media_id`, `date`, `mark`, `unit`, `distributor_id`, `measure_id`, `presentation_id`) VALUES
(5, 'azucar', '6', '112.00', 7, 0, '2018-05-26 17:36:33', '', '50', 3, 1, 0),
(6, 'sal', '1', '1.00', 7, 0, '2018-05-26 17:36:59', '', '1', 3, 1, 0),
(7, 'Harina', '5', '87.00', 7, 0, '2018-05-26 18:32:36', '', '50', 3, 1, 0),
(8, 'Levadura', '1', '7.00', 7, 0, '2018-05-26 18:39:59', '', '0.48', 3, 5, 0),
(9, 'Manteca', '1', '55.00', 7, 0, '2018-05-26 18:57:25', '', '10', 3, 1, 0),
(11, 'Antimoho', '1', '15.00', 7, 0, '2018-05-26 18:59:37', '', '1', 3, 1, 0),
(12, 'Colorante', '1', '8.00', 7, 0, '2018-05-26 19:00:29', '', '0.37', 3, 4, 0),
(13, 'Es. De paneton', '1', '15.00', 7, 0, '2018-05-26 19:01:06', '', '0.25', 3, 6, 0),
(14, 'Fruta Confitada', '1', '70.00', 7, 0, '2018-05-26 19:01:34', '', '10', 3, 1, 0),
(15, 'Leche ', '10', '4.50', 7, 0, '2018-05-26 19:03:11', '', '1000', 3, 3, 0),
(16, 'Manzana', '1', '4.00', 7, 0, '2018-05-30 00:20:06', '', '1', 3, 1, 0),
(17, 'Crema pastelera', '1', '30.00', 7, 0, '2018-05-30 00:22:21', '', '4', 3, 1, 0),
(18, 'Aconcagua', '1', '5.50', 7, 0, '2018-05-30 00:24:26', '', '1', 3, 7, 0),
(19, 'Azucar impalpable', '1', '6.00', 7, 0, '2018-05-30 00:26:47', '', '1', 3, 1, 0),
(20, 'Huevos', '1', '12.00', 7, 0, '2018-05-30 00:29:39', '', '30', 3, 7, 0),
(21, 'aceite', '18', '90.56', 7, 0, '2018-05-31 17:19:40', '', '18', 3, 3, 0),
(22, 'Leche fresca', '1', '2.50', 7, 0, '2018-05-31 17:22:58', '', '1', 3, 3, 0),
(23, 'bicarbonato', '1', '4.00', 7, 0, '2018-05-31 17:23:54', '', '1', 3, 3, 0),
(24, 'escencia de vainilla', '1', '6.00', 7, 0, '2018-05-31 17:24:42', '', '1', 3, 3, 0),
(25, 'Escencia de Paneton', '1', '10.00', 7, 0, '2018-05-31 17:25:19', '', '0.25', 3, 3, 0),
(26, 'manjar-decoracion', '19', '87.00', 7, 0, '2018-05-31 17:26:21', '', '19', 3, 3, 0),
(27, 'cocoa', '1', '6.50', 7, 0, '2018-05-31 17:27:32', '', '1', 3, 8, 0),
(28, 'Canela Molida', '1', '50.00', 7, 0, '2018-05-31 17:28:01', '', '1', 3, 1, 0),
(30, 'prueba', '1', '1.00', 3, 3, '2018-06-01 17:21:17', 'e', 'e', 3, 3, 3);

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
  `distributor_id` int(11) UNSIGNED NOT NULL,
  `presentation_id` int(11) UNSIGNED NOT NULL,
  `measure_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`, `mark`, `unit`, `distributor_id`, `presentation_id`, `measure_id`) VALUES
(21, 'qq', '42', '100.00', '12.00', 2, 0, '2018-05-23 17:00:19', 'q', 'q', 2, 2, 1),
(22, 'gaseosa oro', '10', '60.00', '10.00', 3, 0, '2018-05-23 17:04:11', 'oro', '1 L', 2, 0, 0),
(23, 'w', '1', '1.00', '11.00', 3, 3, '2018-06-01 17:49:04', 'w', 'w', 3, 7, 0),
(24, 'e', '1', '1.00', '1.00', 3, 2, '2018-06-01 19:25:46', 'e', 'e', 3, 1, 1);

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
(1, 'Admin Users', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'pzg9wa7o1.jpg', 1, '2018-06-01 16:55:51'),
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
-- Indices de la tabla `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cost_product`
--
ALTER TABLE `cost_product`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `presentations`
--
ALTER TABLE `presentations`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `cost`
--
ALTER TABLE `cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cost_product`
--
ALTER TABLE `cost_product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `measures`
--
ALTER TABLE `measures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `presentations`
--
ALTER TABLE `presentations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `processed_products`
--
ALTER TABLE `processed_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `production_expenses`
--
ALTER TABLE `production_expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
