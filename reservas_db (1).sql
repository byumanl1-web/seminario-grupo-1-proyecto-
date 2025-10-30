-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-10-2025 a las 04:56:39
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
-- Base de datos: `reservas_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `usuario` text NOT NULL,
  `clave` text NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `foto` text NOT NULL,
  `rol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `usuario`, `clave`, `nombre`, `apellido`, `foto`, `rol`) VALUES
(1, 'admin', '123', 'miguel', 'arias', '', 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `id_consultorio` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `nyaP` text NOT NULL,
  `documento` text NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `id_doctor`, `id_consultorio`, `id_paciente`, `nyaP`, `documento`, `inicio`, `fin`) VALUES
(40, 1, 2, 2, 'tatian cuberp', '207644912', '2024-10-08 08:00:00', '2024-10-08 09:00:00'),
(41, 2, 3, 2, 'tatian cuberp', '207644912', '2024-10-14 08:00:00', '2024-10-14 09:00:00'),
(42, 2, 3, 2, 'tatian cuberp', '207644912', '2024-10-15 14:00:00', '2024-10-15 15:00:00'),
(43, 2, 3, 4, 'Perez Giron', '205', '2024-10-14 09:00:00', '2024-10-14 10:00:00'),
(44, 6, 3, 2, 'tatian cuberp', '207644912', '2024-10-07 09:00:00', '2024-10-07 10:00:00'),
(45, 6, 3, 2, 'tatian cuberp', '207644912', '2024-10-15 08:00:00', '2024-10-15 09:00:00'),
(46, 6, 3, 3, 'Josep Mox', '1122', '2024-10-15 10:00:00', '2024-10-15 11:00:00'),
(47, 1, 2, 2, 'tatian cuberp', '207644912', '2024-10-15 08:00:00', '2024-10-15 09:00:00'),
(48, 1, 2, 0, 'Paciente...', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 1, 2, 0, 'Paciente...', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 1, 2, 0, 'Paciente...', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 1, 2, 0, 'Paciente...', '', '2025-10-07 07:00:00', '2025-10-07 08:00:00'),
(52, 1, 2, 0, 'Paciente...', '', '2025-10-08 09:00:00', '2025-10-08 10:00:00'),
(53, 3, 4, 2, 'tatian cuberp', '207644912', '2025-10-08 10:00:00', '2025-10-08 11:00:00'),
(54, 3, 4, 2, 'tatian cuberp', '207644912', '2025-10-09 11:00:00', '2025-10-09 12:00:00'),
(55, 6, 3, 7, 'Daniel Alejandro', '11111111111111', '2025-10-10 07:00:00', '2025-10-10 08:00:00'),
(56, 7, 7, 0, 'Paciente...', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 2, 3, 2, 'tatian cuberp', '207644912', '2025-10-08 12:00:00', '2025-10-08 13:00:00'),
(58, 7, 2, 2, 'tatian cuberp', '207644912', '2025-10-07 09:00:00', '2025-10-07 10:00:00'),
(59, 7, 2, 0, 'Paciente...', '', '2025-10-16 08:00:00', '2025-10-16 09:00:00'),
(61, 7, 2, 2, 'tatian cuberp', '207644912', '2025-10-16 10:00:00', '2025-10-16 11:00:00'),
(62, 7, 2, 0, 'Daniel Alejandro', '46541651651651', '2025-10-17 11:00:00', '2025-10-17 12:00:00'),
(63, 7, 2, 0, 'Daniel Alejandro', '46541651651651', '2025-10-17 11:00:00', '2025-10-17 12:00:00'),
(64, 7, 2, 0, 'Daniel Alejandro', '46541651651651', '2025-10-17 11:00:00', '2025-10-17 12:00:00'),
(65, 7, 2, 0, 'Daniel Alejandro', '46541651651651', '2025-10-17 11:00:00', '2025-10-17 12:00:00'),
(66, 6, 3, 2, 'tatian cuberp', '207644912', '2025-10-15 07:00:00', '2025-10-15 08:00:00'),
(67, 7, 7, 2, 'tatian cuberp', '207644912', '2025-10-15 09:00:00', '2025-10-15 10:00:00'),
(68, 6, 3, 2, 'tatian cuberp', '207644912', '2025-10-13 07:00:00', '2025-10-13 08:00:00'),
(69, 8, 2, 0, 'Paciente...', '', '2025-10-24 11:00:00', '2025-10-24 12:00:00'),
(70, 16, 7, 2, 'tatian cuberp', '207644912', '2025-10-24 13:00:00', '2025-10-24 14:00:00'),
(71, 2, 9, 0, 'Mario Matzir', '16515', '2025-10-29 08:00:00', '2025-10-29 09:00:00'),
(72, 3, 4, 23, 'Yefri Ramirez', '23131568548', '2025-10-27 08:00:00', '2025-10-27 09:00:00'),
(73, 2, 9, 0, 'Yefri Ramirez', '3513151355', '2025-10-30 17:00:00', '2025-10-30 18:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
--

CREATE TABLE `consultorios` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`id`, `nombre`) VALUES
(2, 'pediatria'),
(3, 'Nutricionista'),
(4, 'ginecologia'),
(7, 'oculista'),
(9, 'Revisión de Peso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `id` int(11) NOT NULL,
  `id_consultorio` int(11) NOT NULL,
  `apellido` text NOT NULL,
  `nombre` text NOT NULL,
  `foto` text NOT NULL,
  `usuario` text NOT NULL,
  `clave` text NOT NULL,
  `sexo` text NOT NULL,
  `horarioE` time NOT NULL,
  `horarioS` time NOT NULL,
  `rol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id`, `id_consultorio`, `apellido`, `nombre`, `foto`, `usuario`, `clave`, `sexo`, `horarioE`, `horarioS`, `rol`) VALUES
