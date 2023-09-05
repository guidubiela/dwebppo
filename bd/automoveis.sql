CREATE SCHEMA automoveis;
USE automoveis;

CREATE TABLE `marca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `fund` datetime NOT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `carro` (
  `idcarro` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(45) NOT NULL,
  `marca_idmarca` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `km` decimal(6,2) NOT NULL,
  PRIMARY KEY (`idcarro`),
  KEY `marca_idmarca` (`marca_idmarca`),
  CONSTRAINT `carro_ibfk_1` FOREIGN KEY (`marca_idmarca`) REFERENCES `marca` (`idmarca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `moto` (
  `idmoto` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(45) NOT NULL,
  `marca_idmarca` int(11) NOT NULL,
  `ano` int(11) NOT NULL,
  `km` decimal(6,2) NOT NULL,
  PRIMARY KEY (`idmoto`),
  KEY `marca_idmarca` (`marca_idmarca`),
  CONSTRAINT `moto_ibfk_1` FOREIGN KEY (`marca_idmarca`) REFERENCES `marca` (`idmarca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `loja` (
  `idloja` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cnpj` int(11) NOT NULL,
  `fund` datetime NOT NULL,
  PRIMARY KEY (`idloja`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `loja_carro` (
  `loja_idloja` int(11) NOT NULL,
  `carro_idcarro` int(11) NOT NULL,
  PRIMARY KEY (`loja_idloja`,`carro_idcarro`),
  KEY `carro_idcarro` (`carro_idcarro`),
  CONSTRAINT `loja_carro_ibfk_1` FOREIGN KEY (`loja_idloja`) REFERENCES `loja` (`idloja`),
  CONSTRAINT `loja_carro_ibfk_2` FOREIGN KEY (`carro_idcarro`) REFERENCES `carro` (`idcarro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `loja_moto` (
  `loja_idloja` int(11) NOT NULL,
  `moto_idmoto` int(11) NOT NULL,
  PRIMARY KEY (`loja_idloja`,`moto_idmoto`),
  KEY `moto_idmoto` (`moto_idmoto`),
  CONSTRAINT `loja_moto_ibfk_1` FOREIGN KEY (`loja_idloja`) REFERENCES `loja` (`idloja`),
  CONSTRAINT `loja_moto_ibfk_2` FOREIGN KEY (`moto_idmoto`) REFERENCES `moto` (`idmoto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;