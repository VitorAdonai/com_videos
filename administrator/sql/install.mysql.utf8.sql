CREATE TABLE IF NOT EXISTS `#__videos_itens` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0',

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`created_by` INT(11)  NOT NULL ,
`nome` VARCHAR(255)  NOT NULL ,
`video` VARCHAR(255)  NOT NULL ,
`imagem` VARCHAR(255)  NOT NULL ,
`hits` VARCHAR(255)  NOT NULL ,
`showautor` VARCHAR(255)  NOT NULL ,
`comentarios` VARCHAR(255)  NOT NULL ,
`width` VARCHAR(255)  NOT NULL ,
`height` VARCHAR(255)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

