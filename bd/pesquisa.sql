-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Abr-2018 às 21:13
-- Versão do servidor: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pesquisa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `escolha`
--

CREATE TABLE `escolha` (
  `id_escolha` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `fk_login` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `fk_questao` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `opc_escolhida` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escolha`
--

INSERT INTO `escolha` (`id_escolha`, `fk_login`, `fk_questao`, `opc_escolhida`) VALUES
(0001, 0003, 0001, 'a'),
(0002, 0003, 0002, 'a'),
(0003, 0004, 0001, 'b'),
(0004, 0004, 0002, 'b'),
(0005, 0002, 0001, 'a'),
(0006, 0002, 0002, 'a'),
(0007, 0005, 0001, 'c'),
(0008, 0005, 0002, 'a'),
(0009, 0005, 0003, '1'),
(0010, 0005, 0004, 'a'),
(0011, 0001, 0001, 'a'),
(0012, 0001, 0002, 'a'),
(0013, 0001, 0005, '1'),
(0014, 0001, 0006, '1'),
(0015, 0001, 0007, '1'),
(0016, 0001, 0008, 'a'),
(0017, 0001, 0009, 'a'),
(0018, 0001, 0010, 'a'),
(0019, 0001, 0003, '1'),
(0020, 0001, 0004, 'a'),
(0021, 0001, 0011, 'a'),
(0022, 0001, 0012, 'c'),
(0023, 0001, 0013, 'a'),
(0024, 0001, 0014, 'c'),
(0025, 0001, 0015, 'c'),
(0026, 0001, 0016, 'd'),
(0027, 0001, 0017, 'd'),
(0028, 0001, 0018, 'd'),
(0029, 0003, 0011, 'a'),
(0030, 0003, 0012, 'a'),
(0031, 0003, 0013, 'a'),
(0032, 0003, 0014, 'c'),
(0033, 0003, 0015, 'a'),
(0034, 0003, 0016, 'd'),
(0035, 0003, 0017, 'e'),
(0036, 0003, 0018, 'a'),
(0037, 0004, 0011, 'a'),
(0038, 0004, 0012, 'a'),
(0039, 0004, 0013, 'b'),
(0040, 0004, 0014, 'd'),
(0041, 0004, 0015, 'd'),
(0042, 0004, 0016, 'd'),
(0043, 0004, 0017, 'd'),
(0044, 0004, 0018, 'd');

-- --------------------------------------------------------

--
-- Estrutura da tabela `follow`
--

CREATE TABLE `follow` (
  `id_follow` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `follower` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `followed` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `follow`
--

INSERT INTO `follow` (`id_follow`, `follower`, `followed`, `status`) VALUES
(0001, 0004, 0001, 1),
(0002, 0001, 0004, 1),
(0003, 0003, 0002, 1),
(0004, 0002, 0003, 1),
(0005, 0003, 0005, 1),
(0006, 0001, 0005, 1),
(0007, 0005, 0001, 1),
(0008, 0003, 0001, 1),
(0009, 0003, 0004, 1),
(0010, 0004, 0003, 1),
(0011, 0004, 0002, 0),
(0012, 0004, 0005, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `id_login` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `perfil` int(2) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cel` varchar(20) NOT NULL,
  `email` varchar(260) DEFAULT NULL,
  `senha` varchar(200) NOT NULL,
  `descr` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`id_login`, `perfil`, `nome`, `cel`, `email`, `senha`, `descr`) VALUES
