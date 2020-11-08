-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema ticketswap
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ticketswap
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ticketswap` DEFAULT CHARACTER SET utf8 ;
USE `ticketswap` ;

-- -----------------------------------------------------
-- Table `ticketswap`.`Evenements`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketswap`.`Evenements` (
  `idEvenements` INT NOT NULL AUTO_INCREMENT,
  `eventName` VARCHAR(100) NOT NULL,
  `standardTicketPrice` FLOAT(6,2) NOT NULL,
  `startDate` DATETIME NOT NULL,
  `endDate` DATETIME NOT NULL,
  `location` VARCHAR(200) NOT NULL,
  `description` VARCHAR(1000) NOT NULL,
  `artists` VARCHAR(1000) NOT NULL,
  PRIMARY KEY (`idEvenements`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketswap`.`Users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketswap`.`Users` (
  `idGebruikers` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(50) NOT NULL,
  `lastName` VARCHAR(50) NOT NULL,
  `address` VARCHAR(200) NOT NULL,
  `couponcode` VARCHAR(8) NOT NULL,
  `numberOfInvites` VARCHAR(45) NULL,
  PRIMARY KEY (`idGebruikers`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ticketswap`.`Tickets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketswap`.`Tickets` (
  `idTickets` INT NOT NULL AUTO_INCREMENT,
  `ticketName` VARCHAR(100) NOT NULL,
  `ticketPrice` FLOAT(6,2) NOT NULL,
  `amount` INT NOT NULL,
  `reasonForSell` VARCHAR(255) NOT NULL,
  `ticketFileLocation` VARCHAR(300) NULL,
  `Evenements_idEvenements` INT NOT NULL,
  `Users_idGebruikers` INT NOT NULL,
  PRIMARY KEY (`idTickets`),
  INDEX `fk_Tickets_Evenements1_idx` (`Evenements_idEvenements` ASC),
  INDEX `fk_Tickets_Users1_idx` (`Users_idGebruikers` ASC),
  CONSTRAINT `fk_Tickets_Evenements1`
    FOREIGN KEY (`Evenements_idEvenements`)
    REFERENCES `ticketswap`.`Evenements` (`idEvenements`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tickets_Users1`
    FOREIGN KEY (`Users_idGebruikers`)
    REFERENCES `ticketswap`.`Users` (`idGebruikers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
