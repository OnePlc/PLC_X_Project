ALTER TABLE `project` ADD `description` TEXT NOT NULL DEFAULT '' AFTER `label`,
ADD `state_idfs` INT(11) NOT NULL DEFAULT '0' AFTER `description`,
ADD `customer_idfs` INT(11) NOT NULL DEFAULT '0' AFTER `state_idfs`,
ADD `planned_release` DATE NOT NULL DEFAULT '0000-00-00' AFTER `customer_idfs`,
ADD `person_resposible` INT(11) NOT NULL DEFAULT '0' AFTER `planned_release`,
ADD `budget` FLOAT NOT NULL DEFAULT 0 AFTER `person_resposible`,
ADD `featured_image` VARCHAR (255) NOT NULL DEFAULT '' AFTER `featured_image`;