DROP DATABASE IF EXISTS hotel;
CREATE DATABASE hotel;
USE hotel;

CREATE TABLE personas
(
	idpersona INT AUTO_INCREMENT PRIMARY KEY,
	nombres VARCHAR(30) NOT NULL,
	apellidos VARCHAR(30) NOT NULL,
	dni CHAR(8) NOT NULL,
	telefono CHAR(9) NULL,
	fechaNac DATETIME NOT NULL,
	CONSTRAINT uk_per_tel UNIQUE(dni)
)
ENGINE = INNODB;

INSERT INTO personas (nombres, apellidos, dni, telefono, fechaNac) VALUES
	('fabrizio','Barrios Saavedra','89632547','986574123','2004-03-19'),
	('daniela','Mexzo Chavez','82533246','986574985','2003-07-27'),
	('cristina','Barreto Rojas','12345678','91225885','2003-02-12');
SELECT * FROM personas	


CREATE TABLE usuarios
(
	idusuario INT AUTO_INCREMENT PRIMARY KEY,
	idpersona INT NOT NULL,
	email VARCHAR(50) NOT NULL,
	nombreusuario	VARCHAR(50)	NOT NULL,
	claveacceso VARCHAR(100) NOT NULL,
	fecharegistro DATETIME NOT NULL DEFAULT NOW(),
	estado CHAR(1) NOT NULL DEFAULT '1',
	CONSTRAINT fk_usu_idp FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
	CONSTRAINT uk_usu_ema UNIQUE(email)
)
ENGINE = INNODB;
WHERE idusuario = 1;
INSERT INTO usuarios (idpersona, nombreusuario, email, claveacceso) VALUES
	(1, 'fabriziobarrios', 'fabrizio@hola.pe', '12345'),
	(2, 'danielachavez', 'mexzo@gmail.pe', '12345'),
	(3, 'cristinabarreto', 'cristina@hotmail.pe', '12345');
			
UPDATE usuarios
	SET claveacceso = '$2y$10$EohJSIFgIehaCjTte7gR7ejMGA.iYrZ20Tn9h1KLUdydZFY7e8tbK'
	WHERE idusuario = 1;
	
UPDATE usuarios
	SET claveacceso = '$2y$10$Rl.KQvA3eLF0XSlNrPj8euYJUw8CqSscWIwyVzWYPl6zPpRaW5lxi'
	WHERE idusuario = 2;
	
UPDATE usuarios
	SET claveacceso = '$2y$10$doonbpnR46ytzDoz28mD6eiutBTu/bQF2hsn9Ujs5Zhri0XgsXyFW'
	WHERE idusuario = 3;
SELECT * FROM usuarios;

CREATE TABLE cargos
(
	idcargo INT AUTO_INCREMENT PRIMARY KEY,
	tipo VARCHAR(40) NOT NULL,
	pago DECIMAL(7,2) NOT NULL
)
ENGINE = INNODB;

INSERT INTO cargos (tipo, pago) VALUES 
	("administrador", 1000),
	("limpieza", 150);
SELECT * FROM cargos

CREATE TABLE empleados
(
	idempleado INT AUTO_INCREMENT PRIMARY KEY,
	idpersona INT NOT NULL,
	turno CHAR(1) NOT NULL, -- M(mañana) T(tarde) , N(noche)
	direccion VARCHAR(40) NULL,
	CONSTRAINT fk_emp_idp FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
	CONSTRAINT 	ck_emp_tur CHECK (turno IN('M','T','N'))
)
ENGINE = INNODB;

INSERT INTO empleados (idpersona,turno) VALUES 
			(1,'M'),
			(2,'T'),
			(3,'N');
SELECT * FROM empleados;
				
CREATE TABLE contratos 
(
	idcontrato INT AUTO_INCREMENT PRIMARY KEY,
	idempleado INT NOT NULL,
	idcargo INT NOT NULL,
	fechaInicio DATE NOT NULL,
	fechaFin DATE NOT NULL,
	CONSTRAINT fk_con_ide FOREIGN KEY (idempleado) REFERENCES empleados (idempleado),
	CONSTRAINT fk_con_idc FOREIGN KEY (idcargo) REFERENCES cargos (idcargo)
)
ENGINE = INNODB;

INSERT INTO contratos (idempleado, idcargo, fechaInicio, fechaFin) VALUES
			(1, 1, '2023-05-30', '2030-05-30'),
			(2, 2, '2023-05-30','2030-06-25');
SELECT * FROM contratos;
				
