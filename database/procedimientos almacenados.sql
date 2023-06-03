USE hotel

-- tabla usuarios
DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN _email VARCHAR(70))
BEGIN
	SELECT	idusuario,
		apellidos,
		nombres,
		telefono,
		email,
		claveacceso,
		nivelacceso
	FROM usuarios 
	WHERE email = _email AND estado = '1';
END $$
CALL spu_usuarios_login('rodrigo@hotmail.pe');

DELIMITER $$
CREATE PROCEDURE spu_usuarios_listar()
BEGIN
	SELECT idusuario, nombres
	FROM usuarios;
END $$
CALL spu_usuarios_listar();

-- tabla personas
DELIMITER $$
CREATE PROCEDURE spu_personas_listar()
BEGIN
	SELECT idpersona,
	CONCAT(nombres , ' ' , apellidos) AS clientes
	FROM personas;
END $$
CALL spu_personas_listar();


-- tabla reservaciones
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
	ORDER BY reservaciones.idreservacion;
END $$
CALL spu_reservaciones_listar();

/*
DELIMITER $$
drop PROCEDURE spu_reservaciones_mostrar()
BEGIN 
	SELECT 	reservacion.idhabitacion, reservacion.tipocomprobante
	FROM reservaciones reservacion;
END $$
CALL spu_reservaciones_mostrar();
*/

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

-- tabla empleados
DELIMITER $$
CREATE PROCEDURE spu_empleados_listar()
BEGIN
	SELECT 	empleado.idempleado,
		persona.nombres
	FROM empleados empleado
	INNER JOIN personas persona ON persona.idpersona = empleado.idpersona;
END $$
CALL spu_empleados_listar();

DELIMITER $$
CREATE PROCEDURE spu_empleados_listar()
BEGIN 
	SELECT 	empleado.idempleado, persona.nombres
	FROM empleados empleado
	INNER JOIN personas persona ON persona.idpersona = empleado.idpersona;
END $$
CALL spu_empleados_listar();

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

-- tabla pagos
DELIMITER $$
CREATE PROCEDURE spu_detallespagos_registro
(
	IN _idusuario 		INT,
	IN _idhabitacion  	INT,
	IN _idcliente		INT,
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
	SELECT 	CONCAT (clientes.nombres, ' ' , clientes.apellidos) AS cliente,
			pago.formapago,
			habitacion.precio AS montoTotal
	FROM detallespagos pago
	INNER JOIN reservaciones reservacion ON reservacion.idreservacion = pago.idreservacion
	INNER JOIN personas clientes ON clientes.idpersona = reservacion.idcliente
	INNER JOIN habitaciones habitacion ON habitacion.idhabitacion = reservacion.idhabitacion;
END $$
CALL spu_detallespagos_listar();