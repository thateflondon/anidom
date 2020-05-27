-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema anidom
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema anidom
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `anidom` DEFAULT CHARACTER SET utf8 ;
USE `anidom` ;

-- -----------------------------------------------------
-- Table `anidom`.`types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anidom`.`types` (
  `id_t` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_t`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anidom`.`owners`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anidom`.`owners` (
  `id_o` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `fname` VARCHAR(45) NOT NULL,
  `mail` VARCHAR(45) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_o`),
  UNIQUE INDEX `mail_UNIQUE` (`mail` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anidom`.`animals`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anidom`.`animals` (
  `id_a` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `gender` ENUM('F', 'M') NOT NULL,
  `photo` LONGBLOB NULL,
  `dob` DATETIME NOT NULL,
  `types_id_type` INT NOT NULL,
  `owners_id_own` INT NOT NULL,
  PRIMARY KEY (`id_a`),
  INDEX `fk_animals_types_idx` (`types_id_type` ASC) VISIBLE,
  INDEX `fk_animals_owners1_idx` (`owners_id_own` ASC) VISIBLE,
  CONSTRAINT `fk_animals_types`
    FOREIGN KEY (`types_id_type`)
    REFERENCES `anidom`.`types` (`id_t`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_animals_owners1`
    FOREIGN KEY (`owners_id_own`)
    REFERENCES `anidom`.`owners` (`id_o`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anidom`.`sitters`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anidom`.`sitters` (
  `id_s` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `dob` DATETIME NOT NULL,
  `mail` VARCHAR(45) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_s`),
  UNIQUE INDEX `mail_UNIQUE` (`mail` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anidom`.`sitters_has_animals`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anidom`.`sitters_has_animals` (
  `sitters_id_sit` INT NOT NULL,
  `animals_id_ani` INT NOT NULL,
  PRIMARY KEY (`sitters_id_sit`, `animals_id_ani`),
  INDEX `fk_sitters_has_animals_animals1_idx` (`animals_id_ani` ASC) VISIBLE,
  INDEX `fk_sitters_has_animals_sitters1_idx` (`sitters_id_sit` ASC) VISIBLE,
  CONSTRAINT `fk_sitters_has_animals_sitters1`
    FOREIGN KEY (`sitters_id_sit`)
    REFERENCES `anidom`.`sitters` (`id_s`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sitters_has_animals_animals1`
    FOREIGN KEY (`animals_id_ani`)
    REFERENCES `anidom`.`animals` (`id_a`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `anidom`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `anidom`.`users` (
  `login` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `level` INT NOT NULL,
  PRIMARY KEY (`login`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) VISIBLE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
