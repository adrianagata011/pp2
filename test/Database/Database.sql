-- mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'testing01';
-- mysql> ALTER USER 'pp2'@'%' IDENTIFIED BY 'Testing_2024';

use PP2;

DROP TABLE usuarios;
CREATE TABLE usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol INT NOT NULL,
    constraint pk_usuarios primary key (idUsuario)
);

INSERT INTO usuarios (usuario,contrasena,rol) values ('paciente','password01',1);
INSERT INTO usuarios (usuario,contrasena,rol) values ('administrativo','password01',2);

DROP TABLE pacientes;
CREATE TABLE pacientes (
    idPaciente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(50) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    domicilio VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    idServicio INT,
    obraSocial VARCHAR(50),
    idHistoriaClinica INT,
    idFichaMedica INT,
    prioridad INT,
    constraint pk_pacientes primary key (idPaciente)
);

DROP TABLE profesionales;
CREATE TABLE profesionales (
    idProfesional INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(50) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    domicilio VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    numeroMatricula VARCHAR(50) NOT NULL,
    idServicio INT,
    horarioIngreso DATETIME,
    horarioEgreso DATETIME,
    inicioActividad DATETIME,
    finActividad DATETIME,
    constraint pk_profesionales primary key (idProfesional)
);

DROP TABLE control_horario;
CREATE TABLE control_horario (
    idProfesional INT,
    fechaHoraIngreso DATETIME,
    fechaHoraEgreso DATETIME
);

DROP TABLE consultorios;
CREATE TABLE consultorios (
    idConsultorio INT,
    idProfesional INT,
    idInsumo INT,
    fechaHoraIngreso DATETIME,
    fechaHoraEgreso DATETIME,
    idServicio INT,
    constraint pk_consultorios primary key (idConsultorio)
);

DROP TABLE turnos;
CREATE TABLE turnos (
    idTurno INT,
    fechaHora DATETIME,
    idProfesional INT,
    idConsultorio INT,
    idServicio INT,
    sobreturno BOOLEAN,
    idPaciente INT,
    acreditado BOOLEAN,
    constraint pk_turnos primary key (idTurnos)
);

DROP TABLE agendas;
CREATE TABLE agendas (
    idProfesional INT,
    fechaHoraIngreso DATETIME,
    fechaHoraEgreso DATETIME,
    idConsultorio INT,
    idServicio INT
);

DROP TABLE pagos;
CREATE TABLE pagos (
    fecha DATETIME,
    idPaciente INT,
    importe FLOAT,
    idObraSocial VARCHAR(50),
    factura VARCHAR(50),
    idServicio INT
);

DROP TABLE fichas_medicas;
CREATE TABLE fichas_medicas (
    idFichaMedica INT,
    idPaciente INT,
    grupoSanguineo VARCHAR(20),
    observaciones VARCHAR(50),
    constraint pk_fichas_medicas primary key (idTurnos)
);

DROP TABLE insumos;
CREATE TABLE insumos (
    cantidadMinima INT,
    cantidadExistente INT,
    descripcion VARCHAR(50),
    observaciones VARCHAR(50)
);

DROP TABLE recetas;
CREATE TABLE recetas (
    fecha DATETIME,
    idPaciente INT,
    idProfesional INT,
    descripcion VARCHAR(50)
);

DROP TABLE informes;
CREATE TABLE informes (
    idInformes INT,
    idProfesional INT,
    idPaciente INT,
    idEstudio INT,
    idResultado INT,
    fecha DATETIME,
    observacion VARCHAR(100),
    constraint pk_informes primary key (idInformes)
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