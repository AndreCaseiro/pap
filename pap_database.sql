-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 28-Jun-2019 às 13:29
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pap_database`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `codigo_vencimento`
--

CREATE TABLE `codigo_vencimento` (
  `idcodigo_vencimento` int(11) NOT NULL,
  `funcao` varchar(245) DEFAULT NULL,
  `salario_base` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `codigo_vencimento`
--

INSERT INTO `codigo_vencimento` (`idcodigo_vencimento`, `funcao`, `salario_base`) VALUES
(1, 'Chefe', '1200'),
(2, 'Fúncionario Limpezas', '550'),
(3, 'Operário', '600'),
(4, 'Finanças', '750'),
(5, 'Camionistas', '600');

-- --------------------------------------------------------

--
-- Estrutura da tabela `descricao_bloqueio`
--

CREATE TABLE `descricao_bloqueio` (
  `id_descricao_bloqueio` int(11) NOT NULL,
  `descricoes` varchar(256) DEFAULT NULL,
  `eliminado` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `descricao_bloqueio`
--

INSERT INTO `descricao_bloqueio` (`id_descricao_bloqueio`, `descricoes`, `eliminado`) VALUES
(1, 'Ativo', 0),
(2, 'Bloqueado', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `idEmpresa` int(11) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `sociedade` varchar(256) NOT NULL,
  `patrao` varchar(256) NOT NULL,
  `nif` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`idEmpresa`, `nome`, `sociedade`, `patrao`, `nif`) VALUES
(1, 'Dara', 'dara', 'Pedro', '123456789'),
(2, 'Padrão', 'padrão', 'José', '987654321');

-- --------------------------------------------------------

--
-- Estrutura da tabela `familia_produto`
--

CREATE TABLE `familia_produto` (
  `idfamilia_produto` int(11) NOT NULL,
  `familia` varchar(256) DEFAULT NULL,
  `eliminado` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `familia_produto`
--

INSERT INTO `familia_produto` (`idfamilia_produto`, `familia`, `eliminado`) VALUES
(1, 'meias', 0),
(2, 'cuecas', 0),
(3, 'collants', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `idfuncionarios` int(11) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `data_nascimento` date DEFAULT NULL,
  `bi` varchar(8) NOT NULL,
  `data_admicao` date NOT NULL,
  `eliminado` int(11) DEFAULT '0',
  `funcao` varchar(45) NOT NULL,
  `utilizadores_idlogin` int(11) NOT NULL,
  `empresa_idEmpresa` int(11) NOT NULL,
  `endereco` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `telemovel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`idfuncionarios`, `nome`, `data_nascimento`, `bi`, `data_admicao`, `eliminado`, `funcao`, `utilizadores_idlogin`, `empresa_idEmpresa`, `endereco`, `email`, `cidade`, `telemovel`) VALUES
