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

INSERT INTO insumos (nombre, cantidadMinima, cantidadExistente, descripcion, observaciones) VALUES
('Guantes', 275, 385, 'Guantes de latex', 'Caja grande'),
('Mascarillas', 1200, 1680, 'Mascarillas quirúrgicas', 'Paquete de 50'),
('Jeringas', 450, 630, 'Jeringas desechables', '10 ml'),
('Agujas Hipodérmicas', 1350, 1890, 'Agujas para inyección', 'Gauge 23'),
('Algodón', 800, 1120, 'Algodón para curaciones', 'Paquete de 500g'),
('Alcohol', 250, 350, 'Alcohol isopropílico', 'Botella de 1L'),
('Tiritas', 1100, 1540, 'Tiritas adhesivas', 'Paquete de 100'),
('Esparadrapo', 600, 840, 'Cinta adhesiva médica', 'Rollo de 5m'),
('Batas Médicas', 300, 420, 'Batas desechables', 'Talla única'),
('Gasas', 900, 1260, 'Gasas estériles', 'Paquete de 100'),
('Termómetros', 700, 980, 'Termómetros digitales', 'Para uso oral'),
('Oxígeno', 1300, 1820, 'Tanques de oxígeno', 'Capacidad 10L'),
('Desinfectante', 500, 700, 'Desinfectante de superficies', 'Botella de 500ml'),
('Tensiómetros', 400, 560, 'Tensiómetros manuales', 'Con estetoscopio'),
('Estetoscopios', 600, 840, 'Estetoscopios', 'Doble campana'),
('Vendas', 750, 1050, 'Vendas elásticas', '5m x 10cm'),
('Bisturíes', 850, 1190, 'Bisturíes desechables', 'Con hoja Nº 11'),
('Suturas', 950, 1330, 'Suturas absorbibles', '0 Vicryl'),
('Tubos de Ensayo', 1150, 1610, 'Tubos de ensayo', 'De vidrio 10ml'),
('Hisopos', 300, 420, 'Hisopos estériles', 'Paquete de 200'),
('Lancetas', 400, 560, 'Lancetas para glucosa', 'Paquete de 100'),
('Reactivos', 700, 980, 'Reactivos para análisis', 'Diversos tipos'),
('Micro pipetas', 500, 700, 'Micro pipetas', '10-100 µl'),
('Placas de Petri', 350, 490, 'Placas de Petri', '100x15mm'),
('Frascos Recolectores', 250, 350, 'Frascos recolectores', 'Para muestras de orina'),
('Solución Salina', 600, 840, 'Solución salina', 'Bolsa de 1L'),
('Tiras Reactivas', 800, 1120, 'Tiras reactivas', 'Para glucosa en sangre'),
('Guantes Esteriles', 950, 1330, 'Guantes esterilizados', 'Talla mediana'),
('Marcadores de Laboratorio', 1000, 1400, 'Marcadores permanentes', 'Para tubos de ensayo'),
('Cubrecalzado', 300, 420, 'Cubrecalzado desechables', 'Paquete de 100'),
('Bolsas de Bioseguridad', 750, 1050, 'Bolsas de bioseguridad', 'Rojas de 10L'),
('Contenedores de Residuos', 800, 1120, 'Contenedores plásticos', 'Para objetos punzantes'),
('Tijeras Médicas', 350, 490, 'Tijeras de acero inoxidable', '15cm'),
('Toallas de Papel', 600, 840, 'Toallas de papel', 'Paquete de 100'),
('Jabón Antiséptico', 700, 980, 'Jabón antiséptico', 'Botella de 500ml'),
('Lamparillas de Alcohol', 450, 630, 'Lamparillas para esterilización', 'De vidrio'),
('Gasas Vaselinadas', 500, 700, 'Gasas impregnadas en vaselina', '10x10cm'),
('Tiras de pH', 300, 420, 'Tiras reactivas de pH', 'Paquete de 100'),
('Papel de Filtración', 200, 280, 'Papel de filtro', 'Diámetro 90mm');

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

INSERT INTO consultorios (idProfesional, idInsumo, fechaHoraIngreso, fechaHoraEgreso, idServicio) VALUES
(1, 1, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 1),
(2, 2, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 2),
(3, 3, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 3),
(4, 4, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 4),
(5, 5, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 5),
(6, 6, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 6),
(7, 7, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 7),
(8, 8, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 8),
(9, 9, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 9),
(10, 10, '2024-05-20 09:00:00', '2024-05-20 18:00:00', 10);


