-- Adminer 4.7.6 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `sensoren`;
CREATE TABLE `sensoren` (
  `ID` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `sensNaam` varchar(30) NOT NULL,
  `IP_adress` varchar(30) NOT NULL DEFAULT '127.0.1.1',
  `aanmaakdatum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `sensor_data`;
CREATE TABLE `sensor_data` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `sensorID` int(10) unsigned NOT NULL,
  `waarde` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `IP` varchar(50) NOT NULL DEFAULT '127.0.1.1',
  PRIMARY KEY (`ID`),
  KEY `sensorID` (`sensorID`),
  CONSTRAINT `sensor_data_ibfk_2` FOREIGN KEY (`sensorID`) REFERENCES `sensoren` (`ID`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2020-11-23 11:54:09
