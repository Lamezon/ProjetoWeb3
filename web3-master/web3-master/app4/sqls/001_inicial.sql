CREATE TABLE `usuarios` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`login` VARCHAR(255) NOT NULL UNIQUE,
	`password` VARCHAR(255) NOT NULL,
	`photo` varchar(1024) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `perguntas` (
	`id_pergunta` INT(255) NOT NULL AUTO_INCREMENT UNIQUE,
	`id_usuario` INT(255) NOT NULL,
	`dificuldade` INT(3) NOT NULL,
	`pergunta` TEXT(1000) NOT NULL,
	`alternativa_1` TEXT(250) NOT NULL,
	`alternativa_2` TEXT(250) NOT NULL,
	`alternativa_3` TEXT(250) NOT NULL,
	`alternativa_4` TEXT(250) NOT NULL,
	`alternativa_5` TEXT(250) NOT NULL,
	PRIMARY KEY (`id_pergunta`)
);

ALTER TABLE `perguntas` ADD CONSTRAINT `perguntas_fk0` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id`);
