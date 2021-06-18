-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Jun-2021 às 22:08
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crudwithviacepapi`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `idCliente` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `cpf` varchar(15) COLLATE utf8_bin NOT NULL,
  `dataNasc` date NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `endereco_idEndereco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nome`, `cpf`, `dataNasc`, `email`, `endereco_idEndereco`) VALUES
(34, 'Adonai Maciel', '11123546897', '1998-04-15', 'adonai@gmail.com', 15),
(35, 'Beatriz Silva Farias', '55879635443', '1988-05-25', 'beatrizsfarias@hotmail.com', 16),
(36, 'Antonio Farias Silva', '54788665214', '1985-07-28', 'antiniosilva@live.com', 17),
(37, 'Walter Aleixo', '02544789632', '1951-02-23', 'aleixowalter@gmail.com', 18);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `idEndereco` int(11) NOT NULL,
  `logradouro` varchar(200) COLLATE utf8_bin NOT NULL,
  `numero` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `bairro` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `cidade` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `uf` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `cep` varchar(8) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`idEndereco`, `logradouro`, `numero`, `bairro`, `cidade`, `uf`, `cep`) VALUES
(15, 'Rua Peixes', '3', 'Ulisses Guimarães', 'Porto Velho', 'RO', '76813852'),
(16, 'Rua Peixes', '36', 'Ulisses Guimarães', 'Porto Velho', 'RO', '76813852'),
(17, 'Rua Barra VelhaJardim Lancaster V', 'S/N', 'Três Bandeiras', 'Foz do Iguaçu', 'PR', '85869716'),
(18, 'Rua Aquário', '11954', 'Ulisses Guimarães', 'Porto Velho', 'RO', '76813854');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`,`endereco_idEndereco`),
  ADD KEY `fk_cliente_endereco_idx` (`endereco_idEndereco`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`idEndereco`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `idEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_cliente_endereco` FOREIGN KEY (`endereco_idEndereco`) REFERENCES `endereco` (`idEndereco`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
