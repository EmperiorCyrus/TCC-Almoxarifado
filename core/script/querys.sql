-- drop database almoxarifado;



-- MySQL Script generated by MySQL Workbench
-- Thu Nov 16 20:06:47 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema almoxarifado
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema almoxarifado
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `almoxarifado` DEFAULT CHARACTER SET utf8 ;
USE `almoxarifado` ;

-- -----------------------------------------------------
-- Table `almoxarifado`.`estrutura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`estrutura` (
  `idestrutura` INT NOT NULL,
  PRIMARY KEY (`idestrutura`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`rua`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`rua` (
  `id_rua` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_rua`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`armazem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`armazem` (
  `idarmazem` INT NOT NULL,
  `estrutura_idestrutura` INT NOT NULL,
  `rua_id_rua` INT NOT NULL,
  PRIMARY KEY (`idarmazem`),
  INDEX `fk_armazem_estrutura1_idx` (`estrutura_idestrutura` ASC),
  INDEX `fk_armazem_rua1_idx` (`rua_id_rua` ASC),
  CONSTRAINT `fk_armazem_estrutura1`
    FOREIGN KEY (`estrutura_idestrutura`)
    REFERENCES `almoxarifado`.`estrutura` (`idestrutura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_armazem_rua1`
    FOREIGN KEY (`rua_id_rua`)
    REFERENCES `almoxarifado`.`rua` (`id_rua`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`representantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`representantes` (
  `id_contato` INT NOT NULL AUTO_INCREMENT,
  `representante` VARCHAR(100) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_contato`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`fornecedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`fornecedor` (
  `id_fornecedor` INT NOT NULL AUTO_INCREMENT,
  `empresa` VARCHAR(100) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `telefone` VARCHAR(45) NOT NULL,
  `contato_id_contato` INT NOT NULL,
  PRIMARY KEY (`id_fornecedor`),
  INDEX `fk_fornecedor_contato1_idx` (`contato_id_contato` ASC),
  CONSTRAINT `fk_fornecedor_contato1`
    FOREIGN KEY (`contato_id_contato`)
    REFERENCES `almoxarifado`.`representantes` (`id_contato`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`categoria` (
  `idcategoria` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idcategoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`produto` (
  `id_produto` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `marca` VARCHAR(50) NOT NULL,
  `perecivel` TINYINT NULL COMMENT 'Caso o produto seja um perecivel, o sistema deve obrigar o cadastro da data de validade na tabela entrada.\nQuando ocorrer um data de validade, a saída precisa respeitar a regra FIFO.',
  `descartavel` TINYINT NOT NULL,
  `validade` DATE NULL,
  `data_criacao` DATETIME NOT NULL,
  `armazem_idarmazem` INT NOT NULL,
  `fornecedor_id_fornecedor` INT NOT NULL,
  `categoria_idcategoria` INT NOT NULL,
  `produto_id_produto` INT NULL,
  `produto_fornecedor_id_fornecedor` INT NOT NULL,
  `produto_categoria_idcategoria` INT NOT NULL,
  PRIMARY KEY (`id_produto`, `fornecedor_id_fornecedor`, `categoria_idcategoria`),
  INDEX `fk_produto_armazem1_idx` (`armazem_idarmazem` ASC),
  INDEX `fk_produto_fornecedor1_idx` (`fornecedor_id_fornecedor` ASC),
  INDEX `fk_produto_categoria1_idx` (`categoria_idcategoria` ASC),
  INDEX `fk_produto_produto1_idx` (`produto_id_produto` ASC, `produto_fornecedor_id_fornecedor` ASC, `produto_categoria_idcategoria` ASC),
  CONSTRAINT `fk_produto_armazem1`
    FOREIGN KEY (`armazem_idarmazem`)
    REFERENCES `almoxarifado`.`armazem` (`idarmazem`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_fornecedor1`
    FOREIGN KEY (`fornecedor_id_fornecedor`)
    REFERENCES `almoxarifado`.`fornecedor` (`id_fornecedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_categoria1`
    FOREIGN KEY (`categoria_idcategoria`)
    REFERENCES `almoxarifado`.`categoria` (`idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_produto_produto1`
    FOREIGN KEY (`produto_id_produto` , `produto_fornecedor_id_fornecedor` , `produto_categoria_idcategoria`)
    REFERENCES `almoxarifado`.`produto` (`id_produto` , `fornecedor_id_fornecedor` , `categoria_idcategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`sessao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`sessao` (
  `id_sessao` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  `rua_id_rua` INT NOT NULL,
  PRIMARY KEY (`id_sessao`, `rua_id_rua`),
  INDEX `fk_sessao_rua_idx` (`rua_id_rua` ASC),
  CONSTRAINT `fk_sessao_rua`
    FOREIGN KEY (`rua_id_rua`)
    REFERENCES `almoxarifado`.`rua` (`id_rua`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`nota`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`nota` (
  `idnota` INT NOT NULL AUTO_INCREMENT COMMENT 'Cada nota pode ser fiscal ou não. De toda forma um documento que determina a origem do lote.',
  `path` VARCHAR(256) NULL COMMENT 'O path é caminho do documento que foi digitalizado. O php fará o upload do arquivo e vem pro banco apenas o caminho do arquivo.',
  `descricao` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idnota`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`lote`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`lote` (
  `idlote` INT NOT NULL AUTO_INCREMENT COMMENT 'O lote é um evento para recebimento de produto(s)',
  `data_cadastro` DATETIME NOT NULL DEFAULT now(),
  `nota_idnota` INT NOT NULL,
  PRIMARY KEY (`idlote`, `nota_idnota`),
  INDEX `fk_lote_notafiscal1_idx` (`nota_idnota` ASC),
  CONSTRAINT `fk_lote_notafiscal1`
    FOREIGN KEY (`nota_idnota`)
    REFERENCES `almoxarifado`.`nota` (`idnota`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`entrada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`entrada` (
  `lote_idlote` INT NOT NULL,
  `produto_id_produto` INT NOT NULL,
  `quantidade` INT NULL,
  `validade` DATETIME NULL,
  `valor` DECIMAL(10) NOT NULL,
  PRIMARY KEY (`lote_idlote`, `produto_id_produto`),
  INDEX `fk_lote_has_produto_produto1_idx` (`produto_id_produto` ASC),
  INDEX `fk_lote_has_produto_lote1_idx` (`lote_idlote` ASC),
  CONSTRAINT `fk_lote_has_produto_lote1`
    FOREIGN KEY (`lote_idlote`)
    REFERENCES `almoxarifado`.`lote` (`idlote`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lote_has_produto_produto1`
    FOREIGN KEY (`produto_id_produto`)
    REFERENCES `almoxarifado`.`produto` (`id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`solicitante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`solicitante` (
  `idsolicitante` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NULL,
  PRIMARY KEY (`idsolicitante`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`solicitacao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`solicitacao` (
  `idemprestimo` INT NOT NULL AUTO_INCREMENT,
  `quantidade` VARCHAR(45) NOT NULL,
  `solicitante_idsolicitante` INT NOT NULL,
  PRIMARY KEY (`idemprestimo`),
  INDEX `fk_emprestimo_solicitante1_idx` (`solicitante_idsolicitante` ASC),
  CONSTRAINT `fk_emprestimo_solicitante1`
    FOREIGN KEY (`solicitante_idsolicitante`)
    REFERENCES `almoxarifado`.`solicitante` (`idsolicitante`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`emprestimo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`emprestimo` (
  `idemprestimo` INT NOT NULL AUTO_INCREMENT,
  `entrada_lote_idlote` INT NOT NULL,
  `entrada_produto_id_produto` INT NOT NULL,
  `solicitacao_idemprestimo` INT NOT NULL,
  PRIMARY KEY (`idemprestimo`, `entrada_lote_idlote`, `entrada_produto_id_produto`, `solicitacao_idemprestimo`),
  INDEX `fk_emprestimo_entrada1_idx` (`entrada_lote_idlote` ASC, `entrada_produto_id_produto` ASC),
  INDEX `fk_emprestimo_solicitacao1_idx` (`solicitacao_idemprestimo` ASC),
  CONSTRAINT `fk_emprestimo_entrada1`
    FOREIGN KEY (`entrada_lote_idlote` , `entrada_produto_id_produto`)
    REFERENCES `almoxarifado`.`entrada` (`lote_idlote` , `produto_id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_emprestimo_solicitacao1`
    FOREIGN KEY (`solicitacao_idemprestimo`)
    REFERENCES `almoxarifado`.`solicitacao` (`idemprestimo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `almoxarifado`.`saida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `almoxarifado`.`saida` (
  `idregistro` INT NOT NULL,
  `datacadastro` DATETIME NOT NULL,
  `entrada_lote_idlote` INT NOT NULL,
  `id_produto` INT NOT NULL,
  `quantidade` INT NOT NULL,
  `idemprestimo` INT NOT NULL,
  `emprestimo_entrada_lote_idlote` INT NOT NULL,
  `emprestimo_entrada_produto_id_produto` INT NOT NULL,
  `emprestimo_solicitacao_idemprestimo` INT NOT NULL,
  PRIMARY KEY (`idregistro`, `entrada_lote_idlote`, `id_produto`),
  INDEX `fk_registro_entrada1_idx` (`entrada_lote_idlote` ASC, `id_produto` ASC),
  INDEX `fk_saida_emprestimo1_idx` (`idemprestimo` ASC, `emprestimo_entrada_lote_idlote` ASC, `emprestimo_entrada_produto_id_produto` ASC, `emprestimo_solicitacao_idemprestimo` ASC),
  CONSTRAINT `fk_registro_entrada1`
    FOREIGN KEY (`entrada_lote_idlote` , `id_produto`)
    REFERENCES `almoxarifado`.`entrada` (`lote_idlote` , `produto_id_produto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_saida_emprestimo1`
    FOREIGN KEY (`idemprestimo` , `emprestimo_entrada_lote_idlote` , `emprestimo_entrada_produto_id_produto` , `emprestimo_solicitacao_idemprestimo`)
    REFERENCES `almoxarifado`.`emprestimo` (`idemprestimo` , `entrada_lote_idlote` , `entrada_produto_id_produto` , `solicitacao_idemprestimo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;