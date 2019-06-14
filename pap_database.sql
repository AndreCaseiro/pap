-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Abr-2019 às 12:34
-- Versão do servidor: 10.1.35-MariaDB
-- versão do PHP: 7.2.9

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
CREATE DATABASE IF NOT EXISTS `pap_database` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `pap_database`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `codigo_vencimento`
--

CREATE TABLE `codigo_vencimento` (
  `idcodigo_vencimento` int(11) NOT NULL,
  `funcao` varchar(245) DEFAULT NULL,
  `salario_base` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `descricao_bloqueio`
--

CREATE TABLE `descricao_bloqueio` (
  `id_descricao_bloqueio` int(11) NOT NULL,
  `descricoes` varchar(256) DEFAULT NULL,
  `eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `descricao_bloqueio`
--

INSERT INTO `descricao_bloqueio` (`id_descricao_bloqueio`, `descricoes`, `eliminado`) VALUES
(1, 'Ativo', NULL),
(2, 'Bloqueado', NULL);

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
(1, 'dara', 'padrao', 'pedro', '123456789');

-- --------------------------------------------------------

--
-- Estrutura da tabela `faltas`
--

CREATE TABLE `faltas` (
  `idfaltas` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `eliminado` int(11) DEFAULT NULL,
  `utilizadores_idlogin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `familia_produto`
--

CREATE TABLE `familia_produto` (
  `idfamilia_produto` int(11) NOT NULL,
  `familia` varchar(256) DEFAULT NULL,
  `eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `familia_produto`
--

INSERT INTO `familia_produto` (`idfamilia_produto`, `familia`, `eliminado`) VALUES
(1, 'meias', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `idfuncionarios` int(11) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `idade` date DEFAULT NULL,
  `bi` varchar(8) NOT NULL,
  `data_admicao` date NOT NULL,
  `eliminado` int(11) DEFAULT NULL,
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

INSERT INTO `funcionarios` (`idfuncionarios`, `nome`, `idade`, `bi`, `data_admicao`, `eliminado`, `funcao`, `utilizadores_idlogin`, `empresa_idEmpresa`, `endereco`, `email`, `cidade`, `telemovel`) VALUES
(1, 'pedro', '1971-11-11', '12345678', '2019-03-06', 0, 'patrao', 1, 1, 'Rua do teste N5', 'teste@gmail.com', 'coimbra', 912345678);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `idrecords` int(11) NOT NULL,
  `dateIn` date DEFAULT NULL,
  `dateOut` date DEFAULT NULL,
  `eliminado` int(11) DEFAULT NULL,
  `utilizadores_idlogin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`idrecords`, `dateIn`, `dateOut`, `eliminado`, `utilizadores_idlogin`) VALUES
(1, '2019-03-22', NULL, NULL, 1),
(2, '2019-03-22', NULL, NULL, 1),
(3, '2019-03-22', NULL, NULL, 2),
(4, '2019-04-15', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `id_permissoes` int(11) NOT NULL,
  `descricoes` varchar(256) DEFAULT NULL,
  `eliminado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`id_permissoes`, `descricoes`, `eliminado`) VALUES
(1, 'Administrador', NULL),
(2, 'Funcionario', NULL);

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
  `eliminado` int(11) DEFAULT NULL,
  `empresa_idEmpresa` int(11) NOT NULL,
  `familia_produto_idfamilia_produto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idprodutos`, `nome`, `preco_base`, `iva`, `stock`, `eliminado`, `empresa_idEmpresa`, `familia_produto_idfamilia_produto`) VALUES
(1, 'meia preta', 15, 15, 100, NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `salarios`
--

CREATE TABLE `salarios` (
  `idsalarios` int(11) NOT NULL,
  `salario_base` float NOT NULL,
  `salario_atual` float NOT NULL,
  `data_salario_base` date NOT NULL,
  `eliminado` int(11) DEFAULT NULL,
  `utilizadores_idlogin` int(11) NOT NULL,
  `funcionarios_idfuncionarios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `eliminado` int(11) NOT NULL,
  `permissoes_id_permissoes` int(11) NOT NULL,
  `descricao_bloqueio_id_descricao_bloqueio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`idlogin`, `utilizador`, `fotografia`, `password`, `tentativas`, `eliminado`, `permissoes_id_permissoes`, `descricao_bloqueio_id_descricao_bloqueio`) VALUES
(1, 'admin', '', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 0, 1, 1),
(2, 'manuel', '', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '3', 0, 2, 1);

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
-- Indexes for table `faltas`
--
ALTER TABLE `faltas`
  ADD PRIMARY KEY (`idfaltas`),
  ADD KEY `fk_faltas_utilizadores1_idx` (`utilizadores_idlogin`);

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
  ADD KEY `fk_funcionarios_empresa1_idx` (`empresa_idEmpresa`);

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
  ADD KEY `fk_salarios_funcionarios1_idx` (`funcionarios_idfuncionarios`);

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
-- AUTO_INCREMENT for table `faltas`
--
ALTER TABLE `faltas`
  MODIFY `idfaltas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `idrecords` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id_permissoes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idprodutos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salarios`
--
ALTER TABLE `salarios`
  MODIFY `idsalarios` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `idlogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `faltas`
--
ALTER TABLE `faltas`
  ADD CONSTRAINT `fk_faltas_utilizadores1` FOREIGN KEY (`utilizadores_idlogin`) REFERENCES `utilizadores` (`idlogin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_salarios_funcionarios1` FOREIGN KEY (`funcionarios_idfuncionarios`) REFERENCES `funcionarios` (`idfuncionarios`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_salarios_utilizadores1` FOREIGN KEY (`utilizadores_idlogin`) REFERENCES `utilizadores` (`idlogin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
