CREATE TABLE `wp_pagamento_congressocoramdeo_test`(
    `id_compra` varchar (200) PRIMARY KEY, 
    `data_cadastro` datetime NOT NULL,
	`status_pagamento` VARCHAR (100),
	`qtde_pagamentos` INT (10),
	`valor` varchar (4),
	`id_mercadopago` varchar (200),
	`status_pedido` varchar (200)
);

CREATE TABLE `wp_inscricao_congressocoramdeo_test`(
    `id` bigint(20) PRIMARY KEY AUTO_INCREMENT,
    `nome` varchar(190) NOT NULL,
    `email` varchar(190) NOT NULL,
    `telefone` varchar(11) NOT NULL,
    `cpf` varchar(11) NOT NULL,
    `igreja` varchar(190) NOT NULL,
    `datacadastro` datetime NOT NULL,
    `idade` INT (2),
    `dia_quatro` TINYINT (1),
    `dia_cinco_manha` TINYINT (1),
    `dia_cinco_noite` TINYINT (1),
    `dia_seis_manha` TINYINT (1),
    `dia_seis_noite` TINYINT (1),
    `id_compra` varchar (200)
);

CREATE TABLE `wp_pagamento_congressocoramdeo`(
    `id_compra` varchar (200) PRIMARY KEY, 
    `data_cadastro` datetime NOT NULL,
	`status_pagamento` VARCHAR (100),
	`qtde_pagamentos` INT (10),
	`valor` varchar (4),
	`id_mercadopago` varchar (200),
	`status_pedido` varchar (200)
);

CREATE TABLE `wp_inscricao_congressocoramdeo`(
    `id` bigint(20) PRIMARY KEY AUTO_INCREMENT,
    `nome` varchar(190) NOT NULL,
    `email` varchar(190) NOT NULL,
    `telefone` varchar(11) NOT NULL,
    `cpf` varchar(11) NOT NULL,
    `igreja` varchar(190) NOT NULL,
    `datacadastro` datetime NOT NULL,
    `idade` INT (2),
    `dia_quatro` TINYINT (1),
    `dia_cinco_manha` TINYINT (1),
    `dia_cinco_noite` TINYINT (1),
    `dia_seis_manha` TINYINT (1),
    `dia_seis_noite` TINYINT (1),
    `id_compra` varchar (200)
);

CREATE TABLE `wp_email`(
    `id` bigint(20) PRIMARY KEY AUTO_INCREMENT,
    `id_inscricao`  bigint(20),
    `id_mercadopago`  bigint(20),
    `data_disparo` datetime,
    `email_enviado` TINYINT (1),
    `error` varchar (200)
);

--Solução, serializar (ou gravar no cookie) o external_reference ao clicar em fazer outra inscrição;
--Outra opção, colocar email como PK, email e id_inscricao como FK pagamento. ocutar o email na 2ª inscrição;


INSERT INTO `wp_congressocoramdeo` (`nome`,`email`,`telefone`,`igreja`,`datacadastro`,`dia_quatro`,`dia_cinco_manha`,`dia_cinco_noite`,`dia_seis_manha`,`dia_seis_noite`)
VALUES
('Simei Lucas da Costa Sousa', 'simeilucas@gmail.com','61992782157', 'Terceira Igreja Presbiteriana de Ceilândia', '2022-10-06', 1,1,1,1,1)