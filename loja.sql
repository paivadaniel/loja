-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Ago-2022 às 21:18
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `loja`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carac`
--

CREATE TABLE `carac` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nome_url` varchar(50) NOT NULL,
  `imagem` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `nome_url`, `imagem`) VALUES
(1, 'categoria teste bica', 'categoria-teste-bica', 'categoria-teste.jpg'),
(2, 'Moda feminina da juju', 'moda-feminina-da-juju', ''),
(3, 'galo-teste', 'galo-teste', 'sem-foto.jpg'),
(4, 'cerveja 2', 'cerveja-2', 'sem-foto.jpg'),
(5, 'Laranja', '', 'laranja-01.jpg'),
(8, 'doces coloridos da tia mafalda', 'doces-coloridos-da-tia-mafalda', 'sem-foto.jpg'),
(9, 'tetsfsf 2', 'tetsfsf-2', 'laranja-01.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(55) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(55) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `logradouro` varchar(75) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `estado` varchar(5) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `pais` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `email`, `telefone`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`, `pais`) VALUES
(1, 'Adamastor Pereira', '919.191.991-11', 'pereira@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `nome` varchar(75) DEFAULT NULL,
  `email` varchar(75) NOT NULL,
  `ativo` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `emails`
--

INSERT INTO `emails` (`id`, `nome`, `email`, `ativo`) VALUES
(1, 'Marley Junior Aparecido', 'paiva.s2.paula@hotmail.com', 'Sim'),
(3, 'Marley Junior', 'admin@gmail.com', 'Sim'),
(4, 'cadada', 'jj@gmail.com', 'Sim'),
(5, 'Marley Junior', 'ped@hotmail.com', 'Sim'),
(6, 'Marley Junior Aparecido', 'ped2@hotmail.com', 'Sim'),
(7, 'Miséria', 'ped3@hotmail.com', 'Sim'),
(8, 'aadadad', 'afafafa@mgail.com', 'Sim'),
(9, 'Marcelo Madureira', 'madureira@gmail.com', 'Sim'),
(11, 'Mardoque', 'mardoqueu@gmail.com', 'Sim'),
(12, 'Adamastor Pereira', 'pereira@gmail.com', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

CREATE TABLE `imagens` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `imagens`
--

INSERT INTO `imagens` (`id`, `id_produto`, `imagem`) VALUES
(4, 4, 'cat-1.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_subcategoria` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nome_url` varchar(100) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `descricao_longa` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `estoque` int(11) NOT NULL,
  `tipo_envio` int(11) NOT NULL,
  `palavras` varchar(250) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `peso` double(8,2) DEFAULT NULL,
  `largura` double(8,2) DEFAULT NULL,
  `altura` double(8,2) DEFAULT NULL,
  `comprimento` double(8,2) DEFAULT NULL,
  `modelo` varchar(100) NOT NULL,
  `valor_frete` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `id_categoria`, `id_subcategoria`, `nome`, `nome_url`, `descricao`, `descricao_longa`, `valor`, `imagem`, `estoque`, `tipo_envio`, `palavras`, `ativo`, `peso`, `largura`, `altura`, `comprimento`, `modelo`, `valor_frete`) VALUES
(2, 5, 6, 'Pão de Mel com Chocolate', 'pao-de-mel-com-chocolate', 'Teste', 'Comida de doce', '53.45', 'doces-coloridos.jpg', 45, 2, 'pão de mel doce, pão de mel gostoso, comprar pão de mel', 'Sim', 23.00, 32.00, 12.00, 24.00, 'doce', '32.00'),
(3, 1, 3, 'dadada', 'dadada', '', '', '41.00', 'sem-foto.jpg', 0, 1, '', 'Sim', 0.00, 0.00, 0.00, 0.00, '', '0.00'),
(4, 1, 3, 'ffsfs', 'ffsfs', '', '', '24.00', 'sem-foto.jpg', 0, 1, '', 'Não', 0.00, 0.00, 0.00, 0.00, '', '0.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `subcategorias`
--

CREATE TABLE `subcategorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `nome_url` varchar(50) NOT NULL,
  `imagem` varchar(150) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `subcategorias`
--

INSERT INTO `subcategorias` (`id`, `nome`, `nome_url`, `imagem`, `id_categoria`) VALUES
(1, 'tênis', 'tenis', 'cat-6.jpg', 2),
(2, 'tênis 2', 'tenis-2', 'cat-5.jpg', 8),
(3, 'dindu', 'dindu', 'sem-foto.jpg', 1),
(4, 'deido', 'deido', 'garrafa-de-cerveja-pequena-à-disposição-92840768.jpg', 5),
(6, 'bund', 'bund', 'sem-foto.jpg', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_envios`
--

CREATE TABLE `tipo_envios` (
  `id` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_envios`
--

INSERT INTO `tipo_envios` (`id`, `tipo`) VALUES
(1, 'correios'),
(2, 'valor fixo'),
(3, 'sem frete'),
(4, 'digital');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(75) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(25) NOT NULL,
  `senha_crip` varchar(150) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `data_cad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `email`, `senha`, `senha_crip`, `nivel`, `data_cad`) VALUES
(6, 'Admin Novo', '000.000.000-00', 'danielantunespaiva@gmail.com', '123', '202cb962ac59075b964b07152d234b70', 'Administrador', '2022-08-08'),
(15, 'Marcelo Madureira', '103.931.093-10', 'madureira@gmail.com', '123', '202cb962ac59075b964b07152d234b70', 'Cliente', '2022-08-08'),
(16, 'Mardoque', '111.111.111-11', 'mardoqueu@gmail.com', '123', '202cb962ac59075b964b07152d234b70', 'Cliente', '2022-08-08'),
(18, 'Adamastor Pereira', '919.191.991-11', 'pereira@gmail.com', '123', '202cb962ac59075b964b07152d234b70', 'Cliente', '2022-08-08');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carac`
--
ALTER TABLE `carac`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tipo_envios`
--
ALTER TABLE `tipo_envios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carac`
--
ALTER TABLE `carac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `subcategorias`
--
ALTER TABLE `subcategorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tipo_envios`
--
ALTER TABLE `tipo_envios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
