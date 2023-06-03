CREATE DATABASE hotel;
USE hotel;

-- tabla usuarios
CREATE TABLE usuarios 
(
	idusuario		INT AUTO_INCREMENT PRIMARY KEY,
	apellidos		VARCHAR(40)	NOT NULL,
	nombres 		VARCHAR(40)	NOT NULL,
	telefono		CHAR(9)		NULL,
	email 			VARCHAR(70) 	NOT NULL,
	claveacceso		VARCHAR(90)	NOT NULL,
	nivelacceso		CHAR(1)		NOT NULL DEFAULT 'S', -- S standar A administrador
	fecharegistro		DATETIME	NOT NULL DEFAULT NOW(),
	fechabaja 		DATETIME 	NULL,
	estado			CHAR(1)		NOT NULL DEFAULT '1', -- 1 = activo | 0 = inactivo
	CONSTRAINT uk_email_usu UNIQUE (email)
) ENGINE = INNODB;

INSERT INTO usuarios (apellidos, nombres, email, claveacceso, nivelacceso) VALUES
	('Barrios Saavedra', 'fabrizio', 'fabrizio@hola.pe', '12345', "S"),
	('Barrios Saavedra', 'rodrigo', 'rodrigo@hotmail.pe', '12345', "A");
			
UPDATE usuarios 
	SET claveacceso = '$2y$10$EohJSIFgIehaCjTte7gR7ejMGA.iYrZ20Tn9h1KLUdydZFY7e8tbK'
	WHERE idusuario = 1;

UPDATE usuarios 
	SET claveacceso = '$2y$10$Rl.KQvA3eLF0XSlNrPj8euYJUw8CqSscWIwyVzWYPl6zPpRaW5lxi'
	WHERE idusuario = 2;
	
SELECT * FROM usuarios;

-- tabla personas 
CREATE TABLE personas
(
	idpersona		INT AUTO_INCREMENT PRIMARY KEY,
	nombres 		VARCHAR(30)	NOT NULL,
	apellidos 		VARCHAR(30)	NOT NULL,
	dni			CHAR(8)		NOT NULL,
	telefono		CHAR(9)		NULL,
	fechanacimiento		DATE	NOT NULL,
	CONSTRAINT uk_persona_dni UNIQUE(dni)
) ENGINE = INNODB;

INSERT INTO personas (nombres, apellidos, dni, telefono, fechanacimiento) VALUES
	('fabrizio','Barrios Saavedra','89632547','986574123','2004-03-19'),
	('daniela','Mexzo Chavez','82533246','986574985','2003-07-27'),
	('cristina','Barreto Rojas','12345678','91225885','2003-02-12');
SELECT * FROM personas;

-- tabla areas
CREATE TABLE areas
(
	idarea INT AUTO_INCREMENT PRIMARY KEY,
	tipoarea VARCHAR(30) NOT NULL,
	montopago DECIMAL(7,2) NOT NULL
) ENGINE = INNODB;

INSERT INTO areas (tipoarea, montopago) VALUES
	("administrador", 1000),
	("limpieza", 150);
SELECT * FROM areas;

-- tabla empleados
CREATE TABLE empleados
(
	idempleado INT AUTO_INCREMENT PRIMARY KEY,
	idpersona INT NOT NULL, -- fk
	turno CHAR(9) NOT NULL, -- turno (m)añana o (t)arde o (a)manecida
	CONSTRAINT ck_turno_empleado CHECK (turno IN ('mañana', 'tarde', 'amanecida')),
	CONSTRAINT fk_idpersona_empleado FOREIGN KEY (idpersona) REFERENCES personas (idpersona)
)ENGINE = INNODB;
INSERT INTO empleados (idpersona, turno) VALUES
	(1, 'mañana'),
	(2, 'tarde'),
	(3, 'amanecida');
SELECT * FROM empleados;

-- tabla categoria
CREATE TABLE categoria(
	idcategoria INT AUTO_INCREMENT PRIMARY KEY,
	descripcion VARCHAR(50),
	estado CHAR(1) NOT NULL DEFAULT '1',
	fechaCreacion DATETIME NOT NULL DEFAULT NOW()
)ENGINE = INNODB

INSERT INTO categoria(descripcion) VALUES
	('Matrimonial'),
	('Doble'),
	('Individual'),
	('Suite')
SELECT * FROM categoria;

-- tipo de habitaciones
CREATE TABLE tipohabitaciones
(
	idtipohabitacion INT AUTO_INCREMENT PRIMARY KEY,
	idcategoria INT NOT NULL,
	descripcion VARCHAR(50) NOT NULL,
	estado CHAR(1) NOT NULL DEFAULT '1',
	fechaCreacion DATETIME NOT NULL DEFAULT NOW(),
	CONSTRAINT fk_idcategoria_tipohabitaciones FOREIGN KEY (idcategoria) REFERENCES categoria (idcategoria)
) ENGINE = INNODB;