(5, 'Pedro andrade', '2018-12-18', '14960621', '2019-05-07', 0, '1', 1, 1, 'Rua Garrett', 'pedroadrd@gmail.com', 'porto', 912939481),
(6, 'António', '2019-05-08', '91424895', '2019-05-24', 0, '1', 2, 1, 'Rua do Arsenal', 'antonioabc@gmail.com', 'Portotinto', 919298843),
(8, 'Miguel', '2001-12-12', '92871637', '1999-04-04', 0, '2', 3, 1, 'Rua da Betesga', 'miguelabc@gmail.com', 'asdasdada', 915423546),
(9, 'Ricardo', '2001-12-12', '18238128', '1999-04-22', 0, '2', 4, 1, 'Rua Ferreira Lapa', 'ricardomiguel@gmail.com', 'asdasdada', 912983849),
(10, 'Rui', '2001-12-04', '12313123', '2002-02-02', 0, '2', 5, 1, 'Rua do Salitre', 'ruiduarte@gmail.com', 'Coimbra', 932942128),
(11, 'Martim', '1991-12-05', '32184759', '1996-01-05', 0, '3', 6, 1, 'Rua da Sota ', 'martimmiguel@gmail.com', 'coimbra', 912939123),
(12, 'José', '2001-12-02', '17482712', '2001-02-12', 0, '1', 7, 2, 'Rua de São Julião', 'joseduarte@gmail.com', 'Coimbra', 916593988),
(13, 'Dinis', '2001-12-02', '19239139', '2001-12-02', 0, '5', 8, 1, 'Rua de SÃ£o Bento', 'dinismiguel@gmail.com', 'Coimbra', 912391939);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `idrecords` int(11) NOT NULL,
  `dateIn` datetime DEFAULT CURRENT_TIMESTAMP,
  `dateOut` datetime DEFAULT CURRENT_TIMESTAMP,
  `eliminado` int(11) DEFAULT '0',
  `utilizadores_idlogin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`idrecords`, `dateIn`, `dateOut`, `eliminado`, `utilizadores_idlogin`) VALUES
(1, '2019-03-22 00:00:00', NULL, NULL, 1),
(2, '2019-03-22 00:00:00', NULL, NULL, 1),
(3, '2019-03-22 00:00:00', NULL, NULL, 2),
(4, '2019-04-15 00:00:00', NULL, NULL, 1),
(5, '2019-04-22 00:00:00', NULL, NULL, 1),
(6, '2019-04-22 00:00:00', NULL, NULL, 2),
(7, '2019-04-22 00:00:00', NULL, NULL, 1),
(8, '2019-04-22 00:00:00', NULL, NULL, 1),
(9, '2019-04-22 00:00:00', NULL, NULL, 1),
(10, '2019-04-22 00:00:00', '2019-04-22 00:00:00', NULL, 1),
(11, '2019-04-22 00:00:00', '2019-04-22 00:00:00', NULL, 1),
(12, '2019-04-22 00:00:00', '2019-04-23 00:00:00', NULL, 1),
(13, '2019-04-23 00:00:00', '2019-04-23 00:00:00', NULL, 1),
(14, '2019-04-23 00:00:00', '2019-04-23 00:00:00', NULL, 1),
(15, '2019-04-23 00:00:00', '2019-04-23 00:00:00', NULL, 1),
(16, '2019-04-23 00:00:00', '2019-04-23 00:00:00', NULL, 1),
(17, '2019-04-23 00:00:00', '2019-04-23 00:00:00', NULL, 1),
(18, '2019-04-23 00:00:00', '2019-04-23 00:38:31', NULL, 1),
(19, '2019-04-23 00:38:55', '2019-04-23 01:41:14', NULL, 1),
(20, '2019-04-23 01:42:44', '2019-04-23 01:43:44', NULL, 1),
(21, '2019-04-23 01:43:50', '2019-04-23 01:43:53', NULL, 1),
(22, '2019-04-23 01:45:02', '2019-04-23 01:45:05', NULL, 1),
(23, '2019-04-23 11:17:14', NULL, NULL, 1),
(24, '2019-04-23 21:48:11', '2019-04-24 00:14:15', NULL, 1),
(25, '2019-04-24 00:16:58', '2019-04-24 00:00:00', NULL, 1),
(26, '2019-04-24 23:47:10', '2019-04-25 01:09:53', NULL, 1),
(27, '2019-04-25 01:10:30', '2019-04-25 01:11:00', NULL, 1),
(28, '2019-04-25 01:12:03', NULL, NULL, 2),
(29, '2019-04-25 01:12:43', '2019-04-25 01:13:41', NULL, 1),
(30, '2019-04-25 01:14:07', '2019-04-25 01:14:09', NULL, 1),
(31, '2019-04-25 01:14:25', '2019-04-25 01:15:54', NULL, 1),
(32, '2019-04-25 01:15:56', '2019-04-25 01:16:00', NULL, 1),
(33, '2019-04-25 01:17:25', '2019-04-25 01:17:29', NULL, 1),
(34, '2019-04-25 01:17:35', '2019-04-25 01:17:37', NULL, 1),
(35, '2019-04-25 01:18:20', '2019-04-25 01:18:29', NULL, 1),
(36, '2019-04-26 18:40:23', '2019-04-26 22:06:05', NULL, 1),
(37, '2019-04-26 22:06:07', '2019-04-26 22:07:17', NULL, 1),
(38, '2019-04-26 22:07:18', '2019-04-26 22:07:33', NULL, 1),
(39, '2019-04-26 22:07:34', '2019-04-26 22:08:03', NULL, 1),
(40, '2019-04-26 22:08:04', '2019-04-26 22:08:18', NULL, 1),
(41, '2019-04-26 22:08:19', '2019-04-26 22:09:23', NULL, 1),
(42, '2019-04-26 22:09:26', NULL, NULL, 2),
(43, '2019-04-26 22:10:26', '2019-04-26 22:10:38', NULL, 1),
(44, '2019-04-26 22:10:39', '2019-04-26 22:11:26', NULL, 1),
(45, '2019-04-26 22:11:27', '2019-04-26 22:11:31', NULL, 1),
(46, '2019-04-26 22:11:37', '2019-04-26 22:12:00', NULL, 1),
(47, '2019-04-26 22:12:01', '2019-04-26 22:14:01', NULL, 1),
(48, '2019-04-26 22:14:02', '2019-04-26 22:14:57', NULL, 1),
(49, '2019-04-26 22:15:00', NULL, NULL, 2),
(50, '2019-04-26 22:15:39', NULL, NULL, 2),
(51, '2019-04-26 22:16:47', NULL, NULL, 2),
(52, '2019-04-26 22:17:15', '2019-04-26 22:17:21', NULL, 1),
(53, '2019-04-26 22:17:23', NULL, NULL, 2),
(54, '2019-04-26 22:17:35', NULL, NULL, 2),
(55, '2019-04-26 22:18:00', NULL, NULL, 1),
(56, '2019-04-27 13:21:39', NULL, NULL, 1),
(57, '2019-04-29 09:20:53', '2019-04-29 11:41:07', NULL, 1),
(58, '2019-04-29 11:41:11', NULL, NULL, 2),
(59, '2019-04-29 11:52:21', NULL, NULL, 2),
(60, '2019-04-29 11:52:54', NULL, NULL, 2),
(61, '2019-04-29 12:52:15', NULL, NULL, 1),
(62, '2019-05-02 09:43:03', NULL, NULL, 1),
(63, '2019-05-02 20:02:35', NULL, NULL, 1),
(64, '2019-05-02 20:49:42', '2019-05-09 14:47:44', NULL, 1),
(65, '2019-05-09 14:47:50', '2019-05-09 14:55:21', NULL, 1),
(66, '2019-05-09 14:55:23', '2019-05-09 14:55:43', NULL, 3),
(67, '2019-05-09 14:55:51', NULL, NULL, 2),
(68, '2019-05-09 14:56:05', NULL, NULL, 3),
(69, '2019-05-13 15:07:57', NULL, NULL, 1),
(70, '2019-05-14 11:34:49', NULL, NULL, 1),
(71, '2019-05-15 10:16:55', '2019-05-15 12:23:43', NULL, 1),
(72, '2019-05-15 12:24:04', NULL, NULL, 4),
(73, '2019-05-15 12:24:25', NULL, NULL, 4),
(74, '2019-05-16 10:15:46', '2019-05-16 11:00:42', NULL, 1),
(75, '2019-05-16 11:00:51', '2019-05-16 13:52:48', NULL, 1),
(76, '2019-05-16 13:52:52', '2019-05-16 14:43:00', NULL, 1),
(77, '2019-05-16 14:43:03', NULL, NULL, 3),
(78, '2019-05-17 10:44:37', NULL, NULL, 1),
(79, '2019-05-23 12:06:50', NULL, NULL, 1),
(80, '2019-05-24 11:04:18', NULL, NULL, 1),
(81, '2019-05-27 10:58:37', NULL, NULL, 1),
(82, '2019-05-27 11:49:02', NULL, NULL, 1),
(83, '2019-05-28 10:01:31', '2019-05-28 16:00:19', NULL, 1),
(84, '2019-05-28 16:00:22', NULL, NULL, 1),
(85, '2019-05-30 11:33:54', '2019-05-30 15:05:19', NULL, 1),
(86, '2019-05-30 15:05:40', NULL, NULL, 2),
(87, '2019-05-30 15:05:55', '2019-05-30 15:06:09', NULL, 3),
(88, '2019-05-30 15:20:28', '2019-05-30 15:48:02', NULL, 1),
(89, '2019-05-31 11:04:05', '2019-05-31 11:24:02', NULL, 1),
(90, '2019-05-31 11:24:07', NULL, NULL, 1),
(91, '2019-06-05 11:00:29', NULL, NULL, 1),
(92, '2019-06-05 11:59:48', NULL, NULL, 1),
(93, '2019-06-05 11:59:58', NULL, NULL, 1),
(94, '2019-06-05 12:00:14', NULL, NULL, 1),
(95, '2019-06-05 12:00:24', NULL, NULL, 1),
(96, '2019-06-05 12:01:15', NULL, NULL, 1),
(97, '2019-06-05 12:01:40', NULL, NULL, 1),
(98, '2019-06-05 12:02:44', NULL, NULL, 1),
(99, '2019-06-05 12:03:12', NULL, NULL, 3),
(100, '2019-06-05 12:03:19', NULL, NULL, 3),
(101, '2019-06-05 12:04:26', NULL, NULL, 1),
(102, '2019-06-05 12:04:33', NULL, NULL, 1),
(103, '2019-06-05 12:07:46', NULL, NULL, 1),
(104, '2019-06-05 12:08:27', NULL, NULL, 1),
(105, '2019-06-05 12:08:33', NULL, NULL, 1),
(106, '2019-06-05 12:08:50', NULL, NULL, 1),
(107, '2019-06-05 12:09:11', NULL, NULL, 1),
(108, '2019-06-05 12:12:33', NULL, NULL, 1),
(109, '2019-06-05 12:13:39', NULL, NULL, 1),
(110, '2019-06-06 18:46:01', '2019-06-06 19:12:19', NULL, 1),
(111, '2019-06-06 19:12:28', '2019-06-06 19:14:03', NULL, 1),
(112, '2019-06-06 19:14:10', '2019-06-06 19:17:10', NULL, 1),
(113, '2019-06-06 19:18:44', '2019-06-06 19:27:52', NULL, 1),
(114, '2019-06-06 19:27:58', '2019-06-06 19:28:39', NULL, 1),
(115, '2019-06-06 19:28:47', '2019-06-06 19:29:06', NULL, 1),
(116, '2019-06-06 19:29:09', '2019-06-06 19:30:09', NULL, 3),
(117, '2019-06-06 19:30:12', '2019-06-06 19:30:17', NULL, 3),
(118, '2019-06-06 19:30:20', '2019-06-06 19:30:24', NULL, 1),
(119, '2019-06-06 19:30:27', '2019-06-06 19:31:48', NULL, 3),
(120, '2019-06-06 19:31:52', NULL, NULL, 1),
(121, '2019-06-06 19:34:28', '2019-06-06 19:41:39', NULL, 1),
(122, '2019-06-06 19:41:41', NULL, NULL, 3),
(123, '2019-06-06 19:44:51', NULL, NULL, 1),
(124, '2019-06-11 14:31:33', NULL, NULL, 1),
(125, '2019-06-12 11:04:10', NULL, NULL, 1),
(126, '2019-06-12 11:07:32', NULL, NULL, 1),
(127, '2019-06-12 11:07:41', NULL, NULL, 1),
(128, '2019-06-12 11:08:03', NULL, NULL, 1),
(129, '2019-06-12 11:09:07', NULL, NULL, 1),
(130, '2019-06-12 11:09:13', NULL, NULL, 1),
(131, '2019-06-12 11:10:20', NULL, NULL, 1),
(132, '2019-06-12 11:10:29', NULL, NULL, 1),
(133, '2019-06-12 11:12:05', NULL, NULL, 1),
(134, '2019-06-12 11:12:45', NULL, NULL, 1),
(135, '2019-06-12 11:14:53', NULL, NULL, 1),
(136, '2019-06-12 11:36:56', NULL, NULL, 1),
(137, '2019-06-12 11:37:57', NULL, NULL, 1),
(138, '2019-06-12 11:39:26', '2019-06-12 12:03:16', NULL, 1),
(139, '2019-06-12 12:07:43', '2019-06-12 15:19:21', NULL, 1),
(140, '2019-06-12 15:19:35', NULL, NULL, 1),
(141, '2019-06-13 11:30:28', NULL, NULL, 1),
(142, '2019-06-14 10:49:37', '2019-06-14 11:30:30', NULL, 1),
(143, '2019-06-14 11:30:33', '2019-06-14 11:31:06', 0, 1),
(144, '2019-06-14 11:31:10', '2019-06-14 11:31:10', 0, 3),
(145, '2019-06-14 11:31:37', '2019-06-14 11:31:37', 0, 1),
(146, '2019-06-14 14:12:50', '2019-06-14 14:50:28', 0, 1),
(147, '2019-06-14 16:16:24', '2019-06-14 16:28:34', 0, 1),
(148, '2019-06-14 17:24:07', '2019-06-14 18:32:41', 0, 1),
(149, '2019-06-14 18:43:19', '2019-06-14 18:43:19', 0, 1),
(150, '2019-06-17 10:54:58', '2019-06-17 11:14:54', 0, 1),
(151, '2019-06-17 11:15:15', '2019-06-17 15:11:41', 0, 4),
(152, '2019-06-17 15:11:48', '2019-06-17 15:11:59', 0, 4),
(153, '2019-06-17 15:12:01', '2019-06-17 15:12:01', 0, 1),
(154, '2019-06-18 11:15:56', '2019-06-18 12:15:45', 0, 1),
(155, '2019-06-18 12:15:55', '2019-06-18 14:55:43', 0, 1),
(156, '2019-06-18 14:55:46', '2019-06-18 14:55:46', 0, 3),
(157, '2019-06-18 14:56:03', '2019-06-18 15:39:46', 0, 1),
(158, '2019-06-18 15:40:37', '2019-06-18 15:40:37', 0, 1),
(159, '2019-06-18 19:21:29', '2019-06-18 19:27:52', 0, 1),
(160, '2019-06-18 19:30:51', '2019-06-18 19:45:31', 0, 1),
(161, '2019-06-18 19:45:34', '2019-06-18 19:45:34', 0, 3),
(162, '2019-06-18 19:47:39', '2019-06-18 20:03:56', 0, 1),
(163, '2019-06-18 20:04:01', '2019-06-18 20:04:01', 0, 3),
(164, '2019-06-18 20:05:46', '2019-06-18 20:19:22', 0, 1),
(165, '2019-06-18 20:19:25', '2019-06-18 20:30:46', 0, 1),
(166, '2019-06-18 20:30:50', '2019-06-19 10:44:43', 0, 1),
(167, '2019-06-19 10:44:46', '2019-06-19 10:44:46', 0, 3),
(168, '2019-06-19 10:45:35', '2019-06-19 11:00:06', 0, 1),
(169, '2019-06-19 11:00:10', '2019-06-19 11:00:10', 0, 3),
(170, '2019-06-19 11:00:39', '2019-06-19 11:00:39', 0, 1),
(171, '2019-06-19 11:03:11', '2019-06-19 11:03:11', 0, 3),
(172, '2019-06-19 11:05:24', '2019-06-19 11:06:47', 0, 1),
(173, '2019-06-19 11:07:02', '2019-06-19 11:07:31', 0, 1),
(174, '2019-06-19 11:07:35', '2019-06-19 11:07:35', 0, 8),
(175, '2019-06-19 11:10:22', '2019-06-19 11:10:22', 0, 3),
(176, '2019-06-19 11:12:53', '2019-06-19 11:13:07', 0, 1),
(177, '2019-06-19 11:13:11', '2019-06-19 11:13:11', 0, 2),
(178, '2019-06-19 11:14:18', '2019-06-19 14:23:03', 0, 1),
(179, '2019-06-19 14:23:08', '2019-06-19 16:51:04', 0, 1),
(180, '2019-06-19 16:51:17', '2019-06-19 17:46:53', 0, 1),
(181, '2019-06-19 17:47:01', '2019-06-19 17:49:24', 0, 1),
(182, '2019-06-19 17:49:26', '2019-06-19 17:51:14', 0, 1),
(183, '2019-06-19 17:51:19', '2019-06-19 17:51:54', 0, 1),
(184, '2019-06-19 17:51:57', '2019-06-19 17:52:55', 0, 1),
(185, '2019-06-19 17:52:58', '2019-06-19 17:52:58', 0, 1),
(186, '2019-06-21 09:44:38', '2019-06-21 09:44:38', 0, 1),
(187, '2019-06-21 16:17:57', '2019-06-21 18:15:46', 0, 1),
(188, '2019-06-21 18:15:48', '2019-06-21 18:17:05', 0, 1),
(189, '2019-06-21 18:17:08', '2019-06-21 18:19:46', 0, 3),
(190, '2019-06-21 18:24:27', '2019-06-21 19:12:25', 0, 4),
(191, '2019-06-21 19:12:27', '2019-06-21 19:12:27', 0, 1),
(192, '2019-06-24 10:28:17', '2019-06-24 12:17:45', 0, 1),
(193, '2019-06-24 12:17:48', '2019-06-24 12:21:14', 0, 1),
(194, '2019-06-24 12:21:18', '2019-06-24 12:21:18', 0, 2),
(195, '2019-06-24 12:21:25', '2019-06-24 12:22:52', 0, 1),
(196, '2019-06-24 12:22:55', '2019-06-24 12:22:55', 0, 2),
(197, '2019-06-24 12:22:59', '2019-06-24 12:22:59', 0, 2),
(198, '2019-06-24 12:28:15', '2019-06-24 12:28:15', 0, 1),
(199, '2019-06-25 11:14:50', '2019-06-25 11:14:50', 0, 1),
(200, '2019-06-27 10:44:52', '2019-06-27 10:44:52', 0, 1),
(201, '2019-06-27 15:28:47', '2019-06-27 15:28:47', 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `id_permissoes` int(11) NOT NULL,
  `descricoes` varchar(256) DEFAULT NULL,
  `eliminado` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`id_permissoes`, `descricoes`, `eliminado`) VALUES
(1, 'Administrador', 0),
(2, 'Funcionário', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `premios`
--

CREATE TABLE `premios` (
  `valor_premio` int(11) NOT NULL,
  `observacoes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `premios`
