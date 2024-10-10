-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 10/10/2024 às 21:03
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
-- Banco de dados: `sistema_crud`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `pergunta1` varchar(255) DEFAULT NULL,
  `resposta1` varchar(255) DEFAULT NULL,
  `resposta2` varchar(255) DEFAULT NULL,
  `pergunta2` varchar(255) DEFAULT NULL,
  `pergunta3` varchar(255) DEFAULT NULL,
  `resposta3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `pergunta1`, `resposta1`, `resposta2`, `pergunta2`, `pergunta3`, `resposta3`) VALUES
(1, 'teste', 'teste@email.com', '$2y$10$Ke8Hj7GfOmeQkVeOnxwzTO.uzc4ZN3Ej5kwMUzDUVYD7mpV7nsBFS', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Roberta Fernandes', 'teste2@email.com', '$2y$10$JI8yJeWKtcohvdi2Ltn5TetaVyNPKpRS0eh8IIdPvR/CBAdady7a6', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Jean', 'teste3@email.com', '$2y$10$c6002Ug6L7mE6fJxT7G8K.aEnswIbO4dJHtq/zPPec2qptKeXXLJG', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'tigrinho', 'teste4@email.com', '$2y$10$cBtaNvDg5WuPEE2IsPOsCeEe7u1fjra7VrNyKP3Q8wu/uGOpUgFyq', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'tigrinho', 'teste4@email.com', '$2y$10$xRAgmp26r/RPz6eFgbJqjexgBtH0GS.ne4tgBFOqGZGgvNKLmOSsK', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'aaa', 'teste5@email.com', '$2y$10$tIfGFQYiM05.YJKHKPLzSO7ri4LZhKDy8i3wx2dAX/Nb5rLiQ61ly', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Roberta Fernandes', 'teste6@email.com', '$2y$10$EDBUFtUJhVQOfTcx1cdaWO5/YQPNqz6Sf./DGFCdMT0IRdgCiOhV2', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'aaa', 'teste7@email.com', '$2y$10$LBW.er381VrF7yuK8g/yRu71xLjhgh04opNaPi1tH2ClyPNrSaXGS', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'bolinho', 'teste8@email.com', '$2y$10$qsO6l1kg9.Pi79FvJIdnbeOYpksz5K5N/XOD1kBgbVpZiSBGMPq/y', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'bolinho', 'teste9@email.com', '$2y$10$PzD7foyn0ReilsqkUdhK/ufDD2CWuoGFYCr.y0pp4fIpZYgUkCPSa', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'bolinho', 'teste10@email.com', '$2y$10$S.u6fTxiVpD900.B6Y9ZiOrcvBWVoXVr3b/hND5zjD6zXLIGznJoa', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'bolinho', 'teste11@email.com', '$2y$10$xH0iYMyiNLYVi07rCHbDPuF/CAoK.IgNYry5AwYoaT0N9QBLGcDym', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'bolinho', 'teste12@email.com', '$2y$10$ptUklHdaJJgiCjKEG4Qwvutjc3HonQnh24QQhMUuomgDz363VjAle', 'Qual o nome de sua mãe?', 'bolo', 'rj', 'Em que cidade você nasceu?', 'Qual é sua data de nascimento?', '20/03/2000'),
(15, 'bolinho2', 'teste13@email.com', '$2y$10$51/pvh5UTDuXyLXeCRbq0e1QUktT5tNAVUvkdz665DDwt9O5pCYOa', 'Qual o nome de sua mãe?', 'bolo', 'Rio de Janeiro', 'Em que cidade você nasceu?', 'Qual é sua data de nascimento?', '20/03/2000');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