(2, 9, 'arce', 'greivin', '', 'd2', '123', 'Masculino', '08:00:00', '19:00:00', 'Doctor'),
(3, 4, 'chavez', 'andres', '', 'd3', '123', 'Masculino', '08:00:00', '20:00:00', 'Doctor'),
(4, 3, 'TAL', 'cual', '', 'd4', '123', 'Masculino', '00:00:00', '00:00:00', 'Doctor'),
(6, 3, 'Jimenez', 'Andrea', '', 'andreaN', '123', 'Femenino', '07:00:00', '16:00:00', 'Doctor'),
(7, 7, 'Luis', 'Luis', '', 'richard1', '123', 'Masculino', '09:00:00', '13:00:00', 'Doctor'),
(13, 4, 'asd', 'asd', '', 'luis12', 'asd', 'Seleccionar...', '00:00:00', '00:00:00', 'Doctor'),
(14, 4, 'asd', 'asd', '', 'luis122', 'asd', 'Masculino', '00:00:00', '00:00:00', 'Doctor'),
(15, 7, 'hola', 'hola', '', 'luis12233', 'asd', 'Masculino', '00:00:00', '00:00:00', 'Doctor'),
(16, 7, 'yo', 'yo', '', 'yo', '123', 'Masculino', '06:00:00', '16:00:00', 'Doctor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(11) NOT NULL,
  `paciente_id` int(11) NOT NULL,
  `nombre_documento` varchar(255) DEFAULT NULL,
  `ruta_documento` varchar(255) DEFAULT NULL,
  `tipo_documento` varchar(50) DEFAULT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `paciente_id`, `nombre_documento`, `ruta_documento`, `tipo_documento`, `fecha_subida`) VALUES
