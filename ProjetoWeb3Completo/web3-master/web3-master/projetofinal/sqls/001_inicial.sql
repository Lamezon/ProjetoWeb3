CREATE TABLE `usuarios` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`login` varchar(255) NOT NULL UNIQUE,
	`password` varchar(255) NOT NULL,
	`photo` varchar(1024) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `perguntas` (
	`id` INT(255) NOT NULL AUTO_INCREMENT UNIQUE,
	`id_usuario` INT(255) NOT NULL,
	`criador` varchar(255) NOT NULL,
	`dificuldade` INT(3) NOT NULL,
	`pergunta` TEXT(1000) NOT NULL,
	`alternativa_1` TEXT(250) NOT NULL,
	`alternativa_2` TEXT(250) NOT NULL,
	`alternativa_3` TEXT(250) NOT NULL,
	`alternativa_4` TEXT(250) NOT NULL,
	`alternativa_5` TEXT(250) NOT NULL,
	`foto_pergunta` varchar(1024),
	`erros` INT DEFAULT '0',
	`correta` INT(5) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`)
);

CREATE TABLE `usuarioresposta` (
	`id_usuario` INT(255) NOT NULL,
	`id_pergunta` INT(255) NOT NULL,
	`resposta` INT(5) NOT NULL
);

ALTER TABLE `perguntas` ADD CONSTRAINT `perguntas_fk0` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id`);

ALTER TABLE `perguntas` ADD CONSTRAINT `perguntas_fk1` FOREIGN KEY (`criador`) REFERENCES `usuarios`(`login`);

ALTER TABLE `usuarioresposta` ADD CONSTRAINT `usuarioresposta_fk0` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id`);

ALTER TABLE `usuarioresposta` ADD CONSTRAINT `usuarioresposta_fk1` FOREIGN KEY (`id_pergunta`) REFERENCES `perguntas`(`id`);
