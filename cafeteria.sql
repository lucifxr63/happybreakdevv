-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-09-2024 a las 22:06:40
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
-- Base de datos: `cafeteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `atencion_cliente`
--

CREATE TABLE `atencion_cliente` (
  `ID_Atencion` int(11) NOT NULL,
  `Tipo_Problemas` varchar(255) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Descripcion` text NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `ID_Cliente` int(11) NOT NULL,
  `Problema` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `ID_Caja` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `Historial_Ventas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carro_de_compra`
--

CREATE TABLE `carro_de_compra` (
  `ID_carrito` int(11) NOT NULL,
  `Productos` text NOT NULL,
  `ID_Pedido` int(11) DEFAULT NULL,
  `Total_A_Pagar` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_Cliente` int(11) NOT NULL,
  `Rol_ID` int(11) NOT NULL,
  `Historial_de_compra` text DEFAULT NULL,
  `Calificacion` int(11) DEFAULT NULL,
  `Favoritos` text DEFAULT NULL,
  `ID_carrito` int(11) DEFAULT NULL,
  `ID_Pedido` int(11) DEFAULT NULL,
  `Fecha_nacimiento` date DEFAULT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_Cliente`, `Rol_ID`, `Historial_de_compra`, `Calificacion`, `Favoritos`, `ID_carrito`, `ID_Pedido`, `Fecha_nacimiento`, `Nombre`, `Telefono`, `Estado`) VALUES
