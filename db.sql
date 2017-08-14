-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.14 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela prototipo_sistemacontas.clientes
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_sistemacontas.clientes: 2 rows
DELETE FROM `clientes`;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `nome`, `telefone`, `endereco`) VALUES
	(2, 'Francisco Mário 3', '(98) 4 9849-8498', 'rua artur bernardes'),
	(3, 'Maria josé 2', '(39) 4 8732-9847', 'Juvenal Lamartine');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;

-- Copiando estrutura para tabela prototipo_sistemacontas.contas
DROP TABLE IF EXISTS `contas`;
CREATE TABLE IF NOT EXISTS `contas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `valor` decimal(8,2) DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_sistemacontas.contas: 2 rows
DELETE FROM `contas`;
/*!40000 ALTER TABLE `contas` DISABLE KEYS */;
INSERT INTO `contas` (`id`, `descricao`, `valor`) VALUES
	(1, 'Pagamento Teste', 25.50),
	(2, 'Pagamento 2 ', 50.55);
/*!40000 ALTER TABLE `contas` ENABLE KEYS */;

-- Copiando estrutura para tabela prototipo_sistemacontas.contas_pagar
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
) ENGINE=MyISAM AUTO_INCREMENT=136 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_sistemacontas.contas_pagar: 4 rows
DELETE FROM `contas_pagar`;
/*!40000 ALTER TABLE `contas_pagar` DISABLE KEYS */;
INSERT INTO `contas_pagar` (`id`, `parent_id`, `numero_titulo`, `fornecedor_id`, `vencimento`, `valor`, `valor_final`, `recorrente`, `recorrente_data_final`) VALUES
	(136, NULL, 'Teste3', 2, '2017-08-16', 555.55, 555.55, 0, NULL),
	(135, 108, 'Teste', 2, '2017-09-14', 34.34, 1.34, 0, NULL),
	(108, NULL, 'Teste', 2, '2017-08-14', 34.34, 1.34, 1, '2017-09-29'),
	(111, NULL, 'teste', 2, '2017-08-14', 100.00, 66.67, 0, NULL),
	(112, NULL, 'T00A1', 2, '2017-09-14', 340.00, 340.00, 0, '2017-10-31');
/*!40000 ALTER TABLE `contas_pagar` ENABLE KEYS */;

-- Copiando estrutura para tabela prototipo_sistemacontas.contas_pagar_descontos
DROP TABLE IF EXISTS `contas_pagar_descontos`;
CREATE TABLE IF NOT EXISTS `contas_pagar_descontos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conta_pagar_id` int(11) NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_sistemacontas.contas_pagar_descontos: 2 rows
DELETE FROM `contas_pagar_descontos`;
/*!40000 ALTER TABLE `contas_pagar_descontos` DISABLE KEYS */;
INSERT INTO `contas_pagar_descontos` (`id`, `conta_pagar_id`, `descricao`, `valor`) VALUES
	(41, 108, 'Abc', 33.00),
	(37, 111, 'aa', 33.33);
/*!40000 ALTER TABLE `contas_pagar_descontos` ENABLE KEYS */;

-- Copiando estrutura para tabela prototipo_sistemacontas.contas_receber
DROP TABLE IF EXISTS `contas_receber`;
CREATE TABLE IF NOT EXISTS `contas_receber` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `numero_titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `vencimento` date NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  `valor_final` decimal(12,2) NOT NULL,
  `recorrente` tinyint(4) NOT NULL DEFAULT '0',
  `recorrente_data_final` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_sistemacontas.contas_receber: 1 rows
DELETE FROM `contas_receber`;
/*!40000 ALTER TABLE `contas_receber` DISABLE KEYS */;
INSERT INTO `contas_receber` (`id`, `parent_id`, `numero_titulo`, `cliente_id`, `vencimento`, `valor`, `valor_final`, `recorrente`, `recorrente_data_final`) VALUES
	(1, NULL, 'TTTEE', 2, '2017-08-14', 434.34, 431.01, 0, NULL),
	(2, NULL, 'Teste 3', 2, '2017-08-17', 500.00, 500.00, 0, NULL),
	(3, NULL, 'Teste #5', 3, '2017-09-14', 444.44, 444.44, 0, NULL);
/*!40000 ALTER TABLE `contas_receber` ENABLE KEYS */;

-- Copiando estrutura para tabela prototipo_sistemacontas.contas_receber_descontos
DROP TABLE IF EXISTS `contas_receber_descontos`;
CREATE TABLE IF NOT EXISTS `contas_receber_descontos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `conta_receber_id` int(11) NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `valor` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_sistemacontas.contas_receber_descontos: 1 rows
DELETE FROM `contas_receber_descontos`;
/*!40000 ALTER TABLE `contas_receber_descontos` DISABLE KEYS */;
INSERT INTO `contas_receber_descontos` (`id`, `conta_receber_id`, `descricao`, `valor`) VALUES
	(1, 1, 'abc', 3.33);
/*!40000 ALTER TABLE `contas_receber_descontos` ENABLE KEYS */;

-- Copiando estrutura para tabela prototipo_sistemacontas.fornecedores
DROP TABLE IF EXISTS `fornecedores`;
CREATE TABLE IF NOT EXISTS `fornecedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `razao_social` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_sistemacontas.fornecedores: 1 rows
DELETE FROM `fornecedores`;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` (`id`, `nome`, `razao_social`, `endereco`) VALUES
	(2, 'Construções entrega', 'Construções ME', 'Rua Paulo Silva');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;

-- Copiando estrutura para tabela prototipo_sistemacontas.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela prototipo_sistemacontas.usuarios: 1 rows
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
	(13, 'Admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3'),
	(14, 'Usuário', 'usuario@usuario.com', '202cb962ac59075b964b07152d234b70');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