(0001, 1, 'Caio', '2126059692', 'caiofabiocosta@gmail.com', '213c437c777a79173173f9a235035c95', '       Sou o administrador aplicação.     '),
(0002, 2, 'Caio Ibraim', '21968639055', 'ibraim.caiofabio@gmail.com', '213c437c777a79173173f9a235035c95', '  \r\nCerta vez, um mestre chassídico mandou seus alunos descerem para expulsar a escuridão do porão.'),
(0003, 2, 'Felipe Moura', '21989132062', 'felipe.iduff@uff.com', '213c437c777a79173173f9a235035c95', '      Sou um pesquisador amador. '),
(0004, 0, 'Marcos Almeida', '21979094617', 'marcos@marinha.com', 'e10adc3949ba59abbe56e057f20f883e', '  Não há ninguém que ame a dor por si só, que a busque e queira tê-la, simplesmente por ser dor... '),
(0005, 0, 'greisson', '21212121', 'greisson@gmail.com', 'f26549532e0caa16432edefac273c6b0', '  Sou um Baiano muito safo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesquisa`
--

CREATE TABLE `pesquisa` (
  `id_pesquisa` int(4) UNSIGNED ZEROFILL NOT NULL,
  `dt_ini` date NOT NULL,
  `dt_fim` date NOT NULL,
  `status` int(1) NOT NULL,
  `titulo` varchar(64) NOT NULL,
  `autor` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `descricao` text NOT NULL,
  `perfil` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pesquisa`
--

INSERT INTO `pesquisa` (`id_pesquisa`, `dt_ini`, `dt_fim`, `status`, `titulo`, `autor`, `descricao`, `perfil`) VALUES
(0001, '2018-04-11', '2018-04-18', 1, 'Segurança pública', 0001, 'A pesquisa se propôs a investigar os elementos estruturais e ideológicos que fomentam o uso abusivo da prisão provisória no Brasil, mais especificamente em seis estados da Federação: Distrito Federal, Rio Grande do Sul, Paraíba, Tocantins, Santa Catarina e São Paulo. Para tanto, buscou-se identificar quais as modificações implementadas em cada um dos seis estados pesquisados, mais especificamente em suas capitais, no âmbito do Poder Judiciário, para a implementação das Audiências de Custódia e das medidas cautelares no processo penal. Também foi analisada a percepção dos operadores jurídicos envolvidos com a implementação das audiências sobre suas potencialidades, assim como sobre as dificuldades para a sua implementação.', 1),
(0003, '2018-04-10', '2018-04-10', 1, 'Pesquisa teste', 0001, 'Todavia, o desenvolvimento contínuo de distintas formas de atuação assume importantes posições no estabelecimento do impacto na agilidade decisória. Do mesmo modo, a consolidação das estruturas aponta para a melhoria do processo de comunicação como um todo. As experiências acumuladas demonstram que o fenômeno da Internet promove a alavancagem das condições inegavelmente apropriadas. Gostaria de enfatizar que o aumento do diálogo entre os diferentes setores produtivos facilita a criação dos índices pretendidos. A certificação de metodologias que nos auxiliam a lidar com a adoção de políticas descentralizadoras estimula a padronização dos conhecimentos estratégicos para atingir a excelência. ', 1),
(0005, '2018-04-16', '2018-04-17', 1, 'Consumo de substâncias quimicas', 0001, 'Pesquisa que visa compreender a relação da sociedade com o uso de substâncias químicas que causam dependência.', 0),
(0006, '2018-04-19', '2018-04-30', 1, 'Insegurança dos estudantes na UFF', 0004, 'Insegurança e vitimização dos estudantes na Universidade Federal Fluminense e redondezas.\r\nEsse questionário foi elaborado pelos membros da Ilumina - Estrategia e Inovação em Segurança Pública, empresa júnior do curso de Segurança Pública da UFF a fim de analisar os casos de crime que sofrem xs alunxs dentro e perto dos campus da Universidade Federal Fluminense. ', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pesquisa_login`
--

CREATE TABLE `pesquisa_login` (
  `id_pesquisa_login` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `id_pesquisa` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `id_login` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `status` int(1) NOT NULL,
  `avaliacao` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `pesquisa_login`
--

INSERT INTO `pesquisa_login` (`id_pesquisa_login`, `id_pesquisa`, `id_login`, `status`, `avaliacao`) VALUES
(0001, 0001, 0003, 1, 0),
(0002, 0003, 0003, 1, 0),
(0003, 0001, 0004, 1, 0),
(0004, 0003, 0004, 1, 0),
(0005, 0001, 0002, 1, 0),
(0006, 0001, 0005, 1, 0),
(0007, 0003, 0005, 1, 0),
(0008, 0001, 0001, 1, 0),
(0009, 0003, 0001, 1, 0),
(0010, 0006, 0001, 1, 0),
(0011, 0006, 0003, 1, 0),
(0012, 0006, 0004, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questao`
--

CREATE TABLE `questao` (
  `id_questao` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `id_pesquisa` smallint(4) UNSIGNED ZEROFILL NOT NULL,
  `tipo` int(1) NOT NULL,
  `texto` text NOT NULL,
  `a` varchar(200) NOT NULL,
  `b` varchar(200) NOT NULL,
  `c` varchar(200) NOT NULL,
  `d` varchar(200) NOT NULL,
  `e` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `questao`
--

INSERT INTO `questao` (`id_questao`, `id_pesquisa`, `tipo`, `texto`, `a`, `b`, `c`, `d`, `e`) VALUES
(0001, 0001, 0, 'Em que área da administração pública a cidade de São Gonçalo mais deixa a desejar?', 'Segurança', 'Saúde', 'Educação', 'Coleta de lixo', 'Urbanização'),
(0002, 0001, 0, 'Como resolver o problema de segurança pública na cidade a curto prazo?', 'Aumento do policiamento nos bairros', 'Criação de uma plataforma colaborativa', 'Atuação mais direta da polícia militar contra o tráfico de drogas', 'Combater o aumento de roubo de cargas', 'Criar postos de monitoramento nas áreas mais sensíveis da cidade'),
(0003, 0003, 1, 'Existe diferença entre a tartaruga o navio e a mãe?', 'Sim ', 'Não ', 'Talvez', 'possivelmente', 'improvável'),
(0004, 0003, 0, 'Qual a  diferença entre a tartaruga o navio e a mãe?', 'O navio tem o casco em baixo dele', 'A tartaruga possui casco', 'O cachorro nada', 'A mãe vai bem', 'Não sei...'),
(0005, 0001, 1, 'Na sua opinião o uso abusivo de drogas contribui para o aumento da violência na cidade de São Gonçalo?', '', '', '', '', ''),
(0006, 0001, 1, 'Na sua opinião está pegando?', '', '', '', '', ''),
(0007, 0001, 1, 'Na sua opinião está safo?', 'Sim ', 'Não ', 'Talvez', 'pode ser', 'nunca'),
(0008, 0001, 0, 'teset', 'asd', 'asdf', 'asdfaasdf', 'asdf', 'asdf'),
(0009, 0001, 0, 'teset', 'asd', 'asdf', 'asdfaasdf', 'asdf', 'asdf'),
(0010, 0001, 0, 'teset', 'asd', 'asdf', 'asdfaasdf', 'asdf', 'asdf'),
(0011, 0006, 0, 'Qual o seu vínculo com a UFF?', 'Aluno', 'Servidor', 'Professor', 'Outro', 'Nenhum'),
(0012, 0006, 0, 'Em qual desses campus da Universidade Federal Fluminense (UFF) você passa a maior parte do tempo? *', 'Campus do Gragoatá', 'Campus da Praia Vermelha', 'Campus do Valonguinho', 'Faculdade de Direito', 'Faculdade de Direito 2 (Rua Tiradentes)'),
(0013, 0006, 0, 'Qual (s) campus da UFF você considera como mais inseguro ?', 'Campus do Gragoatá', 'Campus da Praia Vermelha', 'Campus do Valonguinho', 'Faculdade de Direito', 'Faculdade de Direito 2 (Rua Tiradentes)'),
(0014, 0006, 0, 'Qual turno você considera ser o mais perigoso no que diz respeito a possibilidade de ocorrência de um crime?', 'Manhã', 'Tarde', 'Noite', 'Madrugada', 'Nenhum'),
(0015, 0006, 0, 'Quais são os fatores que mais te causam insegurança dentro e perto dos campus da Universidade Federal Fluminense (UFF)? ', 'Pouca iluminação', 'Pouca circulação de pessoas', 'Falta de policiamento', 'Histórico de crimes dentro e ao redor da Universidade', 'Pouca resolução dos casos já denunciados/notificados'),
(0016, 0006, 0, 'Você conhece alguém que já foi vitimado (tentativa ou ato consumado) dentro de algum campus da UFF? ', 'Foi vitima', 'Sofreu uma tentativa', 'Presenciou', 'Não conhece', 'N/A'),
(0017, 0006, 0, 'Qual tipo de crime aconteceu com você?', 'Roubo', 'Furto', 'Estupro', 'Assédio', 'N/A'),
(0018, 0006, 0, 'Dentre as situações apresentadas, quais são as três que mais teme que possa acontecer com você durante sua circulação e permanência nos campus e proximidades da UFF?', 'Ser assaltado(a) na rua.', 'Ser assaltado(a) no ônibus, no caminho.', 'Ter o veículo roubado.', 'Ser vítima de agressão sexual.', 'Ter sua bicilceta furtada dentro da UFF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `escolha`
--
ALTER TABLE `escolha`
  ADD PRIMARY KEY (`id_escolha`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`id_follow`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `pesquisa`
--
ALTER TABLE `pesquisa`
  ADD PRIMARY KEY (`id_pesquisa`);

--
-- Indexes for table `pesquisa_login`
--
ALTER TABLE `pesquisa_login`
  ADD PRIMARY KEY (`id_pesquisa_login`);

--
-- Indexes for table `questao`
--
ALTER TABLE `questao`
  ADD PRIMARY KEY (`id_questao`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `escolha`
--
ALTER TABLE `escolha`
  MODIFY `id_escolha` smallint(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `follow`
--
ALTER TABLE `follow`
  MODIFY `id_follow` smallint(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` smallint(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesquisa`
--
ALTER TABLE `pesquisa`
  MODIFY `id_pesquisa` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pesquisa_login`
--
ALTER TABLE `pesquisa_login`
  MODIFY `id_pesquisa_login` smallint(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `questao`
--
ALTER TABLE `questao`
  MODIFY `id_questao` smallint(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