CREATE TABLE obras_sociales (
    idObraSocial INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100)
);

INSERT INTO obras_sociales (nombre) VALUES
('OSDE'),
('Swiss Medical'),
('Galeno'),
('Medicus'),
('IAPOS'),
('OSPIM'),
('OSSEG'),
('Sancor Salud'),
('OSPERYH'),
('Federada Salud');

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

INSERT INTO administrativos (nombre, apellido, dni, telefono, domicilio, email, horarioLaboral) VALUES
('María', 'García', 12345678, '555-1234', 'Calle 123', 'maria@example.com', '9:00 - 18:00'),
('Juan', 'López', 23456789, '555-2345', 'Avenida 456', 'juan@example.com', '9:00 - 18:00'),
('Ana', 'Martínez', 34567890, '555-3456', 'Ruta 789', 'ana@example.com', '9:00 - 18:00'),
('Pedro', 'Gómez', 45678901, '555-4567', 'Boulevard 012', 'pedro@example.com', '9:00 - 18:00'),
('Lucía', 'Rodríguez', 56789012, '555-5678', 'Plaza Principal', 'lucia@example.com', '9:00 - 18:00'),
('Carlos', 'Fernández', 67890123, '555-6789', 'Callejón 345', 'carlos@example.com', '9:00 - 18:00');

CREATE TABLE estudios (
    idEstudio INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) UNIQUE,
    fechaHora DATETIME,
    precio FLOAT,
    prioridad VARCHAR(50)
);

INSERT INTO estudios (nombre, fechaHora, precio, prioridad) VALUES
('Ecografía abdominal', '2024-05-20 09:00:00', 150.00, 'Alta'),
('Análisis de sangre', '2024-05-21 10:00:00', 80.00, 'Media'),
('Radiografía de tórax', '2024-05-22 11:00:00', 120.00, 'Alta'),
('Electrocardiograma', '2024-05-23 12:00:00', 100.00, 'Baja'),
('Resonancia magnética', '2024-05-24 13:00:00', 300.00, 'Alta'),
('Tomografía computarizada', '2024-05-25 14:00:00', 250.00, 'Media'),
('Colonoscopía', '2024-05-26 15:00:00', 200.00, 'Alta'),
('Mamografía', '2024-05-27 16:00:00', 180.00, 'Media'),
('Endoscopía', '2024-05-28 17:00:00', 220.00, 'Baja'),
('Prueba de esfuerzo', '2024-05-29 18:00:00', 130.00, 'Media');

CREATE TABLE resultados (
    idResultado INT AUTO_INCREMENT PRIMARY KEY,
    idEstudio INT,
    fecha DATETIME,
    muestra VARCHAR(100),
    descripcion VARCHAR(100),
    comprobanteRetiro BOOLEAN,
    constraint fk_resultados_e foreign key (idEstudio) references estudios(idEstudio)
);

INSERT INTO resultados (idEstudio, fecha, muestra, descripcion, comprobanteRetiro) VALUES
(1, '2024-05-20 09:30:00', 'Sangre', 'Normal', TRUE),
(2, '2024-05-21 10:30:00', 'Sangre', 'Hemoglobina dentro de valores normales', TRUE),
(3, '2024-05-22 11:30:00', 'Radiografía', 'Sin alteraciones significativas', FALSE),
(4, '2024-05-23 12:30:00', 'Electrodos', 'Se observa ritmo cardíaco regular', TRUE),
(5, '2024-05-24 13:30:00', 'Imágenes', 'Presencia de lesión en el tejido blando', TRUE),
(6, '2024-05-25 14:30:00', 'Imágenes', 'Presencia de anomalías en el hígado', TRUE),
(7, '2024-05-26 15:30:00', 'Colonoscopia', 'Presencia de pólipos benignos', FALSE),
(8, '2024-05-27 16:30:00', 'Mamografía', 'No se detectan masas ni calcificaciones', TRUE),
(9, '2024-05-28 17:30:00', 'Endoscopía', 'Úlcera gástrica leve', FALSE),
(10, '2024-05-29 18:30:00', 'Electrocardiograma', 'Ejercicio bien tolerado, sin arritmias', TRUE);


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

