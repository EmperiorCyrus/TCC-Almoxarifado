-- MySQL Script generated by MySQL Workbench
-- Sat Feb  3 23:36:21 2024
-- Model: New Model    Version: 1.0
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
-- Table `mydb`.`estrutura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`estrutura` (
  `idestrutura` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idestrutura`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`comodo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`comodo` (
  `idSala` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(250) NULL,
  PRIMARY KEY (`idSala`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`armazem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`armazem` (
  `idarmazem` INT NOT NULL AUTO_INCREMENT,
  `andar` INT(1) NOT NULL,
  `descricao` VARCHAR(150) NULL,
  `idestrutura` INT NOT NULL,
  `idcomodo` INT NOT NULL,
  PRIMARY KEY (`idarmazem`, `idestrutura`, `idcomodo`),
  INDEX `fk_armazem_estrutura1_idx` (`idestrutura` ASC) ,
  INDEX `fk_armazem_Sala1_idx` (`idcomodo` ASC) ,
  CONSTRAINT `fk_armazem_estrutura1`
    FOREIGN KEY (`idestrutura`)
    REFERENCES `mydb`.`estrutura` (`idestrutura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_armazem_Sala1`
    FOREIGN KEY (`idcomodo`)
    REFERENCES `mydb`.`comodo` (`idSala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`fornecedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`fornecedor` (
  `id_fornecedor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(200) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_fornecedor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`categoria` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`produto` (
  `id_produto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `marca` VARCHAR(50) NOT NULL,
  `perecivel` VARCHAR(3) NOT NULL COMMENT 'Caso o produto seja um perecivel, o sistema deve obrigar o cadastro da data de validade na tabela entrada.\nQuando ocorrer um data de validade, a saída precisa respeitar a regra FIFO.',
  `descartavel` VARCHAR(3) NOT NULL,
  `validade` DATE NULL,
  `data_criacao` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idarmazem` INT NOT NULL,
  `idfornecedor` INT NOT NULL,
  `idcategoria` INT NOT NULL,
  PRIMARY KEY (`id_produto`, `idfornecedor`, `idcategoria`, `idarmazem`),
  INDEX `fk_produto_armazem1_idx` (`idarmazem` ASC) ,
  INDEX `fk_produto_fornecedor1_idx` (`idfornecedor` ASC) ,
  INDEX `fk_produto_categoria1_idx` (`idcategoria` ASC) ,
  CONSTRAINT `fk_produto_armazem1`
    FOREIGN KEY (`idarmazem`)
    REFERENCES `mydb`.`armazem` (`idarmazem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_fornecedor1`
    FOREIGN KEY (`idfornecedor`)
    REFERENCES `mydb`.`fornecedor` (`id_fornecedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_categoria1`
    FOREIGN KEY (`idcategoria`)
    REFERENCES `mydb`.`categoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`nota`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`nota` (
  `idnota` INT NOT NULL AUTO_INCREMENT COMMENT 'Cada nota pode ser fiscal ou não. De toda forma um documento que determina a origem do lote.',
  `path` VARCHAR(256) NULL COMMENT 'O path é caminho do documento que foi digitalizado. O php fará o upload do arquivo e vem pro banco apenas o caminho do arquivo.',
  `descricao` VARCHAR(45) NOT NULL,
  `data_criacao` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nome` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`idnota`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`lote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`lote` (
  `idlote` INT NOT NULL AUTO_INCREMENT COMMENT 'O lote é um evento para recebimento de produto(s)',
  `data_cadastro` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `idnota` INT NOT NULL,
  PRIMARY KEY (`idlote`, `idnota`),
  INDEX `fk_lote_notafiscal1_idx` (`idnota` ASC) ,
  CONSTRAINT `fk_lote_notafiscal1`
    FOREIGN KEY (`idnota`)
    REFERENCES `mydb`.`nota` (`idnota`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`entrada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`entrada` (
  `ldlote` INT NOT NULL,
  `idproduto` INT NOT NULL,
  `quantidade` INT NULL,
  `validade` DATETIME NULL,
  `valor` DECIMAL(10) NOT NULL,
  PRIMARY KEY (`ldlote`, `idproduto`),
  INDEX `fk_lote_has_produto_produto1_idx` (`idproduto` ASC) ,
  INDEX `fk_lote_has_produto_lote1_idx` (`ldlote` ASC) ,
  CONSTRAINT `fk_lote_has_produto_lote1`
    FOREIGN KEY (`ldlote`)
    REFERENCES `mydb`.`lote` (`idlote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lote_has_produto_produto1`
    FOREIGN KEY (`idproduto`)
    REFERENCES `mydb`.`produto` (`id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tipo_usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tipo_usuario` (
  `idtipo_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtipo_usuario`),
  UNIQUE INDEX `nome_UNIQUE` (`nome` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuario` (
  `idusuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `senha` VARCHAR(20) NOT NULL,
  `idtipo_usuario` INT NULL,
  PRIMARY KEY (`idusuario`, `idtipo_usuario`),
  INDEX `fk_usuario_tipo_usuario1_idx` (`idtipo_usuario` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  CONSTRAINT `fk_usuario_tipo_usuario1`
    FOREIGN KEY (`idtipo_usuario`)
    REFERENCES `mydb`.`tipo_usuario` (`idtipo_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`solicitacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`solicitacao` (
  `idemprestimo` INT NOT NULL AUTO_INCREMENT,
  `idusuario` INT NOT NULL,
  `idproduto` INT NOT NULL,
  `quantidade` INT(5) NOT NULL,
  PRIMARY KEY (`idemprestimo`, `idusuario`, `idproduto`),
  INDEX `fk_solicitacao_usuario1_idx` (`idusuario` ASC) ,
  INDEX `fk_solicitacao_produto1_idx` (`idproduto` ASC) ,
  CONSTRAINT `fk_solicitacao_usuario1`
    FOREIGN KEY (`idusuario`)
    REFERENCES `mydb`.`usuario` (`idusuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_solicitacao_produto1`
    FOREIGN KEY (`idproduto`)
    REFERENCES `mydb`.`produto` (`id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`emprestimo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`emprestimo` (
  `idemprestimo` INT NOT NULL AUTO_INCREMENT,
  `idsolicitacao` INT NOT NULL,
  `data_criacao` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idemprestimo`, `idsolicitacao`),
  INDEX `fk_emprestimo_solicitacao1_idx` (`idsolicitacao` ASC) ,
  CONSTRAINT `fk_emprestimo_solicitacao1`
    FOREIGN KEY (`idsolicitacao`)
    REFERENCES `mydb`.`solicitacao` (`idemprestimo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`saida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`saida` (
  `idregistro` INT NOT NULL,
  `data_saida` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_produto` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `emprestimo_idemprestimo` INT NOT NULL,
  `emprestimo_idsolicitacao` INT NOT NULL,
  PRIMARY KEY (`idregistro`, `id_produto`),
  INDEX `fk_registro_entrada1_idx` (`id_produto` ASC) ,
  INDEX `fk_saida_emprestimo1_idx` (`emprestimo_idemprestimo` ASC, `emprestimo_idsolicitacao` ASC) ,
  CONSTRAINT `fk_registro_entrada1`
    FOREIGN KEY (`id_produto`)
    REFERENCES `mydb`.`entrada` (`idproduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_saida_emprestimo1`
    FOREIGN KEY (`emprestimo_idemprestimo` , `emprestimo_idsolicitacao`)
    REFERENCES `mydb`.`emprestimo` (`idemprestimo` , `idsolicitacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`representante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`representante` (
  `id_contato` INT NOT NULL AUTO_INCREMENT,
  `representante` VARCHAR(200) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `idfornecedor` INT NOT NULL,
  PRIMARY KEY (`id_contato`, `idfornecedor`),
  INDEX `fk_representantes_fornecedor1_idx` (`idfornecedor` ASC) ,
  CONSTRAINT `fk_representantes_fornecedor1`
    FOREIGN KEY (`idfornecedor`)
    REFERENCES `mydb`.`fornecedor` (`id_fornecedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
