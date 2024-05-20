-- mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'testing01';
-- mysql> ALTER USER 'pp2'@'%' IDENTIFIED BY 'Testing_2024';

use pp2;

DROP TABLE control_horario;
DROP TABLE agendas;
DROP TABLE pagos;
DROP TABLE recetas;
DROP TABLE historias_clinicas;
DROP TABLE resultados;
DROP TABLE horarios;
DROP TABLE usuarios;
DROP TABLE turnos;
DROP TABLE pacientes;
DROP TABLE consultorios;
DROP TABLE profesionales;
DROP TABLE fichas_medicas;
DROP TABLE informes;
DROP TABLE servicios;
DROP TABLE obras_sociales;
DROP TABLE administrativos;
DROP TABLE muestras;
DROP TABLE insumos;
DROP TABLE estudios;

CREATE TABLE usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol INT NOT NULL
);

INSERT INTO usuarios (usuario,contrasena,rol) values ('paciente','password01',1);
INSERT INTO usuarios (usuario,contrasena,rol) values ('administrativo','password01',2);

CREATE TABLE servicios (
    idServicio INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    tiempo INT,
    horario INT,
    precio FLOAT
);

CREATE TABLE profesionales (
    idProfesional INT AUTO_INCREMENT PRIMARY KEY,
    idServicio INT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(50) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    domicilio VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    numeroMatricula VARCHAR(50) NOT NULL,
    horarioIngreso DATETIME,
    horarioEgreso DATETIME,
    inicioActividad DATETIME,
    finActividad DATETIME
);

CREATE TABLE insumos (
    idInsumo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE,
    cantidadMinima INT,
    cantidadExistente INT,
    descripcion VARCHAR(50),
    observaciones VARCHAR(50)
);

CREATE TABLE consultorios (
    idConsultorio INT AUTO_INCREMENT PRIMARY KEY,
    idProfesional INT,
    idInsumo INT,
    fechaHoraIngreso DATETIME,
    fechaHoraEgreso DATETIME,
    idServicio INT,
    constraint fk_consultorios_p foreign key (idProfesional) references profesionales(idProfesional),
    constraint fk_consultorios_i foreign key (idInsumo) references insumos(idInsumo)
);

CREATE TABLE obras_sociales (
    idObraSocial INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100)
);

CREATE TABLE administrativos (
    idAdministrativo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    dni INT,
    telefono VARCHAR(50),
    domicilio VARCHAR(100),
    email VARCHAR(100),
    horarioLaboral VARCHAR(50)
);

CREATE TABLE estudios (
    idEstudio INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE,
    fechaHora DATETIME,
    precio FLOAT,
    prioridad VARCHAR(50)
);

CREATE TABLE resultados (
    idResultado INT AUTO_INCREMENT PRIMARY KEY,
    idEstudio INT,
    fecha DATETIME,
    muestra VARCHAR(100),
    descripcion VARCHAR(100),
    comprobanteRetiro BOOLEAN,
    constraint fk_resultados_e foreign key (idEstudio) references estudios(idEstudio)
);

CREATE TABLE historias_clinicas (
    idHistoriaClinica INT AUTO_INCREMENT PRIMARY KEY,
    idEstudio INT,
    idServicio INT,
    idResultado INT,
    fecha DATETIME,
    observacion VARCHAR(100),
    derivadoDesde VARCHAR(100),
    derivadoHacia VARCHAR(100),
    constraint fk_historias_clinicas_e foreign key (idEstudio) references estudios(idEstudio),
    constraint fk_historias_clinicas_s foreign key (idServicio) references servicios(idServicio),
    constraint fk_historias_clinicas_r foreign key (idResultado ) references resultados(idResultado)
);

CREATE TABLE fichas_medicas (
    idFichaMedica INT AUTO_INCREMENT PRIMARY KEY,
    idHistoriaClinica INT,
    grupoSanguineo VARCHAR(20),
    observaciones VARCHAR(50),
    constraint fk_fichas_medicas_h foreign key (idHistoriaClinica) references historias_clinicas(idHistoriaClinica)
);

