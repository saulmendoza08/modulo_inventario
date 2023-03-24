<?php

// Obtener los datos del formulario
$db_host = $_POST['db_host'];
$db_name = $_POST['db_name'];
$db_user = $_POST['db_user'];
$db_password = $_POST['db_password'];
$admin_username = $_POST['admin_username'];
$admin_password = $_POST['admin_password'];

// Intentar conectarse a la base de datos
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if (!$conn) {
  die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Crear la tabla de usuarios
$sql = "
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Teclados'),
(2, 'Mouses');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_sc`
--

CREATE TABLE `estados_sc` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados_sc`
--

INSERT INTO `estados_sc` (`id`, `nombre`) VALUES
(1, 'Completa'),
(2, 'Incompleta'),
(3, 'Cancelada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_solicitados`
--

CREATE TABLE `items_solicitados` (
  `id` int(25) NOT NULL,
  `id_productos` int(25) NOT NULL,
  `id_solicitudes` int(11) NOT NULL,
  `cantidad_sol` int(25) NOT NULL,
  `cantidad_recibida` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `items_solicitados`
--

INSERT INTO `items_solicitados` (`id`, `id_productos`, `id_solicitudes`, `cantidad_sol`, `cantidad_recibida`, `id_proveedor`) VALUES
(1, 99652, 2222, 3, 0, 1),
(2, 28225512, 32432, 6, 0, 2),
(3, 99652, 32432, 2, 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(25) NOT NULL,
  `nombre` text NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`, `id_categoria`) VALUES
(1, 'LG', 1),
(2, 'Samsung', 1),
(3, 'LG', 2),
(4, 'Samsung', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(25) NOT NULL,
  `id_categorias` int(11) NOT NULL,
  `id_marcas` int(25) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `id_categorias`, `id_marcas`, `descripcion`) VALUES
(99652, 1, 1, 'Modelo 3'),
(28225512, 2, 2, 'Modelo 222');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(25) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cuit` bigint(255) NOT NULL,
  `domicilio` text NOT NULL,
  `celular` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `nombre`, `cuit`, `domicilio`, `celular`) VALUES
(1, 'Gabriel Fernando Mendoza', 20414012877, 'Av. Alem 928 3B', 5493815561646),
(2, 'Grupo Norte', 30716633140, 'Av. Juan B. Justo 1120', 5493814300043);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `servicio` varchar(100) NOT NULL,
  `interno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `servicio`, `interno`) VALUES
(1, 'Departamento de Enfermería', 139),
(2, 'Informática', 182),
(3, 'Compras', 160),
(4, 'Gerencia', 130),
(5, 'Tesoreria', 241),
(6, 'Anatomia Patologica', 167),
(7, 'Asesoria Letrada', 259),
(8, 'Comite de Docencia', 116),
(9, 'Consultorio externo', 177),
(10, 'Depto. Procuracion y Trasplante', 396),
(11, 'Dermatologia', 322),
(12, 'Tomografia', 174),
(13, 'Ecografia', 195),
(14, 'Tomografia - Recepcion', 163),
(15, 'Conduccion', 112),
(16, 'Electroencefalograma', 224),
(17, 'Estadisticas', 120),
(18, 'Esterilizacion', 139),
(19, 'Farmacia Central', 150),
(20, 'Farmacia Deposito', 239),
(21, 'Gestion Pacientes', 0),
(22, 'Otro', 0),
(23, 'Guardia', 0),
(24, 'Hemodinamia', 235),
(25, 'Hemoterapia', 148),
(26, 'Banco Regional de Tejidos', 359),
(27, 'Infectologia', 153),
(40, 'Ingenieria Clinica - Bioingenieria', 198),
(41, 'Laboratorio Central', 114),
(42, 'Bacteriologia', 118),
(43, 'Hematologia', 228),
(44, 'Mantenimiento', 159),
(45, 'Medicina del Dolor', 245),
(46, 'Medicina Laboral', 246),
(47, 'Mesa de entrada', 178),
(48, 'Nefrologia', 221),
(49, 'Neumonologia', 188),
(50, 'Nutricion', 141),
(51, 'Odontologia', 115),
(52, 'Oftalmologia', 172),
(53, 'Oncologia', 147),
(54, 'ORL ( Otorrino laringologia)', 173),
(55, 'Personal', 180),
(56, 'Quirofano', 175),
(57, 'Radiologia', 144),
(58, 'Recupero de Costos', 181),
(59, 'Recursos Humanos', 204),
(60, 'Residuos Patologicos', 117),
(61, 'Sala 2', 140),
(62, 'Sala 3', 136),
(63, 'Sala 5', 142),
(64, 'Sala 7', 129),
(65, 'Sala 8', 143),
(66, 'Sala 9', 145),
(67, 'Sala 10', 146),
(68, 'Sala 11', 128),
(69, 'Sala 12', 189),
(70, 'Salud Mental', 209),
(71, 'Servicio Generales', 168),
(72, 'Servicio Social', 149),
(73, 'Suministro', 132),
(74, 'Cirugia Toracica', 124),
(75, 'UNCV (UCO)', 210),
(76, 'UCI 1', 200),
(77, 'UCI 2 ', 225),
(78, 'Unidad de Procuracion', 106),
(79, 'Unidad Respiratoria', 122),
(80, 'Unidad de Trasplante Hepatico', 214),
(81, 'Urologia', 213),
(82, 'Resonancia', 163),
(83, 'Telemedicina', 12),
(84, 'Febriles', 123),
(85, 'Calidad', 123),
(86, 'UCI 4', 123),
(87, 'Laboratorio de Guardia', 123),
(88, 'fonoaudiologia', 123),
(89, 'Laboratorio de Hematologia', 123),
(90, 'Maxilofacial', 109),
(91, 'Reumatologia', 136),
(92, 'Auditoria', 143),
(93, 'Epidemiologia', 252),
(94, 'Archivo', 155),
(95, 'Higiene y seguridad', 11),
(96, 'CATA', 218),
(97, 'Unidad de Cuidados Progresivos', 123),
(98, 'Sala de Yeso', 123),
(99, 'Kinesiologia', 123),
(100, 'Ginecologia', 123),
(101, 'Oftalmologia-Unidad de Trasplante de cornea ', 123),
(102, 'Servicio Generales - LAVADERO ', 164),
(103, 'Unidad de Trasplante Renal', 395),
(104, 'Laboratorio Microbiologia', 118),
(105, 'Unidad de Dolor', 0),
(106, 'Rayos Central', 144),
(107, 'Anestesiología', 175),
(108, 'Depto. Clinica Medica', 111),
(109, 'Unidad de Patologia Glandular', 111),
(110, 'Residencia de enfermería', 111),
(111, 'Depto. de Planificación ', 1111),
(112, 'test', 1),
(113, 'Clinica Medica II', 123),
(114, 'Neurologia', 111),
(115, 'Cirugía Vascular', 111),
(116, 'Unidad de soporte nutricional', 260),
(117, 'INFORMATICA CENTRAL', 0),
(118, 'Cirugia General', 1234);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `fecha_sol` date NOT NULL,
  `ticket` int(25) NOT NULL,
  `oc` int(25) NOT NULL,
  `fecha_recepcion` date NOT NULL,
  `remito` int(100) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `pc` varchar(50) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `fecha_sol`, `ticket`, `oc`, `fecha_recepcion`, `remito`, `id_servicio`, `pc`, `id_estado`) VALUES
(2222, '2023-03-01', 2212, 2232, '2023-03-21', 2122, 1, 'hp6666', 2),
(32432, '2023-03-01', 3332, 1234, '2023-03-31', 654, 9, 'hp7655', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(25) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `correo` text NOT NULL,
  `celular` bigint(20) NOT NULL,
  `estado` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `celular`, `estado`) VALUES
(1, 'Saul Ignacio', 'Mendoza', 'saulmendoza08@gmail.com', 5493816049337, 'activo'),
(2, 'Fabian Javier', 'Ponce', 'fabianjponce@hotmail.com', 543816750776, 'activo'),
(3, 'Gerardo Jesus Domingo', 'Andrade', 'ingeniero@gerardoandrade.com', 5493815731212, 'inactivo');

--";
if (!mysqli_query($conn, $sql)) {
  die("Error al crear la tabla de usuarios: " . mysqli_error($conn));
}

// Insertar el usuario admin
$sql = "INSERT INTO users (username, password, is_admin) VALUES ('$admin_username', '$admin_password', 1)";
if (!mysqli_query($conn, $sql)) {
  die("Error al insertar el usuario admin: " . mysqli_error($conn));
}

// Configuración completada
echo "La configuración ha sido completada exitosamente.";

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
