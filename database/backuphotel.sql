/*
SQLyog Enterprise v12.5.1 (64 bit)
MySQL - 10.4.28-MariaDB : Database - hotel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`hotel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `hotel`;

/*Table structure for table `cargos` */

DROP TABLE IF EXISTS `cargos`;

CREATE TABLE `cargos` (
  `idcargo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(40) NOT NULL,
  `pago` decimal(7,2) NOT NULL,
  PRIMARY KEY (`idcargo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `cargos` */

insert  into `cargos`(`idcargo`,`tipo`,`pago`) values 
(1,'administrador',1000.00),
(2,'limpieza',150.00);

/*Table structure for table `contratos` */

DROP TABLE IF EXISTS `contratos`;

CREATE TABLE `contratos` (
  `idcontrato` int(11) NOT NULL AUTO_INCREMENT,
  `idempleado` int(11) NOT NULL,
  `idcargo` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  PRIMARY KEY (`idcontrato`),
  KEY `fk_con_ide` (`idempleado`),
  KEY `fk_con_idc` (`idcargo`),
  CONSTRAINT `fk_con_idc` FOREIGN KEY (`idcargo`) REFERENCES `cargos` (`idcargo`),
  CONSTRAINT `fk_con_ide` FOREIGN KEY (`idempleado`) REFERENCES `empleados` (`idempleado`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `contratos` */

insert  into `contratos`(`idcontrato`,`idempleado`,`idcargo`,`fechaInicio`,`fechaFin`) values 
(1,1,1,'2023-05-30','2030-05-30'),
(2,2,2,'2023-05-30','2030-06-25');

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `idempleado` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `turno` char(1) NOT NULL,
  `direccion` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idempleado`),
  KEY `fk_emp_idp` (`idpersona`),
  CONSTRAINT `fk_emp_idp` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`),
  CONSTRAINT `ck_emp_tur` CHECK (`turno` in ('M','T','N'))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `empleados` */

insert  into `empleados`(`idempleado`,`idpersona`,`turno`,`direccion`) values 
(1,1,'M',NULL),
(2,2,'T',NULL),
(3,3,'N',NULL);

/*Table structure for table `habitaciones` */

DROP TABLE IF EXISTS `habitaciones`;

CREATE TABLE `habitaciones` (
  `idhabitacion` int(11) NOT NULL AUTO_INCREMENT,
  `idtipohabitacion` int(11) NOT NULL,
  `numcamas` tinyint(4) NOT NULL,
  `numhabitacion` smallint(6) NOT NULL,
  `piso` tinyint(4) NOT NULL,
  `capacidad` varchar(10) NOT NULL,
  `precio` decimal(5,2) NOT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'Disponible',
  PRIMARY KEY (`idhabitacion`),
  KEY `fk_hab_idt` (`idtipohabitacion`),
  CONSTRAINT `fk_hab_idt` FOREIGN KEY (`idtipohabitacion`) REFERENCES `tipohabitaciones` (`idtipohabitacion`),
  CONSTRAINT `ck_hab_pre` CHECK (`precio` > 0),
  CONSTRAINT `ck_hab_es` CHECK (`estado` in ('Disponible','Ocupado','Mantenimiento'))
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `habitaciones` */

insert  into `habitaciones`(`idhabitacion`,`idtipohabitacion`,`numcamas`,`numhabitacion`,`piso`,`capacidad`,`precio`,`estado`) values 
(1,1,1,110,1,'2',50.00,'Ocupado'),
(2,2,2,111,1,'4',80.00,'Disponible'),
(3,3,3,120,2,'6',100.00,'Ocupado'),
(4,3,3,3,1,'7',100.00,'Disponible'),
(5,1,1,1,1,'2',30.00,'Ocupado'),
(6,4,4,4,3,'2',30.00,'Ocupado');

/*Table structure for table `pagos` */

DROP TABLE IF EXISTS `pagos`;

CREATE TABLE `pagos` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `idreservacion` int(11) NOT NULL,
  `fechapago` datetime NOT NULL DEFAULT current_timestamp(),
  `mediopago` varchar(20) NOT NULL,
  PRIMARY KEY (`idpago`),
  KEY `fk_con_idr` (`idreservacion`),
  CONSTRAINT `fk_con_idr` FOREIGN KEY (`idreservacion`) REFERENCES `reservaciones` (`idreservacion`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pagos` */

insert  into `pagos`(`idpago`,`idreservacion`,`fechapago`,`mediopago`) values 
(1,1,'0000-00-00 00:00:00',''),
(2,2,'0000-00-00 00:00:00',''),
(3,3,'0000-00-00 00:00:00',''),
(4,4,'0000-00-00 00:00:00',''),
(5,11,'2023-06-06 15:52:25','Debito'),
(6,12,'2023-06-06 15:57:49','Efectivo'),
(7,13,'2023-06-06 21:28:05','Efectivo');

/*Table structure for table `personas` */

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `dni` char(8) NOT NULL,
  `telefono` char(9) DEFAULT NULL,
  `fechaNac` datetime NOT NULL,
  PRIMARY KEY (`idpersona`),
  UNIQUE KEY `uk_per_tel` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `personas` */

insert  into `personas`(`idpersona`,`nombres`,`apellidos`,`dni`,`telefono`,`fechaNac`) values 
(1,'fabrizio','Barrios Saavedra','89632547','986574123','2004-03-19 00:00:00'),
(2,'daniela','Mexzo Chavez','82533246','986574985','2003-07-27 00:00:00'),
(3,'cristina','Barreto Rojas','12345678','91225885','2003-02-12 00:00:00'),
(4,'angelo','chicharito','98653274','986521473','2012-10-14 00:00:00'),
(5,'lucas','pelucas','98888888','966666666','2007-06-08 00:00:00');

/*Table structure for table `reservaciones` */

DROP TABLE IF EXISTS `reservaciones`;

CREATE TABLE `reservaciones` (
  `idreservacion` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `idhabitacion` int(11) NOT NULL,
  `idcliente` int(11) NOT NULL,
  `idempleado` int(11) NOT NULL,
  `fecharegistro` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaentrada` date NOT NULL,
  `fechasalida` date NOT NULL,
  `tipocomprobante` char(1) NOT NULL,
  `fechacomprobante` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idreservacion`),
  KEY `fk_res_idu` (`idusuario`),
  KEY `fk_res_idh` (`idhabitacion`),
  KEY `fk_res_idc` (`idcliente`),
  KEY `fk_res_ide` (`idempleado`),
  CONSTRAINT `fk_res_idc` FOREIGN KEY (`idcliente`) REFERENCES `personas` (`idpersona`),
  CONSTRAINT `fk_res_ide` FOREIGN KEY (`idempleado`) REFERENCES `empleados` (`idempleado`),
  CONSTRAINT `fk_res_idh` FOREIGN KEY (`idhabitacion`) REFERENCES `habitaciones` (`idhabitacion`),
  CONSTRAINT `fk_res_idu` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`),
  CONSTRAINT `ck_res_tco` CHECK (`tipocomprobante` in ('F','B'))
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `reservaciones` */

insert  into `reservaciones`(`idreservacion`,`idusuario`,`idhabitacion`,`idcliente`,`idempleado`,`fecharegistro`,`fechaentrada`,`fechasalida`,`tipocomprobante`,`fechacomprobante`,`estado`) values 
(1,1,1,1,1,'2023-06-06 15:43:21','2023-06-06','2023-01-04','F','2023-06-06 15:43:21','0'),
(2,2,2,2,2,'2023-06-06 15:43:21','2023-06-06','2023-04-12','B','2023-06-06 15:43:21','1'),
(3,1,6,3,3,'2023-06-06 15:43:21','2023-06-06','2023-05-27','B','2023-06-06 15:43:21','1'),
(4,2,1,3,2,'2023-06-06 15:43:21','2023-06-06','2023-09-10','F','2023-06-06 15:43:21','1'),
(9,1,1,2,1,'2023-06-06 15:51:33','2023-06-01','2023-06-10','B','2023-06-06 15:51:33','1'),
(11,1,5,3,1,'2023-06-06 15:52:25','2023-06-01','2023-06-25','F','2023-06-06 15:52:25','0'),
(12,2,6,1,1,'2023-06-06 15:57:49','2023-06-06','2023-06-30','B','2023-06-06 15:57:49','1'),
(13,2,5,4,3,'2023-06-06 21:28:05','2023-06-07','2023-06-23','F','2023-06-06 21:28:05','1');

/*Table structure for table `tipohabitaciones` */

DROP TABLE IF EXISTS `tipohabitaciones`;

CREATE TABLE `tipohabitaciones` (
  `idtipohabitacion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(30) NOT NULL,
  `descripcion` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idtipohabitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tipohabitaciones` */

insert  into `tipohabitaciones`(`idtipohabitacion`,`tipo`,`descripcion`) values 
(1,'Matrimonial','habitacion para ua familia'),
(2,'Doble','habitacion para dos a cuatro personas'),
(3,'Individual','habitacion para una o dos personas'),
(4,'Suite','habitacion para muchos');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nombreusuario` varchar(50) NOT NULL,
  `claveacceso` varchar(100) NOT NULL,
  `fecharegistro` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uk_usu_ema` (`email`),
  KEY `fk_usu_idp` (`idpersona`),
  CONSTRAINT `fk_usu_idp` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`idpersona`,`email`,`nombreusuario`,`claveacceso`,`fecharegistro`,`estado`) values 
(1,1,'fabrizio@hola.pe','fabriziobarrios','$2y$10$EohJSIFgIehaCjTte7gR7ejMGA.iYrZ20Tn9h1KLUdydZFY7e8tbK','2023-06-06 15:32:55','1'),
(2,2,'mexzo@gmail.pe','danielachavez','$2y$10$Rl.KQvA3eLF0XSlNrPj8euYJUw8CqSscWIwyVzWYPl6zPpRaW5lxi','2023-06-06 15:32:55','1'),
(3,3,'cristina@hotmail.pe','cristinabarreto','$2y$10$doonbpnR46ytzDoz28mD6eiutBTu/bQF2hsn9Ujs5Zhri0XgsXyFW','2023-06-06 15:32:55','1');

/* Procedure structure for procedure `spu_cliente_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cliente_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_listar`()
BEGIN 
	SELECT 	idpersona, nombres, apellidos,
		dni, telefono, DATE(fechaNac) AS fechaNac
	FROM personas;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_cliente_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_cliente_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_cliente_registrar`(
IN _nombres 	VARCHAR(30),
IN _apellidos 	VARCHAR(30),
IN _dni 	CHAR(8),
IN _telefono 	CHAR(9),
IN _fechaNac	DATE
)
BEGIN 
	IF _telefono = '' THEN SET _telefono = NULL;END IF;
	IF _fechaNac = '' THEN SET _fechaNac = NULL;END IF;
INSERT INTO personas (nombres, apellidos, dni , telefono, fechaNac) VALUES
		(_nombres, _apellidos, _dni , _telefono, _fechaNac);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_habitaciones_data` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_habitaciones_data` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_habitaciones_data`()
BEGIN
	SELECT 	HA.numhabitacion,
		TH.tipo, HA.estado
	FROM habitaciones HA
	INNER JOIN tipohabitaciones TH ON TH.idtipohabitacion = HA.idtipohabitacion;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_haDisponibles_mostrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_haDisponibles_mostrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_haDisponibles_mostrar`()
BEGIN
		
	SELECT	COUNT(*) AS habitaciones_disponibles
	FROM habitaciones
	WHERE estado = 'Disponible';
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_haLimpieza_mostrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_haLimpieza_mostrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_haLimpieza_mostrar`()
BEGIN
	SELECT COUNT(*) AS habitaciones_Limpieza
	FROM habitaciones
	WHERE estado = 'Limpieza';
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_haOcupadas_mostrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_haOcupadas_mostrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_haOcupadas_mostrar`()
BEGIN
	SELECT COUNT(*) AS habitaciones_ocupadas
	FROM habitaciones
	WHERE estado = 'Ocupado';
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_usuarios` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_usuarios` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_usuarios`()
BEGIN
	SELECT 	US.idusuario,
			PE.nombres, PE.apellidos,
			US.email, US.nombreusuario
			
	FROM usuarios US
	INNER JOIN personas PE ON PE.idpersona = US.idpersona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_montoTotal_grafico` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_montoTotal_grafico` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_montoTotal_grafico`()
BEGIN
	SELECT CASE
		WHEN DAYOFWEEK(PA.fechapago) = 1 THEN 'Domingo'
		WHEN DAYOFWEEK(PA.fechapago) = 2 THEN 'Lunes'
		WHEN DAYOFWEEK(PA.fechapago) = 3 THEN 'Martes'
		WHEN DAYOFWEEK(PA.fechapago) = 4 THEN 'Miercoles'
		WHEN DAYOFWEEK(PA.fechapago) = 5 THEN 'Jueves'
		WHEN DAYOFWEEK(PA.fechapago) = 6 THEN 'Viernes'
		WHEN DAYOFWEEK(PA.fechapago) = 7 THEN 'Sabado'
		ELSE 'Error'
		END AS dia_semana,
		SUM(HA.precio) AS monto_venta
	FROM pagos PA
	INNER JOIN reservaciones RE ON RE.idreservacion = PA.idreservacion
	INNER JOIN habitaciones HA ON HA.idhabitacion = RE.idhabitacion
	GROUP BY dia_semana
	ORDER BY FIELD(dia_semana, 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_mostrarNventas_grafico` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_mostrarNventas_grafico` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_mostrarNventas_grafico`()
BEGIN
	SELECT COUNT(*) AS cantReservaciones, DATE(fecharegistro) AS diasReservacion
	FROM  reservaciones
	WHERE fecharegistro BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()
	GROUP BY DATE(fecharegistro);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_pagos_get` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_pagos_get` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_pagos_get`()
BEGIN 
	SELECT 	CONCAT (CLI.nombres, ' ', CLI.apellidos) AS cliente,
			PA.fechapago, PA.mediopago, HA.precio AS precioDia, 
			DATEDIFF(RE.fechasalida, RE.fechaentrada) 
			* HA.precio AS montoPagar
				
	FROM pagos PA
	INNER JOIN reservaciones RE ON RE.idreservacion = PA.idreservacion
	INNER JOIN personas CLI ON CLI.idpersona = RE.idcliente
	INNER JOIN habitaciones HA ON HA.idhabitacion = RE.idhabitacion;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_pagos_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_pagos_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_pagos_registrar`(
IN _idusuario 		INT,
IN _idhabitacion  	INT,
IN _idcliente		INT,
IN _idempleado		INT,
IN _fechaentrada	DATE,
IN _fechasalida		DATE,
IN _tipocomprobante	CHAR(1),
IN _mediopago		VARCHAR(20)
)
BEGIN
	DECLARE ultimo_id INT;
	CALL spu_reservaciones_registrar(_idusuario, _idhabitacion, _idcliente, _idempleado, _fechaentrada, _fechasalida, _tipocomprobante);
	SELECT LAST_INSERT_ID() INTO ultimo_id;
	INSERT INTO pagos (idreservacion, mediopago) VALUES (ultimo_id, _mediopago);
	UPDATE habitaciones SET estado = 'Ocupado' WHERE idhabitacion = _idhabitacion;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_recuperar_clientes` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_recuperar_clientes` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_recuperar_clientes`()
BEGIN
	SELECT idpersona,
	CONCAT(nombres , ' ' , apellidos) AS clientes
	FROM personas;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_recuperar_empleados` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_recuperar_empleados` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_recuperar_empleados`()
BEGIN 
	SELECT 	EM.idempleado,
		PER.nombres
	FROM empleados EM
	INNER JOIN personas PER ON PER.idpersona = EM.idpersona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_recuperar_habitaciones` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_recuperar_habitaciones` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_recuperar_habitaciones`()
BEGIN 
	SELECT 	HA.idhabitacion, 
		CONCAT(TH.tipo, '  N°', HA.numhabitacion) AS habitacion
	FROM habitaciones HA
	INNER JOIN tipohabitaciones TH ON TH.idtipohabitacion = HA.idtipohabitacion;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_recuperar_usuarios` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_recuperar_usuarios` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_recuperar_usuarios`()
BEGIN 
	SELECT idusuario, nombreusuario
	FROM usuarios;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_reservaciones_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_reservaciones_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_reservaciones_eliminar`(IN _idreservacion INT)
BEGIN
	UPDATE reservaciones SET estado = '0'
	WHERE idreservacion = _idreservacion;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_reservaciones_get` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_reservaciones_get` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_reservaciones_get`()
BEGIN 
	SELECT 	RE.idreservacion,
			CONCAT (CLI.nombres, ' ' , CLI.apellidos) AS cliente,
			RE.fechaentrada, RE.fechasalida,
			HA.numhabitacion, HA.piso, HA.capacidad, HA.precio

	FROM reservaciones RE
	INNER JOIN empleados EM ON EM.idempleado = RE.idempleado 
	INNER JOIN personas CLI ON CLI.idpersona = RE.idcliente
	INNER JOIN habitaciones HA ON HA.idhabitacion = RE.idhabitacion
	WHERE RE.estado = '1'
	ORDER BY RE.idreservacion;	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_reservaciones_recuperar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_reservaciones_recuperar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_reservaciones_recuperar`(IN _idreservacion INT )
BEGIN 
	SELECT  idreservacion,idcliente, idempleado, idusuario,
		idhabitacion, fechaentrada, fechasalida, 
		tipocomprobante
	FROM reservaciones
	WHERE idreservacion = _idreservacion;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_reservaciones_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_reservaciones_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_reservaciones_registrar`(
IN _idusuario 		INT,
IN _idhabitacion  	INT,
IN _idcliente		INT,
IN _idempleado		INT,
IN _fechaentrada	DATE,
IN _fechasalida		DATE,
IN _tipocomprobante	CHAR(1)
)
BEGIN
	INSERT INTO reservaciones (idusuario, idhabitacion, idcliente, idempleado, fechaentrada, fechasalida, tipocomprobante) VALUES
		( _idusuario, _idhabitacion, _idcliente, _idempleado, _fechaentrada, _fechasalida, _tipocomprobante);
		SELECT LAST_INSERT_ID() AS ultimo_id;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_reservaciones_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_reservaciones_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_reservaciones_update`(
IN _idreservacion 	INT,
IN _idusuario 		INT,
IN _idhabitacion 	INT,
IN _idcliente 		INT,
IN _idempleado 		INT,
IN _fechaentrada 	DATE,
IN _fechasalida 	DATE,
IN _tipocomprobante 	CHAR(1)
)
BEGIN
	UPDATE reservaciones SET
	 idusuario = _idusuario,
	 idhabitacion = _idhabitacion,
	 idcliente = _idcliente,
	 idempleado = _idempleado,
	 fechaentrada = _fechaentrada,
	 fechasalida = _fechasalida,
	 tipocomprobante = _tipocomprobante
	 WHERE idreservacion = _idreservacion;

END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_iniciarS` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_iniciarS` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_iniciarS`(IN _email VARCHAR(50))
BEGIN 

	SELECT usuarios.`idusuario`,
		personas.`apellidos`, personas.`nombres`,		
		usuarios.nombreusuario,	usuarios.email, usuarios.`claveacceso`
	FROM usuarios
	INNER JOIN personas ON personas.`idpersona` = usuarios.`idpersona`
	WHERE email = _email AND estado = '1';  

END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