CREATE TABLE pacientes (
    idPaciente INT AUTO_INCREMENT PRIMARY KEY,
    idFichaMedica INT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(50) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    domicilio VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    obraSocial VARCHAR(50),
    prioridad INT,
    constraint fk_pacientes_f foreign key (idFichaMedica) references fichas_medicas(idFichaMedica)
);

CREATE TABLE informes (
    idInformes INT AUTO_INCREMENT PRIMARY KEY,
    idProfesional INT,
    idPaciente INT,
    idEstudio INT,
    idResultado INT,
    fecha DATETIME,
    observacion VARCHAR(100),
    constraint fk_informes_p foreign key (idProfesional) references profesionales(idProfesional),
    constraint fk_informes_pa foreign key (idPaciente) references pacientes(idPaciente),
    constraint fk_informes_e foreign key (idEstudio) references estudios(idEstudio),
    constraint fk_informes_r foreign key (idResultado) references resultados(idResultado)
);

CREATE TABLE muestras (
    idMuestra INT AUTO_INCREMENT PRIMARY KEY,
    idPaciente INT,
    fecha DATETIME,
    descripcion VARCHAR(100),
    idResultado INT,
    rotulo VARCHAR(100),
    constraint fk_muestras_p foreign key (idPaciente) references pacientes(idPaciente)
);

CREATE TABLE turnos (
    idTurno INT AUTO_INCREMENT PRIMARY KEY,
    idProfesional INT,
    idConsultorio INT,
    idServicio INT,
    idPaciente INT,
    fechaHora DATETIME,
    sobreturno BOOLEAN,
    acreditado BOOLEAN,
    constraint fk_turnos_p foreign key (idProfesional) references profesionales(idProfesional),
    constraint fk_turnos_c foreign key (idConsultorio) references consultorios(idConsultorio),
    constraint fk_turnos_s foreign key (idServicio) references servicios(idServicio),
    constraint fk_turnos_pa foreign key (idPaciente) references pacientes(idPaciente)
);

CREATE TABLE control_horario (
    idProfesional INT,
    fechaHoraIngreso DATETIME,
    fechaHoraEgreso DATETIME,
    constraint fk_control_horario_p foreign key (idProfesional) references profesionales(idProfesional)
);

CREATE TABLE agendas (
    idProfesional INT,
    idConsultorio INT,
    idServicio INT,
    fechaHoraIngreso DATETIME,
    fechaHoraEgreso DATETIME,
    constraint fk_agenda_p foreign key (idProfesional) references profesionales(idProfesional),
    constraint fk_agenda_c foreign key (idConsultorio) references consultorios(idConsultorio),
    constraint fk_agenda_s foreign key (idServicio) references servicios(idServicio)
);

CREATE TABLE pagos (
    idPaciente INT,
    idServicio INT,
    idObraSocial INT,
    fecha DATETIME,
    importe FLOAT,
    factura VARCHAR(50),
    constraint fk_pagos_s foreign key (idServicio) references servicios(idServicio),
    constraint fk_pagos_p foreign key (idPaciente) references pacientes(idPaciente),
    constraint fk_pagos_o foreign key (idObraSocial) references obras_sociales(idObraSocial)
);

CREATE TABLE recetas (
    idPaciente INT,
    idProfesional INT,
    fecha DATETIME,
    descripcion VARCHAR(50),
    constraint fk_recetas_p foreign key (idPaciente) references pacientes(idPaciente),
    constraint fk_recetas_pr foreign key (idProfesional) references profesionales(idProfesional)
);

CREATE TABLE horarios (
    idProfesional INT,
    fecha DATETIME,
    turno VARCHAR(50),
    constraint fk_horarios_p foreign key (idProfesional) references profesionales(idProfesional)
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