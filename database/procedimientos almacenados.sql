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
		claveacceso
	FROM usuarios 
	WHERE email = _email AND estado = '1';
END $$
CALL spu_usuarios_login('fabrizio@hola.pe');

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