(5, 23, '1761360283_tarjetas.pdf', 'C:/xampp/htdocs/clinica/uploads/1761360283_tarjetas.pdf', 'application/pdf', '2025-10-25 02:44:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicio`
--

CREATE TABLE `inicio` (
  `id` int(11) NOT NULL,
  `intro` text NOT NULL,
  `horaE` time NOT NULL,
  `horaS` time NOT NULL,
  `telefono` text NOT NULL,
  `correo` text NOT NULL,
  `direccion` text NOT NULL,
  `logo` text NOT NULL,
  `favicon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inicio`
--

INSERT INTO `inicio` (`id`, `intro`, `horaE`, `horaS`, `telefono`, `correo`, `direccion`, `logo`, `favicon`) VALUES
(1, 'empresa', '08:00:00', '19:00:00', '79302545', 'yepocapa@gmail.com', 'YEPOCAPA', 'Vistas/img/a.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `apellido` text NOT NULL,
  `nombre` text NOT NULL,
  `documento` text NOT NULL,
  `foto` text NOT NULL,
  `usuario` text NOT NULL,
  `clave` text NOT NULL,
  `rol` text NOT NULL,
  `alergias` text DEFAULT NULL,
  `enfermedades` text DEFAULT NULL,
  `cirugias` text DEFAULT NULL,
  `vacunas` text DEFAULT NULL,
  `medicamentos` text DEFAULT NULL,
  `habitos` text DEFAULT NULL,
  `antecedentes_familiares` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `apellido`, `nombre`, `documento`, `foto`, `usuario`, `clave`, `rol`, `alergias`, `enfermedades`, `cirugias`, `vacunas`, `medicamentos`, `habitos`, `antecedentes_familiares`) VALUES
(4, 'Giron Perez', 'Jacob Marcos', '205', '', 'm1', '123', 'Paciente', 'Alergia a látex o productos químicos', 'Enfermedad cardíaca (infarto, arritmia, insuficiencia)  Enfermedad tiroidea (hipotiroidismo, hipertiroidismo)', 'Cirugía de hernia  Cirugía ortopédica (rodilla, cadera, fractura)  Cirugía cardíaca', 'Hepatitis B  Hepatitis A  Sarampión, Rubéola, Paperas (SRP)  Virus del papiloma humano (VPH)', 'Antidiabéticos orales o insulina  Anticoagulantes  Antidepresivos / ansiolíticos', 'Consumo de drogas ilícitas  Actividad física (tipo y frecuencia)  Alimentación (balanceada, vegetariana, etc.)', 'Cáncer (especificar tipo y familiar afectado)  Dislipidemia (colesterol o triglicéridos altos)  Enfermedades neurológicas (Alzheimer, Parkinson, epilepsia)'),
(11, 'Matzir', 'Mario', '302151648489', '', 'M2', '123', 'Paciente', 'penicilina, ibuprofeno, sulfas', 'Hipertensión arterial  Diabetes mellitus  Asma bronquial  Enfermedad cardíaca', 'Apendicectomía  Colecistectomía (vesícula)  Cesárea  Cirugía de hernia', 'COVID-19  Influenza anual  Tétanos / Difteria / Tosferina (Td o Tdap)  Hepatitis B  Hepatitis A  Sarampión, Rubéola, Paperas (SRP)', 'Antihipertensivos  Antidiabéticos orales o insulina  Anticoagulantes', 'Tabaquismo (cantidad / tiempo)  Alcohol (frecuencia y cantidad)  Consumo de drogas ilícitas', 'Hipertensión arterial  Diabetes mellitus  Enfermedad cardíaca (infarto, arritmia, insuficiencia)  Cáncer (especificar tipo y familiar afectado)'),
(23, 'Ramirez', 'Yefri', '23131568548', '', 'yef', '123', 'Paciente', 'Penicilina', 'Diabetes', 'Apedince 2019', 'COVID-19', 'Ibuprofenos ', 'No hace ejercicio, fumador', 'Hipertension familiar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `servicio` varchar(50) NOT NULL,
  `comentarios` text DEFAULT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `nombre`, `email`, `telefono`, `fecha`, `hora`, `servicio`, `comentarios`, `creado_en`) VALUES
(1, 'hola', 'hola@gmail.com', '555555', '2001-05-05', '02:05:00', 'consulta', 'para hospedaje', '2025-09-20 16:29:19'),
(2, 'hola', 'hola@gmail.com', '555555', '2001-05-05', '02:05:00', 'consulta', 'para hospedaje', '2025-09-20 16:31:59'),
(3, 'Amilcar', 'amilcarcan@gmail.com', '5555555', '2025-02-10', '18:51:00', 'control', 'Por temas laborales', '2025-09-20 16:33:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretarias`
--

CREATE TABLE `secretarias` (
  `id` int(11) NOT NULL,
  `usuario` text NOT NULL,
  `clave` text NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `foto` text NOT NULL,
  `rol` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `secretarias`
--

INSERT INTO `secretarias` (`id`, `usuario`, `clave`, `nombre`, `apellido`, `foto`, `rol`) VALUES
(1, 's', '123', 'Maria', 'Gaspar', '', 'Secretaria'),
(2, 'angie', '123', 'Angela', 'Estrada', '', 'Secretaria'),
(3, 's', '123', '123', 's', '', 'Secretaria'),
(4, '123', '123', '123', '123', '', 'Secretaria'),
(5, '123', '123', '123', '123', '', 'Secretaria');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_consultorio` (`id_consultorio`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paciente_id` (`paciente_id`);

--
-- Indices de la tabla `inicio`
--
ALTER TABLE `inicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inicio`
--
ALTER TABLE `inicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD CONSTRAINT `id_consultorio` FOREIGN KEY (`id_consultorio`) REFERENCES `consultorios` (`id`);

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