INSERT INTO historias_clinicas (idEstudio, idServicio, idResultado, fecha, observacion, derivadoDesde, derivadoHacia) VALUES
(1, 1, 1, '2024-05-20 09:30:00', 'Paciente sin síntomas aparentes', 'Consulta médica', 'Eco Doppler'),
(2, 2, 2, '2024-05-21 10:30:00', 'Paciente con fatiga crónica', 'Consulta médica', 'Análisis de glucemia postprandial'),
(3, 3, 3, '2024-05-22 11:30:00', 'Paciente con tos persistente', 'Consulta médica', 'Tomografía de abdomen'),
(4, 4, 4, '2024-05-23 12:30:00', 'Paciente con antecedentes cardíacos', 'Consulta médica', 'Holter de 24hs'),
(5, 5, 5, '2024-05-24 13:30:00', 'Paciente con dolor lumbar crónico', 'Consulta médica', 'Revisión por traumatología'),
(6, 6, 6, '2024-05-25 14:30:00', 'Paciente con síntomas gastrointestinales', 'Consulta médica', 'Colangiorresonancia'),
(7, 7, 7, '2024-05-26 15:30:00', 'Paciente asintomático', 'Control de rutina', 'Seguimiento médico'),
(8, 8, 8, '2024-05-27 16:30:00', 'Paciente con antecedentes familiares de cáncer de mama', 'Consulta médica', 'Seguimiento oncológico'),
(9, 9, 9, '2024-05-28 17:30:00', 'Paciente con dispepsia', 'Consulta médica', 'Esofagoscopia'),
(10, 10, 10, '2024-05-29 18:30:00', 'Paciente con antecedentes de enfermedad cardiovascular', 'Consulta médica', 'Seguimiento cardiológico');


CREATE TABLE fichas_medicas (
    idFichaMedica INT AUTO_INCREMENT PRIMARY KEY,
    idHistoriaClinica INT,
    grupoSanguineo VARCHAR(20),
    observaciones VARCHAR(50),
    constraint fk_fichas_medicas_h foreign key (idHistoriaClinica) references historias_clinicas(idHistoriaClinica)
);

INSERT INTO fichas_medicas (idHistoriaClinica, grupoSanguineo, observaciones) VALUES
(1, 'A+', 'Sin observaciones'),
(2, 'O-', 'Sin observaciones'),
(3, 'B+', 'Hipertensión arterial'),
(4, 'AB+', 'Sin observaciones'),
(5, 'A-', 'Sin observaciones'),
(6, 'O+', 'Sin observaciones'),
(7, 'B-', 'Sin observaciones'),
(8, 'AB-', 'Antecedentes familiares de cáncer de mama'),
(9, 'O+', 'Sin observaciones'),
(10, 'A+', 'Sin observaciones');

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

INSERT INTO pacientes (idFichaMedica, nombre, apellido, dni, telefono, domicilio, email, obraSocial, prioridad) VALUES
(1, 'Carlos', 'González', '12345678', '555-1234', 'Calle 123', 'carlos@example.com', 'OSDE', 1),
(2, 'María', 'López', '23456789', '555-2345', 'Avenida 456', 'maria@example.com', 'Swiss Medical', 2),
(3, 'Juan', 'Martínez', '34567890', '555-3456', 'Ruta 789', 'juan@example.com', 'Galeno', 1),
(4, 'Laura', 'Gómez', '45678901', '555-4567', 'Boulevard 012', 'laura@example.com', 'Medicus', 2),
(5, 'Lucía', 'Rodríguez', '56789012', '555-5678', 'Plaza Principal', 'lucia@example.com', 'IAPOS', 3),
(6, 'Pedro', 'Fernández', '67890123', '555-6789', 'Callejón 345', 'pedro@example.com', 'OSPIM', 1),
(7, 'Ana', 'Díaz', '78901234', '555-7890', 'Calle 678', 'ana@example.com', 'OSSEG', 2),
(8, 'Sofía', 'Pérez', '89012345', '555-8901', 'Avenida 901', 'sofia@example.com', 'Sancor Salud', 3),
(9, 'Martín', 'Suárez', '90123456', '555-9012', 'Calle 234', 'martin@example.com', 'OSPERYH', 1),
(10, 'Julieta', 'López', '01234567', '555-0123', 'Avenida 345', 'julieta@example.com', 'Federada Salud', 2);

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