(1, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Luciano Abarca Soto', NULL, NULL),
(2, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Vicente Poblete ', NULL, NULL),
(3, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Vicente Poblete aaa', NULL, NULL),
(4, 0, NULL, NULL, NULL, NULL, NULL, NULL, ' a a a a aB', NULL, NULL),
(5, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'bbbb', NULL, NULL),
(6, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'cccc', NULL, NULL),
(7, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Mantenedor', NULL, NULL),
(8, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Persona11', NULL, NULL),
(9, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Persona2', NULL, NULL),
(10, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'persona3', NULL, NULL),
(11, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Persona4', NULL, NULL),
(12, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'aaa', NULL, NULL),
(13, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Nicolas lopez', NULL, NULL),
(14, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'Gabriel Suazo', NULL, NULL),
(15, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'TEST3', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cocina`
--

CREATE TABLE `cocina` (
  `ID_Cocina` int(11) NOT NULL,
  `ID_Usuario` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `Historial_Cocina` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenedor`
--

CREATE TABLE `mantenedor` (
  `ID_Mantenedor` int(11) NOT NULL,
  `ID_Productos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `ID_Oferta` int(11) NOT NULL,
  `Productos` text NOT NULL,
  `Precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opiniones`
--

CREATE TABLE `opiniones` (
  `ID_Opinion` int(11) NOT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `Opinion` text DEFAULT NULL,
  `Calificacion` int(1) DEFAULT NULL,
  `Fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `opiniones`
--

INSERT INTO `opiniones` (`ID_Opinion`, `ID_Usuario`, `Opinion`, `Calificacion`, `Fecha`) VALUES
(1, 12, 'aaaaaaaaaaaaa', 2, '2024-08-26'),
(2, 12, 'aaaaaaaaaa', 3, '2024-08-26'),
(3, 7, '123', 3, '2024-09-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `ID_Pedido` int(11) NOT NULL,
  `productos` text NOT NULL,
  `Fecha_ingreso` date NOT NULL,
  `Fecha_vencimiento` date DEFAULT NULL,
  `Estado_pedido` varchar(50) NOT NULL,
  `Fecha_Listo_Aprox` date DEFAULT NULL,
  `Fecha_Completado` date DEFAULT NULL,
  `Usuario_realizador` int(11) NOT NULL,
  `Descripcion_Pedido` text DEFAULT NULL,
  `Prioridad` varchar(50) DEFAULT NULL,
  `Tipo_Pago` varchar(50) DEFAULT NULL,
  `Tipo_Pedido` varchar(50) DEFAULT NULL,
  `Validador` varchar(255) DEFAULT NULL,
  `Post_Indicaciones` text DEFAULT NULL,
  `Total_A_Pagar` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`ID_Pedido`, `productos`, `Fecha_ingreso`, `Fecha_vencimiento`, `Estado_pedido`, `Fecha_Listo_Aprox`, `Fecha_Completado`, `Usuario_realizador`, `Descripcion_Pedido`, `Prioridad`, `Tipo_Pago`, `Tipo_Pedido`, `Validador`, `Post_Indicaciones`, `Total_A_Pagar`) VALUES
(10, '[{\"id\":null,\"name\":\"Cafe blanco\",\"price\":1000,\"quantity\":1}]', '2024-06-23', NULL, 'pendiente', NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 1000.00),
(11, '[{\"id\":null,\"name\":\"Cafe blanco\",\"price\":1000,\"quantity\":1}]', '2024-06-23', NULL, 'pendiente', NULL, NULL, 7, NULL, NULL, NULL, NULL, NULL, NULL, 1000.00),
(13, '[{\"id\":null,\"name\":\"Caf\\u00e9 Americano\",\"price\":3790,\"quantity\":1}]', '2024-06-23', NULL, 'pendiente', NULL, NULL, 13, NULL, NULL, NULL, NULL, NULL, NULL, 3790.00),
(14, '[{\"id\":null,\"name\":\"Caf\\u00e9 Americano\",\"price\":3790,\"quantity\":1}]', '2024-06-23', NULL, 'pendiente', NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 3790.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `problema_cocina`
--

CREATE TABLE `problema_cocina` (
  `ID_problema` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Descripcion` text NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Estado` varchar(50) NOT NULL,
  `Respuesta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_Productos` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Categoria` varchar(50) NOT NULL,
  `Fecha_de_compra` date DEFAULT NULL,
  `Fecha_de_EX` date DEFAULT NULL,
  `Stock` int(11) DEFAULT NULL,
  `Imagen` varchar(255) DEFAULT NULL,
  `Proveedor` varchar(100) DEFAULT NULL,
  `Pais_origen` varchar(50) DEFAULT NULL,
  `Lactosa` tinyint(1) DEFAULT NULL,
  `Gluten` tinyint(1) DEFAULT NULL,
  `Descripcion_Producto` text DEFAULT NULL,
  `Contador` int(11) DEFAULT NULL,
  `Comentarios` text DEFAULT NULL,
  `Calificacion` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_Productos`, `Nombre`, `Precio`, `Categoria`, `Fecha_de_compra`, `Fecha_de_EX`, `Stock`, `Imagen`, `Proveedor`, `Pais_origen`, `Lactosa`, `Gluten`, `Descripcion_Producto`, `Contador`, `Comentarios`, `Calificacion`) VALUES
(2, 'Cafe blanco', 2300.00, 'Café', '2025-10-10', '2026-10-10', 1000, 'https://i.postimg.cc/5tRSDC8H/DALL-E-2024-06-23-01-35-19-A-cup-of-white-coffee-served-in-a-white-ceramic-mug-on-a-wooden-table.webp', 'Juan Valdez', 'Colombia', 0, 0, 'Cafe exportado', 0, '', 0),
(3, 'Café Americano', 3790.00, 'Café', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/GmbKDrcp/DALL-E-2024-06-23-01-36-29-A-cup-of-Americano-coffee-served-in-a-white-ceramic-mug-on-a-wooden-tab.webp', 'Proveedor X', 'País X', 0, 0, 'Extracción de lo más tradicional en café al estilo americano. Arábico, bio orgánico, descafeinado o robusta.', 0, '', 0),
(4, 'Capuccino', 5090.00, 'Café', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/rs6Cw2nM/DALL-E-2024-06-23-01-38-09-A-cup-of-cappuccino-served-in-a-white-ceramic-mug-on-a-wooden-table-Th.webp', 'Proveedor X', 'País X', 1, 0, 'Espresso con espuma de leche y polvo de chocolate. Simple o doble, arábico, bio orgánico, descafeinado o robusta.', 0, '', 0),
(5, 'Café Cortado', 4090.00, 'Café', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/tRPNm7JT/DALL-E-2024-06-23-01-39-04-A-cup-of-cortado-coffee-served-in-a-clear-glass-on-a-wooden-table-The.webp', 'Proveedor X', 'País X', 1, 0, 'Extracción de lo mas tradicional en café con leche a elección y un toque de espuma. Simple o doble y arábico.', 0, '', 0),
(6, 'Café Latte', 5090.00, 'Café', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/qq8ctDSn/DALL-E-2024-06-23-01-38-36-A-cup-of-latte-coffee-served-in-a-tall-glass-on-a-wooden-table-The-lat.webp', 'Proveedor X', 'País X', 1, 0, 'Espresso con leche texturizada. Arábico, bio orgánico, descafeinado o robusta y leche a elección.', 0, '', 0),
(7, 'Galletas Surtidas', 5090.00, 'Repostería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/RZq3ybdR/galletas.webp', 'Proveedor Y', 'País Y', 1, 0, 'Deliciosas galletas elaboradas con receta artesanal Tavelli.', 0, '', 0),
(8, 'Brownie de Chocolate', 4290.00, 'Repostería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/fy2zvDGh/brownie.webp', 'Proveedor Y', 'País Y', 1, 0, 'Exquisito bizcocho de chocolates con nueces, bañado en chocolate.', 0, '', 0),
(9, 'Factura Media Luna', 2090.00, 'Repostería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/44BxGQmF/croasam.webp', 'Proveedor Y', 'País Y', 1, 0, 'Masa dulce de textura hojaldrada.', 0, '', 0),
(10, 'Muffin de Chocolate', 4190.00, 'Repostería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/rw6X2DCP/DALL-E-2024-06-23-01-50-12-A-chocolate-muffin-on-a-tray-topped-with-chocolate-chips.webp', 'Proveedor Y', 'País Y', 1, 0, 'Bizcocho de chocolate, relleno de chocolate con chips de chocolate.', 0, '', 0),
(11, 'Muffin de Nutella', 4190.00, 'Repostería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/BnxWSJmQ/DALL-E-2024-06-23-01-50-56-A-Nutella-muffin-with-a-layer-of-Nutella-on-top-and-a-bit-of-crushed-ha.webp', 'Proveedor Y', 'País Y', 1, 0, 'Bizcocho de vainilla relleno con nutella, con chips de chocolate belga.', 0, '', 0),
(12, 'Palmera', 4490.00, 'Repostería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/q70PgWFc/DALL-E-2024-06-23-01-51-14-A-palmier-a-type-of-sweet-pastry-on-a-plate-with-a-golden-and-crispy.webp', 'Proveedor Y', 'País Y', 1, 0, 'Masa dulce hojaldrada, cubierta con azúcar y sus puntas bañadas con chocolate.', 0, '', 0),
(13, 'Variedad breztel', 4390.00, 'Repostería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/TP9ZbC8z/DALL-E-2024-06-23-01-51-39-A-variety-of-pretzels-on-a-plate-some-salty-and-others-with-chocolate.webp', 'Proveedor Y', 'País Y', 1, 0, 'Masa de hoja danesa rellena con crema pastelera.', 0, '', 0),
(14, 'Té', 2500.00, 'Tetería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/WbmLj2Wp/DALL-E-2024-06-23-02-12-39-A-cup-of-hot-tea-with-steam-served-in-a-white-ceramic-cup-on-a-wooden.webp', 'Proveedor Z', 'País Z', 0, 0, 'Té', 0, '', 0),
(15, 'Té Baúl', 2500.00, 'Tetería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/kgw06TPk/DALL-E-2024-06-23-02-13-12-An-open-tea-chest-showing-various-tea-bags-of-different-flavors.webp', 'Proveedor Z', 'País Z', 0, 0, 'Té Baúl', 0, '', 0),
(16, 'Té pakistaní', 2500.00, 'Tetería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/wBGnF3v2/DALL-E-2024-06-23-02-13-45-A-cup-of-Pakistani-tea-chai-with-milk-with-spices-like-cinnamon-and.webp', 'Proveedor Z', 'País Z', 0, 0, 'Té pakistaní', 0, '', 0),
(17, 'Té sabor de la semana', 2500.00, 'Tetería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/J0wvVgjB/DALL-E-2024-06-23-02-14-29-A-cup-of-tea-with-a-sign-that-says-Flavor-of-the-Week-with-fruits-an.webp', 'Proveedor Z', 'País Z', 0, 0, 'Té sabor de la semana', 0, '', 0),
(18, 'Té sol de invierno', 2500.00, 'Tetería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/WzMK2n7Y/DALL-E-2024-06-23-02-14-53-A-cup-of-tea-with-a-slice-of-orange-and-a-cinnamon-stick-served-on-a-t.webp', 'Proveedor Z', 'País Z', 0, 0, 'Té sol de invierno', 0, '', 0),
(19, 'Té verde acaramelado', 2500.00, 'Tetería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/9XTstmjP/DALL-E-2024-06-23-02-15-21-A-cup-of-green-tea-with-a-hint-of-caramel-with-caramel-candies-on-the.webp', 'Proveedor Z', 'País Z', 0, 0, 'Té verde acaramelado', 0, '', 0),
(20, 'Té verde moruno', 2500.00, 'Tetería', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/9XTstmjP/DALL-E-2024-06-23-02-15-21-A-cup-of-green-tea-with-a-hint-of-caramel-with-caramel-candies-on-the.webp', 'Proveedor Z', 'País Z', 0, 0, 'Té verde moruno', 0, '', 0),
(21, 'Alfajor', 1500.00, 'Dulces', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/T32S6n5Q/DALL-E-2024-06-23-02-17-01-A-traditional-alfajor-with-layers-of-cookie-filled-with-dulce-de-leche.webp', 'Proveedor Z', 'País Z', 1, 0, 'Alfajor', 0, '', 0),
(22, 'Brownie', 2000.00, 'Dulces', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/fy2zvDGh/brownie.webp', 'Proveedor Z', 'País Z', 1, 0, 'Brownie', 0, '', 0),
(23, 'Galletón', 800.00, 'Dulces', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/85vXHHxk/DALL-E-2024-06-23-02-18-04-A-large-cookie-with-chocolate-chips-served-on-a-plate.webp', 'Proveedor Z', 'País Z', 1, 0, 'Galletón', 0, '', 0),
(24, 'Kuchen', 2500.00, 'Dulces', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/brjCFnjx/DALL-E-2024-06-23-02-18-33-A-kuchen-a-typical-cake-with-fresh-fruits-and-custard-served-on-a-pla.webp', 'Proveedor Z', 'País Z', 1, 0, 'Kuchen', 0, '', 0),
(25, 'Pie', 2500.00, 'Dulces', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/3NCSMwKP/DALL-E-2024-06-23-02-18-53-A-pie-with-a-crispy-base-and-fruit-filling-like-apple-or-lemon-topped.webp', 'Proveedor Z', 'País Z', 1, 0, 'Pie', 0, '', 0),
(26, 'Queque del día (trozo)', 1500.00, 'Dulces', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/WpMfq5MX/DALL-E-2024-06-23-02-19-07-A-slice-of-the-cake-of-the-day-served-on-a-plate-It-could-be-flavors.webp', 'Proveedor Z', 'País Z', 1, 0, 'Queque del día (trozo)', 0, '', 0),
(27, 'Tartaleta', 2500.00, 'Dulces', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/sDsHY5my/DALL-E-2024-06-23-02-19-30-A-tartlet-with-fresh-fruits-like-strawberries-kiwis-and-blueberries.webp', 'Proveedor Z', 'País Z', 1, 0, 'Tartaleta', 0, '', 0),
(28, 'Torta', 2500.00, 'Dulces', '2024-06-20', '2025-06-20', 50, 'https://i.postimg.cc/RVdsXqpt/DALL-E-2024-06-23-02-19-48-A-slice-of-cake-it-could-be-chocolate-vanilla-or-another-specialty-d.webp', 'Proveedor Z', 'País Z', 1, 0, 'Torta', 0, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo_compra`
--

CREATE TABLE `recibo_compra` (
  `ID_Caja` int(11) NOT NULL,
  `ID_Pedido` int(11) NOT NULL,
  `Direccion` varchar(255) NOT NULL,
  `Telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_Usuarios` int(11) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Contrasena` varchar(255) NOT NULL,
  `Rol_ID` int(11) NOT NULL,
  `Rol` varchar(50) NOT NULL,
  `Nombre_corto` varchar(50) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Foto_perfil` varchar(255) DEFAULT NULL,
  `Fecha_nacimiento` date DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Telefono` varchar(15) DEFAULT NULL,
  `Estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_Usuarios`, `Usuario`, `Contrasena`, `Rol_ID`, `Rol`, `Nombre_corto`, `Correo`, `Foto_perfil`, `Fecha_nacimiento`, `Nombre`, `Telefono`, `Estado`) VALUES
(1, 'lucifxr', '$2y$10$PqIjRGFzDHoA3xlY6Ih2tu6m4DAzLoDZGML6TtW7DyKE3Ww8vzVZi', 0, 'cliente', NULL, 'lucianoalonso2000@gmail.com', NULL, NULL, 'Luciano Abarca Soto', NULL, NULL),
(2, 'Mew Show', '$2y$10$Nx.iQzXE4CDgLUTlgQvzmunL2G2xD25BpGjgMdcs/mKAam97oXt6a', 0, 'cliente', NULL, 'correo@falso.cl', NULL, NULL, 'Vicente Poblete ', NULL, NULL),
(3, 'aaa', '$2y$10$z0SrN004ozk1XDyTY6A9AOpfrlA0P2XUjAelhpJMPLMroUI0vMMYS', 0, 'cliente', NULL, 'correaaaa@falso.cl', NULL, NULL, 'Vicente Poblete aaa', NULL, NULL),
(4, 'cccc', '$2y$10$pyhGL2h42Hr7o8EGlH0ZmuIEdHtd15FuPvl9QAB1ZiOJK2iHmtM76', 0, 'cliente', NULL, 'ASFFDA@GMAIL.COM', NULL, NULL, ' a a a a aB', NULL, NULL),
(5, 'bbbb', '$2y$10$xsxjy5xHXlgsy3yQm92j2OtE1CKQ4RyfuL4bzPkUHbtCVCSalzI6q', 0, 'cliente', NULL, 'bbbb@gmail.com', NULL, NULL, 'bbbb', NULL, NULL),
(6, 'cccc', '$2y$10$UjmODnASB8erExd081pK9.Dn3NZoQOa5YRCMB3bSPUGa5E72.QkHW', 0, 'cliente', NULL, 'cccc@gmail.com', NULL, NULL, 'cccc', NULL, NULL),
(7, 'Mantenedor', '$2y$10$FM5Vs87Ntck8QLkDWM4FF.8Gy.ASfdy/kpfCMO2vs.Gn3Ddd0.6li', 3, 'Mantenedor', NULL, 'Mantenedor@gmail.com', NULL, NULL, 'Mantenedor', NULL, NULL),
(8, 'Peronsa1', '$2y$10$tSU8RSMmr3cmesibk2ZSte2Waeswh4KuaYSTwOzylK2Avad9SzJFe', 3, '', NULL, 'Persona1@gmail.com', NULL, NULL, 'Persona11', NULL, NULL),
(9, 'Peronsa2', '$2y$10$bVJZoxlaMHsneNdEx/PXvOXMogrhPIbVcJkQFBQiLdUNbOGKevR7m', 0, '', NULL, 'Persona2@gmail.com', NULL, NULL, 'Persona2', NULL, NULL),
(10, 'persona3', '$2y$10$3ilvwYAbfRQmXNeGveOuYOUSR5FmFoVKOGpdnNLi4UKNTo5dyivPq', 2, '', NULL, 'persona3@gmail.com', NULL, NULL, 'persona3', NULL, NULL),
(11, 'Persona4', '$2y$10$cGAIpyeEGmZueVjJ9rKfpOVKjIaMvDwpgS10zc.qDJkN7vNvd7il6', 0, '', NULL, 'Persona4@gmail.com', NULL, NULL, 'Persona4', NULL, NULL),
(12, 'aaa', '$2y$10$W9YD06VmW.Iacs4HJHXG/OEJdyDfbE9I9klIBn.aRomO6g.3y/W/q', 0, '', NULL, 'aaa@gmail.com', NULL, NULL, 'aaa', NULL, NULL),
(13, 'NicoLopez', '$2y$10$z7K6WTXWTi3Nf/XOWs1nSuQtFGkfE2gC9uqZqH.gyA701rlTyo5vK', 0, '', NULL, 'Nico.Lopez@gmail.com', NULL, NULL, 'Nicolas lopez', NULL, NULL),
(14, 'Gabo', '$2y$10$Qn9IykiJPfNOPBQZj0KQau1bSb1qO2hIPzCZs2Y8WxZTl8oWMSb0e', 0, '', NULL, 'Gabo123@gmail.com', NULL, NULL, 'Gabriel Suazo', NULL, NULL),
(15, 'TEST3', '$2y$10$TUvfVUdhDECWpcFEBg9RkuKUzMg41c8vc4OLCu5U/Wer9MAd32rfC', 0, '', NULL, 'TEST3@GMAIL.COM', NULL, NULL, 'TEST3', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

CREATE TABLE `valoraciones` (
  `ID_Valoracion` int(11) NOT NULL,
  `ID_Producto` int(11) DEFAULT NULL,
  `ID_Usuario` int(11) DEFAULT NULL,
  `Calificacion` int(1) DEFAULT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`ID_Valoracion`, `ID_Producto`, `ID_Usuario`, `Calificacion`, `Fecha`) VALUES
(1, 2, NULL, 1, '2024-08-30 20:14:16'),
(2, 2, NULL, 1, '2024-08-30 20:14:26'),
(3, 2, NULL, 1, '2024-08-30 20:14:34'),
(4, 2, NULL, 5, '2024-08-30 20:15:01'),
(5, 2, NULL, 5, '2024-08-30 20:15:10'),
(6, 2, NULL, 5, '2024-08-30 20:15:25'),
(7, 2, 12, 1, '2024-08-30 20:16:59');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `atencion_cliente`
--
ALTER TABLE `atencion_cliente`
  ADD PRIMARY KEY (`ID_Atencion`),
  ADD KEY `FK_atencion_cliente` (`ID_Cliente`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`ID_Caja`),
  ADD KEY `FK_caja_pedido` (`ID_Pedido`),
  ADD KEY `FK_caja_usuario` (`ID_Usuario`);

--
-- Indices de la tabla `carro_de_compra`
--
ALTER TABLE `carro_de_compra`
  ADD PRIMARY KEY (`ID_carrito`),
  ADD KEY `FK_carro_pedido` (`ID_Pedido`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_Cliente`),
  ADD KEY `FK_cliente_carrito` (`ID_carrito`),
  ADD KEY `FK_cliente_pedido` (`ID_Pedido`);

--
-- Indices de la tabla `cocina`
--
ALTER TABLE `cocina`
  ADD PRIMARY KEY (`ID_Cocina`),
  ADD KEY `FK_cocina_usuario` (`ID_Usuario`),
  ADD KEY `FK_cocina_pedido` (`ID_Pedido`);

--
-- Indices de la tabla `mantenedor`
--
ALTER TABLE `mantenedor`
  ADD PRIMARY KEY (`ID_Mantenedor`),
  ADD KEY `FK_mantenedor_productos` (`ID_Productos`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`ID_Oferta`);

--
-- Indices de la tabla `opiniones`
--
ALTER TABLE `opiniones`
  ADD PRIMARY KEY (`ID_Opinion`),
  ADD KEY `ID_Usuario` (`ID_Usuario`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID_Pedido`),
  ADD KEY `FK_pedido_cliente` (`Usuario_realizador`);

--
-- Indices de la tabla `problema_cocina`
--
ALTER TABLE `problema_cocina`
  ADD PRIMARY KEY (`ID_problema`),
  ADD KEY `FK_problema_cocina_pedido` (`ID_Pedido`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_Productos`);

--
-- Indices de la tabla `recibo_compra`
--
ALTER TABLE `recibo_compra`
  ADD PRIMARY KEY (`ID_Caja`),
  ADD KEY `FK_recibo_compra_pedido` (`ID_Pedido`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_Usuarios`);

--
-- Indices de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD PRIMARY KEY (`ID_Valoracion`),
  ADD KEY `ID_Producto` (`ID_Producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `atencion_cliente`
--
ALTER TABLE `atencion_cliente`
  MODIFY `ID_Atencion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `ID_Caja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carro_de_compra`
--
ALTER TABLE `carro_de_compra`
  MODIFY `ID_carrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `cocina`
--
ALTER TABLE `cocina`
  MODIFY `ID_Cocina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mantenedor`
--
ALTER TABLE `mantenedor`
  MODIFY `ID_Mantenedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `ID_Oferta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opiniones`
--
ALTER TABLE `opiniones`
  MODIFY `ID_Opinion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `problema_cocina`
--
ALTER TABLE `problema_cocina`
  MODIFY `ID_problema` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID_Productos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `recibo_compra`
--
ALTER TABLE `recibo_compra`
  MODIFY `ID_Caja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  MODIFY `ID_Valoracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `atencion_cliente`
--
ALTER TABLE `atencion_cliente`
  ADD CONSTRAINT `FK_atencion_cliente` FOREIGN KEY (`ID_Cliente`) REFERENCES `clientes` (`ID_Cliente`);

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `FK_caja_pedido` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido` (`ID_Pedido`),
  ADD CONSTRAINT `FK_caja_usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuarios`);

--
-- Filtros para la tabla `carro_de_compra`
--
ALTER TABLE `carro_de_compra`
  ADD CONSTRAINT `FK_carro_pedido` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido` (`ID_Pedido`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `FK_cliente_carrito` FOREIGN KEY (`ID_carrito`) REFERENCES `carro_de_compra` (`ID_carrito`),
  ADD CONSTRAINT `FK_cliente_pedido` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido` (`ID_Pedido`);

--
-- Filtros para la tabla `cocina`
--
ALTER TABLE `cocina`
  ADD CONSTRAINT `FK_cocina_pedido` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido` (`ID_Pedido`),
  ADD CONSTRAINT `FK_cocina_usuario` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuarios`);

--
-- Filtros para la tabla `mantenedor`
--
ALTER TABLE `mantenedor`
  ADD CONSTRAINT `FK_mantenedor_productos` FOREIGN KEY (`ID_Productos`) REFERENCES `productos` (`ID_Productos`);

--
-- Filtros para la tabla `opiniones`
--
ALTER TABLE `opiniones`
  ADD CONSTRAINT `opiniones_ibfk_1` FOREIGN KEY (`ID_Usuario`) REFERENCES `usuarios` (`ID_Usuarios`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `FK_pedido_cliente` FOREIGN KEY (`Usuario_realizador`) REFERENCES `clientes` (`ID_Cliente`);

--
-- Filtros para la tabla `problema_cocina`
--
ALTER TABLE `problema_cocina`
  ADD CONSTRAINT `FK_problema_cocina_pedido` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido` (`ID_Pedido`);

--
-- Filtros para la tabla `recibo_compra`
--
ALTER TABLE `recibo_compra`
  ADD CONSTRAINT `FK_recibo_compra_pedido` FOREIGN KEY (`ID_Pedido`) REFERENCES `pedido` (`ID_Pedido`);

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `valoraciones_ibfk_1` FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID_Productos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