CREATE TABLE tipohabitaciones
(
	idtipohabitacion INT AUTO_INCREMENT PRIMARY KEY,
	tipo VARCHAR(30) NOT NULL,
	descripcion VARCHAR(80)	NULL
)
ENGINE = INNODB;

INSERT INTO tipohabitaciones (tipo, descripcion) VALUES
	('Matrimonial', 'habitacion para ua familia'),
	('Doble', 'habitacion para dos a cuatro personas'),
	('Individual', 'habitacion para una o dos personas'),
	('Suite', 'habitacion para muchos');
SELECT * FROM tipohabitaciones;
		

CREATE TABLE habitaciones
(
	idhabitacion INT AUTO_INCREMENT PRIMARY KEY,
	idtipohabitacion INT NOT NULL,
	numcamas TINYINT NOT NULL,
	numhabitacion SMALLINT NOT NULL,
	piso TINYINT NOT NULL,
	capacidad VARCHAR(10) NOT NULL,
	precio DECIMAL(5,2) NOT NULL,
	estado VARCHAR(20) NOT NULL DEFAULT 'Disponible', -- Disponible , Ocupado, Mantenimiento
	CONSTRAINT fk_hab_idt FOREIGN KEY (idtipohabitacion) REFERENCES tipohabitaciones (idtipohabitacion),
	CONSTRAINT ck_hab_pre CHECK (precio > 0),
	CONSTRAINT ck_hab_es CHECK (estado IN ('Disponible','Ocupado','Mantenimiento'))
)
ENGINE = INNODB;

INSERT INTO habitaciones (idtipohabitacion, numcamas, numhabitacion, piso, capacidad, precio, estado) VALUES
			(1, 1, 110, 1, 2, 50, 'Mantenimiento'),
			(2, 2, 111, 1, 4, 80, 'Disponible'),
			(3, 3, 120, 2, 6, 100, 'Ocupado'),
			(3,  3, 3, 1, 7, 100, 'Disponible'),
			(1,  1, 1, 1, 2, 30, 'Ocupado'),
			(4,  4, 4, 3, 2, 30, 'Disponible');
SELECT * FROM habitaciones;

CREATE TABLE reservaciones
(
	idreservacion INT AUTO_INCREMENT PRIMARY KEY,
	idusuario INT NOT NULL,
	idhabitacion INT NOT NULL,
	idcliente INT NOT NULL,
	idempleado INT NOT NULL,
	fecharegistro DATETIME NOT NULL DEFAULT NOW(),
	fechaentrada DATE NOT NULL,
	fechasalida DATE NOT NULL,
	tipocomprobante CHAR(1) NOT NULL,  -- F(factura) , B(boleta)   
	fechacomprobante DATETIME NOT NULL DEFAULT NOW(),
	estado CHAR(1) NOT NULL DEFAULT '1',
	CONSTRAINT fk_res_idu FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario),
	CONSTRAINT fk_res_idh FOREIGN KEY (idhabitacion) REFERENCES habitaciones (idhabitacion),
	CONSTRAINT fk_res_idc FOREIGN KEY (idcliente) REFERENCES personas (idpersona), -- foreanea clientes de la entidad personas
	CONSTRAINT fk_res_ide FOREIGN KEY (idempleado) REFERENCES empleados (idempleado),
	CONSTRAINT ck_res_tco CHECK (tipocomprobante IN ('F','B'))
)
ENGINE = INNODB;

INSERT INTO reservaciones (idusuario, idhabitacion, idcliente, idempleado, fechaentrada, fechasalida, tipocomprobante) VALUES
	(1, 1, 1, 1, CURRENT_TIMESTAMP(), '2023-01-04', 'F'),
	(2, 2, 2, 2, CURRENT_TIMESTAMP(), '2023-04-12', 'B'),
	(1, 3, 3, 3, CURRENT_TIMESTAMP(), '2023-05-20', 'B'),
	(2, 1, 3, 2, CURRENT_TIMESTAMP(), '2023-09-10', 'F');
SELECT * FROM reservaciones;

CREATE TABLE pagos
(
	idpago INT AUTO_INCREMENT PRIMARY KEY,
	idreservacion INT NOT NULL,
	fechapago DATETIME NOT NULL DEFAULT NOW(),
	mediopago VARCHAR(20) NOT NULL, -- Efectivo, Debito
	CONSTRAINT fk_con_idr FOREIGN KEY (idreservacion) REFERENCES reservaciones(idreservacion)
)
ENGINE = INNODB;
INSERT INTO pagos (idreservacion, fechapago) VALUES
	(1, 'Debito'),
	(2, 'Efectivo'),
	(3, 'Debito'),
	(4, 'Efectivo');
SELECT * FROM pagos;
