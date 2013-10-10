
DROP DATABASE hours;

CREATE DATABASE hours;
use hours;




-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'users'
-- 
-- ---

DROP TABLE IF EXISTS `users`;
    
CREATE TABLE `users` (
  `id` TINYINT NULL AUTO_INCREMENT DEFAULT NULL,
  `username` VARCHAR(50) NULL DEFAULT NULL,
  `password` MEDIUMTEXT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'times'
-- 
-- ---

DROP TABLE IF EXISTS `times`;
    
CREATE TABLE `times` (
  `id` TINYINT NULL AUTO_INCREMENT DEFAULT NULL,
  `timein` TIMESTAMP NULL DEFAULT NULL,
  `timeout` TIMESTAMP NULL DEFAULT NULL,
  `hasClockOut` TINYINT NULL DEFAULT NULL,
  `userID` TINYINT NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `times` ADD FOREIGN KEY (userID) REFERENCES `users` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `times` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `users` (`id`,`username`,`password`) VALUES
-- ('','','');
-- INSERT INTO `times` (`id`,`timein`,`timeout`,`hasClockOut`,`userID`) VALUES
-- ('','','','','');