--

INSERT INTO `premios` (`valor_premio`, `observacoes`) VALUES
(0, 'Prémio não atribuído.'),
(50, 'Produtividade, Autonomia, Competência e Empenho.'),
(100, 'Trabalhador do mês');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idprodutos` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `preco_base` float NOT NULL,
  `iva` float DEFAULT NULL,
  `stock` float NOT NULL,
  `eliminado` int(11) DEFAULT '0',
  `empresa_idEmpresa` int(11) NOT NULL,
  `familia_produto_idfamilia_produto` int(11) NOT NULL,
  `preco_com_iva` float DEFAULT NULL,
  `ano_atual` year(4) DEFAULT '2019',
  `imagem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idprodutos`, `nome`, `preco_base`, `iva`, `stock`, `eliminado`, `empresa_idEmpresa`, `familia_produto_idfamilia_produto`, `preco_com_iva`, `ano_atual`, `imagem`) VALUES
(1, 'meia preta', 100, 13, 50, 0, 1, 1, 113, 2018, 0),
(2, 'meias padrao zebra', 150, 23, 300, 0, 1, 1, 184.5, 2019, 0),
(3, 'meia amarela', 100, 6, 150, 0, 1, 1, 106, 2018, 0),
(4, 'meia bebes', 100, 6, 15, 0, 1, 1, 106, 2018, 0),
(5, 'cuecas azuis', 15, 13, 200, 0, 2, 1, 9.04, 2018, 0),
(6, 'cuecas pretas', 100, 6, 150, 0, 2, 1, 106, 2019, 0),
(7, 'collants  azuis', 15, 6, 150, 0, 2, 2, 15.9, 2019, 0),
(8, 'collants amarelos', 100, 6, 155, 0, 2, 3, 106, 2019, 0),
(9, 'cÃ³llants lilas', 200, 6, 123, 0, 1, 2, 212, 2019, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `salarios`
--

CREATE TABLE `salarios` (
  `idsalarios` int(11) NOT NULL,
  `salario_base` float NOT NULL,
  `salario_atual` float NOT NULL,
  `data_salario_base` date NOT NULL,
  `eliminado` int(11) DEFAULT '0',
  `utilizadores_idlogin` int(11) NOT NULL,
  `funcionarios_idfuncionarios` int(11) NOT NULL,
  `ano_atual` year(4) DEFAULT NULL,
  `fk_empresa` int(11) DEFAULT NULL,
  `fk_premios` int(11) DEFAULT '0',
  `fk_codvencimento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `salarios`
