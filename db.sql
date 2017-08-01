-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.14 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela prototipo_homeoffice.clientes
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_homeoffice.clientes: 2 rows
DELETE FROM `clientes`;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `nome`, `telefone`, `endereco`) VALUES
	(2, 'Francisco Mário 3', '(98) 4 9849-8498', 'rua artur bernardes');
INSERT INTO `clientes` (`id`, `nome`, `telefone`, `endereco`) VALUES
	(3, 'Maria josé 2', '(39) 4 8732-9847', 'Juvenal Lamartine');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Copiando estrutura para tabela prototipo_homeoffice.contas_pagar
DROP TABLE IF EXISTS `contas_pagar`;
CREATE TABLE IF NOT EXISTS `contas_pagar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `numero_titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fornecedor_id` int(11) NOT NULL,
  `vencimento` date NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `valor_final` decimal(12,2) NOT NULL,
  `recorrente` tinyint(4) NOT NULL DEFAULT '0',
  `recorrente_data_final` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_homeoffice.contas_pagar: 3 rows
DELETE FROM `contas_pagar`;
/*!40000 ALTER TABLE `contas_pagar` DISABLE KEYS */;
INSERT INTO `contas_pagar` (`id`, `parent_id`, `numero_titulo`, `fornecedor_id`, `vencimento`, `valor`, `valor_final`, `recorrente`, `recorrente_data_final`) VALUES
	(110, 108, 'Teste', 2, '2017-09-25', 34.34, 0.00, 0, NULL);
INSERT INTO `contas_pagar` (`id`, `parent_id`, `numero_titulo`, `fornecedor_id`, `vencimento`, `valor`, `valor_final`, `recorrente`, `recorrente_data_final`) VALUES
	(109, 108, 'Teste', 2, '2017-08-25', 34.34, 0.00, 0, NULL);
INSERT INTO `contas_pagar` (`id`, `parent_id`, `numero_titulo`, `fornecedor_id`, `vencimento`, `valor`, `valor_final`, `recorrente`, `recorrente_data_final`) VALUES
	(108, NULL, 'Teste', 2, '2017-07-25', 34.34, 0.00, 1, '2017-09-29');
INSERT INTO `contas_pagar` (`id`, `parent_id`, `numero_titulo`, `fornecedor_id`, `vencimento`, `valor`, `valor_final`, `recorrente`, `recorrente_data_final`) VALUES
	(111, NULL, 'teste', 2, '2017-07-25', 100.00, 50.00, 0, NULL);
INSERT INTO `contas_pagar` (`id`, `parent_id`, `numero_titulo`, `fornecedor_id`, `vencimento`, `valor`, `valor_final`, `recorrente`, `recorrente_data_final`) VALUES
	(112, NULL, 'T00A1', 2, '2017-07-25', 340.00, 256.45, 1, '2017-11-30');
INSERT INTO `contas_pagar` (`id`, `parent_id`, `numero_titulo`, `fornecedor_id`, `vencimento`, `valor`, `valor_final`, `recorrente`, `recorrente_data_final`) VALUES
	(116, 112, 'T00A1', 2, '2017-08-25', 340.00, 256.45, 0, NULL);
INSERT INTO `contas_pagar` (`id`, `parent_id`, `numero_titulo`, `fornecedor_id`, `vencimento`, `valor`, `valor_final`, `recorrente`, `recorrente_data_final`) VALUES
	(117, 112, 'T00A1', 2, '2017-09-25', 340.00, 256.45, 0, NULL);
INSERT INTO `contas_pagar` (`id`, `parent_id`, `numero_titulo`, `fornecedor_id`, `vencimento`, `valor`, `valor_final`, `recorrente`, `recorrente_data_final`) VALUES
	(118, 112, 'T00A1', 2, '2017-10-25', 340.00, 256.45, 0, NULL);
INSERT INTO `contas_pagar` (`id`, `parent_id`, `numero_titulo`, `fornecedor_id`, `vencimento`, `valor`, `valor_final`, `recorrente`, `recorrente_data_final`) VALUES
	(119, 112, 'T00A1', 2, '2017-11-25', 340.00, 256.45, 0, NULL);
/*!40000 ALTER TABLE `contas_pagar` ENABLE KEYS */;

-- Copiando estrutura para tabela prototipo_homeoffice.contas_pagar_descontos
DROP TABLE IF EXISTS `contas_pagar_descontos`;
CREATE TABLE IF NOT EXISTS `contas_pagar_descontos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conta_pagar_id` int(11) NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_homeoffice.contas_pagar_descontos: 2 rows
DELETE FROM `contas_pagar_descontos`;
/*!40000 ALTER TABLE `contas_pagar_descontos` DISABLE KEYS */;
INSERT INTO `contas_pagar_descontos` (`id`, `conta_pagar_id`, `descricao`, `valor`) VALUES
	(5, 108, 'b', 34.34);
INSERT INTO `contas_pagar_descontos` (`id`, `conta_pagar_id`, `descricao`, `valor`) VALUES
	(4, 108, 'a', 134.34);
INSERT INTO `contas_pagar_descontos` (`id`, `conta_pagar_id`, `descricao`, `valor`) VALUES
	(6, 111, 'tete', 50.00);
INSERT INTO `contas_pagar_descontos` (`id`, `conta_pagar_id`, `descricao`, `valor`) VALUES
	(28, 112, 'AAA', 50.00);
INSERT INTO `contas_pagar_descontos` (`id`, `conta_pagar_id`, `descricao`, `valor`) VALUES
	(27, 112, 'Teste', 33.55);
/*!40000 ALTER TABLE `contas_pagar_descontos` ENABLE KEYS */;

-- Copiando estrutura para tabela prototipo_homeoffice.contas_receber
DROP TABLE IF EXISTS `contas_receber`;
CREATE TABLE IF NOT EXISTS `contas_receber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `numero_titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fornecedor_id` int(11) NOT NULL,
  `vencimento` date NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `recorrente` tinyint(4) NOT NULL DEFAULT '0',
  `recorrente_data_final` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_homeoffice.contas_receber: 0 rows
DELETE FROM `contas_receber`;
/*!40000 ALTER TABLE `contas_receber` DISABLE KEYS */;
/*!40000 ALTER TABLE `contas_receber` ENABLE KEYS */;

-- Copiando estrutura para tabela prototipo_homeoffice.fornecedores
DROP TABLE IF EXISTS `fornecedores`;
CREATE TABLE IF NOT EXISTS `fornecedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `razao_social` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_homeoffice.fornecedores: 1 rows
DELETE FROM `fornecedores`;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` (`id`, `nome`, `razao_social`, `endereco`) VALUES
	(2, 'Construções entrega', 'Construções ME', 'Rua Paulo Silva');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;

-- Copiando estrutura para tabela prototipo_homeoffice.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_homeoffice.usuarios: 1 rows
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
	(13, 'usuario', 'usuario@email.com', '202cb962ac59075b964b07152d234b70');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
