USE hotel;

-- tabla usuarios
DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN _email VARCHAR(70))
BEGIN
	SELECT	idusuario,
		nombreusuario,
		apellidos,
		nombres,
		telefono,
		email,
		claveacceso,
		nivelacceso
	FROM usuarios
	INNER JOIN personas ON personas.idpersona = usuarios.idpersona
	WHERE email = _email AND estado = '1';
END $$
CALL spu_usuarios_login('mexzo@gmail.pe');

-- recuperar usuarios
DELIMITER $$
CREATE PROCEDURE spu_usuarios_listar()
BEGIN
	SELECT idusuario, nombreusuario, nombres, apellidos, telefono, email, nivelacceso
	FROM usuarios
	INNER JOIN personas ON personas.idpersona = usuarios.idpersona;
END $$
CALL spu_usuarios_listar();

/*
DELIMITER $$
CREATE PROCEDURE spu_usuarios_registrar(
	in _apellidos varchar(40),
	in _nombreusuario varchar(30),
	in _nombres varchar(40),
	in _telefono char(9),
	in _email varchar(70),
	in _claveacceso varchar(90),
	in _nivelacceso char(1)
)
BEGIN
	if _telefono = '' then set _telefono = null;
	end if;
	insert into usuarios (apellidos, nombreusuario, nombres, telefono, email, claveacceso, nivelacceso) 
	values (_apellidos, _nombreusuario, _nombres, _telefono, _email, _claveacceso, _nivelacceso)
	INNER JOIN personas ON personas.idpersona = usuarios.idpersona;
END $$
call spu_usuarios_registrar('minotauro', 'cuto', '', 'cuto@developer.pe', 'holamundo', 'Administrador');
CALL spu_usuarios_listar();
*/


-- tabla reservaciones
-- reservaciones get
DELIMITER $$
CREATE PROCEDURE spu_reservaciones_listar()
BEGIN
	SELECT 	reservaciones.idreservacion,
			CONCAT (clientes.nombres, ' ' , clientes.apellidos) AS cliente,
			reservaciones.fechaentrada, reservaciones.fechasalida,
			habitacion.numhabitacion, habitacion.piso, habitacion.capacidad, habitacion.precio

	FROM reservaciones reservaciones
	INNER JOIN empleados empleado ON empleado.idempleado = reservaciones.idempleado 
	INNER JOIN personas clientes ON clientes.idpersona = reservaciones.idcliente
	INNER JOIN habitaciones habitacion ON habitacion.idhabitacion = reservaciones.idhabitacion
	WHERE reservaciones.estado = '1'
	ORDER BY reservaciones.idreservacion;
END $$
CALL spu_reservaciones_listar();

