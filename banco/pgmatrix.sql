-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14-Nov-2018 às 02:04
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pgmatrix`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `nascimento` varchar(10) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `cpfcnpj` varchar(18) NOT NULL,
  `telefone` char(13) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cep` char(9) NOT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `nascimento`, `rg`, `cpfcnpj`, `telefone`, `email`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `cep`, `data_cadastro`) VALUES
(3, 'Geovani Aparecido Pereira', '1994-09-06', '10.432.131-2', '094.369.888-99', '(44)999999999', 'geovani@email.com', 'Praça Tamoio', '5908', 'Zona VI', 'Umuarama', 'PR', '87503-100', '2018-06-01 11:03:49'),
(4, 'Romário Da Silva Sauro', '2018-06-12', '21.312.312-3', '111.111.111-11', '(44)444444444', 'gsd@fsda.fsd', 'Rua Baependi', '2312', 'Centro', 'Lages', 'SC', '88502-140', '2018-06-01 12:14:20'),
(6, 'Fabio Adonias da Silva', '1994-02-23', '11.056.889-7', '106.689.899-44', '(44)421233321', 'teste@teste.com', 'Avenida Rotary', '2133', 'Parque Presidente', 'Umuarama', 'PR', '87505-030', '2018-06-19 20:54:52'),
(8, 'Bruno Ferreira', '2014-06-02', '10.4464464666', '094.372.329-99', '(44)33992910', 'geovani@hotmail.com', 'Rua Bartolomeu Bueno', '5908', 'Zona III', 'Umuarama', 'PR', '87502-150', '2018-06-19 22:33:18'),
(10, 'Marcio', '2000-02-01', '10111155658', '288.599.067-00', '(12)313123123', 'marciockalves@dasf.com', 'Rua Santa Catarina', '3213', 'Zona II', 'Umuarama', 'PR', '87502-040', '2018-06-20 00:20:25'),
(11, 'Rogério dos Santos', '1988-06-14', '102222369', '09.438.889/7792-22', '(44)933666666', 'teste@teste.com', 'Rua Bartolomeu Bueno', '3424', 'Zona III', 'Umuarama', 'PR', '87502-150', '2018-10-24 17:18:43'),
(12, 'fsafsadfsda', '2010-02-02', '11111111111111111111', '231.323.123-11', '(44)44444444', 'ge@df.com', 'Rua Bartolomeu Bueno', '123a', 'Zona III', 'Umuarama', 'PR', '87502-150', '2018-10-24 21:24:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta`
--

CREATE TABLE `conta` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` float NOT NULL,
  `data` date NOT NULL,
  `conta` enum('Pago','Pendente') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`id`, `descricao`, `valor`, `data`, `conta`) VALUES
(2, 'Almoço 2 pessoas', 2131.33, '2018-05-31', 'Pago'),
(3, 'Compra de Mercadorias', 1233.11, '2018-05-30', 'Pendente'),
(10, 'Pneu do carro', 50, '2018-06-14', 'Pago'),
(11, 'caixas', 15000, '2018-06-07', 'Pago'),
(12, 'Conserto Pneu Carro', 50, '2018-10-24', 'Pago');

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `alteracao` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`id`, `id_usuario`, `hora`, `ip`, `alteracao`) VALUES
(266, 1, '2018-06-19 07:15:18', '::1', ' Status: Em Andamento OS: 99'),
(267, 1, '2018-06-19 07:15:44', '::1', ' Ordem: 99 Valor Parcela: 1181.67 Parcelas: 3'),
(268, 1, '2018-06-19 07:15:51', '::1', ' DataPgto: 2018-06-19 Parcela: 595 Ordem: 99'),
(269, 1, '2018-06-19 07:15:55', '::1', ' DataPgto: 2018-06-20 DataVcto: 2018-06-19 Parcela: 595 Ordem: 99'),
(270, 1, '2018-06-19 02:25:18', '::1', 'Status:Finalizado/OS:99/Data Final: 2018-06-19/Cliente: 4'),
(271, 1, '2018-06-19 02:25:43', '::1', 'Status:Finalizado/OS:99/Data Final: 2018-06-19/Cliente: 4'),
(272, 1, '2018-06-19 02:28:09', '::1', ' DataPgto: 2018-06-19 Parcela: 554 Ordem: 96'),
(273, 1, '2018-06-19 02:28:13', '::1', ' DataPgto: 2018-06-19 Parcela: 555 Ordem: 96'),
(274, 1, '2018-06-19 02:28:17', '::1', ' DataPgto: 2018-06-19 Parcela: 556 Ordem: 96'),
(275, 1, '2018-06-19 02:28:36', '::1', 'Status:Em Andamento/OS:95/Data Final: 2018-06-19/Cliente: 3'),
(276, 1, '2018-06-19 02:28:41', '::1', ' DataPgto: 2018-06-19 Parcela: 547 Ordem: 95'),
(277, 1, '2018-06-19 02:28:43', '::1', ' DataPgto: 2018-06-19 Parcela: 548 Ordem: 95'),
(278, 1, '2018-06-19 02:28:49', '::1', 'Status:Finalizado/OS:95/Data Final: 2018-06-19/Cliente: 3'),
(279, 1, '2018-06-19 20:25:05', '::1', ' Status: Aberto OS: 100'),
(280, 1, '2018-06-19 20:28:10', '::1', ' Ordem: 100 Valor Parcela: 455 Parcelas: 1'),
(281, 6, '2018-06-19 21:03:41', '::1', ' Status: Em Andamento OS: 101'),
(282, 6, '2018-06-19 21:05:53', '::1', ' Ordem: 101 Valor Parcela: 891.67 Parcelas: 3'),
(283, 6, '2018-06-19 21:06:04', '::1', ' DataPgto: 2018-06-20 Parcela: 599 Ordem: 101'),
(284, 6, '2018-06-19 21:06:15', '::1', ' DataPgto: 2018-06-28 DataVcto: 2018-06-19 Parcela: 599 Ordem: 101'),
(285, 6, '2018-06-19 21:06:26', '::1', ' DataVcto: 2018-07-26 Parcela: 600 Ordem: 101'),
(286, 6, '2018-06-19 21:06:49', '::1', ' DataPgto: 2018-06-20 Parcela: 600 Ordem: 101'),
(287, 6, '2018-06-19 21:06:52', '::1', ' DataPgto: 2018-06-20 Parcela: 601 Ordem: 101'),
(288, 6, '2018-06-19 21:07:06', '::1', ' Status: Aberto OS: 102'),
(289, 6, '2018-06-19 21:07:23', '::1', ' Ordem: 102 Valor Parcela: 87.5 Parcelas: 4'),
(290, 1, '2018-06-19 21:23:11', '::1', ' DataPgto: 2018-06-20 Parcela: 592 Ordem: 97'),
(291, 1, '2018-06-19 21:29:42', '::1', ' Status: Orçamento OS: 103'),
(292, 1, '2018-06-19 21:30:06', '::1', ' Ordem: 103 Valor Parcela: 0 Parcelas: 3'),
(293, 1, '2018-06-19 21:30:16', '::1', 'Status:Cancelado/OS:103/Data Final: 2018-06-20/Cliente: 2'),
(294, 1, '2018-06-19 21:30:31', '::1', 'Status:Orçamento/OS:102/Data Final: 2018-06-20/Cliente: 8'),
(295, 1, '2018-06-19 21:30:44', '::1', 'Status:Cancelado/OS:100/Data Final: 2018-06-20/Cliente: 5'),
(296, 1, '2018-06-23 00:14:19', '::1', 'Status:Em Andamento/OS:101/Data Final: 2018-06-20/Cliente: 6'),
(297, 1, '2018-06-23 00:18:03', '::1', ' DataPgto: 2018-06-23 Parcela: 598 Ordem: 100'),
(298, 1, '2018-06-23 00:23:11', '192.168.16.106', ' DataPgto: 2018-06-23 Parcela: 606 Ordem: 103'),
(299, 1, '2018-09-23 16:42:41', '::1', ' Status: Finalizado OS: 104'),
(300, 1, '2018-09-23 16:43:37', '::1', ' Ordem: 104 Valor Parcela: 109.48 Parcelas: 4'),
(301, 1, '2018-09-23 16:44:08', '::1', ' DataPgto: 2018-09-23 Parcela: 609 Ordem: 104'),
(302, 1, '2018-09-23 16:44:12', '::1', ' DataPgto: 2018-09-27 DataVcto: 2018-09-23 Parcela: 609 Ordem: 104'),
(303, 1, '2018-09-23 16:44:45', '::1', ' DataPgto: 2018-09-23 Parcela: 610 Ordem: 104'),
(304, 1, '2018-09-23 16:44:47', '::1', ' DataPgto: 2018-09-23 Parcela: 611 Ordem: 104'),
(305, 1, '2018-09-23 16:44:49', '::1', ' DataPgto: 2018-09-23 Parcela: 612 Ordem: 104'),
(306, 1, '2018-09-25 00:34:20', '::1', ' Status: Aberto OS: 105'),
(307, 1, '2018-09-28 17:57:11', '::1', ' Status: Aberto OS: 106'),
(308, 1, '2018-09-28 17:57:34', '::1', ' Ordem: 106 Valor Parcela: 142.63 Parcelas: 4'),
(309, 1, '2018-09-28 18:00:33', '::1', ' DataPgto: 2018-09-28 Parcela: 613 Ordem: 106'),
(310, 4, '2018-10-24 03:30:28', '::1', ' DataPgto: 2018-10-24 Parcela: 593 Ordem: 97'),
(311, 4, '2018-10-24 03:30:33', '::1', ' DataPgto: 2018-10-24 Parcela: 594 Ordem: 97'),
(312, 4, '2018-10-24 03:30:42', '::1', ' DataPgto: 2018-10-24 Parcela: 615 Ordem: 106'),
(313, 1, '2018-10-24 15:19:59', '::1', ' Status: Aberto OS: 107'),
(314, 1, '2018-10-24 15:21:37', '::1', ' Ordem: 107 Valor Parcela: 1048.78 Parcelas: 4'),
(315, 1, '2018-10-24 15:21:49', '::1', ' DataPgto: 2018-10-24 Parcela: 617 Ordem: 107'),
(316, 1, '2018-10-24 15:21:54', '::1', ' DataPgto: 2018-10-24 Parcela: 618 Ordem: 107'),
(317, 1, '2018-10-24 15:21:56', '::1', ' DataPgto: 2018-10-24 Parcela: 619 Ordem: 107'),
(318, 1, '2018-10-24 15:21:57', '::1', ' DataPgto: 2018-10-24 Parcela: 620 Ordem: 107'),
(319, 1, '2018-10-24 22:28:29', '::1', ' DataPgto: 2018-10-25 Parcela: 482 Ordem: 78'),
(320, 1, '2018-10-24 22:31:49', '::1', ' Status: Aberto OS: 108');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `marca` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id`, `marca`) VALUES
(3, 'AZ BOX'),
(4, 'PPA'),
(5, 'UNISYSTEM'),
(6, 'CS'),
(8, 'CONFIASTES'),
(9, 'INTELBRAS'),
(10, 'OUTRO'),
(11, 'MULTITOC TECNOLOGIA'),
(12, 'WESTERN'),
(14, 'CONDUTTI'),
(16, 'IPEC'),
(17, 'MARCA TESTE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem`
--

CREATE TABLE `ordem` (
  `id` int(11) NOT NULL,
  `data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `datainicial` date NOT NULL,
  `datafinal` date NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `observacao` varchar(100) NOT NULL,
  `status` enum('Aberto','Em Andamento','Finalizado','Cancelado','Orçamento') NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `parcela`
--

CREATE TABLE `parcela` (
  `id` int(11) NOT NULL,
  `id_ordem` int(11) NOT NULL,
  `valor` float NOT NULL,
  `datavcto` date NOT NULL,
  `datapgto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `imagem` varchar(12) NOT NULL,
  `estoque` int(11) NOT NULL,
  `valor` float NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id`, `nome`, `descricao`, `imagem`, `estoque`, `valor`, `id_marca`) VALUES
(4, 'CAMERA BULLET 1080 HDCVI 20M', 'HDCVI VHD 1220B FULL HD 1080P 3,6MM G3 20 METROS', '1537850297', 45, 150, 9),
(5, 'CAMERA DOME HDCVI 1080 20M 1/3', 'VHD 1220D G3 3.6MM 1080P MULTI HD 20 METROS', '', 51, 249.9, 9),
(6, 'DVR 8 CANAIS MHDX 3008 HIBRIDO', 'MHDX 3008 G3 MULTI HD FULL HD 1080P HDCVI / AHD / HDTVI / ANALÒGICO / IP', '', 7, 830.2, 9),
(8, 'CAMERA 1000 LINHAS OU AHD 1/3 10M', 'VMD 1010 IR G3 CAMERA HIBRIDA 1000 LINHAS E AHD', '1537850215', 10, 117.6, 9),
(9, 'CAMERA BULLET HDCVI 720P  10M 1/3', 'VHD 1010 B G3 IR 10 METROS HDCVI / AHD / HDTVI / ANALÒGICO', '', 7, 128, 9),
(10, 'CONECTOR BNC COM MOLA E PARAFUSO PLUG CFTV', 'CONECTOR BNC FEMEA COM MOLA E PARAFUSO', '', 200, 2.5, 10),
(11, 'CAIXA SOBREPOR CFTV BALUN QUADRADA BRANCA 8 X', 'MEDIDA: 8CMX8CMX4CM MATERIAL: ABS TRATADO COR: BRANCO', '1537850180', 94, 8.5, 11),
(12, 'HD 1TB PURPLE ADEQUADO PARA DVR', 'HD 1TB PURPLE ESPECIFICO PARA  CFTV DVR WD10PURZ', '', 24, 359.9, 12),
(14, 'Cabo 4mm CFTV 1 Metro', 'Alimentação Bipolar 90% 95% MALHA 1 METRO', '1537850086', 1481, 0.9, 14),
(15, 'CABO REDE CAT5E', 'CABO CFTV REDE CAT5E UTP 4 PARES', '1537850138', 9568, 1.35, 10),
(16, 'Antena Banda KU 65cm com LNB', 'Antena Banda KU Nacional de 60 cm', '1537850008', 5, 85, 10),
(17, 'CÂMERA SPEED DOME AHD INTELBRAS 2MP', 'CAMERA SPEED AHD  ALTA QUALIDADE ONVIF, IP', '', 50, 3500, 9),
(25, 'Motor portão eletrônico 1/3', 'Motor deslizante 1/3', '', 5, 250, 5),
(26, 'teste', 'gds', '', 0, 1.11, 6),
(30, 'Cabo de Aço Inox 1,6mm METRO', 'Cabo de Aço Inox para Cerca elétrica estruturada de 1,6mm', '1537849925', 310, 21.33, 10),
(31, 'testes', 'teste', '1540354334', 1, 1231.23, 16),
(32, 'Cabo CCI 0.40mm Condutti', 'Cabo CCI 4 fios 0,40mm Condutti para Alarme,Porteiro eletrônico, Sirene', '1540358643', 100, 0.8, 14),
(33, 'Cabo Elétrico Flexível 1,5mm', 'Cabo Elétrico Flexível 1,5mm - Usado em instalação elétrica de baixo consumo', '', 100, 1.25, 10),
(34, 'teste', 'fdsafdas', '1540399457', 3123, 12.33, 11),
(35, 'Produto Teste', 'Produto teste', '1540401362', 12, 136.66, 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_os`
--

CREATE TABLE `produto_os` (
  `id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `id_ordem` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `valor` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `descricao` text NOT NULL,
  `valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id`, `nome`, `descricao`, `valor`) VALUES
(3, 'Instalação Câmera CFTV', 'Instalação Simples, Passagem dos fios, fixação montagem dos conectores', 65),
(5, 'Instalação Motor Deslizante', 'Instalação Motor de Portão Deslizante Residencial', 150),
(6, 'Instalação Antena Banda KU', 'Instalação Completa Antena Banda KU, Apontamento, Fios, Configuração', 125),
(7, 'Instalação Cerca Elétrica', 'Instalação Cerca Elétrica INDUSTRIAL', 350),
(12, 'Instalação Alarme Monitorado', 'residencial ou comercial', 200),
(13, 'Instalação Interfone', 'fixação do porteiro + equipamentos', 130),
(14, 'Instalação rede', 'Instalação de rede Cabeada', 150),
(15, 'Instalação de Camera', 'fdsfdas', 356),
(16, 'Mão de obra instalação tal', 'Mão de obra serviço', 150);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico_os`
--

CREATE TABLE `servico_os` (
  `id` int(11) NOT NULL,
  `id_ordem` int(11) NOT NULL,
  `id_servico` int(11) NOT NULL,
  `valor` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `cpfcnpj` varchar(14) DEFAULT NULL,
  `telefone` varchar(15) NOT NULL,
  `permissao` varchar(15) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  `login` varchar(20) NOT NULL,
  `senha` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `cpfcnpj`, `telefone`, `permissao`, `ativo`, `login`, `senha`) VALUES
(1, 'Geovani Pereira', 'geovani@mail.com', '094.372.329-97', '(44)99887766', 'admin', 'Sim', 'geovani', '202cb962ac59075b964b07152d234b70'),
(4, 'Joao Vitor', 'joao@mail.com', '888.999.999-98', '(11)11111111', 'funcionario', 'Sim', 'joao', '202cb962ac59075b964b07152d234b70'),
(5, 'Patrick Henrique', 'patrick@patrick.com', '213.123.133-33', '(44)123131333', 'funcionario', 'Sim', 'patrick', '202cb962ac59075b964b07152d234b70'),
(6, 'Patrick', 'p@p.oi', '456.464.656-66', '(44)444444444', 'admin', 'Sim', 'patrick123', '202cb962ac59075b964b07152d234b70'),
(7, 'Anderson Mine Fernandes', 'burnes@hotmail.com', '097.779.900-99', '(44)999998888', 'funcionario', 'Sim', 'burnes', 'fcea920f7412b5da7be0cf42b8c93759'),
(8, 'Tidinho da silva', 'p@p.oi', '706.666.699-92', '(44)444444444', 'funcionario', 'Sim', 'tidinho', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conta`
--
ALTER TABLE `conta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fklog_idx` (`id_usuario`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordem`
--
ALTER TABLE `ordem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkcliente_idx` (`id_cliente`),
  ADD KEY `fkusuario_idx` (`id_usuario`);

--
-- Indexes for table `parcela`
--
ALTER TABLE `parcela`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkparcela1_idx` (`id_ordem`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkmarca_idx` (`id_marca`);

--
-- Indexes for table `produto_os`
--
ALTER TABLE `produto_os`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkproduto_idx` (`id_produto`),
  ADD KEY `fkordem_idx` (`id_ordem`);

--
-- Indexes for table `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servico_os`
--
ALTER TABLE `servico_os`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkservico_idx` (`id_servico`),
  ADD KEY `fkordem2_idx` (`id_ordem`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `conta`
--
ALTER TABLE `conta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `ordem`
--
ALTER TABLE `ordem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `parcela`
--
ALTER TABLE `parcela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `produto_os`
--
ALTER TABLE `produto_os`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `servico`
--
ALTER TABLE `servico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `servico_os`
--
ALTER TABLE `servico_os`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fklog` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `ordem`
--
ALTER TABLE `ordem`
  ADD CONSTRAINT `fkcliente` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkusuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `parcela`
--
ALTER TABLE `parcela`
  ADD CONSTRAINT `fkparcela` FOREIGN KEY (`id_ordem`) REFERENCES `ordem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fkmarca` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `produto_os`
--
ALTER TABLE `produto_os`
  ADD CONSTRAINT `fkordem` FOREIGN KEY (`id_ordem`) REFERENCES `ordem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkproduto` FOREIGN KEY (`id_produto`) REFERENCES `produto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `servico_os`
--
ALTER TABLE `servico_os`
  ADD CONSTRAINT `fkordem2` FOREIGN KEY (`id_ordem`) REFERENCES `ordem` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkservico` FOREIGN KEY (`id_servico`) REFERENCES `servico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
