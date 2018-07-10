-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-07-2018 a las 00:53:49
-- Versión del servidor: 5.6.14
-- Versión de PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `vasuld_inv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'Abarrotes'),
(3, 'Gaseosas'),
(7, 'Materias Directos'),
(5, 'paneton'),
(8, 'Pasteles'),
(4, 'QUEQUE'),
(1, 'Repuestos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cost`
--

CREATE TABLE IF NOT EXISTS `cost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `expense_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cost_product`
--

CREATE TABLE IF NOT EXISTS `cost_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) NOT NULL,
  `cost_unit` varchar(50) NOT NULL,
  `quantity` varchar(50) CHARACTER SET utf8 NOT NULL,
  `categorie_id` int(11) unsigned NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `cost_product`
--

INSERT INTO `cost_product` (`id`, `expense_id`, `cost_unit`, `quantity`, `categorie_id`, `media_id`) VALUES
(10, 14, '0.10', '40', 8, 4),
(11, 15, '0.43', '12', 8, 3),
(12, 0, '4.60', '1', 3, 3),
(14, 0, '3.86', '1', 0, NULL),
(15, 0, '3.86', '1', 0, NULL),
(16, 0, '3.86', '1', 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distributors`
--

CREATE TABLE IF NOT EXISTS `distributors` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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

CREATE TABLE IF NOT EXISTS `measures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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
(8, 'sobre'),
(9, 'tajada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `presentations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

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

CREATE TABLE IF NOT EXISTS `processed_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `quantity` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) unsigned NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL,
  `mark` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `unit` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `distributor_id` int(11) unsigned NOT NULL,
  `presentation_id` int(11) unsigned NOT NULL,
  `measure_id` int(11) unsigned NOT NULL,
  `cost_unit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `productTotalUnit` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `processed_products`
--

INSERT INTO `processed_products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`, `mark`, `unit`, `distributor_id`, `presentation_id`, `measure_id`, `cost_unit`, `productTotalUnit`) VALUES
(17, 'ww', '10', NULL, '15.00', 2, 3, '0000-00-00 00:00:00', NULL, '1', 0, 0, 3, '14', NULL),
(18, 'ee', NULL, NULL, '0.00', 2, 2, '0000-00-00 00:00:00', NULL, '400ml', 0, 1, 1, '15', NULL),
(20, 'p', NULL, NULL, '0.00', 2, 2, '2018-06-13 15:47:04', NULL, '1', 0, 1, 1, '5.10', '1'),
(22, 'PAY DE MANZANA', '7', NULL, '2.50', 8, 3, '2018-06-13 22:53:39', NULL, '1', 0, 0, 7, '0.64', '12'),
(23, 'PASTEL DE CHOCOLATE', '2', NULL, '2.00', 8, 4, '2018-06-13 22:56:30', NULL, '1', 0, 0, 9, '0.65', '40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `production_expenses`
--

CREATE TABLE IF NOT EXISTS `production_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `quantity` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `categorie_id` int(11) unsigned NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL,
  `mark` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `unit` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `distributor_id` int(11) unsigned NOT NULL,
  `measure_id` int(11) unsigned NOT NULL,
  `presentation_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

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
(26, 'manjar-decoracion', '19', '87.00', 7, 0, '2018-05-31 17:26:21', '', '19', 3, 1, 1),
(27, 'cocoa', '1', '6.50', 7, 0, '2018-05-31 17:27:32', '', '1', 3, 8, 0),
(28, 'Canela Molida', '1', '50.00', 7, 0, '2018-05-31 17:28:01', '', '1', 3, 1, 0),
(30, 'prueba', '1', '1.00', 3, 3, '2018-06-01 17:21:17', 'e', 'e', 3, 3, 3),
(31, 'a', '1', '10.00', 2, 0, '2018-07-10 00:52:03', '', '1', 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) unsigned NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL,
  `mark` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `distributor_id` int(11) unsigned NOT NULL,
  `presentation_id` int(11) unsigned NOT NULL,
  `measure_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `categorie_id` (`categorie_id`),
  KEY `media_id` (`media_id`),
  KEY `distributor_id` (`distributor_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`, `mark`, `unit`, `distributor_id`, `presentation_id`, `measure_id`) VALUES
(21, 'qqq', '42', '100.00', '12.00', 2, 0, '2018-05-23 17:00:19', 'qq', 'q', 2, 2, 1),
(22, 'gaseosa oro', '10', '60.00', '10.00', 3, 0, '2018-05-23 17:04:11', 'oro', '1 L', 2, 0, 0),
(23, 'w', '1', '1.00', '11.00', 3, 3, '2018-06-01 17:49:04', 'w', 'w', 3, 7, 0),
(24, 'e', '1', '1.00', '1.00', 3, 2, '2018-06-01 19:25:46', 'e', 'e', 3, 1, 1),
(25, 'a', '1', '10.00', '15.00', 2, 0, '2018-07-09 23:43:15', '', 'a', 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `user_level` (`user_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Admin Users', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'pzg9wa7o1.jpg', 1, '2018-07-09 22:32:16'),
(2, 'Special User', 'special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'no_image.jpg', 1, '2017-06-16 07:11:26'),
(3, 'Default User', 'user', '12dea96fec20593566ab75692c9949596833adc9', 3, 'no_image.jpg', 1, '2017-06-16 07:11:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_level` (`group_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'Special', 2, 0),
(3, 'User', 3, 1);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
