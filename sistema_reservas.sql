-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.26 - MySQL Community Server (GPL)
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para sistema_reservas
CREATE DATABASE IF NOT EXISTS `sistema_reservas` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sistema_reservas`;

-- Copiando estrutura para tabela sistema_reservas.carros
CREATE TABLE IF NOT EXISTS `carros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `placa` varchar(8) NOT NULL,
  `preco_dia` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_reservas.carros: ~8 rows (aproximadamente)
DELETE FROM `carros`;
/*!40000 ALTER TABLE `carros` DISABLE KEYS */;
INSERT INTO `carros` (`id`, `nome`, `placa`, `preco_dia`) VALUES
	(1, 'Corsa', 'MIT-3752', 50.00),
	(2, 'HB20', 'QHP-3786', 75.00),
	(3, 'Palio', 'MGI-3434', 47.00),
	(4, 'Fusion', 'MFD-2385', 170.00),
	(5, 'Corolla', 'PQP-6767', 110.00),
	(6, 'Fusca', 'GAY-2424', 30.00),
	(7, 'Hilux', 'VSF-3040', 150.00),
	(8, 'Camaro', 'KLS-4820', 200.00),
	(9, 'Gol', 'SDN-5389', 37.90),
	(10, 'Punto', 'NDF-2784', 30.50);
/*!40000 ALTER TABLE `carros` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_reservas.pessoas
CREATE TABLE IF NOT EXISTS `pessoas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `telefone` varchar(19) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_reservas.pessoas: 9 rows
DELETE FROM `pessoas`;
/*!40000 ALTER TABLE `pessoas` DISABLE KEYS */;
INSERT INTO `pessoas` (`id`, `nome`, `cpf`, `telefone`) VALUES
	(1, 'Douglas Pinheiro Goulart', '106.264.439-54', '+55 (48) 99975-1669'),
	(2, 'Paulo Cesar', '432.423.463-45', '+32 (46) 74812-8538'),
	(3, 'Pedro Oliveira da Silva', '579.680.472-86', '+57 (26) 59275-6286'),
	(4, 'Henrique Lacerda', '476.829.572-97', '+35 (34) 74578-2672'),
	(5, 'Fulano LÃ¡', '582.058.479-57', '+92 (05) 83658-9333'),
	(6, 'Ciclano Alves', '395.979.285-73', '+48 (29) 05828-5984'),
	(7, 'Cheik Alibaba', '111.222.333-44', '+11 (22) 33445-5667'),
	(8, 'Ricardo Milos', '777.242.424-11', '+55 (48) 99924-2424'),
	(9, 'Carinha Qualquer', '348.393.747-29', '+34 (23) 47326-4237'),
	(10, 'Emma Thomas', '345.745.365-44', '+45 (36) 76745-8345');
/*!40000 ALTER TABLE `pessoas` ENABLE KEYS */;

-- Copiando estrutura para tabela sistema_reservas.reservas
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_carro` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela sistema_reservas.reservas: ~8 rows (aproximadamente)
DELETE FROM `reservas`;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` (`id`, `id_carro`, `id_pessoa`, `data_inicio`, `data_fim`) VALUES
	(1, 2, 1, '2019-08-05', '2019-08-10'),
	(2, 4, 2, '2019-08-07', '2019-08-08'),
	(3, 2, 3, '2019-08-01', '2019-08-04'),
	(4, 2, 4, '2019-08-11', '2019-08-13'),
	(5, 10, 5, '2019-08-03', '2019-08-06'),
	(6, 1, 6, '2019-08-10', '2019-08-26'),
	(7, 8, 7, '2019-12-15', '2020-01-25'),
	(8, 4, 8, '2019-03-03', '2019-03-10'),
	(10, 9, 10, '2019-08-10', '2019-08-26');
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