--

INSERT INTO `salarios` (`idsalarios`, `salario_base`, `salario_atual`, `data_salario_base`, `eliminado`, `utilizadores_idlogin`, `funcionarios_idfuncionarios`, `ano_atual`, `fk_empresa`, `fk_premios`, `fk_codvencimento`) VALUES
(1, 600, 800, '2019-05-16', 0, 1, 5, 2018, 1, 50, 2),
(2, 500, 600, '2019-05-16', 0, 2, 6, 2018, 1, 0, 1),
(3, 800, 900, '2019-05-11', 0, 3, 8, 2018, 2, 0, 2),
(4, 500, 550, '2019-05-11', 0, 4, 9, 2019, 2, 50, 2),
(5, 111110, 123, '1996-12-00', 0, 5, 11, 2019, 2, 50, 2),
(6, 500, 500, '2012-12-31', 0, 8, 13, 2018, 2, 100, 4),
(7, 500, 600, '2001-12-05', 0, 7, 12, 2019, 2, 50, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `idlogin` int(11) NOT NULL,
  `utilizador` varchar(45) DEFAULT NULL,
  `fotografia` varchar(256) NOT NULL,
  `password` varchar(256) DEFAULT NULL,
  `tentativas` varchar(45) DEFAULT NULL,
  `eliminado` int(11) NOT NULL DEFAULT '0',
  `permissoes_id_permissoes` int(11) NOT NULL,
  `descricao_bloqueio_id_descricao_bloqueio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`idlogin`, `utilizador`, `fotografia`, `password`, `tentativas`, `eliminado`, `permissoes_id_permissoes`, `descricao_bloqueio_id_descricao_bloqueio`) VALUES
(1, 'admin', '1.png', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 0, 1, 1),
(2, 'Empresa', '', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 0, 1, 1),
(3, 'jorge', '', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 0, 1, 1),
(4, 'pedroantonio', '', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 0, 1, 1),
(5, 'danielsimoes', '', '*3C06A471CB6048FCCCF5DB904D8F5BE49F1C7585', '3', 0, 1, 1),
(6, 'pedromiguel', '', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '4', 0, 1, 1),
(7, 'andrécaseiro', '', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '2', 0, 1, 1),
(8, 'joaogonçalves', '', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 0, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codigo_vencimento`
--
ALTER TABLE `codigo_vencimento`
  ADD PRIMARY KEY (`idcodigo_vencimento`);

--
-- Indexes for table `descricao_bloqueio`
--
ALTER TABLE `descricao_bloqueio`
  ADD PRIMARY KEY (`id_descricao_bloqueio`);

--
-- Indexes for table `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idEmpresa`);

