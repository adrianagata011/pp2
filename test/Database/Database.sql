-- mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'testing01';
-- mysql> ALTER USER 'pp2'@'%' IDENTIFIED BY 'Testing_2024';

use pp2;

DROP TABLE control_horario;
DROP TABLE agendas;
DROP TABLE pagos;
DROP TABLE recetas;
DROP TABLE informes;
DROP TABLE muestras;
DROP TABLE turnos;
DROP TABLE pacientes;
DROP TABLE fichas_medicas;
DROP TABLE historias_clinicas;
DROP TABLE servicios;
DROP TABLE resultados;
DROP TABLE estudios;
DROP TABLE horarios;
DROP TABLE usuarios;
DROP TABLE consultorios;
DROP TABLE profesionales;
DROP TABLE servicios;
DROP TABLE obras_sociales;
DROP TABLE administrativos;
DROP TABLE insumos;


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
    horarioInicio INT,
    horarioFin INT,
    precio FLOAT
);

INSERT INTO servicios (nombre, tiempo, horarioInicio, horarioFin, precio) VALUES
('Emergencias', 15, 9, 18, 150.00),
('Medicina Interna', 15, 9, 18, 150.00),
('Cirugía General', 15, 9, 18, 150.00),
('Pediatría', 15, 9, 18, 150.00),
('Ginecología y Obstetricia', 15, 9, 18, 150.00),
('Cardiología', 15, 9, 18, 150.00),
('Neurología', 15, 9, 18, 150.00),
('Oncología', 15, 9, 18, 150.00),
('Dermatología', 15, 9, 18, 150.00),
('Oftalmología', 15, 9, 18, 150.00),
('Otorrinolaringología', 15, 9, 18, 150.00),
('Ortopedia y Traumatología', 15, 9, 18, 150.00),
('Psiquiatría', 15, 9, 18, 150.00),
('Urología', 15, 9, 18, 150.00),
('Gastroenterología', 15, 9, 18, 150.00),
('Neumología', 15, 9, 18, 150.00),
('Endocrinología', 15, 9, 18, 150.00),
('Nefrología', 15, 9, 18, 150.00),
('Hematología', 15, 9, 18, 150.00),
('Reumatología', 15, 9, 18, 150.00),
('Radiología', 15, 9, 18, 150.00),
('Anestesiología', 15, 9, 18, 150.00),
('Unidad de Cuidados Intensivos (UCI)', 15, 9, 18, 150.00),
('Rehabilitación y Fisioterapia', 15, 9, 18, 150.00),
('Laboratorio Clínico', 15, 9, 18, 150.00),
('Farmacia Hospitalaria', 15, 9, 18, 150.00),
('Nutrición y Dietética', 15, 9, 18, 150.00),
('Terapia Ocupacional', 15, 9, 18, 150.00),
('Terapia del Lenguaje', 15, 9, 18, 150.00),
('Medicina Física y Rehabilitación', 15, 9, 18, 150.00),
('Cirugía Plástica y Reconstructiva', 15, 9, 18, 150.00),
('Medicina del Dolor y Cuidados Paliativos', 15, 9, 18, 150.00),
('Infectología', 15, 9, 18, 150.00),
('Medicina Nuclear', 15, 9, 18, 150.00),
('Unidad de Cuidados Coronarios', 15, 9, 18, 150.00),
('Unidad de Quemados', 15, 9, 18, 150.00),
('Genética Clínica', 15, 9, 18, 150.00),
('Neurocirugía', 15, 9, 18, 150.00),
('Cirugía Vascular', 15, 9, 18, 150.00),
('Neonatología', 15, 9, 18, 150.00);

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
    horarioIngreso INT,
    horarioEgreso INT,
    inicioActividad DATE,
    finActividad DATETIME DEFAULT NULL,
    constraint fk_profesionales_s foreign key (idServicio) references servicios(idServicio)
);

