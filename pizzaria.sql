-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/05/2025 às 01:46
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
-- Banco de dados: `pizzaria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `mensagem` text NOT NULL,
  `data_comentario` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `totalPedido` decimal(6,2) NOT NULL,
  `idQuant` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `quantidadepiz`
--

CREATE TABLE `quantidadepiz` (
  `idQuant` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_sabor` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `saborpizpainel`
--

CREATE TABLE `saborpizpainel` (
  `idSabor` int(10) UNSIGNED NOT NULL,
  `nomeSabor` varchar(40) DEFAULT NULL,
  `descSabor` varchar(130) DEFAULT NULL,
  `precoSabor` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `saborpizpainel`
--

INSERT INTO `saborpizpainel` (`idSabor`, `nomeSabor`, `descSabor`, `precoSabor`) VALUES
(108, 'Calabresa Especial', 'Calabresa artesanal, cebola roxa, mussarela e orégano', 30.00),
(109, 'Marguerita Clássica', 'Molho de tomate, mussarela fresca, manjericão e azeite de oliva\r\n', 35.00),
(110, 'Portuguesa Tradicional', 'Presunto, ovos, cebola, ervilha, mussarela e azeitonas pretas', 56.00),
(111, 'Quatro Queijos', 'Mussarela, provolone, parmesão e gorgonzola com toque de noz-moscada', 59.00),
(112, 'Frango com Catupiry', 'Frango desfiado temperado, catupiry original e milho verde', 57.00),
(113, 'Pepperoni Supreme', 'Pepperoni importado, mussarela especial e molho picante da casa', 40.00),
(114, 'Vegetariana Gourmet', 'Berinjela, abobrinha, pimentão, tomate seco e mussarela de búfala', 58.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`);

--
-- Índices de tabela `quantidadepiz`
--
ALTER TABLE `quantidadepiz`
  ADD PRIMARY KEY (`idQuant`);

--
-- Índices de tabela `saborpizpainel`
--
ALTER TABLE `saborpizpainel`
  ADD PRIMARY KEY (`idSabor`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `quantidadepiz`
--
ALTER TABLE `quantidadepiz`
  MODIFY `idQuant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `saborpizpainel`
--
ALTER TABLE `saborpizpainel`
  MODIFY `idSabor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
