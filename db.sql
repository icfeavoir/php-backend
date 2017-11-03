DROP DATABASE ajcBackend;

CREATE DATABASE IF NOT EXISTS ajcBackend;
use ajcBackend;


CREATE TABLE IF NOT EXISTS `Right` (
  `right` int(4) UNSIGNED NOT NULL DEFAULT 0,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`right`)
);

CREATE TABLE IF NOT EXISTS `User` (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NULL DEFAULT NULL,
  `lastName` varchar(255) NULL DEFAULT NULL,
  `born` date NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rights` int(4) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`)
);

CREATE TABLE IF NOT EXISTS `Event` (
  `event_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `creator` int(11) UNSIGNED NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` int UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  FOREIGN KEY (`creator`) REFERENCES User(`user_id`)
);

CREATE TABLE IF NOT EXISTS `Participation` (
  `participation_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `event_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `participe` int(11) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`participation_id`),
  FOREIGN KEY (`event_id`) REFERENCES Event(`event_id`),
  FOREIGN KEY (`user_id`) REFERENCES User(`user_id`)
);
