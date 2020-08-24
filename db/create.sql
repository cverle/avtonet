/*
Created: 6/4/2020
Modified: 8/20/2020
Model: MySQL 5.0
Database: MySQL 5.0
*/

-- Create tables section -------------------------------------------------

-- Table users

CREATE TABLE `users`
(
  `id_users` Int NOT NULL AUTO_INCREMENT,
  `first_name` Varchar(50) NOT NULL,
  `last_name` Varchar(100) NOT NULL,
  `email` Varchar(100) NOT NULL,
  `pass` Varchar(255) NOT NULL,
  PRIMARY KEY (`id_users`),
  UNIQUE `id_users` (`id_users`)
)
;

ALTER TABLE `users` ADD UNIQUE `email` (`email`)
;

-- Table locations

CREATE TABLE `locations`
(
  `id` Int NOT NULL,
  `cities` Varchar(100) NOT NULL
)
;

ALTER TABLE `locations` ADD PRIMARY KEY (`id`)
;

-- Table pictures

CREATE TABLE `pictures`
(
  `id_pictures` Int NOT NULL AUTO_INCREMENT,
  `url` Varchar(255) NOT NULL,
  `id_cars` Int,
  PRIMARY KEY (`id_pictures`)
)
;

CREATE INDEX `IX_Relationship14` ON `pictures` (`id_cars`)
;

-- Table cars

CREATE TABLE `cars`
(
  `id_cars` Int NOT NULL AUTO_INCREMENT,
  `gear_shifts` Varchar(100) NOT NULL,
  `year_of_registration` Year(4) NOT NULL,
  `engine` Varchar(50) NOT NULL,
  `price` Decimal(7,2) NOT NULL,
  `id_users` Int,
  `id_fuel` Int,
  `id_models` Int,
  PRIMARY KEY (`id_cars`)
)
;

CREATE INDEX `IX_Relationship13` ON `cars` (`id_users`)
;

CREATE INDEX `IX_Relationship15` ON `cars` (`id_fuel`)
;

CREATE INDEX `IX_Relationship16` ON `cars` (`id_models`)
;

-- Table brands

CREATE TABLE `brands`
(
  `id_brands` Int NOT NULL AUTO_INCREMENT,
  `brand` Varchar(100) NOT NULL,
  PRIMARY KEY (`id_brands`)
)
;

-- Table models

CREATE TABLE `models`
(
  `id_models` Int NOT NULL AUTO_INCREMENT,
  `model` Varchar(100) NOT NULL,
  `id_brands` Int,
  PRIMARY KEY (`id_models`)
)
;

CREATE INDEX `IX_Relationship17` ON `models` (`id_brands`)
;

-- Table fuel

CREATE TABLE `fuel`
(
  `id_fuel` Int NOT NULL AUTO_INCREMENT,
  `fuel_type` Varchar(100) NOT NULL,
  PRIMARY KEY (`id_fuel`)
)
;

-- Table coments

CREATE TABLE `coments`
(
  `id_coments` Int NOT NULL AUTO_INCREMENT,
  `date_add` Timestamp NOT NULL,
  `content` Text NOT NULL,
  `id_pictures` Int,
  `id_users` Int,
  PRIMARY KEY (`id_coments`)
)
;

CREATE INDEX `IX_Relationship18` ON `coments` (`id_pictures`)
;

CREATE INDEX `IX_Relationship19` ON `coments` (`id_users`)
;

-- Create foreign keys (relationships) section -------------------------------------------------

ALTER TABLE `cars` ADD CONSTRAINT `Relationship13` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `pictures` ADD CONSTRAINT `Relationship14` FOREIGN KEY (`id_cars`) REFERENCES `cars` (`id_cars`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `cars` ADD CONSTRAINT `Relationship15` FOREIGN KEY (`id_fuel`) REFERENCES `fuel` (`id_fuel`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `cars` ADD CONSTRAINT `Relationship16` FOREIGN KEY (`id_models`) REFERENCES `models` (`id_models`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `models` ADD CONSTRAINT `Relationship17` FOREIGN KEY (`id_brands`) REFERENCES `brands` (`id_brands`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `coments` ADD CONSTRAINT `Relationship18` FOREIGN KEY (`id_pictures`) REFERENCES `pictures` (`id_pictures`) ON DELETE RESTRICT ON UPDATE RESTRICT
;

ALTER TABLE `coments` ADD CONSTRAINT `Relationship19` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE RESTRICT ON UPDATE RESTRICT
;


