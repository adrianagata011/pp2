-- mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'testing01';
-- mysql> ALTER USER 'pp2'@'%' IDENTIFIED BY 'Testing_2024';

use PP2;

DROP TABLE usuarios;
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol INT NOT NULL
);

INSERT INTO usuarios (usuario,contrasena,rol) values ('paciente','password01',1);
INSERT INTO usuarios (usuario,contrasena,rol) values ('administrativo','password01',2);

DROP TABLE pacientes;
CREATE TABLE pacientes (
    id_paciente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(50) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    domicilio VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    id_procedencia INT,
    obra_social VARCHAR(50),
    id_historia_clinica INT,
    id_ficha_medica INT,
    prioridad INT
);

DROP TABLE profesionales;
CREATE TABLE profesionales (
    id_profesional INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(50) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    domicilio VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    nro_matricula VARCHAR(50) NOT NULL,
    id_servicio INT,
    horario_ingreso DATETIME,
    horario_egreso DATETIME,
    inicio_actividad DATETIME,
    fin_actividad DATETIME
);

DROP TABLE control_horario;
CREATE TABLE control_horario (
    id_profesional INT,
    fecha_hora_ingreso DATETIME,
    fecha_hora_egreso DATETIME
);

DROP TABLE consultorios;
CREATE TABLE consultorios (
    id_consultorio INT,
    id_profesional INT,
    id_insumo INT,
    fecha_hora_ingreso DATETIME,
    fecha_hora_egreso DATETIME,
    id_servicio INT
);

DROP TABLE turnos;
CREATE TABLE turnos (
    id_turno INT,
    fecha_hora DATETIME,
    id_profesional INT,
    id_consultorio INT,
    id_servicio INT,
    sobreturno BOOLEAN,
    id_paciente INT,
    acreditado BOOLEAN
);

DROP TABLE agendas;
CREATE TABLE agendas (
    id_profesional INT,
    fecha_hora_ingreso DATETIME,
    fecha_hora_egreso DATETIME,
    id_consultorio INT,
    id_servicio INT
);

drop procedure if exists VerificarUsuario;

delimiter //
CREATE PROCEDURE `VerificarUsuario`(
    IN t_usuario varchar(50),
    IN t_contrasena varchar(255),
    OUT existe boolean,
    OUT rol_id int
)
begin
    declare t_count INT;
    declare t_rol INT;
    select count(*) into t_count from usuarios where usuario = t_usuario and contrasena = t_contrasena;
    if t_count > 0 then
        set existe = TRUE;
        select CONVERT(rol, SIGNED INTEGER) into t_rol from usuarios where usuario = t_usuario;
        set rol_id = t_rol;
	else
        set existe = FALSE;
        set rol_id = NULL;
    end if;
end
//

-- Para probar una salida verdadera y una falsa
-- CALL VerificarUsuario('pirulo', 'gomezd01', @existe, @rol);
-- SELECT @existe,@rol;
-- CALL VerificarUsuario('paciente', 'password01', @existe, @rol);
-- SELECT @existe, @rol;