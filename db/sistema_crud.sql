-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 24/11/2024 às 21:53
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
-- Estrutura para tabela `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `data_hora` datetime DEFAULT current_timestamp(),
  `acao` varchar(255) DEFAULT NULL,
  `segundo_fator` varchar(255) DEFAULT NULL,
  `passou_2fa` tinyint(1) DEFAULT NULL,
  `sucesso_login` tinyint(1) DEFAULT NULL,
  `detalhes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `acao` varchar(255) NOT NULL,
  `data_hora` datetime DEFAULT current_timestamp(),
  `detalhes` text DEFAULT NULL,
  `2fa_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `logs`
--

INSERT INTO `logs` (`id`, `usuario_id`, `acao`, `data_hora`, `detalhes`, `2fa_status`) VALUES
(1, 20, 'Tentativa de login', '2024-11-21 22:23:38', 'Usuário logou com sucesso.', 1),
(2, 20, 'Tentativa de login', '2024-11-21 22:23:49', 'Usuário logou com sucesso.', 1),
(3, 1, 'Tentativa de login', '2024-11-21 22:24:53', 'Usuário logou com sucesso.', 0),
(4, 1, 'Tentativa de login', '2024-11-21 22:27:17', 'Usuário logou com sucesso.', 0),
(5, 1, 'Tentativa de login', '2024-11-21 23:21:36', 'Usuário logou com sucesso.', 0),
(6, 1, 'Tentativa de login', '2024-11-23 12:48:05', 'Usuário logou com sucesso.', 0),
(7, 20, 'Tentativa de login', '2024-11-23 13:09:23', 'Usuário logou com sucesso.', 0),
(8, 1, 'Tentativa de login', '2024-11-23 13:09:36', 'Usuário logou com sucesso.', 0),
(9, 20, 'Tentativa de login', '2024-11-23 13:49:56', 'Usuário logou com sucesso.', 0),
(10, 1, 'Tentativa de login', '2024-11-23 13:50:11', 'Usuário logou com sucesso.', 0),
(11, 1, 'Login realizado', '2024-11-23 14:15:31', 'Usuário logou com sucesso.', 0),
(12, 1, 'Login realizado', '2024-11-23 14:15:37', 'Usuário logou com sucesso.', 0),
(13, 1, 'Login realizado', '2024-11-23 14:15:44', 'Usuário logou com sucesso.', 0),
(14, 1, 'Login realizado', '2024-11-23 14:16:58', 'Usuário logou com sucesso.', 0),
(15, 1, 'Login realizado', '2024-11-23 14:17:04', 'Usuário logou com sucesso.', 0),
(16, 1, 'Login realizado', '2024-11-23 14:48:51', 'Usuário logou com sucesso.', 0),
(17, 20, 'Login realizado', '2024-11-23 14:50:04', 'Usuário logou com sucesso.', 0),
(18, 20, 'Login realizado', '2024-11-23 14:50:19', 'Usuário logou com sucesso.', 0),
(19, 1, 'Login realizado', '2024-11-23 14:51:03', 'Usuário logou com sucesso.', 0),
(20, 1, 'Login realizado', '2024-11-23 15:04:28', 'Usuário logou com sucesso.', 1),
(21, 1, 'Tentativa login', '2024-11-23 15:17:52', 'Usuário logou com sucesso.', 1),
(22, 20, 'Tentativa login', '2024-11-23 15:18:19', 'Usuário logou com sucesso.', 1),
(23, 1, 'Tentativa login', '2024-11-23 15:18:37', 'Usuário logou com sucesso.', 1),
(24, 1, 'Tentativa login', '2024-11-23 15:41:23', 'Usuário logou com sucesso.', 1),
(25, 1, 'Tentativa login', '2024-11-23 15:52:00', 'Usuário logou com sucesso.', 0),
(26, 1, 'Tentativa login', '2024-11-23 15:58:23', 'Usuário logou com sucesso.', 0),
(27, 1, 'Tentativa login', '2024-11-23 15:59:37', 'Usuário logou com sucesso.', 0),
(28, 1, 'Tentativa login', '2024-11-23 16:05:14', 'Usuário logou com sucesso.', 0),
(29, 1, 'Tentativa login', '2024-11-23 16:05:26', 'Usuário logou com sucesso.', 0),
(30, 1, 'Tentativa login', '2024-11-23 16:10:16', 'Usuário logou com sucesso.', 0),
(31, 1, 'Tentativa login', '2024-11-24 13:43:03', 'Usuário logou com sucesso.', 0),
(32, 1, 'Tentativa login', '2024-11-24 13:51:27', 'Usuário logou com sucesso.', 0),
(33, 1, 'Tentativa login', '2024-11-24 13:51:32', 'Usuário logou com sucesso.', 0),
(34, 1, 'Tentativa login', '2024-11-24 13:54:44', 'Usuário logou com sucesso.', 0),
(35, 1, 'Tentativa login', '2024-11-24 13:54:57', 'Usuário logou com sucesso.', 0),
(36, 1, 'Tentativa login', '2024-11-24 14:08:04', 'Usuário logou com sucesso.', 0),
(37, 1, 'Tentativa login', '2024-11-24 14:08:22', 'Usuário logou com sucesso.', 0),
(38, 1, 'Tentativa login', '2024-11-24 14:08:22', 'Usuário logou com sucesso.', 0),
(39, 1, 'Tentativa login', '2024-11-24 14:09:11', 'Usuário logou com sucesso.', 0),
(40, 1, 'Tentativa login', '2024-11-24 14:18:13', 'Usuário logou com sucesso.', 0),
(41, 1, '2FA', '2024-11-24 14:18:17', 'Autenticação 2FA bem-sucedida.', 1),
(42, 1, 'Tentativa login', '2024-11-24 14:19:42', 'Usuário logou com sucesso.', 0),
(43, 1, 'Tentativa login', '2024-11-24 14:19:55', 'Usuário logou com sucesso.', 0),
(44, 1, '2FA', '2024-11-24 14:19:58', 'Autenticação 2FA bem-sucedida.', 1),
(45, 20, 'Tentativa login', '2024-11-24 14:21:14', 'Usuário logou com sucesso.', 0),
(46, 20, 'Tentativa login', '2024-11-24 14:21:25', 'Usuário logou com sucesso.', 0),
(47, 20, '2FA', '2024-11-24 14:21:28', 'Autenticação 2FA bem-sucedida.', 1),
(48, 1, 'Tentativa login', '2024-11-24 14:21:38', 'Usuário logou com sucesso.', 0),
(49, 1, '2FA', '2024-11-24 14:21:41', 'Autenticação 2FA bem-sucedida.', 1),
(50, 1, 'Tentativa login', '2024-11-24 14:27:33', 'Usuário logou com sucesso.', 0),
(51, 1, 'Tentativa login', '2024-11-24 14:27:36', 'Usuário logou com sucesso.', 1),
(52, 1, 'Tentativa login', '2024-11-24 14:31:34', 'Usuário logou com sucesso.', 0),
(53, 1, 'Tentativa login', '2024-11-24 14:31:37', 'Usuário logou com sucesso.', 1),
(54, 1, 'Tentativa login', '2024-11-24 14:41:13', 'Usuário logou com sucesso após 2FA.', 1),
(60, NULL, 'Tentativa de login falha', '2024-11-24 14:55:25', 'Email ou senha incorretos!', 0),
(61, NULL, 'Tentativa de login falha', '2024-11-24 14:55:31', 'Email ou senha incorretos!', 0),
(62, 1, 'Tentativa de 2FA falha', '2024-11-24 14:55:44', 'Resposta incorreta na verificação 2FA.', 0),
(63, 1, 'Tentativa de 2FA falha', '2024-11-24 14:55:47', 'Resposta incorreta na verificação 2FA.', 0),
(64, 1, 'Tentativa de 2FA falha', '2024-11-24 14:55:48', 'Número máximo de tentativas excedido.', 0),
(65, 1, 'Tentativa login', '2024-11-24 14:55:56', 'Usuário logou com sucesso após 2FA.', 1),
(66, 1, 'Tentativa login', '2024-11-24 14:57:37', 'Resposta incorreta na verificação 2FA.', 0),
(67, 1, 'Tentativa login', '2024-11-24 14:57:39', 'Resposta incorreta na verificação 2FA.', 0),
(68, 1, 'Tentativa login', '2024-11-24 14:57:42', 'Número máximo de tentativas excedido.', 0),
(69, 1, 'Tentativa login', '2024-11-24 14:57:50', 'Usuário logou com sucesso.', 1),
(70, 1, 'Tentativa login', '2024-11-24 15:03:05', 'Usuário logou com sucesso.', 1),
(71, 23, 'Tentativa login', '2024-11-24 15:40:55', 'Usuário logou com sucesso.', 1),
(72, 23, 'Tentativa login', '2024-11-24 15:47:57', 'Usuário logou com sucesso.', 1),
(73, 1, 'Tentativa login', '2024-11-24 16:00:57', 'Usuário logou com sucesso.', 1),
(74, 20, 'Tentativa login', '2024-11-24 16:02:18', 'Usuário logou com sucesso.', 1),
(75, NULL, 'Tentativa de login falha', '2024-11-24 16:02:33', 'Email ou senha incorretos!', 0),
(76, 1, 'Tentativa login', '2024-11-24 16:02:42', 'Usuário logou com sucesso.', 1),
(77, 23, 'Tentativa login', '2024-11-24 16:03:06', 'Usuário logou com sucesso.', 1),
(78, 1, 'Tentativa login', '2024-11-24 16:10:14', 'Usuário logou com sucesso.', 1),
(79, 1, 'Tentativa login', '2024-11-24 16:11:47', 'Usuário logou com sucesso.', 1),
(80, 1, 'Tentativa login', '2024-11-24 16:23:59', 'Usuário logou com sucesso.', 1),
(81, 20, 'Tentativa login', '2024-11-24 16:25:29', 'Usuário logou com sucesso.', 1),
(82, 1, 'Tentativa login', '2024-11-24 16:25:42', 'Resposta incorreta na verificação 2FA.', 0),
(83, 1, 'Tentativa login', '2024-11-24 16:25:46', 'Usuário logou com sucesso.', 1),
(84, 1, 'Tentativa login', '2024-11-24 16:46:25', 'Usuário logou com sucesso.', 1),
(85, 22, 'Tentativa login', '2024-11-24 17:13:29', 'Usuário logou com sucesso.', 1),
(86, NULL, 'Tentativa de login falha', '2024-11-24 17:15:15', 'Email ou senha incorretos!', 0),
(87, 1, 'Tentativa login', '2024-11-24 17:15:31', 'Resposta incorreta na verificação 2FA.', 0),
(88, 1, 'Tentativa login', '2024-11-24 17:15:36', 'Usuário logou com sucesso.', 1),
(89, NULL, 'Tentativa de login falha', '2024-11-24 17:18:39', 'Email ou senha incorretos!', 0),
(93, 1, 'Tentativa login', '2024-11-24 17:19:34', 'Resposta incorreta na verificação 2FA.', 0),
(94, 1, 'Tentativa login', '2024-11-24 17:19:55', 'Usuário logou com sucesso.', 1),
(95, NULL, 'Tentativa de login falha', '2024-11-24 17:20:28', 'Email ou senha incorretos!', 0),
(96, 1, 'Tentativa login', '2024-11-24 17:20:43', 'Resposta incorreta na verificação 2FA.', 0),
(97, 1, 'Tentativa login', '2024-11-24 17:20:49', 'Resposta incorreta na verificação 2FA.', 0),
(98, 1, 'Tentativa login', '2024-11-24 17:20:52', 'Número máximo de tentativas excedido.', 0),
(99, 1, 'Tentativa login', '2024-11-24 17:21:04', 'Usuário logou com sucesso.', 1),
(100, 25, 'Tentativa login', '2024-11-24 17:26:45', 'Usuário logou com sucesso.', 1),
(101, NULL, 'Tentativa de login falha', '2024-11-24 17:27:31', 'Email ou senha incorretos!', 0),
(102, 1, 'Tentativa login', '2024-11-24 17:27:47', 'Resposta incorreta na verificação 2FA.', 0),
(103, 1, 'Tentativa login', '2024-11-24 17:27:52', 'Resposta incorreta na verificação 2FA.', 0),
(104, 1, 'Tentativa login', '2024-11-24 17:27:56', 'Número máximo de tentativas excedido.', 0),
(105, 1, 'Tentativa login', '2024-11-24 17:28:10', 'Usuário logou com sucesso.', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `imagem`, `categoria`) VALUES
(1, 'Elden Ring', 399.90, 'assets/produtos/ELDEN-RING.avif', 'RPG'),
(2, 'Marvel’s Spider-Man 2', 349.90, 'assets/produtos/Marvel\'s Spider-Man 2.avif', 'Aventura'),
(3, 'Black Myth: Wukong', 299.90, 'assets/produtos/Black Myth-Wukong.avif', 'RPG'),
(4, 'Resident Evil Village', 184.50, 'assets/produtos/Resident Evil Village.jpeg', 'Terror'),
(5, 'Dragon Ball', 349.90, 'assets/produtos/DRAGON BALL.avif', 'Luta'),
(6, 'Dead by Daylight', 149.50, 'assets/produtos/Dead by Daylight.webp', 'Terror'),
(7, 'God of War Ragnarök', 349.90, 'assets/produtos/God of War Ragnarök.jpeg', 'Aventura'),
(8, 'Cyberpunk 2077', 249.90, 'assets/produtos/Cyberpunk 2077.webp', 'Ação'),
(9, 'Hogwarts Legacy', 249.90, 'assets/produtos/Hogwarts Legacy.webp', 'RPG'),
(10, 'Mortal Kombat 1', 249.99, 'assets/produtos/Mortal Kombat1.avif', 'Luta'),
(11, 'NARUTO X BORUTO', 149.95, 'assets/produtos/NARUTO X BORUTO Ultimate Ninja STORM CONNECTIONS.avif', 'Luta'),
(12, 'The Last of Us™ Part II', 199.50, 'assets/produtos/The Last of Us™ Part II.avif', 'Aventura');

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
  `login` varchar(100) DEFAULT NULL,
  `tipo_usuario` enum('master','comum') DEFAULT 'comum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `pergunta1`, `resposta1`, `resposta2`, `pergunta2`, `pergunta3`, `resposta3`, `data_nascimento`, `sexo`, `nome_materno`, `cpf`, `telefone_celular`, `telefone_fixo`, `cep`, `endereco_completo`, `login`, `tipo_usuario`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$vfG4a4Y7QOUjHqVR3.Z4s.7kZ.mrQow6MMhrwaCgFwDWuKc9RZXIq', 'Qual o nome de sua mãe?', 'admin', 'admin', 'Qual é o seu CEP?', 'Qual é sua data de nascimento?', 'admin', '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'master'),
(3, 'Roberta Fernandes', 'teste2@email.com', '$2y$10$JI8yJeWKtcohvdi2Ltn5TetaVyNPKpRS0eh8IIdPvR/CBAdady7a6', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'comum'),
(4, 'Jean', 'teste3@email.com', '$2y$10$c6002Ug6L7mE6fJxT7G8K.aEnswIbO4dJHtq/zPPec2qptKeXXLJG', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'comum'),
(5, 'tigrinho', 'teste4@email.com', '$2y$10$cBtaNvDg5WuPEE2IsPOsCeEe7u1fjra7VrNyKP3Q8wu/uGOpUgFyq', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'comum'),
(6, 'tigrinho', 'teste4@email.com', '$2y$10$xRAgmp26r/RPz6eFgbJqjexgBtH0GS.ne4tgBFOqGZGgvNKLmOSsK', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'comum'),
(7, 'aaa', 'teste5@email.com', '$2y$10$tIfGFQYiM05.YJKHKPLzSO7ri4LZhKDy8i3wx2dAX/Nb5rLiQ61ly', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'comum'),
(8, 'Roberta Fernandes', 'teste6@email.com', '$2y$10$EDBUFtUJhVQOfTcx1cdaWO5/YQPNqz6Sf./DGFCdMT0IRdgCiOhV2', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'comum'),
(9, 'aaa', 'teste7@email.com', '$2y$10$LBW.er381VrF7yuK8g/yRu71xLjhgh04opNaPi1tH2ClyPNrSaXGS', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'comum'),
(10, 'bolinho', 'teste8@email.com', '$2y$10$qsO6l1kg9.Pi79FvJIdnbeOYpksz5K5N/XOD1kBgbVpZiSBGMPq/y', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'comum'),
(11, 'bolinho', 'teste9@email.com', '$2y$10$PzD7foyn0ReilsqkUdhK/ufDD2CWuoGFYCr.y0pp4fIpZYgUkCPSa', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'comum'),
(12, 'bolinho', 'teste10@email.com', '$2y$10$S.u6fTxiVpD900.B6Y9ZiOrcvBWVoXVr3b/hND5zjD6zXLIGznJoa', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'comum'),
(13, 'bolinho', 'teste11@email.com', '$2y$10$xH0iYMyiNLYVi07rCHbDPuF/CAoK.IgNYry5AwYoaT0N9QBLGcDym', NULL, NULL, NULL, NULL, NULL, NULL, '2024-10-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'comum'),
(17, 'Xxxxx Fernandes Oliveira Felippe', 'robertafernandes46@gmail.com', '$2y$10$e7mTs2fCZC2HecQsLQf7rePfMUKDusTr5YORVd5XkRnPfQq7R/RCa', 'Qual o nome de sua mãe?', 'Osilda de Cassia Fernandes', '21031-620', 'Qual é o seu CEP?', 'Qual é sua data de nascimento?', '20/03/2000', '2024-10-24', 'Masculino', 'Roberta Fernandes Oliveira Felippe', 2147483647, 2147483647, 2147483647, 21031, 'Rua Pereira Landim, Ramos, Rio de Janeiro - RJ', 'zozoey', 'comum'),
(18, 'Xaaabb Fernandes Oliveira Felippe', 'robertafernaxxxs46@gmail.com', '$2y$10$9m6RuW4M/64KXRipZflxduireELJrIFicDtDAW8HVEiFrNHo5G.PK', 'Qual o nome de sua mãe?', 'Osilda de Cassia Fernandes', '21031-620', 'Qual é o seu CEP?', 'Qual é sua data de nascimento?', '20/03/2000', '2024-10-01', 'Masculino', 'Roberta Fernandes Oliveira Felippe', 2147483647, 2147483647, 2147483647, 21031, 'Rua Pereira Landim, Ramos, Rio de Janeiro - RJ', 'zozoey', 'comum'),
(19, 'Lunaaaaaaaaaaaa', 'teste1@gmail.com', '$2y$10$Ycx9LM2OpwsjFO1zBIeiVeoacyVz980iCDZnMKx1s/jkoHetEKcx.', 'Qual o nome de sua mãe?', 'bolo', '21031-620', 'Qual é o seu CEP?', 'Qual é sua data de nascimento?', '20/03/2000', '2000-03-20', 'Feminino', 'bolinho', 2147483647, 2147483647, 2147483647, 21031620, 'Rua Pereira Landim, Ramos, Rio de Janeiro - RJ', 'zozoey', 'comum'),
(20, 'aaaaaaaaaaaaaaaa', 'teste2@gmail.com', '$2y$10$k3vRUO/N6iO2bSDdFnQiDeCDRQfpfQCs9.J3I9RD4RPcUI0MMSlwu', 'Qual o nome de sua mãe?', 'bolo', '21031620', 'Qual é o seu CEP?', 'Qual é sua data de nascimento?', '20/03/2000', '2000-03-20', 'Feminino', 'bolo', 2147483647, 2147483647, 2147483647, 21031620, 'Rua Pereira Landim, Ramos, Rio de Janeiro - RJ', 'luluna', 'comum'),
(21, 'Lunaaaaaaaaaaaaaaaa', 'teste3@gmail.com', '$2y$10$Nt6CMUCx2h0X91XA4HJ57uxyx1vO.NIIWqnYcpckd0HhsgBCMF/da', 'Qual o nome de sua mãe?', 'bolo', '21031-620', 'Qual é o seu CEP?', 'Qual é sua data de nascimento?', '20/03/2000', '2000-03-20', 'Feminino', 'bolo', 2147483647, 2147483647, 2147483647, 21031, 'Rua Pereira Landim, Ramos, Rio de Janeiro - RJ', 'luluna', 'comum'),
(22, 'Roberta Fernandes Oliveira Felippe', 'teste4@gmail.com', '$2y$10$1M15IJZDvRVOL1FJsFEgIOA0x.c5L8FILBZaITYhhP0p8X4LU/OIK', 'Qual o nome de sua mãe?', 'Mamãe', '21031-620', 'Qual é o seu CEP?', 'Qual é sua data de nascimento?', '20/03/2000', '2000-03-20', 'Feminino', 'Mamãe', 2147483647, 2147483647, 2147483647, 21031, 'Rua Pereira Landim, Ramos, Rio de Janeiro - RJ', 'zozoey', 'comum'),
(23, 'Roberta Fernandes Oliveira Felippe', 'teste5@gmail.com', '$2y$10$1RSolaDI22tQCpDHlve.1e7alrLEfMTjWe7R17XhnN1MziHcbmZiK', 'Qual o nome de sua mãe?', 'Mamãe', '21031-620', 'Qual é o seu CEP?', 'Qual é sua data de nascimento?', '20/03/2000', '2000-03-20', 'Feminino', 'Mamãe', 2147483647, 2147483647, 2147483647, 21031, 'Rua Pereira Landim, Ramos, Rio de Janeiro - RJ', 'zozoey', 'comum'),
(25, 'Roberta Fernandesxxxx', 'teste30@gmail.com', '$2y$10$ji3mKrxc0MUIHELMUFvDZ.qL9SzdjiCSoNBaALMifdoER5m1A8rZG', 'Qual o nome de sua mãe?', 'zeroze', '21031-620', 'Qual é o seu CEP?', 'Qual é sua data de nascimento?', '2000-03-20', '2000-03-20', 'Masculino', 'Roberta Fernandes Oliveira Felippe', 2147483647, 2147483647, 2147483647, 21031, 'Rua Pereira Landim', 'zeroze', 'comum');

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
-- Índices de tabela `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

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
-- AUTO_INCREMENT de tabela `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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

--
-- Restrições para tabelas `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
