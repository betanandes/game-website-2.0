-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08/11/2024 às 15:23
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
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantidade` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_carrinho`
--

CREATE TABLE `itens_carrinho` (
  `id` int(11) NOT NULL,
  `carrinho_id` int(11) DEFAULT NULL,
  `produto_id` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `resposta3` varchar(255) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `sexo` varchar(255) DEFAULT NULL,
  `nome_materno` varchar(255) DEFAULT NULL,
  `cpf` int(11) DEFAULT NULL,
  `telefone_celular` int(11) DEFAULT NULL,
  `telefone_fixo` int(11) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `endereco_completo` varchar(255) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `pergunta1`, `resposta1`, `resposta2`, `pergunta2`, `pergunta3`, `resposta3`, `data_nascimento`, `sexo`, `nome_materno`, `cpf`, `telefone_celular`, `telefone_fixo`, `cep`, `endereco_completo`, `login`) VALUES
(1, 'teste', 'teste@email.com', '$2y$10$Ke8Hj7GfOmeQkVeOnxwzTO.uzc4ZN3Ej5kwMUzDUVYD7mpV7nsBFS', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Roberta Fernandes', 'teste2@email.com', '$2y$10$JI8yJeWKtcohvdi2Ltn5TetaVyNPKpRS0eh8IIdPvR/CBAdady7a6', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Jean', 'teste3@email.com', '$2y$10$c6002Ug6L7mE6fJxT7G8K.aEnswIbO4dJHtq/zPPec2qptKeXXLJG', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'tigrinho', 'teste4@email.com', '$2y$10$cBtaNvDg5WuPEE2IsPOsCeEe7u1fjra7VrNyKP3Q8wu/uGOpUgFyq', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'tigrinho', 'teste4@email.com', '$2y$10$xRAgmp26r/RPz6eFgbJqjexgBtH0GS.ne4tgBFOqGZGgvNKLmOSsK', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'aaa', 'teste5@email.com', '$2y$10$tIfGFQYiM05.YJKHKPLzSO7ri4LZhKDy8i3wx2dAX/Nb5rLiQ61ly', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Roberta Fernandes', 'teste6@email.com', '$2y$10$EDBUFtUJhVQOfTcx1cdaWO5/YQPNqz6Sf./DGFCdMT0IRdgCiOhV2', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'aaa', 'teste7@email.com', '$2y$10$LBW.er381VrF7yuK8g/yRu71xLjhgh04opNaPi1tH2ClyPNrSaXGS', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'bolinho', 'teste8@email.com', '$2y$10$qsO6l1kg9.Pi79FvJIdnbeOYpksz5K5N/XOD1kBgbVpZiSBGMPq/y', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'bolinho', 'teste9@email.com', '$2y$10$PzD7foyn0ReilsqkUdhK/ufDD2CWuoGFYCr.y0pp4fIpZYgUkCPSa', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'bolinho', 'teste10@email.com', '$2y$10$S.u6fTxiVpD900.B6Y9ZiOrcvBWVoXVr3b/hND5zjD6zXLIGznJoa', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'bolinho', 'teste11@email.com', '$2y$10$xH0iYMyiNLYVi07rCHbDPuF/CAoK.IgNYry5AwYoaT0N9QBLGcDym', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'bolinho', 'teste12@email.com', '$2y$10$ptUklHdaJJgiCjKEG4Qwvutjc3HonQnh24QQhMUuomgDz363VjAle', 'Qual o nome de sua mãe?', 'bolo', 'rj', 'Em que cidade você nasceu?', 'Qual é sua data de nascimento?', '20/03/2000', '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'bolinho2', 'teste13@email.com', '$2y$10$51/pvh5UTDuXyLXeCRbq0e1QUktT5tNAVUvkdz665DDwt9O5pCYOa', 'Qual o nome de sua mãe?', 'bolo', 'Rio de Janeiro', 'Em que cidade você nasceu?', 'Qual é sua data de nascimento?', '20/03/2000', '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'bolinho3', 'teste15@email.com', '$2y$10$YuvJoTc10B0dl5G8mS/rjOr4rmqtWoFIUPHHjb7FxJkG9lKPpN9fG', 'Qual o nome de sua mãe?', 'bolo', 'Rio de Janeiro', 'Qual é o seu CEP', 'Qual é sua data de nascimento?', '20/03/2000', '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Xxxxx Fernandes Oliveira Felippe', 'robertafernandes46@gmail.com', '$2y$10$ak5WwqRyQsxuATyI4vi2QOz7Zvx7jjqxaQuceq/e2cbgkgh2u9ZWO', 'Qual o nome de sua mãe?', 'Osilda de Cassia Fernandes', '21031-620', 'Qual é o seu CEP?', 'Qual é sua data de nascimento?', '20/03/2000', '2024-10-24', 'Masculino', 'Roberta Fernandes Oliveira Felippe', 2147483647, 2147483647, 2147483647, 21031, 'Rua Pereira Landim, Ramos, Rio de Janeiro - RJ', 'zozoey'),
(18, 'Xaaabb Fernandes Oliveira Felippe', 'robertafernaxxxs46@gmail.com', '$2y$10$9m6RuW4M/64KXRipZflxduireELJrIFicDtDAW8HVEiFrNHo5G.PK', 'Qual o nome de sua mãe?', 'Osilda de Cassia Fernandes', '21031-620', 'Qual é o seu CEP?', 'Qual é sua data de nascimento?', '20/03/2000', '2024-10-01', 'Masculino', 'Roberta Fernandes Oliveira Felippe', 2147483647, 2147483647, 2147483647, 21031, 'Rua Pereira Landim, Ramos, Rio de Janeiro - RJ', 'zozoey');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario` (`usuario_id`);

--
-- Índices de tabela `itens_carrinho`
--
ALTER TABLE `itens_carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_carrinho` (`carrinho_id`),
  ADD KEY `fk_produto` (`produto_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens_carrinho`
--
ALTER TABLE `itens_carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `itens_carrinho`
--
ALTER TABLE `itens_carrinho`
  ADD CONSTRAINT `fk_carrinho` FOREIGN KEY (`carrinho_id`) REFERENCES `carrinho` (`id`),
  ADD CONSTRAINT `fk_produto` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
