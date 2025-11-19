-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/11/2025 às 00:06
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
(1, 'EcoFit Vila Mariana', '12345678000100', '1', 1, NULL),
(2, 'PowerGyn Moema', '23456789000111', '2', 2, NULL),
(3, 'EcoFit Pinheiros', '34567890000122', '3', 1, NULL),
(4, 'PowerGyn Campinas', '45678901000133', '4', 2, NULL),
(5, 'EcoFit Rio', '56789012000144', '5', 1, NULL),
(6, 'PowerGyn Salvador', '67890123000155', '6', 2, NULL);

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
(12, 'Parque da Felicidade II', 12),
(13, 'Pires', 12),
(14, 'Jardim Belvedere', 13);

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
(12, 13973, 'Rua Hortêncio Canela', 12),
(13, 13974, 'Avenida Getúlio Vargas', 13),
(14, 13601, 'Rua Prudente de Moraes', 14);

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
(12, 'Itapira', 22),
(13, 'Araras', 22);

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
(1, 'Esteira Elétrica', 150.5, 1, 'A', 'I'),
(9, 'teste2', 123, 1, 'M', 'I'),
(13, 'Cadeira', 52, 1, 'I', 'I'),
(15, 'Equipamento Novo', 845, 1, 'M', 'I'),
(16, 'Teste Novo', 457, 1, 'I', 'I'),
(17, 'sad', 23, 1, 'A', 'I'),
(19, 'asd', 12, 1, 'M', 'I'),
(32, 'Esteira Elétrica', 12.5, 1, 'I', 'I'),
(33, 'teste', 34, 1, 'I', 'I'),
(34, 'Bicicleta', 15, 1, 'I', 'I'),
(35, 'Remo', 98, 1, 'A', 'I'),
(36, 'Novo Equipamento', 84, 1, 'I', 'I'),
(37, 'FDS', 74, 1, 'A', 'I'),
(38, 'FDS DNV', 54, 1, 'A', 'I'),
(39, 'Ultimo teste', 33, 1, 'A', 'I'),
(40, 'Agora vai', 87, 1, 'A', 'I'),
(41, 'Aqui Já Foi', 84, 1, 'A', 'I'),
(42, 'Esteira Elétrica', 32, 1, 'A', 'I'),
(43, 'teste', 43, 1, 'I', 'I'),
(44, 'Teste Reset', 87, 1, 'A', 'I'),
(45, 'Testando DNV', 855, 1, 'I', 'I'),
(46, 'Teste de ID', 56, 1, 'I', 'I'),
(47, 'fffff', 12.5, 1, 'I', 'I'),
(48, 'dsf', 34, 1, 'M', 'A'),
(49, 'Teste Validate Select', 12, 1, 'A', 'I'),
(50, 'dfs', 12.5, 1, 'M', 'I'),
(51, 'Teste de ID', 12, 1, 'A', 'I'),
(52, 'novo', 32, 1, 'I', 'I'),
(53, 'aa', 11, 1, 'A', 'I'),
(54, 'Esteira Elétrica', 12.5, 1, 'A', 'I'),
(55, 'Novo Equipamento', 12.5, 1, 'I', 'I'),
(56, 'Elíptico', 12.5, 1, 'A', 'I'),
(57, 'Elíptico', 10, 1, 'I', 'I'),
(58, 'Elíptico', 10, 1, 'A', 'I'),
(59, 'Elíptico', 12.5, 1, 'I', 'I'),
(60, 'Teste', 84, 1, 'I', 'A');

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
(22, 'SP');

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
(1, 'EcoPlan', 'Plano sustentável mensal', 99.90, 30),
(2, 'PowerGyn', 'Plano premium com energia', 149.90, 30);

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
  `PERMISSAO` char(1) NOT NULL,
  `SITUACAO` char(1) NOT NULL,
  `ATIVO` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`ID_USUARIO`, `NOME`, `EMAIL`, `GENERO`, `SENHA`, `CPF`, `TELEFONE`, `DATA_NASCIMENTO`, `FK_PLANO_ID`, `FK_ACADEMIA_ID`, `FK_CEP_ID`, `NUMERO_RESIDENCIAL`, `PERMISSAO`, `SITUACAO`, `ATIVO`) VALUES
(64, 'Felipe', 'felipe@godoy', 'male', '$2y$10$SkMQEmCq6tF9VwunskRy5u0kM3p3eDRA4KIxhk2Ycz2OrUyCUKW/W', '466.987.828-07', '+84 (51) 52520-2000', NULL, NULL, NULL, 12, '123', 'U', 'M', 'A'),
(65, 'Felipe', 'felipe@gmail.com', NULL, '$2y$10$BefucxTRW9nOlbmPt7FMPOSCfwK28/vxtr3lvoyX0VkH6TTVPcfz2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 'M', 'A'),
(66, 'Rafael', 'rafael@albuquerque', 'male', '$2y$10$6VeGxg7JC0eB8zxFhy46TO28C3xLVRPmPsePSVbnstyeJOUg94aaa', '477.339.108-11', '+55 (55) 55555-5555', NULL, NULL, NULL, 14, '154', 'U', 'M', 'A');

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
  MODIFY `ID_ACADEMIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `bairro`
--
ALTER TABLE `bairro`
  MODIFY `ID_BAIRRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `cep`
--
ALTER TABLE `cep`
  MODIFY `ID_CEP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `cidade`
--
ALTER TABLE `cidade`
  MODIFY `ID_CIDADE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `equipamento`
--
ALTER TABLE `equipamento`
  MODIFY `ID_EQUIPAMENTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `ID_ESTADO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `movimento`
--
ALTER TABLE `movimento`
  MODIFY `ID_MOVIMENTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
-- Restrições para tabelas `movimento`
--
ALTER TABLE `movimento`
  ADD CONSTRAINT `FK_MOVIMENTO_EQUIPAMENTO` FOREIGN KEY (`FK_EQUIPAMENTO_ID`) REFERENCES `equipamento` (`ID_EQUIPAMENTO`),
  ADD CONSTRAINT `FK_MOVIMENTO_USUARIOS` FOREIGN KEY (`FK_USUARIO_ID`) REFERENCES `usuarios` (`ID_USUARIO`);

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