INSERT INTO tipohabitaciones (idcategoria, descripcion) VALUES
	(1, 'habitacion para uno'),
	(2, 'habitacion para dos'),
	(1, 'habitacion para uno'),
	(2, 'habitacion para dos'),
	(4, 'habitacion completa'),
	(3, 'habitacion para tres');
SELECT * FROM tipohabitaciones;

-- tabla habitaciones
CREATE TABLE habitaciones
(
	idhabitacion INT AUTO_INCREMENT PRIMARY KEY,
	idtipohabitacion INT NOT NULL,
	idcategoria INT NOT NULL,
	numcuarto TINYINT NOT NULL,
	numhabitacion SMALLINT NOT NULL,
	piso TINYINT NOT NULL,
	capacidad VARCHAR(10) NOT NULL,
	precio DECIMAL(5,2) NOT NULL,
	estado VARCHAR(20) NOT NULL DEFAULT 'Disponible', -- Disponible , Ocupado, Limpieza
	CONSTRAINT fk_idtipohabitacion_habitaciones FOREIGN KEY (idtipohabitacion) REFERENCES tipohabitaciones (idtipohabitacion),
	CONSTRAINT fk_idcategoria_habitaciones FOREIGN KEY (idcategoria) REFERENCES categoria (idcategoria),
	CONSTRAINT ck_precio_habitaciones CHECK (precio > 0),
	CONSTRAINT ck_estado_habitaciones CHECK (estado IN ('Disponible','Ocupado','Limpieza'))
) ENGINE = INNODB;

INSERT INTO habitaciones (idtipohabitacion, idcategoria, numcuarto, numhabitacion, piso, capacidad, precio) VALUES
	(1, 1, 1, 1, 1, 2, 30),
	(2, 2, 2, 2, 1, 6, 50),
	(3, 3, 3, 3, 1, 7, 100),
	(4, 4, 4, 4, 3, 2, 30);
SELECT * FROM habitaciones;

-- tabla reservaciones
CREATE TABLE reservaciones
(
	idreservacion INT AUTO_INCREMENT PRIMARY KEY,
	idusuario INT NOT NULL,
	idhabitacion INT NOT NULL,
	idcliente INT NOT NULL,
	idempleado INT NOT NULL,
	fecharegistro DATETIME NOT NULL DEFAULT NOW(),
	fechaentrada DATETIME NOT NULL,
	fechasalida DATE NOT NULL,
	tipocomprobante CHAR(8) NOT NULL,  -- factura , boleta  
	fechacomprobante DATETIME NOT NULL DEFAULT NOW(),
	CONSTRAINT ck_tipocomprobante_reservaciones CHECK (tipocomprobante IN ('Factura', 'Boleta')),
	CONSTRAINT fk_idusuario_reservaciones FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario),
	CONSTRAINT fk_idhabitacion_reservaciones FOREIGN KEY (idhabitacion) REFERENCES habitaciones (idhabitacion),
	CONSTRAINT fk_idcliente_reservaciones FOREIGN KEY (idcliente) REFERENCES personas (idpersona),
	CONSTRAINT fk_idempleado_reservaciones FOREIGN KEY (idempleado) REFERENCES empleados (idempleado)
) ENGINE = INNODB;

INSERT INTO reservaciones (idusuario, idhabitacion, idcliente, idempleado, fechaentrada, fechasalida, tipocomprobante) VALUES
	(1, 1, 1, 1, CURRENT_TIMESTAMP(), '2023-01-04', 'Factura'),
	(2, 2, 2, 2, CURRENT_TIMESTAMP(), '2023-04-12', 'Boleta'),
	(1, 3, 3, 3, CURRENT_TIMESTAMP(), '2023-05-20', 'Boleta'),
	(2, 1, 3, 2, CURRENT_TIMESTAMP(), '2023-09-10', 'Factura');
SELECT * FROM reservaciones;

/*falta hacer y probar*/
-- tabla detalles de pago
CREATE TABLE detallespagos
(
	iddetallepago INT AUTO_INCREMENT PRIMARY KEY,
	idreservacion INT NOT NULL,
	formapago VARCHAR(20) NOT NULL,
	CONSTRAINT fk_idreservacion_detallespagos FOREIGN KEY (idreservacion) REFERENCES reservaciones (idreservacion)
)ENGINE = INNODB;

INSERT INTO detallespagos (idreservacion, formapago) VALUES
	(1, 'Debito'),
	(2, 'Efectivo'),
	(3, 'Debito'),
	(4, 'Efectivo');
SELECT * FROM detallespagos;

-- pagos
CREATE TABLE pagos
(
	idpagos INT AUTO_INCREMENT PRIMARY KEY,
	iddetallepago INT NOT NULL,
	-- estado VARCHAR(10),
	total DECIMAL(10,2) NOT NULL,
	-- constraint ck_estado_pagos check (estado in ('Pendiente', 'Pagado'))
)ENGINE = INNODB

