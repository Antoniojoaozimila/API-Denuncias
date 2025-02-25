-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Dez-2024 às 13:11
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projectofinal-curso`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `classificacao_denuncia`
--

CREATE TABLE `classificacao_denuncia` (
  `id` int(11) NOT NULL,
  `gravidade` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `classificacao_denuncia`
--

INSERT INTO `classificacao_denuncia` (`id`, `gravidade`, `created_at`, `updated_at`) VALUES
(1, 'Alta urgência', '2024-02-25 16:08:33', NULL),
(2, 'Média urgência', '2024-02-25 16:08:33', NULL),
(3, 'Baixa urgência', '2024-02-25 16:09:27', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncia`
--

CREATE TABLE `denuncia` (
  `id` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_classificacao` int(11) NOT NULL,
  `id_municipe` int(11) NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT 1,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `localizacao` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `denuncia`
--

INSERT INTO `denuncia` (`id`, `id_tipo`, `id_classificacao`, `id_municipe`, `id_status`, `titulo`, `descricao`, `localizacao`, `created_at`, `updated_at`) VALUES
(8, 1, 1, 7, 1, 'Denuncia Teste', 'Denuncia do tipo teste', 'localizacao teste', '2024-03-30 15:53:50', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `media_denuncia`
--

CREATE TABLE `media_denuncia` (
  `id` int(11) NOT NULL,
  `id_denuncia` int(11) NOT NULL,
  `url_arquivo` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `media_denuncia`
--

INSERT INTO `media_denuncia` (`id`, `id_denuncia`, `url_arquivo`, `created_at`, `updated_at`) VALUES
(5, 8, 'denuncia_8_6608196e80515_rag-doll-with-checklist-others-with-briefcase-one-red (1).jpg', '2024-03-30 15:53:50', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `municipe`
--

CREATE TABLE `municipe` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` int(9) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `municipe`
--

INSERT INTO `municipe` (`id`, `id_usuario`, `nome`, `telefone`, `email`, `created_at`, `updated_at`) VALUES
(7, 41, 'Usuario teste', 822222222, 'usuarioteste@gmail.com', '2024-03-30 15:52:09', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status_denuncia`
--

CREATE TABLE `status_denuncia` (
  `id` int(11) NOT NULL,
  `status` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `status_denuncia`
--

INSERT INTO `status_denuncia` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Aberta', '2024-02-25 16:11:05', NULL),
(2, 'Em andamento', '2024-02-25 16:11:05', NULL),
(3, 'Em espera', '2024-02-25 16:12:08', NULL),
(4, 'Resolvida', '2024-02-25 16:12:08', NULL),
(5, 'Fechada pelo usuário', '2024-02-25 16:13:37', NULL),
(6, 'Reaberta', '2024-02-25 16:13:37', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tecnico`
--

CREATE TABLE `tecnico` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` int(9) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tecnico`
--

INSERT INTO `tecnico` (`id`, `id_usuario`, `nome`, `telefone`, `email`, `senha`, `imagem`, `created_at`, `updated_at`) VALUES
(9, 40, 'Antonio Zimila', 841111111, 'antoniojoaozimila@gmail.com', '$2y$10$mvPmRjvSmQuwWiJv6b3KA.df0egI3K0WxaOQ6pWtyVTfQBCizq9yu', 'user__6608180e7d845.jpg', '2024-03-30 15:47:59', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tecnico_denuncia`
--

CREATE TABLE `tecnico_denuncia` (
  `id` int(11) NOT NULL,
  `id_tecnico` int(11) NOT NULL,
  `id_denuncia` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tecnico_denuncia`
--

INSERT INTO `tecnico_denuncia` (`id`, `id_tecnico`, `id_denuncia`, `created_at`, `updated_at`) VALUES
(44, 9, 8, '2024-03-30 23:27:11', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_denuncia`
--

CREATE TABLE `tipo_denuncia` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tipo_denuncia`
--

INSERT INTO `tipo_denuncia` (`id`, `nome`, `created_at`, `updated_at`) VALUES
(1, 'Vazamento na via pública', '2024-02-25 16:03:18', NULL),
(2, 'Vazamento em residência', '2024-02-25 16:03:18', NULL),
(3, 'Vazamento em estabelecimento', '2024-02-25 16:04:15', NULL),
(4, 'Vazamento em rede de abastecimento público', '2024-02-25 16:04:15', NULL),
(5, 'Vazamento em instalações públicas', '2024-02-25 16:06:06', NULL),
(6, 'Vazamento em sistemas de irrigação', '2024-02-25 16:06:06', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` int(9) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `recuperar_senha` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `nivel_acesso` enum('administrador','funcionario','usuario') NOT NULL DEFAULT 'usuario',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `telefone`, `email`, `senha`, `recuperar_senha`, `imagem`, `nivel_acesso`, `created_at`, `updated_at`) VALUES
(1, 'Cripton Domingos Baloi', 823333333, 'criptonbaloi9@gmail.com', '$2y$10$i4yb9s.8OXzdWYHU4PMOHeIubgmfroJCRe304ny4ytmue86TUGyHq', NULL, NULL, 'administrador', '2024-01-16 13:25:10', NULL),
(40, 'Antonio Zimila', 841111111, 'antoniojoaozimila@gmail.com', '$2y$10$mvPmRjvSmQuwWiJv6b3KA.df0egI3K0WxaOQ6pWtyVTfQBCizq9yu', NULL, 'user__6608180e7d845.jpg', 'funcionario', '2024-03-30 15:47:58', NULL),
(41, 'Usuario teste', 822222222, 'usuarioteste@gmail.com', '$2y$10$WX6I9RGU/ExtDVORQ8etRexFK/qoqm9Zqh7S0WbUeCNy6qDTZ0O6K', NULL, NULL, 'usuario', '2024-03-30 15:52:09', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `classificacao_denuncia`
--
ALTER TABLE `classificacao_denuncia`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `denuncia`
--
ALTER TABLE `denuncia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipo_denuncia` (`id_tipo`),
  ADD KEY `fk_classificacao` (`id_classificacao`),
  ADD KEY `fk_municipe` (`id_municipe`),
  ADD KEY `fk_status_denuncia` (`id_status`);

--
-- Índices para tabela `media_denuncia`
--
ALTER TABLE `media_denuncia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_denuncias` (`id_denuncia`);

--
-- Índices para tabela `municipe`
--
ALTER TABLE `municipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_umunicipe` (`id_usuario`);

--
-- Índices para tabela `status_denuncia`
--
ALTER TABLE `status_denuncia`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tecnico`
--
ALTER TABLE `tecnico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_utecnico` (`id_usuario`);

--
-- Índices para tabela `tecnico_denuncia`
--
ALTER TABLE `tecnico_denuncia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tecnico` (`id_tecnico`),
  ADD KEY `fk_denuncia` (`id_denuncia`);

--
-- Índices para tabela `tipo_denuncia`
--
ALTER TABLE `tipo_denuncia`
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
-- AUTO_INCREMENT de tabela `classificacao_denuncia`
--
ALTER TABLE `classificacao_denuncia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `denuncia`
--
ALTER TABLE `denuncia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `media_denuncia`
--
ALTER TABLE `media_denuncia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `municipe`
--
ALTER TABLE `municipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `status_denuncia`
--
ALTER TABLE `status_denuncia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tecnico`
--
ALTER TABLE `tecnico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `tecnico_denuncia`
--
ALTER TABLE `tecnico_denuncia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `tipo_denuncia`
--
ALTER TABLE `tipo_denuncia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `denuncia`
--
ALTER TABLE `denuncia`
  ADD CONSTRAINT `fk_classificacao` FOREIGN KEY (`id_classificacao`) REFERENCES `classificacao_denuncia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_municipe` FOREIGN KEY (`id_municipe`) REFERENCES `municipe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_status_denuncia` FOREIGN KEY (`id_status`) REFERENCES `status_denuncia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipo_denuncia` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_denuncia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `media_denuncia`
--
ALTER TABLE `media_denuncia`
  ADD CONSTRAINT `fk_denuncias` FOREIGN KEY (`id_denuncia`) REFERENCES `denuncia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `municipe`
--
ALTER TABLE `municipe`
  ADD CONSTRAINT `fk_umunicipe` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tecnico`
--
ALTER TABLE `tecnico`
  ADD CONSTRAINT `fk_utecnico` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `tecnico_denuncia`
--
ALTER TABLE `tecnico_denuncia`
  ADD CONSTRAINT `fk_denuncia` FOREIGN KEY (`id_denuncia`) REFERENCES `denuncia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tecnico` FOREIGN KEY (`id_tecnico`) REFERENCES `tecnico` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