INSERT INTO profesionales (idServicio, nombre, apellido, dni, telefono, domicilio, email, numeroMatricula, horarioIngreso, horarioEgreso, inicioActividad) VALUES
(1, 'Juan', 'Perez', '12345678A', '555-1234', 'Calle Falsa 123', 'juan.perez@example.com', 'MAT-001', 9, 18, '2012-01-01'),
(2, 'Maria', 'Gomez', '87654321B', '555-5678', 'Avenida Siempre Viva 742', 'maria.gomez@example.com', 'MAT-002', 9, 18, '2012-01-02'),
(3, 'Luis', 'Martinez', '11223344C', '555-9101', 'Calle de la Luna 456', 'luis.martinez@example.com', 'MAT-003', 9, 18, '2012-01-03'),
(4, 'Ana', 'Lopez', '55667788D', '555-1122', 'Calle del Sol 789', 'ana.lopez@example.com', 'MAT-004', 9, 18, '2012-01-04'),
(5, 'Carlos', 'Fernandez', '33445566E', '555-3344', 'Calle de las Estrellas 101', 'carlos.fernandez@example.com', 'MAT-005', 9, 18, '2012-01-05'),
(6, 'Sofia', 'Rodriguez', '99887766F', '555-5566', 'Calle de los Pinos 102', 'sofia.rodriguez@example.com', 'MAT-006', 9, 18, '2012-01-06'),
(7, 'Miguel', 'Garcia', '22334455G', '555-7788', 'Calle de los Olmos 103', 'miguel.garcia@example.com', 'MAT-007', 9, 18, '2012-01-07'),
(8, 'Lucia', 'Diaz', '44332211H', '555-9900', 'Calle de los Robles 104', 'lucia.diaz@example.com', 'MAT-008', 9, 18, '2012-01-08'),
(9, 'Fernando', 'Sanchez', '66554433I', '555-2211', 'Calle de los Cerezos 105', 'fernando.sanchez@example.com', 'MAT-009', 9, 18, '2012-01-09'),
(10, 'Elena', 'Morales', '77889900J', '555-3322', 'Calle de los Manzanos 106', 'elena.morales@example.com', 'MAT-010', 9, 18, '2012-01-10'),
(11, 'Raul', 'Romero', '88990011K', '555-4433', 'Calle de los Almendros 107', 'raul.romero@example.com', 'MAT-011', 9, 18, '2012-01-11'),
(12, 'Patricia', 'Hernandez', '99001122L', '555-5544', 'Calle de los Naranjos 108', 'patricia.hernandez@example.com', 'MAT-012', 9, 18, '2012-01-12'),
(13, 'Javier', 'Ruiz', '10101010M', '555-6655', 'Calle de los Sauces 109', 'javier.ruiz@example.com', 'MAT-013', 9, 18, '2012-01-13'),
(14, 'Claudia', 'Ramos', '20202020N', '555-7766', 'Calle de los Cedros 110', 'claudia.ramos@example.com', 'MAT-014', 9, 18, '2012-01-14'),
(15, 'Victor', 'Gonzalez', '30303030O', '555-8877', 'Calle de los Álamos 111', 'victor.gonzalez@example.com', 'MAT-015', 9, 18, '2012-01-15'),
(16, 'Adriana', 'Torres', '40404040P', '555-9988', 'Calle de los Avellanos 112', 'adriana.torres@example.com', 'MAT-016', 9, 18, '2012-01-16'),
(17, 'Oscar', 'Vargas', '50505050Q', '555-1100', 'Calle de los Arces 113', 'oscar.vargas@example.com', 'MAT-017', 9, 18, '2012-01-17'),
(18, 'Laura', 'Reyes', '60606060R', '555-2211', 'Calle de los Fresnos 114', 'laura.reyes@example.com', 'MAT-018', 9, 18, '2012-01-18'),
(19, 'Diego', 'Ortega', '70707070S', '555-3322', 'Calle de los Olmos 115', 'diego.ortega@example.com', 'MAT-019', 9, 18, '2012-01-19'),
(20, 'Carolina', 'Mendoza', '80808080T', '555-4433', 'Calle de los Castaños 116', 'carolina.mendoza@example.com', 'MAT-020', 9, 18, '2012-01-20'),
(21, 'Ivan', 'Silva', '90909090U', '555-5544', 'Calle de los Tejos 117', 'ivan.silva@example.com', 'MAT-021', 9, 18, '2012-01-21'),
(22, 'Gabriela', 'Rivas', '01010101V', '555-6655', 'Calle de los Cipreses 118', 'gabriela.rivas@example.com', 'MAT-022', 9, 18, '2012-01-22'),
(23, 'Hector', 'Gutierrez', '11111111W', '555-7766', 'Calle de los Cedros 119', 'hector.gutierrez@example.com', 'MAT-023', 9, 18, '2012-01-23'),
(24, 'Isabel', 'Molina', '22222222X', '555-8877', 'Calle de los Álamos 120', 'isabel.molina@example.com', 'MAT-024', 9, 18, '2012-01-24'),
(25, 'Ricardo', 'Castro', '33333333Y', '555-9988', 'Calle de los Avellanos 121', 'ricardo.castro@example.com', 'MAT-025', 9, 18, '2012-01-25'),
(26, 'Veronica', 'Nunez', '44444444Z', '555-1100', 'Calle de los Arces 122', 'veronica.nunez@example.com', 'MAT-026', 9, 18, '2012-01-26'),
(27, 'Eduardo', 'Cabrera', '55555555A', '555-2211', 'Calle de los Fresnos 123', 'eduardo.cabrera@example.com', 'MAT-027', 9, 18, '2012-01-27'),
(28, 'Monica', 'Vega', '66666666B', '555-3322', 'Calle de los Olmos 124', 'monica.vega@example.com', 'MAT-028', 9, 18, '2012-01-28'),
(29, 'Gonzalo', 'Acosta', '77777777C', '555-4433', 'Calle de los Cerezos 125', 'gonzalo.acosta@example.com', 'MAT-029', 9, 18, '2012-01-29'),
(30, 'Susana', 'Pena', '88888888D', '555-5544', 'Calle de los Manzanos 126', 'susana.pena@example.com', 'MAT-030', 9, 18, '2012-01-30'),
(31, 'Rafael', 'Luna', '99999999E', '555-6655', 'Calle de los Almendros 127', 'rafael.luna@example.com', 'MAT-031', 9, 18, '2012-01-31'),
(32, 'Nuria', 'Salinas', '00000000F', '555-7766', 'Calle de los Naranjos 128', 'nuria.salinas@example.com', 'MAT-032', 9, 18, '2012-01-01'),
(33, 'Pablo', 'Blanco', '12121212G', '555-8877', 'Calle de los Sauces 129', 'pablo.blanco@example.com', 'MAT-033', 9, 18, '2012-01-02'),
(34, 'Beatriz', 'Flores', '34343434H', '555-9988', 'Calle de los Cedros 130', 'beatriz.flores@example.com', 'MAT-034', 9, 18, '2012-01-03'),
(35, 'Esteban', 'Carrillo', '56565656I', '555-1100', 'Calle de los Álamos 131', 'esteban.carrillo@example.com', 'MAT-035', 9, 18, '2012-01-04'),
(36, 'Andrea', 'Roldan', '78787878J', '555-2211', 'Calle de los Avellanos 132', 'andrea.roldan@example.com', 'MAT-036', 9, 18, '2012-01-05'),
(37, 'Sergio', 'Fuentes', '90909090K', '555-3322', 'Calle de los Arces 133', 'sergio.fuentes@example.com', 'MAT-037', 9, 18, '2012-01-06'),
(38, 'Daniela', 'Lozano', '12312312L', '555-4433', 'Calle de los Fresnos 134', 'daniela.lozano@example.com', 'MAT-038', 9, 18, '2012-01-07'),
(39, 'Alejandro', 'Montes', '45645645M', '555-5544', 'Calle de los Olmos 135', 'alejandro.montes@example.com', 'MAT-039', 9, 18, '2012-01-08'),
(40, 'Carmen', 'Vidal', '78978978N', '555-6655', 'Calle de los Cerezos 136', 'carmen.vidal@example.com', 'MAT-040', 9, 18, '2012-01-09');


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