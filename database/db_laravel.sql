-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 06/08/2016 às 08:40
-- Versão do servidor: 5.6.30-1+deb.sury.org~trusty+2
-- Versão do PHP: 7.0.9-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_laravel`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_07_03_095947_create_tbmenu_table', 1),
('2016_07_03_121129_create_tbfiltro_table', 1),
('2016_07_03_123122_create_tbuf_table', 1),
('2016_07_07_084152_create_tbfornecedor_table', 1),
('2016_07_07_084540_create_tbproduto_table', 1),
('2016_07_09_113151_create_tbgrupo_table', 1),
('2016_07_09_115154_create_tbgrupo_user_table', 1),
('2016_07_10_094817_create_tbpermissao_table', 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbfiltro`
--

CREATE TABLE `tbfiltro` (
  `id` int(10) UNSIGNED NOT NULL,
  `inputs` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ordem` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `controller` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `manter_filtro` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `tbfiltro`
--

INSERT INTO `tbfiltro` (`id`, `inputs`, `ordem`, `controller`, `page`, `id_user`, `manter_filtro`, `created_at`, `updated_at`) VALUES
(304, 'filtro_codigo_fornecedor=>;filtro_nome_fornecedor=>;', 'codigo_fornecedor', 'fornecedor', 1, 5, 'N', NULL, NULL),
(305, 'filtro_grupo=>;filtro_descricao=>;', 'grupo', 'grupo', 1, 5, 'N', NULL, NULL),
(645, 'filtro_grupo=>;filtro_descricao=>;', 'grupo', 'permissao', 1, 4, 'N', NULL, NULL),
(648, 'filtro_name=>;filtro_email=>;', 'name', 'user', 1, 6, 'N', NULL, NULL),
(673, 'filtro_sigla_uf=>;filtro_nome_uf=>;', 'nome_uf', 'uf', 1, 4, 'N', NULL, NULL),
(682, 'filtro_grupo=>;filtro_descricao=>;', 'grupo', 'permissao', 1, 4, 'N', NULL, NULL),
(683, 'filtro_grupo=>;filtro_descricao=>;', 'grupo', 'grupo', 1, 4, 'S', NULL, NULL),
(707, 'filtro_confirmar=>;filtro_email=>;', 'name', 'user', 1, 5, 'N', NULL, NULL),
(708, 'filtro_grupo=>;filtro_descricao=>;', 'grupo', 'grupo', 1, 4, 'S', NULL, NULL),
(719, 'filtro_grupo=>;filtro_descricao=>;', 'grupo', 'grupo', 1, 4, 'S', NULL, NULL),
(720, 'filtro_grupo=>;filtro_descricao=>;', 'grupo', 'permissao', 1, 4, 'N', NULL, NULL),
(723, 'filtro_grupo=>;filtro_descricao=>;', 'grupo', 'permissao', 1, 4, 'N', NULL, NULL),
(724, 'filtro_grupo=>;filtro_descricao=>;', 'grupo', 'grupo', 1, 4, 'S', NULL, NULL),
(725, 'filtro_grupo=>;filtro_descricao=>;', 'grupo', 'permissao', 1, 4, 'N', NULL, NULL),
(733, 'filtro_codigo=>;filtro_nome=>;', 'codigo', 'fornecedor', 1, 4, 'S', NULL, NULL),
(740, 'filtro_codigo=>;filtro_nome=>;', 'codigo', 'fornecedor', 1, 4, 'S', NULL, NULL),
(781, 'filtro_codigo=>; filtro_descricao=>a; ', 'id_fornecedor', 'produto', 1, 4, 'N', NULL, NULL),
(782, 'filtro_nome=>;filtro_usuario=>;filtro_email=>;', 'nome', 'user', 1, 4, 'N', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbfornecedor`
--

CREATE TABLE `tbfornecedor` (
  `id_fornecedor` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `tbfornecedor`
--

INSERT INTO `tbfornecedor` (`id_fornecedor`, `codigo`, `nome`, `created_at`, `updated_at`) VALUES
(1, '01', 'forne 1', '2016-07-10 14:35:30', '2016-07-10 14:35:30'),
(2, '22', 'forne 2', '2016-07-10 14:35:52', '2016-07-10 14:35:52'),
(3, 'cb', 'Casas Bahia', '2016-07-23 13:44:54', '2016-08-06 13:12:56'),
(4, 'ad', 's', '2016-08-01 12:06:45', '2016-08-01 12:06:45'),
(5, 'AAA', 'A', '2016-08-01 12:40:29', '2016-08-01 12:40:29'),
(6, 'PR', 'prefeitura', '2016-08-06 14:01:04', '2016-08-06 14:01:04');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbgrupo`
--

CREATE TABLE `tbgrupo` (
  `id_grupo` int(10) UNSIGNED NOT NULL,
  `grupo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `tbgrupo`
--

INSERT INTO `tbgrupo` (`id_grupo`, `grupo`, `descricao`, `created_at`, `updated_at`) VALUES
(6, 'adm', 'administrativo', '2016-07-09 19:04:39', '2016-07-31 13:55:56'),
(8, 'CONTAB', 'CONTABILIDADE', '2016-07-10 12:26:46', '2016-07-10 12:26:46'),
(9, 'novo', 'novo', '2016-08-01 12:51:30', '2016-08-01 12:51:30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbgrupo_user`
--

CREATE TABLE `tbgrupo_user` (
  `id_grupo_user` int(10) UNSIGNED NOT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `tbgrupo_user`
--

INSERT INTO `tbgrupo_user` (`id_grupo_user`, `id_grupo`, `id_user`, `created_at`, `updated_at`) VALUES
(23, 8, 4, '2016-07-10 12:45:16', '2016-07-10 12:45:16'),
(24, 8, 5, '2016-07-10 12:45:16', '2016-07-10 12:45:16'),
(25, 8, 6, '2016-07-10 12:45:16', '2016-07-10 12:45:16'),
(44, 6, 4, '2016-08-06 10:08:27', '2016-08-06 10:08:27'),
(45, 6, 5, '2016-08-06 10:08:28', '2016-08-06 10:08:28');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbmenu`
--

CREATE TABLE `tbmenu` (
  `id_menu` int(10) UNSIGNED NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rota` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `acao` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `posicao` int(11) NOT NULL,
  `id_pai` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `tbmenu`
--

INSERT INTO `tbmenu` (`id_menu`, `nome`, `titulo`, `rota`, `acao`, `posicao`, `id_pai`, `created_at`, `updated_at`) VALUES
(1, 'auxiliares', 'Auxiliares', NULL, NULL, 1, NULL, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(2, 'uf', 'UF', 'uf', NULL, 1, 1, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(3, 'uf_incluir', 'Incluir', 'uf', 'incluir', 1, 2, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(4, 'uf_alterar', 'Alterar', 'uf', 'alterar', 2, 2, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(5, 'uf_excluir', 'Excluir', 'uf', 'excluir', 3, 2, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(6, 'uf_consultar', 'Consultar', 'uf', 'consultar', 4, 2, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(7, 'uf_imprimir', 'Imprimir', 'uf', 'imprimir', 5, 2, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(8, 'fornecedor', 'Fornecedor', 'fornecedor', NULL, 2, 1, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(9, 'fornecedor_incluir', 'Incluir', 'fornecedor', 'incluir', 1, 8, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(10, 'fornecedor_alterar', 'Alterar', 'fornecedor', 'alterar', 2, 8, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(11, 'fornecedor_excluir', 'Excluir', 'fornecedor', 'excluir', 3, 8, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(12, 'fornecedor_consultar', 'Consultar', 'fornecedor', 'consultar', 4, 8, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(13, 'fornecedor_imprimir', 'Imprimir', 'fornecedor', 'imprimir', 5, 8, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(14, 'produto', 'Produtos', 'produto', NULL, 3, 1, '2016-07-09 15:07:54', '2016-07-09 15:07:54'),
(15, 'produto_incluir', 'Incluir', 'produto', 'incluir', 1, 14, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(16, 'produto_alterar', 'Alterar', 'produto', 'alterar', 2, 14, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(17, 'produto_excluir', 'Excluir', 'produto', 'excluir', 3, 14, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(18, 'produto_consultar', 'Consultar', 'produto', 'consultar', 4, 14, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(19, 'produto_imprimir', 'Imprimir', 'produto', 'imprimir', 5, 14, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(20, 'clientes', 'Clientes', 'clientes', NULL, 4, 1, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(21, 'clientes_incluir', 'Incluir', 'clientes', 'incluir', 1, 20, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(22, 'clientes_alterar', 'Alterar', 'clientes', 'alterar', 2, 20, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(23, 'clientes_excluir', 'Excluir', 'clientes', 'excluir', 3, 20, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(24, 'clientes_consultar', 'Consultar', 'clientes', 'consultar', 4, 20, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(25, 'clientes_imprimir', 'Imprimir', 'clientes', 'imprimir', 5, 20, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(26, 'administrativo', 'Administrativo', NULL, NULL, 2, NULL, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(27, 'user', 'Usuários', 'user', NULL, 1, 26, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(28, 'user_incluir', 'Incluir', 'user', 'incluir', 1, 27, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(29, 'user_alterar', 'Alterar', 'user', 'alterar', 2, 27, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(30, 'user_excluir', 'Excluir', 'user', 'excluir', 3, 27, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(31, 'user_consultar', 'Consultar', 'user', 'consultar', 4, 27, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(32, 'user_imprimir', 'Imprimir', 'user', 'imprimir', 5, 27, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(33, 'grupo', 'Grupo', 'grupo', NULL, 2, 26, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(34, 'grupo_incluir', 'Incluir', 'grupo', 'incluir', 1, 33, '2016-07-09 15:07:55', '2016-07-09 15:07:55'),
(35, 'grupo_alterar', 'Alterar', 'grupo', 'alterar', 2, 33, '2016-07-09 15:07:56', '2016-07-09 15:07:56'),
(36, 'grupo_excluir', 'Excluir', 'grupo', 'excluir', 3, 33, '2016-07-09 15:07:56', '2016-07-09 15:07:56'),
(37, 'grupo_consultar', 'Consultar', 'grupo', 'consultar', 4, 33, '2016-07-09 15:07:56', '2016-07-09 15:07:56'),
(38, 'grupo_imprimir', 'Imprimir', 'grupo', 'imprimir', 5, 33, '2016-07-09 15:07:56', '2016-07-09 15:07:56'),
(39, 'permissao', 'Permissões', 'permissao', NULL, 3, 26, '2016-07-09 15:07:56', '2016-07-09 15:07:56'),
(40, 'permissao_alterar', 'Alterar', 'permissao', 'alterar', 1, 39, '2016-07-09 15:07:56', '2016-07-09 15:07:56'),
(41, 'configuracao', 'Configuração', 'configuracao', NULL, 4, 26, '2016-07-09 15:07:56', '2016-07-09 15:07:56'),
(42, 'configuracao_alterar', 'Alterar', 'configuracao', 'alterar', 1, 41, '2016-07-09 15:07:56', '2016-07-09 15:07:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbpermissao`
--

CREATE TABLE `tbpermissao` (
  `id_permissao` int(10) UNSIGNED NOT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `id_menu` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `tbpermissao`
--

INSERT INTO `tbpermissao` (`id_permissao`, `id_grupo`, `id_menu`, `created_at`, `updated_at`) VALUES
(1047, 8, 1, '2016-07-29 11:29:28', '2016-07-29 11:29:28'),
(1048, 8, 2, '2016-07-29 11:29:28', '2016-07-29 11:29:28'),
(1049, 8, 3, '2016-07-29 11:29:28', '2016-07-29 11:29:28'),
(1050, 8, 4, '2016-07-29 11:29:28', '2016-07-29 11:29:28'),
(1051, 8, 5, '2016-07-29 11:29:28', '2016-07-29 11:29:28'),
(1052, 8, 6, '2016-07-29 11:29:28', '2016-07-29 11:29:28'),
(1053, 8, 7, '2016-07-29 11:29:28', '2016-07-29 11:29:28'),
(1363, 6, 1, '2016-08-06 11:05:21', '2016-08-06 11:05:21'),
(1364, 6, 2, '2016-08-06 11:05:21', '2016-08-06 11:05:21'),
(1365, 6, 3, '2016-08-06 11:05:21', '2016-08-06 11:05:21'),
(1366, 6, 4, '2016-08-06 11:05:21', '2016-08-06 11:05:21'),
(1367, 6, 5, '2016-08-06 11:05:21', '2016-08-06 11:05:21'),
(1368, 6, 6, '2016-08-06 11:05:21', '2016-08-06 11:05:21'),
(1369, 6, 7, '2016-08-06 11:05:21', '2016-08-06 11:05:21'),
(1370, 6, 8, '2016-08-06 11:05:21', '2016-08-06 11:05:21'),
(1371, 6, 9, '2016-08-06 11:05:21', '2016-08-06 11:05:21'),
(1372, 6, 10, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1373, 6, 11, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1374, 6, 12, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1375, 6, 13, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1376, 6, 14, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1377, 6, 15, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1378, 6, 16, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1379, 6, 17, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1380, 6, 18, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1381, 6, 19, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1382, 6, 20, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1383, 6, 21, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1384, 6, 22, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1385, 6, 23, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1386, 6, 24, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1387, 6, 25, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1388, 6, 26, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1389, 6, 27, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1390, 6, 28, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1391, 6, 29, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1392, 6, 30, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1393, 6, 31, '2016-08-06 11:05:22', '2016-08-06 11:05:22'),
(1394, 6, 32, '2016-08-06 11:05:23', '2016-08-06 11:05:23'),
(1395, 6, 33, '2016-08-06 11:05:23', '2016-08-06 11:05:23'),
(1396, 6, 34, '2016-08-06 11:05:23', '2016-08-06 11:05:23'),
(1397, 6, 35, '2016-08-06 11:05:23', '2016-08-06 11:05:23'),
(1398, 6, 36, '2016-08-06 11:05:23', '2016-08-06 11:05:23'),
(1399, 6, 37, '2016-08-06 11:05:23', '2016-08-06 11:05:23'),
(1400, 6, 38, '2016-08-06 11:05:23', '2016-08-06 11:05:23'),
(1401, 6, 39, '2016-08-06 11:05:23', '2016-08-06 11:05:23'),
(1402, 6, 40, '2016-08-06 11:05:23', '2016-08-06 11:05:23'),
(1403, 6, 41, '2016-08-06 11:05:23', '2016-08-06 11:05:23'),
(1404, 6, 42, '2016-08-06 11:05:23', '2016-08-06 11:05:23');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbproduto`
--

CREATE TABLE `tbproduto` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `tbproduto`
--

INSERT INTO `tbproduto` (`id_produto`, `codigo`, `descricao`, `quantidade`, `preco`, `id_fornecedor`, `created_at`, `updated_at`) VALUES
(1, '1', 'prodUTO', NULL, NULL, 1, '2016-07-10 14:36:06', '2016-07-26 11:03:46'),
(2, 'DD', 'DFDSFSD', NULL, NULL, 2, '2016-07-26 11:02:24', '2016-07-26 11:02:24'),
(3, '03 ', 'armadura', 33, '1.99', 3, '2016-07-26 11:12:26', '2016-08-06 14:36:50'),
(4, '9', 'dsadas', NULL, NULL, 1, '2016-07-29 11:59:10', '2016-07-29 11:59:10'),
(5, '7', '77777...', NULL, NULL, 1, '2016-07-30 11:16:42', '2016-07-31 13:30:08'),
(8, 'A', 'AA', 2, '12.00', 1, '2016-08-01 12:42:21', '2016-08-06 14:36:27'),
(9, '33', '333', NULL, NULL, 5, '2016-08-01 12:42:54', '2016-08-01 12:42:54'),
(11, '2222222222', '22222222222222222', NULL, NULL, 5, '2016-08-06 14:00:38', '2016-08-06 14:00:38');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbuf`
--

CREATE TABLE `tbuf` (
  `id_uf` int(10) UNSIGNED NOT NULL,
  `sigla_uf` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `nome_uf` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `tbuf`
--

INSERT INTO `tbuf` (`id_uf`, `sigla_uf`, `nome_uf`, `created_at`, `updated_at`) VALUES
(1, 'SP', 'SÃO PAULO', '2016-07-09 17:38:36', '2016-07-26 10:53:16'),
(2, 'PR', 'PARANÁ', '2016-07-26 10:52:55', '2016-07-26 10:53:06'),
(3, 'AM', 'AMAZONAS', '2016-07-30 11:35:11', '2016-07-30 11:35:11'),
(4, 'ja', 'as....', '2016-07-30 11:43:50', '2016-07-30 11:56:10'),
(5, 'uu', 'aa', '2016-07-30 11:44:06', '2016-07-30 11:44:06'),
(6, '11', '1111...', '2016-07-30 11:55:14', '2016-07-30 13:40:10'),
(7, 'gg', 'dsfsdfdsfds', '2016-07-30 11:55:24', '2016-08-01 11:58:52'),
(8, '33', '333...', '2016-07-30 11:55:41', '2016-07-30 11:55:55'),
(9, 'dd', 'sssss', '2016-07-30 15:48:07', '2016-07-30 15:48:07'),
(10, 'kk', 'kkk', '2016-07-30 16:06:21', '2016-07-30 16:06:21'),
(11, 'yy', 'yy', '2016-07-31 10:13:56', '2016-07-31 10:13:56'),
(12, 'ds', 'sds', '2016-08-01 10:18:45', '2016-08-01 10:18:45'),
(13, 'ss', 'sss', '2016-08-01 11:27:15', '2016-08-01 11:27:15'),
(14, 'pa', 'p', '2016-08-01 11:49:27', '2016-08-01 11:49:27'),
(15, 'as', 'sssss', '2016-08-01 11:58:16', '2016-08-01 11:58:16'),
(16, 'aw', 'dasdsd', '2016-08-01 12:02:24', '2016-08-01 12:02:24'),
(17, 'AA', 'A', '2016-08-01 12:39:17', '2016-08-01 12:39:17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `master` char(1) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `usuario`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `master`) VALUES
(4, 'Moisés Nunes', 'moinunes', 'moinunes@gmail.com', 'eyJpdiI6ImJJbjlvaGprZzVmdFF3aDRuNDRub2c9PSIsInZhbHVlIjoiTUdFbTFINmhFS0RLTjRhMVBJM3V0QT09IiwibWFjIjoiZDBhNDEwYWYwMmMxZDI5ZDhkYjM5OTEyNThhYzk5MDQwNjBiODE1MTc4MWY5NTA1MTAyNzYxNWYzOTNlOTgxZSJ9', '3EJUzSpT5bnuUrNI6z5WgtEmR5HzDisSse9yYFfEw7EIFlSMqAjfK2vxiiAD', '2016-07-03 12:51:42', '2016-08-06 12:17:30', 'S'),
(5, 'Magda Bueno Pereira Nunes', 'magda', 'magdabpn@gmail.com', '$2y$10$kB0.bIqaiGIZ85Cppw3xbetRMM0DrUz1W.6ue9GLdJHuqsUWkxcla', 'l3A5uT07BSPfr6YL04fW5d2AMie6jPa1yW8pb849rZ8PjGn2JcfvFD0ahsp1', '2016-07-09 14:03:11', '2016-08-04 11:18:02', ''),
(28, 'lana', 'lana', 'lana@gmail.com', 'eyJpdiI6Impja2FHbVwvUWpjOVwvVTZ0Z3o0MXlkQT09IiwidmFsdWUiOiIwWXMxalZJZWdMYU5HWDIwREs0YUZRPT0iLCJtYWMiOiJjNWFmMWUxNjI4NWE2YjQxYmE1Zjk1NzRkZDM5ZWIxODJmZjM0NzQ5YmVlODE5YTJkMWQ1MWEzMzBjZWQ2NjdiIn0=', 'cMDVne2c06kl2cqOG3zdGLN4O5pXVPMwYad4QtlKx1DUe5oT4mY473Vk0by6', '2016-08-05 12:25:25', '2016-08-05 14:56:35', NULL),
(29, 'marta', 'marta', 'marta@gmail.com', 'eyJpdiI6ImdjXC9ybGI2RFwvXC9iaVAwZ2tscVhUdUE9PSIsInZhbHVlIjoiSzQ3TzNKS25GTmlCaGxmS2xcL0tTVHc9PSIsIm1hYyI6IjFkMzY2ODE1MTA0NzE0NTU5ZTg1Mjk0Yjg2YmZkZWIzOWVlZmI3N2QzOTdmNzYxMDk4YzU2NDVmYjg3MmU5YWQifQ==', 'omtiMfeqF18wFHLXAWSFH2OJptfmg5ryDMxBoBskN4JpdFhDaTM9Y31r47AP', '2016-08-05 15:10:54', '2016-08-05 15:11:08', NULL);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Índices de tabela `tbfiltro`
--
ALTER TABLE `tbfiltro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tbfornecedor`
--
ALTER TABLE `tbfornecedor`
  ADD PRIMARY KEY (`id_fornecedor`);

--
-- Índices de tabela `tbgrupo`
--
ALTER TABLE `tbgrupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Índices de tabela `tbgrupo_user`
--
ALTER TABLE `tbgrupo_user`
  ADD PRIMARY KEY (`id_grupo_user`);

--
-- Índices de tabela `tbmenu`
--
ALTER TABLE `tbmenu`
  ADD PRIMARY KEY (`id_menu`),
  ADD UNIQUE KEY `tbmenu_nome_unique` (`nome`);

--
-- Índices de tabela `tbpermissao`
--
ALTER TABLE `tbpermissao`
  ADD PRIMARY KEY (`id_permissao`);

--
-- Índices de tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Índices de tabela `tbuf`
--
ALTER TABLE `tbuf`
  ADD PRIMARY KEY (`id_uf`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tbfiltro`
--
ALTER TABLE `tbfiltro`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=783;
--
-- AUTO_INCREMENT de tabela `tbfornecedor`
--
ALTER TABLE `tbfornecedor`
  MODIFY `id_fornecedor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de tabela `tbgrupo`
--
ALTER TABLE `tbgrupo`
  MODIFY `id_grupo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de tabela `tbgrupo_user`
--
ALTER TABLE `tbgrupo_user`
  MODIFY `id_grupo_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de tabela `tbmenu`
--
ALTER TABLE `tbmenu`
  MODIFY `id_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de tabela `tbpermissao`
--
ALTER TABLE `tbpermissao`
  MODIFY `id_permissao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1405;
--
-- AUTO_INCREMENT de tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  MODIFY `id_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de tabela `tbuf`
--
ALTER TABLE `tbuf`
  MODIFY `id_uf` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;