-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Evenementen`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Evenementen` (
  `idEvenementen` INT NOT NULL AUTO_INCREMENT,
  `Naam` VARCHAR(100) NOT NULL,
  `Standaard_ticketprijs` DOUBLE NOT NULL,
  `Aanvangstijd` DATETIME NULL,
  `Sluitingstijd` DATETIME NULL,
  `Locatie` VARCHAR(200) NULL,
  `Beschrijving` VARCHAR(255) NULL,
  `Aanwezige_artiesten` VARCHAR(255) NULL,
  PRIMARY KEY (`idEvenementen`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Tickets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Tickets` (
  `idTickets` INT NOT NULL AUTO_INCREMENT,
  `Naam` VARCHAR(100) NOT NULL,
  `Prijs_per_ticket` DOUBLE NOT NULL,
  `Aantal` INT NOT NULL,
  `Reden_van_verkoop` VARCHAR(255) NULL,
  `Ticket_bestandlocatie` VARCHAR(100) NULL,
  `Evenementen_idEvenementen` INT NOT NULL,
  PRIMARY KEY (`idTickets`),
  INDEX `fk_Tickets_Evenementen_idx` (`Evenementen_idEvenementen` ASC) VISIBLE,
  CONSTRAINT `fk_Tickets_Evenementen`
    FOREIGN KEY (`Evenementen_idEvenementen`)
    REFERENCES `mydb`.`Evenementen` (`idEvenementen`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Gebruikers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Gebruikers` (
  `idGebruikers` INT NOT NULL AUTO_INCREMENT,
  `Voornaam` VARCHAR(50) NOT NULL,
  `Achternaam` VARCHAR(50) NOT NULL,
  `Adres` VARCHAR(200) NOT NULL,
  `Kortingscode` VARCHAR(8) NOT NULL,
  `Aantal_uitgenodigd` VARCHAR(45) NULL,
  PRIMARY KEY (`idGebruikers`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Gebruikers_has_Tickets`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Gebruikers_has_Tickets` (
  `Gebruikers_idGebruikers` INT NOT NULL,
  `Tickets_idTickets` INT NOT NULL,
  PRIMARY KEY (`Gebruikers_idGebruikers`, `Tickets_idTickets`),
  INDEX `fk_Gebruikers_has_Tickets_Tickets1_idx` (`Tickets_idTickets` ASC) VISIBLE,
  INDEX `fk_Gebruikers_has_Tickets_Gebruikers1_idx` (`Gebruikers_idGebruikers` ASC) VISIBLE,
  CONSTRAINT `fk_Gebruikers_has_Tickets_Gebruikers1`
    FOREIGN KEY (`Gebruikers_idGebruikers`)
    REFERENCES `mydb`.`Gebruikers` (`idGebruikers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Gebruikers_has_Tickets_Tickets1`
    FOREIGN KEY (`Tickets_idTickets`)
    REFERENCES `mydb`.`Tickets` (`idTickets`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