--
-- Indexes for table `familia_produto`
--
ALTER TABLE `familia_produto`
  ADD PRIMARY KEY (`idfamilia_produto`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`idfuncionarios`),
  ADD KEY `fk_funcionarios_utilizadores1_idx` (`utilizadores_idlogin`),
  ADD KEY `fk_funcionarios_empresa1_idx` (`empresa_idEmpresa`),
  ADD KEY `funcao` (`funcao`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`idrecords`),
  ADD KEY `fk_logs_utilizadores_idx` (`utilizadores_idlogin`);

--
-- Indexes for table `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id_permissoes`);

--
-- Indexes for table `premios`
--
ALTER TABLE `premios`
  ADD PRIMARY KEY (`valor_premio`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idprodutos`),
  ADD KEY `fk_produtos_empresa1_idx` (`empresa_idEmpresa`),
  ADD KEY `fk_produtos_familia_produto1_idx` (`familia_produto_idfamilia_produto`);

--
-- Indexes for table `salarios`
--
ALTER TABLE `salarios`
  ADD PRIMARY KEY (`idsalarios`),
  ADD KEY `fk_salarios_utilizadores1_idx` (`utilizadores_idlogin`),
  ADD KEY `fk_salarios_funcionarios1_idx` (`funcionarios_idfuncionarios`),
  ADD KEY `id_fk_empresa` (`fk_empresa`),
  ADD KEY `id_fk_premios` (`fk_premios`),
  ADD KEY `id_fk_codigo_vencimento` (`fk_codvencimento`);

--
-- Indexes for table `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`idlogin`),
  ADD KEY `fk_utilizadores_permissoes1_idx` (`permissoes_id_permissoes`),
  ADD KEY `fk_utilizadores_descricao_bloqueio1_idx` (`descricao_bloqueio_id_descricao_bloqueio`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `descricao_bloqueio`
--
ALTER TABLE `descricao_bloqueio`
  MODIFY `id_descricao_bloqueio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `idfuncionarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `idrecords` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id_permissoes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idprodutos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `salarios`
--
ALTER TABLE `salarios`
  MODIFY `idsalarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `idlogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `fk_funcionarios_empresa1` FOREIGN KEY (`empresa_idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_funcionarios_utilizadores1` FOREIGN KEY (`utilizadores_idlogin`) REFERENCES `utilizadores` (`idlogin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_logs_utilizadores` FOREIGN KEY (`utilizadores_idlogin`) REFERENCES `utilizadores` (`idlogin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fk_produtos_empresa1` FOREIGN KEY (`empresa_idEmpresa`) REFERENCES `empresa` (`idEmpresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_produtos_familia_produto1` FOREIGN KEY (`familia_produto_idfamilia_produto`) REFERENCES `familia_produto` (`idfamilia_produto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `salarios`
--
ALTER TABLE `salarios`
  ADD CONSTRAINT `fk_salarios_utilizadores1` FOREIGN KEY (`utilizadores_idlogin`) REFERENCES `utilizadores` (`idlogin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_fk_codigo_vencimento` FOREIGN KEY (`fk_codvencimento`) REFERENCES `codigo_vencimento` (`idcodigo_vencimento`),
  ADD CONSTRAINT `id_fk_codvencimento` FOREIGN KEY (`fk_codvencimento`) REFERENCES `codigo_vencimento` (`idcodigo_vencimento`),
  ADD CONSTRAINT `id_fk_empresa` FOREIGN KEY (`fk_empresa`) REFERENCES `empresa` (`idEmpresa`),
  ADD CONSTRAINT `id_fk_premios` FOREIGN KEY (`fk_premios`) REFERENCES `premios` (`valor_premio`),
  ADD CONSTRAINT `salarios_ibfk_1` FOREIGN KEY (`funcionarios_idfuncionarios`) REFERENCES `funcionarios` (`idfuncionarios`);

--
-- Limitadores para a tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD CONSTRAINT `fk_utilizadores_descricao_bloqueio1` FOREIGN KEY (`descricao_bloqueio_id_descricao_bloqueio`) REFERENCES `descricao_bloqueio` (`id_descricao_bloqueio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_utilizadores_permissoes1` FOREIGN KEY (`permissoes_id_permissoes`) REFERENCES `permissoes` (`id_permissoes`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
