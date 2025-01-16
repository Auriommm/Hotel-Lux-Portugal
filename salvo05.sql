-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema hotel_management
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema hotel_management
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `hotel_management` DEFAULT CHARACTER SET utf8 ;
USE `hotel_management` ;

-- -----------------------------------------------------
-- Table `hotel_management`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel_management`.`cliente` (
  `idcliente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NULL,
  `num_identificacao` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `contacto` VARCHAR(20) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`idcliente`),
  UNIQUE INDEX `num_identificacao_UNIQUE` (`num_identificacao` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hotel_management`.`quarto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel_management`.`quarto` (
  `idquarto` INT NOT NULL AUTO_INCREMENT,
  `numero_quarto` VARCHAR(10) NOT NULL,
  `tipo` VARCHAR(50) NOT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `status` ENUM('Disponivel', 'Ocupado', 'Reservado') NULL DEFAULT 'Disponível',
  `descricao` TEXT(255) NULL,
  PRIMARY KEY (`idquarto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hotel_management`.`reserva`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel_management`.`reserva` (
  `idreserva` INT NOT NULL AUTO_INCREMENT,
  `cliente_idcliente` INT NOT NULL,
  `quarto_idquarto` INT NOT NULL,
  `data_checkin` DATE NOT NULL,
  `data_checkout` DATE NOT NULL,
  `status` ENUM('Ativa', 'Concluída', 'Cancelada') NOT NULL DEFAULT 'Ativa',
  `created_at` TIMESTAMP(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`idreserva`),
  INDEX `fk_reserva_cliente_idx` (`cliente_idcliente` ASC),
  INDEX `fk_reserva_quarto1_idx` (`quarto_idquarto` ASC),
  CONSTRAINT `fk_reserva_cliente`
    FOREIGN KEY (`cliente_idcliente`)
    REFERENCES `hotel_management`.`cliente` (`idcliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_quarto1`
    FOREIGN KEY (`quarto_idquarto`)
    REFERENCES `hotel_management`.`quarto` (`idquarto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `hotel_management`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `hotel_management`.`admin` (
  `idadmin` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP(6) NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`idadmin`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
