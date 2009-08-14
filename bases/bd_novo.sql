# phpMyAdmin SQL Dump
# version 2.13
# http://www.phpmyadmin.net
#
# Servidor: localhost
# Data de Geração: Mai 9, 2009 as 19:33 PM
# Versão do Servidor: 5.0.51
# Versão do PHP: 5.2.5

#
# Banco de Dados: `gerenciador`
#

# ############################

#
# Estrutura da tabela `agenda`
#

CREATE TABLE IF NOT EXISTS `agenda` (
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `codigo_dentista` varchar(11) NOT NULL,
  `codigo_paciente` int(10) default NULL,
  `descricao` varchar(90) default NULL,
  `procedimento` varchar(15) default NULL,
  `faltou` enum('Sim','Não') NOT NULL default 'Não',
  PRIMARY KEY  (`data`,`hora`,`codigo_dentista`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `agenda_obs`
#

CREATE TABLE IF NOT EXISTS `agenda_obs` (
  `data` date NOT NULL,
  `codigo_dentista` varchar(11) NOT NULL,
  `obs` longtext,
  PRIMARY KEY  (`data`,`codigo_dentista`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `agradecimentos`
#

CREATE TABLE `agradecimentos` (
  `agradecimento` TEXT NULL DEFAULT NULL ,
  `codigo_paciente` INT NOT NULL ,
  PRIMARY KEY ( `codigo_paciente` )
) ENGINE = MYISAM;

# ############################

#
# Estrutura da tabela `ajuda`
#

CREATE TABLE IF NOT EXISTS `ajuda` (
  `codigo` int(10) NOT NULL auto_increment,
  `topico` varchar(200) NOT NULL,
  `texto` text NOT NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

#
# Extraindo dados da tabela `ajuda`
#

INSERT INTO `ajuda` (`codigo`, `topico`, `texto`) VALUES
(1, 'Dentistas', '<b><h3>Incluir Dentista</b></h3>\r\n<br>\r\n<br>\r\n<b>Caminho:</b> Arquivo > Dentistas > Incluir novo dentista\r\n<br>\r\n<br>\r\n<b><h3>Excluir Dentista</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Dentistas\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do dentista a ser excluído do sistema. A direita do número do CRO, aparecerá a opção EXCLUIR. Confirme exclusão.\r\n<br>\r\n<br>\r\n<b><h3>Editar dados do Dentista</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Dentistas\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do dentista que irá alterar as informações. A direita do número do CRO, aparecerá a opção EDITAR. Clique e confirme alterações.\r\n<br>\r\n<br>\r\n<b><h3>Procurar Dentista Cadastrado</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Dentistas\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do dentista a ser procurado do sistema.\r\n<br>\r\n<br>\r\n<b><h3>Relatório Total dos Dentistas</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Dentistas\r\n<br><br>\r\nJá aparecerá, por padrão, todos dentistas cadastrados. Listagem por ordem alfabética.\r\n'),
(2, 'Funcionários', '<b><h3>Incluir Funcionário</b></h3>\r\n<br>\r\n<br>\r\n<b>Caminho:</b> Arquivo > Funcionários > Incluir novo funcionário\r\n<br>\r\n<br>\r\n<b><h3>Excluir Funcionário</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Funcionários\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do funcionário a ser excluído do sistema. A direita da Função Principal, aparecerá a opção EXCLUIR. Confirme exclusão.\r\n<br>\r\n<br>\r\n<b><h3>Editar dados do Funcionário</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Funcionários\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do funcionário que irá alterar as informações. A direita da Função Principal, aparecerá a opção EDITAR. Clique e confirme alterações.\r\n<br>\r\n<br>\r\n<b><h3>Procurar Funcionário Cadastrado</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Funcionários\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do funcionário a ser procurado do sistema.\r\n<br>\r\n<br>\r\n<b><h3>Relatório Total dos Funcionários</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > funcionários\r\n<br><br>\r\nJá aparecerá, por padrão, todos funcionários cadastrados. Listagem por ordem alfabética.'),
(3, 'Pacientes', '<b><h3>Incluir Paciente</b></h3>\r\n<br>\r\n<br>\r\n<b>Caminho:</b> Arquivo > Pacientes > Incluir novo paciente\r\n<br>\r\n<br>\r\n<b><h3>Excluir Paciente</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Pacientes\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do paciente a ser excluído do sistema. A direita do número da ficha clínica \r\n\r\naparecerá a opção EXCLUIR. Confirme exclusão.\r\n<br>\r\n<br>\r\n<b><h3>Editar dados do Paciente</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Pacientes\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do paciente que irá alterar as informações. A direita do número da ficha clínica \r\n\r\naparecerá a opção EDITAR. Clique e confirme alterações.\r\n<br>\r\n<br>\r\n<b><h3>Procurar Paciente Cadastrado</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Pacientes\r\n<br><br>\r\nDigite no campo "pesquisa" o nome do paciente a ser procurado do sistema.\r\n<br>\r\n<br>\r\n<b><h3>Relatório Total dos Pacientes</b></h3>\r\n<br><br>\r\n<b>Caminho:</b> Arquivo > Pacientes\r\n<br><br>\r\nJá aparecerá, por padrão, todos pacientes cadastrados. Listagem por ordem alfabética.');

# ############################

#
# Estrutura da tabela `arquivos`
#

CREATE TABLE IF NOT EXISTS `arquivos` (
  `codigo` int(20) NOT NULL auto_increment,
  `nome` varchar(20) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `tamanho` float NOT NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `atestados`
#

CREATE TABLE IF NOT EXISTS `atestados` (
  `atestado` longtext,
  `codigo_paciente` int(11) NOT NULL,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `caixa`
#

CREATE TABLE IF NOT EXISTS `caixa` (
  `codigo` int(15) NOT NULL auto_increment,
  `data` date default NULL,
  `dc` enum('+','-') default NULL,
  `valor` float default NULL,
  `descricao` varchar(255) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `caixa_dent`
#

CREATE TABLE IF NOT EXISTS `caixa_dent` (
  `codigo` int(15) NOT NULL auto_increment,
  `codigo_dentista` varchar(11) default NULL,
  `data` date default NULL,
  `dc` enum('+','-') default NULL,
  `valor` float default NULL,
  `descricao` varchar(255) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `cheques`
#

CREATE TABLE IF NOT EXISTS `cheques` (
  `codigo` int(50) NOT NULL auto_increment,
  `valor` float default NULL,
  `nometitular` varchar(80) default NULL,
  `numero` varchar(50) default NULL,
  `banco` varchar(50) default NULL,
  `agencia` varchar(20) default NULL,
  `recebidode` varchar(80) default NULL,
  `encaminhadopara` varchar(80) default NULL,
  `compensacao` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `cheques_dent`
#

CREATE TABLE IF NOT EXISTS `cheques_dent` (
  `codigo` int(50) NOT NULL auto_increment,
  `codigo_dentista` varchar(11) NOT NULL,
  `valor` float default NULL,
  `nometitular` varchar(80) default NULL,
  `numero` varchar(50) default NULL,
  `banco` varchar(50) default NULL,
  `agencia` varchar(20) default NULL,
  `recebidode` varchar(80) default NULL,
  `encaminhadopara` varchar(80) default NULL,
  `compensacao` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `contaspagar`
#

CREATE TABLE IF NOT EXISTS `contaspagar` (
  `codigo` int(20) NOT NULL auto_increment,
  `datavencimento` date default NULL,
  `descricao` varchar(150) default NULL,
  `valor` float default NULL,
  `datapagamento` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `contaspagar_dent`
#

CREATE TABLE IF NOT EXISTS `contaspagar_dent` (
  `codigo` int(20) NOT NULL auto_increment,
  `codigo_dentista` varchar(11) default NULL,
  `datavencimento` date default NULL,
  `descricao` varchar(150) default NULL,
  `valor` float default NULL,
  `datapagamento` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `contasreceber`
#

CREATE TABLE IF NOT EXISTS `contasreceber` (
  `codigo` int(20) NOT NULL auto_increment,
  `datavencimento` date default NULL,
  `descricao` varchar(150) default NULL,
  `valor` float default NULL,
  `datapagamento` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `contasreceber_dent`
#

CREATE TABLE IF NOT EXISTS `contasreceber_dent` (
  `codigo` int(20) NOT NULL auto_increment,
  `codigo_dentista` varchar(11) default NULL,
  `datavencimento` date default NULL,
  `descricao` varchar(150) default NULL,
  `valor` float default NULL,
  `datapagamento` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `convenios`
#

CREATE TABLE IF NOT EXISTS `convenios` (
  `codigo` int(15) NOT NULL auto_increment,
  `nomefantasia` varchar(80) default NULL,
  `cpf` varchar(50) NOT NULL default '',
  `razaosocial` varchar(80) default NULL,
  `atuacao` varchar(80) default NULL,
  `endereco` varchar(150) default NULL,
  `bairro` varchar(40) default NULL,
  `cidade` varchar(40) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `celular` varchar(15) default NULL,
  `telefone1` varchar(15) default NULL,
  `telefone2` varchar(15) default NULL,
  `inscricaoestadual` varchar(40) default NULL,
  `website` varchar(100) default NULL,
  `email` varchar(100) default NULL,
  `nomerepresentante` varchar(80) default NULL,
  `apelidorepresentante` varchar(50) default NULL,
  `emailrepresentante` varchar(100) default NULL,
  `celularrepresentante` varchar(15) default NULL,
  `telefone1representante` varchar(15) default NULL,
  `telefone2representante` varchar(15) default NULL,
  `banco` varchar(50) default NULL,
  `agencia` varchar(15) default NULL,
  `conta` varchar(15) default NULL,
  `favorecido` varchar(50) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `dados_clinica`
#

CREATE TABLE IF NOT EXISTS `dados_clinica` (
  `cnpj` varchar(50) default NULL,
  `razaosocial` varchar(80) default NULL,
  `fantasia` varchar(90) default NULL,
  `proprietario` varchar(50) default NULL,
  `endereco` varchar(150) default NULL,
  `bairro` varchar(40) default NULL,
  `cidade` varchar(40) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `fundacao` varchar(4) default NULL,
  `telefone1` varchar(13) default NULL,
  `telefone2` varchar(13) default NULL,
  `fax` varchar(13) default NULL,
  `email` varchar(100) default NULL,
  `web` varchar(100) default NULL,
  `banco1` varchar(50) default NULL,
  `agencia1` varchar(15) default NULL,
  `conta1` varchar(15) default NULL,
  `banco2` varchar(50) default NULL,
  `agencia2` varchar(15) default NULL,
  `conta2` varchar(15) default NULL,
  `idioma` varchar(50) default NULL,
  `logomarca` blob
) ENGINE=MyISAM;

#
# Extraindo dados da tabela `dados_clinica`
#

INSERT INTO `dados_clinica` (`cnpj`, `razaosocial`, `fantasia`, `proprietario`, `endereco`, `bairro`, `cidade`, `estado`, `pais`, `cep`, `fundacao`, `telefone1`, `telefone2`, `fax`, `email`, `web`, `banco1`, `agencia1`, `conta1`, `banco2`, `agencia2`, `conta2`, `logomarca`) VALUES
(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

# ############################

#
# Estrutura da tabela `dentistas`
#

CREATE TABLE IF NOT EXISTS `dentistas` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) default NULL,
  `cpf` varchar(50) default NULL,
  `usuario` varchar(15) character set latin7 collate latin7_general_cs default NULL,
  `senha` varchar(32) default NULL,
  `endereco` varchar(150) default NULL,
  `bairro` varchar(50) default NULL,
  `cidade` varchar(50) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `nascimento` date default NULL,
  `telefone1` varchar(15) default NULL,
  `celular` varchar(15) default NULL,
  `telefone2` varchar(15) default NULL,
  `sexo` enum('Masculino','Feminino') NOT NULL,
  `nomemae` varchar(80) default NULL,
  `rg` varchar(50) default NULL,
  `email` varchar(100) default NULL,
  `comissao` float default NULL,
  `codigo_areaatuacao1` int(5) default NULL,
  `codigo_areaatuacao2` int(5) default NULL,
  `codigo_areaatuacao3` int(5) default NULL,
  `conselho_tipo` varchar(30) default NULL,
  `conselho_estado` varchar(30) default NULL,
  `conselho_numero` varchar(30) default NULL,
  `ativo` enum('Sim','Não') default NULL,
  `foto` blob,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `encaminhamentos`
#

CREATE TABLE `encaminhamentos` (
  `encaminhamento` TEXT NULL DEFAULT NULL ,
  `codigo_paciente` INT NOT NULL ,
  PRIMARY KEY ( `codigo_paciente` )
) ENGINE = MYISAM;

# ############################

#
# Estrutura da tabela `especialidades`
#

CREATE TABLE IF NOT EXISTS `especialidades` (
  `codigo` int(5) NOT NULL auto_increment,
  `descricao` varchar(100) NOT NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

#
# Extraindo dados da tabela `especialidades`
#

INSERT INTO `especialidades` (`codigo`, `descricao`) VALUES
(1, 'Cirurgia e Traumatologia Buco Maxilo Faciais'),
(2, 'Clínica Geral'),
(3, 'Dentistica'),
(4, 'Dentistica Restauradora'),
(5, 'Disfuncao Temporo-Mandibular e Dor-Orofacial'),
(6, 'Endodontia'),
(7, 'Estomatologia'),
(8, 'Implantodontia'),
(9, 'Odontologia do Trabalho'),
(10, 'Odontologia em Saude Coletiva'),
(11, 'Odontologia Legal'),
(12, 'Odontologia para Pacientes com Necessidades Especiais'),
(13, 'Odontogeriatria'),
(14, 'Odontopediatria'),
(15, 'Ortodontia'),
(16, 'Ortodontia e Ortopedia Facial'),
(17, 'Ortopedia Funcional dos Maxilares'),
(18, 'Patologia Bucal'),
(19, 'Periodontia'),
(20, 'Protese Buco Maxilo Facial'),
(21, 'Protese Dentaria'),
(22, 'Radiologia'),
(23, 'Radiologia Odontologica e Imaginologia'),
(24, 'Saúde Coletiva');

# ############################

#
# Estrutura da tabela `estoque`
#

CREATE TABLE IF NOT EXISTS `estoque` (
  `codigo` int(15) NOT NULL auto_increment,
  `descricao` varchar(150) default NULL,
  `quantidade` varchar(25) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `estoque_dent`
#

CREATE TABLE IF NOT EXISTS `estoque_dent` (
  `codigo` int(15) NOT NULL auto_increment,
  `codigo_dentista` varchar(11) default NULL,
  `descricao` varchar(150) default NULL,
  `quantidade` varchar(25) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `evolucao`
#

CREATE TABLE IF NOT EXISTS `evolucao` (
  `codigo_paciente` int(10) NOT NULL,
  `codigo` int(10) NOT NULL auto_increment,
  `procexecutado` varchar(150) default NULL,
  `procprevisto` varchar(150) default NULL,
  `data` date default NULL,
  `codigo_dentista` varchar(11) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `exameobjetivo`
#

CREATE TABLE IF NOT EXISTS `exameobjetivo` (
  `codigo_paciente` int(10) NOT NULL,
  `pressao` varchar(150) default NULL,
  `peso` varchar(150) default NULL,
  `altura` varchar(150) default NULL,
  `edema` varchar(150) default NULL,
  `face` varchar(150) default NULL,
  `atm` varchar(150) default NULL,
  `linfonodos` varchar(150) default NULL,
  `labio` varchar(150) default NULL,
  `mucosa` varchar(150) default NULL,
  `soalhobucal` varchar(150) default NULL,
  `palato` varchar(150) default NULL,
  `orofaringe` varchar(150) default NULL,
  `lingua` varchar(150) default NULL,
  `gengiva` varchar(150) default NULL,
  `higienebucal` varchar(150) default NULL,
  `habitosnocivos` varchar(150) default NULL,
  `aparelho` enum('Sim','Não') default NULL,
  `lesaointra` varchar(150) default NULL,
  `observacoes` text,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;


# ############################

#
# Estrutura da tabela `exames`
#

CREATE TABLE IF NOT EXISTS `exames` (
  `exame` text,
  `codigo_paciente` int(11) NOT NULL,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `fornecedores`
#

CREATE TABLE IF NOT EXISTS `fornecedores` (
  `codigo` int(15) NOT NULL auto_increment,
  `nomefantasia` varchar(80) default NULL,
  `cpf` varchar(50) NOT NULL default '',
  `razaosocial` varchar(80) default NULL,
  `atuacao` varchar(80) default NULL,
  `endereco` varchar(150) default NULL,
  `bairro` varchar(40) default NULL,
  `cidade` varchar(40) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `celular` varchar(15) default NULL,
  `telefone1` varchar(15) default NULL,
  `telefone2` varchar(15) default NULL,
  `inscricaoestadual` varchar(40) default NULL,
  `website` varchar(100) default NULL,
  `email` varchar(100) default NULL,
  `nomerepresentante` varchar(80) default NULL,
  `apelidorepresentante` varchar(50) default NULL,
  `emailrepresentante` varchar(100) default NULL,
  `celularrepresentante` varchar(15) default NULL,
  `telefone1representante` varchar(15) default NULL,
  `telefone2representante` varchar(15) default NULL,
  `banco` varchar(50) default NULL,
  `agencia` varchar(15) default NULL,
  `conta` varchar(15) default NULL,
  `favorecido` varchar(50) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `fotospacientes`
#

CREATE TABLE IF NOT EXISTS `fotospacientes` (
  `codigo_paciente` int(10) NOT NULL,
  `codigo` int(10) NOT NULL auto_increment,
  `foto` mediumblob NOT NULL,
  `legenda` varchar(50) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `foto_padrao`
#

CREATE TABLE IF NOT EXISTS `foto_padrao` (
  `foto` blob NOT NULL
) ENGINE=MyISAM;

#
# Extraindo dados da tabela `foto_padrao`
#

INSERT INTO `foto_padrao` (`foto`) VALUES
(0xffd8ffe000104a4649460001010100c100c10000ffdb00430001010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101ffdb00430101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101010101ffc0001108008c006a03011100021101031101ffc4001e0001000104030101000000000000000000000a020708090304050601ffc4004010000005030104070408050305000000000102030405000611070812213109131422415191526171d215162332538193d11762a1c1e12473b23342b1f0f1ffc4001a010100030101010000000000000000000000020304010507ffc4003511000103020306040504020301000000000100021103210412311341516171f0228191a11432b1c1d1234252e162f133829205ffda000c03010002110311003f0099b76871f8eb7ea9ff007af417cfd3b438fc75bf54ff00bd113b438fc75bf54ffbd117e0ba58a1933854a1e62b1803d44d4456fee7d5bb16cf4565ee5be2162134004542ba95dc5b018e0042984c06f754803c3bdddf4e227b2d1abb74e9ebd562b5ddd235b2e5a4b9d175aaad173a390501a2abafcb988081b038e5e39e353c87f8fa69bb8ca81aac8d41cda58031c6c442b3b23d2fbb2547aa297d7092738110df41bb812860440047bc3c4d81100f2c79d4c5071fdaee36ff004b3eda892469e674e21772dfe972d91e75f1191afd7517bd8fb79041ca68064774037f38c88fc31438778fdaef31dc754da52e2749eecb366c1da0f4cf535ba4e6cbbdd8cd24a87701ac820753dc1d50a853710f4c0fc6aa2c8e3369f3f2fa4ad2ca94dda653bace3f5fcc2bca0e963630e5436433c1630e43cf81b1e9505d5576871f8eb7ea9ff7a2276871f8eb7ea9ff007a2276871f8eb7ea9ff7a2276871f8eb7ea9ff007a22e1a22511759d3b4192265dca809244011131b8070011e7c8338c067c6ba04a2d41ededd20b07a2117f566064c54bb2451395264c4e439d1c6f9416531c485c8e788ef0055f4e91798001bdff00be5e9c3ad352b35a09bff88d093d6776f518fd4cda4354f53e49dbe9db9e4cc9b950c616e574a9498111100100373001c08e78f956f661da078b5fbf7bb76e2bcf2f7ba65c60eee1c3cc5d58c5dd3972613aebaaa98444445450e71c9b9f13088f1abc35a370efbdca103da2ebad80f20a90b696e8ba980f20f4a4a2b8b606abea16984aa13164dd52f0ae90394c0541e2e2dcfba60360cdcc7eaf038f000f31cd56fa6c7ea3d2dc7f2ba091a18e91ef6efd548a7600e94735f8f6374d3591f358eb80e6237612cb2c541a4981b05005575bba9adec97250139ab057a059a491c6defcf9db7ad94711f2b5f97d0f7ee6782dfc327ad641aa2f192e9b96cb90a749648c07228430640c062f01c871e158e216c3aaedd71712889444a225116186d89aeecf4774ea7a48cf08829f472bd590ea703ae5298f802e40444377180e7e3563469c49b71be9ea78a8bdc1bbc1b127a6f1e927c942b758752a6b566fe9bbca71d2ae557ce96168455432856ad44e2254910308ee13c7743966bd6a2c0c60e275b46bf40bcb73cbc9719b9b026607f7bf77056c2ae514a225112889445ced9cb866e1076d1651bba6ca9176eba27122a8ac99b793513397025314c002021e35c201041b82208e21774b85293e89fdb8dcea55bc868dea0c9f69bb2dc6a0de35ebc5cc771271bbc5222639941de59ca3802ef644db9f9d79788a591d61e13a18b5e7ac7e7d46fc3d50406b8cb87a86c98326c4ee3c7aadeafa7e5cab22d0bf6889444a22e25942a4989cc6dcc721f7800880721e78ff0035d0ba3b95177e988d727cf6eb8bd368e5f71b95133b7e5218037cbbc25029c388f1f22980442b5e1e9e67c99cbf7f4fae92562c554102989926e40b5b766dd3cac77ad0e57a8b1a5112889444a22511288af56cfba9f29a45aaf695e714baa828c64db157ea8e24151b9950df218738dcc672020354d66e661e4ba1d94877f133bfed3e7653afd16be1b6a2e9a5a974b354a3f4945b65d5129badfb4509be60de130e4726e381c008080578ee96b8e9df55ebb5c1c03e2411efd77fdf5575ea289444a22f0ae4700d61de38ce3aa48c60f1e3b86f0a934c4f4fc2ea85574904f1e7b68fb80fd61952b444897f293bc6c807c315e8612d9a4dfbfc2f3b131b410328234e63bee1600d6e59d2889444a2251128894455a66dc55237b2aa66f1f03947c38fa570e87a1fa229b1746a4c3995d99ad132f8fb1648909e22050c8067f2e3e7c78d78d5624f5fb77f65e8513fa22370038f7afd392d8497880552af6dc0555175288be62f0eac6df9121f3de6ea631cf81478f970c873f3a9344ebd945081dbb8c736d0f7989c0383c326410f12a4631723efe3e15e96163c4bcbad26b662419601ff00931758695b1569444a225112889444a22a89f7d3ff00713ff98570e87a15c3a1e854d57a308a51d98ed8373c248943cbbc531873efc863cbdd5e2d599efbd17a586ca6940b811af38fbf25b19aa95e9444a22f9dba1a99d433e02980bb8d57371c8e7b9c0031f0a90fb84898e467d88fba84a7481c3b989da16e905c0401774b2c4c86070a1c4dff00cfeb5e9614822470f79bfd579759b96a9ef5858395b1569444a225112889444a22a89ff513ff00713ff98570e87a21bdb8a9ad746522b35d986d503263f6892072f01e4299fc31c38d78b5a73690bd3c2340a573ac70feef2085b1228888644303e5552bc800d8caaa8a29445d27c81176ca94c4138f54a00007f31703c0780f0e2203e01c38d75bec75efe88a21bd2d766a903ad6d24fa8ea1bcca0a0914c609bc888e439f31c788e43956ec2ba001d6077d7cd79b8b01af0f17dc6e758ecf2b2d481830610ce7038cf9d7a01521535d44a225112889444a22f7ed68771705c7070cd5232cb48c9b36a54cbf78dd62c501c72e41c6a2f30d7744efd4c5a77a9d86c8565a960e8959d6f2c90a4aa510c943147390fb12fdee001bc3bff00f686078f3c66bc47dce6e24f9f70bd5a632d368e035b5c75d4efd5650d414d2889445498044a2018c88638fbe8bab407d301a14f6e9b6995e1148196756faa0b1c83dd3aa9282207c0094378039948411388f11eee4d5a68bf2bc104df522343aefb0f2e2b362585cc91123c422419e0205dd1d47085193592322a289285326aa4a1935113944874ce51c18a601e4203efaf55ae9008b8dc78fd0fb2f3efa1f3bce9c79ae1a9225112889444a225116e27a2e76279ad5fbf233566e764a37b26da5bb43717081bfd73d4950145248a72ee29bfb807c870eac788873ac588abab0473bf7c6cb450a45ce0ed1a3dcfa296eb2688b16a8344080449ba49a2994000a0522650290a005e000528014003800057987fd2f43ed65daa2251128894456f750b4d6dad4883790770b34dcb674d1c35314e5298bbaba66267bdc84b9c944390e3c82a40ff00befd7aa1f16b795153e905e8ef9ad1195737d59ad8cbda6ed550eb9504f7c8d8c6111032ea0177c4c60e3bd9dc01ce78d6bc3d5876f20db9f48f2b7e163c4321b22047888fa99de78cad3f9c864cc621c374c5112983c8439857a520dc68b1aa6ba89444a22511663ec87b265dbb4b5eac59b464e0b6cb57888c9bd297b8a22060de290c25129833801e3de0c8565c457d9f847cdbf88e9e5e9aabe8d2351c2de1bdfbdfeca68fa13a5103a31a6b6e5876fb441ab486649207ea49bbd6ac040eb5538f31318e26e79dd0ee8700af2dce275d64cf1d67be8bd10d0c194191d67901e415e2a8a25112889444a22511588da52d186bcb46af88b996e82e8042bd553ebc8530114220a180433c8dc3ba3e1e1526120dbbefbdca2f00b1c0cc46e13eca071a82c9bc75e771316a25ea1aca3a45302f22948a98a05f1ce31cf98d7b54fe51f995e408bc19b9f2e5bd7c6d58ba9444a22fc1e43f0a22973743c5a5111da02da593410fa41d2e2a2aa80075a39c88072e581e381fcabc6aff003bbaf19e3dfb68bd1c37fc79a66d6b46ff00517dcb717542bd2889444a225115260110ee8e07ceba175700ac4440c2b280001ccc6e001f98d775fb988e1c1488e82da4ad6cf486ed636769268fdc56fb09868eae79d64bb241b20b90e644144cc4113ee184c51011e021ff008ab68b333875ddcbb9f2e8b2d7aa29b48de6c35e37d3eea19926fd794917b24e4dbcbbe74b39547ccca9c4dfdebd868800700bce1dcae8d75128894441e43445231e899daaad7b7603f87171bf6f1ea1ce42b632ca94a50503052e4044374796403808f3e39af32bd321c4ea3bfc9dfaf25b30b518d191c622609d21c748f4befeaa4451d32c65504dcb17e8b94140289544d42180404038f7447fa70cd65bee023feba77c7cd6ff000c73f30bdc0f8e6a0a0bf6889444a22b57aa5abf66693c1b999baa51bb24914543814ca90a711294440302601cf0a9341d45ef11bfbff7b97090352a3e5b58f4b249bc5df5bda5ea9d048a2a25db89f7f7789378a25307201cf0e239c70e75b29e1c9d4ebbbf3f7fed61a9892e96b45ee083a5f7fdf96e5a38d45d54bcf54259796bb265e492cb286537575d45085130e7ba0611c07f2870f3cf3adcc6065c6bde8b35e4b89927b81c95b7ab112889444a22e702a221f78c537f3631fd03351f17007d947c5c01f65ebc05c9336b48252508fd666e90301c87454394a2203bc19dd128f3e78c08f21c8508cdaff6a4b679b3ef4a1ea7e9828c985c4bb9978c4770870595150a0981b182e404dc4a38001e58e23e3592a61b7b23d63af7a95736bbdbcc7d3f3c392df16cff00d247a3dab0dda377b269c1c92a5214c9bb549d418e2001c077bba006371e21efcd647d370d4758d47b77e8b5b2bb1d69bf3b7de39f05b1784b9612e2689bd879266fdba8192aad9722a41e019e2511e59c71c71e154477bfd15e2f7171c57bb5c45ac3dabfa4af4a342527b0102fd1b86eb4ca299906aa10e9365440400a7390c381def0f7639d5eca2e75f4f2f481afa8f259eae2594f421c7f8837e72a347b4aedaba99b404c3b5a4a59d21187554ea9922b1c8dca43604bba42e03977473ceb7d3a197fbd7bb0581ef7d4273481711e7cb9715854750ea984ea18c73184444c61111111f78d69d171515d44a225112889444a22511288bd38b9994857047316f9cb25886de28a0a9c81bc1c844a530070a8b9a1c2e39738de11670e847484ebb68a48b63b59e732b1698a60ab174b1d448e997818a291c44bba2001f747203c6a87e198e16d79f77f65632abd9bc91699e5df05b206fd37f2e08200bd9e415c114c161044702a8103ac10ef72dfce2a8f85a9fcbe8adf8b7ff01dff00d96812727e5ae391752b30f577af1e2c759655650e7131ce22223de11adc1a1ba6bc7f1c02cd179debc6a9225112889444a225112889444a225112889445d806ca0f1eefaff8a8671cd4338e6bb5d8833f7b8797f9c7f6ab323ffc7dff000aadb72efd57211aa65f7fc78ffefa5366e3f33801c1bf92a26b13a77df55c866e99804318f8007ed5dd881a120f383f85115083b96c1749ece8d5f44ac892d0fd0bd9b768ad4976d6f236af5b5ad8baf37aa51f7d36b91ea7665afa3da76c7502c8ba2ee827da74942cfbb6b69c25d675671c4de64115d0711ed31d5cc2a9151d558c19723a9c35907e6351c43834874897385b72f670ee6bb0f4dd470f85c4d587ed9957c55b6a1c7232852da31f51a696571d987df35ed0ad3bfd09b37522edd59beadd9e63b356865a175db367ba75ac517774d3cb6f546e28059fc9e9b276e69ec2ddb73b44826adebf9e5be776c0ec212d886610f332df4d8a49b9987bda18d2d356a39a5c32165d80fcd2e7006c5b31a932042af2d1aafad503be16831eda64d66bce5ace6e634b2d36bde2eda85b221ad686b8e6b1e46bb16dd82ef539c4d6a6e98dad64696595a55aa529a93703a9e696edc1a4facae9e2564dfb6d449624f75baedad598c87d49710885fce08b24c99dbabc9028d4adb1f0814dc4bdcf606c89da53f9987708fe53979a7c33a6b4d4a4da7469d1ac6b39ce0d751ae4ecea35b933de27265da1d036571df9b195eba796f5e72b237ae9dcd5c562db315a9737a7f012cf9fdce9687dc6ea1195adacae1c76224144c4dc4e2e6b68cd6c2989365aa2c99ceb09293b45ab031dc14cab9cb4789a1c4b03b2db68d99a77326329f181924407155d5c356a4d792fa25f4d8dacea4c74bfe1df9432b9d5ad6bb3b229b88ac03812c017b7b34e9d6982fa43b546b9de8e74e276e3d0cb42c67365e9aea642deb396c4eb9be2ef6f6dbd92958eb552669bd74e9158d05650af71c6161aef3a1313481e088a2a1dac2a07d1a6d2f8a8e7667b03416e513bceed5d6d34baee10b3e1f1b897ec4bb0cca469d2ac2a39aeda54c8490c027f8d3f108a977785794d76359972d98401755b4e8bae93163a3a890fb3928daf4fafb236ebeb355d4b8c3277816dc1d2b6eea434dd21bc9141dde490a0cc4b0ee8529fde8f0e6d77c3b641d90d6cadcb39b27cb9c3fe7f0fcb7d5061ea599b5a3f12ea7b56e122a6d5cc2cda8fd4cbb0bd2f1dea6963e2b2fabd40d90ad40b93672b6b49353eddb90baa1b2bc2ed07a93713d2dda8c3d8f16c185c13d7d5fae1bc9db31b2aa5a2dede8872fe2ed8806737746f404b20464b387f16939e36a3a2b178232563498d86cb89ca1adb3fe69372605f8053ab4067c2328d5a6fdb609b8aaae22a014da039d52a5da096063490c199f2d75ae26c66a868337b06d7b73502d5d4fb2b5974dee5b8a5aca6f7d58ac6ef858f637d41c547dc12768bd87bf606d9b8c5e37b765e2668251b45ad06aa2fc8d139033f41cb64ada64bdc58e069bc00ecae00cb49203a5af70d411acdb459eb34d2a6dacca94b1145ef34c55a62a340a8d6871616d56b1d21a43a632de264156305917c04407e39fed56647ff0087bfe166dbf2efd501914399847e1c2bb91f3fb63cc9fa04dbf00bb1d9d2f673f131bf7ab3237f8b7d02ab68ee5ff96fe1735494128894459276bdddb324c58f67c16ae587acd037858acae286677b6cf531a7300fef38f9e9b7b3e84ddf8e6f98c7d24a5db00322bdb50eea1176ac13b598c63751317657073d0e6d70f71a6ea65ae8396a871ca40021b948f09893fe44adaca983752632bd2c435f4c39a2a614d269a81ce2ecd54d404ed1b395b961a191695929696dfce585d5ae2e9e29ac9a576d6afdcba5f73a733b3b5d36a426a7343e8f586a6995af093afef68d94b62461ee2b6d63dc57a19ab24dfab7ba48ad14b251265913d0ec248a7f2542c0f1155a4b7f51d9c919483e1366eecbadd6b67ff522a6209f88a2caefa4fcd857b1b57f429ec58d71a80b0b5ecf154b4ed223c321597d52da7dbea3c26d2f0af1aea2dc0eb5ba0b40ed9b7ef1d48bc51bb2f16ac743ee67d361317dbcea88d5696b8dabc041186b412616c5b8e0864a25a251e254c2d6502c344f806ccd6710d6e51faadcb0de439dcef59eb634556e2dbfaae3881866b6a557e7a918779766a874cce1032b218ddd65d8bbb6a182b96e5da2a7d0b32659a7ae3b34e98682c736564e39456de96d3e67a2cd5ddcf26a268948fe3253f852f4cd183404deb72ccb12aea9bb239dee0a0e0288cc3f4eb3ea9b1b879a860731b4f65d7635ae7e29fb370f88c1d1c30b8f09a4dc30ce78b4ec1d005c661c0ab2d646a5b1b4f497687d357510f5f3ad6e80d30858e966ce9ba2d6dd3581a8cd6f978e241b2a432cf8928d5b1a35a11a9933377472aebef22025ab9ecccfa4e9ff008cbc9e799997fb59a95614e862e89692712ca2d041b3767545424f1902070d564d30daab4a1adcf6febb2d61ea829b47db3a571ba611f1a94fd9a5d9fdca30ba44b685c7cb3f667603a9a0aab63a859a7c8b696293eb8944adf76087b3d67d8548348399b13533cc3b6bf3ed08d727cd6d3e5e6b68c7510f6e24d3ac716ca228819a9fc298a1f0e0911b6ff8efafcffe365f0b6aed33090f2fa2f2b2f684d3a1b1b668b93647bf918a938f47e98d2b9883b82d46375d8e67a8a9f47ea4b680bb671cbd4ee2ed76a2b36da185bb3247f6f4d499a04ed21c3c559b5d9234a808743a3f64b469e289deaa66318d7619ce63bf4b06fc0d4ca478a8b9ae607d3916ab96a3c9cd2ccd96d1217c76aa6a86983ed2fb3f44f45edfd488fb06ddd43b93561f4c6af4ada7257b3bbc6e5b5a0aca7118cbea3328eb792b51b41db71ef10170d8d3469870f8145c580374cb26537ed0d5a85b98b05386021b9412e9f112665c77c7255d7af44d1661b0ecaa29b6abeb97572c350d47b1b4cb46cc0664cad047eecd3b963955eb1a511288bd4ec497b4a7a97e5a227624bda53d4bf2d113b125ed29ea5f96889d892f694f52fcb444ec497b4a7a97e5a227624bda53d4bf2d113b125ed29ea5f96889d892f694f52fcb444ec497b4a7a97e5a227624bda53d4bf2d113b125ed29ea5f96889d892f694f52fcb444ec497b4a7a97e5a227624bda53d4bf2d117fffd9);

# ############################

#
# Estrutura da tabela `funcionarios`
#

CREATE TABLE IF NOT EXISTS `funcionarios` (
  `codigo` INT NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) default NULL,
  `cpf` varchar(50) default NULL,
  `usuario` varchar(15) character set latin7 collate latin7_general_cs default NULL,
  `senha` varchar(32) default NULL,
  `rg` varchar(50) default NULL,
  `estadocivil` enum('solteiro','casado','divorciado','viuvo') default NULL,
  `endereco` varchar(150) default NULL,
  `bairro` varchar(50) default NULL,
  `cidade` varchar(50) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `nascimento` date default NULL,
  `telefone1` varchar(15) default NULL,
  `telefone2` varchar(15) default NULL,
  `celular` varchar(15) default NULL,
  `sexo` enum('Masculino','Feminino') default NULL,
  `email` varchar(100) default NULL,
  `nomemae` varchar(80) default NULL,
  `nascimentomae` date default NULL,
  `nomepai` varchar(80) default NULL,
  `nascimentopai` date default NULL,
  `enderecofamiliar` varchar(220) default NULL,
  `funcao1` varchar(80) default NULL,
  `funcao2` varchar(80) default NULL,
  `admissao` date default NULL,
  `demissao` date default NULL,
  `observacoes` text,
  `ativo` enum('Sim','Não') default NULL,
  `foto` blob,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

#
# Extraindo dados da tabela `funcionarios`
#

INSERT INTO `funcionarios` (`codigo`, `nome`, `cpf`, `usuario`, `senha`, `rg`, `estadocivil`, `endereco`, `bairro`, `cidade`, `estado`, `pais`, `cep`, `nascimento`, `telefone1`, `telefone2`, `celular`, `sexo`, `email`, `nomemae`, `nascimentomae`, `nomepai`, `nascimentopai`, `enderecofamiliar`, `funcao1`, `funcao2`, `admissao`, `demissao`, `observacoes`, `ativo`, `foto`) VALUES
(1, 'Administrador', '11111111111', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', 'solteiro', '', '', '', 'MG', 'Brasil', '', NULL, '', '', '', 'Masculino', '', '', NULL, '', NULL, '', 'Administrador da clínica', '', NULL, NULL, '', 'Sim', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `honorarios`
--

CREATE TABLE `honorarios` (
  `codigo` varchar(10) NOT NULL default '',
  `procedimento` varchar(200) NULL default NULL,
  `valor_particular` float NULL default '0',
  `valor_convenio` float NULL default '0',
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM ;

--
-- Extraindo dados da tabela `honorarios`
--

INSERT INTO `honorarios` VALUES('EX001', 'Consulta inicial: exame clínico e plano de tratamento', 61, 0);
INSERT INTO `honorarios` VALUES('EX002', 'Urgência: noturna, sábado, domingos e feriados', 116, 45);
INSERT INTO `honorarios` VALUES('EX003', 'Avaliação técnica: perícia inicial ou final', 45, 0);
INSERT INTO `honorarios` VALUES('EX004', 'Falta a consulta', 49, 30);
INSERT INTO `honorarios` VALUES('DE001', 'Restauração de Amálgama - 1 Face', 52, 35);
INSERT INTO `honorarios` VALUES('DE002', 'Restauração de Amálgama - 2 Face', 66, 40);
INSERT INTO `honorarios` VALUES('DE003', 'Restauração de Amálgama - 3 Faces', 77, 45);
INSERT INTO `honorarios` VALUES('DE005', 'Restauração de Amálgama - Pim', 100, 60);
INSERT INTO `honorarios` VALUES('DE004', 'Restauração  de almálgama - 4 Faces', 77.5, 50);
INSERT INTO `honorarios` VALUES('DE006', 'Restauração Resina Folopolimerizável - 1 Face', 63, 40);
INSERT INTO `honorarios` VALUES('DE007', 'Restauração Resina Fotopolimerizável - 2 Face', 66, 50);
INSERT INTO `honorarios` VALUES('DE009', 'Restauraçao Resina Fotopolimerizável - 4 Face', 100, 65);
INSERT INTO `honorarios` VALUES('DE010', 'Faceta em Resina Fotopolimerizável', 110, 85);
INSERT INTO `honorarios` VALUES('DE011', 'Núcleo de Preenchimento em Ionômero de Viddro', 63, 35);
INSERT INTO `honorarios` VALUES('DE012', 'Núcleo de Preenchimento em Resina Folopolimerizável', 80, 40);
INSERT INTO `honorarios` VALUES('DE014', 'Núcleo de Preenchimento em Almálgama', 80, 45);
INSERT INTO `honorarios` VALUES('DE016', 'Pino de Retenção Intradicular', 171, 70);
INSERT INTO `honorarios` VALUES('DE017', 'Clareamento de Dente Vitalizado ( por Elemento )', 40, 35);
INSERT INTO `honorarios` VALUES('DE018', 'Restauração Inlay e Onlay (Arglas-Solidex)', 426, 250);
INSERT INTO `honorarios` VALUES('DE019', 'Clareamento  de Dente Vitalizado e Desvitalizado com Moldeiras de Uso Caseiro (por arcada)', 268, 150);
INSERT INTO `honorarios` VALUES('DE020', 'Restauração Metálica Fundida', 219, 140);
INSERT INTO `honorarios` VALUES('DE021', 'Restauração Temporária', 46, 35);
INSERT INTO `honorarios` VALUES('EN002', 'Tratamento Endodôntico Pré-Molares (não inclue radiografias)', 220, 180);
INSERT INTO `honorarios` VALUES('EN003', 'Tratamento Endodôntico Molar (não inclue radiografias)', 350, 260);
INSERT INTO `honorarios` VALUES('EN004', 'Retratamento Endodôntico Incisivo ou Canino (não inclue radiografias)', 203, 160);
INSERT INTO `honorarios` VALUES('EN005', 'Retratamento Endodôntico Pré- Molar (não inclue radiografias)', 270, 210);
INSERT INTO `honorarios` VALUES('EN001', 'Tratamento Endodôntico Incisivo ou Canino (não inclue radiografias)', 188, 140);
INSERT INTO `honorarios` VALUES('DE022', 'Clareamento Dental em Consultório - Técnica com peróxido de carbamida a 35% - Dente Unitário', 189, 110);
INSERT INTO `honorarios` VALUES('OD001', 'Aplicação Tópica de Flúor-Verniz ( quatro hemiarcadas )', 35.26, 30);
INSERT INTO `honorarios` VALUES('OD002', 'Aplicação de Salante ( por elemento)', 35, 30);
INSERT INTO `honorarios` VALUES('OD003', 'Aplicação de Salante- Téorica Invasiva (por elemento)', 42, 35);
INSERT INTO `honorarios` VALUES('OD004', 'Aplicação Cariostático 1 Sessão ( quatro hemiarcadas)', 32, 20);
INSERT INTO `honorarios` VALUES('DE015', 'Ajuste Oclusal ( por sessão )', 64, 45);
INSERT INTO `honorarios` VALUES('DE008', 'Restauraçao Resina Fotopolimerizável - 3 Face', 94, 55);
INSERT INTO `honorarios` VALUES('DE013', 'Restauração Inlay Onlay de Porcelana', 450, 360);
INSERT INTO `honorarios` VALUES('EN006', 'Retratamento do Molar (não inclue radiografias)', 470, 320);
INSERT INTO `honorarios` VALUES('EN008', 'Remoção de Núcleo Intrarradicular (por elemento) (não inclue radiografias)', 114, 70);
INSERT INTO `honorarios` VALUES('EN009', 'Capeamento Pulpar (excluindo restauração final)', 68, 35);
INSERT INTO `honorarios` VALUES('EN010', 'Pulpotomia', 79, 40);
INSERT INTO `honorarios` VALUES('EN011', 'Clareamento Dental em consultório-Técnica com peróxido de carbamida a 35% por d', 189, 110);
INSERT INTO `honorarios` VALUES('EN012', 'Preparo para Núcleo Intrarradicular', 52, 35);
INSERT INTO `honorarios` VALUES('EN014', 'Urgência Endodôntico Pulpectoma (Indenpente da sequência do tratamento)', 83, 35);
INSERT INTO `honorarios` VALUES('EN015', 'Apicectomia de Caninos ou Incisivos (não inclue radiografias)', 177, 140);
INSERT INTO `honorarios` VALUES('EN016', 'Apicectomia de Caninos -Incisivos com Obturação Retrograda (não inclue radiografias)', 202, 180);
INSERT INTO `honorarios` VALUES('EN013', 'Tratamento de Dentes Rizogênese Incompleta (por sessão)', 78, 40);
INSERT INTO `honorarios` VALUES('EN007', 'Tratademento de Perfuração (não inclue radiografias)', 130, 70);
INSERT INTO `honorarios` VALUES('EN017', 'Apicectomia Pré-Molares (não inclue radiografias)', 209, 155);
INSERT INTO `honorarios` VALUES('EN018', 'Apicectomia Pré-Molares com obturação retrograda (não inclue radiografias)', 236, 170);
INSERT INTO `honorarios` VALUES('EN019', 'Apicectomia de Molares (não inclue radiografias)', 242, 190);
INSERT INTO `honorarios` VALUES('EN020', 'Apicectomia de Molares com obturação retrogada (não inclue radiografias)', 269, 220);
INSERT INTO `honorarios` VALUES('EN021', 'Remoção de Corpo estranho intracanal por conduto', 89, 40);
INSERT INTO `honorarios` VALUES('EN022', 'Curativo de demora', 102, 40);
INSERT INTO `honorarios` VALUES('EN023', 'Reembasamento provisório', 34, 20);
INSERT INTO `honorarios` VALUES('EN024', 'Restauração Temporária', 46, 30);
INSERT INTO `honorarios` VALUES('OD005', 'Remineralização- Fluorterapia (quatro sessões)', 35, 30);
INSERT INTO `honorarios` VALUES('OD006', 'Adequação do Meio Bucal com Iônomero de Vidro (por hemiarcada)', 66, 35);
INSERT INTO `honorarios` VALUES('OD007', 'Adequação do Meio Bucal com IRM (por hemiarcada)', 65, 30);
INSERT INTO `honorarios` VALUES('OD008', 'Restauração a Iônomero de vidro (1 face)', 59, 35);
INSERT INTO `honorarios` VALUES('OD009', 'Restauraão Preventiva (iônomero + selante)', 60, 35);
INSERT INTO `honorarios` VALUES('OD011', 'Pulpotomia', 78, 40);
INSERT INTO `honorarios` VALUES('OD012', 'Tratamento Endodôntico em Decidios (não inclue as radiografias)', 142, 90);
INSERT INTO `honorarios` VALUES('OD013', 'Exdontia de Dentes Decídios', 44, 30);
INSERT INTO `honorarios` VALUES('OD014', 'Mantenedor de Espaço', 208, 80);
INSERT INTO `honorarios` VALUES('OD015', 'Placa de Mordida', 174, 70);
INSERT INTO `honorarios` VALUES('OD017', 'Condicionamento Odontopediatria (por sessão)', 47, 30);
INSERT INTO `honorarios` VALUES('OD018', 'Ulotomia', 72, 35);
INSERT INTO `honorarios` VALUES('OD019', 'Utlectomia', 78, 40);
INSERT INTO `honorarios` VALUES('OD020', 'Restauração Temporária', 46, 35);
INSERT INTO `honorarios` VALUES('OD010', 'Coroa de Aço', 125, 60);
INSERT INTO `honorarios` VALUES('OD016', 'Plano Inclinado', 176, 80);
INSERT INTO `honorarios` VALUES('PE001', 'Tratamento Não Cirúrgico da Periodontite Leve (por segmento) Baixo Risco', 67, 40);
INSERT INTO `honorarios` VALUES('PE002', 'Tratamento Não Cirúrgico da Periodontite Moderado  (Por Segmento) Médio Risco', 78, 45);
INSERT INTO `honorarios` VALUES('PE003', 'Tramento Não Cirúrgico da Periodontite Grave (Por Segmento) Alto Risco', 90, 50);
INSERT INTO `honorarios` VALUES('PE004', 'Tratamento de Processo Agudo (por sessão)', 80, 40);
INSERT INTO `honorarios` VALUES('PE005', 'Controle de Placa Bacteriana (por sessão)', 32, 20);
INSERT INTO `honorarios` VALUES('PE006', 'Dessensilização Dentária (por segmento)', 40, 25);
INSERT INTO `honorarios` VALUES('PE007', 'Imobilização Dentária Com Resina Fotopolimerizável (dentes)', 111, 60);
INSERT INTO `honorarios` VALUES('PE008', 'Ajuste Oclusal ( por sessão )', 64, 45);
INSERT INTO `honorarios` VALUES('PE010', 'Placa de  Mordida Miorelaxante', 177, 120);
INSERT INTO `honorarios` VALUES('PE011', 'Proservação Pré-Cirúrgia (por segmento)', 61, 30);
INSERT INTO `honorarios` VALUES('PE012', 'Gegivectomia (por segmento)', 140, 70);
INSERT INTO `honorarios` VALUES('PE013', 'Cirúrgia Retalho ( por segmento)', 150, 100);
INSERT INTO `honorarios` VALUES('PE014', 'Sepultamento Radicular (por raiz)', 148, 100);
INSERT INTO `honorarios` VALUES('PE015', 'Cunha distal', 139, 80);
INSERT INTO `honorarios` VALUES('PE016', 'Extensão de Vestíbulo (por Segmento)', 154, 80);
INSERT INTO `honorarios` VALUES('PE017', 'Enxerto Pediculado (por segmento)', 147, 90);
INSERT INTO `honorarios` VALUES('PE018', 'Enxerto Livre ( por segmento)', 175, 100);
INSERT INTO `honorarios` VALUES('PE019', 'Enxerto Conjuntivo Subepitelial', 175, 100);
INSERT INTO `honorarios` VALUES('PE020', 'Frenectomia ou  Bridectomia', 126, 90);
INSERT INTO `honorarios` VALUES('PE021', 'Odonto-Sessão ( por elemento)', 143, 80);
INSERT INTO `honorarios` VALUES('PE022', 'Amputação Radicular Sem Obturação Retrograda- por Raiz', 179, 110);
INSERT INTO `honorarios` VALUES('PE023', 'Amputação Radicular Com Obturação Retrograda- por Raiz', 205, 140);
INSERT INTO `honorarios` VALUES('PE025', 'Tratamento Periodico de Manutenção para periodontite leve de 6 em 6 meses', 159, 80);
INSERT INTO `honorarios` VALUES('PE026', 'Tratamento Periodico de Manutenção para periodontite leve de 4 em 4 meses', 159, 80);
INSERT INTO `honorarios` VALUES('PE027', 'Tratamento Periodico de Manutenção para periodontite leve de 2 em 2 meses', 159, 80);
INSERT INTO `honorarios` VALUES('PR001', 'Profilaxia: Pol. Coron. (4 hemiarcadas) e Apl. de Jato de Bicarbonato - Tartarec', 56, 40);
INSERT INTO `honorarios` VALUES('PR002', 'Aplicação de Jato de Bicabornato', 80, 40);
INSERT INTO `honorarios` VALUES('PR003', 'Or. de Higiene Bucal.:cárie d.,doen. period.,câncer b.,manut. de prótese.,uso de dentif. e enxaguat.', 40, 30);
INSERT INTO `honorarios` VALUES('PR004', 'Aplicação Tópica de Flúor (excluindo profilaxia )', 40, 30);
INSERT INTO `honorarios` VALUES('PR005', 'Controle de Placa Bacteriana ( por sessão )', 32, 15);
INSERT INTO `honorarios` VALUES('PR006', 'Tratamento de Gengivite-Terapêutica básica ( duas hemiarcadas)', 74, 40);
INSERT INTO `honorarios` VALUES('TE001', 'Teste de Risco de Cárie', 40, 30);
INSERT INTO `honorarios` VALUES('TE002', 'Ph', 40, 30);
INSERT INTO `honorarios` VALUES('TE003', 'Capacidade Tampão', 40, 30);
INSERT INTO `honorarios` VALUES('TE004', 'Fluxo Salivar', 40, 30);
INSERT INTO `honorarios` VALUES('TE005', 'Biópsia de Lesões Sugestivas (Acrescentar os Honorários do Laboratório)', 230, 110);
INSERT INTO `honorarios` VALUES('TE006', 'Citologia Esfoliativa (acrescentar honorários do laboratório)', 200, 90);
INSERT INTO `honorarios` VALUES('RA001', 'Periapical', 10, 7);
INSERT INTO `honorarios` VALUES('RA002', 'Interproximal ( Bite-Wing )', 10, 7);
INSERT INTO `honorarios` VALUES('RA003', 'Oclusal', 23, 15);
INSERT INTO `honorarios` VALUES('RA004', 'RX Postero Anterior', 51, 30);
INSERT INTO `honorarios` VALUES('RA005', 'RX da ATM Série Completa ( três incidências )', 98, 50);
INSERT INTO `honorarios` VALUES('RA006', 'Panorâmica', 46, 30);
INSERT INTO `honorarios` VALUES('RA007', 'Telerradiografia com Traçado Computadorizado', 62, 40);
INSERT INTO `honorarios` VALUES('RA008', 'Telerradiografia sem Traçados Computadorizado', 51, 30);
INSERT INTO `honorarios` VALUES('RA009', 'RX de Mão ( Carpal )', 56, 30);
INSERT INTO `honorarios` VALUES('RA010', 'Modelos Ortodônticos (par)', 54, 25);
INSERT INTO `honorarios` VALUES('RA011', 'Slides ( unidade )', 10, 7);
INSERT INTO `honorarios` VALUES('RA012', 'Fotografia ( unidade )', 10, 6);
INSERT INTO `honorarios` VALUES('PO023', 'Prótese Fixa Adesiva Direta (por elemento)', 189, 100);
INSERT INTO `honorarios` VALUES('PO001', 'Planejamento em Prótese-modelo de est. par. montagem em articul. semi ajustável', 85, 40);
INSERT INTO `honorarios` VALUES('PO002', 'Enceramento de Diagnóstico (por elemento)', 92, 50);
INSERT INTO `honorarios` VALUES('PO003', 'Ajuste Oclusal(por sessão)', 64, 45);
INSERT INTO `honorarios` VALUES('PO004', 'Restauração Metálica Fundida', 219, 140);
INSERT INTO `honorarios` VALUES('PO005', 'Restauração Inlay e Onlay de Porcelana', 440, 400);
INSERT INTO `honorarios` VALUES('PO006', 'Remoção de Restaurações Metálicas ou Coroas', 39, 20);
INSERT INTO `honorarios` VALUES('PO007', 'Recolocação de Restauração Metálica Fundida ou Coras', 50, 35);
INSERT INTO `honorarios` VALUES('PO008', 'Núcleo Metálico Fundido', 154, 70);
INSERT INTO `honorarios` VALUES('PO009', 'Coroa Provisória em Dente de Estoque', 86, 45);
INSERT INTO `honorarios` VALUES('PO010', 'Coroa Provisória Prensada em Acrílico no Laboratório', 176, 90);
INSERT INTO `honorarios` VALUES('PO011', 'Reembasamento Provisório', 34, 20);
INSERT INTO `honorarios` VALUES('PO012', 'Coroa de Jaqueta Acrílica', 215, 100);
INSERT INTO `honorarios` VALUES('PO013', 'Coroa de Porcelana  Pura', 508, 410);
INSERT INTO `honorarios` VALUES('PO014', 'Coroa Metalo Cerâmica', 448, 350);
INSERT INTO `honorarios` VALUES('PO016', 'Coroa de Venner', 363, 170);
INSERT INTO `honorarios` VALUES('PO017', 'Coroa Total Metálica', 256, 150);
INSERT INTO `honorarios` VALUES('PO018', 'Coroa 3/4 ou 4/5', 252, 150);
INSERT INTO `honorarios` VALUES('PO019', 'Faceta Laminada de Porcelana', 441, 400);
INSERT INTO `honorarios` VALUES('PO020', 'Prótese Fixa em Metalo Cerâmica(por elemento)', 602, 350);
INSERT INTO `honorarios` VALUES('PO021', 'Prótese Fixa em Metalo Pástica(por elemento)', 459, 200);
INSERT INTO `honorarios` VALUES('PO025', 'Prótese Fixa Adesiva Indireta em Metalo Plástica(3 elementos)', 578, 310);
INSERT INTO `honorarios` VALUES('PO024', 'Prótese Fixa  Adesiva Indireta em Metalo Cerâmica(3 elementos)', 808, 630);
INSERT INTO `honorarios` VALUES('PO026', 'Prótese Parcial Removível Provisória em Acrílico ou sem Grampos', 427, 180);
INSERT INTO `honorarios` VALUES('PO027', 'Prótese Parcial Removível com grampos Bilateral', 751, 360);
INSERT INTO `honorarios` VALUES('PO028', 'Prótese Parcial Removível para Encaixes', 1013, 650);
INSERT INTO `honorarios` VALUES('PO029', 'Encaixe Fêmea (por elemento)', 432, 290);
INSERT INTO `honorarios` VALUES('PO030', 'Encaixe Macho(por elemento)', 432, 290);
INSERT INTO `honorarios` VALUES('PO031', 'Reembasamento de Prótese Total ou Parcial', 221, 110);
INSERT INTO `honorarios` VALUES('PO032', 'Prótese Total', 962, 290);
INSERT INTO `honorarios` VALUES('PO033', 'Prótese Total Caracterizada', 1205, 350);
INSERT INTO `honorarios` VALUES('PO034', 'Prótese Total Imediata', 618, 230);
INSERT INTO `honorarios` VALUES('PO035', 'Casquete de Moldagem', 71, 40);
INSERT INTO `honorarios` VALUES('PO036', 'Ponto de solda', 151, 90);
INSERT INTO `honorarios` VALUES('PO037', 'Guia Cirúrgico para Prótese Imediata ou para Cirurgia de Implante', 215, 120);
INSERT INTO `honorarios` VALUES('PO038', 'Placa de Mordida Miorrelaxante', 170, 140);
INSERT INTO `honorarios` VALUES('PO040', 'Jig ou Front Platô', 84, 50);
INSERT INTO `honorarios` VALUES('PO041', 'Conserto em Prótese Total ou Parcial', 127, 45);
INSERT INTO `honorarios` VALUES('PO042', 'Reparo ou substituição de dentes em Prótese total ou Parcial', 61, 40);
INSERT INTO `honorarios` VALUES('PO043', 'Clareamento Dental consultório-Técnica com Peróxido de carbamida e 35%(Por Elemento)', 189, 110);
INSERT INTO `honorarios` VALUES('PO044', 'Claream. Dent. com Moldeira de uso cas. para Dentes Vital. e Desvit.(por arcada)', 268, 150);
INSERT INTO `honorarios` VALUES('PO045', 'Restauração Inlay e Onlay(Artglas/Solidex)', 426, 250);
INSERT INTO `honorarios` VALUES('PO046', 'Prótese Fixa em Metalo(Artglas/Solidex)(Por Elemento)', 430, 250);
INSERT INTO `honorarios` VALUES('PO047', 'Prótese Fixa Adesiva Indireta em Metalo(Artglas/Solidex)(3 elementos)', 580, 450);
INSERT INTO `honorarios` VALUES('PO048', 'Restauração Temporária', 46, 35);
INSERT INTO `honorarios` VALUES('OR001', 'Aparelho Ortodôntico Fixo Metálico - 1 arcada', 368, 0);
INSERT INTO `honorarios` VALUES('OR002', 'Aparelho Ortodôntico Fixo Estético (POLICARBOXILATO) :: 1 arcada', 580, 300);
INSERT INTO `honorarios` VALUES('OR003', 'Manutenção de Ap. Ortodôntico :: 20% à 30% Salário Mínimo :: Apresentação em 22% Salário', 120, 77);
INSERT INTO `honorarios` VALUES('OR004', 'Placa Lábio Ativa', 190, 120);
INSERT INTO `honorarios` VALUES('OR005', 'Aparelho Extra Bucal', 247, 130);
INSERT INTO `honorarios` VALUES('OR006', 'Arco Lingual', 217, 120);
INSERT INTO `honorarios` VALUES('OR007', 'Botão de Nance', 225, 120);
INSERT INTO `honorarios` VALUES('OR008', 'Barra Transpalatina Fixa', 223, 120);
INSERT INTO `honorarios` VALUES('OR009', 'Barra Transpalatina Removível', 136, 80);
INSERT INTO `honorarios` VALUES('OR010', 'Quadrihélice', 225, 120);
INSERT INTO `honorarios` VALUES('OR011', 'Grade Palatina FIxa', 225, 120);
INSERT INTO `honorarios` VALUES('OR012', 'Pendulum de Hilgers com mola de TMA', 254, 120);
INSERT INTO `honorarios` VALUES('OR013', 'Pendex de Hilgers com mola de TMA', 280, 120);
INSERT INTO `honorarios` VALUES('OR014', 'Distalizador de Molar, tipo Jones Jig', 251, 120);
INSERT INTO `honorarios` VALUES('OR015', 'Herbst Encapsulado', 378, 180);
INSERT INTO `honorarios` VALUES('OR016', 'Mascara Facial-Delaire, tração reversa( sem o diajuntor )', 209, 120);
INSERT INTO `honorarios` VALUES('OR017', 'Mentoneira', 114, 70);
INSERT INTO `honorarios` VALUES('OR018', 'Disjuntor Palatino tipo Haas, Hirax', 258, 120);
INSERT INTO `honorarios` VALUES('OR019', 'Disjuntor Palatino tipo McNammara, Faltin', 221, 120);
INSERT INTO `honorarios` VALUES('OR020', 'Frankel', 291, 120);
INSERT INTO `honorarios` VALUES('OR021', 'Bimier', 291, 120);
INSERT INTO `honorarios` VALUES('OR022', 'Planas', 291, 120);
INSERT INTO `honorarios` VALUES('OR023', 'Aparelho Removível com Alça de Binator Invertida', 286, 120);
INSERT INTO `honorarios` VALUES('OR024', 'Aparelho Removível com alça de Escheler', 237, 120);
INSERT INTO `honorarios` VALUES('OR025', 'Bionator de Baiters', 274, 120);
INSERT INTO `honorarios` VALUES('OR027', 'Aparelho de Thurow', 264, 120);
INSERT INTO `honorarios` VALUES('OR028', 'Placa de Hawley (Aparelho de Contenção Superior)', 160, 120);
INSERT INTO `honorarios` VALUES('OR029', 'Placa de Hawley com torno expansor', 180, 130);
INSERT INTO `honorarios` VALUES('OR030', 'Grade Palatina Removível', 149, 80);
INSERT INTO `honorarios` VALUES('OR031', 'Planejamento em Ortodontia', 222, 100);
INSERT INTO `honorarios` VALUES('OR026', 'Blaca dupla de Sanders', 286, 120);
INSERT INTO `honorarios` VALUES('CO001', 'Exodontia (por elemento de permanente)', 77, 30);
INSERT INTO `honorarios` VALUES('CO002', 'Exodontia a Retalho', 100, 45);
INSERT INTO `honorarios` VALUES('CO003', 'Exodontia (Raiz Residual)', 78, 35);
INSERT INTO `honorarios` VALUES('CO004', 'Alveoloplastia(por segmento)', 106, 65);
INSERT INTO `honorarios` VALUES('CO006', 'Biópsia de Lesões Sugestivas  (acrescentar valor cobrado em laboratório)', 230, 110);
INSERT INTO `honorarios` VALUES('CO005', 'Ulotomia', 71, 30);
INSERT INTO `honorarios` VALUES('CO007', 'Sulcoplastia ( por arcada )', 117, 60);
INSERT INTO `honorarios` VALUES('CO008', 'Cirurgia para Torus Palatino', 138, 80);
INSERT INTO `honorarios` VALUES('CO009', 'Cirurgia para Torus Mandibular-Unilateral', 111, 100);
INSERT INTO `honorarios` VALUES('CO010', 'Cirurgia para Torus Mandibular-Bilateral', 168, 130);
INSERT INTO `honorarios` VALUES('CO011', 'Apicectomia de Caninos ou Incisivos', 177, 140);
INSERT INTO `honorarios` VALUES('CO012', 'Apcectomia Caninos/Incisivos com Obturação Retrograda', 202, 180);
INSERT INTO `honorarios` VALUES('CO013', 'Apcectomia Prè-Molares', 209, 155);
INSERT INTO `honorarios` VALUES('CO014', 'Apcectomia Pré-Molares com obturação retrograda', 236, 170);
INSERT INTO `honorarios` VALUES('CO015', 'Apcectomia de Molares', 242, 190);
INSERT INTO `honorarios` VALUES('CO017', 'Frenetomia ou Bridectomia', 126, 90);
INSERT INTO `honorarios` VALUES('CO018', 'Remoção de Dentes Inclusos ou Impactados', 188, 100);
INSERT INTO `honorarios` VALUES('CO019', 'Cirurgia de Tumores Intra-Óssea', 188, 120);
INSERT INTO `honorarios` VALUES('CO020', 'Tratamento de Lesão Cística(enucaleação)', 210, 150);
INSERT INTO `honorarios` VALUES('CO021', 'Tratamento de Lesão Cística(marzupialização e enucleação final)', 243, 190);
INSERT INTO `honorarios` VALUES('CO022', 'Remoção de Corpo Estranho no Selo Maxilar', 232, 190);
INSERT INTO `honorarios` VALUES('CO023', 'Tratamento Cirúrgico de Fístula Buço-Sinucal ou Buco-Nasal com Retalho', 188, 140);
INSERT INTO `honorarios` VALUES('CO024', 'Excisão de Glândula Sublingual', 424, 350);
INSERT INTO `honorarios` VALUES('CO025', 'Excisão de Glândula Submandibular', 688, 510);
INSERT INTO `honorarios` VALUES('CO026', 'Excisão de Glândula Parótida', 562.19, 400);
INSERT INTO `honorarios` VALUES('CO027', 'Excisão de Rânula', 457, 360);
INSERT INTO `honorarios` VALUES('CO028', 'Excisão de Tumor de Glândula Salivar', 424, 310);
INSERT INTO `honorarios` VALUES('CO029', 'Retirada de Cálculo Salivar', 172, 110);
INSERT INTO `honorarios` VALUES('CO030', 'Excisão de Mucocele de Desenvolvimento', 117, 90);
INSERT INTO `honorarios` VALUES('CO031', 'Drenagem de Abcesso', 63, 35);
INSERT INTO `honorarios` VALUES('CO032', 'Ulectomia', 78, 35);
INSERT INTO `honorarios` VALUES('CO033', 'Sinusotomia', 193, 180);
INSERT INTO `honorarios` VALUES('CO034', 'Plástico do Canal de Stenon', 359, 240);
INSERT INTO `honorarios` VALUES('CO035', 'Palentolabioplastia Bilateral', 433, 310);
INSERT INTO `honorarios` VALUES('CO036', 'Tratamento Cirúrgico do Lábio Leporino', 337, 250);
INSERT INTO `honorarios` VALUES('CO037', 'Recosntrução Parcial do Lábio Traumatizado', 337, 250);
INSERT INTO `honorarios` VALUES('CO038', 'Reconstrução Total de Lábio Traumatizado', 484, 400);
INSERT INTO `honorarios` VALUES('CO039', 'Redução Cirúrgica de Luxação de ATM', 330, 250);
INSERT INTO `honorarios` VALUES('CO040', 'Tratamento Cirúrgico para Aniquilose de ATM(por lado)', 550, 410);
INSERT INTO `honorarios` VALUES('CO041', 'Tratamento Cirúrgico para Osteomelite dos Ossos da Face', 411, 350);
INSERT INTO `honorarios` VALUES('CO042', 'Excisão de Sutura de Lesão da Boca com Rotação de Retalho', 448, 300);
INSERT INTO `honorarios` VALUES('CO043', 'Suturas Simples de Face', 73, 45);
INSERT INTO `honorarios` VALUES('CO044', 'Suturas Múltiplas de Face', 91.2, 60);
INSERT INTO `honorarios` VALUES('CO045', 'Maxilectomia com ou sem Esvaziamento Orbitário', 440, 320);
INSERT INTO `honorarios` VALUES('CO047', 'Osteotomia e Osteoplastia de Mandíbula para Micrognatismo', 765, 600);
INSERT INTO `honorarios` VALUES('CO046', 'Osteotomia e Osteoplastia de Mandíbula para Prognatismo', 765, 600);
INSERT INTO `honorarios` VALUES('CO048', 'Osteotomia e Osteoplastia de Mandíbula para Laterognostismo', 765, 600);
INSERT INTO `honorarios` VALUES('CO049', 'Osteotomia e Osteoplastia de Maxila Tipo Le Fort I', 550, 400);
INSERT INTO `honorarios` VALUES('CO050', 'Osteotomia e Osteoplastia de Maxila Tipo Le Fort II', 789, 610);
INSERT INTO `honorarios` VALUES('CO051', 'Osteotomia e Osteplastia de Maxila Tipo Le Fort III', 936, 710);
INSERT INTO `honorarios` VALUES('CO052', 'Reconstrução Total da Mandíbula com Enxerto Ósseo/Prótese', 1138, 930);
INSERT INTO `honorarios` VALUES('CO053', 'Reconstrução Parcial da Mandíbula com Enxerto Ósseo/Prótese', 716, 545);
INSERT INTO `honorarios` VALUES('CO054', 'Reconstrução de Sulco Gengivo-Labial', 152, 110);
INSERT INTO `honorarios` VALUES('CO055', 'Excisão em Cunha de Lábio Sutura', 156, 115);
INSERT INTO `honorarios` VALUES('CO056', 'Cirurgia de Hipertrofia do Lábio', 264, 195);
INSERT INTO `honorarios` VALUES('CO057', 'Cirurgia para Microstomia', 440, 360);
INSERT INTO `honorarios` VALUES('CO058', 'Redução de Fratura de Osso Próprios do Nariz', 440, 350);
INSERT INTO `honorarios` VALUES('CO059', 'Redução Incluenta de Fratura Unilateral de Mandibula', 205, 130);
INSERT INTO `honorarios` VALUES('CO060', 'Redução Cruenta de Fratura Unilateral Mandíbula', 477, 340);
INSERT INTO `honorarios` VALUES('CO061', 'Redução Incluenta de Fratura Bilateral de Mandíbula', 249, 190);
INSERT INTO `honorarios` VALUES('CO062', 'Redução Cruenta de Fratura Bilateral de Mandíbula', 789, 410);
INSERT INTO `honorarios` VALUES('CO063', 'Redução Cruenta de Fratura Cominutiva de Mandibula', 703, 520);
INSERT INTO `honorarios` VALUES('CO064', 'Redução de Fratura de Côndido Mandíbula', 455, 320);
INSERT INTO `honorarios` VALUES('CO065', 'Fraturas Alvéolo-Dentárias-Redução Cruenta', 132, 110);
INSERT INTO `honorarios` VALUES('CO066', 'Fraturas Alvéolo-Dentárias-Redução Incruenta', 73, 45);
INSERT INTO `honorarios` VALUES('CO067', 'Reimplante de Dente (por elemento)', 117, 60);
INSERT INTO `honorarios` VALUES('CO068', 'Redução Inoruenta de Fratura de Le Fort I', 356, 300);
INSERT INTO `honorarios` VALUES('CO069', 'Redução Incruenta de Fratura Le Fort II', 356, 300);
INSERT INTO `honorarios` VALUES('CO070', 'Redução Incruenta de Fratura Le Fort III', 411, 310);
INSERT INTO `honorarios` VALUES('CO071', 'Redução Cruenta de Fratura Le Fort I', 550, 450);
INSERT INTO `honorarios` VALUES('CO072', 'Redução Cruenta de Fratura Le Fort II', 765, 500);
INSERT INTO `honorarios` VALUES('CO074', 'Fraturas Complexas do Segmento Fixo da Face', 411, 300);
INSERT INTO `honorarios` VALUES('CO073', 'Redução Cruenta de Fratura Le Fort III', 765, 510);
INSERT INTO `honorarios` VALUES('CO075', 'Fraturas Complexas do Segmento da Face com Fixação Pericraniana', 1138, 800);
INSERT INTO `honorarios` VALUES('CO077', 'Fratura do Arco Zigomático - Redução cirúrgica sem fixação', 337, 250);
INSERT INTO `honorarios` VALUES('CO078', 'Fratura do Osso Zigomático - Redução Cirúrgica e Fixação', 440, 320);
INSERT INTO `honorarios` VALUES('CO079', 'Retirada de Fios Intra ou Trans-Ósseos', 44, 35);
INSERT INTO `honorarios` VALUES('CO080', 'Retirada de Bloqueio Maxilo-Mandibular', 41, 35);
INSERT INTO `honorarios` VALUES('CO081', 'Retirada de Ancoragem e Cerclagens', 41, 35);
INSERT INTO `honorarios` VALUES('CO082', 'Cirurgia de Cisto', 108, 100);
INSERT INTO `honorarios` VALUES('CO083', 'Artroplastia para Luxação Rescidivante da ATM', 752, 550);
INSERT INTO `honorarios` VALUES('CO084', 'Ressecção Parcial da Mandíbula', 514, 400);
INSERT INTO `honorarios` VALUES('CO085', 'Ressecção Parcial de Mandíbula com enxerto ósseo', 624, 490);
INSERT INTO `honorarios` VALUES('CO086', 'Hemimandibuloctomia', 587, 430);
INSERT INTO `honorarios` VALUES('CO087', 'Hemimandibulectomia com colação de prótese', 716, 510);
INSERT INTO `honorarios` VALUES('CO088', 'Hemimandibulectomia com enxerto ósseo', 789, 590);
INSERT INTO `honorarios` VALUES('CO089', 'Mnadibulectomias com Reconstrução Microcirúrgica', 1138, 900);
INSERT INTO `honorarios` VALUES('CO090', 'Mandibulectomia com Reconstrução de osteomicutanêa', 936, 705);
INSERT INTO `honorarios` VALUES('CO091', 'Osteoplastia de Etmóido Orbitárias', 862, 650);
INSERT INTO `honorarios` VALUES('CO092', 'Osteoplastia de Mandíbula', 789, 600);
INSERT INTO `honorarios` VALUES('CO093', 'Osteoplastia de Órbita', 936, 710);
INSERT INTO `honorarios` VALUES('CO094', 'Ressecção do Meso Infra Estrutura do Maxila Superior', 466, 300);
INSERT INTO `honorarios` VALUES('CO095', 'Ressecção Total de Maxila Inclinada Exenter de Órbita', 826, 600);
INSERT INTO `honorarios` VALUES('CO096', 'Ressecção Maxilar Superior Reconstrução à custa Retalhos', 991, 735);
INSERT INTO `honorarios` VALUES('IM001', 'Ato Cirúrgico de Inserção do Pino de Titânio', 850, 600);
INSERT INTO `honorarios` VALUES('IM002', 'Planejamento Cirúrgico e Protético com modelos de estudo', 120, 60);
INSERT INTO `honorarios` VALUES('IM003', 'Coroa Total sobre Implante em Metalo Artglas/Solidex', 530, 420);
INSERT INTO `honorarios` VALUES('IM004', 'Coroa Total sobre Implante em Metalo Cerâmica (Porcelana)', 720, 530);
INSERT INTO `honorarios` VALUES('IM005', 'Barra para Prótese Total Fixa ou Removível Sobre Implante (Over Dental0', 430, 350);
INSERT INTO `honorarios` VALUES('IM006', 'Interm. e Adapt. para prótese sobre implante:Oring. Munhões,Uclas etc(unitários)', 240, 130);
INSERT INTO `honorarios` VALUES('IM007', 'Coroa Total Provisória sobre Implante em Acrílico', 320, 250);
INSERT INTO `honorarios` VALUES('OR032', 'Manutenção de Ap. Ortodôntico :: 20% à 30% Salário Mínimo :: Apresentação em 30% Salário', 140, 105);
INSERT INTO `honorarios` VALUES('DE023', 'Clareamento Dental em Consultório a Layser :: Por Arcada', 490, 300);
INSERT INTO `honorarios` VALUES('EX005', 'Urgência Horário Normal (independente da sequência do tratamento)', 70, 35);
INSERT INTO `honorarios` VALUES('OR033', 'Aparelho Ortodôntico Fixo Estético (CERÂMICA) :: 1 Arcada', 850, 600);
INSERT INTO `honorarios` VALUES('CO097', 'Aumento de Coroa Clínica', 132, 80);
INSERT INTO `honorarios` VALUES('CO098', 'Enxerto Ósseo Autôgeno em Bloco para Ganho de Volume - Por Segmento', 700, 500);
INSERT INTO `honorarios` VALUES('CO099', 'Enxertos Utilizando Bio-Materiais (Acrescentar o Valor do Bio-Material)', 420, 210);
INSERT INTO `honorarios` VALUES('CO100', 'Exodontia de CISO ''Incluso ou Impactado''', 188, 100);
INSERT INTO `honorarios` VALUES('EN025', 'Tratamento Endodôntico de Molar acima de 3 condutos (não inclue radiografias)', 400, 290);
INSERT INTO `honorarios` VALUES('EN026', 'Retratamento Endodôntico de Molar acima de 3 condutos (não inlcue radiografias)', 450, 350);
INSERT INTO `honorarios` VALUES('IM008', 'Elemento de Porcelana para Ponte Sobre Implante', 600, 430);
INSERT INTO `honorarios` VALUES('CO101', 'Apicectomia de Molares - Com obturação retrograda', 269, 220);
INSERT INTO `honorarios` VALUES('CO102', 'Osteoplastia Zigomático - Maxilar', 441, 310);
INSERT INTO `honorarios` VALUES('PE009', 'Remoção  de Fatores de Retenção', 62, 30);
INSERT INTO `honorarios` VALUES('PE028', 'Manutenção do Tratamento Cirúrgico', 65, 35);
INSERT INTO `honorarios` VALUES('PE029', 'Aumento de Coroa Clínica (por elemento)', 132, 80);
INSERT INTO `honorarios` VALUES('PE030', 'Tratamento Regenerativo com uso de Barreia', 445, 300);
INSERT INTO `honorarios` VALUES('IM009', 'Guia Cirúrgico para Cirurgia de Implante Unitário ou Múltiplos', 215, 120);

# ############################

#
# Estrutura da tabela `implantodontia`
#

CREATE TABLE IF NOT EXISTS `implantodontia` (
  `codigo_paciente` int(10) NOT NULL,
  `tratamento` enum('Sim','Não') default NULL,
  `regioes` varchar(200) default NULL,
  `expectativa` varchar(200) default NULL,
  `areas` varchar(200) default NULL,
  `marca` varchar(200) default NULL,
  `enxerto` enum('Sim','Não') default NULL,
  `tipoenxerto` varchar(200) default NULL,
  `observacoes` text default NULL,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `inquerito`
#

CREATE TABLE IF NOT EXISTS `inquerito` (
  `codigo_paciente` int(10) NOT NULL,
  `tratamento` enum('Sim','Não') default NULL,
  `motivotrat` varchar(150) default NULL,
  `hospitalizado` enum('Sim','Não') default NULL,
  `motivohosp` varchar(150) default NULL,
  `cardiovasculares` enum('Sim','Não') default NULL,
  `sanguineo` enum('Sim','Não') default NULL,
  `reumatico` enum('Sim','Não') default NULL,
  `respiratorio` enum('Sim','Não') default NULL,
  `qualresp` varchar(150) default NULL,
  `gastro` enum('Sim','Não') default NULL,
  `qualgastro` varchar(150) default NULL,
  `renal` enum('Sim','Não') default NULL,
  `diabetico` enum('Sim','Não') default NULL,
  `contagiosa` enum('Sim','Não') default NULL,
  `qualcont` varchar(150) default NULL,
  `anestesia` enum('Sim','Não') default NULL,
  `complicacoesanest` varchar(150) default NULL,
  `alergico` enum('Sim','Não') default NULL,
  `qualalergico` varchar(150) default NULL,
  `observacoes` text,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `laboratorios`
#

CREATE TABLE IF NOT EXISTS `laboratorios` (
  `codigo` int(15) NOT NULL auto_increment,
  `nomefantasia` varchar(80) default NULL,
  `cpf` varchar(50) NOT NULL default '',
  `razaosocial` varchar(80) default NULL,
  `atuacao` varchar(80) default NULL,
  `endereco` varchar(150) default NULL,
  `bairro` varchar(40) default NULL,
  `cidade` varchar(40) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `celular` varchar(15) default NULL,
  `telefone1` varchar(15) default NULL,
  `telefone2` varchar(15) default NULL,
  `inscricaoestadual` varchar(40) default NULL,
  `website` varchar(100) default NULL,
  `email` varchar(100) default NULL,
  `nomerepresentante` varchar(80) default NULL,
  `apelidorepresentante` varchar(50) default NULL,
  `emailrepresentante` varchar(100) default NULL,
  `celularrepresentante` varchar(15) default NULL,
  `telefone1representante` varchar(15) default NULL,
  `telefone2representante` varchar(15) default NULL,
  `banco` varchar(50) default NULL,
  `agencia` varchar(15) default NULL,
  `conta` varchar(15) default NULL,
  `favorecido` varchar(50) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `laboratorios_procedimentos`
#

CREATE TABLE IF NOT EXISTS laboratorios_procedimentos (
  codigo int NOT NULL auto_increment,
  codigo_paciente int NOT NULL,
  codigo_dentista int NOT NULL,
  procedimento TEXT NOT NULL,
  datahora DATETIME NOT NULL,
  PRIMARY KEY (codigo)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `laboratorios_procedimentos_status`
#

CREATE TABLE IF NOT EXISTS laboratorios_procedimentos_status (
  codigo int NOT NULL auto_increment,
  codigo_procedimento int NOT NULL,
  `status` TEXT NOT NULL,
  datahora DATETIME NOT NULL,
  PRIMARY KEY (codigo)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `laudos`
#

CREATE TABLE `laudos` (
  `laudo` TEXT NULL DEFAULT NULL ,
  `codigo_paciente` INT NOT NULL ,
  PRIMARY KEY ( `codigo_paciente` )
) ENGINE = MYISAM;

# ############################

#
# Estrutura da tabela `odontograma`
#

CREATE TABLE `odontograma` (
  `codigo_paciente` INT NOT NULL ,
  `dente` INT(2) NULL DEFAULT NULL ,
  `descricao` VARCHAR(100) NULL DEFAULT NULL ,
  PRIMARY KEY ( `codigo_paciente` , `dente` )
) ENGINE = MYISAM;

# ############################

#
# Estrutura da tabela `orcamento`
#

CREATE TABLE IF NOT EXISTS `orcamento` (
  `codigo` int(10) NOT NULL auto_increment,
  `codigo_paciente` int(10) NOT NULL,
  `data` date default NULL,
  `formapagamento` enum('À vista','Cheque pré-datado','Promissória','Desconto em folha','Cartão') default NULL,
  `aserpago` enum('Particular','Convênio') default NULL,
  `valortotal` float default NULL,
  `parcelas` enum('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20') default NULL,
  `desconto` float default NULL,
  `codigo_dentista` varchar(11) default NULL,
  `confirmado` enum('Sim','Não') NOT NULL default 'Não',
  `entrada` float default '0',
  `entrada_tipo` enum('R$','%') NOT NULL default 'R$',
  `baixa` enum('Sim','Não') NOT NULL default 'Não',
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `ortodontia`
#

CREATE TABLE IF NOT EXISTS `ortodontia` (
  `codigo_paciente` int(10) NOT NULL,
  `tratamento` enum('Sim','Não') default NULL,
  `previsao` varchar(200) default NULL,
  `razoes` varchar(200) default NULL,
  `motivacao` varchar(200) default NULL,
  `perfil` varchar(200) default NULL,
  `simetria` varchar(200) default NULL,
  `tipologia` varchar(200) default NULL,
  `classe` varchar(200) default NULL,
  `mordida` varchar(200) default NULL,
  `spee` varchar(200) default NULL,
  `overbite` varchar(200) default NULL,
  `overjet` varchar(200) default NULL,
  `media` varchar(200) default NULL,
  `atm` varchar(200) default NULL,
  `radio` text default NULL,
  `modelo` text default NULL,
  `observacoes` text default NULL,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `pacientes`
#

CREATE TABLE IF NOT EXISTS `pacientes` (
  `codigo` int(10) NOT NULL,
  `nome` varchar(80) default NULL,
  `cpf` varchar(50) default NULL,
  `rg` varchar(50) default NULL,
  `estadocivil` enum('solteiro','casado','divorciado','viuvo') default NULL,
  `sexo` enum('Masculino','Feminino') default NULL,
  `etnia` enum('africano','asiatico','caucasiano','latino','orientemedio','multietnico') default NULL,
  `profissao` varchar(80) default NULL,
  `naturalidade` varchar(80) default NULL,
  `nacionalidade` varchar(80) default NULL,
  `nascimento` date default NULL,
  `endereco` varchar(150) default NULL,
  `bairro` varchar(40) default NULL,
  `cidade` varchar(40) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `celular` varchar(15) default NULL,
  `telefone1` varchar(15) default NULL,
  `telefone2` varchar(15) default NULL,
  `hobby` varchar(250) default NULL,
  `indicadopor` varchar(80) default NULL,
  `email` varchar(100) default NULL,
  `obs_etiqueta` varchar(90) default NULL,
  `tratamento` set('Ortodontia', 'Implantodontia', 'Dentística', 'Prótese', 'Odontopediatria', 'Cirurgia', 'Endodontia', 'Periodontia', 'Radiologia', 'DTM', 'Odontogeriatria', 'Ortopedia') default NULL,
  `codigo_dentistaprocurado` int default NULL,
  `codigo_dentistaatendido` int default NULL,
  `codigo_dentistaencaminhado` int default NULL,
  `nomemae` varchar(80) default NULL,
  `nascimentomae` date default NULL,
  `profissaomae` varchar(150) default NULL,
  `nomepai` varchar(80) default NULL,
  `nascimentopai` date default NULL,
  `profissaopai` varchar(150) default NULL,
  `telefone1pais` varchar(15) default NULL,
  `telefone2pais` varchar(15) default NULL,
  `enderecofamiliar` varchar(150) default NULL,
  `datacadastro` date default NULL,
  `dataatualizacao` date default NULL,
  `status` enum('Avaliação','Em tratamento','Concluído','Em revisão') default NULL,
  `objetivo` text,
  `observacoes` text,
  `convenio` int NOT NULL,
  `outros` varchar(100) default NULL,
  `matricula` varchar(20) default NULL,
  `titular` varchar(80) default NULL,
  `validadeconvenio` varchar(25) default NULL,
  `foto` blob,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `parcelas_orcamento`
#

CREATE TABLE IF NOT EXISTS `parcelas_orcamento` (
  `codigo` int(100) NOT NULL auto_increment,
  `codigo_orcamento` int(10) NOT NULL,
  `datavencimento` date default NULL,
  `valor` float default NULL,
  `pago` enum('Sim','Não') NOT NULL default 'Não',
  `datapgto` date default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `patrimonio`
#

CREATE TABLE IF NOT EXISTS `patrimonio` (
  `codigo` int(10) NOT NULL auto_increment,
  `setor` varchar(40) default NULL,
  `descricao` varchar(150) default NULL,
  `valor` float default NULL,
  `dataaquisicao` date default NULL,
  `tempogarantia` varchar(30) default NULL,
  `cor` varchar(30) default NULL,
  `quantidade` varchar(20) default NULL,
  `fornecedor` varchar(50) default NULL,
  `numeronotafiscal` varchar(30) default NULL,
  `dimensoes` varchar(30) default NULL,
  `observacoes` text,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `procedimentos_orcamento`
#

CREATE TABLE IF NOT EXISTS `procedimentos_orcamento` (
  `codigo` int(10) NOT NULL auto_increment,
  `codigo_orcamento` int(10) NOT NULL,
  `codigoprocedimento` varchar(10) default NULL,
  `dente` varchar(15) default NULL,
  `descricao` varchar(150) default NULL,
  `particular` float default NULL,
  `convenio` float default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `receitas`
#

CREATE TABLE IF NOT EXISTS `receitas` (
  `receita` longtext,
  `codigo_paciente` int(11) NOT NULL,
  PRIMARY KEY  (`codigo_paciente`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura da tabela `telefones`
#

CREATE TABLE IF NOT EXISTS `telefones` (
  `codigo` int(10) NOT NULL auto_increment,
  `nome` varchar(80) default NULL,
  `endereco` varchar(50) default NULL,
  `bairro` varchar(50) default NULL,
  `cidade` varchar(50) default NULL,
  `estado` varchar(50) default NULL,
  `pais` varchar(50) default NULL,
  `cep` varchar(9) default NULL,
  `celular` varchar(15) default NULL,
  `telefone1` varchar(15) default NULL,
  `telefone2` varchar(15) default NULL,
  `email` varchar(150) default NULL,
  `website` varchar(150) default NULL,
  PRIMARY KEY  (`codigo`)
) ENGINE=MyISAM;

# ############################

#
# Estrutura para visualizar `v_agenda`
#

CREATE VIEW v_agenda AS ( SELECT tp.codigo AS codigo_paciente, ta.data AS data, ta.hora AS hora, ta.descricao AS descricao, ta.procedimento AS procedimento, ta.faltou AS faltou, td.nome AS nome_dentista, td.sexo AS sexo_dentista FROM agenda ta INNER JOIN pacientes tp ON tp.codigo = ta.codigo_paciente INNER JOIN dentistas td ON td.codigo = ta.codigo_dentista );

# ############################

#
# Estrutura para visualizar `v_evolucao`
#

CREATE VIEW v_evolucao AS ( SELECT tp.codigo AS codigo_paciente, tp.nome AS paciente, td.sexo AS sexo_dentista, td.nome AS dentista, te.procexecutado AS executado, te.procprevisto AS previsto, te.data AS data FROM evolucao te INNER JOIN dentistas td ON te.codigo_dentista = td.codigo INNER JOIN pacientes tp ON te.codigo_paciente = tp.codigo );

# ############################

#
# Estrutura para visualizar `v_orcamento`
#

CREATE VIEW v_orcamento AS ( SELECT tpo.codigo_orcamento AS codigo_orcamento, tor.parcelas AS parcelas, tor.confirmado AS confirmado, tor.baixa AS baixa, tpo.codigo AS codigo_parcela, tpo.datavencimento AS data, tpo.valor AS valor, tpo.pago AS pago, tpo.datapgto AS datapgto, tp.codigo AS codigo_paciente, tp.nome AS paciente, td.nome AS dentista, td.sexo AS sexo_dentista FROM parcelas_orcamento tpo INNER JOIN orcamento tor ON tpo.codigo_orcamento = tor.codigo INNER JOIN pacientes tp ON tor.codigo_paciente = tp.codigo JOIN dentistas td ON tor.codigo_dentista = td.codigo );