INSERT INTO informes (idProfesional, idPaciente, idEstudio, idResultado, fecha, observacion) VALUES
(1, 1, 1, 1, '2024-05-20 09:30:00', 'Eco abdominal normal'),
(2, 2, 2, 2, '2024-05-21 10:30:00', 'Análisis de sangre dentro de valores normales'),
(3, 3, 3, 3, '2024-05-22 11:30:00', 'Radiografía sin hallazgos significativos'),
(4, 4, 4, 4, '2024-05-23 12:30:00', 'Electrocardiograma sin alteraciones'),
(5, 5, 5, 5, '2024-05-24 13:30:00', 'Lesión detectada en resonancia magnética'),
(6, 6, 6, 6, '2024-05-25 14:30:00', 'Anomalías en tomografía computarizada'),
(7, 7, 7, 7, '2024-05-26 15:30:00', 'Pólipos detectados en colonoscopía'),
(8, 8, 8, 8, '2024-05-27 16:30:00', 'Mamografía normal'),
(9, 9, 9, 9, '2024-05-28 17:30:00', 'Úlcera gástrica leve en endoscopía'),
(10, 10, 10, 10, '2024-05-29 18:30:00', 'Prueba de esfuerzo bien tolerada');


CREATE TABLE muestras (
    idMuestra INT AUTO_INCREMENT PRIMARY KEY,
    idPaciente INT,
    fecha DATETIME,
    descripcion VARCHAR(100),
    idResultado INT,
    rotulo VARCHAR(100),
    constraint fk_muestras_p foreign key (idPaciente) references pacientes(idPaciente)
);

INSERT INTO muestras (idPaciente, fecha, descripcion, idResultado, rotulo) VALUES
(1, '2024-05-20 09:30:00', 'Sangre', 1, 'Muestra A-123'),
(2, '2024-05-21 10:30:00', 'Sangre', 2, 'Muestra B-456'),
(3, '2024-05-22 11:30:00', 'Radiografía', 3, 'Muestra C-789'),
(4, '2024-05-23 12:30:00', 'Electrodos', 4, 'Muestra D-012'),
(5, '2024-05-24 13:30:00', 'Imágenes', 5, 'Muestra E-345'),
(6, '2024-05-25 14:30:00', 'Imágenes', 6, 'Muestra F-678'),
(7, '2024-05-26 15:30:00', 'Colonoscopia', 7, 'Muestra G-901'),
(8, '2024-05-27 16:30:00', 'Mamografía', 8, 'Muestra H-234'),
(9, '2024-05-28 17:30:00', 'Endoscopía', 9, 'Muestra I-567'),
(10, '2024-05-29 18:30:00', 'Electrocardiograma', 10, 'Muestra J-890');

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

INSERT INTO turnos (idProfesional, idConsultorio, idServicio, idPaciente, fechaHora, sobreturno, acreditado) VALUES
(1, 1, 1, 1, '2024-05-20 09:30:00', FALSE, TRUE),
(2, 2, 2, 2, '2024-05-21 10:30:00', FALSE, TRUE),
(3, 3, 3, 3, '2024-05-22 11:30:00', FALSE, TRUE),
(4, 4, 4, 4, '2024-05-23 12:30:00', FALSE, TRUE),
(5, 5, 5, 5, '2024-05-24 13:30:00', FALSE, TRUE),
(6, 6, 6, 6, '2024-05-25 14:30:00', FALSE, TRUE),
(7, 7, 7, 7, '2024-05-26 15:30:00', FALSE, TRUE),
(8, 8, 8, 8, '2024-05-27 16:30:00', FALSE, TRUE),
(9, 9, 9, 9, '2024-05-28 17:30:00', FALSE, TRUE),
(10, 10, 10, 10, '2024-05-29 18:30:00', FALSE, TRUE);

CREATE TABLE control_horario (
    idProfesional INT,
    fechaHoraIngreso DATETIME,
    fechaHoraEgreso DATETIME,
    constraint fk_control_horario_p foreign key (idProfesional) references profesionales(idProfesional)
);

INSERT INTO control_horario (idProfesional, fechaHoraIngreso, fechaHoraEgreso) VALUES
(1, '2024-05-20 09:00:00', '2024-05-20 18:00:00'),
(2, '2024-05-21 09:00:00', '2024-05-21 18:00:00'),
(3, '2024-05-22 09:00:00', '2024-05-22 18:00:00'),
(4, '2024-05-23 09:00:00', '2024-05-23 18:00:00'),
(5, '2024-05-24 09:00:00', '2024-05-24 18:00:00'),
(6, '2024-05-25 09:00:00', '2024-05-25 18:00:00'),
(7, '2024-05-26 09:00:00', '2024-05-26 18:00:00'),
(8, '2024-05-27 09:00:00', '2024-05-27 18:00:00'),
(9, '2024-05-28 09:00:00', '2024-05-28 18:00:00'),
(10, '2024-05-29 09:00:00', '2024-05-29 18:00:00');

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

