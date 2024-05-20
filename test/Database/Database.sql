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

DROP TABLE fichas_medicas;
CREATE TABLE fichas_medicas (
    idFichaMedica INT,
    idPaciente INT,
    grupoSanguineo VARCHAR(20),
    observaciones VARCHAR(50),
    constraint pk_fichas_medicas primary key (idTurnos)
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

DROP TABLE servicios;
CREATE TABLE servicios (
    idServicio INT,
    nombre VARCHAR(100),
    tiempo INT,
    horario INT,
    precio FLOAT,
    constraint pk_servicios primary key (idServicios)
);

DROP TABLE obras_sociales;
CREATE TABLE obras_sociales (
    idObraSocial INT,
    nombre VARCHAR(100),
    constraint pk_obras_sociales primary key (idObraSocial)
);

DROP TABLE administrativos;
CREATE TABLE administrativos (
    idAdministrativo INT,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    dni INT,
    telefono VARCHAR(50),
    domicilio VARCHAR(100),
    email VARCHAR(100),
    horarioLaboral VARCHAR(50),
    constraint pk_administrativos primary key (idAdministrativo)
);

DROP TABLE muestras;
CREATE TABLE muestras (
    idMuestra INT,
    idPaciente INT,
    fecha DATETIME,
    descripcion VARCHAR(100),
    idResultado INT,
    rotulo VARCHAR(100),
    constraint pk_muestras primary key (idMuestra)
);

DROP TABLE control_horario;
CREATE TABLE control_horario (
    idProfesional INT,
    fechaHoraIngreso DATETIME,
    fechaHoraEgreso DATETIME,
    constraint fk_control_horario_p foreign key (idProfesional) references profesionales(idProfesional)
);

DROP TABLE agendas;
CREATE TABLE agendas (
    idProfesional INT,
    idConsultorio INT,
    idServicio INT,
    fechaHoraIngreso DATETIME,
    fechaHoraEgreso DATETIME
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

DROP TABLE historias_clinicas;
CREATE TABLE historias_clinicas (
    idPaciente INT,
    fecha DATETIME,
    idEstudio INT,
    idServicio INT,
    observacion VARCHAR(100),
    idResultado INT,
    derivadoDesde VARCHAR(100),
    derivadoHacia VARCHAR(100)
);

DROP TABLE resultados;
CREATE TABLE resultados (
    idEstudio INT,
    idPaciente INT,
    fecha DATETIME,
    muestra VARCHAR(100),
    descripcion VARCHAR(100),
    comprobanteRetiro BOOLEAN
);

DROP TABLE horarios;
CREATE TABLE horarios (
    idProfesional INT,
    fecha DATETIME,
    turno VARCHAR(50)
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