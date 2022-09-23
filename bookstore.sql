-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bookstore
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bookstore
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bookstore` DEFAULT CHARACTER SET utf8 ;
USE `bookstore` ;

-- -----------------------------------------------------
-- Table `bookstore`.`tipos_clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`tipos_clientes` (
  `idtipos_clientes` INT NOT NULL,
  `tipocliente` VARCHAR(45) NULL,
  PRIMARY KEY (`idtipos_clientes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`estado` (
  `idestado` INT NOT NULL,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`idestado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`clientes` (
  `idclientes` INT NOT NULL AUTO_INCREMENT,
  `nombres` VARCHAR(50) NULL,
  `apellidos` VARCHAR(50) NULL,
  `direcciones` VARCHAR(100) NULL,
  `telefonos` VARCHAR(15) NULL,
  `dni` VARCHAR(12) NULL,
  `ruc` VARCHAR(11) NULL,
  `correoelectronico` VARCHAR(50) NULL,
  `contraseñas` VARCHAR(45) NULL,
  `idtipos_clientes` INT NOT NULL,
  `idestado` INT NOT NULL,
  PRIMARY KEY (`idclientes`),
  INDEX `fk_clientes_tipos_clientes1_idx` (`idtipos_clientes` ASC),
  INDEX `fk_clientes_estado1_idx` (`idestado` ASC),
  CONSTRAINT `fk_clientes_tipos_clientes1`
    FOREIGN KEY (`idtipos_clientes`)
    REFERENCES `bookstore`.`tipos_clientes` (`idtipos_clientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_clientes_estado1`
    FOREIGN KEY (`idestado`)
    REFERENCES `bookstore`.`estado` (`idestado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`boletas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`boletas` (
  `idboletas` INT NOT NULL,
  `numero` VARCHAR(15) NULL,
  `fecha` DATETIME NULL,
  `total` DECIMAL(19,7) NULL,
  `igv` DECIMAL(19,7) NULL,
  `idclientes` INT NOT NULL,
  PRIMARY KEY (`idboletas`),
  INDEX `fk_boletas_clientes_idx` (`idclientes` ASC),
  CONSTRAINT `fk_boletas_clientes`
    FOREIGN KEY (`idclientes`)
    REFERENCES `bookstore`.`clientes` (`idclientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`stock`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`stock` (
  `idstock` INT NOT NULL,
  `totalstock` INT NULL,
  `ultimafecha` DATE NULL,
  PRIMARY KEY (`idstock`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`generos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`generos` (
  `idgeneros` INT NOT NULL,
  `generos` VARCHAR(45) NULL,
  PRIMARY KEY (`idgeneros`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`libros` (
  `idlibros` INT NOT NULL,
  `titulo` VARCHAR(100) NULL,
  `descripcion` VARCHAR(100) NULL,
  `precio_unitario` DECIMAL(19,7) NULL,
  `añopublicacion` YEAR NULL,
  `idstock` INT NOT NULL,
  `idgeneros` INT NOT NULL,
  PRIMARY KEY (`idlibros`),
  INDEX `fk_libros_stock1_idx` (`idstock` ASC),
  INDEX `fk_libros_generos1_idx` (`idgeneros` ASC),
  CONSTRAINT `fk_libros_stock1`
    FOREIGN KEY (`idstock`)
    REFERENCES `bookstore`.`stock` (`idstock`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_libros_generos1`
    FOREIGN KEY (`idgeneros`)
    REFERENCES `bookstore`.`generos` (`idgeneros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`detalles_boletas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`detalles_boletas` (
  `iddetalles_boletas` INT NOT NULL,
  `cantidad` INT NULL,
  `precio_unitario` DECIMAL(19,7) NULL,
  `subtotal` DECIMAL(19,7) NULL,
  `idboletas` INT NOT NULL,
  `idlibros` INT NOT NULL,
  PRIMARY KEY (`iddetalles_boletas`),
  INDEX `fk_detalles_boletas_boletas1_idx` (`idboletas` ASC),
  INDEX `fk_detalles_boletas_libros1_idx` (`idlibros` ASC),
  CONSTRAINT `fk_detalles_boletas_boletas1`
    FOREIGN KEY (`idboletas`)
    REFERENCES `bookstore`.`boletas` (`idboletas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalles_boletas_libros1`
    FOREIGN KEY (`idlibros`)
    REFERENCES `bookstore`.`libros` (`idlibros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`autores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`autores` (
  `idautores` INT NOT NULL,
  `fullnombres` VARCHAR(100) NULL,
  `fechanac` DATETIME NULL,
  `fechadef` DATETIME NULL,
  PRIMARY KEY (`idautores`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`editoriales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`editoriales` (
  `ideditoriales` INT NOT NULL,
  `editoriales` VARCHAR(80) NULL,
  PRIMARY KEY (`ideditoriales`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`estado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`estado` (
  `idestado` INT NOT NULL,
  `estado` VARCHAR(45) NULL,
  PRIMARY KEY (`idestado`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`pedidos` (
  `idpedidos` INT NOT NULL,
  `fechapedido` DATE NULL,
  `fechaenvio` VARCHAR(45) NULL,
  `idestado` INT NOT NULL,
  `idclientes` INT NOT NULL,
  PRIMARY KEY (`idpedidos`),
  INDEX `fk_pedidos_estado1_idx` (`idestado` ASC),
  INDEX `fk_pedidos_clientes1_idx` (`idclientes` ASC),
  CONSTRAINT `fk_pedidos_estado1`
    FOREIGN KEY (`idestado`)
    REFERENCES `bookstore`.`estado` (`idestado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedidos_clientes1`
    FOREIGN KEY (`idclientes`)
    REFERENCES `bookstore`.`clientes` (`idclientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`detallespedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`detallespedidos` (
  `iddetallespedidos` INT NOT NULL,
  `cantidad` INT NULL,
  `saldo` DECIMAL(19,7) NULL,
  `idpedidos` INT NOT NULL,
  `idlibros` INT NOT NULL,
  PRIMARY KEY (`iddetallespedidos`, `idpedidos`, `idlibros`),
  INDEX `fk_detallespedidos_pedidos1_idx` (`idpedidos` ASC),
  INDEX `fk_detallespedidos_libros1_idx` (`idlibros` ASC),
  CONSTRAINT `fk_detallespedidos_pedidos1`
    FOREIGN KEY (`idpedidos`)
    REFERENCES `bookstore`.`pedidos` (`idpedidos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detallespedidos_libros1`
    FOREIGN KEY (`idlibros`)
    REFERENCES `bookstore`.`libros` (`idlibros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`auditoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`auditoria` (
  `idauditoria` INT NOT NULL,
  `tabla` VARCHAR(45) NULL,
  `operacion` VARCHAR(45) NULL,
  `datos_anteriores` JSON NULL,
  `datos_actuales` JSON NULL,
  `usuario` VARCHAR(45) NULL,
  `ip` VARCHAR(45) NULL,
  `fecha` TIMESTAMP NULL,
  PRIMARY KEY (`idauditoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`autorlibro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`autorlibro` (
  `idautores` INT NOT NULL,
  `idlibros` INT NOT NULL,
  PRIMARY KEY (`idautores`, `idlibros`),
  INDEX `fk_autorlibro_libros1_idx` (`idlibros` ASC),
  CONSTRAINT `fk_autorlibro_autores1`
    FOREIGN KEY (`idautores`)
    REFERENCES `bookstore`.`autores` (`idautores`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_autorlibro_libros1`
    FOREIGN KEY (`idlibros`)
    REFERENCES `bookstore`.`libros` (`idlibros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bookstore`.`editlibro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookstore`.`editlibro` (
  `ideditoriales` INT NOT NULL,
  `idlibros` INT NOT NULL,
  PRIMARY KEY (`ideditoriales`, `idlibros`),
  INDEX `fk_editlibro_libros1_idx` (`idlibros` ASC),
  CONSTRAINT `fk_editlibro_editoriales1`
    FOREIGN KEY (`ideditoriales`)
    REFERENCES `bookstore`.`editoriales` (`ideditoriales`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_editlibro_libros1`
    FOREIGN KEY (`idlibros`)
    REFERENCES `bookstore`.`libros` (`idlibros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `bookstore`.`tipos_clientes`
-- -----------------------------------------------------
START TRANSACTION;
USE `bookstore`;
INSERT INTO `bookstore`.`tipos_clientes` (`idtipos_clientes`, `tipocliente`) VALUES (1, 'Persona Natural');
INSERT INTO `bookstore`.`tipos_clientes` (`idtipos_clientes`, `tipocliente`) VALUES (2, 'Persona Jurídica');

COMMIT;


-- -----------------------------------------------------
-- Data for table `bookstore`.`estado`
-- -----------------------------------------------------
START TRANSACTION;
USE `bookstore`;
INSERT INTO `bookstore`.`estado` (`idestado`, `estado`) VALUES (1, 'No Registrado');
INSERT INTO `bookstore`.`estado` (`idestado`, `estado`) VALUES (2, 'Registrado');
INSERT INTO `bookstore`.`estado` (`idestado`, `estado`) VALUES (3, 'Suspendido');

COMMIT;