-- actualizar reservaciones
DELIMITER $$
CREATE PROCEDURE spu_reservaciones_actualizar
(
	IN _idreservacion	INT,
	IN _idusuario  	INT,
	IN _idhabitacion INT,
	IN _idcliente		INT,
	IN _idempleado		INT,
	IN _fechaentrada	DATE,
	IN _fechasalida		DATE,
	IN _tipocomprobante	CHAR(8)
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
END $$
CALL spu_reservaciones_actualizar(2, 1, 1, 2, 2, CURRENT_TIMESTAMP(), '2023-04-20', 'Factura');
CALL spu_reservaciones_listar();

-- eliminar reservaciones
DELIMITER $$ 
CREATE PROCEDURE spu_reservaciones_eliminar(IN _idreservacion INT)
BEGIN
	UPDATE reservaciones SET estado = '0'
	WHERE idreservacion = _idreservacion;
END $$
CALL spu_reservaciones_eliminar(1);
CALL spu_reservaciones_listar();
UPDATE reservaciones SET estado = '1';

-- recuperar reservaciones
DELIMITER $$ 
CREATE PROCEDURE spu_reservaciones_getdata(IN _idreservacion INT )
BEGIN 
	SELECT  idreservacion, idcliente, idempleado, idusuario,
		idhabitacion, fechaentrada, fechasalida, 
		tipocomprobante
	FROM reservaciones
	WHERE idreservacion = _idreservacion;
END $$
CALL spu_reservaciones_getdata(1);

-- tabla pagos
-- pagos get
DELIMITER $$ 
CREATE PROCEDURE spu_detpagos_getdata()
BEGIN 
	SELECT 	CONCAT (clientes.nombres, ' ', clientes.apellidos) AS cliente,
			pago.diapago, pago.formapago, habitacion.precio AS precioTotal, 
			DATEDIFF(reservacion.fechasalida, reservacion.fechaentrada) * habitacion.precio AS montoTotal
	FROM detallespagos pago
	INNER JOIN reservaciones reservacion ON reservacion.idreservacion = pago.idreservacion
	INNER JOIN personas clientes ON clientes.idpersona = reservacion.idcliente
	INNER JOIN habitaciones habitacion ON habitacion.idhabitacion = reservacion.idhabitacion;
END $$
CALL spu_detpagos_getdata();

-- recuperar empleado
DELIMITER $$
CREATE PROCEDURE spu_empleados_listar()
BEGIN
	SELECT 	empleado.idempleado,
		persona.nombres
	FROM empleados empleado
	INNER JOIN personas persona ON persona.idpersona = empleado.idpersona;
END $$
CALL spu_empleados_listar();

-- recuperar clientes
DELIMITER $$
CREATE PROCEDURE spu_personas_listar()
BEGIN
	SELECT idpersona,
	CONCAT(nombres , ' ' , apellidos) AS clientes, dni, telefono, fechanacimiento
	FROM personas;
END $$
CALL spu_personas_listar();

-- RECUPERAR HABITACIONES 
DELIMITER $$
CREATE PROCEDURE spu_habitaciones_listar()
BEGIN 
	SELECT 	idhabitacion, 
		CONCAT(descripcion, ' Nro° Habitacion ', numhabitacion) AS habitacion
	FROM habitaciones
	INNER JOIN categoria ON idcategoria = idcategoria;
END $$
CALL spu_habitaciones_listar();

-- habitaciones data
DELIMITER $$
CREATE PROCEDURE spu_habitaciones_getdata()
BEGIN
	SELECT 	numhabitacion, descripcion, habitaciones.estado
	FROM habitaciones
	INNER JOIN categoria ON idcategoria = idcategoria;
END $$
CALL spu_habitaciones_getdata();

-- spu_haDisponibles_mostrar
DELIMITER $$ 
CREATE PROCEDURE spu_habitaciones_disponible()
BEGIN
	SELECT	COUNT(*) AS Disponible
	FROM habitaciones
	WHERE estado = 'Disponible';
END $$
CALL spu_habitaciones_disponible();

-- spu_haOcupadas_mostrar()
DELIMITER $$ 
CREATE PROCEDURE spu_habitaciones_ocupadas()
BEGIN
	SELECT COUNT(*) AS Ocupadas
	FROM habitaciones
	WHERE estado = 'Ocupado';
END $$
CALL spu_habitaciones_ocupadas();

-- spu_haLimpieza_mostrar
DELIMITER $$ 
CREATE PROCEDURE spu_habitaciones_limpieza()
BEGIN
	SELECT COUNT(*) AS Limpieza
	FROM habitaciones
	WHERE estado = 'Limpieza';
END $$
CALL spu_habitaciones_limpieza();

-- reservaciones registrar
/**/
DELIMITER $$
CREATE PROCEDURE spu_reservaciones_registrar
(
	IN _idusuario 		INT,
	IN _idhabitacion  	INT,
	IN _idcliente		INT,
	IN _idempleado		INT,
	IN _fechaentrada	DATE,
	IN _fechasalida		DATE,
	IN _tipocomprobante	CHAR(8)
)
BEGIN
INSERT INTO reservaciones (idusuario, idhabitacion, idcliente, idempleado, fechaentrada, fechasalida, tipocomprobante) VALUES
	( _idusuario, _idhabitacion, _idcliente, _idempleado, _fechaentrada, _fechasalida, _tipocomprobante);
	SELECT LAST_INSERT_ID() AS _id;
END $$
CALL spu_reservaciones_registrar(1, 3, 1, 2, CURRENT_TIMESTAMP(), '2023-03-24', 'Factura');

-- spu_pagos_registrar
DELIMITER $$
CREATE PROCEDURE spu_detallespagos_registro
(
	IN _idhabitacion  	INT,
	IN _idcliente		INT,
	IN _idusuario 		INT,
	IN _idempleado		INT,
	IN _fechaentrada	DATE,
	IN _fechasalida		DATE,
	IN _tipocomprobante	CHAR(8),
	IN _formapago 		VARCHAR(20)
)
BEGIN
	DECLARE _id INT;
	CALL spu_reservaciones_registrar( _idusuario, _idhabitacion, _idcliente, _idempleado, _fechaentrada, _fechasalida, _tipocomprobante);
	SELECT LAST_INSERT_ID() INTO _id;
	INSERT INTO detallespagos (idreservacion, formapago) VALUES (_id, _formapago);
END $$
CALL spu_detallespagos_registro(2, 2, 1, 1, CURRENT_TIMESTAMP(), '2023-09-12', 'Factura', 'Debito');
SELECT * FROM detallespagos;


-- GRAFICO muestra numero de ventas en la semana
DELIMITER $$ 
CREATE PROCEDURE spu_grafico_alquiler()
BEGIN 
	SELECT COUNT(*) AS cantidad, DATE(fecharegistro) AS dias
	FROM  reservaciones
	WHERE fecharegistro BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()
	GROUP BY DATE(fecharegistro);
END $$
CALL spu_grafico_alquiler();


-- GRAFICO2 
-- Muestra el total de dinero del dia 
DELIMITER $$
CREATE PROCEDURE spu_grafico_monto()
BEGIN
	SELECT CASE
		WHEN DAYOFWEEK(diapago) = 1 THEN 'Domingo'
		WHEN DAYOFWEEK(diapago) = 2 THEN 'Lunes'
		WHEN DAYOFWEEK(diapago) = 3 THEN 'Martes'
		WHEN DAYOFWEEK(diapago) = 4 THEN 'Miercoles'
		WHEN DAYOFWEEK(diapago) = 5 THEN 'Jueves'
		WHEN DAYOFWEEK(diapago) = 6 THEN 'Viernes'
		WHEN DAYOFWEEK(diapago) = 7 THEN 'Sabado'
		ELSE 'Error'
		END AS dias,
		SUM(precio) AS monto
	FROM detallespagos
	INNER JOIN reservaciones ON reservaciones.idreservacion = detallespagos.idreservacion
	INNER JOIN habitaciones ON habitaciones.idhabitacion = reservaciones.idhabitacion
	GROUP BY dias
	-- FIELD para especificar el orden
	ORDER BY FIELD(dias, 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
END $$
CALL spu_grafico_monto();




/*me quedo aqio*/
/*
DELIMITER $$
CREATE PROCEDURE spu_detallespagos_registro
(
	IN _idhabitacion  	INT,
	IN _idcliente		INT,
	IN _idusuario 		INT,
	IN _idempleado		INT,
	IN _fechaentrada	DATE,
	IN _fechasalida		DATE,
	IN _tipocomprobante	CHAR(8),
	IN _formapago 		VARCHAR(20)
)
BEGIN
	DECLARE _id INT;
	CALL spu_reservaciones_registrar( _idusuario, _idhabitacion, _idcliente, _idempleado, _fechaentrada, _fechasalida, _tipocomprobante);
	SELECT LAST_INSERT_ID() INTO _id;
	INSERT INTO detallespagos (idreservacion, formapago) VALUES (_id, _formapago);
END $$
CALL spu_detallespagos_registro(2, 2, 1, 1, CURRENT_TIMESTAMP(), '2023-09-12', 'Factura', 'Debito');
SELECT * FROM detallespagos;

DELIMITER $$
CREATE PROCEDURE spu_detallespagos_listar()
BEGIN 
	SELECT 	CONCAT (clientes.nombres, ' ' , clientes.apellidos) AS cliente, pago.formapago, pago.diapago,habitacion.precio AS montoTotal
	FROM detallespagos pago
	INNER JOIN reservaciones reservacion ON reservacion.idreservacion = pago.idreservacion
	INNER JOIN personas clientes ON clientes.idpersona = reservacion.idcliente
	INNER JOIN habitaciones habitacion ON habitacion.idhabitacion = reservacion.idhabitacion;
END $$
CALL spu_detallespagos_listar();

-- tabla personas
DELIMITER $$
CREATE PROCEDURE spu_personas_listar()
BEGIN
	SELECT idpersona,
	CONCAT(nombres , ' ' , apellidos) AS clientes, dni, telefono, fechanacimiento
	FROM personas
	WHERE estado = '1'
	ORDER BY idpersona DESC;
END $$
CALL spu_personas_listar();

DELIMITER $$
CREATE PROCEDURE spu_personas_registrar
(
	IN _nombres VARCHAR(30),
	IN _apellidos VARCHAR(30),
	IN _dni CHAR(8),
	IN _telefono CHAR(9),
	IN _fechanacimiento DATE
)
BEGIN
	IF _telefono = '' THEN SET _telefono = NULL; END IF;
	IF _dni = '' THEN SET _dni = NULL; END IF;
	INSERT INTO personas (nombres, apellidos, dni, telefono, fechanacimiento) VALUES
		(_nombres, _apellidos, _dni, _telefono, _fechanacimiento);
END $$
CALL spu_personas_registrar('fiorela', 'pampañaupa', '55887744', '', '2002-12-03');
CALL spu_personas_listar();

DELIMITER $$
CREATE PROCEDURE spu_personas_buscar_dni(IN _dni CHAR(8))
BEGIN
	SELECT idpersona, nombres, apellidos, dni, telefono, fechanacimiento
	FROM personas
	WHERE dni = _dni AND estado = '1';
END $$
CALL spu_personas_buscar_dni('55887744');

DELIMITER $$
CREATE PROCEDURE spu_personas_eliminar(IN _idpersona INT)
BEGIN
	UPDATE personas SET estado = '0'
		WHERE idpersona = _idpersona;
END $$
CALL spu_personas_eliminar(1);
CALL spu_personas_listar();


DELIMITER $$
CREATE PROCEDURE spu_personas_getdata(IN _idpersona INT)
BEGIN
	SELECT idpersona, nombres, apellidos, dni, telefono, fechanacimiento
		FROM personas
		WHERE idpersona = _idpersona;
END $$
CALL spu_personas_getdata(1);

DELIMITER $$
CREATE PROCEDURE spu_personas_actualizar
(
	IN _idpersona INT,
	IN _nombres VARCHAR(30),
	IN _apellidos VARCHAR(30),
	IN _dni CHAR(8),
	IN _telefono CHAR(9),
	IN _fechanacimiento DATE
)
BEGIN
	IF _telefono = '' THEN SET _telefono = NULL; END IF;
	
	UPDATE personas SET
		nombres = _nombres,
		apellidos = _apellidos,
		dni = _dni,
		telefono = _telefono,
		fechanacimiento = _fechanacimiento
	WHERE idpersona = _idpersona;
END $$
CALL spu_personas_actualizar(4, 'fiorela', 'pampañaupa', '55887744', '987653421', '2002-12-03');
CALL spu_personas_listar();

-- tabla empleados

-- tabla habitaciones
DELIMITER $$
CREATE PROCEDURE spu_habitaciones_listar()
BEGIN
	SELECT 	habitacion.numhabitacion, categoria.descripcion,
		habitacion.estado
	FROM habitaciones habitacion
	INNER JOIN categoria categoria ON categoria.idcategoria = categoria.idcategoria;
END $$
CALL spu_habitaciones_listar();

DELIMITER $$
CREATE PROCEDURE spu_habitaciones_mostrar()
BEGIN 
	SELECT 	habitacion.idhabitacion, categoria.descripcion
	FROM habitaciones habitacion
	INNER JOIN categoria categoria ON categoria.idcategoria = habitacion.idcategoria;
	
END $$
CALL spu_habitaciones_mostrar();

DELIMITER $$
CREATE PROCEDURE spu_habitaciones_getdata()
BEGIN 
	SELECT 	idhabitacion, 
		CONCAT(descripcion, '  N°', numhabitacion) AS habitacion
	FROM habitaciones
	INNER JOIN categoria ON idcategoria = idcategoria;
END $$
CALL spu_habitaciones_getdata();


-- tabla graficos
DELIMITER $$ 
CREATE PROCEDURE spu_grafico_finsemana()
BEGIN 

	SELECT COUNT(*) AS cantidad, DATE(fecharegistro) AS dias
	FROM  reservaciones
	WHERE fecharegistro BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()
	GROUP BY DATE(fecharegistro);
END $$
CALL spu_grafico_finsemana();

DELIMITER $$
CREATE PROCEDURE spu_grafico_total()
BEGIN
	SELECT CASE
		WHEN DAYOFWEEK(pago.formapago) = 1 THEN 'Domingo'
		WHEN DAYOFWEEK(pago.formapago) = 2 THEN 'Lunes'
		WHEN DAYOFWEEK(pago.formapago) = 3 THEN 'Martes'
		WHEN DAYOFWEEK(pago.formapago) = 4 THEN 'Miercoles'
		WHEN DAYOFWEEK(pago.formapago) = 5 THEN 'Jueves'
		WHEN DAYOFWEEK(pago.formapago) = 6 THEN 'Viernes'
		WHEN DAYOFWEEK(pago.formapago) = 7 THEN 'Sabado'
		ELSE 'Error'
		END AS dias,
		SUM(habitacion.precio) AS monto
	FROM detallespagos pago
	INNER JOIN reservaciones reservacion ON reservacion.idreservacion = pago.idreservacion
	INNER JOIN habitaciones habitacion ON habitacion.idhabitacion = reservacion.idhabitacion
	GROUP BY dias
	-- FIELD para especificar el orden
	ORDER BY FIELD(dias, 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
END $$
CALL spu_grafico_total();
*/