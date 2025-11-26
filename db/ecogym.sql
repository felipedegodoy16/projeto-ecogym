-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/11/2025 às 00:13
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecogym`
--
CREATE DATABASE IF NOT EXISTS `ecogym` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ecogym`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `academia`
--

CREATE TABLE `academia` (
  `ID_ACADEMIA` int(11) NOT NULL,
  `NOME` varchar(50) NOT NULL,
  `CNPJ` char(14) NOT NULL,
  `NUMERO_RESIDENCIAL` varchar(5) NOT NULL,
  `FK_ID_PLANO` int(11) DEFAULT NULL,
  `FK_CEP_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `academia`
--

INSERT INTO `academia` (`ID_ACADEMIA`, `NOME`, `CNPJ`, `NUMERO_RESIDENCIAL`, `FK_ID_PLANO`, `FK_CEP_ID`) VALUES
(1, 'EcoGym Paulista', '12345678000199', '125', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `bairro`
--

CREATE TABLE `bairro` (
  `ID_BAIRRO` int(11) NOT NULL,
  `BAIRRO` varchar(30) NOT NULL,
  `FK_CIDADE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `bairro`
--

INSERT INTO `bairro` (`ID_BAIRRO`, `BAIRRO`, `FK_CIDADE_ID`) VALUES
(1, 'Centro', 1),
(2, 'Botafogo', 2),
(3, 'Savassi', 3),
(4, 'Moinhos de Vento', 4),
(5, 'Batel', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cep`
--

CREATE TABLE `cep` (
  `ID_CEP` int(11) NOT NULL,
  `CEP` int(11) NOT NULL,
  `LOGRADOURO` varchar(50) NOT NULL,
  `FK_BAIRRO_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cep`
--

INSERT INTO `cep` (`ID_CEP`, `CEP`, `LOGRADOURO`, `FK_BAIRRO_ID`) VALUES
(1, 11001000, 'Rua das Palmeiras', 1),
(2, 22222000, 'Rua Voluntários', 2),
(3, 30130000, 'Av. Contorno', 3),
(4, 90520000, 'Rua Félix da Cunha', 4),
(5, 80420000, 'Av. Batel', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cidade`
--

CREATE TABLE `cidade` (
  `ID_CIDADE` int(11) NOT NULL,
  `CIDADE` varchar(30) NOT NULL,
  `FK_ESTADO_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `cidade`
--

INSERT INTO `cidade` (`ID_CIDADE`, `CIDADE`, `FK_ESTADO_ID`) VALUES
(1, 'São Paulo', 1),
(2, 'Rio de Janeiro', 2),
(3, 'Belo Horizonte', 3),
(4, 'Porto Alegre', 4),
(5, 'Curitiba', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `equipamento`
--

CREATE TABLE `equipamento` (
  `ID_EQUIPAMENTO` int(11) NOT NULL,
  `NOME` varchar(30) NOT NULL,
  `KCAL_HORA` float DEFAULT NULL,
  `FK_ACADEMIA_ID` int(11) NOT NULL,
  `SITUACAO` char(1) DEFAULT NULL,
  `ATIVO` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `equipamento`
--

INSERT INTO `equipamento` (`ID_EQUIPAMENTO`, `NOME`, `KCAL_HORA`, `FK_ACADEMIA_ID`, `SITUACAO`, `ATIVO`) VALUES
(1, 'Bicicleta Spinning A1', 420, 1, 'I', 'A'),
(2, 'Esteira Pro Run', 520, 1, 'A', 'A'),
(3, 'Elíptico MaxFit', 460, 1, 'I', 'A'),
(4, 'Remo Indoor R5', 600, 1, 'A', 'A'),
(5, 'Bicicleta Horizontal HR1', 380, 1, 'I', 'A'),
(6, 'Step Eletrônico S200', 300, 1, 'A', 'A'),
(7, 'Escada PowerClimb', 650, 1, 'A', 'A'),
(8, 'Bike Spinning X-PRO', 500, 1, 'A', 'A'),
(9, 'Esteira Runner 300', 480, 1, 'A', 'A'),
(10, 'Elíptico SoftMotion', 410, 1, 'A', 'A'),
(11, 'Remo Force R7', 590, 1, 'I', 'A'),
(12, 'Step Aeróbico Digital', 320, 1, 'A', 'A'),
(13, 'Escada Climber XT', 670, 1, 'M', 'A'),
(14, 'Corrida Air Runner', 550, 1, 'A', 'A'),
(15, 'Bike Indoor SprintMaster', 480, 1, 'A', 'A');

-- --------------------------------------------------------

--
-- Estrutura para tabela `estado`
--

CREATE TABLE `estado` (
  `ID_ESTADO` int(11) NOT NULL,
  `UF` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `estado`
--

INSERT INTO `estado` (`ID_ESTADO`, `UF`) VALUES
(1, 'SP'),
(2, 'RJ'),
(3, 'MG'),
(4, 'RS'),
(5, 'PR');

-- --------------------------------------------------------

--
-- Estrutura para tabela `exercicio`
--

CREATE TABLE `exercicio` (
  `ID_EXERCICIO` int(11) NOT NULL,
  `EXERCICIO` varchar(30) NOT NULL,
  `SERIES` int(3) NOT NULL,
  `REPETICOES` int(3) NOT NULL,
  `CARGA` int(4) NOT NULL,
  `FK_USUARIO_ID` int(11) DEFAULT NULL,
  `FK_TREINO_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `movimento`
--

CREATE TABLE `movimento` (
  `ID_MOVIMENTO` int(11) NOT NULL,
  `FK_USUARIO_ID` int(11) NOT NULL,
  `FK_EQUIPAMENTO_ID` int(11) NOT NULL,
  `INICIO` time NOT NULL,
  `FIM` time DEFAULT NULL,
  `DATA_MOVIMENTO` date NOT NULL,
  `CALORIA_GASTA` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `movimento`
--

INSERT INTO `movimento` (`ID_MOVIMENTO`, `FK_USUARIO_ID`, `FK_EQUIPAMENTO_ID`, `INICIO`, `FIM`, `DATA_MOVIMENTO`, `CALORIA_GASTA`) VALUES
(1, 3, 2, '07:10:00', '07:38:00', '2025-01-05', 248),
(2, 7, 5, '18:15:00', '18:47:00', '2025-01-11', 203),
(3, 1, 9, '06:02:00', '06:44:00', '2025-01-15', 336),
(4, 14, 4, '17:32:00', '18:10:00', '2025-01-18', 380),
(5, 12, 1, '08:10:00', '08:32:00', '2025-01-21', 154),
(6, 6, 11, '19:22:00', '19:59:00', '2025-01-22', 362),
(7, 9, 3, '16:01:00', '16:33:00', '2025-01-25', 244),
(8, 4, 13, '15:15:00', '15:43:00', '2025-01-29', 312),
(9, 5, 7, '06:30:00', '07:00:00', '2025-02-02', 325),
(10, 8, 2, '17:15:00', '17:48:00', '2025-02-05', 286),
(11, 11, 10, '19:10:00', '19:42:00', '2025-02-09', 219),
(12, 13, 3, '08:40:00', '09:15:00', '2025-02-12', 268),
(13, 15, 14, '15:22:00', '15:51:00', '2025-02-15', 265),
(14, 2, 1, '18:12:00', '18:33:00', '2025-02-19', 153),
(15, 17, 6, '07:50:00', '08:21:00', '2025-02-22', 155),
(16, 10, 12, '11:20:00', '11:46:00', '2025-02-27', 138),
(17, 4, 9, '07:00:00', '07:40:00', '2025-03-01', 320),
(18, 16, 8, '19:15:00', '19:45:00', '2025-03-03', 250),
(19, 19, 11, '06:05:00', '06:44:00', '2025-03-06', 382),
(20, 1, 4, '16:15:00', '16:44:00', '2025-03-09', 290),
(21, 3, 2, '18:22:00', '18:55:00', '2025-03-12', 282),
(22, 20, 13, '09:00:00', '09:29:00', '2025-03-19', 300),
(23, 12, 3, '15:30:00', '16:02:00', '2025-03-22', 245),
(24, 7, 6, '08:05:00', '08:35:00', '2025-03-25', 150),
(25, 14, 15, '17:40:00', '18:12:00', '2025-03-28', 256),
(26, 8, 5, '06:40:00', '07:15:00', '2025-04-03', 224),
(27, 6, 7, '18:22:00', '18:51:00', '2025-04-05', 314),
(28, 11, 4, '17:10:00', '17:44:00', '2025-04-07', 340),
(29, 10, 1, '07:15:00', '07:36:00', '2025-04-12', 150),
(30, 16, 9, '15:10:00', '15:48:00', '2025-04-13', 365),
(31, 2, 2, '19:02:00', '19:33:00', '2025-04-20', 255),
(32, 5, 8, '14:30:00', '15:00:00', '2025-04-23', 250),
(33, 18, 3, '09:05:00', '09:27:00', '2025-04-27', 210),
(34, 3, 11, '06:10:00', '06:42:00', '2025-05-01', 330),
(35, 7, 14, '19:20:00', '19:48:00', '2025-05-04', 255),
(36, 12, 10, '18:05:00', '18:36:00', '2025-05-09', 210),
(37, 15, 8, '07:33:00', '07:59:00', '2025-05-12', 220),
(38, 19, 3, '16:15:00', '16:45:00', '2025-05-18', 230),
(39, 5, 6, '17:04:00', '17:38:00', '2025-05-20', 170),
(40, 20, 1, '08:22:00', '08:43:00', '2025-05-25', 155),
(41, 1, 15, '09:10:00', '09:39:00', '2025-05-28', 232),
(42, 4, 9, '06:50:00', '07:28:00', '2025-06-02', 355),
(43, 6, 2, '17:10:00', '17:40:00', '2025-06-04', 260),
(44, 9, 7, '18:22:00', '18:55:00', '2025-06-09', 342),
(45, 8, 4, '19:05:00', '19:37:00', '2025-06-13', 338),
(46, 14, 10, '15:10:00', '15:40:00', '2025-06-16', 210),
(47, 11, 6, '06:22:00', '06:49:00', '2025-06-20', 135),
(48, 18, 12, '16:40:00', '17:15:00', '2025-06-25', 175),
(49, 7, 14, '09:55:00', '10:27:00', '2025-06-29', 265),
(50, 1, 1, '06:00:00', '06:22:00', '2025-07-01', 140),
(51, 3, 8, '18:10:00', '18:42:00', '2025-07-03', 240),
(52, 15, 5, '19:15:00', '19:44:00', '2025-07-08', 195),
(53, 10, 13, '16:50:00', '17:20:00', '2025-07-12', 290),
(54, 17, 9, '07:30:00', '08:05:00', '2025-07-18', 315),
(55, 20, 11, '18:45:00', '19:16:00', '2025-07-20', 330),
(56, 9, 4, '08:22:00', '08:57:00', '2025-07-23', 355),
(57, 12, 3, '17:10:00', '17:35:00', '2025-07-28', 210),
(58, 6, 2, '06:12:00', '06:45:00', '2025-08-01', 280),
(59, 4, 7, '19:20:00', '19:55:00', '2025-08-04', 360),
(60, 3, 14, '18:05:00', '18:31:00', '2025-08-09', 240),
(61, 8, 12, '17:02:00', '17:30:00', '2025-08-11', 155),
(62, 11, 5, '16:40:00', '17:15:00', '2025-08-15', 210),
(63, 19, 1, '07:44:00', '08:02:00', '2025-08-21', 110),
(64, 14, 10, '18:33:00', '19:02:00', '2025-08-25', 210),
(65, 17, 8, '06:50:00', '07:16:00', '2025-08-29', 220),
(66, 9, 3, '06:20:00', '06:55:00', '2025-09-02', 240),
(67, 7, 11, '19:10:00', '19:45:00', '2025-09-05', 355),
(68, 13, 7, '18:22:00', '18:55:00', '2025-09-10', 342),
(69, 15, 4, '07:15:00', '07:47:00', '2025-09-15', 360),
(70, 2, 6, '16:40:00', '17:10:00', '2025-09-19', 150),
(71, 1, 2, '08:33:00', '09:07:00', '2025-09-23', 260),
(72, 6, 9, '17:10:00', '17:42:00', '2025-09-26', 288),
(73, 12, 14, '08:20:00', '08:48:00', '2025-09-30', 255),
(74, 3, 1, '06:10:00', '06:33:00', '2025-10-01', 150),
(75, 16, 8, '19:05:00', '19:35:00', '2025-10-03', 250),
(76, 20, 13, '18:22:00', '18:49:00', '2025-10-07', 285),
(77, 7, 4, '15:20:00', '15:52:00', '2025-10-11', 350),
(78, 9, 15, '11:10:00', '11:38:00', '2025-10-15', 230),
(79, 8, 6, '07:25:00', '07:56:00', '2025-10-20', 155),
(80, 12, 12, '19:30:00', '19:58:00', '2025-10-24', 155),
(81, 5, 2, '16:40:00', '17:14:00', '2025-10-30', 270),
(82, 1, 10, '06:10:00', '06:40:00', '2025-11-02', 210),
(83, 4, 5, '19:18:00', '19:44:00', '2025-11-05', 160),
(84, 14, 3, '17:10:00', '17:45:00', '2025-11-10', 260),
(85, 10, 11, '06:30:00', '07:03:00', '2025-11-13', 310),
(86, 17, 15, '18:06:00', '18:37:00', '2025-11-18', 225),
(87, 18, 7, '08:20:00', '08:52:00', '2025-11-22', 320),
(88, 6, 9, '07:44:00', '08:16:00', '2025-11-26', 288),
(89, 12, 1, '16:22:00', '16:44:00', '2025-11-30', 154),
(90, 5, 4, '06:00:00', '06:32:00', '2025-12-01', 320),
(91, 8, 11, '19:12:00', '19:43:00', '2025-12-04', 310),
(92, 2, 7, '18:22:00', '18:55:00', '2025-12-07', 340),
(93, 9, 13, '15:30:00', '16:02:00', '2025-12-12', 350),
(94, 13, 3, '16:10:00', '16:41:00', '2025-12-15', 245),
(95, 18, 8, '07:33:00', '07:58:00', '2025-12-19', 220),
(96, 11, 5, '17:10:00', '17:40:00', '2025-12-22', 195),
(97, 20, 9, '18:44:00', '19:15:00', '2025-12-28', 290),
(98, 7, 14, '06:55:00', '07:28:00', '2025-12-29', 265),
(99, 3, 10, '08:10:00', '08:42:00', '2025-12-30', 210),
(100, 14, 2, '19:20:00', '19:50:00', '2025-12-31', 260);

-- --------------------------------------------------------

--
-- Estrutura para tabela `plano`
--

CREATE TABLE `plano` (
  `ID_PLANO` int(11) NOT NULL,
  `NOME_PLANO` varchar(30) NOT NULL,
  `DESCRICAO` varchar(100) DEFAULT NULL,
  `PRECO` float(10,2) DEFAULT NULL,
  `DURACAO_PLANO` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `plano`
--

INSERT INTO `plano` (`ID_PLANO`, `NOME_PLANO`, `DESCRICAO`, `PRECO`, `DURACAO_PLANO`) VALUES
(1, 'Mensal', 'Plano mensal básico', 99.90, 1),
(2, 'Trimestral', 'Plano trimestral com desconto', 249.90, 3),
(3, 'Anual', 'Plano anual completo', 799.90, 12);

-- --------------------------------------------------------

--
-- Estrutura para tabela `treino`
--

CREATE TABLE `treino` (
  `ID_TREINO` int(11) NOT NULL,
  `TREINO` varchar(50) NOT NULL,
  `DESCANSO` int(3) NOT NULL,
  `FK_USUARIO_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `treino`
--

INSERT INTO `treino` (`ID_TREINO`, `TREINO`, `DESCANSO`, `FK_USUARIO_ID`) VALUES
(1, 'Treino A - Pernas', 60, 1),
(2, 'Treino B - Peito/Tríceps', 90, 2),
(3, 'Treino C - Costas', 45, 3),
(4, 'Treino D - Ombros', 60, 4),
(5, 'Treino E - Braços', 75, 5),
(6, 'Treino F - Full Body', 90, 6),
(7, 'Treino G - HIIT', 30, 7),
(8, 'Treino H - Core', 50, 8),
(9, 'Treino I - Glúteos', 70, 9),
(10, 'Treino J - Resistência', 80, 10),
(11, 'Treino K - Cardio', 40, 11),
(12, 'Treino L - Mobilidade', 30, 12),
(13, 'Treino M - Hipertrofia', 90, 13),
(14, 'Treino N - Funcional', 45, 14),
(15, 'Treino O - Avançado', 120, 15);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_USUARIO` int(11) NOT NULL,
  `NOME` varchar(40) NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `GENERO` varchar(10) DEFAULT NULL,
  `SENHA` text NOT NULL,
  `CPF` char(14) DEFAULT NULL,
  `TELEFONE` char(19) DEFAULT NULL,
  `DATA_NASCIMENTO` date DEFAULT NULL,
  `FK_PLANO_ID` int(11) DEFAULT NULL,
  `FK_ACADEMIA_ID` int(11) DEFAULT NULL,
  `FK_CEP_ID` int(11) DEFAULT NULL,
  `NUMERO_RESIDENCIAL` varchar(5) DEFAULT NULL,
  `DATA_CADASTRO` date DEFAULT NULL,
  `PERMISSAO` char(1) NOT NULL,
  `SITUACAO` char(1) NOT NULL,
  `ATIVO` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `NOME`, `EMAIL`, `GENERO`, `SENHA`, `CPF`, `TELEFONE`, `DATA_NASCIMENTO`, `FK_PLANO_ID`, `FK_ACADEMIA_ID`, `FK_CEP_ID`, `NUMERO_RESIDENCIAL`, `DATA_CADASTRO`, `PERMISSAO`, `SITUACAO`, `ATIVO`) VALUES
(1, 'Carlos Silva', 'carlos.silva@gmail.com', 'Masculino', '123', '12345678901', '11988887777', '1990-01-15', 1, 1, 1, '101', '2023-05-01', 'U', 'I', 'I'),
(2, 'Ana Pereira', 'ana.pereira@gmail.com', 'Feminino', '123', '98765432100', '11999991111', '1992-03-20', 2, 1, 2, '220', '2023-04-10', 'U', 'A', 'A'),
(3, 'João Almeida', 'joao.almeida@gmail.com', 'Masculino', '123', '45678912366', '11944445555', '1988-10-08', 1, 1, 3, '300', '2023-07-18', 'U', 'A', 'A'),
(4, 'Mariana Costa', 'mariana.costa@gmail.com', 'Feminino', '123', '11223344556', '21988884444', '1995-05-07', 3, 1, 4, '180', '2023-09-05', 'U', 'A', 'A'),
(5, 'Lucas Andrade', 'lucas.andrade@gmail.com', 'Masculino', '123', '99887766554', '41977775555', '1998-12-22', 2, 1, 5, '950', '2025-11-22', 'U', 'A', 'A'),
(6, 'Fernanda Rocha', 'fernanda.rocha@gmail.com', 'Feminino', '123', '55443322119', '11966668888', '1991-06-29', 1, 1, 1, '201', '2025-03-10', 'U', 'A', 'I'),
(7, 'Ricardo Braga', 'ricardo.braga@gmail.com', 'Masculino', '123', '90909090888', '11955556666', '1985-02-14', 3, 1, 2, '102', '2025-11-11', 'U', 'I', 'A'),
(8, 'Juliana Martins', 'juliana.martins@gmail.com', 'Feminino', '123', '78787878700', '21933334444', '1994-07-03', 2, 1, 3, '50', '2023-06-02', 'U', 'I', 'A'),
(9, 'Pedro Carvalho', 'pedro.carvalho@gmail.com', 'Masculino', '123', '67676767611', '11922223333', '1993-09-28', 1, 1, 4, '600', '2023-10-11', 'U', 'A', 'A'),
(10, 'Isabela Gomes', 'isabela.gomes@gmail.com', 'Feminino', '123', '56565656588', '11911112222', '1996-08-14', 3, 1, 5, '178', '2023-08-15', 'U', 'M', 'A'),
(11, 'Roberto Nunes', 'roberto.nunes@gmail.com', 'Masculino', '123', '45454545422', '11988882222', '1989-11-11', 1, 1, 1, '725', '2023-06-21', 'U', 'A', 'A'),
(12, 'Patrícia Araujo', 'patricia.araujo@gmail.com', 'Feminino', '123', '34343434355', '21999996666', '1997-04-12', 2, 1, 2, '888', '2023-06-17', 'U', 'I', 'A'),
(13, 'Thiago Ramos', 'thiago.ramos@gmail.com', 'Masculino', '123', '23232323277', '11911114444', '1992-02-18', 3, 1, 3, '123', '2023-03-12', 'U', 'A', 'A'),
(14, 'Amanda Farias', 'amanda.farias@gmail.com', 'Feminino', '123', '12121212199', '11955553333', '1990-05-22', 1, 1, 4, '321', '2023-04-12', 'U', 'A', 'A'),
(15, 'Diego Batista', 'diego.batista@gmail.com', 'Masculino', '123', '01010101033', '21922221111', '1987-01-01', 2, 1, 5, '47', '2023-05-02', 'U', 'I', 'A'),
(16, 'Bruna Melo', 'bruna.melo@gmail.com', 'Feminino', '123', '89898989866', '31977776666', '1999-06-05', 3, 1, 1, '130', '2023-01-10', 'U', 'A', 'A'),
(17, 'Eduardo Teles', 'eduardo.teles@gmail.com', 'Masculino', '123', '78787878744', '11944443333', '1986-09-19', 1, 1, 2, '233', '2025-03-11', 'U', 'A', 'I'),
(18, 'Cláudia Moraes', 'claudia.moraes@gmail.com', 'Feminino', '123', '67676767655', '11922224444', '1993-03-01', 2, 1, 3, '345', '2023-02-28', 'U', 'I', 'I'),
(19, 'Felipe Barros', 'felipe.barros@gmail.com', 'Masculino', '123', '56565656599', '11911113333', '1995-12-12', 3, 1, 4, '556', '2023-05-19', 'U', 'I', 'A'),
(20, 'Larissa Cunha', 'larissa.cunha@gmail.com', 'Feminino', '123', '45454545411', '11944445555', '1998-10-10', 1, 1, 5, '77', '2023-04-23', 'U', 'I', 'I'),
(21, 'Felipe', 'felipe@gmail.com', NULL, '$2y$10$Yzy8jPuiiJLH8Ay7RtUMB./OB6ETQ37TDP6EvvXkbu0.yu8f/rSHW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 'M', 'A'),
(22, 'Felipe', 'felipe@godoy', NULL, '$2y$10$.OyNAjwDYxl/dOTAxcWTuuEjzFEmUDBVp4wOcvowR8oxwAGd8Y5pG', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'U', 'M', 'A');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `academia`
--
ALTER TABLE `academia`
  ADD PRIMARY KEY (`ID_ACADEMIA`),
  ADD UNIQUE KEY `CNPJ` (`CNPJ`),
  ADD KEY `FK_ACADEMIA_CEP` (`FK_CEP_ID`),
  ADD KEY `FK_PLANO_ACADEMIA` (`FK_ID_PLANO`);

--
-- Índices de tabela `bairro`
--
ALTER TABLE `bairro`
  ADD PRIMARY KEY (`ID_BAIRRO`),
  ADD KEY `FK_BAIRRO_CIDADE` (`FK_CIDADE_ID`);

--
-- Índices de tabela `cep`
--
ALTER TABLE `cep`
  ADD PRIMARY KEY (`ID_CEP`),
  ADD KEY `FK_CEP_BAIRRO` (`FK_BAIRRO_ID`);

--
-- Índices de tabela `cidade`
--
ALTER TABLE `cidade`
  ADD PRIMARY KEY (`ID_CIDADE`),
  ADD KEY `FK_CIDADE_ESTADO` (`FK_ESTADO_ID`);

--
-- Índices de tabela `equipamento`
--
ALTER TABLE `equipamento`
  ADD PRIMARY KEY (`ID_EQUIPAMENTO`),
  ADD KEY `FK_EQUIPAMENTO_ACADEMIA` (`FK_ACADEMIA_ID`);

--
-- Índices de tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`ID_ESTADO`);

--
-- Índices de tabela `exercicio`
--
ALTER TABLE `exercicio`
  ADD PRIMARY KEY (`ID_EXERCICIO`),
  ADD KEY `FK_USUARIO_ID` (`FK_USUARIO_ID`),
  ADD KEY `FK_TREINO_ID` (`FK_TREINO_ID`);

--
-- Índices de tabela `movimento`
--
ALTER TABLE `movimento`
  ADD PRIMARY KEY (`ID_MOVIMENTO`),
  ADD KEY `FK_MOVIMENTO_USUARIOS` (`FK_USUARIO_ID`),
  ADD KEY `FK_MOVIMENTO_EQUIPAMENTO` (`FK_EQUIPAMENTO_ID`);

--
-- Índices de tabela `plano`
--
ALTER TABLE `plano`
  ADD PRIMARY KEY (`ID_PLANO`);

--
-- Índices de tabela `treino`
--
ALTER TABLE `treino`
  ADD PRIMARY KEY (`ID_TREINO`),
  ADD KEY `treino_ibfk_1` (`FK_USUARIO_ID`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD UNIQUE KEY `EMAIL` (`EMAIL`),
  ADD UNIQUE KEY `CPF` (`CPF`),
  ADD KEY `FK_USUARIOS_PLANO` (`FK_PLANO_ID`),
  ADD KEY `FK_USUARIOS_ACADEMIA` (`FK_ACADEMIA_ID`),
  ADD KEY `FK_USUARIOS_CEP` (`FK_CEP_ID`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `academia`
--
ALTER TABLE `academia`
  MODIFY `ID_ACADEMIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `bairro`
--
ALTER TABLE `bairro`
  MODIFY `ID_BAIRRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `cep`
--
ALTER TABLE `cep`
  MODIFY `ID_CEP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `ID_CIDADE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `ID_EQUIPAMENTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `ID_ESTADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `exercicio`
--
ALTER TABLE `exercicio`
  MODIFY `ID_EXERCICIO` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `movimento`
--
ALTER TABLE `movimento`
  MODIFY `ID_MOVIMENTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `treino`
--
ALTER TABLE `treino`
  MODIFY `ID_TREINO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `academia`
--
ALTER TABLE `academia`
  ADD CONSTRAINT `FK_ACADEMIA_CEP` FOREIGN KEY (`FK_CEP_ID`) REFERENCES `cep` (`ID_CEP`),
  ADD CONSTRAINT `FK_PLANO_ACADEMIA` FOREIGN KEY (`FK_ID_PLANO`) REFERENCES `plano` (`ID_PLANO`);

--
-- Restrições para tabelas `bairro`
--
ALTER TABLE `bairro`
  ADD CONSTRAINT `FK_BAIRRO_CIDADE` FOREIGN KEY (`FK_CIDADE_ID`) REFERENCES `cidade` (`ID_CIDADE`);

--
-- Restrições para tabelas `cep`
--
ALTER TABLE `cep`
  ADD CONSTRAINT `FK_CEP_BAIRRO` FOREIGN KEY (`FK_BAIRRO_ID`) REFERENCES `bairro` (`ID_BAIRRO`);

--
-- Restrições para tabelas `cidade`
--
ALTER TABLE `cidade`
  ADD CONSTRAINT `FK_CIDADE_ESTADO` FOREIGN KEY (`FK_ESTADO_ID`) REFERENCES `estado` (`ID_ESTADO`);

--
-- Restrições para tabelas `equipamento`
--
ALTER TABLE `equipamento`
  ADD CONSTRAINT `FK_EQUIPAMENTO_ACADEMIA` FOREIGN KEY (`FK_ACADEMIA_ID`) REFERENCES `academia` (`ID_ACADEMIA`);

--
-- Restrições para tabelas `exercicio`
--
ALTER TABLE `exercicio`
  ADD CONSTRAINT `exercicio_ibfk_1` FOREIGN KEY (`FK_USUARIO_ID`) REFERENCES `usuarios` (`ID_USUARIO`),
  ADD CONSTRAINT `exercicio_ibfk_2` FOREIGN KEY (`FK_TREINO_ID`) REFERENCES `treino` (`ID_TREINO`);

--
-- Restrições para tabelas `movimento`
--
ALTER TABLE `movimento`
  ADD CONSTRAINT `FK_MOVIMENTO_EQUIPAMENTO` FOREIGN KEY (`FK_EQUIPAMENTO_ID`) REFERENCES `equipamento` (`ID_EQUIPAMENTO`),
  ADD CONSTRAINT `FK_MOVIMENTO_USUARIOS` FOREIGN KEY (`FK_USUARIO_ID`) REFERENCES `usuarios` (`ID_USUARIO`);

--
-- Restrições para tabelas `treino`
--
ALTER TABLE `treino`
  ADD CONSTRAINT `treino_ibfk_1` FOREIGN KEY (`FK_USUARIO_ID`) REFERENCES `usuarios` (`ID_USUARIO`);

--
-- Restrições para tabelas `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_USUARIOS_ACADEMIA` FOREIGN KEY (`FK_ACADEMIA_ID`) REFERENCES `academia` (`ID_ACADEMIA`),
  ADD CONSTRAINT `FK_USUARIOS_CEP` FOREIGN KEY (`FK_CEP_ID`) REFERENCES `cep` (`ID_CEP`),
  ADD CONSTRAINT `FK_USUARIOS_PLANO` FOREIGN KEY (`FK_PLANO_ID`) REFERENCES `plano` (`ID_PLANO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
