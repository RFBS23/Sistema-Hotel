USE hotel;

DELIMITER $$
CREATE PROCEDURE spu_usuarios_iniciarS (IN _email VARCHAR(50))
BEGIN 

	SELECT usuarios.`idusuario`,
		personas.`apellidos`, personas.`nombres`,		
		usuarios.nombreusuario,	usuarios.email, usuarios.`claveacceso`
	FROM usuarios
	INNER JOIN personas ON personas.`idpersona` = usuarios.`idpersona`
	WHERE email = _email AND estado = '1';  

END$$
CALL spu_usuarios_iniciarS('fabrizio@hola.pe');

DELIMITER $$
CREATE PROCEDURE spu_reservaciones_get()
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
END $$
CALL spu_reservaciones_get();

DELIMITER $$ 
CREATE PROCEDURE spu_reservaciones_eliminar(IN _idreservacion INT)
BEGIN
	UPDATE reservaciones SET estado = '0'
	WHERE idreservacion = _idreservacion;
END $$
CALL spu_reservaciones_eliminar(2);
UPDATE reservaciones SET estado = '1';

DELIMITER $$
CREATE PROCEDURE spu_reservaciones_update
(
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

END $$

CALL spu_reservaciones_update(6,1,2,11,2, '2023-06-01','2023-06-08','B');

DELIMITER $$ 
CREATE PROCEDURE spu_reservaciones_recuperar(IN _idreservacion INT )
BEGIN 
	SELECT  idreservacion,idcliente, idempleado, idusuario,
		idhabitacion, fechaentrada, fechasalida, 
		tipocomprobante
	FROM reservaciones
	WHERE idreservacion = _idreservacion;
END $$

CALL spu_reservaciones_recuperar(1);

DELIMITER $$ 
CREATE PROCEDURE spu_pagos_get()
BEGIN 
	SELECT 	CONCAT (CLI.nombres, ' ', CLI.apellidos) AS cliente,
			PA.fechapago, PA.mediopago, HA.precio AS precioDia, 
			DATEDIFF(RE.fechasalida, RE.fechaentrada) 
			* HA.precio AS montoPagar
	FROM pagos PA
	INNER JOIN reservaciones RE ON RE.idreservacion = PA.idreservacion
	INNER JOIN personas CLI ON CLI.idpersona = RE.idcliente
	INNER JOIN habitaciones HA ON HA.idhabitacion = RE.idhabitacion;
END $$
CALL spu_pagos_get();

DELIMITER $$
CREATE PROCEDURE spu_recuperar_empleados()
BEGIN 
	SELECT 	EM.idempleado,
		PER.nombres
	FROM empleados EM
	INNER JOIN personas PER ON PER.idpersona = EM.idpersona;
END $$

CALL spu_recuperar_empleados();

DELIMITER $$
CREATE PROCEDURE spu_recuperar_clientes()
BEGIN
	SELECT idpersona,
	CONCAT(nombres , ' ' , apellidos) AS clientes
	FROM personas;
END $$
CALL spu_recuperar_clientes();

DELIMITER $$
CREATE PROCEDURE spu_recuperar_usuarios()
BEGIN 
	SELECT idusuario, nombreusuario
	FROM usuarios;
END $$

CALL spu_recuperar_usuarios();

DELIMITER $$
CREATE PROCEDURE spu_recuperar_habitaciones()
BEGIN 
	SELECT 	HA.idhabitacion, 
		CONCAT(TH.tipo, '  N°', HA.numhabitacion) AS habitacion
	FROM habitaciones HA
	INNER JOIN tipohabitaciones TH ON TH.idtipohabitacion = HA.idtipohabitacion;
END $$

CALL spu_recuperar_habitaciones();

DELIMITER $$
CREATE PROCEDURE spu_habitaciones_data()
BEGIN
	SELECT 	HA.numhabitacion,
		TH.tipo, HA.estado
	FROM habitaciones HA
	INNER JOIN tipohabitaciones TH ON TH.idtipohabitacion = HA.idtipohabitacion;
END $$

CALL spu_habitaciones_data();

DELIMITER $$ 
CREATE PROCEDURE spu_haDisponibles_mostrar()
BEGIN
		
	SELECT	COUNT(*) AS habitaciones_disponibles
	FROM habitaciones
	WHERE estado = 'Disponible';
END $$

CALL spu_haDisponibles_mostrar();

DELIMITER $$ 
CREATE PROCEDURE spu_haOcupadas_mostrar()
BEGIN
	SELECT COUNT(*) AS habitaciones_ocupadas
	FROM habitaciones
	WHERE estado = 'Ocupado';
END $$

CALL spu_haOcupadas_mostrar();

DELIMITER $$ 
CREATE PROCEDURE spu_haLimpieza_mostrar()
BEGIN
	SELECT COUNT(*) AS habitaciones_Limpieza
	FROM habitaciones
	WHERE estado = 'Limpieza';
END $$

CALL spu_haLimpieza_mostrar();

DELIMITER $$ 
CREATE PROCEDURE spu_listar_usuarios()
BEGIN
	SELECT 	US.idusuario,
			PE.nombres, PE.apellidos,
			US.email, US.nombreusuario
			
	FROM usuarios US
	INNER JOIN personas PE ON PE.idpersona = US.idpersona;
END $$
CALL spu_listar_usuarios();

DELIMITER $$
CREATE PROCEDURE spu_reservaciones_registrar
(
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
END $$

CALL spu_reservaciones_registrar(1,1,2,1,'2023-06-01','2023-06-10','B');

DELIMITER $$ 
CREATE PROCEDURE spu_pagos_registrar
(
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
END $$
CALL spu_pagos_registrar(1,1,3,1,'2023-06-01','2023-06-10','B','Debito');
SELECT * FROM pagos;

DELIMITER $$ 
CREATE PROCEDURE spu_mostrarNventas_grafico()
BEGIN
	SELECT COUNT(*) AS cantReservaciones, DATE(fecharegistro) AS diasReservacion
	FROM  reservaciones
	WHERE fecharegistro BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()
	GROUP BY DATE(fecharegistro);
END $$
CALL spu_mostrarNventas_grafico();

DELIMITER $$
CREATE PROCEDURE spu_montoTotal_grafico()
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
END $$
CALL spu_montoTotal_grafico();