INSERT INTO agendas (idProfesional, idConsultorio, idServicio, fechaHoraIngreso, fechaHoraEgreso) VALUES
(1, 1, 1, '2024-05-20 09:00:00', '2024-05-20 18:00:00'),
(2, 2, 2, '2024-05-21 09:00:00', '2024-05-21 18:00:00'),
(3, 3, 3, '2024-05-22 09:00:00', '2024-05-22 18:00:00'),
(4, 4, 4, '2024-05-23 09:00:00', '2024-05-23 18:00:00'),
(5, 5, 5, '2024-05-24 09:00:00', '2024-05-24 18:00:00'),
(6, 6, 6, '2024-05-25 09:00:00', '2024-05-25 18:00:00'),
(7, 7, 7, '2024-05-26 09:00:00', '2024-05-26 18:00:00'),
(8, 8, 8, '2024-05-27 09:00:00', '2024-05-27 18:00:00'),
(9, 9, 9, '2024-05-28 09:00:00', '2024-05-28 18:00:00'),
(10, 10, 10, '2024-05-29 09:00:00', '2024-05-29 18:00:00');

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

INSERT INTO pagos (idPaciente, idServicio, idObraSocial, fecha, importe, factura) VALUES
(1, 1, 1, '2024-05-20 09:30:00', 150.00, 'FAC-001'),
(2, 2, 2, '2024-05-21 10:30:00', 80.00, 'FAC-002'),
(3, 3, 3, '2024-05-22 11:30:00', 120.00, 'FAC-003'),
(4, 4, 4, '2024-05-23 12:30:00', 100.00, 'FAC-004'),
(5, 5, 5, '2024-05-24 13:30:00', 300.00, 'FAC-005'),
(6, 6, 6, '2024-05-25 14:30:00', 250.00, 'FAC-006'),
(7, 7, 7, '2024-05-26 15:30:00', 200.00, 'FAC-007'),
(8, 8, 8, '2024-05-27 16:30:00', 180.00, 'FAC-008'),
(9, 9, 9, '2024-05-28 17:30:00', 220.00, 'FAC-009'),
(10, 10, 10, '2024-05-29 18:30:00', 130.00, 'FAC-010');

CREATE TABLE recetas (
    idPaciente INT,
    idProfesional INT,
    fecha DATETIME,
    descripcion VARCHAR(50),
    constraint fk_recetas_p foreign key (idPaciente) references pacientes(idPaciente),
    constraint fk_recetas_pr foreign key (idProfesional) references profesionales(idProfesional)
);

INSERT INTO recetas (idPaciente, idProfesional, fecha, descripcion) VALUES
(1, 1, '2024-05-20 09:30:00', 'Analgesia para el dolor abdominal'),
(2, 2, '2024-05-21 10:30:00', 'Antibióticos para tratar infección'),
(3, 3, '2024-05-22 11:30:00', 'Antiinflamatorios para aliviar dolor'),
(4, 4, '2024-05-23 12:30:00', 'Medicación para regular ritmo cardíaco'),
(5, 5, '2024-05-24 13:30:00', 'Tratamiento para lesión en tejido blando'),
(6, 6, '2024-05-25 14:30:00', 'Medicamentos para afecciones hepáticas'),
(7, 7, '2024-05-26 15:30:00', 'Laxantes para preparación de colonoscopia'),
(8, 8, '2024-05-27 16:30:00', 'Indicaciones para seguimiento mamográfico'),
(9, 9, '2024-05-28 17:30:00', 'Tratamiento para úlcera gástrica'),
(10, 10, '2024-05-29 18:30:00', 'Recomendaciones post-prueba de esfuerzo');

CREATE TABLE horarios (
    idProfesional INT,
    fecha DATETIME,
    turno VARCHAR(50),
    constraint fk_horarios_p foreign key (idProfesional) references profesionales(idProfesional)
);

INSERT INTO horarios (idProfesional, fecha, turno) VALUES
(1, '2024-05-20', 'Mañana'),
(2, '2024-05-21', 'Mañana'),
(3, '2024-05-22', 'Mañana'),
(4, '2024-05-23', 'Mañana'),
(5, '2024-05-24', 'Mañana'),
(6, '2024-05-25', 'Mañana'),
(7, '2024-05-26', 'Mañana'),
(8, '2024-05-27', 'Mañana'),
(9, '2024-05-28', 'Mañana'),
(10, '2024-05-29', 'Mañana');

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