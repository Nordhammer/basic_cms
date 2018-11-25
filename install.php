CREATE TABLE `d01e410b`.`wcp_config` ( `id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT , `alias` VARCHAR(255) NOT NULL , `value` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = MyISAM;

// user_online.php
ALTER TABLE `cms_user_online` CHANGE `useronlineID` `id` INT(255) UNSIGNED NOT NULL AUTO_INCREMENT, CHANGE `useronlineSESSION` `session` CHAR(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, CHANGE `useronlineUID` `uid` INT(10) NOT NULL, CHANGE `useronlineTIME` `uip` VARCHAR(34) NOT NULL, CHANGE `useronlineUIP` `created` INT(11) NOT NULL DEFAULT '0';